<?php
/**
 * This file has fields for Theme Options > Header.
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
$section_name = 'header';


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'     => 'toggle',
		'settings' => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Header Search' ),
		'label'    => __( 'Enable Header Search?', 'business-class' ),
		'section'  => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'  => business_class_customizer_defaults( $panel_name, $section_name, 'Enable Header Search' ),
		'priority' => 10,
	)
);



Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'     => 'custom',
		'settings' => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'cta_label' ),
		'section'  => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'  => business_class_customizer_defaults( $panel_name, $section_name, 'cta_label' ),
		'priority' => 10,
	)
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'     => 'toggle',
		'settings' => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'enable_cta' ),
		'label'    => __( 'Enable Call To Action?', 'business-class' ),
		'section'  => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'  => business_class_customizer_defaults( $panel_name, $section_name, 'enable_cta' ),
		'priority' => 10,
	)
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'            => 'text',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Label' ),
		'label'           => __( 'Label', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Label' ),
		'priority'        => 10,
		'choices'         => array(
			'placeholder' => esc_html__( 'Ex: Account', 'business-class' ),
		),
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'enable_cta' ),
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'            => 'select',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Link Type' ),
		'label'           => __( 'Link Type', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Link Type' ),
		'description'     => esc_html__( 'Link type for your call to action. If "Custom Link" is selected, you need to enter custom link.', 'business-class' ),
		'priority'        => 10,
		'placeholder'     => esc_html__( 'Select link type', 'business-class' ),
		'choices'         => array(
			'none'         => esc_html__( 'Select', 'business-class' ),
			'custom_links' => esc_html__( 'Custom Links', 'business-class' ),
			'wp_pages'     => esc_html__( 'WordPress Page', 'business-class' ),
		),
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'enable_cta' ),
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'            => 'url',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Custom Links' ),
		'label'           => __( 'Custom Links', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Custom Links' ),
		'priority'        => 10,
		'choices'         => array(
			'placeholder' => esc_html( 'https://' ),
		),
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'enable_cta' ),
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Link Type' ),
				'operator' => '==',
				'value'    => 'custom_links',
			),
		),
	)
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'            => 'select',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'cta_page' ),
		'label'           => __( 'CTA Page', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'cta_page' ),
		'description'     => esc_html__( 'Content for right panel', 'business-class' ),
		'priority'        => 10,
		'placeholder'     => esc_html__( 'Select a page', 'business-class' ),
		'choices'         => business_class_get_page_options_for_customizer(),
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'enable_cta' ),
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Link Type' ),
				'operator' => '==',
				'value'    => 'wp_pages',
			),
		),
	)
);
