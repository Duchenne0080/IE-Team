<?php
/**
 * Homepage Sections
 *
 */
function sidebar_customize_homepagesection_one( $config ) {

	global $sidebar_option_categories;

    Kirki::add_section( 'sidebar_homepage_section_one', array(
        'priority'   => 14,
        'capability' => 'edit_theme_options',
        'title'      => esc_html__( 'Section One Settings', 'sidebar' ),
        'panel' =>  'sidebar_homepage_panel'
    ) );
    
    /** homepage section starts */
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'toggle',
		'settings'    => 'sidebar_homepage_section_one_ed',
		'label'       => esc_html__( 'Enable Section One', 'sidebar' ),
		'section'     => 'sidebar_homepage_section_one',
		'default'     => '0',
		'priority'    => 10,
		'description' => esc_html__( 'Enable or Disable Section One', 'sidebar' ),
	) );	
	
	Kirki::add_field( 'sidebar', array(
        'type'        => 'select',
        'settings'    => 'sidebar_homepage_section_one_values',
        'label'       => esc_html__( 'Select Section One Category', 'sidebar' ),
        'section'     => 'sidebar_homepage_section_one',
        'priority'    => 15,
		'choices'     => $sidebar_option_categories,
	));	
	
    /** homepage section ends */
	

}
add_action( 'kirki_config', 'sidebar_customize_homepagesection_one' );