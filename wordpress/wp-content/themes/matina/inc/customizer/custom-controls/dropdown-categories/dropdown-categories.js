/**
 * Custom scripts for Dropdown Categories Control
 *
 * @package Matina
 */

wp.customize.controlConstructor['mt-dropdown-categories'] = wp.customize.Control.extend({

	ready: function() {

		'use strict';

		var control = this;

		control.container.on( 'change', 'select', function() {
			control.setting.set( jQuery( this ).val() );
		} );

	}

});