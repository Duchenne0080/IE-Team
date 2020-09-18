<?php
/**
 * Override field methods
 *
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2019, Ari Stathopoulos (@aristath)
 * @license     https://opensource.org/licenses/MIT
 * @since       2.2.7
 */

/**
 * Field overrides.
 */
class Business_Class_Customizer_Field_Spacing extends Business_Class_Customizer_Field_Dimensions {

	/**
	 * Set the choices.
	 * Adds a pseudo-element "controls" that helps with the JS API.
	 *
	 * @access protected
	 */
	protected function set_choices() {
		$default_args = array(
			'controls' => array(
				'top'    => ( isset( $this->default['top'] ) ),
				'bottom' => ( isset( $this->default['top'] ) ),
				'left'   => ( isset( $this->default['top'] ) ),
				'right'  => ( isset( $this->default['top'] ) ),
			),
			'labels'   => array(
				'top'    => esc_html__( 'Top', 'business-class' ),
				'bottom' => esc_html__( 'Bottom', 'business-class' ),
				'left'   => esc_html__( 'Left', 'business-class' ),
				'right'  => esc_html__( 'Right', 'business-class' ),
			),
		);

		$this->choices = wp_parse_args( $this->choices, $default_args );
	}
}
