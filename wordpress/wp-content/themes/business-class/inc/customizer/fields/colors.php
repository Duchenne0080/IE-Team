<?php
/**
 * This file has fields for Colors panels.
 *
 * @package business-class/customizer/fields
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$panel_name   = 'colors';
$section_name = 'colors';

Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'        => 'color',
		'settings'    => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Frontpage Background Color' ),
		'label'       => __( 'Frontpage Background Color', 'business-class' ),
		'section'     => $section_name,
		'default'     => business_class_customizer_defaults( $panel_name, $section_name, 'Frontpage Background Color' ),
		'description' => esc_html__( 'Choose background color for your static frontpage.', 'business-class' ),
		'priority'    => 10,
	)
);

Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'        => 'color',
		'settings'    => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Primary Color' ),
		'label'       => __( 'Primary Color', 'business-class' ),
		'section'     => $section_name,
		'default'     => business_class_customizer_defaults( $panel_name, $section_name, 'Primary Color' ),
		'description' => esc_html__( 'Choose overall site primary color.', 'business-class' ),
		'priority'    => 10,
	)
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'        => 'color',
		'settings'    => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Secondary Color' ),
		'label'       => __( 'Secondary Color', 'business-class' ),
		'section'     => $section_name,
		'default'     => business_class_customizer_defaults( $panel_name, $section_name, 'Secondary Color' ),
		'description' => esc_html__( 'Choose overall site secondary color. It is used by some elements, for ex: footer credit background color', 'business-class' ),
		'priority'    => 10,
	)
);
