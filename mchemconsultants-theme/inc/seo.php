<?php
/**
 * MChem Consultants - inc/seo.php
 *
 * Comprehensive Search Engine Optimization (SEO) & Social Graph Engine:
 * 1. Title Tag & Meta Description optimization for Chemical Engineering keywords.
 * 2. Open Graph & Twitter Card social meta tags (WhatsApp, LinkedIn, Facebook preview).
 * 3. JSON-LD Structured Data Schema (ProfessionalService + Organization + WebSite).
 * 4. Automatic HTTP 410 Gone purge for obsolete spam/demo URLs (e.g. /stockroom/).
 * 5. Google Search Console site verification integration.
 * 6. Robots.txt optimization.
 *
 * @package mchemconsultants
 */

defined( 'ABSPATH' ) || exit;

// ── 1. CLEAN DOCUMENT TITLE ──────────────────────────────────────────────────
add_filter( 'pre_get_document_title', 'mchem_seo_document_title', 20 );
function mchem_seo_document_title( $title ) {
    $custom_title = get_theme_mod( 'mchem_seo_title', '' );
    if ( ( is_front_page() || is_home() ) && ! empty( $custom_title ) ) {
        return esc_html( $custom_title );
    }

    if ( is_front_page() || is_home() ) {
        return 'MChem Consultants | Chemical Engineering & Process Simulation | BIC MUET Jamshoro';
    }

    if ( is_page( 'about' ) || is_page_template( 'page-about.php' ) ) {
        return 'About Us & Our Story | MChem Consultants · BIC MUET Jamshoro';
    }

    return $title;
}

add_filter( 'document_title_separator', function() {
    return '|';
} );

// ── 2. METADATA IN <HEAD> ────────────────────────────────────────────────────
add_action( 'wp_head', 'mchem_seo_meta_tags', 1 );
function mchem_seo_meta_tags() {
    $site_name   = 'MChem Consultants';
    $site_url    = home_url( '/' );
    $logo_url    = get_template_directory_uri() . '/assets/images/mchem-logo.png';
    $banner_url  = get_template_directory_uri() . '/screenshot.png';

    // Meta Description
    $custom_desc = get_theme_mod( 'mchem_seo_description', '' );
    $default_desc = 'MChem Consultants is a premier Chemical Engineering consultancy firm incubated at the Business Incubation Center (BIC), Mehran University of Engineering and Technology (MUET), Jamshoro. We deliver expert process simulation & modeling, HAZOP risk studies, plant design, and energy optimization across Oil & Gas, Chemical, and Textile industries.';
    $meta_desc   = ! empty( $custom_desc ) ? $custom_desc : $default_desc;

    // Meta Keywords
    $custom_keywords = get_theme_mod( 'mchem_seo_keywords', '' );
    $default_keywords = 'MChem Consultants, Chemical Engineering Consultancy, Process Simulation, Process Optimization, HAZOP Studies, LOPA Risk Analysis, BIC MUET Jamshoro, Mehran University, Plant Design, PFD P&ID, Energy Efficiency, Waste-to-Energy, Pakistan Engineering Consultant';
    $meta_keywords   = ! empty( $custom_keywords ) ? $custom_keywords : $default_keywords;

    // Google Site Verification
    $gsc_code = get_theme_mod( 'mchem_gsc_verification', '' );

    // Canonical URL
    $canonical_url = is_singular() ? get_permalink() : $site_url;

    ?>
    <!-- MChem Consultants SEO & Social Engine -->
    <meta name="description" content="<?php echo esc_attr( $meta_desc ); ?>">
    <meta name="keywords" content="<?php echo esc_attr( $meta_keywords ); ?>">
    <meta name="author" content="MChem Consultants">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?php echo esc_url( $canonical_url ); ?>">

    <?php if ( ! empty( $gsc_code ) ) : ?>
    <meta name="google-site-verification" content="<?php echo esc_attr( trim( $gsc_code ) ); ?>">
    <?php endif; ?>

    <!-- Open Graph / WhatsApp / Facebook / LinkedIn -->
    <meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( wp_get_document_title() ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $meta_desc ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $canonical_url ); ?>">
    <meta property="og:image" content="<?php echo esc_url( $banner_url ); ?>">
    <meta property="og:image:secure_url" content="<?php echo esc_url( $banner_url ); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="MChem Consultants - Chemical Engineering & Process Simulation">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( wp_get_document_title() ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $meta_desc ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $banner_url ); ?>">

    <!-- JSON-LD Structured Data (Google Rich Snippets) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": ["ProfessionalService", "Organization"],
          "@id": "<?php echo esc_url( $site_url ); ?>#organization",
          "name": "MChem Consultants",
          "legalName": "MChem Consultants",
          "url": "<?php echo esc_url( $site_url ); ?>",
          "logo": {
            "@type": "ImageObject",
            "url": "<?php echo esc_url( $logo_url ); ?>"
          },
          "image": "<?php echo esc_url( $banner_url ); ?>",
          "description": "<?php echo esc_js( $meta_desc ); ?>",
          "telephone": "+923320386271",
          "email": "mchemconsultants2@gmail.com",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Department of Chemical Engineering, Mehran University of Engineering and Technology (MUET)",
            "addressLocality": "Jamshoro",
            "addressRegion": "Sindh",
            "postalCode": "76062",
            "addressCountry": "PK"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": "25.4057",
            "longitude": "68.2612"
          },
          "parentOrganization": {
            "@type": "EducationalOrganization",
            "name": "Mehran University of Engineering and Technology (MUET)",
            "url": "https://www.muet.edu.pk"
          },
          "areaServed": [
            { "@type": "Country", "name": "Pakistan" },
            { "@type": "Place", "name": "International" }
          ],
          "priceRange": "$$",
          "knowsAbout": [
            "Chemical Engineering Consultancy",
            "Process Safety and HAZOP Studies",
            "Process Simulation and Modeling",
            "Sustainable Engineering Solutions",
            "Energy Optimization & Pinch Integration",
            "Plant Design and P&ID Layouts"
          ]
        },
        {
          "@type": "WebSite",
          "@id": "<?php echo esc_url( $site_url ); ?>#website",
          "url": "<?php echo esc_url( $site_url ); ?>",
          "name": "MChem Consultants",
          "description": "Faculty-Guided Chemical Engineering Consultancy at BIC MUET Jamshoro",
          "publisher": {
            "@id": "<?php echo esc_url( $site_url ); ?>#organization"
          }
        }
      ]
    }
    </script>
    <?php
}

// ── 3. AUTOMATIC HTTP 410 GONE & CLEANUP FOR OBSOLETE SPAM/DEMO URLS ──────────
// When old demo imports, nulled plugin spam (e.g. /stockroom/ or demo posts)
// are requested, send 410 Gone so Googlebot permanently and immediately removes
// them from the Google Search index.
add_action( 'template_redirect', 'mchem_purge_obsolete_urls', 1 );
function mchem_purge_obsolete_urls() {
    $uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

    // Patterns matching the spam/dummy demo pages indexed by Google
    $spam_patterns = array(
        'stockroom',
        'maroon-p',
        'easy-menu-editor',
        'seele',
        'legenda',
        'aboss',
        'dc-agency',
        'wp-theme-free',
        'wordpress-plugin-download',
    );

    foreach ( $spam_patterns as $pattern ) {
        if ( stripos( $uri, $pattern ) !== false ) {
            status_header( 410 );
            nocache_headers();
            header( 'X-Robots-Tag: noindex, nofollow, noarchive, nosnippet', true );
            echo '<!DOCTYPE html><html><head><meta name="robots" content="noindex, nofollow"><title>410 Content Removed - MChem Consultants</title></head><body style="font-family:sans-serif;text-align:center;padding:5rem 1rem;"><h2>410 - Content Permanently Removed</h2><p>This obsolete demo/temporary link has been permanently purged from this server.</p><p><a href="' . esc_url( home_url( '/' ) ) . '" style="color:#0284c7;font-weight:bold;">Return to MChem Consultants Official Homepage &rarr;</a></p></body></html>';
            exit;
        }
    }
}

// ── 4. ROBOTS.TXT ENHANCEMENT ────────────────────────────────────────────────
add_filter( 'robots_txt', 'mchem_custom_robots_txt', 20, 2 );
function mchem_custom_robots_txt( $output, $public ) {
    if ( ! $public ) {
        return $output;
    }

    $site_url = home_url( '/' );
    $custom  = "User-agent: *\n";
    $custom .= "Disallow: /wp-admin/\n";
    $custom .= "Disallow: /stockroom/\n";
    $custom .= "Disallow: /*stockroom*\n";
    $custom .= "Disallow: /wp-includes/\n";
    $custom .= "Disallow: /trackback/\n";
    $custom .= "Disallow: /*?*\n";
    $custom .= "Disallow: /*.php$\n";
    $custom .= "Allow: /wp-admin/admin-ajax.php\n";
    $custom .= "Allow: /wp-content/themes/\n";
    $custom .= "Allow: /wp-content/uploads/\n\n";
    $custom .= "Sitemap: " . esc_url( $site_url . 'wp-sitemap.xml' ) . "\n";

    return $custom;
}