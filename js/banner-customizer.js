/**
 * @author bramb
 */
( function( $ ) {
	
	$banner = $('.banner-bg');
	
	// banner image
	wp.customize( 'banner_image', function( value ) {
		value.bind( function( newval ) {			
			$banner.css('background-image', 'url('+newval+')' );
		} );
	} );
		
	wp.customize( 'banner_position', function( value ) {		
		value.bind( function( newval ) {	
			$banner.css('background-position', newval );
		} );
	} );
	
	
} )( jQuery );