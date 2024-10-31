<?php
/**
 * Plugin Name: ReCaptcha JS Alert
 * Plugin URI: https://wordpress.org/plugins/recaptcha-js-alert
 * Description: Notify visitors of your website if JavaScript required by reCAPTCHA is being blocked.
 * Version: 1.0.1
 * Author: freemp
 * Author URI: https://profiles.wordpress.org/freemp
 * Text Domain: recaptcha-js-alert
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'RECAPTCHA_JS_ALERT_VERSION', '1.0.1' );

if ( is_admin() ) {
	require_once dirname( __FILE__ ) . '/admin/recaptcha-js-alert-admin.php';
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'recaptcha_js_alert_action_links' );
}

add_action( 'plugins_loaded',
	function() {
		load_plugin_textdomain( 'recaptcha-js-alert', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		if ( false === get_option( 'recaptcha_js_alert_settings' ) )
			add_option( 'recaptcha_js_alert_settings', array(
				'message' => __( 'This form is protected against spam-bots. Please enable JavaScript.', 'recaptcha-js-alert' ),
				'delay' => '5000',
				'fg_color' => '#ffffff',
				'bg_color' => '#e94e00',
				'font_size' => '100',
				'custom_css' => ''
			) );
	} );

add_action( 'wp_enqueue_scripts',
	function() {
		wp_enqueue_style( 'recaptcha-js-alert', plugins_url( 'css/recaptcha-js-alert.css', __FILE__ ), array(), RECAPTCHA_JS_ALERT_VERSION );
	} );

add_shortcode( 'recaptcha-js-alert',
	function( $atts, $content = null ) {
		$settings = get_option( 'recaptcha_js_alert_settings' );
		$atts = shortcode_atts( array(
			'message' => '',
			'style' => 'background-color:' . $settings['bg_color'] . ';color:' . $settings['fg_color'] . ';font-size:' . $settings['font_size'] . '%;' . $settings['custom_css'],
			'delay' => $settings['delay']
		), $atts );
		$message = $atts['message'];
		if ( ! $message ) $message = $settings['message'];
		$style = 'display:none;' . $atts['style'];
		$delay = $atts['delay'];
		if ( ! is_numeric( $delay ) || $delay < 0 ) $delay = $settings['delay'];
		wp_enqueue_script( 'recaptcha-js-alert', plugins_url( 'js/recaptcha-js-alert.js', __FILE__), array(), RECAPTCHA_JS_ALERT_VERSION);
		wp_localize_script( 'recaptcha-js-alert', 'delay', $delay );
		return "<span id='recaptcha_js_alert_box' style='$style'>$message</span>";
	} );
