/**
 * Custom scripts for Radio Image Control
 *
 * @package Matina
 */

wp.customize.controlConstructor['mt-radio-image'] = wp.customize.Control.extend({
	ready: function() {
		'use strict';
		var control = this;
		// Change the value
		this.container.on( 'click', 'input', function() {
			control.setting.set( jQuery( this ).val() );
		});
	}
});