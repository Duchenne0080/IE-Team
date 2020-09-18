<?php
/**
 * This file has all the required code for helping the kirki customizer to load and blend in with theme.
 * Please run this file before any other customizer module files.
 * And also please do not include any kirki functions and class here.
 *
 * @package business-class
 * @subpackage customizer
 */

/**
 * Helps the autoload method to load the kirki files hence saving our time to replace file names of kirki framework.
 * This function uses str_replace function to work.
 *
 * Also this function must be used in kirki autoloader method, most probably in "class-kirki-autoload.php".
 *
 * @see https://www.php.net/manual/en/function.str-replace.php
 *
 * @param string $find_text    Class name text to you want to replace.
 * @param string $replace_with Text that class name will be replaced to.
 * @param string $class_name   Name of the class name that we are trying to load.
 * @return string New compatible class name string that autoload can read.
 */
function business_class_customizer_kirki_autoloader_helper( $find_text, $replace_with, $class_name ) {
	return str_replace( $find_text, $replace_with, $class_name );
}

/**
 * Format the string ready for customizer id.
 *
 * @param string $string Raw or unformated string.
 * @return string Formated string.
 */
function business_class_format_string_id_ready( $string ) {
	$string_lower = strtolower( $string );
	return str_replace( array( ' ', '-' ), array( '_', '_' ), $string_lower );
}

/**
 * Returns the panel id.
 *
 * @param string $panel_name Customizer panel name.
 * @return string Panel ID.
 */
function business_class_get_customizer_panel_id( $panel_name ) {
	if ( empty( $panel_name ) || ! is_string( $panel_name ) ) {
		return;
	}
	$panel_name = business_class_format_string_id_ready( $panel_name );
	return 'business_class_panel_' . $panel_name;
}

/**
 * Returns the section ID.
 *
 * @param string $parent_panel Parent panel name or ID.
 * @param string $section_name Name of the customizer section.
 * @return string Section ID.
 */
function business_class_get_customizer_section_id( $parent_panel, $section_name ) {
	if ( empty( $parent_panel ) || ! is_string( $parent_panel ) ) {
		return;
	}
	if ( empty( $section_name ) || ! is_string( $section_name ) ) {
		return;
	}

	$section_name = business_class_format_string_id_ready( $section_name );
	return business_class_get_customizer_panel_id( $parent_panel ) . '_section_' . $section_name;
}

/**
 * Returns the settings ID.
 *
 * @param string $panel_name Customizer panel name.
 * @param string $section_name Section name.
 * @param string $field_name Field name.
 * @return string Section ID.
 */
function business_class_customizer_fields_settings_id( $panel_name, $section_name, $field_name ) {
	$panel_name   = business_class_format_string_id_ready( $panel_name );
	$section_name = business_class_format_string_id_ready( $section_name );
	$field_name   = business_class_format_string_id_ready( $field_name );

	return 'business_class_theme_options[' . $panel_name . '][' . $section_name . '][' . $field_name . ']';
}

/**
 * Returns the theme mods.
 *
 * @param string $panel_name Customizer panel name.
 * @param string $section_name Section name.
 * @param string $field_name Field name.
 * @return mixed Theme mod.
 */
function business_class_get_theme_mod( $panel_name, $section_name, $field_name ) {
	$panel_name   = business_class_format_string_id_ready( $panel_name );
	$section_name = business_class_format_string_id_ready( $section_name );
	$field_name   = business_class_format_string_id_ready( $field_name );

	$default = business_class_customizer_defaults( $panel_name, $section_name, $field_name );
	$mods    = get_theme_mod( 'business_class_theme_options' );

	return isset( $mods[ $panel_name ][ $section_name ][ $field_name ] ) ? $mods[ $panel_name ][ $section_name ][ $field_name ] : $default;
}

if ( ! function_exists( 'business_class_customizer_get_terms' ) ) {

	/**
	 * This function returns the formated array of terms
	 * for the given taxonomy name, for the customizer dropdown.
	 *
	 * @param string $tax_name Taxonomy name. Default is "category".
	 * @param bool   $hide_empty Takes boolean value, pass true if you want to hide empty terms.
	 * @return array $items Formated array for the dropdown options for the customizer.
	 */
	function business_class_customizer_get_terms( $tax_name = 'category', $hide_empty = true ) {

		if ( empty( $tax_name ) ) {
			return;
		}

		$items = array();
		$terms = get_terms(
			array(
				'taxonomy'   => $tax_name,
				'hide_empty' => $hide_empty,
			)
		);

		if ( is_array( $terms ) && count( $terms ) > 0 ) {
			foreach ( $terms as $term ) {
				$term_name = ! empty( $term->name ) ? $term->name : false;
				$term_id   = ! empty( $term->term_id ) ? $term->term_id : '';
				if ( $term_name ) {
					$items[ $term_id ] = $term_name;
				}
			}
		}

		return $items;
	}
}

if ( ! function_exists( 'business_class_get_page_options_for_customizer' ) ) {

	/**
	 * Returns the formatted array for the customer dropdown for pages options.
	 */
	function business_class_get_page_options_for_customizer() {
		$items     = array();
		$all_pages = get_pages();

		if ( is_array( $all_pages ) && count( $all_pages ) > 0 ) {
			foreach ( $all_pages as $page ) {
				$title = ! empty( $page->post_title ) ? $page->post_title : false;
				$id    = ! empty( $page->ID ) ? $page->ID : '';
				if ( $title ) {
					$items[ $id ] = $title;
				}
			}
		}

		return $items;
	}
}

if ( ! function_exists( 'business_class_recursively_get_files_path' ) ) {

	/**
	 * Returns the path of all the files and sub-files for given directory.
	 *
	 * @param string $directory_path Relative path for the directory.
	 * @return array $paths Returns the relative path to all the files.
	 */
	function business_class_recursively_get_files_path( $directory_path ) {

		if ( empty( $directory_path ) ) {
			return;
		}

		$paths = array();

		$files_and_folders = scandir( $directory_path );

		if ( is_array( $files_and_folders ) && count( $files_and_folders ) > 0 ) {
			foreach ( $files_and_folders as $file_and_folder ) {
				if ( '.' === $file_and_folder || '..' === $file_and_folder ) {
					continue;
				}
				if ( is_file( "{$directory_path}/{$file_and_folder}" ) ) {
					$paths[] = wp_normalize_path( "{$directory_path}/{$file_and_folder}" );
					continue;
				}
				foreach ( business_class_recursively_get_files_path( "{$directory_path}/{$file_and_folder}" ) as $file_and_folder ) {
					$paths[] = wp_normalize_path( $file_and_folder );
				}
			}
		}
		return $paths;
	}
}
