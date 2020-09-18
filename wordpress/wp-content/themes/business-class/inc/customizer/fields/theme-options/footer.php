<?php
/**
 * This file has fields for Theme Options > Footer.
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
$section_name = 'footer';

Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'        => 'toggle',
		'settings'    => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Footer Widgets' ),
		'label'       => __( 'Enable Footer Widgets?', 'business-class' ),
		'description' => esc_html__( 'Hide or display the widgets area just above the footer credit.', 'business-class' ),
		'section'     => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'     => business_class_customizer_defaults( $panel_name, $section_name, 'Enable Footer Widgets' ),
		'priority'    => 10,
	)
);
