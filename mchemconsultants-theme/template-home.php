<?php
/**
 * Template Name: MChem Full Homepage
 *
 * @package mchemconsultants
 */
?>
<?php
/**
 * MChem Consultants - Full Homepage Layout (NIW Standard)
 *
 * @package mchemconsultants
 */

get_header();
?>

<?php get_template_part( 'template-parts/sections/hero' ); ?>
<?php get_template_part( 'template-parts/sections/trust-bar' ); ?>
<?php get_template_part( 'template-parts/sections/about' ); ?>
<?php get_template_part( 'template-parts/sections/services-ticker' ); ?>
<?php get_template_part( 'template-parts/sections/services-grid' ); ?>
<?php get_template_part( 'template-parts/sections/projects' ); ?>
<?php get_template_part( 'template-parts/sections/gallery' ); ?>
<?php get_template_part( 'template-parts/sections/industries' ); ?>
<?php get_template_part( 'template-parts/sections/team' ); ?>
<?php get_template_part( 'template-parts/sections/reviews' ); ?>
<?php get_template_part( 'template-parts/sections/booking-form' ); ?>

<?php
get_footer();
