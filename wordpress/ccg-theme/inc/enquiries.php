<?php
/**
 * Consultation form handler.
 * Each enquiry is saved (wp-admin → Enquiries) and emailed to the address in Settings → Custom Closet Guys.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function () {
	register_post_type( 'ccg_enquiry', array(
		'labels'          => array(
			'name'          => 'Enquiries',
			'singular_name' => 'Enquiry',
			'edit_item'     => 'Enquiry',
		),
		'public'          => false,
		'show_ui'         => true,
		'menu_icon'       => 'dashicons-email-alt',
		'menu_position'   => 22,
		'supports'        => array( 'title', 'editor' ),
		'capability_type' => 'post',
		'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'    => true,
	) );
} );

function ccg_handle_enquiry() {
	$back = isset( $_POST['back'] ) ? esc_url_raw( wp_unslash( $_POST['back'] ) ) : home_url( '/contact/' );
	$back = wp_validate_redirect( $back, home_url( '/contact/' ) );

	if ( ! isset( $_POST['ccg_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['ccg_nonce'] ), 'ccg_enquiry' ) ) {
		wp_safe_redirect( $back );
		exit;
	}
	// Honeypot: bots fill the hidden "website" field. Pretend it worked.
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'sent', '1', $back ) . '#contact' );
		exit;
	}

	$f = array(
		'Name'    => sanitize_text_field( wp_unslash( isset( $_POST['name'] ) ? $_POST['name'] : '' ) ),
		'Phone'   => sanitize_text_field( wp_unslash( isset( $_POST['phone'] ) ? $_POST['phone'] : '' ) ),
		'Email'   => sanitize_email( wp_unslash( isset( $_POST['email'] ) ? $_POST['email'] : '' ) ),
		'Space'   => sanitize_text_field( wp_unslash( isset( $_POST['space'] ) ? $_POST['space'] : '' ) ),
		'Message' => sanitize_textarea_field( wp_unslash( isset( $_POST['message'] ) ? $_POST['message'] : '' ) ),
	);
	if ( '' === $f['Name'] || '' === $f['Phone'] ) {
		wp_safe_redirect( $back . '#contact' );
		exit;
	}

	$body = '';
	foreach ( $f as $k => $v ) {
		$body .= $k . ': ' . $v . "\n";
	}
	$body .= "\nSent from: " . $back;

	wp_insert_post( array(
		'post_type'    => 'ccg_enquiry',
		'post_status'  => 'private',
		'post_title'   => $f['Name'] . ' (' . $f['Space'] . ')',
		'post_content' => $body,
	) );

	$to = ccg_setting( 'enquiry_email' );
	if ( $to ) {
		$headers = array();
		if ( $f['Email'] ) {
			$headers[] = 'Reply-To: ' . $f['Name'] . ' <' . $f['Email'] . '>';
		}
		wp_mail( $to, 'New consultation request: ' . $f['Name'], $body, $headers );
	}

	wp_safe_redirect( add_query_arg( 'sent', '1', $back ) . '#contact' );
	exit;
}
add_action( 'admin_post_nopriv_ccg_enquiry', 'ccg_handle_enquiry' );
add_action( 'admin_post_ccg_enquiry', 'ccg_handle_enquiry' );
