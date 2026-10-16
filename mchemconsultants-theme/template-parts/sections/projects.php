<?php
/**
 * MChem Consultants - template-parts/sections/projects.php
 *
 * Featured Projects & Engineering Case Studies Section.
 * Matches NIW's split layout: Project narrative on left, schematic visual dashboard on right.
 *
 * @package mchemconsultants
 */

$project_query = new WP_Query( array(
    'post_type'      => 'mchem_project',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
) );

$cpt_projects = array();
if ( $project_query->have_posts() ) {
    $p_idx = 1;
    while ( $project_query->have_posts() ) {
        $project_query->the_post();
        $cpt_projects[] = array(
            'num'         => 'Project 0' . $p_idx,
            'category'    => get_post_meta( get_the_ID(), 'mchem_project_category', true ) ?: 'ENGINEERING CASE STUDY',
            'title'       => get_the_title(),
            'desc'        => get_the_excerpt() ?: wp_trim_words( get_the_content(), 28 ),
            'tags'        => get_post_meta( get_the_ID(), 'mchem_project_tags', true ) ? explode( ',', get_post_meta( get_the_ID(), 'mchem_project_tags', true ) ) : array( 'Engineering', 'Simulation', 'Optimization' ),
            'features'    => array(
                array(
                    'title' => get_post_meta( get_the_ID(), 'mchem_feat_1_title', true ) ?: 'Verified engineering design',
                    'desc'  => get_post_meta( get_the_ID(), 'mchem_feat_1_desc', true ) ?: 'Detailed calculations and rigorous industrial modeling.',
                ),
                array(
                    'title' => get_post_meta( get_the_ID(), 'mchem_feat_2_title', true ) ?: 'Measurable performance gain',
                    'desc'  => get_post_meta( get_the_ID(), 'mchem_feat_2_desc', true ) ?: 'Enhanced operational throughput and safety compliance.',
                ),
            ),
            'metric_main' => get_post_meta( get_the_ID(), 'mchem_metric_main', true ) ?: 'Measurable operational results delivered',
            'stats'       => array(
                'Status'     => 'Completed',
                'Client'     => get_post_meta( get_the_ID(), 'mchem_project_client', true ) ?: 'Industrial Client',
                'Sector'     => get_post_meta( get_the_ID(), 'mchem_project_sector', true ) ?: 'Chemical & Process',
            ),
        );
        $p_idx++;
    }
    wp_reset_postdata();
}

$default_projects = array(
    array(
        'num'         => 'Project 01',
        'category'    => 'PROCESS SIMULATION & OPTIMIZATION',
        'title'       => 'Crude Distillation Debottlenecking & Process Simulation Modeling',
        'desc'        => 'A comprehensive high-fidelity simulation and modeling framework developed to eliminate column flooding, optimize reflux ratios, and integrate crude preheat train heat exchangers.',
        'tags'        => array( 'Process Simulation', 'Thermodynamic Modeling', 'Pinch Integration', 'Debottlenecking' ),
        'features'    => array(
            array(
                'title' => 'Optimizes unit operations & feed preheating',
                'desc'  => 'Accurately models vapor-liquid equilibrium and tray hydraulics to increase column throughput by 22% without major capital expenditure.',
            ),
            array(
                'title' => 'Eliminates thermal bottlenecks across preheat train',
                'desc'  => 'Recovers waste heat from pumparounds and heavy distillate streams to significantly reduce furnace fuel consumption.',
            ),
            array(
                'title' => 'Delivers 28% reduction in thermal energy OPEX',
                'desc'  => 'Maintains strict product fractionation specifications while achieving measurable steam and fuel savings.',
            ),
        ),
        'metric_main' => 'Reduces thermal energy consumption by 28%',
        'stats'       => array(
            'Throughput Gain' => '+22%',
            'Energy Saved'    => '28%',
            'Simulated Cap'   => '5,000 bbl/d',
        ),
    ),
    array(
        'num'         => 'Project 02',
        'category'    => 'PROCESS SAFETY & RISK MANAGEMENT',
        'title'       => 'Comprehensive HAZOP & Safety Integrity Level (SIL) Assessment',
        'desc'        => 'A full-scope hazard and operability study (HAZOP) and Layer of Protection Analysis (LOPA) conducted for a chemical processing plant to verify relief systems and automated interlocks.',
        'tags'        => array( 'HAZOP Study', 'LOPA Analysis', 'Risk Mitigation', 'SIL Verification' ),
        'features'    => array(
            array(
                'title' => 'Systematic node-by-node deviation analysis',
                'desc'  => 'Identifies high-risk process scenarios across pressure, temperature, flow, and level deviations under abnormal operating conditions.',
            ),
            array(
                'title' => 'Calibrates independent protection layers (IPLs)',
                'desc'  => 'Applies LOPA methodology to determine target Safety Integrity Levels (SIL 1/2) and eliminate single points of failure.',
            ),
            array(
                'title' => '100% regulatory compliance & risk mitigation',
                'desc'  => 'Delivers prioritized risk reduction recommendations, emergency relief valve calculations, and updated safety documentation.',
            ),
        ),
        'metric_main' => '100% Regulatory compliance & risk mitigation',
        'stats'       => array(
            'Nodes Analyzed'  => '48 Nodes',
            'Risk Reduction'  => 'High Impact',
            'Safety Rating'   => 'Zero Incidents',
        ),
    ),
    array(
        'num'         => 'Project 03',
        'category'    => 'SUSTAINABLE ENGINEERING & PLANT DESIGN',
        'title'       => 'Biomass Gasification & Waste-to-Energy Process Design',
        'desc'        => 'Detailed chemical process engineering for converting agricultural waste into synthesis gas and renewable thermal power, including comprehensive PFD, P&ID, and reactor sizing.',
        'tags'        => array( 'Waste-to-Energy', 'PFD / P&ID', 'Reactor Sizing', 'Circular Economy' ),
        'features'    => array(
            array(
                'title' => 'Thermochemical gasification reactor modeling',
                'desc'  => 'Optimizes equivalence ratio and temperature profiles to maximize syngas calorific value while minimizing tar formation.',
            ),
            array(
                'title' => 'Complete engineering deliverables package',
                'desc'  => 'Produces professional PFDs, P&IDs, equipment specifications, and mass-energy balance sheets ready for fabricator procurement.',
            ),
            array(
                'title' => 'Clean renewable power with high ROI',
                'desc'  => 'Replaces fossil fuels with agricultural residue to create a high-yield, net-zero industrial energy stream.',
            ),
        ),
        'metric_main' => 'Generates 3.5 MW renewable thermal power',
        'stats'       => array(
            'Power Output'    => '3.5 MWth',
            'Carbon Offset'   => '-1,800 t/yr',
            'Feedstock Use'   => '100% Waste',
        ),
    ),
);

$projects = ! empty( $cpt_projects ) ? $cpt_projects : $default_projects;
?>

<!-- ============================================================
     OUR PROJECTS SECTION (NIW Matching)
     ============================================================ -->
<section id="projects" class="mchem-projects-section" aria-labelledby="mchem-projects-heading">
    <div class="mchem-container">

        <!-- Split Section Header (Matches Screenshot 1) -->
        <div class="mchem-projects-header" data-animate="fade-up">
            <div class="mchem-projects-header__pill">
                <span><?php esc_html_e( 'OUR PROJECTS', 'mchemconsultants' ); ?></span>
            </div>
            <h2 id="mchem-projects-heading" class="mchem-projects-header__title">
                Engineering built<br>
                <span class="mchem-projects-header__highlight"><?php esc_html_e( 'around real operations.', 'mchemconsultants' ); ?></span>
            </h2>
            <p class="mchem-projects-header__sub">
                <?php esc_html_e( 'Selected MChem engineering case studies spanning process simulation, chemical plant design, HAZOP safety studies, waste-to-energy conversion, and industrial energy optimization.', 'mchemconsultants' ); ?>
            </p>
        </div>

        <!-- Project Cards Stack (Matches Screenshots 2 & 3) -->
        <div class="mchem-projects-stack">
            <?php foreach ( $projects as $idx => $proj ) : ?>
            <article class="mchem-project-panel" data-animate="fade-up" data-delay="<?php echo esc_attr( $idx * 100 ); ?>">
                <div class="mchem-project-panel__grid">

                    <!-- Left Column: Narrative, Category, Tags, Interactive Points -->
                    <div class="mchem-project-panel__narrative">

                        <!-- Top row -->
                        <div class="mchem-project-panel__top">
                            <span class="mchem-project-panel__category"><?php echo esc_html( $proj['category'] ); ?></span>
                            <span class="mchem-project-panel__num"><?php echo esc_html( $proj['num'] ); ?></span>
                        </div>

                        <!-- Title & Overview -->
                        <h3 class="mchem-project-panel__title"><?php echo esc_html( $proj['title'] ); ?></h3>
                        <p class="mchem-project-panel__desc"><?php echo esc_html( $proj['desc'] ); ?></p>

                        <!-- Tech/Tool Tags -->
                        <div class="mchem-project-panel__tags">
                            <?php foreach ( $proj['tags'] as $tag ) : ?>
                            <span class="mchem-project-panel__tag"><?php echo esc_html( $tag ); ?></span>
                            <?php endforeach; ?>
                        </div>

                        <!-- Feature Accordion Points -->
                        <div class="mchem-project-panel__features">
                            <?php foreach ( $proj['features'] as $fIdx => $feat ) : ?>
                            <details class="mchem-project-panel__accordion" <?php echo ( $fIdx === 0 ) ? 'open' : ''; ?>>
                                <summary class="mchem-project-panel__summary">
                                    <span><?php echo esc_html( $feat['title'] ); ?></span>
                                    <svg class="mchem-project-panel__chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
                                </summary>
                                <div class="mchem-project-panel__details">
                                    <p><?php echo esc_html( $feat['desc'] ); ?></p>
                                </div>
                            </details>
                            <?php endforeach; ?>
                        </div>

                        <!-- Bottom Delivery Badge -->
                        <div class="mchem-project-panel__delivery">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                            <span><?php esc_html_e( 'INTEGRATED MCHEM DELIVERY', 'mchemconsultants' ); ?></span>
                        </div>

                    </div>

                    <!-- Right Column: Visual Schematic Dashboard (Matches Screenshot 2 & 3 Right Side) -->
                    <div class="mchem-project-panel__visual">
                        <div class="mchem-project-dash">

                            <!-- Dashboard Main Header -->
                            <div class="mchem-project-dash__header">
                                <h4 class="mchem-project-dash__title"><?php echo esc_html( $proj['metric_main'] ); ?></h4>
                                <div class="mchem-project-dash__pulse-line"></div>
                            </div>

                            <!-- Dashboard Sub-Cards Grid -->
                            <div class="mchem-project-dash__grid">

                                <!-- Card A: Structured Alerts / Stream Monitoring -->
                                <div class="mchem-project-dash__card">
                                    <span class="mchem-project-dash__card-label"><?php esc_html_e( 'PROCESS PARAMETERS', 'mchemconsultants' ); ?></span>
                                    <div class="mchem-project-dash__lines">
                                        <div class="mchem-project-dash__line"><span class="mchem-project-dash__dot mchem-project-dash__dot--gold"></span><span class="mchem-project-dash__bar mchem-project-dash__bar--long"></span></div>
                                        <div class="mchem-project-dash__line"><span class="mchem-project-dash__dot mchem-project-dash__dot--cyan"></span><span class="mchem-project-dash__bar mchem-project-dash__bar--mid"></span></div>
                                        <div class="mchem-project-dash__line"><span class="mchem-project-dash__dot mchem-project-dash__dot--cyan"></span><span class="mchem-project-dash__bar mchem-project-dash__bar--short"></span></div>
                                    </div>
                                </div>

                                <!-- Card B: Location / PFD Context Map -->
                                <div class="mchem-project-dash__card">
                                    <span class="mchem-project-dash__card-label"><?php esc_html_e( 'UNIT INTEGRATION', 'mchemconsultants' ); ?></span>
                                    <div class="mchem-project-dash__map">
                                        <div class="mchem-project-dash__map-grid"></div>
                                        <div class="mchem-project-dash__pin">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#38BDF8" stroke="currentColor" stroke-width="1.5"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3" fill="#06101F"/></svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card C: Timeline / Node History -->
                                <div class="mchem-project-dash__card">
                                    <span class="mchem-project-dash__card-label"><?php esc_html_e( 'CYCLE HISTORY', 'mchemconsultants' ); ?></span>
                                    <div class="mchem-project-dash__timeline">
                                        <div class="mchem-project-dash__timeline-line"></div>
                                        <span class="mchem-project-dash__t-dot"></span>
                                        <span class="mchem-project-dash__t-dot"></span>
                                        <span class="mchem-project-dash__t-dot mchem-project-dash__t-dot--active"></span>
                                        <span class="mchem-project-dash__t-dot"></span>
                                    </div>
                                </div>

                                <!-- Card D: Performance Reporting Bars -->
                                <div class="mchem-project-dash__card">
                                    <span class="mchem-project-dash__card-label"><?php esc_html_e( 'PERFORMANCE GAINS', 'mchemconsultants' ); ?></span>
                                    <div class="mchem-project-dash__bars">
                                        <span class="mchem-project-dash__col" style="height: 45%;"></span>
                                        <span class="mchem-project-dash__col" style="height: 60%;"></span>
                                        <span class="mchem-project-dash__col" style="height: 40%;"></span>
                                        <span class="mchem-project-dash__col mchem-project-dash__col--gold" style="height: 95%;"></span>
                                        <span class="mchem-project-dash__col" style="height: 75%;"></span>
                                    </div>
                                </div>

                            </div>

                            <!-- Bottom Summary Stats Strip -->
                            <div class="mchem-project-dash__footer">
                                <p class="mchem-project-dash__footer-text">
                                    <?php esc_html_e( 'Provides rigorous simulation models, verified safety nodes, and verified engineering blueprints so industrial teams operate with higher yield and lower risk.', 'mchemconsultants' ); ?>
                                </p>
                                <div class="mchem-project-dash__stats-row">
                                    <?php foreach ( $proj['stats'] as $sLbl => $sVal ) : ?>
                                    <div class="mchem-project-dash__stat">
                                        <span class="mchem-project-dash__stat-val"><?php echo esc_html( $sVal ); ?></span>
                                        <span class="mchem-project-dash__stat-lbl"><?php echo esc_html( $sLbl ); ?></span>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <!-- More Projects Notice -->
        <div class="mchem-projects-more" data-animate="fade-up">
            <div class="mchem-projects-more__line"></div>
            <p class="mchem-projects-more__text">
                <?php echo wp_kses(
                    sprintf(
                        /* translators: %s is the link to booking section */
                        __( 'These are just a few of our completed projects. MChem Consultants has delivered <strong>15+ engineering solutions</strong> across process simulation, safety studies, plant design, and energy optimization. <a href="#booking">Contact us</a> to discuss your project.', 'mchemconsultants' ),
                        '#booking'
                    ),
                    array( 'strong' => array(), 'a' => array( 'href' => array() ) )
                ); ?>
            </p>
        </div>

    </div>
</section>
