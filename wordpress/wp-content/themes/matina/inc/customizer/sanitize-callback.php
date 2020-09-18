<?php
/**
 * Customizer Sanitize functions.
 *
 * @package Matina
 */

if ( ! function_exists( 'matina_sanitize_repeater' ) ) :

    /**
     * Sanitize repeater value
     *
     * @param  json $input Customizer setting input repeater json.
     * @param  object       $setting Setting Object.
     * @return array        Return array.
     *
     * @since 1.0.0
     */
    function matina_sanitize_repeater( $input, $setting ) {
        $input_decoded = json_decode( $input, true );
            
        if ( !empty( $input_decoded ) ) {
            foreach ( $input_decoded as $boxes => $box ) {
                foreach ( $box as $key => $value ) {
                    if ( $key == 'mt_select_pages' || $key == 'mt_select_field' ) {
                        $input_decoded[$boxes][$key] = sanitize_key( $value );
                    } elseif ( $key == 'url' || $key == 'mt_item_upload' || $key == 'mt_item_link' ) {
                        $input_decoded[$boxes][$key] = esc_url_raw( $value );
                    } else {
                        $input_decoded[$boxes][$key] = wp_kses_post( $value );
                    }
                }
            }
            return $input_decoded;
        }
        
        return $input;
    }

endif;

if ( ! function_exists( 'matina_sanitize_float_value' ) ) :

    /**
     * Sanitize float value.
     * @param  number $input Customizer setting input number.
     * @return float          Return float number.
     *
     * @since 1.0.0
     */
    function matina_sanitize_float_value( $input ) {

        $input = floatval( $input );

        return $input;

    }

endif;

if ( ! function_exists( 'matina_sanitize_title_field' ) ) :

    /**
     * Sanitize title field.
     *
     * @param string $input     The string prior to being sanitized.
     * @return string           Sanitize string with wp_kses_post.
     *
     * @since 1.0.0
     *
     */
    function matina_sanitize_title_field( $input ) {

        $input = wp_kses_post( $input );

        return $input;

    }

endif;

if ( ! function_exists( 'matina_sanitize_textarea' ) ) :

    /**
     * Sanitize textarea value.
     *
     * @param string $input     The string prior to being sanitized.
     * @return string           Sanitize string with wp_kses_post.
     *
     * @since 1.0.0
     *
     */
    function matina_sanitize_textarea( $input ) {

        $input = wp_kses_post( $input );

        return $input;

    }

endif;

if ( ! function_exists( 'matina_sanitize_checkbox' ) ) :

    /**
	 * Sanitize checkbox.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
     *
     * @since 1.0.0
	 */
	function matina_sanitize_checkbox( $checked ) {

		return ( ( isset( $checked ) && true === $checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'matina_sanitize_select' ) ) :
    
	/**
	 * Sanitize select.
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
     *
     * @since 1.0.0
	 */
	function matina_sanitize_select( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

endif;

if ( ! function_exists( 'matina_sanitize_image' ) ) :

	/**
	 * Image sanitization callback
	 *
	 * @since 1.0.0
	 */
	function matina_sanitize_image( $image, $setting ) {
		/*
		 * Array of valid image file types.
		 *
		 * The array includes image mime types that are included in wp_get_mime_types()
		 */
	    $mimes = array(
	        'jpg|jpeg|jpe' => 'image/jpeg',
	        'gif'          => 'image/gif',
	        'png'          => 'image/png',
	        'bmp'          => 'image/bmp',
	        'tif|tiff'     => 'image/tiff',
	        'ico'          => 'image/x-icon'
	    );
		// Return an array with file extension and mime_type.
	    $file = wp_check_filetype( $image, $mimes );
		// If $image has a valid mime_type, return it; otherwise, return the default.
	    return ( $file['ext'] ? esc_url_raw( $image ) : $setting->default );
	}

endif;

if ( ! function_exists( 'matina_sanitize_alpha_color' ) ) :

	/**
	 * Alpha Color sanitization callback
	 *
	 * @since 1.0.0
	 */
	function matina_sanitize_alpha_color( $color ) {
	    if ( empty( $color ) || is_array( $color ) ) {
	        return '';
	    }

	    // If string does not start with 'rgba', then treat as hex.
	    // sanitize the hex color and finally convert hex to rgba
	    if ( false === strpos( $color, 'rgba' ) ) {
	        return sanitize_hex_color( $color );
	    }

	    // By now we know the string is formatted as an rgba color so we need to further sanitize it.
	    $color = str_replace( ' ', '', $color );
	    sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

	    return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
	}
	
endif;

if ( ! function_exists( 'matina_sanitize_multi_choices' ) ) :

    /**
     * Select choices sanitization callback
     *
     * @since 1.0.0
     */
    function matina_sanitize_multi_choices( $input, $setting ) {
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;
        $input_keys = $input;

        foreach ( $input_keys as $key => $value ) {
            if ( ! array_key_exists( $value, $choices ) ) {
                unset( $input[ $key ] );
            }
        }

        // If the input is a valid key, return it;
        // otherwise, return the default.
        return ( is_array( $input ) ? $input : $setting->default );
    }

endif;

if ( ! function_exists( 'matina_sanitize_number' ) ) :
    
    /**
     * Number sanitization callback
     *
     * @since 1.0.0
     */
    function matina_sanitize_number( $input ) {
        return is_numeric( $input ) ? $input : 0;
    }

endif;

if ( ! function_exists( 'matina_sanitize_multicheck' ) ) :

    /**
     * Multicheck sanitization callback
     *
     * @param array          $input The value to sanitize.
     * @return array
     * @since 1.0.0
     */
    function matina_sanitize_multicheck( $input ) {
        $multi_values = ! is_array( $input ) ? explode( ',', $input ) : $input;
        return ! empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
    }

endif;

