<?php
/**
 * MChem Consultants - template-parts/components/post-card.php
 * Reusable blog post card.
 * @package mchemconsultants
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("mchem-post-card"); ?>>
    <?php if(has_post_thumbnail()): ?>
    <a href="<?php the_permalink(); ?>" class="mchem-post-card__thumb" tabindex="-1">
        <?php the_post_thumbnail("medium",["loading"=>"lazy","class"=>"mchem-post-card__img"]); ?>
    </a>
    <?php endif; ?>
    <div class="mchem-post-card__body">
        <div class="mchem-post-card__meta">
            <time datetime="<?php echo esc_attr(get_the_date("c")); ?>"><?php echo esc_html(get_the_date()); ?></time>
        </div>
        <h2 class="mchem-post-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <p class="mchem-post-card__excerpt"><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="mchem-post-card__link">
            <?php esc_html_e("Read More","mchemconsultants"); ?>
        </a>
    </div>
</article>
