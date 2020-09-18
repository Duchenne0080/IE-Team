jQuery(document).ready(function($) {
	/* Move Front page widgets to front-page panel */
	wp.customize.section( 'sidebar-widgets-newsletter-section' ).panel( 'general_settings' );
    wp.customize.section( 'sidebar-widgets-newsletter-section' ).priority( '60' );
 
});

( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['blossom-recipe-pro-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );