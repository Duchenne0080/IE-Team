<?php
/**
 * socialmedia Options
 *
 */

function sidebar_customize_socialmedia( $config ) {

    Kirki::add_section( 'sidebar_socialmedia_section', array(
        'priority'   => 14,
        'capability' => 'edit_theme_options',
        'title'      => esc_html__( 'Social Media Settings', 'sidebar' ),
        'panel' =>  'sidebar_main_panel'
    ) );
    
    /** socialmedia */
    Kirki::add_field( 'sidebar', array(
        'label'     => esc_html__( 'Social Media', 'sidebar' ),
        'section'   => 'sidebar_socialmedia_section',
        'settings'  => 'sidebar_ed_socialmedia',
        'type'      => 'toggle',
        'default'   => '1',
    ) );
	
/** Enable/Disable Social in Header */
    Kirki::add_field( 'sidebar', array(
        'type'        => 'toggle',
        'settings'    => 'sidebar_ed_socialmedia',
        'label'       => esc_html__( 'Social Links in Header', 'sidebar' ),
        'section'     => 'sidebar_socialmedia_section',
        'default'     => '',
    ) );	
   
	Kirki::add_field( 'sidebar', array(
		'type'        => 'link',
		'settings'    => 'sidebar_socialmedia_fb',
		'label'       => esc_html__( 'Facebook URL', 'sidebar' ),
		'section'     => 'sidebar_socialmedia_section',
		'priority'    => 10,
		'description' => esc_html__( 'Enter Facebook URL. Leave blank to disable it', 'sidebar' ),
	) );	    
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'link',
		'settings'    => 'sidebar_socialmedia_tw',
		'label'       => esc_html__( 'Twitter URL', 'sidebar' ),
		'section'     => 'sidebar_socialmedia_section',
		'priority'    => 10,
		'description' => esc_html__( 'Enter Twitter URL. Leave blank to disable it', 'sidebar' ),
	) );	    
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'link',
		'settings'    => 'sidebar_socialmedia_gplus',
		'label'       => esc_html__( 'Google+ URL', 'sidebar' ),
		'section'     => 'sidebar_socialmedia_section',
		'priority'    => 10,
		'description' => esc_html__( 'Enter Google+ URL. Leave blank to disable it', 'sidebar' ),
	) );	    
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'link',
		'settings'    => 'sidebar_socialmedia_insta',
		'label'       => esc_html__( 'Instagram URL', 'sidebar' ),
		'section'     => 'sidebar_socialmedia_section',
		'priority'    => 10,
		'description' => esc_html__( 'Enter Instagram URL. Leave blank to disable it', 'sidebar' ),
	) );	    
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'link',
		'settings'    => 'sidebar_socialmedia_linkedin',
		'label'       => esc_html__( 'Linkedin URL', 'sidebar' ),
		'section'     => 'sidebar_socialmedia_section',
		'priority'    => 10,
		'description' => esc_html__( 'Enter Linkedin URL. Leave blank to disable it', 'sidebar' ),
	) );	
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'link',
		'settings'    => 'sidebar_socialmedia_pin',
		'label'       => esc_html__( 'Pinterest URL', 'sidebar' ),
		'section'     => 'sidebar_socialmedia_section',
		'priority'    => 10,
		'description' => esc_html__( 'Enter Pinterest URL. Leave blank to disable it', 'sidebar' ),
	) );		    						    
	
	Kirki::add_field( 'sidebar', array(
		'type'        => 'link',
		'settings'    => 'sidebar_socialmedia_ytube',
		'label'       => esc_html__( 'Youtube URL', 'sidebar' ),
		'section'     => 'sidebar_socialmedia_section',
		'priority'    => 10,
		'description' => esc_html__( 'Enter YouTube URL. Leave blank to disable it', 'sidebar' ),
	) );		
   
    /** Social Link Ends */	
	

}
add_action( 'kirki_config', 'sidebar_customize_socialmedia' );