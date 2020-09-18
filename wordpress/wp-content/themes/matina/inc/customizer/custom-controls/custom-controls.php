<?php
/**
 * Define path for required files for Custom Control
 * 
 * @package Matina
*/

if ( ! function_exists( 'matina_register_custom_controls' ) ) :
    
    /**
     * Register Custom Controls
     * 
     * @since 1.0.0
    */
    function matina_register_custom_controls( $wp_customize ) {
        
        // Load our custom control.
        require_once get_template_directory() . '/inc/customizer/custom-controls/toggle/class-toggle-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/repeater/class-repeater-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/radio-image/class-radio-image-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/color-alpha/class-color-alpha-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/range/class-range-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/buttonset/class-buttonset-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/heading/class-heading-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/typography/class-typography-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/radio-icons/class-radio-icons-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/dropdown-categories/class-dropdown-categories-control.php';
        require_once get_template_directory() . '/inc/customizer/custom-controls/multicheck/class-multicheck-control.php';
        
        // Register the control type.
        $wp_customize->register_control_type( 'Matina_Control_Toggle' );
        $wp_customize->register_control_type( 'Matina_Control_Radio_Image' );
        $wp_customize->register_control_type( 'Matina_Control_Color' );
        $wp_customize->register_control_type( 'Matina_Control_Range' );
        $wp_customize->register_control_type( 'Matina_Control_Buttonset' );
        $wp_customize->register_control_type( 'Matina_Control_Heading' );

        $wp_customize->register_control_type( 'Matina_Control_Typography' );
        $wp_customize->register_control_type( 'Matina_Control_Radio_Icons' );
        $wp_customize->register_control_type( 'Matina_Control_Dropdown_Categories' );
        $wp_customize->register_control_type( 'Matina_Control_Multicheck' );
    }

endif;

add_action( 'customize_register', 'matina_register_custom_controls' );

// Load theme upsell section
require_once get_template_directory() . '/inc/customizer/custom-controls/theme-upsell/class-theme-upsell-section.php';