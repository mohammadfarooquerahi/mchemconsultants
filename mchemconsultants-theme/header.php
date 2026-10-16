<?php
/**
 * MChem Consultants - header.php
 *
 * Floating Island Navbar:
 * - Left: [Logo (Enlarged)]
 * - Right: [✉ Email us] + [🌙/☼ Theme Toggle] + [Menu ☰]
 * - Slide Drawer: Primary navigation + Theme switch + WhatsApp + Email.
 *
 * @package mchemconsultants
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="mchem-html" data-theme="light">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico' ); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico' ); ?>" type="image/x-icon">

    <!-- Resource preconnect for Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Anti-flicker theme initialization (Light mode default) -->
    <script>
      (function() {
        var theme = localStorage.getItem('mchem_theme') || 'light';
        document.documentElement.setAttribute('data-theme', theme);
      })();
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class( 'mchem-body' ); ?>>
<?php wp_body_open(); ?>

<!-- ============================================================
     PREMIUM INTRO SPLASH / BRAND ANIMATION (2s Smooth Transition)
     ============================================================ -->
<div id="mchem-intro-splash" class="mchem-splash" aria-hidden="true">
    <div class="mchem-splash__backdrop"></div>
    <div class="mchem-splash__content">
        <div class="mchem-splash__logo-box">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/mchem-logo.png' ); ?>" alt="MChem Consultants" class="mchem-splash__logo" width="110" height="110">
            <span class="mchem-splash__aura" aria-hidden="true"></span>
            <span class="mchem-splash__ring" aria-hidden="true"></span>
        </div>
        <h1 class="mchem-splash__title">MCHEM CONSULTANTS</h1>
        <p class="mchem-splash__tagline">Engineering Sustainable Solutions for better tomorrow</p>
        <div class="mchem-splash__progress">
            <span class="mchem-splash__bar"></span>
        </div>
    </div>
</div>

<!-- ============================================================
     FLOATING ISLAND NAVBAR (Logo on Left | Email + Toggle + Menu on Right)
     ============================================================ -->
<header class="mchem-header" id="mchem-site-header" role="banner">
    <div class="mchem-header__island">

        <!-- Background glow & border shimmer -->
        <span class="mchem-header__glow-top" aria-hidden="true"></span>
        <span class="mchem-header__glow-bottom" aria-hidden="true"></span>
        <span class="mchem-header__border-inner" aria-hidden="true"></span>

        <!-- LEFT: Logo (Enlarged) -->
        <div class="mchem-header__left">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mchem-header__logo-link" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                <div class="mchem-header__logo-wrap">
                    <?php
                    $logo_url = get_template_directory_uri() . '/assets/images/mchem-logo.png';
                    if ( function_exists('has_custom_logo') && has_custom_logo() ) {
                        the_custom_logo();
                    } else {
                        echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="mchem-nav-logo" height="48" loading="eager">';
                    }
                    ?>
                    <span class="mchem-header__brand-name">MCHEM CONSULTANTS</span>
                </div>
            </a>
        </div>

        <!-- RIGHT: [✉ Email us] + [Theme Toggle] + [Menu] -->
        <div class="mchem-header__right">

            <!-- 1. Email Us Action Button (Guaranteed Redirect) -->
            <a href="mailto:<?php echo esc_attr( get_theme_mod( 'mchem_contact_email', 'mchemconsultants2@gmail.com' ) ); ?>" class="mchem-header__action-btn mchem-email-direct-btn" target="_blank" rel="noopener noreferrer" title="<?php esc_attr_e( 'Email: mchemconsultants2@gmail.com', 'mchemconsultants' ); ?>">
                <?php mchem_icon( 'mail', 'mchem-header__action-icon', '18' ); ?>
                <span class="mchem-header__action-text"><?php esc_html_e( 'Email us', 'mchemconsultants' ); ?></span>
            </a>

            <!-- 2. Theme Toggle Button (Light/Dark Switcher) -->
            <button
                type="button"
                class="mchem-header__theme-toggle"
                id="mchem-theme-toggle"
                aria-label="<?php esc_attr_e( 'Toggle dark/light mode', 'mchemconsultants' ); ?>"
                title="<?php esc_attr_e( 'Switch theme', 'mchemconsultants' ); ?>"
            >
                <!-- Moon icon shown in light mode to switch to dark -->
                <svg class="mchem-icon-moon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                <!-- Sun icon shown in dark mode to switch to light -->
                <svg class="mchem-icon-sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
            </button>

            <!-- 3. Menu Toggle Button -->
            <button
                type="button"
                class="mchem-header__menu-toggle"
                id="mchem-menu-toggle"
                aria-label="<?php esc_attr_e( 'Open Menu', 'mchemconsultants' ); ?>"
                aria-expanded="false"
                aria-controls="mchem-mobile-menu"
            >
                <span class="mchem-header__menu-label"><?php esc_html_e( 'Menu', 'mchemconsultants' ); ?></span>
                <svg class="mchem-header__menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                <svg class="mchem-header__close-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
            </button>

        </div>
    </div>
</header>

<!-- ============================================================
     SLIDE-OUT NAVIGATION DRAWER
     ============================================================ -->
<div class="mchem-mobile-menu" id="mchem-mobile-menu" aria-hidden="true">
    <div class="mchem-mobile-menu__backdrop" id="mchem-menu-backdrop"></div>
    <nav class="mchem-mobile-menu__nav" aria-label="<?php esc_attr_e( 'Navigation Menu', 'mchemconsultants' ); ?>">
        <div class="mchem-mobile-menu__header">
            <?php
            $logo_url = get_template_directory_uri() . '/assets/images/mchem-logo.png';
            echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="mchem-nav-logo" height="42" loading="lazy">';
            ?>
            <button type="button" class="mchem-mobile-menu__close" id="mchem-menu-close" aria-label="<?php esc_attr_e( 'Close menu', 'mchemconsultants' ); ?>">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
            </button>
        </div>

        <ul class="mchem-mobile-menu__list">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#home"><?php esc_html_e( 'Home', 'mchemconsultants' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#about"><?php esc_html_e( 'About & Story', 'mchemconsultants' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#services"><?php esc_html_e( 'Core Services', 'mchemconsultants' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#projects"><?php esc_html_e( 'Projects & Case Studies', 'mchemconsultants' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#gallery"><?php esc_html_e( 'Gallery', 'mchemconsultants' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#industries"><?php esc_html_e( 'Industries & Sectors', 'mchemconsultants' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#team"><?php esc_html_e( 'Leadership Team', 'mchemconsultants' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#reviews"><?php esc_html_e( 'Client Reviews', 'mchemconsultants' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#booking"><?php esc_html_e( 'Book Consultation', 'mchemconsultants' ); ?></a></li>
        </ul>

        <div class="mchem-mobile-menu__cta">
            <a href="<?php echo mchem_get_whatsapp_url(); ?>" class="mchem-btn mchem-btn--niw-primary mchem-btn--full" target="_blank" rel="noopener noreferrer">
                <?php mchem_icon( 'whatsapp', '', '18' ); ?>
                <span><?php esc_html_e( 'Chat on WhatsApp', 'mchemconsultants' ); ?></span>
            </a>
            <a href="mailto:<?php echo esc_attr( get_theme_mod( 'mchem_contact_email', 'mchemconsultants2@gmail.com' ) ); ?>" class="mchem-btn mchem-btn--niw-glass mchem-btn--full mchem-email-direct-btn" target="_blank" rel="noopener noreferrer">
                <?php mchem_icon( 'mail', '', '18' ); ?>
                <span><?php esc_html_e( 'Email Us Directly', 'mchemconsultants' ); ?></span>
            </a>
        </div>

        <div class="mchem-mobile-menu__contact">
            <p>
                <?php mchem_icon( 'mail', '', '14' ); ?>
                <a href="mailto:<?php echo esc_attr( get_theme_mod( 'mchem_contact_email', 'mchemconsultants2@gmail.com' ) ); ?>" class="mchem-email-direct-btn"><?php echo esc_html( get_theme_mod( 'mchem_contact_email', 'mchemconsultants2@gmail.com' ) ); ?></a>
            </p>
            <p>
                <?php mchem_icon( 'phone', '', '14' ); ?>
                <a href="tel:+923320386271">+92 332 0386271</a>
            </p>
            <p>
                <?php mchem_icon( 'map-pin', '', '14' ); ?>
                <span>Dept. of Chemical Engineering, MUET Jamshoro</span>
            </p>
        </div>
    </nav>
</div>

<a class="mchem-skip-link screen-reader-text" href="#mchem-main-content"><?php esc_html_e( 'Skip to content', 'mchemconsultants' ); ?></a>

<main id="mchem-main-content" class="mchem-main" tabindex="-1">