( function( api ) {

	// Extends our custom "vw-restaurant-lite" section.
	api.sectionConstructor['vw-restaurant-lite'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );