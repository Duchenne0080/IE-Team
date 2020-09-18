<?php
/**
 * Homepage Sections
 *
 */

function sidebar_customize_homepagesection_three( $config ) {

	global $sidebar_option_categories;

    Kirki::add_section( 'sidebar_homepage_section_three', array(
        'priority'   => 14,
        'capability' => 'edit_theme_options',
        'title'      => esc_html__( 'Section Three Settings', 'sidebar' ),
        'panel' =>  'sidebar_homepage_panel'
    ) );
    
    /** homepage section starts */
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'toggle',
		'settings'    => 'sidebar_homepage_section_three_ed',
		'label'       => esc_html__( 'Enable Section Three', 'sidebar' ),
		'section'     => 'sidebar_homepage_section_three',
		'default'     => '0',
		'priority'    => 10,
		'description' => esc_html__( 'Enable or Disable Section Three', 'sidebar' ),
	) );	
	
	Kirki::add_field( 'sidebar', array(
        'type'        => 'select',
        'settings'    => 'sidebar_homepage_section_three_values',
        'label'       => esc_html__( 'Select Section Three Category', 'sidebar' ),
        'section'     => 'sidebar_homepage_section_three',
        'priority'    => 15,
		'choices'     => $sidebar_option_categories,
	));	
	
    /** homepage section ends */
	

}
add_action( 'kirki_config', 'sidebar_customize_homepagesection_three' );