<?php
/**
 * Customizer Radio Image Control.
 * 
 * @package Matina
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Matina_Control_Radio_Image' ) ) {
    
    /**
	 * Radio Image control (modified radio).
     *
     * @since 1.0.0
     */
	class Matina_Control_Radio_Image extends WP_Customize_Control {

        /**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'mt-radio-image';
        
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
						
            $this->json['inputAttrs'] = '';
			foreach ( $this->input_attrs as $attr => $value ) {
				$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
			}
		}
        
        public function enqueue() {            
            wp_enqueue_style( 'matina-radio-image-style', get_template_directory_uri() . '/inc/customizer/custom-controls/radio-image/radioimage.css', null );
            wp_enqueue_script( 'matina-radio-image-script', get_template_directory_uri() . '/inc/customizer/custom-controls/radio-image/radioimage.js', array( 'jquery' ), false, true );
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
            <div id="input_{{ data.id }}" class="image">
                <# for ( key in data.choices ) { #>
                    <# dataAlt = ( _.isObject( data.choices[ key ] ) && ! _.isUndefined( data.choices[ key ].alt ) ) ? data.choices[ key ].alt : '' #>
                    <input {{{ data.inputAttrs }}} class="image-select" type="radio" value="{{ key }}" name="_customize-radio-{{ data.id }}" id="{{ data.id }}{{ key }}" {{{ data.link }}}<# if ( data.value === key ) { #> checked="checked"<# } #> data-alt="{{ dataAlt }}" />
                        <label for="{{ data.id }}{{ key }}" {{{ data.labelStyle }}} class="{{{ data.id + key }}}">
                            <# if ( _.isObject( data.choices[ key ] ) ) { #>
                                <img src="{{ data.choices[ key ].src }}" title="{{ data.choices[ key ].title }}" alt="{{ data.choices[ key ].alt }}">
                                
                            <# } else { #>
                                <img src="{{ data.choices[ key ] }}">
                            <# } #>
                            <span class="radio-label">{{ data.choices[ key ].title }}</span>
                        </label>
                <# } #>
            </div>
	<?php
		}

    }

}