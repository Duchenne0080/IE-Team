<?php
/**
 * Customizer Dropdown Categories Control.
 * 
 * @package Matina
 *
 * @see   		https://github.com/aristath/kirki
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Matina_Control_Dropdown_Categories' ) ) :


	/**
	 * Dropdown categories control
	 *
	 * @since 1.0.0
	 */
	class Matina_Control_Dropdown_Categories extends WP_Customize_Control {

		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'mt-dropdown-categories';

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue() {
			wp_enqueue_script( 'mt-dropdown-categories', get_template_directory_uri() . '/inc/customizer/custom-controls/dropdown-categories/dropdown-categories.js', array( 'jquery', 'customize-base' ), false, true );
		}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			if ( isset( $this->default ) ) {
				$this->json['default'] = $this->default;
			} else {
				$this->json['default'] = $this->setting->default;
			}
			$this->json['value']       = $this->value();
			$this->json['choices']     = $this->choices;
			$this->json['link']        = $this->get_link();
			$this->json['id']          = $this->id;

			$dropdown = wp_dropdown_categories(
				array(
					'name'              => '_customize-dropdown-pages-' . esc_attr( $this->id ),
					'echo'              => '0',
					'show_option_none'  => '&mdash; '. esc_html__( 'Select Category', 'matina' ) .' &mdash;',
					'option_none_value' => '0',
					'selected'          => esc_attr( $this->value() ),
					'show_count'		=> 1,
					'hierarchical'		=> 1
				)
			);

			// Hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

			$this->json['dropdown'] = $dropdown;

			$this->json['inputAttrs'] = '';
			foreach ( $this->input_attrs as $attr => $value ) {
				$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
			}

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
			<label>
				<# if ( data.label ) { #>
					<span class="customize-control-title">{{{ data.label }}}</span>
				<# } #>
				<# if ( data.description ) { #>
					<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } #>
				<div class="customize-control-content">{{{ data.dropdown }}}</div>
			</label>
			<?php
		}
	}

endif;
