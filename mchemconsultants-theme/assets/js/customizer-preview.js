( function ( $ ) {
  wp.customize( 'mchem_hero_heading', function ( value ) {
    value.bind( function ( newval ) {
      document.querySelector( '.mchem-hero__heading' ) && ( document.querySelector( '.mchem-hero__heading' ).textContent = newval );
    } );
  } );
  wp.customize( 'mchem_hero_sub', function ( value ) {
    value.bind( function ( newval ) {
      document.querySelector( '.mchem-hero__sub' ) && ( document.querySelector( '.mchem-hero__sub' ).textContent = newval );
    } );
  } );
} )( jQuery );
