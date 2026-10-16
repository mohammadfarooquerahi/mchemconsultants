<?php
/**
 * MChem Consultants - template-parts/sections/about.php
 *
 * About MChem Consultants & Our Story Section.
 * Exact client story, BIC MUET Incubation details, mission statement, and pillars.
 *
 * @package mchemconsultants
 */
?>

<!-- ============================================================
     ABOUT & OUR STORY SECTION (NIW Standard)
     ============================================================ -->
<section id="about" class="mchem-about-section" aria-labelledby="mchem-about-heading">
    <div class="mchem-container">

        <!-- Split Section Header -->
        <div class="mchem-about-header" data-animate="fade-up">
            <div class="mchem-about-header__left">
                <div class="mchem-about-header__pill">
                    <span><?php esc_html_e( 'ABOUT & OUR STORY', 'mchemconsultants' ); ?></span>
                </div>
                <h2 id="mchem-about-heading" class="mchem-about-header__title">
                    About <span class="mchem-about-header__highlight"><?php esc_html_e( 'MChem Consultants', 'mchemconsultants' ); ?></span>
                </h2>
            </div>
            <div class="mchem-about-header__right">
                <div class="mchem-about-header__mission-box">
                    <span class="mchem-about-header__mission-tag"><?php esc_html_e( 'OUR MISSION', 'mchemconsultants' ); ?></span>
                    <p class="mchem-about-header__mission-text">
                        <?php echo esc_html( get_theme_mod( 'mchem_about_mission', 'To enhance industrial safety, operational efficiency, and environmental sustainability through cost-effective, faculty-guided, and technology-driven engineering consultancy services.' ) ); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Bento Grid: Main Story + Pillars -->
        <div class="mchem-about-grid">

            <!-- Main Narrative Card -->
            <div class="mchem-about-card mchem-about-card--main" data-animate="fade-up" data-delay="100">
                <div class="mchem-about-card__top">
                    <span class="mchem-about-card__badge"><?php esc_html_e( 'BIC MUET INCUBATED STARTUP', 'mchemconsultants' ); ?></span>
                    <span class="mchem-about-card__num">01</span>
                </div>

                <h3 class="mchem-about-card__title">
                    <?php esc_html_e( 'Bridging Academic Engineering Rigor with Real Industrial Performance', 'mchemconsultants' ); ?>
                </h3>

                <div class="mchem-about-card__content">
                    <p class="mchem-about-card__lead">
                        <?php echo esc_html( get_theme_mod( 'mchem_about_story', 'MChem Consultants is a specialized Chemical Engineering consultancy firm incubated at the Business Incubation Center (BIC), Mehran University of Engineering and Technology (MUET), Jamshoro. We provide expert solutions in Process Safety & Risk Management, Process Optimization & Simulation, Sustainable Engineering Solutions, and Professional Training for the Oil & Gas, Chemical, and Textile industries.' ) ); ?>
                    </p>
                </div>

                <!-- Affiliation & Credibility Badges -->
                <div class="mchem-about-affils">
                    <div class="mchem-about-affil">
                        <div class="mchem-about-affil__icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                        </div>
                        <div class="mchem-about-affil__info">
                            <strong><?php esc_html_e( 'Department of Chemical Engineering', 'mchemconsultants' ); ?></strong>
                            <span><?php esc_html_e( 'MUET Jamshoro — Faculty Mentorship', 'mchemconsultants' ); ?></span>
                        </div>
                    </div>

                    <div class="mchem-about-affil">
                        <div class="mchem-about-affil__icon" style="overflow:hidden;padding:3px;background:#ffffff;">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/BIC-MUET-logo.png' ); ?>" alt="BIC MUET Jamshoro" style="width:100%;height:100%;object-fit:contain;">
                        </div>
                        <div class="mchem-about-affil__info">
                            <strong><?php esc_html_e( 'Business Incubation Center (BIC)', 'mchemconsultants' ); ?></strong>
                            <span><?php esc_html_e( 'Incubated Enterprise & Industry Hub', 'mchemconsultants' ); ?></span>
                        </div>
                    </div>
                </div>

                <div class="mchem-about-card__footer">
                    <a href="#booking" class="mchem-btn mchem-btn--niw-primary">
                        <span><?php esc_html_e( 'Discuss Your Project With Us', 'mchemconsultants' ); ?></span>
                        <svg class="mchem-btn__arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                    </a>
                </div>
            </div>

            <!-- Side Pillar 1: Safety -->
            <div class="mchem-about-card mchem-about-card--pillar" data-animate="fade-up" data-delay="150">
                <div class="mchem-about-pillar__icon mchem-about-pillar__icon--blue">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h4 class="mchem-about-pillar__title"><?php esc_html_e( 'Process Safety & Risk Studies', 'mchemconsultants' ); ?></h4>
                <p class="mchem-about-pillar__desc">
                    <?php esc_html_e( 'HAZOP facilitation, LOPA analyses, safety integrity level assessments, and regulatory compliance studies to protect personnel and capital assets.', 'mchemconsultants' ); ?>
                </p>
                <span class="mchem-about-pillar__tag"><?php esc_html_e( 'HAZOP · LOPA · Safety QRA', 'mchemconsultants' ); ?></span>
            </div>

            <!-- Side Pillar 2: Optimization -->
            <div class="mchem-about-card mchem-about-card--pillar" data-animate="fade-up" data-delay="200">
                <div class="mchem-about-pillar__icon mchem-about-pillar__icon--cyan">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                </div>
                <h4 class="mchem-about-pillar__title"><?php esc_html_e( 'Simulation & Process Optimization', 'mchemconsultants' ); ?></h4>
                <p class="mchem-about-pillar__desc">
                    <?php esc_html_e( 'High-fidelity simulation, column debottlenecking, thermodynamic analysis, and energy recovery networks delivering measurable operational ROI.', 'mchemconsultants' ); ?>
                </p>
                <span class="mchem-about-pillar__tag"><?php esc_html_e( 'Simulation · Pinch · Optimization', 'mchemconsultants' ); ?></span>
            </div>

            <!-- Side Pillar 3: Sustainability -->
            <div class="mchem-about-card mchem-about-card--pillar" data-animate="fade-up" data-delay="250">
                <div class="mchem-about-pillar__icon mchem-about-pillar__icon--teal">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
                </div>
                <h4 class="mchem-about-pillar__title"><?php esc_html_e( 'Sustainable Solutions & Training', 'mchemconsultants' ); ?></h4>
                <p class="mchem-about-pillar__desc">
                    <?php esc_html_e( 'Waste-to-energy conversion, net-zero carbon roadmaps, and CPD-certified masterclasses for engineers in Oil & Gas, Chemical, and Textile sectors.', 'mchemconsultants' ); ?>
                </p>
                <span class="mchem-about-pillar__tag"><?php esc_html_e( 'Net-Zero · Waste-to-Energy · CPD', 'mchemconsultants' ); ?></span>
            </div>

        </div>

    </div>
</section>