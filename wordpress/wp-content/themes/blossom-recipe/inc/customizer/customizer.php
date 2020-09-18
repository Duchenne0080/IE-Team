<?php
/**
 * Blossom Recipe Theme Customizer
 *
 * @package Blossom_Recipe
 */

/**
 * Requiring customizer panels & sections
*/
$blossom_recipe_panels = array( 'info', 'site', 'layout', 'general', 'footer' );

foreach( $blossom_recipe_panels as $p ){
    require get_template_directory() . '/inc/customizer/' . $p . '.php';
}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Active Callbacks
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blossom_recipe_customize_preview_js() {
	wp_enqueue_script( 'blossom-recipe-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), BLOSSOM_RECIPE_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'blossom_recipe_customize_preview_js' );

function blossom_recipe_customize_script(){    
    wp_enqueue_style( 'blossom-recipe-customize', get_template_directory_uri() . '/inc/css/customize.css', array(), BLOSSOM_RECIPE_THEME_VERSION );
    wp_enqueue_script( 'blossom-recipe-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), BLOSSOM_RECIPE_THEME_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'blossom_recipe_customize_script' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-recommend.php';