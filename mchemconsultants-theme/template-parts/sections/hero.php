<?php
/**
 * MChem Consultants - template-parts/sections/hero.php
 *
 * Hero section matching the NIW editorial serif + dual pill CTA layout.
 *
 * @package mchemconsultants
 */

$heading_line1 = get_theme_mod( 'mchem_hero_heading_1', 'We engineer intelligent process solutions' );
$heading_line2 = get_theme_mod( 'mchem_hero_heading_2', 'drive industrial performance.' );
$sub           = get_theme_mod( 'mchem_hero_sub', 'Engineering Sustainable Solutions for better tomorrow' );
$cta1_text     = get_theme_mod( 'mchem_hero_cta1', 'Process Simulation & Services' );
$cta2_text     = get_theme_mod( 'mchem_hero_cta2', 'Request a Consultation' );
?>

<!-- ============================================================
     HERO SECTION (NIW Layout)
     ============================================================ -->
<section id="home" class="mchem-hero" aria-labelledby="mchem-hero-heading">

    <!-- Atmospheric background lighting & Loop Video -->
    <div class="mchem-hero__bg" aria-hidden="true">
        <video
            class="mchem-hero__video"
            id="mchem-hero-bg-video"
            src="<?php echo esc_url( get_template_directory_uri() . '/assets/videos/bgvideomchem.mp4' ); ?>"
            autoplay
            loop
            muted
            playsinline
            webkit-playsinline
            preload="metadata"
            disablepictureinpicture
            disableremoteplayback
        >
            <source src="<?php echo esc_url( get_template_directory_uri() . '/assets/videos/bgvideomchem.mp4' ); ?>" type="video/mp4">
        </video>
        <div class="mchem-hero__video-overlay"></div>
        <div class="mchem-hero__bg-glow"></div>
        <div class="mchem-hero__bg-grid"></div>
        <div class="mchem-hero__bg-particles" id="mchem-particles"></div>
        <span class="mchem-hero__bg-line"></span>
    </div>

    <div class="mchem-hero__inner mchem-container">
        <div class="mchem-hero__content">

            <!-- Eyebrow Badge -->
            <div class="mchem-hero__eyebrow-wrap" data-animate="fade-up">
                <span class="mchem-hero__eyebrow">
                    <span class="mchem-hero__eyebrow-dot"></span>
                    Faculty-Guided · Industry-Focused · MUET BIC Incubated
                </span>
            </div>

            <!-- Main Editorial Serif Heading -->
            <h1 id="mchem-hero-heading" class="mchem-hero__heading" data-animate="fade-up" data-delay="100">
                <?php echo esc_html( $heading_line1 ); ?><br>
                that <span class="mchem-hero__highlight"><?php echo esc_html( $heading_line2 ); ?></span>
            </h1>

            <!-- Subtitle -->
            <p class="mchem-hero__sub" data-animate="fade-up" data-delay="200">
                <?php echo esc_html( $sub ); ?>
            </p>

            <!-- Dual Pill Action Buttons (Matches Screenshot) -->
            <div class="mchem-hero__cta" data-animate="fade-up" data-delay="300">
                <a href="#services" class="mchem-btn mchem-btn--niw-primary">
                    <span><?php echo esc_html( $cta1_text ); ?></span>
                    <svg class="mchem-btn__arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                </a>

                <a href="#booking" class="mchem-btn mchem-btn--niw-glass">
                    <svg class="mchem-btn__icon-left" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.88 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.83 3h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 10.1A16 16 0 0 0 13.9 15.9l1.06-1.06a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span><?php echo esc_html( $cta2_text ); ?></span>
                    <svg class="mchem-btn__chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
                </a>
            </div>

        </div>
    </div>

</section>
