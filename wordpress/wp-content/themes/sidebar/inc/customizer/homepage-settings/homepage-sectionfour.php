<?php
/**
 * Homepage Sections
 *
 */

function sidebar_customize_homepagesection_four( $config ) {

	global $sidebar_option_categories;

    Kirki::add_section( 'sidebar_homepage_section_four', array(
        'priority'   => 14,
        'capability' => 'edit_theme_options',
        'title'      => esc_html__( 'Section Four Settings', 'sidebar' ),
        'panel' =>  'sidebar_homepage_panel'
    ) );
    
    /** homepage section starts */
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'toggle',
		'settings'    => 'sidebar_homepage_section_four_ed',
		'label'       => esc_html__( 'Enable Section Four', 'sidebar' ),
		'section'     => 'sidebar_homepage_section_four',
		'default'     => '0',
		'priority'    => 10,
		'description' => esc_html__( 'Enable or Disable Section Four', 'sidebar' ),
	) );	
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'text',
		'settings'    => 'sidebar_homepage_section_four_label',
		'label'       => esc_html__( 'Section Label', 'sidebar' ),
		'section'     => 'sidebar_homepage_section_four',
		'priority'    => 10,
		'description' => esc_html__( 'Enter Heading Text For Section', 'sidebar' ),
	) );		
	
	Kirki::add_field( 'sidebar', array(
        'type'        => 'select',
        'settings'    => 'sidebar_homepage_section_four_values',
        'label'       => esc_html__( 'Select Section Four Category', 'sidebar' ),
        'section'     => 'sidebar_homepage_section_four',
        'priority'    => 15,
		'choices'     => $sidebar_option_categories,
	));	
	
    /** homepage section ends */
	

}
add_action( 'kirki_config', 'sidebar_customize_homepagesection_four' );