<?php
/**
 * MChem Consultants - inc/helpers.php
 *
 * Utility/helper functions used across templates.
 * All functions are prefixed mchem_ to avoid collisions.
 *
 * @package mchemconsultants
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get the WhatsApp click-to-chat URL.
 *
 * @param string $custom_message Optional pre-filled message.
 * @return string Escaped WhatsApp URL.
 */
function mchem_get_whatsapp_url( $custom_message = '' ) {
    $number  = get_theme_mod( 'mchem_whatsapp_number', '923320386271' );
    $message = $custom_message ?: 'Hello MChem Consultants! I would like to inquire about your engineering consultancy services.';
    return esc_url( 'https://wa.me/' . rawurlencode( $number ) . '?text=' . rawurlencode( $message ) );
}

/**
 * Render an inline SVG Lucide icon.
 *
 * @param string $icon    Lucide icon slug (e.g. 'settings', 'shield', 'leaf').
 * @param string $classes Additional CSS classes.
 * @param string $size    Icon size in px.
 */
function mchem_icon( $icon, $classes = '', $size = '22' ) {

    $icons = array(
        'settings'       => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>',
        'shield'         => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
        'leaf'           => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
        'zap'            => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
        'factory'        => '<path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M17 18h1"/><path d="M12 18h1"/><path d="M7 18h1"/>',
        'graduation-cap' => '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>',
        'whatsapp'       => '<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.999 2.003c-5.514 0-9.997 4.483-9.997 9.997 0 1.762.46 3.414 1.268 4.849L2 22l5.236-1.37A9.954 9.954 0 0 0 12 21.997c5.514 0 9.997-4.483 9.997-9.997 0-5.515-4.483-9.997-9.998-9.997z"/>',
        'mail'           => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
        'phone'          => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.88 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.83 3h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 10.1A16 16 0 0 0 13.9 15.9l1.06-1.06a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
        'map-pin'        => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
        'clock'          => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
        'linkedin'       => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/>',
        'arrow-right'    => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'chevron-right'  => '<path d="m9 18 6-6-6-6"/>',
        'menu'           => '<line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/>',
        'x'              => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
        'check-circle'   => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>',
        'flask'          => '<path d="M9 3h6l1 9H8z"/><path d="M3 21h18"/><path d="M7.5 13.5c2.5 1 5 1 7 0"/>',
    );

    $path_data = isset( $icons[ $icon ] ) ? $icons[ $icon ] : $icons['settings'];
    $cls       = 'mchem-icon' . ( $classes ? ' ' . esc_attr( $classes ) : '' );

    printf(
        '<svg xmlns="http://www.w3.org/2000/svg" width="%1$s" height="%1$s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="%2$s" aria-hidden="true">%3$s</svg>',
        esc_attr( $size ),
        esc_attr( $cls ),
        $path_data
    );
}

/**
 * Get social media links from Customizer settings.
 */
function mchem_get_social_links() {
    $platforms = array( 'linkedin', 'facebook', 'instagram', 'youtube' );
    $links     = array();

    foreach ( $platforms as $platform ) {
        $url = get_theme_mod( "mchem_social_{$platform}", '' );
        if ( $url ) {
            $links[ $platform ] = esc_url( $url );
        }
    }

    return $links;
}

/**
 * Render the site logo with strict constraints.
 */
function mchem_the_logo( $classes = '' ) {
    $wrapper_class = 'mchem-logo' . ( $classes ? ' ' . esc_attr( $classes ) : '' );

    if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
        echo '<div class="' . esc_attr( $wrapper_class ) . '">';
        the_custom_logo();
        echo '</div>';
    } else {
        $logo_url = get_template_directory_uri() . '/assets/images/mchem-logo.png';
        echo '<div class="' . esc_attr( $wrapper_class ) . '">';
        echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
        echo '<img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="mchem-logo__img" width="160" height="48" loading="eager">';
        echo '</a>';
        echo '</div>';
    }
}

/**
 * Get expertise tags from pipe-separated meta value.
 */
function mchem_parse_expertise_tags( $raw ) {
    if ( empty( $raw ) ) return array();
    return array_map( 'trim', explode( '|', $raw ) );
}

/**
 * Default Services Array (fallback if database is empty).
 */
function mchem_get_default_services() {
    return array(
        array(
            'number'   => '01',
            'title'    => 'Process Simulation & Modeling',
            'desc'     => 'High-fidelity process simulation, thermodynamic modeling, debottlenecking, and performance analysis.',
            'software' => 'Simulation & Modeling',
            'icon'     => 'settings',
            'outcome'  => 'Up to 30% efficiency gains',
        ),
        array(
            'number'   => '02',
            'title'    => 'Sustainable Engineering Solutions',
            'desc'     => 'Waste-to-energy, resource efficiency, environmental assessment, and sustainable process solutions.',
            'software' => 'Waste-to-Energy',
            'icon'     => 'leaf',
            'outcome'  => 'Net-zero roadmaps',
        ),
        array(
            'number'   => '03',
            'title'    => 'Process Safety & Risk Management',
            'desc'     => 'HAZOP, risk assessment, safety studies, and process safety improvement solutions.',
            'software' => 'HAZOP / LOPA / FMEA',
            'icon'     => 'shield',
            'outcome'  => 'Regulatory compliance',
        ),
        array(
            'number'   => '04',
            'title'    => 'Plant Design & Engineering',
            'desc'     => 'Process plant design, process flow development, equipment sizing, layouts, and engineering documentation.',
            'software' => 'PFD / P&ID',
            'icon'     => 'factory',
            'outcome'  => 'Full DFD to P&ID',
        ),
        array(
            'number'   => '05',
            'title'    => 'Energy Recovery & Efficiency',
            'desc'     => 'Waste-heat recovery, energy integration, heat-exchanger network analysis, and process energy optimization.',
            'software' => 'Pinch Analysis',
            'icon'     => 'zap',
            'outcome'  => 'Proven energy savings',
        ),
        array(
            'number'   => '06',
            'title'    => 'Professional & Corporate Training',
            'desc'     => 'Industry-focused training and workshops in process safety, simulation, process engineering, energy efficiency, and sustainability.',
            'software' => 'Simulation & Safety',
            'icon'     => 'graduation-cap',
            'outcome'  => 'CPD-certified workshops',
        ),
    );
}

/**
 * Default Team Members Array (fallback if database is empty).
 */
function mchem_get_default_team() {
    return array(
        array(
            'name'      => 'Muhsin Ali',
            'role'      => 'Founder & Managing Director',
            'initials'  => 'MA',
            'bio'       => 'Leads the overall strategic direction and operations of MChem Consultants, with a focus on process engineering, industry engagement, project coordination, and business development.',
            'expertise' => array( 'Process Engineering', 'Operations Management', 'Industry Coordination' ),
            'featured'  => true,
            'linkedin'  => '',
            'email'     => 'mchemconsultants2@gmail.com',
        ),
        array(
            'name'      => 'Sardar Ali',
            'role'      => 'Co-Founder & Technical Director',
            'initials'  => 'SA',
            'bio'       => 'Leads the technical function of MChem Consultants, focusing on process simulation, process modelling, optimization, engineering calculations, and software-based engineering solutions.',
            'expertise' => array( 'Process Simulation', 'Technical Modeling', 'Digital Engineering' ),
            'featured'  => false,
            'linkedin'  => '',
            'email'     => '',
        ),
        array(
            'name'      => 'Muhammad Hassan',
            'role'      => 'Finance & Administration Lead',
            'initials'  => 'MH',
            'bio'       => 'Responsible for financial planning, project costing, budgeting, financial documentation, and administrative coordination to support sustainable business operations.',
            'expertise' => array( 'Financial Planning', 'Costing', 'Business Administration' ),
            'featured'  => false,
            'linkedin'  => '',
            'email'     => '',
        ),
        array(
            'name'      => 'Zuhaib Ali',
            'role'      => 'Business Development & Plant Design Lead',
            'initials'  => 'ZA',
            'bio'       => 'Leads marketing, client acquisition, business development, and brand promotion while contributing to plant design, engineering layouts, technical presentations, and design development.',
            'expertise' => array( 'Business Development', 'Marketing', 'Plant Design & Engineering' ),
            'featured'  => false,
            'linkedin'  => '',
            'email'     => '',
        ),
        array(
            'name'      => 'Muhammad Usman',
            'role'      => 'Technical & Project Engineer',
            'initials'  => 'MU',
            'bio'       => 'Supports technical projects through engineering analysis, technical documentation, project execution, and coordination with the engineering team.',
            'expertise' => array( 'Technical Support', 'Engineering Analysis', 'Project Execution' ),
            'featured'  => false,
            'linkedin'  => '',
            'email'     => '',
        ),
    );
}