<?php
/**
 * This file loads the customizer files.
 * Include all the required files for this customizer module here.
 *
 * Other configurations and initial configurations are being done from business-class/inc/customizer.php
 *
 * @package business-class
 * @subpackage customizer
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID' ) ) {
	define( 'BUSINESS_CLASS_CUSTOMIZER_THEME_CONFIG_ID', 'business-class-customizer-config-id' );
}

$customizer_root = get_template_directory() . '/inc/customizer';

$file_paths = array(
	"{$customizer_root}/customizer-helpers",
	"{$customizer_root}/kirki/kirki",
	"{$customizer_root}/panels",
	"{$customizer_root}/defaults",
);

if ( is_array( $file_paths ) && count( $file_paths ) > 0 ) {
	foreach ( $file_paths as $file_path ) {
		$files = wp_normalize_path( "{$file_path}.php" );
		if ( file_exists( $files ) ) {
			require_once $files;
		}
	}
}

if ( ! function_exists( 'business_class_kirki_config' ) ) {
	/**
	 * Initial configs for kirki framework.
	 *
	 * @param array $configs Kirki configurations.
	 */
	function business_class_kirki_configs( $configs ) {

		/**
		 * Disable customizer preview loader logo.
		 */
		$configs['disable_loader'] = true;
		return $configs;
	}
	add_filter( 'kirki_config', 'business_class_kirki_configs' );
}

/**
 * Remove admin notices.
 */
add_filter( 'kirki_telemetry', '__return_false' );


/**
 * Bail early if "business_class_recursively_get_files_path" function is not created in themes customizer-helpers.php file
 */
if ( ! function_exists( 'business_class_recursively_get_files_path' ) ) {
	wp_die(
		'<strong>Warning: </strong>
		Function <strong>business_class_recursively_get_files_path</strong> not found for customizer-loader.php.</br>
		Please include that function in customizer-helpers.php to work.',
		'Function not found'
	);
}


/**
 * Auto load section files.
 */
$section_files = wp_normalize_path( "{$customizer_root}/sections" );
$section_files = business_class_recursively_get_files_path( $section_files );
if ( is_array( $section_files ) && count( $section_files ) ) {
	foreach ( $section_files as $section_file_path ) {
		if ( file_exists( $section_file_path ) ) {
			require_once $section_file_path;
		}
	}
}

if ( ! function_exists( 'business_class_init_customizer_fields' ) ) {

	/**
	 * Hook customizer fields to init hook.
	 * It is necessary as some functionality, eg: Custom Taxonomies, need it.
	 */
	function business_class_init_customizer_fields() {

		$customizer_root = get_template_directory() . '/inc/customizer';
		$field_files     = wp_normalize_path( "{$customizer_root}/fields" );
		$field_files     = business_class_recursively_get_files_path( $field_files );

		/**
		 * Load upsell link button to customizer.
		 */
		require_once "{$customizer_root}/upsell/load-upsell.php";

		/**
		 * Auto load field files.
		 */
		if ( is_array( $field_files ) && count( $field_files ) ) {
			foreach ( $field_files as $field_file_path ) {
				if ( file_exists( $field_file_path ) ) {
					require_once $field_file_path;
				}
			}
		}
	}
	add_action( 'init', 'business_class_init_customizer_fields' );
}
