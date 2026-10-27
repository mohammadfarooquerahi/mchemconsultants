/**
 * MChem Consultants - assets/js/main.js
 *
 * Core theme JavaScript:
 *   1. Header scroll state
 *   2. Mobile menu slide drawer
 *   3. Intersection Observer scroll-entry animations
 *   4. Particle background (hero)
 *   5. Smooth scroll for anchor links
 *   6. Industries fan deck switcher
 *   7. Team carousel navigation
 *   8. Light / Dark theme toggle (Light default)
 */

( function () {
  'use strict';

  // ── 1. HEADER SCROLL STATE ────────────────────────────────────────────────
  const header = document.getElementById( 'mchem-site-header' );

  if ( header ) {
    const onScroll = () => {
      if ( window.scrollY > 20 ) {
        header.classList.add( 'mchem-header--scrolled' );
      } else {
        header.classList.remove( 'mchem-header--scrolled' );
      }
    };
    window.addEventListener( 'scroll', onScroll, { passive: true } );
    onScroll();
  }

  // ── 2. MOBILE MENU TOGGLE ────────────────────────────────────────────────
  const menuToggle  = document.getElementById( 'mchem-menu-toggle' );
  const menuClose   = document.getElementById( 'mchem-menu-close' );
  const mobileMenu  = document.getElementById( 'mchem-mobile-menu' );
  const backdrop    = document.getElementById( 'mchem-menu-backdrop' );

  function openMenu() {
    if ( ! mobileMenu ) return;
    mobileMenu.classList.add( 'is-open' );
    mobileMenu.setAttribute( 'aria-hidden', 'false' );
    if ( menuToggle ) menuToggle.setAttribute( 'aria-expanded', 'true' );
    document.body.style.overflow = 'hidden';
    setTimeout( () => { if ( menuClose ) menuClose.focus(); }, 50 );
  }

  function closeMenu() {
    if ( ! mobileMenu ) return;
    mobileMenu.classList.remove( 'is-open' );
    mobileMenu.setAttribute( 'aria-hidden', 'true' );
    if ( menuToggle ) menuToggle.setAttribute( 'aria-expanded', 'false' );
    document.body.style.overflow = '';
    if ( menuToggle ) menuToggle.focus();
  }

  if ( menuToggle ) menuToggle.addEventListener( 'click', openMenu );
  if ( menuClose  ) menuClose.addEventListener( 'click', closeMenu );
  if ( backdrop   ) backdrop.addEventListener( 'click', closeMenu );

  document.addEventListener( 'keydown', ( e ) => {
    if ( e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains( 'is-open' ) ) {
      closeMenu();
    }
  } );

  const mobileNavLinks = document.querySelectorAll( '.mchem-mobile-menu__list a' );
  mobileNavLinks.forEach( link => {
    link.addEventListener( 'click', closeMenu );
  } );

  // ── 3. SCROLL ENTRY ANIMATIONS ───────────────────────────────────────────
  const animEls = document.querySelectorAll( '[data-animate]' );

  if ( animEls.length > 0 && 'IntersectionObserver' in window ) {
    const observer = new IntersectionObserver( ( entries ) => {
      entries.forEach( ( entry ) => {
        if ( entry.isIntersecting ) {
          entry.target.classList.add( 'is-visible' );
          observer.unobserve( entry.target );
        }
      } );
    }, {
      threshold: 0.12,
      rootMargin: '0px 0px -40px 0px',
    } );

    animEls.forEach( el => observer.observe( el ) );
  } else {
    animEls.forEach( el => el.classList.add( 'is-visible' ) );
  }

  // ── 4. HERO PARTICLE EFFECT ───────────────────────────────────────────────
  const particleContainer = document.getElementById( 'mchem-particles' );

  function createParticles() {
    if ( ! particleContainer ) return;

    const count = window.matchMedia( '(max-width: 640px)' ).matches ? 14 : 28;

    for ( let i = 0; i < count; i++ ) {
      const dot = document.createElement( 'span' );
      dot.style.cssText = `
        position: absolute;
        width: ${Math.random() * 3 + 1}px;
        height: ${Math.random() * 3 + 1}px;
        border-radius: 50%;
        background: ${ Math.random() > 0.5 ? 'rgba(2,132,199,0.45)' : 'rgba(201,152,42,0.45)' };
        top: ${Math.random() * 100}%;
        left: ${Math.random() * 100}%;
        opacity: ${Math.random() * 0.6 + 0.1};
        animation: mchem-particle-float ${6 + Math.random() * 10}s ease-in-out infinite;
        animation-delay: ${Math.random() * 8}s;
      `;
      particleContainer.appendChild( dot );
    }

    if ( ! document.getElementById( 'mchem-particle-anim' ) ) {
      const style = document.createElement( 'style' );
      style.id = 'mchem-particle-anim';
      style.textContent = `
        @keyframes mchem-particle-float {
          0%, 100% { transform: translateY(0) scale(1); opacity: 0.3; }
          50% { transform: translateY(-${12 + Math.random() * 20}px) scale(1.2); opacity: 0.7; }
        }
      `;
      document.head.appendChild( style );
    }
  }

  if ( ! window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
    createParticles();
  }

  // ── 5. SMOOTH SCROLL FOR ANCHOR LINKS ────────────────────────────────────
  document.querySelectorAll( 'a[href^="#"]' ).forEach( anchor => {
    anchor.addEventListener( 'click', function ( e ) {
      const targetId = this.getAttribute( 'href' ).slice( 1 );
      if ( ! targetId ) return;

      const target = document.getElementById( targetId );
      if ( target ) {
        e.preventDefault();
        const headerHeight = header ? header.getBoundingClientRect().height + 20 : 100;
        const top = target.getBoundingClientRect().top + window.scrollY - headerHeight;
        window.scrollTo( { top, behavior: 'smooth' } );
      }
    } );
  } );

  // ── 6. THEME TOGGLE (LIGHT DEFAULT & DARK SWITCH) ────────────────────────
  function initThemeToggle() {
    const themeBtn = document.getElementById( 'mchem-theme-toggle' );
    const htmlEl = document.documentElement;

    function setTheme( theme ) {
      htmlEl.setAttribute( 'data-theme', theme );
      try {
        localStorage.setItem( 'mchem_theme', theme );
      } catch ( e ) {}
    }

    if ( themeBtn ) {
      themeBtn.addEventListener( 'click', function () {
        const currentTheme = htmlEl.getAttribute( 'data-theme' ) || 'light';
        const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme( nextTheme );
      } );
    }
  }

  if ( document.readyState === 'loading' ) {
    document.addEventListener( 'DOMContentLoaded', initThemeToggle );
  } else {
    initThemeToggle();
  }

  // ── 7. INDUSTRIES FAN DECK ───────────────────────────────────────────────
  function initIndustriesDeck() {
    const tiles = document.querySelectorAll( '.mchem-fan-tile' );
    const catEl = document.getElementById( 'mchem-ind-category' );
    const descEl = document.getElementById( 'mchem-ind-desc' );
    const waBtn = document.getElementById( 'mchem-ind-wa' );

    if ( ! tiles.length || ! catEl || ! descEl ) return;

    tiles.forEach( tile => {
      tile.addEventListener( 'click', function () {
        tiles.forEach( t => {
          t.classList.remove( 'is-active' );
          t.setAttribute( 'aria-selected', 'false' );
        } );

        this.classList.add( 'is-active' );
        this.setAttribute( 'aria-selected', 'true' );

        const cat = this.getAttribute( 'data-category' );
        const desc = this.getAttribute( 'data-desc' );
        const label = this.getAttribute( 'data-label' );

        catEl.style.opacity = '0';
        descEl.style.opacity = '0';

        setTimeout( () => {
          catEl.textContent = cat;
          descEl.textContent = desc;
          if ( waBtn ) {
            waBtn.href = `https://wa.me/923320386271?text=Hello%20MChem%20Consultants!%20I%20am%20interested%20in%20solutions%20for%20the%20${encodeURIComponent(label)}%20industry.`;
          }
          catEl.style.opacity = '1';
          descEl.style.opacity = '1';
        }, 150 );
      } );
    } );
  }

  if ( document.readyState === 'loading' ) {
    document.addEventListener( 'DOMContentLoaded', initIndustriesDeck );
  } else {
    initIndustriesDeck();
  }

  // ── 8. TEAM CAROUSEL ARROW CONTROLS ──────────────────────────────────────
  function initTeamCarousel() {
    const track = document.getElementById( 'mchem-team-track' );
    const prevBtn = document.getElementById( 'mchem-team-prev' );
    const nextBtn = document.getElementById( 'mchem-team-next' );

    if ( ! track || ! prevBtn || ! nextBtn ) return;

    prevBtn.addEventListener( 'click', function () {
      track.scrollBy( { left: -360, behavior: 'smooth' } );
    } );

    nextBtn.addEventListener( 'click', function () {
      track.scrollBy( { left: 360, behavior: 'smooth' } );
    } );
  }

  // ── 9. INTRO SPLASH & PRELOADER ENGINE (Zero-FOUC & 100% Loaded Reveal) ─
  function initIntroSplash() {
    const splash = document.getElementById( 'mchem-intro-splash' );
    if ( ! splash ) {
      document.documentElement.classList.remove( 'mchem-is-loading' );
      return;
    }

    let isDismissed = false;
    const minSplashDuration  = 1600; // Minimum 1.6s so visitor sees the brand intro
    const maxFailsafeTimeout = 3800; // Max 3.8s safety cutoff for slow networks / stalled 3rd-party assets
    const startTime          = ( window.__mchemStartTime || Date.now() );

    function dismissSplash() {
      if ( isDismissed ) return;
      isDismissed = true;

      splash.classList.add( 'is-dismissed' );
      document.documentElement.classList.remove( 'mchem-is-loading' );

      setTimeout( () => {
        splash.style.display = 'none';
        document.dispatchEvent( new CustomEvent( 'mchem:siteReady' ) );
      }, 550 );
    }

    // Only dismiss once stylesheets, images, and fonts are completely loaded
    if ( document.readyState === 'complete' ) {
      const elapsed = Date.now() - startTime;
      const waitTime = Math.max( 0, minSplashDuration - elapsed );
      setTimeout( dismissSplash, waitTime );
    } else {
      window.addEventListener( 'load', () => {
        const elapsed = Date.now() - startTime;
        const waitTime = Math.max( 0, minSplashDuration - elapsed );
        setTimeout( dismissSplash, waitTime );
      }, { once: true } );
    }

    // Safety timeout: prevents stuck preloader under extreme network drop
    setTimeout( dismissSplash, maxFailsafeTimeout );
  }

  initIntroSplash();

  // ── 10. HERO BACKGROUND VIDEO AUTOPLAY GUARANTEE ─────────────────────────
  function initHeroVideo() {
    const video = document.getElementById( 'mchem-hero-bg-video' ) || document.querySelector( '.mchem-hero__video' );
    if ( ! video ) return;

    // Strict requirements for modern browser background autoplay
    video.muted = true;
    video.defaultMuted = true;

    const playVideo = function () {
      const promise = video.play();
      if ( promise !== undefined ) {
        promise.catch( function () {
          // If browser blocked initial autoplay (low-power or strict policy), retry on first interaction
          const onUserGesture = function () {
            video.play().catch( function () {} );
            window.removeEventListener( 'click', onUserGesture );
            window.removeEventListener( 'touchstart', onUserGesture );
            window.removeEventListener( 'scroll', onUserGesture );
          };
          window.addEventListener( 'click', onUserGesture, { once: true } );
          window.addEventListener( 'touchstart', onUserGesture, { once: true } );
          window.addEventListener( 'scroll', onUserGesture, { once: true } );
        } );
      }
    };

    if ( video.readyState >= 2 ) {
      playVideo();
    } else {
      video.addEventListener( 'canplay', playVideo, { once: true } );
      video.addEventListener( 'loadeddata', playVideo, { once: true } );
      setTimeout( playVideo, 300 );
    }
  }

  if ( document.readyState === 'loading' ) {
    document.addEventListener( 'DOMContentLoaded', initHeroVideo );
  } else {
    initHeroVideo();
  }

  // ── 11. SMART EMAIL REDIRECT (Desktop Webmail & Mobile Native Mail) ────────
  function initSmartEmailLinks() {
    const emailLinks = document.querySelectorAll( 'a[href^="mailto:"], .mchem-email-direct-btn, .mchem-header__action-btn' );
    const targetEmail = 'mchemconsultants2@gmail.com';

    emailLinks.forEach( link => {
      link.addEventListener( 'click', function ( e ) {
        const isMobile = /Android|iPhone|iPad|iPod|webOS|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent );

        if ( ! isMobile ) {
          // On desktop, open Gmail Web Composer in a new tab to guarantee redirection
          // even when Windows has no local mail software configured.
          e.preventDefault();
          const gmailUrl = `https://mail.google.com/mail/?view=cm&fs=1&to=${encodeURIComponent( targetEmail )}&su=${encodeURIComponent( 'Inquiry for MChem Consultants' )}`;
          window.open( gmailUrl, '_blank', 'noopener,noreferrer' );

          // Also trigger mailto in background for Outlook/Thunderbird users
          setTimeout( () => {
            const temp = document.createElement( 'a' );
            temp.href = `mailto:${targetEmail}?subject=${encodeURIComponent( 'Inquiry for MChem Consultants' )}`;
            temp.style.display = 'none';
            document.body.appendChild( temp );
            temp.click();
            document.body.removeChild( temp );
          }, 350 );
        }
      } );
    } );
  }

  if ( document.readyState === 'loading' ) {
    document.addEventListener( 'DOMContentLoaded', initSmartEmailLinks );
  } else {
    initSmartEmailLinks();
  }

} )();
