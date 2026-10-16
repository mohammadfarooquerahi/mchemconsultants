<?php
/**
 * MChem Consultants - inc/custom-post-types.php
 *
 * Registers custom post types:
 *  - mchem_service : The 6 core engineering services
 *  - mchem_team    : Team member profiles
 *
 * @package mchemconsultants
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'mchem_register_post_types' );
function mchem_register_post_types() {

    // ── CPT: Services ─────────────────────────────────────────────────────────
    register_post_type( 'mchem_service', array(
        'labels' => array(
            'name'               => esc_html__( 'Services',           'mchemconsultants' ),
            'singular_name'      => esc_html__( 'Service',            'mchemconsultants' ),
            'add_new_item'       => esc_html__( 'Add New Service',    'mchemconsultants' ),
            'edit_item'          => esc_html__( 'Edit Service',       'mchemconsultants' ),
            'menu_name'          => esc_html__( 'Services',           'mchemconsultants' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'show_in_rest'       => true,   // Enables Gutenberg + REST API
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'menu_icon'          => 'dashicons-admin-tools',
        'menu_position'      => 5,
        'rewrite'            => array( 'slug' => 'services' ),
    ) );

    // ── CPT: Team Members ─────────────────────────────────────────────────────
    register_post_type( 'mchem_team', array(
        'labels' => array(
            'name'               => esc_html__( 'Team Members',       'mchemconsultants' ),
            'singular_name'      => esc_html__( 'Team Member',        'mchemconsultants' ),
            'add_new_item'       => esc_html__( 'Add Team Member',    'mchemconsultants' ),
            'edit_item'          => esc_html__( 'Edit Team Member',   'mchemconsultants' ),
            'menu_name'          => esc_html__( 'Team',               'mchemconsultants' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'menu_icon'          => 'dashicons-groups',
        'menu_position'      => 6,
        'rewrite'            => array( 'slug' => 'team' ),
    ) );

    // ── CPT: Gallery (Photos & Videos) ────────────────────────────────────────
    register_post_type( 'mchem_gallery', array(
        'labels' => array(
            'name'               => esc_html__( 'Gallery',             'mchemconsultants' ),
            'singular_name'      => esc_html__( 'Gallery Item',        'mchemconsultants' ),
            'add_new_item'       => esc_html__( 'Add Gallery Item',    'mchemconsultants' ),
            'edit_item'          => esc_html__( 'Edit Gallery Item',   'mchemconsultants' ),
            'menu_name'          => esc_html__( 'Gallery',             'mchemconsultants' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'thumbnail', 'custom-fields', 'page-attributes' ),
        'menu_icon'          => 'dashicons-format-gallery',
        'menu_position'      => 7,
        'rewrite'            => array( 'slug' => 'gallery' ),
    ) );

    // ── CPT: Projects & Case Studies ──────────────────────────────────────────
    register_post_type( 'mchem_project', array(
        'labels' => array(
            'name'               => esc_html__( 'Projects',            'mchemconsultants' ),
            'singular_name'      => esc_html__( 'Project',             'mchemconsultants' ),
            'add_new_item'       => esc_html__( 'Add New Project',     'mchemconsultants' ),
            'edit_item'          => esc_html__( 'Edit Project',        'mchemconsultants' ),
            'menu_name'          => esc_html__( 'Projects',            'mchemconsultants' ),
        ),
        'public'             => true,
        'has_archive'        => true,
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
        'menu_icon'          => 'dashicons-portfolio',
        'menu_position'      => 8,
        'rewrite'            => array( 'slug' => 'projects' ),
    ) );

    // ── CPT: Client Reviews & Testimonials ────────────────────────────────────
    register_post_type( 'mchem_review', array(
        'labels' => array(
            'name'               => esc_html__( 'Client Reviews',      'mchemconsultants' ),
            'singular_name'      => esc_html__( 'Review',              'mchemconsultants' ),
            'add_new_item'       => esc_html__( 'Add New Review',      'mchemconsultants' ),
            'edit_item'          => esc_html__( 'Edit Review',         'mchemconsultants' ),
            'menu_name'          => esc_html__( 'Reviews',             'mchemconsultants' ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
        'menu_icon'          => 'dashicons-testimonial',
        'menu_position'      => 9,
        'rewrite'            => array( 'slug' => 'reviews' ),
    ) );
}

/**
 * Populate default Services data on theme activation if no services exist.
 * Runs only once via a theme option flag.
 */
add_action( 'after_switch_theme', 'mchem_seed_default_data' );
function mchem_seed_default_data() {

    // Prevent double-seeding
    if ( get_option( 'mchem_data_seeded' ) ) {
        return;
    }

    // ── Default Services ──────────────────────────────────────────────────────
    $services = array(
        array(
            'title'   => 'Process Simulation & Modeling',
            'excerpt' => 'Process simulation and modeling, process optimization, thermodynamic modeling, and performance analysis.',
            'meta'    => array(
                'mchem_service_number'   => '01',
                'mchem_service_software' => 'Simulation & Modeling',
                'mchem_service_icon'     => 'settings',
                'mchem_service_outcome'  => 'Up to 30% efficiency gains',
            ),
        ),
        array(
            'title'   => 'Sustainable Engineering Solutions',
            'excerpt' => 'Waste-to-energy, resource efficiency, environmental assessment, and sustainable process solutions.',
            'meta'    => array(
                'mchem_service_number'  => '02',
                'mchem_service_icon'    => 'leaf',
                'mchem_service_outcome' => 'Net-zero roadmaps',
            ),
        ),
        array(
            'title'   => 'Process Safety & Risk Management',
            'excerpt' => 'HAZOP, risk assessment, safety studies, and process safety improvement solutions.',
            'meta'    => array(
                'mchem_service_number'   => '03',
                'mchem_service_software' => 'HAZOP / LOPA / FMEA',
                'mchem_service_icon'     => 'shield',
                'mchem_service_outcome'  => 'Regulatory compliance',
            ),
        ),
        array(
            'title'   => 'Plant Design & Engineering',
            'excerpt' => 'Process plant design, PFD/P&ID development, equipment sizing, layouts, and engineering documentation.',
            'meta'    => array(
                'mchem_service_number'  => '04',
                'mchem_service_icon'    => 'factory',
                'mchem_service_outcome' => 'Full DFD to P&ID',
            ),
        ),
        array(
            'title'   => 'Energy Recovery & Efficiency',
            'excerpt' => 'Waste-heat recovery, energy integration, heat-exchanger network analysis, and process energy optimization.',
            'meta'    => array(
                'mchem_service_number'  => '05',
                'mchem_service_icon'    => 'zap',
                'mchem_service_outcome' => 'Proven energy savings',
            ),
        ),
        array(
            'title'   => 'Professional & Corporate Training',
            'excerpt' => 'Industry-focused training and workshops in process safety, simulation, process engineering, energy efficiency, and sustainability.',
            'meta'    => array(
                'mchem_service_number'  => '06',
                'mchem_service_icon'    => 'graduation-cap',
                'mchem_service_outcome' => 'CPD-certified workshops',
            ),
        ),
    );

    foreach ( $services as $order => $svc ) {
        if ( ! get_page_by_title( $svc['title'], OBJECT, 'mchem_service' ) ) {
            $post_id = wp_insert_post( array(
                'post_type'    => 'mchem_service',
                'post_title'   => $svc['title'],
                'post_excerpt' => $svc['excerpt'],
                'post_content' => $svc['excerpt'],
                'post_status'  => 'publish',
                'menu_order'   => $order + 1,
            ) );
            if ( $post_id && ! is_wp_error( $post_id ) ) {
                foreach ( $svc['meta'] as $key => $value ) {
                    update_post_meta( $post_id, $key, sanitize_text_field( $value ) );
                }
            }
        }
    }

    // ── Default Team Members ──────────────────────────────────────────────────
    $team = array(
        array(
            'title'   => 'Muhsin Ali',
            'excerpt' => 'Leads the overall strategic direction and operations of MChem Consultants, with a focus on process engineering, industry engagement, project coordination, and business development.',
            'meta'    => array(
                'mchem_team_role'       => 'Founder & Managing Director',
                'mchem_team_expertise'  => 'Process Engineering | Operations Management | Industry Coordination',
                'mchem_team_order'      => '1',
            ),
        ),
        array(
            'title'   => 'Sardar Ali',
            'excerpt' => 'Leads the technical function of MChem Consultants, focusing on process simulation, modelling, optimization, engineering calculations, and software-based engineering solutions.',
            'meta'    => array(
                'mchem_team_role'       => 'Co-Founder & Technical Director',
                'mchem_team_expertise'  => 'Process Simulation | Technical Modeling | Digital Engineering',
                'mchem_team_order'      => '2',
            ),
        ),
        array(
            'title'   => 'Muhammad Hassan',
            'excerpt' => 'Responsible for financial planning, project costing, budgeting, financial documentation, and administrative coordination to support sustainable business operations.',
            'meta'    => array(
                'mchem_team_role'       => 'Finance & Administration Lead',
                'mchem_team_expertise'  => 'Financial Planning | Costing | Business Administration',
                'mchem_team_order'      => '3',
            ),
        ),
        array(
            'title'   => 'Zuhaib Ali',
            'excerpt' => 'Leads marketing, client acquisition, business development, and brand promotion while contributing to plant design, engineering layouts, technical presentations, and design development.',
            'meta'    => array(
                'mchem_team_role'       => 'Business Development & Plant Design Lead',
                'mchem_team_expertise'  => 'Business Development | Marketing | Plant Design & Engineering',
                'mchem_team_order'      => '4',
            ),
        ),
        array(
            'title'   => 'Muhammad Usman',
            'excerpt' => 'Supports technical projects through engineering analysis, technical documentation, project execution, and coordination with the engineering team.',
            'meta'    => array(
                'mchem_team_role'       => 'Technical & Project Engineer',
                'mchem_team_expertise'  => 'Technical Support | Engineering Analysis | Project Execution',
                'mchem_team_order'      => '5',
            ),
        ),
    );

    foreach ( $team as $member ) {
        if ( ! get_page_by_title( $member['title'], OBJECT, 'mchem_team' ) ) {
            $post_id = wp_insert_post( array(
                'post_type'    => 'mchem_team',
                'post_title'   => $member['title'],
                'post_excerpt' => $member['excerpt'],
                'post_content' => $member['excerpt'],
                'post_status'  => 'publish',
                'menu_order'   => (int) $member['meta']['mchem_team_order'],
            ) );
            if ( $post_id && ! is_wp_error( $post_id ) ) {
                foreach ( $member['meta'] as $key => $value ) {
                    update_post_meta( $post_id, $key, sanitize_text_field( $value ) );
                }
            }
        }
    }

    // Mark as seeded
    update_option( 'mchem_data_seeded', true );
}