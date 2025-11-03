<?php
/**
 * Plugin Name: WhatsApp Contact Form
 * Description: A simple contact form that sends messages directly to WhatsApp instead of email.
 * Version: 1.0.0
 * Author: Abdul Majeed Ali
 * Text Domain: whatsapp-contact-form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define constants
define( 'WCF_PATH', plugin_dir_path( __FILE__ ) );
define( 'WCF_URL', plugin_dir_url( __FILE__ ) );

// Include admin settings and shortcode
require_once WCF_PATH . 'admin/settings-page.php';
require_once WCF_PATH . 'public/form-shortcode.php';