<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Register shortcode
add_shortcode('whatsapp_contact_form', function() {
	ob_start(); ?>
	<form id="whatsapp-contact-form" class="wcf-form">
		<p><input type="text" name="name" placeholder="Your Name" required /></p>
		<p><input type="email" name="email" placeholder="Your Email" required /></p>
		<p><textarea name="message" placeholder="Your Message" required></textarea></p>
		<p><button type="submit">Send to WhatsApp</button></p>
	</form>

	<script>
	document.addEventListener('DOMContentLoaded', function() {
		const form = document.getElementById('whatsapp-contact-form');
		form.addEventListener('submit', function(e) {
			e.preventDefault();

			const name = form.querySelector('[name="name"]').value;
			const email = form.querySelector('[name="email"]').value;
			const message = form.querySelector('[name="message"]').value;

			const phone = "<?php echo esc_js(get_option('wcf_whatsapp_number')); ?>";
			const defaultMsg = "<?php echo esc_js(get_option('wcf_default_message')); ?>";

			if(!phone) {
				alert('WhatsApp number not configured. Please check plugin settings.');
				return;
			}

			let text = defaultMsg ? defaultMsg + "\n\n" : "";
			text += "Name: " + name + "\nEmail: " + email + "\nMessage: " + message;

			const url = "https://wa.me/" + phone + "?text=" + encodeURIComponent(text);
			window.open(url, '_blank');
		});
	});
	</script>

	<style>
	.wcf-form input, .wcf-form textarea {width:100%;padding:10px;margin-bottom:10px;}
	.wcf-form button {background:#25d366;color:white;border:none;padding:10px 20px;cursor:pointer;}
	.wcf-form button:hover {background:#128c7e;}
	</style>
	<?php
	return ob_get_clean();
});