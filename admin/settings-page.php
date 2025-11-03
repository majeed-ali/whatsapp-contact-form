<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Add settings page
add_action('admin_menu', function() {
	add_options_page(
		'WhatsApp Contact Form Settings',
		'WhatsApp Contact Form',
		'manage_options',
		'whatsapp-contact-form',
		'wcf_settings_page_html'
	);
});

// Register settings
add_action('admin_init', function() {
	register_setting('wcf_settings_group', 'wcf_whatsapp_number');
	register_setting('wcf_settings_group', 'wcf_default_message');
});

function wcf_settings_page_html() {
	?>
	<div class="wrap">
		<h1>WhatsApp Contact Form Settings</h1>
		<form method="post" action="options.php">
			<?php settings_fields('wcf_settings_group'); ?>
			<?php do_settings_sections('wcf_settings_group'); ?>

			<table class="form-table">
				<tr valign="top">
					<th scope="row">WhatsApp Number</th>
					<td>
						<input type="text" name="wcf_whatsapp_number" value="<?php echo esc_attr(get_option('wcf_whatsapp_number')); ?>" placeholder="15551234567" class="regular-text" />
						<p class="description">Enter your WhatsApp number (with country code, no + or spaces).</p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">Default Greeting Message</th>
					<td>
						<textarea name="wcf_default_message" rows="3" class="large-text"><?php echo esc_textarea(get_option('wcf_default_message')); ?></textarea>
						<p class="description">Optional message that appears before form details.</p>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}