<?php
// phpcs:ignoreFile

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'business_class_customizer_get_option' ) ) {
	/**
	 * Get the value of a field.
	 * This is a deprecated function that we used when there was no API.
	 * Please use the Business_Class_Customizer::get_option() method instead.
	 * Documentation is available for the new method on https://github.com/aristath/kirki/wiki/Getting-the-values
	 *
	 * @return mixed
	 */
	function business_class_customizer_get_option( $option = '' ) {
		_deprecated_function( __FUNCTION__, '1.0.0', sprintf( esc_html__( '%1$s or %2$s', 'business-class' ), 'get_theme_mod', 'get_option' ) ); // phpcs:ignore
		return Business_Class_Customizer::get_option( '', $option );
	}
}

if ( ! function_exists( 'business_class_customizer_sanitize_hex' ) ) {
	function business_class_customizer_sanitize_hex( $color ) {
		_deprecated_function( __FUNCTION__, '1.0.0', 'ariColor::newColor( $color )->toCSS( \'hex\' )' );
		return Business_Class_Customizer_Color::sanitize_hex( $color );
	}
}

if ( ! function_exists( 'business_class_customizer_get_rgb' ) ) {
	function business_class_customizer_get_rgb( $hex, $implode = false ) {
		_deprecated_function( __FUNCTION__, '1.0.0', 'ariColor::newColor( $color )->toCSS( \'rgb\' )' );
		return Business_Class_Customizer_Color::get_rgb( $hex, $implode );
	}
}

if ( ! function_exists( 'business_class_customizer_get_rgba' ) ) {
	function business_class_customizer_get_rgba( $hex = '#fff', $opacity = 100 ) {
		_deprecated_function( __FUNCTION__, '1.0.0', 'ariColor::newColor( $color )->toCSS( \'rgba\' )' );
		return Business_Class_Customizer_Color::get_rgba( $hex, $opacity );
	}
}

if ( ! function_exists( 'business_class_customizer_get_brightness' ) ) {
	function business_class_customizer_get_brightness( $hex ) {
		_deprecated_function( __FUNCTION__, '1.0.0', 'ariColor::newColor( $color )->lightness' );
		return Business_Class_Customizer_Color::get_brightness( $hex );
	}
}

if ( ! function_exists( 'Business_Class_Customizer' ) ) {
	function Business_Class_Customizer() {
		return business_class_customizer();
	}
}
