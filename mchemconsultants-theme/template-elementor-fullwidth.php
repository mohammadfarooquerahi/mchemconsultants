<?php
/**
 * Template Name: Elementor Full Width
 * Template Post Type: page, post, mchem_service
 *
 * A template for building pages using Elementor while retaining
 * the custom theme floating header and footer.
 *
 * @package mchemconsultants
 */

get_header();

while ( have_posts() ) :
    the_post();
    ?>
    <div class="mchem-elementor-fullwidth" style="padding-top: 100px;">
        <?php the_content(); ?>
    </div>
    <?php
endwhile;

get_footer();
