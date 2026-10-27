<?php
/**
 * MChem Consultants - inc/performance.php
 *
 * Lightweight Performance & Head Sanitization Engine:
 * 1. Removes WordPress head bloat (emojis, embeds, RSD, generator tags).
 * 2. Adds DNS prefetch & preconnect resource hints for fonts.
 * 3. Transient query caching helpers.
 *
 * @package mchemconsultants
 */

defined( 'ABSPATH' ) || exit;

// ── 1. CLEAN WP HEAD BLOAT ──────────────────────────────────────────────────
add_action( 'init', 'mchem_clean_wp_head' );
function mchem_clean_wp_head() {
    // Emojis
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    // Meta tags & links (Keep REST discovery intact)
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}

// ── 2. RESOURCE HINTS & PRECONNECT ──────────────────────────────────────────
add_filter( 'wp_resource_hints', 'mchem_resource_hints', 10, 2 );
function mchem_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href'        => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}

// ── 3. TRANSIENT QUERY CACHING HELPERS ──────────────────────────────────────
function mchem_get_cached_services() {
    $cached = get_transient( 'mchem_services_cache' );
    if ( false !== $cached && is_array( $cached ) && ! empty( $cached ) ) {
        return $cached;
    }

    $services_query = new WP_Query( array(
        'post_type'      => 'mchem_service',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'no_found_rows'  => true,
    ) );

    $services_raw = array();
    if ( $services_query->have_posts() ) {
        while ( $services_query->have_posts() ) {
            $services_query->the_post();
            $software_val = get_post_meta( get_the_ID(), 'mchem_service_software', true );
            if ( stripos( $software_val, 'aspen' ) !== false || empty( $software_val ) ) {
                $software_val = 'Simulation & Modeling';
            }
            $services_raw[] = array(
                'title'    => get_the_title(),
                'excerpt'  => get_the_excerpt(),
                'icon'     => get_post_meta( get_the_ID(), 'mchem_service_icon', true ) ?: 'settings',
                'number'   => get_post_meta( get_the_ID(), 'mchem_service_number', true ) ?: '01',
                'software' => $software_val,
                'outcome'  => get_post_meta( get_the_ID(), 'mchem_service_outcome', true ),
            );
        }
        wp_reset_postdata();
    }

    if ( empty( $services_raw ) && function_exists( 'mchem_get_default_services' ) ) {
        $services_raw = mchem_get_default_services();
    }

    set_transient( 'mchem_services_cache', $services_raw, 12 * HOUR_IN_SECONDS );
    return $services_raw;
}

add_action( 'save_post_mchem_service', function() {
    delete_transient( 'mchem_services_cache' );
} );

add_action( 'after_switch_theme', function() {
    delete_transient( 'mchem_services_cache' );
} );

// ── 4. DEFER NON-CRITICAL JAVASCRIPT TO UNBLOCK RENDERING ──────────────────
add_filter( 'script_loader_tag', 'mchem_defer_scripts', 10, 3 );
function mchem_defer_scripts( $tag, $handle, $src ) {
    // Keep admin scripts untouched
    if ( is_admin() ) {
        return $tag;
    }

    // Scripts that should be deferred to allow instant visual painting
    $defer_scripts = array(
        'mchem-ticker',
        'mchem-whatsapp-form',
        'comment-reply',
    );

    if ( in_array( $handle, $defer_scripts, true ) ) {
        if ( false === strpos( $tag, ' defer' ) ) {
            $tag = str_replace( ' src', ' defer="defer" src', $tag );
        }
    }

    return $tag;
}

// ── 5. ENTERPRISE HTTP SECURITY HEADERS ──────────────────────────────────────
add_action( 'send_headers', 'mchem_security_headers' );
function mchem_security_headers() {
    if ( ! is_admin() && ! headers_sent() ) {
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-Frame-Options: SAMEORIGIN' );
        header( 'X-XSS-Protection: 1; mode=block' );
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
        header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
    }
}

// ── 6. DISABLE XML-RPC PINGBACK DDOS VECTORS ─────────────────────────────────
add_filter( 'xmlrpc_methods', function( $methods ) {
    unset( $methods['pingback.ping'] );
    return $methods;
} );
add_filter( 'wp_headers', function( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
} );

// ── 7. REMOVE QUERY STRINGS FROM STATIC ASSETS (Cache Optimization) ──────────
add_filter( 'style_loader_src', 'mchem_remove_query_strings', 10, 2 );
add_filter( 'script_loader_src', 'mchem_remove_query_strings', 10, 2 );
function mchem_remove_query_strings( $src ) {
    if ( strpos( $src, '?ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
