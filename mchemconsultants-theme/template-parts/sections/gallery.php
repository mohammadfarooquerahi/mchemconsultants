<?php
/**
 * Gallery Section Template - MChem Consultants
 * Real Chemical Engineering showcase images & interactive lightbox
 */

$gallery_query = new WP_Query([
    'post_type'      => 'mchem_gallery',
    'posts_per_page' => -1,
    'post_status'    => 'publish'
]);

$default_gallery_items = array(
    array(
        'title'    => 'Process Simulation & Modeling Workshop',
        'category' => 'SIMULATION & MODELING',
        'image'    => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1200&q=80',
        'desc'     => 'Thermodynamic modeling, column hydraulics, and mass-energy balance calculations.',
    ),
    array(
        'title'    => 'Industrial Chemical Plant & Distillation Columns',
        'category' => 'PLANT DESIGN & DEBOTTLENECKING',
        'image'    => 'https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=1200&q=80',
        'desc'     => 'On-site technical evaluation of preheat trains, reboilers, and fractionation units.',
    ),
    array(
        'title'    => 'Process Safety, HAZOP & Risk Studies',
        'category' => 'PROCESS SAFETY & HAZOP',
        'image'    => 'https://images.unsplash.com/photo-1581092335397-9583fe92d232?auto=format&fit=crop&w=1200&q=80',
        'desc'     => 'Comprehensive HAZOP node evaluation, safety interlocks, and risk matrix verification.',
    ),
    array(
        'title'    => 'Sustainable Engineering & Waste-to-Energy Systems',
        'category' => 'SUSTAINABLE ENGINEERING',
        'image'    => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?auto=format&fit=crop&w=1200&q=80',
        'desc'     => 'Heat integration pinch analysis and renewable biomass gasification engineering.',
    ),
    array(
        'title'    => 'Engineering Blueprint & PFD / P&ID Review Session',
        'category' => 'FACULTY & TEAM COLLABORATION',
        'image'    => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=1200&q=80',
        'desc'     => 'Detailed review of piping & instrumentation diagrams with departmental faculty guidance.',
    ),
    array(
        'title'    => 'BIC MUET Jamshoro Incubation & Analytical Lab',
        'category' => 'BIC MUET INCUBATION',
        'image'    => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1200&q=80',
        'desc'     => 'Advanced analytical research, chemical engineering testing, and startup incubation.',
    ),
);
?>
<section id="gallery" class="mchem-gallery-section" data-animate="fade-up">
    <div class="mchem-container">
        <div class="mchem-gallery-header" data-animate="fade-up">
            <h2 class="mchem-gallery-header__title"><span class="mchem-gallery-header__dash">—</span> <?php esc_html_e( 'GALLERY', 'mchemconsultants' ); ?></h2>
            <p class="mchem-gallery-header__sub"><?php esc_html_e( 'A visual showcase of our engineering projects, workshops, and industrial collaborations.', 'mchemconsultants' ); ?></p>
        </div>

        <div class="mchem-gallery-grid" data-animate="fade-up">
            <?php if ( $gallery_query->have_posts() ) : ?>
                <?php while ( $gallery_query->have_posts() ) : $gallery_query->the_post(); 
                    $video_url = get_post_meta( get_the_ID(), 'mchem_gallery_video_url', true );
                    $image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    $is_video  = !empty($video_url);
                    $media_url = $is_video ? $video_url : $image_url;
                ?>
                    <div class="mchem-gallery-item" data-media="<?php echo esc_attr($media_url); ?>" data-type="<?php echo $is_video ? 'video' : 'image'; ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img class="mchem-gallery-item__img" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
                        <?php else: ?>
                            <img class="mchem-gallery-item__img" src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
                        <?php endif; ?>
                        
                        <?php if ( $is_video ) : ?>
                            <div class="mchem-gallery-item__play">
                                <svg viewBox="0 0 24 24" width="48" height="48" fill="white"><circle cx="12" cy="12" r="10" fill="rgba(0,0,0,0.5)"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                            </div>
                        <?php endif; ?>
                        <div class="mchem-gallery-item__caption">
                            <?php the_title(); ?>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <?php foreach ( $default_gallery_items as $item ) : ?>
                    <div class="mchem-gallery-item" data-media="<?php echo esc_url($item['image']); ?>" data-type="image">
                        <img class="mchem-gallery-item__img" src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" loading="lazy">
                        <div class="mchem-gallery-item__caption">
                            <span class="mchem-gallery-item__cat"><?php echo esc_html($item['category']); ?></span>
                            <span class="mchem-gallery-item__title"><?php echo esc_html($item['title']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="mchem-gallery-lightbox" class="mchem-gallery-lightbox" style="display: none;">
    <div class="mchem-gallery-lightbox__overlay"></div>
    <div class="mchem-gallery-lightbox__content">
        <button class="mchem-gallery-lightbox__close" aria-label="Close lightbox">&times;</button>
        <div id="mchem-gallery-lightbox__media" class="mchem-gallery-lightbox__media"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.getElementById('mchem-gallery-lightbox');
    const lightboxMedia = document.getElementById('mchem-gallery-lightbox__media');
    const closeBtn = document.querySelector('.mchem-gallery-lightbox__close');
    const overlay = document.querySelector('.mchem-gallery-lightbox__overlay');
    const items = document.querySelectorAll('.mchem-gallery-item');

    function openLightbox(url, type) {
        if (!url) return;
        lightboxMedia.innerHTML = '';
        if (type === 'video') {
            if (url.includes('youtube.com') || url.includes('youtu.be') || url.includes('vimeo.com')) {
                let embedUrl = url;
                if (url.includes('youtube.com/watch?v=')) {
                    embedUrl = url.replace('watch?v=', 'embed/');
                } else if (url.includes('youtu.be/')) {
                    embedUrl = url.replace('youtu.be/', 'www.youtube.com/embed/');
                }
                lightboxMedia.innerHTML = `<iframe src="${embedUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
            } else {
                lightboxMedia.innerHTML = `<video src="${url}" controls autoplay style="max-width:100%; max-height:80vh;"></video>`;
            }
        } else {
            lightboxMedia.innerHTML = `<img src="${url}" style="max-width:90vw; max-height:85vh; border-radius:12px; object-fit:contain;" alt="MChem Engineering Gallery">`;
        }
        lightbox.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.style.display = 'none';
        lightboxMedia.innerHTML = '';
        document.body.style.overflow = '';
    }

    items.forEach(function (item) {
        item.addEventListener('click', function () {
            const mediaUrl = this.getAttribute('data-media');
            const mediaType = this.getAttribute('data-type');
            openLightbox(mediaUrl, mediaType);
        });
    });

    if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
    if (overlay) overlay.addEventListener('click', closeLightbox);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lightbox && lightbox.style.display !== 'none') {
            closeLightbox();
        }
    });
});
</script>