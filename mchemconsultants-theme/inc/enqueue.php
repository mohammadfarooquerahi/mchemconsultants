<?php
/**
 * MChem Consultants - inc/enqueue.php
 *
 * Enqueues all stylesheets and scripts with instant non-blocking delivery and cache busting.
 * @package mchemconsultants
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', 'mchem_enqueue_assets', 10 );
function mchem_enqueue_assets() {

    $dir = get_template_directory();
    $uri = get_template_directory_uri();

    $v = function( $file ) use ( $dir ) {
        $path = $dir . $file;
        return file_exists( $path ) ? filemtime( $path ) : '27.0.0';
    };

    // ── GOOGLE FONTS ──
    wp_enqueue_style(
        'mchem-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // ── MAIN COMBINED STYLESHEET ──
    wp_enqueue_style(
        'mchem-main-style',
        get_stylesheet_uri(),
        array(),
        $v( '/style.css' )
    );

    // ── SCRIPTS ──
    wp_enqueue_script(
        'mchem-main',
        $uri . '/assets/js/main.js',
        array(),
        $v( '/assets/js/main.js' ),
        true
    );

    wp_enqueue_script(
        'mchem-ticker',
        $uri . '/assets/js/ticker.js',
        array( 'mchem-main' ),
        $v( '/assets/js/ticker.js' ),
        true
    );

    wp_enqueue_script(
        'mchem-whatsapp-form',
        $uri . '/assets/js/whatsapp-form.js',
        array( 'mchem-main' ),
        $v( '/assets/js/whatsapp-form.js' ),
        true
    );

    wp_localize_script( 'mchem-whatsapp-form', 'mchemData', array(
        'whatsapp_number' => get_theme_mod( 'mchem_whatsapp_number', '923320386271' ),
        'email'           => get_theme_mod( 'mchem_contact_email',   'mchemconsultants2@gmail.com' ),
        'ajax_url'        => admin_url( 'admin-ajax.php' ),
        'nonce'           => wp_create_nonce( 'mchem_booking_nonce' ),
        'site_name'       => get_bloginfo( 'name' ),
    ) );
}

// ── TIDIO LIVE CHAT ────────────────────────────────────────────────────────────
// To enable Tidio live chat: go to Appearance > Customize > MChem Theme Options
// and paste your Tidio Public Key. Leave blank to disable.
add_action( 'wp_footer', 'mchem_inject_tidio_chat', 99 );
function mchem_inject_tidio_chat() {
    $tidio_key = get_theme_mod( 'mchem_tidio_key', '' );
    if ( ! empty( $tidio_key ) ) {
        $key = esc_attr( trim( $tidio_key ) );
        echo '<script src="//code.tidio.co/' . $key . '.js" async></script>' . "\n";
    }
}