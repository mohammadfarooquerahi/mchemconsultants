<?php
/**
 * MChem Consultants - footer.php
 *
 * Pre-footer CTA strip, 2-column company & contact directory, and legal sub-footer matching NIW.
 *
 * @package mchemconsultants
 */

$contact_email = get_theme_mod( 'mchem_contact_email', 'mchemconsultants2@gmail.com' );
$contact_phone = get_theme_mod( 'mchem_contact_phone', '+92 332 0386271' );
$contact_addr  = get_theme_mod( 'mchem_contact_address', 'Department of Chemical Engineering, Mehran University of Engineering and Technology (MUET), Jamshoro, Sindh, 76062, Pakistan' );
$wa_url        = mchem_get_whatsapp_url();
?>

</main><!-- /#mchem-main-content -->

<!-- ============================================================
     PRE-FOOTER CTA STRIP (Matches Screenshot 1)
     ============================================================ -->
<section class="mchem-prefooter-cta" aria-labelledby="mchem-cta-title">
    <div class="mchem-container">
        <div class="mchem-prefooter-cta__inner" data-animate="fade-up">

            <div class="mchem-prefooter-cta__pill">
                <span><?php esc_html_e( 'START A CONVERSATION', 'mchemconsultants' ); ?></span>
            </div>

            <h2 id="mchem-cta-title" class="mchem-prefooter-cta__title">
                Your next engineering<br>
                transformation <span class="mchem-prefooter-cta__highlight"><?php esc_html_e( 'starts here.', 'mchemconsultants' ); ?></span>
            </h2>

            <p class="mchem-prefooter-cta__sub">
                <?php esc_html_e( 'Tell us what you are designing, optimizing, or evaluating. MChem will help turn the concept into a rigorous, verified chemical engineering solution.', 'mchemconsultants' ); ?>
            </p>

            <div class="mchem-prefooter-cta__actions">
                <a href="#booking" class="mchem-btn mchem-btn--niw-primary">
                    <span><?php esc_html_e( 'Request a Consultation', 'mchemconsultants' ); ?></span>
                    <svg class="mchem-btn__arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                </a>
                <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="mchem-btn mchem-btn--niw-glass mchem-email-direct-btn" target="_blank" rel="noopener noreferrer">
                    <?php mchem_icon( 'mail', '', '18' ); ?>
                    <span><?php esc_html_e( 'Email Us', 'mchemconsultants' ); ?></span>
                </a>
                <a href="<?php echo esc_url( $wa_url ); ?>" class="mchem-btn mchem-btn--niw-glass" target="_blank" rel="noopener noreferrer">
                    <?php mchem_icon( 'whatsapp', '', '18' ); ?>
                    <span><?php esc_html_e( 'Chat on WhatsApp', 'mchemconsultants' ); ?></span>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     GLOBAL SITE FOOTER (Matches Screenshot 2)
     ============================================================ -->
<footer class="mchem-footer" role="contentinfo">
    <div class="mchem-container">

        <!-- Main 2-Column Split Directory (Company vs Contact) -->
        <div class="mchem-footer__main">

            <!-- LEFT: Company Identity -->
            <div class="mchem-footer__col mchem-footer__col--company">
                <span class="mchem-footer__heading"><?php esc_html_e( 'Company', 'mchemconsultants' ); ?></span>
                <h3 class="mchem-footer__title"><?php esc_html_e( 'MChem Consultants', 'mchemconsultants' ); ?></h3>
                <p class="mchem-footer__desc">
                    <?php esc_html_e( 'Faculty-guided engineering consultancy delivering process optimization, simulation modeling, HAZOP risk studies, and sustainable plant designs engineered around measurable industrial results.', 'mchemconsultants' ); ?>
                </p>
                <div class="mchem-footer__affiliation">
                    <div class="mchem-footer__bic-badge">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/BIC-MUET-logo.png' ); ?>" alt="BIC MUET Jamshoro Logo" class="mchem-footer__bic-img" width="36" height="36" loading="lazy">
                        <span class="mchem-footer__bic-text"><?php esc_html_e( 'Incubated at Business Incubation Center (BIC) MUET Jamshoro', 'mchemconsultants' ); ?></span>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Contact Directory -->
            <div class="mchem-footer__col mchem-footer__col--contact">
                <span class="mchem-footer__heading"><?php esc_html_e( 'Contact', 'mchemconsultants' ); ?></span>

                <!-- Email -->
                <div class="mchem-footer__item">
                    <span class="mchem-footer__item-label"><?php esc_html_e( 'EMAIL', 'mchemconsultants' ); ?></span>
                    <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="mchem-footer__item-val mchem-footer__item-val--link mchem-email-direct-btn" target="_blank" rel="noopener noreferrer">
                        <?php echo esc_html( $contact_email ); ?>
                        <svg class="mchem-footer__ext-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                    </a>
                </div>

                <!-- Office Address -->
                <div class="mchem-footer__item">
                    <span class="mchem-footer__item-label"><?php esc_html_e( 'OFFICE', 'mchemconsultants' ); ?></span>
                    <a href="https://maps.google.com/?q=Mehran+University+of+Engineering+and+Technology+Jamshoro" target="_blank" rel="noopener noreferrer" class="mchem-footer__item-val mchem-footer__item-val--link mchem-footer__item-val--address">
                        <svg class="mchem-footer__pin-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span><?php echo esc_html( $contact_addr ); ?></span>
                        <svg class="mchem-footer__ext-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                    </a>
                </div>

                <!-- WhatsApp & Phone -->
                <div class="mchem-footer__item">
                    <span class="mchem-footer__item-label"><?php esc_html_e( 'WHATSAPP & DIRECT LINE', 'mchemconsultants' ); ?></span>
                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="mchem-footer__item-val mchem-footer__item-val--link">
                        <?php echo esc_html( $contact_phone ); ?>
                        <svg class="mchem-footer__ext-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                    </a>
                </div>

                <!-- Website -->
                <div class="mchem-footer__item">
                    <span class="mchem-footer__item-label"><?php esc_html_e( 'WEBSITE', 'mchemconsultants' ); ?></span>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mchem-footer__item-val mchem-footer__item-val--link">
                        mchemconsultants.com
                        <svg class="mchem-footer__ext-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                    </a>
                </div>

            </div>

        </div>

        <!-- Bottom Legal Bar (Matches Screenshot 2 Bottom) -->
        <div class="mchem-footer__bottom">
            <div class="mchem-footer__copyright">
                <span class="mchem-footer__legal-name"><?php esc_html_e( 'MChem Consultants', 'mchemconsultants' ); ?></span>
                <span class="mchem-footer__legal-copy">&copy; <?php echo date('Y'); ?> <?php esc_html_e( 'MChem Consultants. All rights reserved.', 'mchemconsultants' ); ?></span>
            </div>

            <nav class="mchem-footer__nav" aria-label="<?php esc_attr_e( 'Footer Navigation', 'mchemconsultants' ); ?>">
                <a href="#home"><?php esc_html_e( 'Home', 'mchemconsultants' ); ?></a>
                <a href="#about"><?php esc_html_e( 'About', 'mchemconsultants' ); ?></a>
                <a href="#services"><?php esc_html_e( 'Services', 'mchemconsultants' ); ?></a>
                <a href="#projects"><?php esc_html_e( 'Projects', 'mchemconsultants' ); ?></a>
                <a href="#gallery"><?php esc_html_e( 'Gallery', 'mchemconsultants' ); ?></a>
                <a href="#industries"><?php esc_html_e( 'Industries', 'mchemconsultants' ); ?></a>
                <a href="#team"><?php esc_html_e( 'Team', 'mchemconsultants' ); ?></a>
                <a href="#reviews"><?php esc_html_e( 'Reviews', 'mchemconsultants' ); ?></a>
                <a href="#booking"><?php esc_html_e( 'Book Consultation', 'mchemconsultants' ); ?></a>
            </nav>

            <div class="mchem-footer__talk">
                <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="mchem-footer__talk-link">
                    <span><?php esc_html_e( "Let's talk", 'mchemconsultants' ); ?></span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                </a>
            </div>
        </div>

        <!-- Developer Credit (10% opacity, 50% on hover) -->
        <div class="mchem-footer__developer">
            <span class="mchem-footer__developer-text"><?php esc_html_e( 'Developed by Mohammad Farooque', 'mchemconsultants' ); ?></span>
        </div>

    </div>
</footer>

<!-- ============================================================
     STICKY FLOATING CONTACT DOCK (Email + WhatsApp)
     ============================================================ -->
<aside class="mchem-floating-contact" aria-label="<?php esc_attr_e( 'Quick Contact Options', 'mchemconsultants' ); ?>">
    <!-- Email Float Button -->
    <a
        href="mailto:<?php echo esc_attr( $contact_email ); ?>"
        class="mchem-floating-btn mchem-floating-btn--email mchem-email-direct-btn"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="<?php esc_attr_e( 'Email MChem Consultants', 'mchemconsultants' ); ?>"
        title="<?php esc_attr_e( 'Email: mchemconsultants2@gmail.com', 'mchemconsultants' ); ?>"
    >
        <?php mchem_icon( 'mail', 'mchem-floating-btn__icon', '18' ); ?>
        <span class="mchem-floating-btn__label"><?php esc_html_e( 'Email us', 'mchemconsultants' ); ?></span>
    </a>

    <!-- WhatsApp Float Button -->
    <a
        href="<?php echo esc_url( $wa_url ); ?>"
        class="mchem-floating-btn mchem-floating-btn--wa"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="<?php esc_attr_e( 'Chat with MChem on WhatsApp', 'mchemconsultants' ); ?>"
        title="<?php esc_attr_e( 'WhatsApp: +92 332 0386271', 'mchemconsultants' ); ?>"
    >
        <span class="mchem-floating-btn__pulse" aria-hidden="true"></span>
        <?php mchem_icon( 'whatsapp', 'mchem-floating-btn__icon', '20' ); ?>
        <span class="mchem-floating-btn__label"><?php esc_html_e( 'Chat with us', 'mchemconsultants' ); ?></span>
    </a>
</aside>

<?php wp_footer(); ?>
</body>
</html>
