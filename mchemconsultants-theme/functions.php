<?php
/**
 * MChem Consultants - functions.php
 *
 * Main theme bootstrap file. Loads all /inc/ modules in order.
 * Do NOT add theme logic here — keep this file as a clean loader only.
 *
 * @package mchemconsultants
 * @version 17.0.0
 */

defined( 'ABSPATH' ) || exit;

// ── Load helpers FIRST so utility functions are available everywhere ─────────
require_once get_template_directory() . '/inc/helpers.php';           // Utility / helper functions (icons, logos, WhatsApp URLs)
require_once get_template_directory() . '/inc/performance.php';       // Blazing-fast performance & head bloat removal engine
require_once get_template_directory() . '/inc/theme-setup.php';      // add_theme_support, nav menus, sidebars
require_once get_template_directory() . '/inc/enqueue.php';           // wp_enqueue_style/script
require_once get_template_directory() . '/inc/customizer.php';        // Customizer panels & controls
require_once get_template_directory() . '/inc/custom-post-types.php'; // CPTs: Services, Team + auto seed
require_once get_template_directory() . '/inc/acf-fields.php';        // ACF field group definitions
require_once get_template_directory() . '/inc/whatsapp-form.php';     // WhatsApp booking form handler
require_once get_template_directory() . '/inc/seo.php';               // SEO, Structured Data, Open Graph & 410 Purge engine
