<?php
/**
 * Homepage Sections
 *
 */

function sidebar_customize_homepagesection_two( $config ) {

	global $sidebar_option_categories;

    Kirki::add_section( 'sidebar_homepage_section_two', array(
        'priority'   => 14,
        'capability' => 'edit_theme_options',
        'title'      => esc_html__( 'Section Two Settings', 'sidebar' ),
        'panel' =>  'sidebar_homepage_panel'
    ) );
    
    /** homepage section starts */
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'toggle',
		'settings'    => 'sidebar_homepage_section_two_ed',
		'label'       => esc_html__( 'Enable Section Two', 'sidebar' ),
		'section'     => 'sidebar_homepage_section_two',
		'default'     => '0',
		'priority'    => 10,
		'description' => esc_html__( 'Enable or Disable Section Two', 'sidebar' ),
	) );	
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'text',
		'settings'    => 'sidebar_homepage_section_two_label',
		'label'       => esc_html__( 'Section Label', 'sidebar' ),
		'section'     => 'sidebar_homepage_section_two',
		'priority'    => 10,
		'description' => esc_html__( 'Enter Heading Text For Section', 'sidebar' ),
	) );		
	
	Kirki::add_field( 'sidebar', array(
        'type'        => 'select',
        'settings'    => 'sidebar_homepage_section_two_values',
        'label'       => esc_html__( 'Select Section Two Category', 'sidebar' ),
        'section'     => 'sidebar_homepage_section_two',
        'priority'    => 15,
		'choices'     => $sidebar_option_categories,
	));	
	
    /** homepage section ends */
	

}
add_action( 'kirki_config', 'sidebar_customize_homepagesection_two' );