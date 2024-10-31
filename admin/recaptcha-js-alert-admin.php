<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function recaptcha_js_alert_action_links( $links ) {
	array_unshift( $links, '<a href="' . esc_url( get_admin_url( null, 'options-general.php?page=recaptcha-js-alert-settings' ) ) . '">' . __( 'Settings' ) . '</a>' );
	return $links;
}

add_action( 'admin_enqueue_scripts',
	function() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'recaptcha-js-alert-admin', plugins_url( 'js/recaptcha-js-alert-admin.js', __FILE__ ), array( 'wp-color-picker' ), RECAPTCHA_JS_ALERT_VERSION );
	} );

add_action( 'admin_init',
	function() {
		register_setting( 'recaptcha-js-alert-settings', 'recaptcha_js_alert_settings' );
	} );

add_action( 'admin_menu',
	function() {
		add_options_page( __( 'ReCaptcha JS Alert Settings', 'recaptcha-js-alert' ), 'ReCaptcha JS Alert', 'administrator', 'recaptcha-js-alert-settings',
			function() {
				$settings = get_option( 'recaptcha_js_alert_settings' );
?>
<div class="wrap">
<h2><?php _e( 'ReCaptcha JS Alert Settings', 'recaptcha-js-alert' ); ?></h2>
<p><?php _e( 'ReCaptcha JS Alert provides the <tt>[recaptcha-js-alert]</tt> shortcode, which (if necessary) informs visitors of your website that a form requires JavaScript to run <strong>reCAPTCHA</strong>.', 'recaptcha-js-alert' ); ?></p>
<form method="post" action="options.php">
<?php settings_fields( 'recaptcha-js-alert-settings' ); ?>
<?php do_settings_sections( 'recaptcha-js-alert-settings' ); ?>
<table class="form-table">
	<tr valign="top">
	<th scope="row"><?php _e( 'Notification Message', 'recaptcha-js-alert' ); ?></th>
	<td><input type="text" size="60" name="recaptcha_js_alert_settings[message]" value="<?php echo esc_html( $settings['message'] ); ?>" /></td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Wait for reCAPTCHA', 'recaptcha-js-alert' ); ?></th>
	<td><input style="width:80px" type="number" name="recaptcha_js_alert_settings[delay]" min="0" step="1" required="true" value="<?php echo esc_attr( $settings['delay'] ); ?>" />&nbsp;<?php _e( 'milliseconds', 'recaptcha-js-alert' ); ?></td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Text Color', 'recaptcha-js-alert' ); ?></th>
	<td><input type="text" name="recaptcha_js_alert_settings[fg_color]" value="<?php echo esc_attr( $settings['fg_color'] ); ?>" class="wp_color_picker" data-default-color="#<?php echo esc_attr( $settings['fg_color'] ); ?>" /></td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Background Color', 'recaptcha-js-alert' ); ?></th>
	<td><input type="text" name="recaptcha_js_alert_settings[bg_color]" value="<?php echo esc_attr( $settings['bg_color'] ); ?>" class="wp_color_picker" data-default-color="#<?php echo esc_attr( $settings['bg_color'] ); ?>" /></td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Font Size', 'recaptcha-js-alert' ); ?></th>
	<td><input style="width:70px" type="number" name="recaptcha_js_alert_settings[font_size]" min="0" step="1" required="true" value="<?php echo esc_attr( $settings['font_size'] ); ?>" />&nbsp;&#37;</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Custom CSS', 'recaptcha-js-alert' ); ?></th>
	<td><input type="text" size="60" name="recaptcha_js_alert_settings[custom_css]" value="<?php echo esc_html( $settings['custom_css'] ); ?>" /></td>
	</tr>
</table>
<?php submit_button(); ?>
</form>
</div>
<?php
			} );
	} );
