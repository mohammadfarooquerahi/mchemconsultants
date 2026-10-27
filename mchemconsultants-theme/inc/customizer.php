<?php
/**
 * MChem Consultants - inc/customizer.php
 *
 * Registers all Customizer panels, sections, and controls.
 * Clients can edit: contact info, WhatsApp number, hero text,
 * tagline, social links, colors — all from WP Admin > Appearance > Customize.
 *
 * @package mchemconsultants
 */

defined( 'ABSPATH' ) || exit;

add_action( 'customize_register', 'mchem_customizer_register' );
function mchem_customizer_register( $wp_customize ) {

    // ── PANEL: MChem Theme Options ────────────────────────────────────────────
    $wp_customize->add_panel( 'mchem_options', array(
        'title'       => esc_html__( 'MChem Theme Options', 'mchemconsultants' ),
        'description' => esc_html__( 'Control all site-wide settings for MChem Consultants.', 'mchemconsultants' ),
        'priority'    => 30,
    ) );

    // ═══════════════════════════════════════════════════════════════
    // SECTION 1: Contact & WhatsApp
    // ═══════════════════════════════════════════════════════════════
    $wp_customize->add_section( 'mchem_contact', array(
        'title'  => esc_html__( 'Contact & WhatsApp', 'mchemconsultants' ),
        'panel'  => 'mchem_options',
    ) );

    // WhatsApp number (no + or spaces, international format)
    $wp_customize->add_setting( 'mchem_whatsapp_number', array(
        'default'           => '923320386271',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'mchem_whatsapp_number', array(
        'label'       => esc_html__( 'WhatsApp Number (no + sign, e.g. 923320386271)', 'mchemconsultants' ),
        'section'     => 'mchem_contact',
        'type'        => 'text',
        'description' => esc_html__( 'Country code + number. No spaces or symbols. Pakistan: 92 + 10 digits.', 'mchemconsultants' ),
    ) );

    // Contact email
    $wp_customize->add_setting( 'mchem_contact_email', array(
        'default'           => 'mchemconsultants2@gmail.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'mchem_contact_email', array(
        'label'   => esc_html__( 'Contact Email', 'mchemconsultants' ),
        'section' => 'mchem_contact',
        'type'    => 'email',
    ) );

    // Phone display
    $wp_customize->add_setting( 'mchem_contact_phone', array(
        'default'           => '+92 332 0386271',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'mchem_contact_phone', array(
        'label'   => esc_html__( 'Display Phone Number', 'mchemconsultants' ),
        'section' => 'mchem_contact',
        'type'    => 'text',
    ) );

    // Office location
    $wp_customize->add_setting( 'mchem_office_address', array(
        'default'           => 'Dept. of Chemical Engineering, MUET Jamshoro, Sindh, Pakistan',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'mchem_office_address', array(
        'label'   => esc_html__( 'Office Address', 'mchemconsultants' ),
        'section' => 'mchem_contact',
        'type'    => 'textarea',
    ) );

    // Working hours
    $wp_customize->add_setting( 'mchem_working_hours', array(
        'default'           => 'Mon – Sat: 9:00 AM – 6:00 PM (PKT)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'mchem_working_hours', array(
        'label'   => esc_html__( 'Working Hours', 'mchemconsultants' ),
        'section' => 'mchem_contact',
        'type'    => 'text',
    ) );

    // Response time promise
    $wp_customize->add_setting( 'mchem_response_time', array(
        'default'           => 'We reply within 24 hours',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'mchem_response_time', array(
        'label'   => esc_html__( 'Response Time Promise', 'mchemconsultants' ),
        'section' => 'mchem_contact',
        'type'    => 'text',
    ) );

    // ═══════════════════════════════════════════════════════════════
    // SECTION 2: Hero Section
    // ═══════════════════════════════════════════════════════════════
    $wp_customize->add_section( 'mchem_hero', array(
        'title' => esc_html__( 'Hero Section', 'mchemconsultants' ),
        'panel' => 'mchem_options',
    ) );

    $hero_fields = array(
        'mchem_hero_eyebrow'   => array( 'label' => 'Eyebrow Tag (small text above heading)',   'default' => 'Faculty-Guided · Industry-Focused · Engineering-Driven' ),
        'mchem_hero_heading'   => array( 'label' => 'Hero Main Heading',                        'default' => 'Engineering intelligent process solutions that drive industrial performance.' ),
        'mchem_hero_highlight' => array( 'label' => 'Highlighted Word/Phrase in Heading',       'default' => 'drive industrial performance.' ),
        'mchem_hero_sub'       => array( 'label' => 'Hero Subheadline',                         'default' => 'Engineering Sustainable Solutions for better tomorrow' ),
        'mchem_hero_cta1'      => array( 'label' => 'CTA Button 1 Text',                        'default' => 'Process Simulation & Services' ),
        'mchem_hero_cta2'      => array( 'label' => 'CTA Button 2 Text',                        'default' => 'Request a Consultation' ),
    );

    foreach ( $hero_fields as $setting_id => $args ) {
        $wp_customize->add_setting( $setting_id, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( $setting_id, array(
            'label'   => esc_html__( $args['label'], 'mchemconsultants' ),
            'section' => 'mchem_hero',
            'type'    => 'text',
        ) );
    }

    // ═══════════════════════════════════════════════════════════════
    // SECTION 3: Social Media Links
    // ═══════════════════════════════════════════════════════════════
    $wp_customize->add_section( 'mchem_social', array(
        'title' => esc_html__( 'Social Media Links', 'mchemconsultants' ),
        'panel' => 'mchem_options',
    ) );

    $social_platforms = array(
        'linkedin'  => 'LinkedIn URL',
        'facebook'  => 'Facebook URL',
        'instagram' => 'Instagram URL',
        'youtube'   => 'YouTube URL',
    );

    foreach ( $social_platforms as $platform => $label ) {
        $wp_customize->add_setting( "mchem_social_{$platform}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "mchem_social_{$platform}", array(
            'label'   => esc_html__( $label, 'mchemconsultants' ),
            'section' => 'mchem_social',
            'type'    => 'url',
        ) );
    }

    // ═══════════════════════════════════════════════════════════════
    // SECTION 4: About / Credibility
    // ═══════════════════════════════════════════════════════════════
    $wp_customize->add_section( 'mchem_about_section', array(
        'title' => esc_html__( 'About & Credibility', 'mchemconsultants' ),
        'panel' => 'mchem_options',
    ) );

    $wp_customize->add_setting( 'mchem_show_bic_badge', array(
        'default'           => true,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'mchem_show_bic_badge', array(
        'label'   => esc_html__( 'Show BIC/MUET Incubation Badge', 'mchemconsultants' ),
        'section' => 'mchem_about_section',
        'type'    => 'checkbox',
    ) );

    // Mission Statement
    $wp_customize->add_setting( 'mchem_about_mission', array(
        'default'           => 'To enhance industrial safety, operational efficiency, and environmental sustainability through cost-effective, faculty-guided, and technology-driven engineering consultancy services.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'mchem_about_mission', array(
        'label'   => esc_html__( 'Mission Statement Text', 'mchemconsultants' ),
        'section' => 'mchem_about_section',
        'type'    => 'textarea',
    ) );

    // About Main Narrative
    $wp_customize->add_setting( 'mchem_about_story', array(
        'default'           => 'MChem Consultants is a specialized Chemical Engineering consultancy firm incubated at the Business Incubation Center (BIC), Mehran University of Engineering and Technology (MUET), Jamshoro. We provide expert solutions in Process Safety & Risk Management, Process Optimization & Simulation, Sustainable Engineering Solutions, and Professional Training for the Oil & Gas, Chemical, and Textile industries.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'mchem_about_story', array(
        'label'   => esc_html__( 'About / Story Main Description', 'mchemconsultants' ),
        'section' => 'mchem_about_section',
        'type'    => 'textarea',
    ) );

    // ═══════════════════════════════════════════════════════════════
    // SECTION 5: Brand Colors
    // ═══════════════════════════════════════════════════════════════
    $wp_customize->add_section( 'mchem_colors', array(
        'title' => esc_html__( 'Brand Colors', 'mchemconsultants' ),
        'panel' => 'mchem_options',
    ) );

    $color_settings = array(
        'mchem_color_primary'   => array( 'label' => 'Primary Navy Color',  'default' => '#0D1B3E' ),
        'mchem_color_secondary' => array( 'label' => 'Accent Gold Color',   'default' => '#C9982A' ),
        'mchem_color_teal'      => array( 'label' => 'Teal Highlight Color', 'default' => '#0EA5A0' ),
        'mchem_color_bg'        => array( 'label' => 'Page Background',      'default' => '#06101F' ),
    );

    foreach ( $color_settings as $setting_id => $args ) {
        $wp_customize->add_setting( $setting_id, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
            'label'   => esc_html__( $args['label'], 'mchemconsultants' ),
            'section' => 'mchem_colors',
        ) ) );
    }

    // ═══════════════════════════════════════════════════════════════
    // SECTION 6: Live Chat & AI (Tidio)
    // ═══════════════════════════════════════════════════════════════
    $wp_customize->add_section( 'mchem_chat', array(
        'title'       => esc_html__( 'Live Chat & AI (Tidio)', 'mchemconsultants' ),
        'panel'       => 'mchem_options',
        'description' => esc_html__( 'Integrate your Tidio Live Chat & AI bot on the website.', 'mchemconsultants' ),
    ) );

    $wp_customize->add_setting( 'mchem_tidio_key', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'mchem_tidio_key', array(
        'label'       => esc_html__( 'Tidio Public Key / Project Key', 'mchemconsultants' ),
        'section'     => 'mchem_chat',
        'type'        => 'text',
        'description' => esc_html__( 'Enter your Tidio project key (e.g. from code.tidio.co/YOUR_KEY.js). Once entered, Tidio chat widget and AI will automatically appear on all pages.', 'mchemconsultants' ),
    ) );

    // ═══════════════════════════════════════════════════════════════
    // SECTION 7: Search Engine Optimization (SEO) & Social Meta
    // ═══════════════════════════════════════════════════════════════
    $wp_customize->add_section( 'mchem_seo_section', array(
        'title'       => esc_html__( 'SEO & Social Meta', 'mchemconsultants' ),
        'panel'       => 'mchem_options',
        'description' => esc_html__( 'Configure search engine title, meta description, keywords, and Google Search Console verification.', 'mchemconsultants' ),
    ) );

    // SEO Title
    $wp_customize->add_setting( 'mchem_seo_title', array(
        'default'           => 'MChem Consultants | Chemical Engineering & Process Simulation | BIC MUET Jamshoro',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'mchem_seo_title', array(
        'label'       => esc_html__( 'Google Search Title', 'mchemconsultants' ),
        'section'     => 'mchem_seo_section',
        'type'        => 'text',
        'description' => esc_html__( 'The main title that appears on Google search results.', 'mchemconsultants' ),
    ) );

    // SEO Meta Description
    $wp_customize->add_setting( 'mchem_seo_description', array(
        'default'           => 'MChem Consultants is a premier Chemical Engineering consultancy firm incubated at the Business Incubation Center (BIC), Mehran University of Engineering and Technology (MUET), Jamshoro. We deliver expert process simulation & modeling, HAZOP risk studies, plant design, and energy optimization across Oil & Gas, Chemical, and Textile industries.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'mchem_seo_description', array(
        'label'       => esc_html__( 'Google Meta Description', 'mchemconsultants' ),
        'section'     => 'mchem_seo_section',
        'type'        => 'textarea',
        'description' => esc_html__( 'The snippet paragraph shown under your title on Google search (optimal 150-160 characters).', 'mchemconsultants' ),
    ) );

    // SEO Keywords
    $wp_customize->add_setting( 'mchem_seo_keywords', array(
        'default'           => 'MChem Consultants, Chemical Engineering Consultancy, Process Simulation, Process Optimization, HAZOP Studies, LOPA Risk Analysis, BIC MUET Jamshoro, Mehran University, Plant Design, PFD P&ID, Energy Efficiency, Waste-to-Energy, Pakistan Engineering Consultant',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'mchem_seo_keywords', array(
        'label'       => esc_html__( 'Meta Keywords', 'mchemconsultants' ),
        'section'     => 'mchem_seo_section',
        'type'        => 'text',
        'description' => esc_html__( 'Comma-separated target keywords for search crawlers.', 'mchemconsultants' ),
    ) );

    // Google Search Console Verification
    $wp_customize->add_setting( 'mchem_gsc_verification', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'mchem_gsc_verification', array(
        'label'       => esc_html__( 'Google Search Console Verification Code', 'mchemconsultants' ),
        'section'     => 'mchem_seo_section',
        'type'        => 'text',
        'description' => esc_html__( 'Paste your HTML tag verification code (content attribute) from Google Search Console to verify ownership.', 'mchemconsultants' ),
    ) );

    // Bing Webmaster Verification
    $wp_customize->add_setting( 'mchem_bing_verification', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'mchem_bing_verification', array(
        'label'       => esc_html__( 'Bing Webmaster Verification Code', 'mchemconsultants' ),
        'section'     => 'mchem_seo_section',
        'type'        => 'text',
        'description' => esc_html__( 'Paste your msvalidate.01 meta content code from Bing Webmaster Tools to index in Bing & Yahoo.', 'mchemconsultants' ),
    ) );
}