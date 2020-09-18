<?php
/**
 * This file has fields for Theme Options > Layouts.
 *
 * @package business-class/customizer/fields
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$panel_name   = 'theme_options';
$section_name = 'layouts';

$choices = array(
	'no-sidebar'    => esc_html__( 'No Sidebar - Full Width', 'business-class' ),
	'left-sidebar'  => esc_html__( 'Left Sidebar - Right Contents', 'business-class' ),
	'right-sidebar' => esc_html__( 'Right Sidebar - Left Contents', 'business-class' ),
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'        => 'select',
		'settings'    => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Post Layout' ),
		'label'       => __( 'Post Layout', 'business-class' ),
		'section'     => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'     => business_class_customizer_defaults( $panel_name, $section_name, 'Post Layout' ),
		'description' => esc_html__( 'Select layout for your single post.', 'business-class' ),
		'priority'    => 10,
		'placeholder' => esc_html__( 'Select Layout', 'business-class' ),
		'choices'     => $choices,
	)
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'        => 'select',
		'settings'    => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Page Layout' ),
		'label'       => __( 'Page Layout', 'business-class' ),
		'section'     => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'     => business_class_customizer_defaults( $panel_name, $section_name, 'Page Layout' ),
		'description' => esc_html__( 'Select layout for your single page.', 'business-class' ),
		'priority'    => 10,
		'placeholder' => esc_html__( 'Select Layout', 'business-class' ),
		'choices'     => $choices,
	)
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'        => 'select',
		'settings'    => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Archives Layout' ),
		'label'       => __( 'Archives Layout', 'business-class' ),
		'section'     => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'     => business_class_customizer_defaults( $panel_name, $section_name, 'Archives Layout' ),
		'description' => esc_html__( 'Select layout for your blogs and archives page.', 'business-class' ),
		'priority'    => 10,
		'placeholder' => esc_html__( 'Select Layout', 'business-class' ),
		'choices'     => $choices,
	)
);
