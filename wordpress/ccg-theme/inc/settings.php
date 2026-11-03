<?php
/**
 * Settings → Custom Closet Guys.
 * Enquiry email, hours, test mode (banner + noindex) and an optional login lock for staging.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ccg_setting_defaults() {
	return array(
		'enquiry_email' => get_option( 'admin_email' ),
		'designer_url'  => '',
		'hours'         => '',
		'test_mode'     => 1,
		'login_lock'    => 0,
	);
}

function ccg_setting( $key ) {
	$all = wp_parse_args( (array) get_option( 'ccg_settings', array() ), ccg_setting_defaults() );
	return isset( $all[ $key ] ) ? $all[ $key ] : null;
}

add_action( 'admin_init', function () {
	register_setting( 'ccg_settings', 'ccg_settings', array(
		'type'              => 'array',
		'sanitize_callback' => function ( $in ) {
			$in = (array) $in;
			return array(
				'enquiry_email' => sanitize_email( isset( $in['enquiry_email'] ) ? $in['enquiry_email'] : '' ),
				'designer_url'  => esc_url_raw( isset( $in['designer_url'] ) ? trim( $in['designer_url'] ) : '' ),
				'hours'         => sanitize_text_field( isset( $in['hours'] ) ? $in['hours'] : '' ),
				'test_mode'     => empty( $in['test_mode'] ) ? 0 : 1,
				'login_lock'    => empty( $in['login_lock'] ) ? 0 : 1,
			);
		},
	) );
} );

add_action( 'admin_menu', function () {
	add_options_page( 'Custom Closet Guys', 'Custom Closet Guys', 'manage_options', 'ccg-settings', 'ccg_settings_page' );
} );

function ccg_settings_page() {
	$s = wp_parse_args( (array) get_option( 'ccg_settings', array() ), ccg_setting_defaults() );
	?>
	<div class="wrap">
		<h1>Custom Closet Guys</h1>
		<?php if ( isset( $_GET['ccg_setup'] ) ) : // phpcs:ignore ?>
			<div class="notice notice-success"><p><?php echo esc_html( sanitize_text_field( wp_unslash( $_GET['ccg_setup'] ) ) ); // phpcs:ignore ?></p></div>
		<?php endif; ?>
		<form method="post" action="options.php">
			<?php settings_fields( 'ccg_settings' ); ?>
			<table class="form-table" role="presentation">
				<tr><th scope="row"><label for="ccg-email">Send enquiries to</label></th>
					<td><input id="ccg-email" class="regular-text" type="email" name="ccg_settings[enquiry_email]" value="<?php echo esc_attr( $s['enquiry_email'] ); ?>">
					<p class="description">Consultation requests are emailed here and also saved under <strong>Enquiries</strong> in the sidebar.</p></td></tr>
				<tr><th scope="row"><label for="ccg-designer">Designer app URL</label></th>
					<td><input id="ccg-designer" class="regular-text" type="url" name="ccg_settings[designer_url]" value="<?php echo esc_attr( $s['designer_url'] ); ?>" placeholder="https://your-designer.vercel.app">
					<p class="description">The Custom Closet Guys deployment of the closet designer. While empty, the Design page shows the concept preview.</p></td></tr>
				<tr><th scope="row"><label for="ccg-hours">Business hours</label></th>
					<td><input id="ccg-hours" class="regular-text" type="text" name="ccg_settings[hours]" value="<?php echo esc_attr( $s['hours'] ); ?>" placeholder="Mon to Fri, 8am to 5pm"></td></tr>
				<tr><th scope="row">Test mode</th>
					<td><label><input type="checkbox" name="ccg_settings[test_mode]" value="1" <?php checked( $s['test_mode'], 1 ); ?>> Show the "Test site" banner and hide the site from search engines</label>
					<p class="description">Untick this on launch day.</p></td></tr>
				<tr><th scope="row">Staging lock</th>
					<td><label><input type="checkbox" name="ccg_settings[login_lock]" value="1" <?php checked( $s['login_lock'], 1 ); ?>> Only logged-in users can see the site</label>
					<p class="description">For a staging copy. Visitors are sent to the login screen. Never tick this on the live site.</p></td></tr>
			</table>
			<?php submit_button(); ?>
		</form>

		<hr>
		<h2>Starter content</h2>
		<p>Creates the site's pages (Home, Design, Accessories, Contact), sets Home as the front page and imports the 44 Amazon accessories with their photos. Safe to run more than once: existing pages and products are kept, not duplicated.</p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="ccg_setup_content">
			<?php wp_nonce_field( 'ccg_setup_content' ); ?>
			<?php submit_button( 'Import starter content', 'secondary', 'submit', false ); ?>
		</form>
	</div>
	<?php
}

/* Test mode: noindex. */
add_filter( 'wp_robots', function ( $robots ) {
	if ( ccg_setting( 'test_mode' ) ) {
		$robots['noindex']  = true;
		$robots['nofollow'] = true;
	}
	return $robots;
} );

/* Staging lock: send logged-out visitors to the login screen. */
add_action( 'template_redirect', function () {
	if ( ccg_setting( 'login_lock' ) && ! is_user_logged_in() ) {
		auth_redirect();
	}
} );
