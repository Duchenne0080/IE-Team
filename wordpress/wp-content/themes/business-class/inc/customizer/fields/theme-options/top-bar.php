<?php
/**
 * This file has fields for Theme Options > Top Bar.
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
$section_name = 'top_bar';


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'     => 'toggle',
		'settings' => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Top Bar' ),
		'label'    => __( 'Enable Top Bar?', 'business-class' ),
		'section'  => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'  => business_class_customizer_defaults( $panel_name, $section_name, 'Enable Top Bar' ),
		'priority' => 10,
	)
);



Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'            => 'text',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Address' ),
		'label'           => __( 'Address', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'priority'        => 10,
		'choices'         => array(
			'placeholder' => esc_html__( 'Ex: 337 Mount Suite 502, Ivyhaven', 'business-class' ),
		),
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Top Bar' ),
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
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Email' ),
		'label'           => __( 'Email', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'priority'        => 10,
		'choices'         => array(
			'placeholder' => esc_html__( 'Ex: email@domain.com', 'business-class' ),
		),
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Top Bar' ),
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
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Contact Number' ),
		'label'           => __( 'Contact Number', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'priority'        => 10,
		'choices'         => array(
			'placeholder' => esc_html__( 'Ex: +01-23456789', 'business-class' ),
		),
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Top Bar' ),
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);



Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'            => 'repeater',
		'label'           => esc_html__( 'Social Links', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'priority'        => 10,
		'row_label'       => array(
			'type'  => 'field',
			'value' => esc_html__( 'Social Link', 'business-class' ),
			'field' => 'social_link_type',
		),
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Top Bar' ),
				'operator' => '==',
				'value'    => true,
			),
		),
		'button_label'    => esc_html__( 'Add Social Link', 'business-class' ),
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Social Links' ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Social Links' ),
		'fields'          => array(
			'social_link_type' => array(
				'type'        => 'text',
				'description' => __( 'Ex: Facebook', 'business-class' ),
				'label'       => esc_html__( 'Social Link Type', 'business-class' ),
			),
			'social_link'      => array(
				'type'  => 'url',
				'label' => esc_html__( 'Social Link', 'business-class' ),
			),
		),
	)
);
