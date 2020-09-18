<?php
/**
 * This file has fields for Front Page > Contact Us section.
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
$section_name = 'contact_us';

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
		'type'            => 'select',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Contents' ),
		'label'           => __( 'Contents', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Contents' ),
		'description'     => esc_html__( 'Content for right panel', 'business-class' ),
		'priority'        => 10,
		'placeholder'     => esc_html__( 'Select a page', 'business-class' ),
		'choices'         => business_class_get_page_options_for_customizer(),
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
		'type'            => 'custom',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Contact Box One' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Contact Box One' ),
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
		'type'            => 'toggle',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Contacts' ),
		'label'           => __( 'Enable Contacts?', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Enable Contacts' ),
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
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Contact Box One Title' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'label'           => __( 'Title', 'business-class' ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Contact Box One Title' ),
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Section' ),
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Contacts' ),
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
		'label'           => '',
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'priority'        => 10,
		'row_label'       => array(
			'type'  => 'field',
			'value' => esc_html__( 'Contact', 'business-class' ),
			'field' => 'contact_type',
		),
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Section' ),
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Contacts' ),
				'operator' => '==',
				'value'    => true,
			),
		),
		'button_label'    => esc_html__( 'Add Field', 'business-class' ),
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Contact Fields' ),
		'fields'          => array(
			'icon'           => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Field Icon', 'business-class' ),
				'choices' => business_class_get_fa_classes(),
			),
			'contact_detail' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Contact Detail', 'business-class' ),
			),
		),
	)
);


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'            => 'custom',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Contact Box Two' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Contact Box Two' ),
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
		'type'            => 'toggle',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Opening Hours' ),
		'label'           => __( 'Enable Opening Hours?', 'business-class' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Enable Opening Hours' ),
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
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Contact Box Two Title' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'label'           => __( 'Title', 'business-class' ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Contact Box Two Title' ),
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Section' ),
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Opening Hours' ),
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
		'label'           => '',
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'priority'        => 10,
		'row_label'       => array(
			'type'  => 'field',
			'value' => esc_html__( 'Opening Hour', 'business-class' ),
			'field' => 'duration',
		),
		'active_callback' => array(
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Section' ),
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Opening Hours' ),
				'operator' => '==',
				'value'    => true,
			),
		),
		'button_label'    => esc_html__( 'Add Field', 'business-class' ),
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Opening Hours' ),
		'fields'          => array(
			'icon'     => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Field Icon', 'business-class' ),
				'choices' => business_class_get_fa_classes(),
			),
			'duration' => array(
				'type'        => 'text',
				'description' => __( 'Ex: Monday - Friday', 'business-class' ),
				'label'       => esc_html__( 'Duration', 'business-class' ),
			),
			'time'     => array(
				'type'        => 'text',
				'description' => __( 'Ex: 10:00 - 18:00', 'business-class' ),
				'label'       => esc_html__( 'Time', 'business-class' ),
			),
		),
	)
);
