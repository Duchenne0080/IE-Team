<?php
/**
 * This file has fields for Front Page > Pre Footer section.
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
$section_name = 'pre_footer';

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
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Social Links Title' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'label'           => __( 'Title', 'business-class' ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Social Links Title' ),
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
				'setting'  => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Enable Section' ),
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


/**
 * Bail if user has not installed newsletter plugin.
 *
 * @uses mc4wp_show_form() - MailChimp for WordPress plugin
 * @link https://www.mc4wp.com/
 */
if ( ! business_class_get_newsletter_form( '', false ) ) {
	return;
}


Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'            => 'custom',
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Newsletter' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Newsletter' ),
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
		'settings'        => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Newsletter Title' ),
		'section'         => business_class_get_customizer_section_id( $panel_name, $section_name ),
		'label'           => __( 'Newsletter Title', 'business-class' ),
		'default'         => business_class_customizer_defaults( $panel_name, $section_name, 'Newsletter Title' ),
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

