<?php
/**
 * All the panels here.
 *
 * @package business-class/customizer
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create config id for the customizer.
 */
Business_Class_Customizer::add_config(
	BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID,
	array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	)
);


$priority = 120;

$panels = array(
	'Theme Options' => array(
		'panel_title' => __( 'Theme Options', 'business-class' ),
		'description' => __( 'This panel has all general settings for this theme.', 'business-class' ),
	),
	'Front Page'    => array(
		'panel_title' => __( 'Front Page', 'business-class' ),
		'description' => __( 'This panel has all settings for customizing the static front page. To view the sections, please select Static Front Page option front Homepage Settings panel.', 'business-class' ),
	),
);

if ( is_array( $panels ) && count( $panels ) > 0 ) {
	foreach ( $panels as $panels_id => $panels_args ) {
		$panel_title = ! empty( $panels_args['panel_title'] ) ? $panels_args['panel_title'] : '';
		$description = ! empty( $panels_args['description'] ) ? $panels_args['description'] : '';
		Business_Class_Customizer::add_panel(
			business_class_get_customizer_panel_id( $panels_id ),
			array(
				'title'       => $panel_title,
				'description' => $description,
				'priority'    => $priority,
			)
		);
	}
}
