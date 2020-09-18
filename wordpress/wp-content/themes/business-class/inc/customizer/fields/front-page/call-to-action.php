<?php
/**
 * This file has fields for Front Page > Call To Action section.
 *
 * @package business-class/customizer/fields
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$panel_name   = 'front_page';
$section_name = 'call_to_action';

Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'     => 'toggle',
		'settings' => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Section' ),
		'label'    => __( 'Enable Section?', 'business-class' ),
		'section'  => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'  => business_class_customizer_defaults( $panel_name, $section_name, 'Enable Section' ),
		'priority' => 10,
	)
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'            => 'select',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Content' ),
		'label'           => __( 'Content', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Content' ),
		'description'     => esc_html__( 'Select content for your call to action section.', 'business-class' ),
		'choices'         => business_class_get_page_options_for_customizer(),
		'placeholder'     => esc_html__( 'Content', 'business-class' ),
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Section' ),
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'            => 'text',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Button Label' ),
		'label'           => __( 'Button Label', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Button Label' ),
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Section' ),
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
