<?php
/**
 * MChem Consultants - template-parts/sections/team.php
 *
 * Leadership Team Section matching NIW layout:
 * - Split Header with [LEADERSHIP & TEAM] pill + Carousel navigation buttons (← / →)
 * - Elevated Team Cards with top overlapping squircle avatar badge, category, serif name, title, bio, and MChem Team footer.
 *
 * @package mchemconsultants
 */

$team_members = array(
    array(
        'num'      => '01',
        'initials' => 'MA',
        'category' => 'EXECUTIVE LEADERSHIP',
        'name'     => 'Muhsin Ali',
        'role'     => 'Founder & Managing Director',
        'bio'      => 'Oversees strategic consultancy vision, industrial client coordination, process optimization workflows, and executive university-industry partnerships.',
        'gradient' => 'linear-gradient(135deg, #38BDF8 0%, #0284C7 100%)',
    ),
    array(
        'num'      => '02',
        'initials' => 'SA',
        'category' => 'TECHNICAL DIRECTION',
        'name'     => 'Sardar Ali',
        'role'     => 'Co-Founder & Technical Director',
        'bio'      => 'Leads process simulation and modeling architectures, thermodynamic modeling, equipment sizing, and technical QA across all engineering deliverables.',
        'gradient' => 'linear-gradient(135deg, #0EA5A0 0%, #065F5C 100%)',
        'active'   => true, // Center highlighted card in view
    ),
    array(
        'num'      => '03',
        'initials' => 'MH',
        'category' => 'FINANCE & ADMINISTRATION',
        'name'     => 'Muhammad Hassan',
        'role'     => 'Finance & Administration Lead',
        'bio'      => 'Directs commercial strategy, project costing, financial feasibility assessments, corporate governance, and operational resource planning.',
        'gradient' => 'linear-gradient(135deg, #C9982A 0%, #855E10 100%)',
    ),
    array(
        'num'      => '04',
        'initials' => 'ZA',
        'category' => 'BUSINESS DEVELOPMENT & DESIGN',
        'name'     => 'Zuhaib Ali',
        'role'     => 'Business Development & Plant Design Lead',
        'bio'      => 'Drives commercial partnerships, industrial market expansion, and chemical plant layout engineering including PFD and P&ID drafting.',
        'gradient' => 'linear-gradient(135deg, #38BDF8 0%, #1E3A8A 100%)',
    ),
    array(
        'num'      => '05',
        'initials' => 'MU',
        'category' => 'PROJECT ENGINEERING',
        'name'     => 'Muhammad Usman',
        'role'     => 'Technical & Project Engineer',
        'bio'      => 'Specializes in on-site engineering analysis, process safety studies, data validation, and coordinated project execution across client manufacturing sites.',
        'gradient' => 'linear-gradient(135deg, #6366F1 0%, #312E81 100%)',
    ),
);

// If WordPress CPT has team members, enrich with dynamic data
$team_query = new WP_Query( array(
    'post_type'      => 'mchem_team',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

if ( $team_query->have_posts() ) {
    $cpt_team = array();
    $i = 1;
    while ( $team_query->have_posts() ) {
        $team_query->the_post();
        $name = get_the_title();
        $words = explode( ' ', trim( $name ) );
        $initials = '';
        foreach ( $words as $w ) {
            if ( ! empty( $w ) ) { $initials .= strtoupper( $w[0] ); }
        }
        $initials = substr( $initials, 0, 2 );

        $cpt_team[] = array(
            'num'      => sprintf( '%02d', $i ),
            'initials' => $initials ?: 'MC',
            'category' => strtoupper( get_post_meta( get_the_ID(), 'mchem_team_dept', true ) ?: 'ENGINEERING LEADERSHIP' ),
            'name'     => $name,
            'role'     => get_post_meta( get_the_ID(), 'mchem_team_role', true ) ?: 'Engineering Consultant',
            'bio'      => get_the_content() ?: get_the_excerpt(),
            'photo'    => get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ?: '',
            'gradient' => 'linear-gradient(135deg, #38BDF8 0%, #0284C7 100%)',
        );
        $i++;
    }
    wp_reset_postdata();
    if ( ! empty( $cpt_team ) ) {
        $team_members = $cpt_team;
    }
}
?>

<!-- ============================================================
     LEADERSHIP TEAM SECTION (NIW Matching)
     ============================================================ -->
<section id="team" class="mchem-team-section" aria-labelledby="mchem-team-heading">
    <div class="mchem-container">

        <!-- Split Header with Carousel Nav Arrows (Matches Screenshot 1) -->
        <div class="mchem-team-header" data-animate="fade-up">
            <div class="mchem-team-header__left">
                <div class="mchem-team-header__pill">
                    <span><?php esc_html_e( 'THE PEOPLE BEHIND MCHEM', 'mchemconsultants' ); ?></span>
                </div>
                <h2 id="mchem-team-heading" class="mchem-team-header__title">
                    The people building<br>
                    <span class="mchem-team-header__highlight"><?php esc_html_e( 'what comes next.', 'mchemconsultants' ); ?></span>
                </h2>
                <p class="mchem-team-header__sub">
                    <?php esc_html_e( 'Leadership, engineering, process simulation, plant design, safety auditing, and financial management under one dedicated team.', 'mchemconsultants' ); ?>
                </p>
            </div>

            <!-- Top-Right Carousel Navigation Arrows (Matches Screenshot 1 Right) -->
            <div class="mchem-team-header__nav">
                <button type="button" class="mchem-team-arrow mchem-team-arrow--prev" id="mchem-team-prev" aria-label="<?php esc_attr_e( 'Previous team member', 'mchemconsultants' ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" class="mchem-team-arrow mchem-team-arrow--next" id="mchem-team-next" aria-label="<?php esc_attr_e( 'Next team member', 'mchemconsultants' ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <!-- Carousel Track / Horizontal Scroll Grid (Matches Screenshot 2) -->
        <div class="mchem-team-carousel-wrap">
            <div class="mchem-team-carousel" id="mchem-team-track" role="list">
                <?php foreach ( $team_members as $member ) : ?>
                <article class="mchem-team-card<?php echo ! empty( $member['active'] ) ? ' is-active' : ''; ?>" role="listitem">

                    <!-- Concentric arc lines -->
                    <div class="mchem-team-card__arcs" aria-hidden="true">
                        <span class="mchem-team-card__arc"></span>
                    </div>

                    <!-- Top Overlapping Squircle Avatar Badge (Matches Screenshot 2) -->
                    <div class="mchem-team-card__avatar-wrap">
                        <div class="mchem-team-card__avatar" style="<?php echo ! empty( $member['photo'] ) ? 'background-image:url(' . esc_url( $member['photo'] ) . ');background-size:cover;' : 'background:' . esc_attr( $member['gradient'] ) . ';'; ?>">
                            <?php if ( empty( $member['photo'] ) ) : ?>
                            <span class="mchem-team-card__initials"><?php echo esc_html( $member['initials'] ); ?></span>
                            <?php endif; ?>
                            <div class="mchem-team-card__avatar-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect width="8" height="8" x="3" y="3" rx="2"/><path d="M7 13h10a2 2 0 0 1 2 2v6"/><rect width="8" height="8" x="13" y="13" rx="2"/></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="mchem-team-card__body">
                        <div class="mchem-team-card__meta">
                            <span class="mchem-team-card__category"><?php echo esc_html( $member['category'] ); ?></span>
                            <span class="mchem-team-card__num"><?php echo esc_html( $member['num'] ); ?></span>
                        </div>

                        <h3 class="mchem-team-card__name"><?php echo esc_html( $member['name'] ); ?></h3>
                        <p class="mchem-team-card__role"><?php echo esc_html( $member['role'] ); ?></p>
                        <p class="mchem-team-card__bio"><?php echo esc_html( $member['bio'] ); ?></p>
                    </div>

                    <!-- Card Footer: MCHEM TEAM badge + WhatsApp & Email Connect -->
                    <div class="mchem-team-card__footer" style="display:flex;align-items:center;justify-content:space-between;">
                        <a
                            href="<?php echo mchem_get_whatsapp_url( 'Hi MChem! I would like to connect with ' . $member['name'] . ' (' . $member['role'] . ').' ); ?>"
                            class="mchem-team-card__link"
                            target="_blank"
                            rel="noopener noreferrer"
                            title="<?php esc_attr_e( 'Connect on WhatsApp', 'mchemconsultants' ); ?>"
                        >
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect width="8" height="8" x="3" y="3" rx="2"/><path d="M7 13h10a2 2 0 0 1 2 2v6"/><rect width="8" height="8" x="13" y="13" rx="2"/></svg>
                            <span><?php esc_html_e( 'MCHEM TEAM', 'mchemconsultants' ); ?></span>
                        </a>
                        <a
                            href="mailto:<?php echo esc_attr( get_theme_mod( 'mchem_contact_email', 'mchemconsultants2@gmail.com' ) ); ?>?subject=<?php echo rawurlencode( 'Inquiry for ' . $member['name'] . ' (' . $member['role'] . ')' ); ?>"
                            class="mchem-team-card__email-btn"
                            title="<?php esc_attr_e( 'Email MChem', 'mchemconsultants' ); ?>"
                            style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:50%;background:var(--mchem-bg-elevated);border:1px solid var(--mchem-border);color:var(--mchem-primary-blue);text-decoration:none;transition:all 0.2s ease;"
                        >
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </a>
                    </div>

                </article>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
