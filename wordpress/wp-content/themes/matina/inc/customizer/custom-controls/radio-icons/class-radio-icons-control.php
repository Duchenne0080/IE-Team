<?php
/**
 * Customizer Radio Icons Control.
 * 
 * @package Matina
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Matina_Control_Radio_Icons' ) ) {
    
    /**
     * Radio Icons control (modified radio).
     *
     * @since 1.0.0
     */
    class Matina_Control_Radio_Icons extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'mt-radio-icons';
        
        public $tooltip = '';
        
        public function to_json() {
            parent::to_json();
            
            if ( isset( $this->default ) ) {
                $this->json['default'] = $this->default;
            } else {
                $this->json['default'] = $this->setting->default;
            }
            
            $this->json['value']   = $this->value();
            $this->json['link']    = $this->get_link();
            $this->json['id']      = $this->id;
            $this->json['tooltip'] = $this->tooltip;
            $this->json['choices'] = $this->choices;
        }
        
        public function enqueue() {            
            wp_enqueue_style( 'matina-radio-icons-style', get_template_directory_uri() . '/inc/customizer/custom-controls/radio-icons/radioicons.css', null );
            wp_enqueue_script( 'matina-radio-icons-script', get_template_directory_uri() . '/inc/customizer/custom-controls/radio-icons/radioicons.js', array( 'jquery' ), false, true );
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

            <# if ( data.tooltip ) { #>
                <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
            <# } #>
            <label class="customizer-text">
                <# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
                <# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><# } #>
            </label>
            <div id="input_{{ data.id }}" class="radio-icons">
                <# for ( key in data.choices ) { #>
                    <label>
                        <input class="icon-select" type="radio" value="{{ key }}" name="_customize-icon-select-{{ data.id }}" {{{ data.link }}}<# if ( data.value === key ) { #> checked<# } #> />
                        <span class="icon-select-label"><i class="{{ key }}"></i></span>
                    </label>
                <# } #>
            </div>
    <?php
        }

    }

}