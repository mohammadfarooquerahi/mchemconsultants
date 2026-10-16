<?php
/**
 * MChem Consultants - template-parts/sections/industries.php
 *
 * Interactive Curved Fan / Sector Solutions Deck matching NIW layout.
 *
 * @package mchemconsultants
 */

$industries = array(
    array(
        'id'       => 'oil-gas',
        'label'    => 'Oil & Gas',
        'category' => 'REFINING & HYDROCARBON PROCESSING',
        'desc'     => 'Crude distillation debottlenecking, process simulation and modeling, preheat train heat integration, and fractionation modeling for maximum hydrocarbon recovery.',
        'icon'     => 'factory',
        'active'   => true,
    ),
    array(
        'id'       => 'chemical',
        'label'    => 'Chemical',
        'category' => 'SPECIALTY & INDUSTRIAL CHEMICALS',
        'desc'     => 'Reactor kinetics modeling, chemical synthesis and purification trains, catalyst optimization, and high-pressure process safety studies.',
        'icon'     => 'flask',
        'active'   => false,
    ),
    array(
        'id'       => 'textile',
        'label'    => 'Textile',
        'category' => 'TEXTILE PROCESSING & DYEING UNITS',
        'desc'     => 'Process water recovery, thermal energy auditing, steam distribution optimization, waste-heat capture, and sustainable chemical processing.',
        'icon'     => 'leaf',
        'active'   => false,
    ),
    array(
        'id'       => 'academic',
        'label'    => 'Academic',
        'category' => 'ACADEMIA & CPD MASTERCLASSES',
        'desc'     => 'Hands-on simulation and modeling training, university mentorship programs, professional safety workshops, and accredited corporate masterclasses.',
        'icon'     => 'graduation-cap',
        'active'   => false,
    ),
);
?>

<!-- ============================================================
     INDUSTRIES SECTION (Curved Interactive Deck Matching NIW)
     ============================================================ -->
<section id="industries" class="mchem-industries-section" aria-labelledby="mchem-industries-heading">
    <div class="mchem-container">

        <!-- Section Header (Matches Screenshot 1) -->
        <div class="mchem-industries-header" data-animate="fade-up">
            <div class="mchem-industries-header__pill">
                <span><?php esc_html_e( 'INDUSTRIES', 'mchemconsultants' ); ?></span>
            </div>
            <h2 id="mchem-industries-heading" class="mchem-industries-header__title">
                Engineering shaped<br>
                <span class="mchem-industries-header__highlight"><?php esc_html_e( 'around your industry.', 'mchemconsultants' ); ?></span>
            </h2>
            <p class="mchem-industries-header__sub">
                <?php esc_html_e( 'Sector-specific engineering solutions designed around real operational requirements, rigorous chemical standards, and measurable industrial outcomes.', 'mchemconsultants' ); ?>
            </p>
        </div>

        <!-- Curved Interactive Fan / Deck Container (Matches Screenshot 1 & 2) -->
        <div class="mchem-fan-deck" data-animate="fade-up" data-delay="150">
            <div class="mchem-fan-deck__track" id="mchem-industries-deck" role="tablist" aria-label="<?php esc_attr_e( 'Industries Carousel', 'mchemconsultants' ); ?>">
                <?php
                foreach ( $industries as $i => $item ) :
                    $is_active = $item['active'];
                ?>
                <button
                    type="button"
                    class="mchem-fan-tile<?php echo $is_active ? ' is-active' : ''; ?>"
                    data-id="<?php echo esc_attr( $item['id'] ); ?>"
                    data-label="<?php echo esc_attr( $item['label'] ); ?>"
                    data-category="<?php echo esc_attr( $item['category'] ); ?>"
                    data-desc="<?php echo esc_attr( $item['desc'] ); ?>"
                    role="tab"
                    aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
                    aria-controls="mchem-industry-panel"
                    title="<?php echo esc_attr( $item['label'] ); ?>"
                >
                    <div class="mchem-fan-tile__icon-wrap">
                        <?php mchem_icon( $item['icon'], 'mchem-fan-tile__icon', '28' ); ?>
                    </div>
                    <span class="mchem-fan-tile__pill"><?php echo esc_html( $item['label'] ); ?></span>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Dynamic Information Panel (Matches Screenshot 2 Bottom) -->
        <div class="mchem-industry-info" id="mchem-industry-panel" role="tabpanel" data-animate="fade-up" data-delay="250">
            <span class="mchem-industry-info__category" id="mchem-ind-category">REFINING & HYDROCARBON PROCESSING</span>
            <p class="mchem-industry-info__desc" id="mchem-ind-desc">
                Crude distillation debottlenecking, process simulation and modeling, preheat train heat integration, and fractionation modeling for maximum hydrocarbon recovery.
            </p>
            <div class="mchem-industry-info__cta">
                <a href="<?php echo mchem_get_whatsapp_url( 'Hello MChem Consultants! I would like to discuss solutions for my industry.' ); ?>" class="mchem-btn mchem-btn--niw-primary" id="mchem-ind-wa" target="_blank" rel="noopener noreferrer">
                    <span>Discuss Your Industry Needs</span>
                    <svg class="mchem-btn__arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                </a>
            </div>
        </div>

    </div>
</section>
