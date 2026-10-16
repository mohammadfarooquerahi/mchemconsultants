<?php
/**
 * MChem Consultants - inc/acf-fields.php
 *
 * Programmatically registers ACF field groups for Services and Team CPTs.
 * Fallback: if ACF is not active, meta boxes are registered via native WP.
 *
 * @package mchemconsultants
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register ACF field groups only if ACF plugin is active.
 * This keeps the theme self-documenting even without ACF installed.
 */
add_action( 'acf/init', 'mchem_register_acf_fields' );
function mchem_register_acf_fields() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // ── Service Fields ─────────────────────────────────────────────────────────
    acf_add_local_field_group( array(
        'key'      => 'group_mchem_service',
        'title'    => 'Service Details',
        'fields'   => array(
            array(
                'key'           => 'field_service_number',
                'label'         => 'Service Number (e.g. 01)',
                'name'          => 'mchem_service_number',
                'type'          => 'text',
                'instructions'  => 'Displayed as the large decorative number on the service card.',
            ),
            array(
                'key'           => 'field_service_icon',
                'label'         => 'Icon Name (Lucide icon slug)',
                'name'          => 'mchem_service_icon',
                'type'          => 'text',
                'instructions'  => 'Use any Lucide icon name: settings, shield, leaf, zap, factory, graduation-cap',
                'default_value' => 'settings',
            ),
            array(
                'key'           => 'field_service_software',
                'label'         => 'Software / Tools Badge (optional)',
                'name'          => 'mchem_service_software',
                'type'          => 'text',
                'instructions'  => 'e.g. "Simulation & Modeling" — shown as a badge on the card.',
            ),
            array(
                'key'           => 'field_service_outcome',
                'label'         => 'Key Outcome / Right-side Metric',
                'name'          => 'mchem_service_outcome',
                'type'          => 'text',
                'instructions'  => 'Short impact phrase shown on the card right edge (e.g. "Up to 30% efficiency gains").',
            ),
            array(
                'key'           => 'field_service_full_desc',
                'label'         => 'Full Service Description (for service detail page)',
                'name'          => 'mchem_service_full_desc',
                'type'          => 'textarea',
                'rows'          => 5,
            ),
        ),
        'location' => array( array( array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'mchem_service',
        ) ) ),
        'menu_order' => 0,
        'style'      => 'seamless',
    ) );

    // ── Team Member Fields ─────────────────────────────────────────────────────
    acf_add_local_field_group( array(
        'key'    => 'group_mchem_team',
        'title'  => 'Team Member Details',
        'fields' => array(
            array(
                'key'          => 'field_team_role',
                'label'        => 'Role / Title',
                'name'         => 'mchem_team_role',
                'type'         => 'text',
                'instructions' => 'e.g. "Founder & Managing Director"',
            ),
            array(
                'key'          => 'field_team_expertise',
                'label'        => 'Expertise Tags (pipe-separated)',
                'name'         => 'mchem_team_expertise',
                'type'         => 'text',
                'instructions' => 'e.g. "Process Engineering | Operations Management | Industry Coordination"',
            ),
            array(
                'key'          => 'field_team_linkedin',
                'label'        => 'LinkedIn URL',
                'name'         => 'mchem_team_linkedin',
                'type'         => 'url',
            ),
            array(
                'key'          => 'field_team_email',
                'label'        => 'Email Address',
                'name'         => 'mchem_team_email',
                'type'         => 'email',
            ),
            array(
                'key'          => 'field_team_order',
                'label'        => 'Display Order (1 = first)',
                'name'         => 'mchem_team_order',
                'type'         => 'number',
                'min'          => 1,
            ),
        ),
        'location' => array( array( array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'mchem_team',
        ) ) ),
        'menu_order' => 0,
        'style'      => 'seamless',
    ) );

    // ── Homepage Options (ACF Options Page) ────────────────────────────────────
    if ( function_exists( 'acf_add_options_page' ) ) {
        acf_add_options_page( array(
            'page_title' => 'MChem Site Options',
            'menu_title' => 'Site Options',
            'menu_slug'  => 'mchem-site-options',
            'capability' => 'manage_options',
            'icon_url'   => 'dashicons-admin-site-alt3',
            'position'   => 2,
        ) );
    }
}

/**
 * Fallback: Register native WP meta boxes if ACF is NOT installed.
 * Allows the theme to work standalone without ACF plugin.
 */
add_action( 'add_meta_boxes', 'mchem_native_meta_boxes' );
function mchem_native_meta_boxes() {

    if ( function_exists( 'acf_add_local_field_group' ) ) {
        return; // ACF handles this
    }

    // Service meta box
    add_meta_box(
        'mchem_service_details',
        esc_html__( 'Service Details', 'mchemconsultants' ),
        'mchem_service_meta_box_cb',
        'mchem_service',
        'normal',
        'high'
    );

    // Team meta box
    add_meta_box(
        'mchem_team_details',
        esc_html__( 'Team Member Details', 'mchemconsultants' ),
        'mchem_team_meta_box_cb',
        'mchem_team',
        'normal',
        'high'
    );
}

/** Service meta box callback */
function mchem_service_meta_box_cb( $post ) {
    wp_nonce_field( 'mchem_save_service_meta', 'mchem_service_nonce' );
    $fields = array(
        'mchem_service_number'  => 'Service Number (01, 02...)',
        'mchem_service_icon'    => 'Icon Slug (e.g. settings)',
        'mchem_service_software'=> 'Software Badge (optional)',
        'mchem_service_outcome' => 'Key Outcome',
    );
    foreach ( $fields as $key => $label ) {
        $val = esc_attr( get_post_meta( $post->ID, $key, true ) );
        echo '<p><label><strong>' . esc_html( $label ) . '</strong><br>';
        echo '<input type="text" name="' . esc_attr( $key ) . '" value="' . $val . '" style="width:100%"></label></p>';
    }
}

/** Team meta box callback */
function mchem_team_meta_box_cb( $post ) {
    wp_nonce_field( 'mchem_save_team_meta', 'mchem_team_nonce' );
    $fields = array(
        'mchem_team_role'      => 'Role / Title',
        'mchem_team_expertise' => 'Expertise Tags (pipe-separated)',
        'mchem_team_linkedin'  => 'LinkedIn URL',
        'mchem_team_email'     => 'Email Address',
        'mchem_team_order'     => 'Display Order',
    );
    foreach ( $fields as $key => $label ) {
        $val = esc_attr( get_post_meta( $post->ID, $key, true ) );
        echo '<p><label><strong>' . esc_html( $label ) . '</strong><br>';
        echo '<input type="text" name="' . esc_attr( $key ) . '" value="' . $val . '" style="width:100%"></label></p>';
    }
}

/** Save native meta on post save */
add_action( 'save_post', 'mchem_save_custom_meta' );
function mchem_save_custom_meta( $post_id ) {

    // Security checks
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Service meta save
    if ( isset( $_POST['mchem_service_nonce'] ) &&
         wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mchem_service_nonce'] ) ), 'mchem_save_service_meta' ) ) {
        $service_keys = array( 'mchem_service_number', 'mchem_service_icon', 'mchem_service_software', 'mchem_service_outcome' );
        foreach ( $service_keys as $key ) {
            if ( isset( $_POST[ $key ] ) ) {
                update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
            }
        }
    }

    // Team meta save
    if ( isset( $_POST['mchem_team_nonce'] ) &&
         wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mchem_team_nonce'] ) ), 'mchem_save_team_meta' ) ) {
        $team_keys = array( 'mchem_team_role', 'mchem_team_expertise', 'mchem_team_linkedin', 'mchem_team_email', 'mchem_team_order' );
        foreach ( $team_keys as $key ) {
            if ( isset( $_POST[ $key ] ) ) {
                $sanitizer = in_array( $key, array( 'mchem_team_linkedin' ), true ) ? 'esc_url_raw' : 'sanitize_text_field';
                update_post_meta( $post_id, $key, $sanitizer( wp_unslash( $_POST[ $key ] ) ) );
            }
        }
    }
}