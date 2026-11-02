<?php
/**
 * Custom Closet Guys theme.
 *
 * Pages use their own templates (front-page.php, page-{slug}.php).
 * Accessories are a custom post type so Richard can edit products in wp-admin.
 * Enquiries are emailed and also saved in wp-admin, so nothing is lost while email is being set up.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CCG_VERSION', '1.0.0' );

require_once get_theme_file_path( 'inc/settings.php' );
require_once get_theme_file_path( 'inc/accessories.php' );
require_once get_theme_file_path( 'inc/enquiries.php' );
require_once get_theme_file_path( 'inc/setup-content.php' );

/* ---------- Theme basics ---------- */

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_image_size( 'ccg-product', 600, 600, false );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'ccg-fonts', 'https://fonts.googleapis.com/css2?family=Gloock&family=Hanken+Grotesk:wght@400;600;700&display=swap', array(), null );
	$css = get_theme_file_path( 'assets/css/site.css' );
	$js  = get_theme_file_path( 'assets/js/site.js' );
	wp_enqueue_style( 'ccg-site', get_theme_file_uri( 'assets/css/site.css' ), array( 'ccg-fonts' ), file_exists( $css ) ? filemtime( $css ) : CCG_VERSION );
	wp_enqueue_script( 'ccg-site', get_theme_file_uri( 'assets/js/site.js' ), array(), file_exists( $js ) ? filemtime( $js ) : CCG_VERSION, true );
	wp_add_inline_script( 'ccg-site', 'window.CCG_DESIGNER_URL = ' . wp_json_encode( (string) ccg_setting( 'designer_url' ) ) . ';', 'before' );
} );

add_filter( 'wp_resource_hints', function ( $urls, $relation ) {
	if ( 'preconnect' === $relation ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $urls;
}, 10, 2 );

/* ---------- Helpers used by the templates ---------- */

/** URL of one of the site's pages, by slug. Empty slug is the home page. */
function ccg_url( $slug = '' ) {
	return esc_url( home_url( $slug ? '/' . trim( $slug, '/' ) . '/' : '/' ) );
}

/** URL of a file inside the theme's assets folder. */
function ccg_asset( $path ) {
	return esc_url( get_theme_file_uri( 'assets/' . ltrim( $path, '/' ) ) );
}

/** aria-current for the nav. */
function ccg_current( $slug ) {
	$on = $slug ? is_page( $slug ) : is_front_page();
	return $on ? ' aria-current="page"' : '';
}

/** Business hours from settings, or the placeholder tag while empty. */
function ccg_hours() {
	$hours = ccg_setting( 'hours' );
	return $hours ? esc_html( $hours ) : '<span class="todo">[Hours]</span>';
}

/** True after a successful enquiry redirect. */
function ccg_sent() {
	return isset( $_GET['sent'] ) && '1' === $_GET['sent']; // phpcs:ignore WordPress.Security.NonceVerification
}

/** The consultation form's opening tag and hidden fields. */
function ccg_form_open() {
	$back = is_singular() ? get_permalink() : home_url( '/' );
	echo '<form class="form-grid" method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '">';
	echo '<input type="hidden" name="action" value="ccg_enquiry">';
	echo '<input type="hidden" name="back" value="' . esc_url( $back ) . '">';
	wp_nonce_field( 'ccg_enquiry', 'ccg_nonce' );
}
