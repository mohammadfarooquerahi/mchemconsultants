/**
 * MChem Consultants - assets/js/ticker.js
 *
 * Handles the service card ticker:
 *   - Ensures seamless infinite loop (cloning)
 *   - Pauses on hover (CSS handles this too, but JS provides touch support)
 *   - Respects prefers-reduced-motion
 */

( function () {
  'use strict';

  // Respect reduced motion — stop animations entirely
  if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
    return;
  }

  const tickers = document.querySelectorAll( '.mchem-ticker' );

  tickers.forEach( ticker => {
    const track = ticker.querySelector( '.mchem-ticker__track' );
    if ( ! track ) return;

    // Touch: pause on touch start, resume on touch end
    ticker.addEventListener( 'touchstart', () => {
      track.style.animationPlayState = 'paused';
    }, { passive: true } );

    ticker.addEventListener( 'touchend', () => {
      track.style.animationPlayState = 'running';
    }, { passive: true } );
  } );

} )();
