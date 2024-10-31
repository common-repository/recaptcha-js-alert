=== ReCaptcha JS Alert ===
Contributors: freemp
Tags: recaptcha, javascript, disabled, blocked, notification, warning, test, alert
Requires at least: 3.8
Tested up to: 6.6
Stable tag: trunk
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

ReCaptcha JS Alert provides the `[recaptcha-js-alert]` shortcode, which (if necessary) informs visitors of your website that a form requires JavaScript to run __reCAPTCHA__.

== Description ==

A lightweight WordPress plugin providing the `[recaptcha-js-alert]` shortcode which may be used to display a notification text box if JavaScript required by __reCAPTCHA__ is being blocked.

Next to the notification message text and the delay allowing to load the __reCAPTCHA__ JavaScript code, the plugin offers configuration of background and foreground color, as well as the font size. Further customization can be achieved by means of custom CSS snippets.

The shortcode allows its configuration being overridden by the following parameters:

* `message`: The notification message text
* `style`: Custom CSS for displaying the message text
* `delay`: The delay (in milliseconds) allowing the __reCAPTCHA__ JavaScript code to load

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/recaptcha-js-alert` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Settings->ReCaptcha JS Alert screen to configure the plugin.

== Frequently Asked Questions ==

= Does ReCaptcha JS Alert support multilingual sites? =

Yes, it does. A corresponding `wpml-config.xml` language configuration file can be found in the plugin's home directory.

= I would like the notification text box being displayed differently. Would that be possible? =

Sure. Additional CSS code may be entered into the `Custom CSS` input field in the configuration screen of the plugin. In order to completely overrride the generated CSS, the shortcode's `style` parameter may be used.

= The message box shows up even though no JavaScript is being blocked and the __reCAPTCHA__ challenge also shows up correctly. =

Make sure the browser is allowed to access `google.com` and `gstatic.com` as __reCAPTCHA__ requires to load its code from these domains.
Also make sure the delay specified in the plugin settings under `Wait for reCAPTCHA` or by the `delay` shortcode parameter is big enough to allow the __reCAPTCHA__ JavaScript code to load. If the delay is too short, the plugin cannot find the corresponding page elements and thinks that loading the JavaScript code was blocked.

== Screenshots ==

1. Notification Message
2. Shortcode Usage in Page Editor
3. Plugin Settings

== Changelog ==

= 1.0.1 =
* Resorted screenshots.
* Fixed misplaced newlines.
* Added another FAQ item.

= 1.0.0 =
* Initial release.
