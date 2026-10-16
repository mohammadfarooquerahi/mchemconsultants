<?php
/**
 * MChem Consultants - page.php
 * @package mchemconsultants
 */

if ( is_front_page() || is_home() ) {
    get_template_part( 'front-page' );
    return;
}

get_header();
while ( have_posts() ) : the_post();
    $content = get_the_content();
    if ( empty( trim( $content ) ) ) {
        get_template_part( 'template-parts/sections/hero' );
        get_template_part( 'template-parts/sections/trust-bar' );
        get_template_part( 'template-parts/sections/services-ticker' );
        get_template_part( 'template-parts/sections/services-grid' );
        get_template_part( 'template-parts/sections/projects' );
        get_template_part( 'template-parts/sections/industries' );
        get_template_part( 'template-parts/sections/team' );
        get_template_part( 'template-parts/sections/booking-form' );
    } else {
?>
<article class="mchem-page mchem-container" style="padding-block: var(--mchem-space-3xl); padding-top: calc(var(--mchem-space-3xl) + 80px);" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1 class="mchem-page__title"><?php the_title(); ?></h1>
    <div class="mchem-page__content"><?php the_content(); ?></div>
</article>
<?php
    }
endwhile;
get_footer();
