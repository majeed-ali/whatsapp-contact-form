# WhatsApp Contact Form

A simple WordPress plugin that provides a contact form which sends messages directly to WhatsApp instead of email.

- Plugin main file: `whatsapp-contact-form.php`
- Admin settings: `admin/settings-page.php`
- Public shortcode form: `public/form-shortcode.php`

## Features

- Add a contact form via shortcode to any post or page.
- Messages are sent directly to a configured WhatsApp number (opens WhatsApp / WhatsApp Web).
- Simple admin settings page to configure the target phone number and message templates.

## Requirements

- WordPress 5.0+ (recommended latest)
- PHP 7.2+ (follow host requirements)
- A phone with WhatsApp installed or desktop with WhatsApp Web for testing

## Installation

1. Upload the `whatsapp-contact-form` folder to the `/wp-content/plugins/` directory, or install via your preferred plugin installer.
2. Activate the plugin through the 'Plugins' screen in WordPress.

## Initial Setup

1. After activation, open the plugin settings page to configure your WhatsApp recipient and default message template.
   - The settings UI is provided by `admin/settings-page.php`.
   - Assumption: the settings page is available under the WordPress admin; look under **Settings** or the plugin list if you don't see a top-level menu.
2. Enter the target phone number (including country code but without the + or leading zeros). Example: `15551234567` for +1 555 123 4567.
3. Save settings.

Note: If you can't find the settings page, open `admin/settings-page.php` to see the exact admin menu slug and location.

## Usage — Shortcode

Place the following shortcode into a post or page where you want the form to appear:

[whatsapp_contact_form]

What this does:
- Renders a contact form (input fields and submit button).
- On submit, the plugin builds a WhatsApp URL with the message and opens WhatsApp or WhatsApp Web.

Optional: The plugin's `public/form-shortcode.php` file may accept additional shortcode attributes depending on implementation. If you want to customize behavior (button text, prefill text, or the target phone), check `public/form-shortcode.php` for supported attributes and examples.

Example (if attributes are supported by your version):

[whatsapp_contact_form button_text="Send on WhatsApp"]

If the plugin does not implement shortcode attributes, configure defaults in the admin settings page.

## Customization

- To change markup, validation, or the message template, edit `public/form-shortcode.php`.
- To add more settings, edit `admin/settings-page.php` and follow WordPress Settings API or option functions.

Developer contract (inputs / outputs):
- Input: Standard HTML form fields (name, email, message) — exact fields depend on `form-shortcode.php`.
- Output: Redirect to WhatsApp URL (web.whatsapp.com or whatsapp://) with prefilled message.
- Error modes: If WhatsApp cannot open, the form should fallback to showing the composed URL or instructing the user to copy/paste the message.

## Testing

1. Add the shortcode to a test page and view it on the front end.
2. Fill the form and press the send button.
3. Expected result: your browser opens a WhatsApp link (desktop => WhatsApp Web, mobile => WhatsApp app) with the message prefilled and the recipient set to the number configured in settings.

## Troubleshooting

- Nothing happens on submit:
  - Verify JavaScript is enabled and there are no JS errors. Check browser console.
  - Confirm the configured phone number in the settings is correct (country code + number, no "+").
- WhatsApp Web opens but recipient is not set:
  - Make sure the number uses the international format (country code + subscriber number, no leading zero). Example: `447700900123`.
- Settings page not visible:
  - Check `admin/settings-page.php` for the admin menu registration (menu slug and capability). You may need Administrator privileges.

## Security & Privacy

- The plugin sends messages to a WhatsApp number. It does not send emails by default.
- If you log or store submitted messages, ensure you comply with GDPR and local privacy regulations.
- Sanitize and escape all inputs if you modify the plugin. Use `sanitize_text_field()`, `esc_html()`, `wp_kses()` where appropriate.

## Localization

- The plugin header includes a text domain: `whatsapp-contact-form` in `whatsapp-contact-form.php`.
- To add translations, create `.pot`/.po/.mo files using the same text domain and load them with standard WordPress functions.

## Hooks & Extensibility

- If you want to add filters or actions, consider adding `apply_filters()` around the message template and `do_action()` on form submission inside `public/form-shortcode.php`.
- Example idea (not implemented automatically):

  - `apply_filters('wcf_message_template', $message, $form_data)` — lets other plugins modify the message text.
  - `do_action('wcf_after_submit', $form_data, $whatsapp_url)` — run custom code after the form builds the WhatsApp URL.

If you want, I can add these hooks as a small follow-up change.

## Changelog

- 1.0.0 — Initial release: basic contact form and admin settings.

## License

This plugin is provided under the terms set by the plugin author. If you plan to redistribute or modify, include a license file as appropriate (MIT, GPLv2+, etc.). WordPress plugins typically use GPL-compatible licenses.

## Support

For issues, open an issue in the repository or inspect plugin PHP files:
- `whatsapp-contact-form.php`
- `admin/settings-page.php`
- `public/form-shortcode.php`

If you want, I can also:
- Add example shortcode attributes and document them.
- Add a settings screenshot and menu location in the README.
- Add filters/actions to make the plugin more extensible.

---

(Assumptions: The README references the plugin files included with this repository. I inferred the admin page location and certain behaviors — if you want the README to show exact admin menu paths, shortcode attributes, or screenshots, I can open the specific files and update the README accordingly.)
