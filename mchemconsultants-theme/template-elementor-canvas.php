<?php
/**
 * Template Name: Elementor Canvas (No Header/Footer)
 * Template Post Type: page, post
 *
 * Blank canvas template for landing pages or full Elementor layouts.
 *
 * @package mchemconsultants
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'mchem-canvas' ); ?>>
<?php
wp_body_open();

while ( have_posts() ) :
    the_post();
    the_content();
endwhile;

wp_footer();
?>
</body>
</html>
