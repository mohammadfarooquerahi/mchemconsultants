<?php
/**
 * MChem Consultants - template-parts/sections/trust-bar.php
 *
 * Credibility / trust badge strip — affiliations, certifications, software.
 *
 * @package mchemconsultants
 */
?>

<!-- ============================================================
     TRUST BAR
     ============================================================ -->
<section class="mchem-trust" aria-label="<?php esc_attr_e( 'Affiliations and Credibility', 'mchemconsultants' ); ?>">
    <div class="mchem-trust__inner mchem-container">

        <p class="mchem-trust__label"><?php esc_html_e( 'Trusted by industry, mentored by academia', 'mchemconsultants' ); ?></p>

        <div class="mchem-trust__items">

            <div class="mchem-trust__item">
                <?php mchem_icon( 'check-circle', 'mchem-trust__icon', '16' ); ?>
                <span><?php esc_html_e( 'MUET — Dept. of Chemical Engineering', 'mchemconsultants' ); ?></span>
            </div>

            <span class="mchem-trust__sep" aria-hidden="true">·</span>

            <div class="mchem-trust__item">
                <?php mchem_icon( 'check-circle', 'mchem-trust__icon', '16' ); ?>
                <span><?php esc_html_e( 'BIC MUET Jamshoro — Incubated Startup', 'mchemconsultants' ); ?></span>
            </div>

            <span class="mchem-trust__sep" aria-hidden="true">·</span>

            <div class="mchem-trust__item">
                <?php mchem_icon( 'settings', 'mchem-trust__icon', '16' ); ?>
                <span><?php esc_html_e( 'Simulation and Modeling', 'mchemconsultants' ); ?></span>
            </div>

            <span class="mchem-trust__sep" aria-hidden="true">·</span>

            <div class="mchem-trust__item">
                <?php mchem_icon( 'shield', 'mchem-trust__icon', '16' ); ?>
                <span><?php esc_html_e( 'HAZOP & Risk Studies', 'mchemconsultants' ); ?></span>
            </div>

            <span class="mchem-trust__sep" aria-hidden="true">·</span>

            <div class="mchem-trust__item">
                <?php mchem_icon( 'leaf', 'mchem-trust__icon', '16' ); ?>
                <span><?php esc_html_e( 'Sustainable Engineering', 'mchemconsultants' ); ?></span>
            </div>

        </div><!-- /.mchem-trust__items -->

    </div><!-- /.mchem-trust__inner -->
</section><!-- /.mchem-trust -->
