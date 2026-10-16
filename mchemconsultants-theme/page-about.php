<?php
/**
 * Template Name: About MChem Consultants
 *
 * @package mchemconsultants
 */

get_header();
?>

<div style="padding-top: 5rem;">
    <?php get_template_part( 'template-parts/sections/about' ); ?>
    <?php get_template_part( 'template-parts/sections/services-grid' ); ?>
    <?php get_template_part( 'template-parts/sections/team' ); ?>
    <?php get_template_part( 'template-parts/sections/booking-form' ); ?>
</div>

<?php
get_footer();