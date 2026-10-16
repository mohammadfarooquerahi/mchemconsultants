<?php
/**
 * MChem Consultants - single.php
 * Single post template.
 * @package mchemconsultants
 */
get_header();
while ( have_posts() ) : the_post();
?>
<article class="mchem-single mchem-container" style="padding-block:var(--mchem-space-3xl);padding-top:calc(var(--mchem-space-3xl)+80px);max-width:800px;" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="mchem-single__header">
        <div class="mchem-section-header mchem-section-header--left" style="margin-bottom:2rem">
            <?php the_category( ', ' ); ?>
        </div>
        <h1 class="mchem-single__title"><?php the_title(); ?></h1>
        <div class="mchem-single__meta">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
            <span><?php the_author(); ?></span>
        </div>
        <?php if(has_post_thumbnail()):?>
        <div class="mchem-single__thumb"><?php the_post_thumbnail('large',['loading'=>'lazy','class'=>'mchem-single__img']); ?></div>
        <?php endif; ?>
    </header>
    <div class="mchem-single__content"><?php the_content(); ?></div>
    <?php wp_link_pages(); ?>
    <footer class="mchem-single__footer">
        <?php the_tags('<div class="mchem-single__tags">','','</div>'); ?>
        <div class="mchem-single__nav"><?php the_post_navigation(); ?></div>
    </footer>
</article>
<?php endwhile; get_footer();
