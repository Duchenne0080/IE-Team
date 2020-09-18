<?php
/**
 * This file has fields for Front Page > Our Blogs section.
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
$section_name = 'our_blogs';

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
		'type'            => 'text',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Heading' ),
		'label'           => __( 'Heading', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Heading' ),
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
		'type'            => 'textarea',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Sub Heading' ),
		'label'           => __( 'Sub Heading', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Sub Heading' ),
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
		'type'            => 'number',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Number Of Items' ),
		'label'           => __( 'Number Of Items', 'business-class' ),
		'description'     => esc_html__( 'Enter the number of items you want to display in slides. Max: No Limit', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Number Of Items' ),
		'priority'        => 10,
		'choices'         => array(
			'min'  => 1,
			'step' => 1,
		),
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
