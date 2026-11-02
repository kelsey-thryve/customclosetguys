<?php
/**
 * Accessories: one product per post.
 *   Title          = product name
 *   Excerpt        = short note under the name
 *   Featured image = product photo
 *   Amazon link    = meta box below the editor
 *   Category       = Accessory categories (description = the blurb shown under the heading)
 *   Order          = "Order" box (lower shows first); categories use the "Display order" field
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function () {
	register_post_type( 'ccg_accessory', array(
		'labels'        => array(
			'name'          => 'Accessories',
			'singular_name' => 'Accessory',
			'add_new_item'  => 'Add accessory',
			'edit_item'     => 'Edit accessory',
			'all_items'     => 'All accessories',
		),
		'public'        => false,
		'show_ui'       => true,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-cart',
		'menu_position' => 21,
		'supports'      => array( 'title', 'excerpt', 'thumbnail', 'page-attributes' ),
	) );

	register_taxonomy( 'ccg_accessory_cat', 'ccg_accessory', array(
		'labels'            => array(
			'name'          => 'Accessory categories',
			'singular_name' => 'Accessory category',
			'menu_name'     => 'Categories',
		),
		'public'            => false,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
	) );
} );

/* Amazon link meta box. */
add_action( 'add_meta_boxes', function () {
	add_meta_box( 'ccg_url', 'Amazon link', function ( $post ) {
		wp_nonce_field( 'ccg_url_save', 'ccg_url_nonce' );
		$url = get_post_meta( $post->ID, '_ccg_url', true );
		echo '<input type="url" name="ccg_url" value="' . esc_attr( $url ) . '" style="width:100%" placeholder="https://amzn.to/...">';
		echo '<p class="description">Paste the Amazon affiliate link (SiteStripe short link is fine).</p>';
	}, 'ccg_accessory', 'normal', 'high' );
} );

add_action( 'save_post_ccg_accessory', function ( $post_id ) {
	if ( ! isset( $_POST['ccg_url_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['ccg_url_nonce'] ), 'ccg_url_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$url = isset( $_POST['ccg_url'] ) ? esc_url_raw( wp_unslash( $_POST['ccg_url'] ) ) : '';
	update_post_meta( $post_id, '_ccg_url', $url );
} );

/* Admin list: thumbnail and link columns. */
add_filter( 'manage_ccg_accessory_posts_columns', function ( $cols ) {
	$new = array();
	foreach ( $cols as $k => $v ) {
		if ( 'title' === $k ) {
			$new['ccg_thumb'] = 'Photo';
		}
		$new[ $k ] = $v;
		if ( 'title' === $k ) {
			$new['ccg_link'] = 'Amazon link';
		}
	}
	return $new;
} );
add_action( 'manage_ccg_accessory_posts_custom_column', function ( $col, $post_id ) {
	if ( 'ccg_thumb' === $col ) {
		echo get_the_post_thumbnail( $post_id, array( 56, 56 ) );
	}
	if ( 'ccg_link' === $col ) {
		$url = get_post_meta( $post_id, '_ccg_url', true );
		echo $url ? '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener">' . esc_html( $url ) . '</a>' : '<em>Missing</em>';
	}
}, 10, 2 );

/* Category display order field. */
$ccg_order_field = function ( $term = null ) {
	$val = is_object( $term ) ? (int) get_term_meta( $term->term_id, 'ccg_order', true ) : 0;
	echo '<div class="form-field"><label for="ccg_order">Display order</label><input id="ccg_order" name="ccg_order" type="number" value="' . esc_attr( $val ) . '"><p>Lower numbers show first on the Accessories page.</p></div>';
};
add_action( 'ccg_accessory_cat_add_form_fields', $ccg_order_field );
add_action( 'ccg_accessory_cat_edit_form_fields', function ( $term ) {
	$val = (int) get_term_meta( $term->term_id, 'ccg_order', true );
	echo '<tr class="form-field"><th><label for="ccg_order">Display order</label></th><td><input id="ccg_order" name="ccg_order" type="number" value="' . esc_attr( $val ) . '"><p class="description">Lower numbers show first on the Accessories page.</p></td></tr>';
} );
$ccg_save_order = function ( $term_id ) {
	if ( isset( $_POST['ccg_order'] ) && current_user_can( 'manage_categories' ) ) { // phpcs:ignore WordPress.Security.NonceVerification -- core term screens verify their own nonce.
		update_term_meta( $term_id, 'ccg_order', (int) $_POST['ccg_order'] );
	}
};
add_action( 'created_ccg_accessory_cat', $ccg_save_order );
add_action( 'edited_ccg_accessory_cat', $ccg_save_order );

/** Categories in display order, each with its published products. */
function ccg_accessory_groups() {
	$terms = get_terms( array(
		'taxonomy'   => 'ccg_accessory_cat',
		'hide_empty' => true,
	) );
	if ( is_wp_error( $terms ) ) {
		return array();
	}
	usort( $terms, function ( $a, $b ) {
		return (int) get_term_meta( $a->term_id, 'ccg_order', true ) - (int) get_term_meta( $b->term_id, 'ccg_order', true );
	} );
	$groups = array();
	foreach ( $terms as $term ) {
		$items = get_posts( array(
			'post_type'      => 'ccg_accessory',
			'posts_per_page' => -1,
			'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
			'tax_query'      => array( array( 'taxonomy' => 'ccg_accessory_cat', 'terms' => $term->term_id ) ), // phpcs:ignore WordPress.DB.SlowDBQuery
		) );
		if ( $items ) {
			$groups[] = array( 'term' => $term, 'items' => $items );
		}
	}
	return $groups;
}
