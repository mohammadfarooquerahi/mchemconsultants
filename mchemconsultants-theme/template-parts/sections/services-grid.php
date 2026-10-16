<?php
/**
 * MChem Consultants - template-parts/sections/services-grid.php
 *
 * Services section matching NIW layout:
 * - Left: "OUR SERVICES" tag + Editorial serif heading with highlight
 * - Right: Explanatory paragraph
 * - 3-Column interactive cards with category, serif title, description, and circular arrow CTA
 *
 * @package mchemconsultants
 */

$services_list = array(
    array(
        'number'   => '01',
        'category' => 'PROCESS SIMULATION',
        'title'    => 'Process Simulation & Modeling',
        'desc'     => 'Process simulation and modeling, thermodynamic analysis, plant debottlenecking, and real-time process performance optimization for chemical units.',
        'icon'     => 'settings',
        'badge'    => 'Simulation & Modeling',
    ),
    array(
        'number'   => '02',
        'category' => 'SUSTAINABILITY',
        'title'    => 'Sustainable Engineering & Waste-to-Energy',
        'desc'     => 'Waste-to-energy conversion, resource recovery, environmental lifecycle assessments, and sustainable green chemical processes.',
        'icon'     => 'leaf',
        'badge'    => 'Net-Zero Solutions',
    ),
    array(
        'number'   => '03',
        'category' => 'PROCESS SAFETY',
        'title'    => 'Process Safety & HAZOP Risk Studies',
        'desc'     => 'HAZOP facilitation, Quantitative Risk Assessment (QRA), LOPA studies, safety instrumented systems, and regulatory compliance audits.',
        'icon'     => 'shield',
        'badge'    => 'HAZOP / LOPA',
    ),
    array(
        'number'   => '04',
        'category' => 'PLANT DESIGN',
        'title'    => 'Plant Design & Engineering Layouts',
        'desc'     => 'Comprehensive chemical plant design, Block Flow (BFD), PFD, P&ID development, equipment sizing, and detailed technical specifications.',
        'icon'     => 'factory',
        'badge'    => 'PFD / P&ID',
    ),
    array(
        'number'   => '05',
        'category' => 'ENERGY EFFICIENCY',
        'title'    => 'Energy Recovery & Pinch Integration',
        'desc'     => 'Waste-heat recovery networks, Pinch analysis, heat exchanger network synthesis, and process thermal efficiency maximization.',
        'icon'     => 'zap',
        'badge'    => 'Pinch Analysis',
    ),
    array(
        'number'   => '06',
        'category' => 'CORPORATE TRAINING',
        'title'    => 'Professional & Corporate Training',
        'desc'     => 'Industry-focused workshops and CPD-certified masterclasses in process simulation and modeling, process safety principles, and plant operations.',
        'icon'     => 'graduation-cap',
        'badge'    => 'CPD Certified',
    ),
);

// If database has posts, enrich/merge with CPT
$services_query = new WP_Query( array(
    'post_type'      => 'mchem_service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

if ( $services_query->have_posts() ) {
    $cpt_list = array();
    while ( $services_query->have_posts() ) {
        $services_query->the_post();
        $cpt_list[] = array(
            'number'   => get_post_meta( get_the_ID(), 'mchem_service_number', true ) ?: '01',
            'category' => strtoupper( get_post_meta( get_the_ID(), 'mchem_service_software', true ) ?: 'ENGINEERING' ),
            'title'    => get_the_title(),
            'desc'     => get_the_excerpt() ?: get_the_content(),
            'icon'     => get_post_meta( get_the_ID(), 'mchem_service_icon', true ) ?: 'settings',
            'badge'    => get_post_meta( get_the_ID(), 'mchem_service_outcome', true ) ?: '',
        );
    }
    wp_reset_postdata();
    if ( ! empty( $cpt_list ) ) {
        $services_list = $cpt_list;
    }
}
?>

<!-- ============================================================
     SERVICES GRID SECTION (NIW Matching)
     ============================================================ -->
<section id="services" class="mchem-services-section" aria-labelledby="mchem-services-heading">
    <div class="mchem-container">

        <!-- Split Section Header (Matches Screenshot 1) -->
        <div class="mchem-services-header" data-animate="fade-up">
            <div class="mchem-services-header__left">
                <div class="mchem-services-header__pill">
                    <span><?php esc_html_e( 'OUR SERVICES', 'mchemconsultants' ); ?></span>
                </div>
                <h2 id="mchem-services-heading" class="mchem-services-header__title">
                    Expertise designed to<br>
                    <span class="mchem-services-header__highlight"><?php esc_html_e( 'move business forward.', 'mchemconsultants' ); ?></span>
                </h2>
            </div>
            <div class="mchem-services-header__right">
                <p class="mchem-services-header__desc">
                    <?php esc_html_e( 'Explore MChem\'s capabilities through a collection of interactive service cards. Each one opens into the engineering rigor, simulation modeling, and industrial outcomes behind the work.', 'mchemconsultants' ); ?>
                </p>
            </div>
        </div>

        <!-- 3-Column Interactive Service Cards Grid (Matches Screenshot 2) -->
        <div class="mchem-services-cards__grid" role="list">
            <?php
            $delay = 0;
            foreach ( $services_list as $index => $svc ) :
                $delay += 80;
                $is_first = ( $index === 0 );
            ?>
            <article
                class="mchem-niw-card<?php echo $is_first ? ' mchem-niw-card--active' : ''; ?>"
                role="listitem"
                data-animate="fade-up"
                data-delay="<?php echo esc_attr( $delay ); ?>"
            >
                <!-- Decorative concentric arc lines in background -->
                <div class="mchem-niw-card__arcs" aria-hidden="true">
                    <span class="mchem-niw-card__arc mchem-niw-card__arc--1"></span>
                    <span class="mchem-niw-card__arc mchem-niw-card__arc--2"></span>
                </div>

                <!-- Top Row: Icon Badge (Left) + Number (Right) -->
                <div class="mchem-niw-card__top">
                    <div class="mchem-niw-card__icon-box">
                        <?php mchem_icon( esc_attr( $svc['icon'] ), 'mchem-niw-card__icon', '22' ); ?>
                    </div>
                    <span class="mchem-niw-card__num"><?php echo esc_html( $svc['number'] ); ?></span>
                </div>

                <!-- Middle Content -->
                <div class="mchem-niw-card__body">
                    <span class="mchem-niw-card__category"><?php echo esc_html( $svc['category'] ); ?></span>
                    <h3 class="mchem-niw-card__title"><?php echo esc_html( $svc['title'] ); ?></h3>
                    <p class="mchem-niw-card__text"><?php echo esc_html( $svc['desc'] ); ?></p>
                </div>

                <!-- Bottom Row: EXPLORE SERVICE + Circular Arrow Button -->
                <div class="mchem-niw-card__footer">
                    <a
                        href="<?php echo mchem_get_whatsapp_url( 'Hi MChem Consultants! I would like to explore your ' . $svc['title'] . ' service.' ); ?>"
                        class="mchem-niw-card__link"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <span class="mchem-niw-card__link-text"><?php esc_html_e( 'EXPLORE SERVICE', 'mchemconsultants' ); ?></span>
                        <div class="mchem-niw-card__btn-circle">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                        </div>
                    </a>
                </div>

                <!-- Glow overlay -->
                <span class="mchem-niw-card__glow" aria-hidden="true"></span>
            </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>
