<?php
/**
 * Customizer ButtonSet Control.
 *
 * @package Matina
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Matina_Control_Heading' ) ) {

	/**
	 * Heading control
	 *
     * @since 1.0.0
	 */
	class Matina_Control_Heading extends WP_Customize_Control {

		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'mt-heading';

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue() {
			wp_enqueue_style( 'matina-heading-style', get_template_directory_uri() . '/inc/customizer/custom-controls/heading/heading.css', array(), '1.0.0' );
		}

		/**
		 * An Underscore (JS) template for this control's content (but not its container).
		 *
		 * Class variables for this control class are available in the `data` JS object;
		 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
		 *
		 * @see WP_Customize_Control::print_template()
		 *
		 * @access protected
		 */
		protected function content_template() {
	?>
			<h4 class="mt-customizer-heading">{{{ data.label }}}</h4>
			<div class="description">{{{ data.description }}}</div>
	<?php
		}
	}

}