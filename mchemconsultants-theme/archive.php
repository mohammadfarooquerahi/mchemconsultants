<?php
/**
 * MChem Consultants - archive.php
 * @package mchemconsultants
 */
get_header();
?>
<div class="mchem-container" style="padding-block:var(--mchem-space-3xl);padding-top:calc(var(--mchem-space-3xl)+80px)">
    <div class="mchem-section-header">
        <h1 class="mchem-section-header__title"><?php the_archive_title(); ?></h1>
        <?php $desc=get_the_archive_description(); if($desc): ?><p class="mchem-section-header__sub"><?php echo wp_kses_post($desc); ?></p><?php endif; ?>
    </div>
    <?php if(have_posts()): ?>
    <div class="mchem-blog__grid">
        <?php while(have_posts()):the_post(); get_template_part("template-parts/components/post-card"); endwhile; ?>
    </div>
    <?php the_posts_pagination(array("mid_size"=>2,"prev_text"=>"&larr; ".esc_html__("Newer","mchemconsultants"),"next_text"=>esc_html__("Older","mchemconsultants")." &rarr;")); ?>
    <?php else: ?>
    <p style="text-align:center;color:var(--mchem-text-muted)"><?php esc_html_e("No posts found.","mchemconsultants"); ?></p>
    <?php endif; ?>
</div>
<?php get_footer();
