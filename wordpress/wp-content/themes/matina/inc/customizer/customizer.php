<?php
/**
 * Matina Theme Customizer
 *
 * @package Matina
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function matina_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->register_section_type( 'Matina_Section_Upsell' );

    /**
     * Register theme upsell sections.
     *
     * @since 1.0.2
     */
    $wp_customize->add_section( new Matina_Section_Upsell(
        $wp_customize,
            'matina_theme_upsell',
            array(
                'title'    	=> esc_html__( 'Matina Pro', 'matina' ),
                'pro_text' 	=> esc_html__( 'Buy Now', 'matina' ),
                'pro_url'  	=> 'https://mysterythemes.com/wp-themes/matina-pro/',
                'priority' 	=> 1,
            )
        )
    );
}
add_action( 'customize_register', 'matina_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function matina_customize_preview_js() {

	wp_enqueue_script( 'matina-customizer', get_template_directory_uri() . '/inc/customizer/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'matina_customize_preview_js' );

/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function matina_customize_backend_scripts() {
 	
    global $matina_theme_version;

	wp_enqueue_style( 'mt-font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/all.min.css', '', '5.10.2', 'all' );

	wp_enqueue_style( 'mt-extend-customizer', get_template_directory_uri() . '/inc/customizer/assets/css/mt-extend-customizer.min.css', array(), esc_attr( $matina_theme_version ) );

	wp_enqueue_script( 'mt-extend-customizer', get_template_directory_uri(). '/inc/customizer/assets/js/mt-extend-customizer.min.js', array('jquery'), esc_attr( $matina_theme_version ), true );

	wp_enqueue_style( 'mt-theme-upsell-style', get_template_directory_uri() . '/inc/customizer/custom-controls/theme-upsell/theme-upsell.css', null );
    
    wp_enqueue_script( 'mt-theme-upsell-script', get_template_directory_uri() . '/inc/customizer/custom-controls/theme-upsell/theme-upsell.js', array( 'jquery' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'matina_customize_backend_scripts', 10 );

/**
 * Load required customizer files
 *
 */

require get_template_directory(). '/inc/customizer/extend-customizer/class-mt-customize-panel.php';
require get_template_directory(). '/inc/customizer/extend-customizer/class-mt-customize-section.php';
require get_template_directory(). '/inc/customizer/custom-controls/custom-controls.php';
require get_template_directory(). '/inc/customizer/active-callback.php';
require get_template_directory(). '/inc/customizer/sanitize-callback.php';
require get_template_directory(). '/inc/customizer/customizer-helper.php';

require get_template_directory(). '/inc/customizer/mt-sections-and-panels.php';

$matina_sub_sections = array(
	'general'		=> array( 'site-layout', 'preloader', 'colors', 'featured-image', 'social', 'typography', 'error-page', 'scroll' ),
	'header'		=> array( 'top', 'site-identity', 'main', 'media', 'style', 'pagetitle' ),
	'homepage'		=> array( 'banner', 'featured' ),
	'blog'			=> array( 'blog-archive', 'single', 'single-page' ),
	'footer'		=> array( 'style', 'main', 'bottom' )
);

foreach ( $matina_sub_sections as $key => $value ) {
	foreach ( $value as $k => $v ) {
		require get_template_directory() . '/inc/customizer/sections/'. $key . '/' . $v .'.php';
	}
}