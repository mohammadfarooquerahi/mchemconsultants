<?php
/**
 * MChem Consultants - inc/theme-setup.php
 *
 * Registers theme supports, navigation menus, and widget areas.
 *
 * @package mchemconsultants
 */

defined( 'ABSPATH' ) || exit;

/**
 * after_setup_theme: runs on every page load, before init.
 * Used for all theme declarations that must fire early.
 */
add_action( 'after_setup_theme', 'mchem_theme_setup' );
function mchem_theme_setup() {

    // Make theme translations-ready
    load_theme_textdomain( 'mchemconsultants', get_template_directory() . '/languages' );

    // Automatic feed links in <head>
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the <title> tag
    add_theme_support( 'title-tag' );

    // Enable featured images (post thumbnails) on all post types
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 800, 600, true );

    // Custom logo support — shown in header via the_custom_logo()
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // HTML5 semantic markup for core elements
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ) );

    // Post formats (for blog section flexibility)
    add_theme_support( 'post-formats', array( 'aside', 'gallery', 'quote', 'link', 'image', 'video' ) );

    // Gutenberg wide/full-width block alignment support
    add_theme_support( 'align-wide' );

    // Responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Elementor header/footer support
    add_theme_support( 'elementor' );

    // Register Navigation Menus
    register_nav_menus( array(
        'primary-menu' => esc_html__( 'Primary Navigation', 'mchemconsultants' ),
        'footer-menu'  => esc_html__( 'Footer Menu',        'mchemconsultants' ),
    ) );
}

/**
 * Register widget areas (sidebars).
 * The main site uses full-width layout, but widgets are available for
 * blog sidebar and footer columns.
 */
add_action( 'widgets_init', 'mchem_widgets_init' );
function mchem_widgets_init() {

    // Blog sidebar
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'mchemconsultants' ),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__( 'Appears on blog listing and single post pages.', 'mchemconsultants' ),
        'before_widget' => '<div id="%1$s" class="mchem-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="mchem-widget__title">',
        'after_title'   => '</h4>',
    ) );

    // Footer widget columns (3 columns)
    for ( $i = 1; $i <= 3; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( esc_html__( 'Footer Column %d', 'mchemconsultants' ), $i ),
            'id'            => "footer-col-{$i}",
            'description'   => sprintf( esc_html__( 'Footer widget column %d.', 'mchemconsultants' ), $i ),
            'before_widget' => '<div id="%1$s" class="mchem-footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="mchem-footer-widget__title">',
            'after_title'   => '</h5>',
        ) );
    }
}