<?php
/**
 * MChem Consultants - search.php
 * @package mchemconsultants
 */
get_header();
?>
<div class="mchem-container" style="padding-block:var(--mchem-space-3xl);padding-top:calc(var(--mchem-space-3xl)+80px)">
    <h1 class="mchem-section-header__title" style="margin-bottom:2rem">
        <?php printf(esc_html__("Search results for: %s","mchemconsultants"),"<span>".get_search_query()."</span>"); ?>
    </h1>
    <?php get_search_form(); ?>
    <?php if(have_posts()): ?>
    <div class="mchem-blog__grid" style="margin-top:2rem">
        <?php while(have_posts()):the_post(); get_template_part("template-parts/components/post-card"); endwhile; ?>
    </div>
    <?php else: ?>
    <p style="color:var(--mchem-text-muted);margin-top:2rem"><?php esc_html_e("No results found. Try a different search term.","mchemconsultants"); ?></p>
    <?php endif; ?>
</div>
<?php get_footer();
