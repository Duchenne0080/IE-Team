<?php
/**
 * Homepage Settings panel on the customizer
 * 
 *  @package sidebar
 */

function sidebar_theme_panel() {
    /**
     * Add a main panel for other panels	 
     */
    Kirki::add_panel('sidebar_main_panel', array(
        'title' =>  esc_html__( 'Theme Options', 'sidebar' ),
        'description'   =>  esc_html__( 'Panel for the custom theme options', 'sidebar' )
    ));

    /**
     * Homepage Panel
     */
    Kirki::add_panel('sidebar_homepage_panel', array(
        'title' =>  esc_html__( 'Custom Homepage Options', 'sidebar' ),
        'description'   =>  esc_html__( 'Panel for the Theme homepage', 'sidebar' ),
        'panel' =>  'sidebar_main_panel'
    ));
}

 $custom_sections = array( 
    'sectionone',
    'sectiontwo',
    'sectionthree',
    'sectionfour',			
     );

 foreach( $custom_sections as $section ) {
     get_template_part('inc/customizer/homepage-settings/homepage', $section);
 }


add_action( 'kirki_config', 'sidebar_theme_panel' );