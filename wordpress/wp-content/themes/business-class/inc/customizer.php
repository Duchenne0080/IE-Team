<?php
/**
 * Business Class Theme Customizer.
 * This file deals with the core customizer options.
 * The other custom options are inside customizer module.
 *
 * @package business-class
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_class_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'business_class_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'business_class_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'business_class_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function business_class_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function business_class_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function business_class_customize_preview_js() {
	wp_enqueue_script( 'business-class-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'business_class_customize_preview_js' );

/**
 * This function adds some styles to the WordPress Customizer
 */
function business_class_customizer_css_fixes() {
	?>
	<style id="<?php echo esc_attr( __FUNCTION__ ); ?>">

		/* Hide the visibility toggle button in section sorter. */
		.customize-control-kirki-sortable ul.ui-sortable li .dashicons.visibility {
			display:none;
		}

		/* Use default line height for color picker button. */
		.wp-color-result-text {
			line-height: 2.54545455 !important;
		}

		/* Kirki select x icon alignment. */
		.select2-container .select2-selection--single{
			height: auto;
		}

		.select2-container--default .select2-selection--single .select2-selection__arrow{
			height: 100%;
		}

	</style>
	<?php

}
add_action( 'customize_controls_print_styles', 'business_class_customizer_css_fixes', 50 );

/**
 * Initialize the customizer module.
 */
require_once get_template_directory() . '/inc/customizer/customizer-loader.php';
