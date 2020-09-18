<?php
/**
 * This file has fields for Homepage settings panel.
 *
 * @package business-class/customizer/fields
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$panel_name   = 'static_front_page';
$section_name = 'static_front_page';

Business_Class_Customizer::add_field(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'type'        => 'switch',
		'settings'    => business_class_customizer_fields_settings_id( $panel_name, $section_name, 'Display Static Content' ),
		'label'       => __( 'Display Static Content', 'business-class' ),
		'section'     => $section_name,
		'default'     => business_class_customizer_defaults( $panel_name, $section_name, 'Display Static Content' ),
		'description' => esc_html__( 'Whether or not to display your homepage title and contents as a static page section.', 'business-class' ),
		'priority'    => 10,
	)
);
