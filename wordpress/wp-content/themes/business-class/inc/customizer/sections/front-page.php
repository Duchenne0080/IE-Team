<?php
/**
 * This has the required codes for creating sections in front-page panel.
 *
 * @package business-class/customizer/sections
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$panel_name = 'front_page';
$sections   = array(
	'Banner Slider'  => array(
		'section_title' => __( 'Banner Slider', 'business-class' ),
		'description'   => __( 'Customize the appearance of banner slider on frontpage.', 'business-class' ),
	),
	'Why Choose Us'  => array(
		'section_title' => __( 'Why Choose Us', 'business-class' ),
		'description'   => __( 'Customize the appearance of Why Choose Us section on frontpage.', 'business-class' ),
	),
	'Recent Works'   => array(
		'section_title' => __( 'Recent Works', 'business-class' ),
		'description'   => __( 'Customize the appearance of Recent Works section on frontpage.', 'business-class' ),
	),
	'Our Team'       => array(
		'section_title' => __( 'Our Team', 'business-class' ),
		'description'   => __( 'Customize the appearance of Our Team section on frontpage.', 'business-class' ),
	),
	'Our Blogs'      => array(
		'section_title' => __( 'Our Blogs', 'business-class' ),
		'description'   => __( 'Customize the appearance of Our Blogs section on frontpage.', 'business-class' ),
	),
	'Call To Action' => array(
		'section_title' => __( 'Call To Action', 'business-class' ),
		'description'   => __( 'Customize the appearance of Call To Action section on frontpage.', 'business-class' ),
	),
	'Testimonials'   => array(
		'section_title' => __( 'Testimonials', 'business-class' ),
		'description'   => __( 'Customize the appearance of Testimonials section on frontpage.', 'business-class' ),
	),
	'Contact Us'     => array(
		'section_title' => __( 'Contact Us', 'business-class' ),
		'description'   => __( 'Customize the appearance of Contact Us section on frontpage.', 'business-class' ),
	),
	'Pre Footer'     => array(
		'section_title' => __( 'Pre Footer', 'business-class' ),
		'description'   => __( 'Customize the appearance of Pre Footer section on frontpage.', 'business-class' ),
	),
);

if ( is_array( $sections ) && count( $sections ) > 0 ) {
	foreach ( $sections as $section_id => $sections_args ) {
		$section_title = ! empty( $sections_args['section_title'] ) ? $sections_args['section_title'] : '';
		$description   = ! empty( $sections_args['description'] ) ? $sections_args['description'] : '';
		Business_Class_Customizer::add_section(
			business_class_get_customizer_section_id( $panel_name, $section_id ),
			array(
				'title'       => $section_title,
				'description' => $description,
				'panel'       => business_class_get_customizer_panel_id( $panel_name ),
				'priority'    => 160,
			)
		);
	}
}
