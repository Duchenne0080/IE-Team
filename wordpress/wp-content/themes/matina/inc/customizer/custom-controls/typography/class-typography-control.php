<?php
/**
 * Customizer Typography Control.
 * 
 * @package Matina
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Matina_Control_Typography' ) ){

    /**
     * Custom class for typography
     *
     * @since 1.0.0
     */
    class Matina_Control_Typography extends WP_Customize_Control {
    
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'mt-typography';

        /**
         * Array 
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $l10n = array();

        /**
         * Set up our control.
         *
         * @since  1.0.0
         * @access public
         * @param  object  $manager
         * @param  string  $id
         * @param  array   $args
         * @return void
         */
        public function __construct( $manager, $id, $args = array() ) {

            // Let the parent class do its thing.
            parent::__construct( $manager, $id, $args );

            // Make sure we have labels.
            $this->l10n = wp_parse_args(
                $this->l10n,
                array(
                    'family'    => esc_html__( 'Font Family', 'matina' ),
                    'style'     => esc_html__( 'Font Weight/Style', 'matina' )
                )
            );
        }

        /**
         * Enqueue scripts/styles.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {

            wp_enqueue_script( 'matina-google-webfont', get_template_directory_uri() . '/inc/customizer/custom-controls/typography/webfontloader.min.js', array( 'jquery' ) );

            wp_enqueue_style( 'matina-select2-style', get_template_directory_uri() . '/inc/customizer/custom-controls/typography/select2.min.css', null );
            
            wp_enqueue_script( 'matina-select2-script', get_template_directory_uri() . '/inc/customizer/custom-controls/typography/select2.min.js', array( 'jquery' ), '4.0.13', true );

            wp_enqueue_script( 'matina-typography-script', get_template_directory_uri() . '/inc/customizer/custom-controls/typography/typography.js', array( 'jquery', 'matina-select2-script' ), false, true );

            wp_enqueue_script( 'matina-typo-ajax-script', get_template_directory_uri() . '/inc/customizer/custom-controls/typography/typo-ajax.js', array( 'jquery', 'matina-select2-script', 'jquery-ui-slider' ), false, true );
            
            wp_localize_script( 'matina-typo-ajax-script', 'ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
        }

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();

            // Loop through each of the settings and set up the data for it.
            foreach ( $this->settings as $setting_key => $setting_id ) {
                $this->json[ $setting_key ] = array(
                    'link'  => $this->get_link( $setting_key ),
                    'value' => $this->value( $setting_key ),
                    'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
                );

                if ( 'family' === $setting_key ) {
                    $this->json[ $setting_key ]['choices'] = $this->get_font_families();
                } elseif ( 'style' === $setting_key ) {
                    $this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();
                }
            }


        }

        /**
         * Underscore JS template to handle the control's output.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function content_template() {
        ?>

        <# if ( data.label ) { #>
            <span class="customize-control-title">{{ data.label }}</span>
        <# } #>

        <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

        <ul>

        <# if ( data.family && data.family.choices ) { #>

            <li class="typography-font-family">

            <# if ( data.family.label ) { #>
                <span class="customize-control-title">{{ data.family.label }}</span>
            <# } #>

                <select {{{ data.family.link }}} id="{{ data.section }}" class="typography_face customize-control-select2">

                <# _.each( data.family.choices, function( label, choice ) { #>
                    <option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                <# } ) #>

                </select>
            </li>
        <#  } #>

        <# if ( data.style && data.style.choices ) { #>

            <li class="typography-font-style">

            <# if ( data.style.label ) { #>
                <span class="customize-control-title">{{ data.style.label }}</span>
            <# } #>

                <select {{{ data.style.link }}}>

                <# _.each( data.style.choices, function( label, choice ) { #>
                    <option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                <# } ) #>

                </select>
            </li>
        <#  } #>

        <# if ( data.text_transform && data.text_transform.choices ) { #>

            <li class="typography-text-transform">

            <# if ( data.text_transform.label ) { #>
                <span class="customize-control-title">{{ data.text_transform.label }}</span>
            <# } #>

                <select {{{ data.text_transform.link }}} id="p_typography_text_transform" class="typography_text_transform">

                    <# _.each( data.text_transform.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.text_transform.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                    <# } ) #>

                </select>
            </li>
        <# } #>

        <# if ( data.text_decoration && data.text_decoration.choices ) { #>

            <li class="typography-text-decoration">

            <# if ( data.text_decoration.label ) { #>
                <span class="customize-control-title">{{ data.text_decoration.label }}</span>
            <# } #>

                <select {{{ data.text_decoration.link }}} id="p_typography_text_decoration" class="typography_text_decoration">

                    <# _.each( data.text_decoration.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.text_decoration.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                    <# } ) #>

                </select>
            </li>
        <#  } #>

        <# if ( data.size ) { #>

            <li class="typography-font-size">

            <# if ( data.size.label ) { #>
                <span class="customize-control-title">{{ data.size.label }} </span>
            <# } #>

                <span class="slider-value-size"></span>px
                <input type="hidden" {{{ data.size.link }}} value="{{ data.size.value }}" />
                <div class="slider-range-size" value="{{ data.size.value }}" ></div>

            </li>
        <#  } #>

        <# if ( data.line_height ) { #>

            <li class="typography-line-height">

            <# if ( data.line_height.label ) { #>
                <span class="customize-control-title">{{ data.line_height.label }}</span>
            <# } #>

                <span class="slider-value-line-height"></span>
                <input type="hidden" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />
                <div class="slider-range-line-height" value="{{ data.line_height.value }}"></div>
          
            </li>
        <#  } #>

        <# if ( data.px_line_height ) { #>

            <li class="typography-line-height">

            <# if ( data.px_line_height.label ) { #>
                <span class="customize-control-title">{{ data.px_line_height.label }}</span>
            <# } #>

                <span class="slider-value-size"></span>px
                <div class="slider-range-size" {{{ data.px_line_height.link }}} value="{{ data.px_line_height.value }}"  ></div>
          
            </li>
        <#  } #>

        <# if ( data.typocolor ) { #>

            <li class="typography-color">
                <# if ( data.typocolor.label ) { #>
                    <span class="customize-control-title">{{{ data.typocolor.label }}}</span>
                <# } #>

                    <div class="customize-control-content">
                        <input class="color-picker-hex" type="text" maxlength="7" placeholder="<?php esc_attr_e( 'Hex Value', 'matina' ); ?>" {{{ data.typocolor.link }}} value="{{ data.typocolor.value }}"  />
                    </div>
            </li>
        <#  } #>

        </ul>
        <?php }

        /**
         * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
         *
         * @todo Integrate with Google fonts.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        public function get_fonts() { return array(); }

        /**
         * Returns the available font families.
         *
         * @todo Pull families from `get_fonts()`.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        function get_font_families() {

            $mt_google_fonts_file = apply_filters( 'matina_google_fonts_json_file', get_template_directory() . '/inc/customizer/custom-controls/typography/mt-google-fonts.json' );

            if ( ! file_exists( get_template_directory() . '/inc/customizer/custom-controls/typography/mt-google-fonts.json' ) ) {

                $google_fonts = array();
                return $google_fonts;
            }

            global $wp_filesystem;
            WP_Filesystem();

            $get_file_content   = $wp_filesystem->get_contents( $mt_google_fonts_file );
            $get_google_fonts   = json_decode( $get_file_content, 1 );

            foreach ( $get_google_fonts as $key => $font ) {
                $name = key( $font );
                foreach ( $font[ $name ] as $font_key => $single_font ) {

                    if ( 'variants' === $font_key ) {

                        foreach ( $single_font as $variant_key => $variant ) {

                            if ( 'regular' == $variant ) {
                                $font[ $name ][ $font_key ][ $variant_key ] = '400';
                            }
                        }
                    }

                    $google_fonts[ $name ] = array_values( $font[ $name ] );
                }
            }

            $matina_google_font = get_option( 'matina_google_font' );
            if ( empty( $matina_google_font ) || $google_fonts != $matina_google_font ) {
                update_option( 'matina_google_font', $google_fonts );
                $matina_google_font = get_option( 'matina_google_font' );
            }

            foreach ( $matina_google_font as $key => $value ) {
                $mt_fonts[esc_attr( $key )] = esc_html( $key );
            }

            return $mt_fonts;
        }

        /**
         * Returns the available font weights.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        public function get_font_weight_choices() {

            if ( $this->settings['family']->id ) {
                $matina_font_list = get_option( 'matina_google_font' );

                $font_family_id = $this->settings['family']->id;
                $default_font_family = $this->settings['family']->default;
                $get_font_family = get_theme_mod( $font_family_id, $default_font_family );

                $variants_array = $matina_font_list[$get_font_family]['0'];
                

                if ( is_array( $variants_array ) ) {
                    $options_array = array();
                    foreach ( $variants_array  as $variants ) {
                        $options_array[$variants] = matina_convert_font_variants( $variants );
                    }
                    return $options_array;
                } else {
                    return array(
                      '400' => esc_html__( 'Normal 400', 'matina' ),
                      '700' => esc_html__( 'Bold 700', 'matina' ),
                    );
                }
            } else {
                return array(
                  '400' => esc_html__( 'Normal 400', 'matina' ),
                  '700' => esc_html__( 'Bold 700', 'matina' ),
                );
            }
        }       
    }
}