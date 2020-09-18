<?php
/**
 * Customizer Color Alpha Control.
 * 
 * @package Matina
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Matina_Control_Color' ) ){

    /**
     * Alpha Color control
     *
     * @since 1.0.0
     */
    class Matina_Control_Color extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */

        public $type = 'mt-alpha-color';

        public $tooltip = '';

        /**
         * Add support for palettes to be passed in.
         *
         * Supported palette values are true, false, or an array of RGBa and Hex colors.
         *
         * @var bool
         */
        public $palette;

        /**
         * Add support for showing the opacity value on the slider handle.
         *
         * @var array
         */
        public $show_opacity;

        /**
         * Enqueue control related scripts/styles.
         *
         * @access public
         */
        public function enqueue() {
            wp_enqueue_script( 'matina-alpha-color-picker-script', get_template_directory_uri() . '/inc/customizer/custom-controls/color-alpha/color-alpha-picker.min.js', array( 'jquery', 'wp-color-picker', 'customize-controls' ), false, true );
            
            wp_enqueue_style( 'matina-alpha-color-picker-style', get_template_directory_uri() . '/inc/customizer/custom-controls/color-alpha/color-alpha-picker.min.css', array( 'wp-color-picker' ), '1.0.0' );
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();

            if ( isset( $this->default ) ) {
                $this->json['default']  = $this->default;
            } else {
                $this->json['default']  = $this->setting->default;
            }

            // Process the palette
            if ( is_array( $this->palette ) ) {
                $this->json['palette'] = implode( '|', $this->palette );
            } else {
                // Default to true.
                $this->json['palette'] = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
            }

            $this->json['show_opacity'] = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
            $this->json['value']        = $this->value();
            $this->json['link']         = $this->get_link();
            $this->json['id']           = $this->id;
            $this->json['tooltip']      = $this->tooltip;

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
                <# if ( data.tooltip ) { #>
                    <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
                <# } #>

                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{{ data.label }}}</span>
                <# } #>
                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>
                <div>
                    <input class="alpha-color-control" type="text"  value="{{ data.value }}" data-show-opacity="{{ data.show_opacity }}" data-palette="{{ data.palette }}" data-default-color="{{ data.default }}" {{{ data.link }}} />
                </div>
            </label>
            
    <?php
        }
    }

}