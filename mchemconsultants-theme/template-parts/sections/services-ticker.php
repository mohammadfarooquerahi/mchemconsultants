<?php
/**
 * MChem Consultants - template-parts/sections/services-ticker.php
 *
 * Animated infinite-scroll service cards ticker — mirrors niwnet.com service flow.
 *
 * @package mchemconsultants
 */

// Use transient-cached services for zero-DB overhead on page loads
$services_raw = function_exists( 'mchem_get_cached_services' ) ? mchem_get_cached_services() : ( function_exists( 'mchem_get_default_services' ) ? mchem_get_default_services() : array() );

if ( empty( $services_raw ) && function_exists( 'mchem_get_default_services' ) ) {
    $services_raw = mchem_get_default_services();
}

// Duplicate cards for seamless infinite marquee loop
$row1 = array_merge( $services_raw, $services_raw, $services_raw );
$row2 = array_reverse( $row1 );
?>

<!-- ============================================================
     SERVICES TICKER SECTION
     ============================================================ -->
<section
    class="mchem-ticker-section"
    aria-label="<?php esc_attr_e( 'MChem Consultants Services Overview', 'mchemconsultants' ); ?>"
>
    <p class="screen-reader-text">
        <?php esc_html_e( 'MChem Consultants core services include: Process Optimization & Simulation, Sustainable Engineering Solutions, Process Safety & Risk Management, Plant Design & Engineering, Energy Recovery & Efficiency, and Professional & Corporate Training.', 'mchemconsultants' ); ?>
    </p>

    <!-- Row 1: scrolls left -->
    <div class="mchem-ticker" data-direction="left" aria-hidden="true">
        <div class="mchem-ticker__track" id="mchem-ticker-row1">
            <?php foreach ( $row1 as $svc ) : ?>
            <article class="mchem-ticker__card">
                <div class="mchem-ticker__card-content">
                    <div class="mchem-ticker__icon-wrap">
                        <?php mchem_icon( esc_attr( isset($svc['icon']) ? $svc['icon'] : 'settings' ), 'mchem-ticker__icon', '22' ); ?>
                    </div>
                    <div class="mchem-ticker__text">
                        <p class="mchem-ticker__number"><?php echo esc_html( isset($svc['number']) ? $svc['number'] : '01' ); ?></p>
                        <p class="mchem-ticker__title"><?php echo esc_html( isset($svc['title']) ? $svc['title'] : '' ); ?></p>
                        <?php
                        $software_text = isset($svc['software']) ? $svc['software'] : '';
                        if ( stripos( $software_text, 'aspen' ) !== false || ( isset($svc['number']) && $svc['number'] === '01' && empty($software_text) ) ) {
                            $software_text = 'Simulation & Modeling';
                        }
                        if ( ! empty( $software_text ) ) :
                        ?>
                        <p class="mchem-ticker__software"><?php echo esc_html( $software_text ); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $svc['outcome'] ) ) : ?>
                    <div class="mchem-ticker__outcome">
                        <p class="mchem-ticker__outcome-text"><?php echo esc_html( $svc['outcome'] ); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Row 2: scrolls right -->
    <div class="mchem-ticker" data-direction="right" aria-hidden="true">
        <div class="mchem-ticker__track" id="mchem-ticker-row2">
            <?php foreach ( $row2 as $svc ) : ?>
            <article class="mchem-ticker__card">
                <div class="mchem-ticker__card-content">
                    <div class="mchem-ticker__icon-wrap">
                        <?php mchem_icon( esc_attr( isset($svc['icon']) ? $svc['icon'] : 'settings' ), 'mchem-ticker__icon', '22' ); ?>
                    </div>
                    <div class="mchem-ticker__text">
                        <p class="mchem-ticker__number"><?php echo esc_html( isset($svc['number']) ? $svc['number'] : '01' ); ?></p>
                        <p class="mchem-ticker__title"><?php echo esc_html( isset($svc['title']) ? $svc['title'] : '' ); ?></p>
                        <?php
                        $software_text_r2 = isset($svc['software']) ? $svc['software'] : '';
                        if ( stripos( $software_text_r2, 'aspen' ) !== false || ( isset($svc['number']) && $svc['number'] === '01' && empty($software_text_r2) ) ) {
                            $software_text_r2 = 'Simulation & Modeling';
                        }
                        if ( ! empty( $software_text_r2 ) ) :
                        ?>
                        <p class="mchem-ticker__software"><?php echo esc_html( $software_text_r2 ); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $svc['outcome'] ) ) : ?>
                    <div class="mchem-ticker__outcome">
                        <p class="mchem-ticker__outcome-text"><?php echo esc_html( $svc['outcome'] ); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
