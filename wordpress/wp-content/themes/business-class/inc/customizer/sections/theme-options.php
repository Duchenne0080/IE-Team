<?php
/**
 * This has the required codes for creating sections in theme-options panel.
 *
 * @package business-class/customizer/sections
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$panel_name = 'theme_options';
$sections   = array(
	'Top Bar' => array(
		'section_title' => __( 'Top Bar', 'business-class' ),
		'description'   => __( 'Settings for theme header top bar.', 'business-class' ),
	),
	'Header'  => array(
		'section_title' => __( 'Header', 'business-class' ),
		'description'   => __( 'Settings for theme header.', 'business-class' ),
	),
	'Layouts' => array(
		'section_title' => __( 'Layouts', 'business-class' ),
		'description'   => __( 'Customize the appearance of theme archives, single posts and pages layouts.', 'business-class' ),
	),
	'Footer'  => array(
		'section_title' => __( 'Footer', 'business-class' ),
		'description'   => __( 'Settings for theme footer.', 'business-class' ),
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
