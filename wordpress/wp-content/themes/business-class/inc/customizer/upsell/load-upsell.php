<?php
/**
 * Loads the upsell button in customizer.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Loads upsell scripts when customizer loads.
 */
function business_class_load_upsell_scripts() {
	wp_enqueue_style( 'business-class-upsell', get_template_directory_uri() . '/inc/customizer/upsell/lib/upgrade.css', array(), '1.0.0', 'all' );
	wp_enqueue_script( 'business-class-upsell', get_template_directory_uri() . '/inc/customizer/upsell/lib/upgrade.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'business_class_load_upsell_scripts' );



/**
 * Load upsell.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_class_load_upsell( $wp_customize ) {

	require_once get_template_directory() . '/inc/customizer/upsell/lib/class-business-class-customizer-upsell.php';

	if ( class_exists( 'Business_Class_Customizer_Upsell' ) ) {
		$wp_customize->register_section_type( 'Business_Class_Customizer_Upsell' );

		$wp_customize->add_section(
			new Business_Class_Customizer_Upsell(
				$wp_customize,
				'business_class_pro',
				array(
					'title'       => esc_html__( 'Business Class Pro', 'business-class' ),
					'button_text' => esc_html__( 'Buy Pro', 'business-class' ),
					'button_url'  => 'https://bunnytemplates.com/downloads/business-class-pro',
					'priority'    => 1,
				)
			)
		);
	}

}
add_action( 'customize_register', 'business_class_load_upsell' );
