<?php
/**
 * "Import starter content" button (Settings → Custom Closet Guys).
 * Creates the pages, sets the front page and imports the accessories with photos.
 * Re-running keeps what exists: pages are matched by slug, products by title.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ccg_pages() {
	// What we build, Getting started and Our work are sections of the home page (see the redirect below).
	return array(
		'home'        => 'Home',
		'design'      => 'Design your closet',
		'accessories' => 'Accessories',
		'contact'     => 'Contact',
	);
}

/**
 * Old page addresses (including the current site's /gallery/ and /getting-started/) go to the
 * matching section of the home page. Runs only when WordPress has no page at that address.
 */
add_action( 'template_redirect', function () {
	if ( ! is_404() ) {
		return;
	}
	$map  = array(
		'gallery'         => 'work',
		'our-work'        => 'work',
		'getting-started' => 'process',
		'what-we-build'   => 'services',
	);
	$path = trim( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH ), '/' ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$slug = basename( $path );
	if ( isset( $map[ $slug ] ) ) {
		wp_safe_redirect( home_url( '/' ) . '#' . $map[ $slug ], 301 );
		exit;
	}
} );

add_action( 'admin_post_ccg_setup_content', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Not allowed.' );
	}
	check_admin_referer( 'ccg_setup_content' );
	@set_time_limit( 300 ); // phpcs:ignore WordPress.PHP.NoSilencedErrors

	$made_pages = 0;
	foreach ( ccg_pages() as $slug => $title ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			$id = wp_insert_post( array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_content' => '',
			) );
			if ( $id && ! is_wp_error( $id ) ) {
				$made_pages++;
				$page = get_post( $id );
			}
		}
		if ( 'home' === $slug && $page ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $page->ID );
		}
	}

	$seed = require get_theme_file_path( 'inc/accessories-seed.php' );

	$term_ids = array();
	foreach ( $seed['categories'] as $c ) {
		$t = term_exists( $c['slug'], 'ccg_accessory_cat' );
		if ( ! $t ) {
			$t = wp_insert_term( $c['name'], 'ccg_accessory_cat', array( 'slug' => $c['slug'], 'description' => $c['blurb'] ) );
		}
		if ( ! is_wp_error( $t ) ) {
			$term_ids[ $c['slug'] ] = (int) $t['term_id'];
			if ( '' === get_term_meta( $t['term_id'], 'ccg_order', true ) ) {
				update_term_meta( $t['term_id'], 'ccg_order', $c['order'] );
			}
		}
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$made_products = 0;
	foreach ( $seed['products'] as $p ) {
		$existing = get_posts( array(
			'post_type'      => 'ccg_accessory',
			'title'          => $p['name'],
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		) );
		if ( $existing ) {
			continue;
		}
		$id = wp_insert_post( array(
			'post_type'    => 'ccg_accessory',
			'post_status'  => 'publish',
			'post_title'   => $p['name'],
			'post_excerpt' => $p['note'],
			'menu_order'   => $p['order'],
		) );
		if ( ! $id || is_wp_error( $id ) ) {
			continue;
		}
		update_post_meta( $id, '_ccg_url', esc_url_raw( $p['url'] ) );
		if ( isset( $term_ids[ $p['cat'] ] ) ) {
			wp_set_object_terms( $id, array( $term_ids[ $p['cat'] ] ), 'ccg_accessory_cat' );
		}
		$src = get_theme_file_path( 'assets/img/accessories/' . $p['image'] );
		if ( file_exists( $src ) ) {
			$tmp = wp_tempnam( $p['image'] );
			if ( $tmp && copy( $src, $tmp ) ) {
				$file   = array( 'name' => sanitize_file_name( sanitize_title( $p['name'] ) . '.jpg' ), 'tmp_name' => $tmp );
				$att_id = media_handle_sideload( $file, $id, $p['name'] );
				if ( ! is_wp_error( $att_id ) ) {
					set_post_thumbnail( $id, $att_id );
				} else {
					@unlink( $tmp ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
				}
			}
		}
		$made_products++;
	}

	$msg = sprintf( 'Done. %d pages and %d accessories created. Home is set as the front page.', $made_pages, $made_products );
	wp_safe_redirect( add_query_arg( 'ccg_setup', rawurlencode( $msg ), admin_url( 'options-general.php?page=ccg-settings' ) ) );
	exit;
} );

/* After activating the theme, point the admin to the import button. */
add_action( 'admin_notices', function () {
	if ( get_option( 'page_on_front' ) && get_page_by_path( 'accessories' ) && get_posts( array( 'post_type' => 'ccg_accessory', 'posts_per_page' => 1, 'fields' => 'ids' ) ) ) {
		return;
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	echo '<div class="notice notice-info"><p><strong>Custom Closet Guys theme:</strong> go to <a href="' . esc_url( admin_url( 'options-general.php?page=ccg-settings' ) ) . '">Settings → Custom Closet Guys</a> and click <em>Import starter content</em> to create the pages and accessories.</p></div>';
} );
