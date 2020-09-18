<?php
/**
 * This file has the required codes for registering the metaboxes in posts or pages.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Bail if static front page is not set.
 */
if ( 'page' !== get_option( 'show_on_front' ) ) {
	return;
}

require_once get_template_directory() . '/inc/metabox-callbacks.php';

if ( ! function_exists( 'business_class_register_custom_metabox' ) ) {

	/**
	 * Adds custom metaboxes to post types.
	 */
	function business_class_register_custom_metabox() {

		$args = business_class_get_metabox_args();

		if ( is_array( $args ) && count( $args ) > 0 ) {
			foreach ( $args as $key => $arg ) {
				$box_id     = "business_class_metabox_{$key}";
				$box_title  = ! empty( $arg['box_title'] ) ? $arg['box_title'] : '';
				$callback   = ! empty( $arg['callback'] ) ? $arg['callback'] : "{$box_id}_cb";
				$box_screen = ! empty( $arg['screen'] ) ? $arg['screen'] : 'post';
				$context    = ! empty( $arg['context'] ) ? $arg['context'] : 'side';
				$priority   = ! empty( $arg['priority'] ) ? $arg['priority'] : 'high';

				add_meta_box( $box_id, $box_title, $callback, $box_screen, $context, $priority );
			}
		}
	}
	add_action( 'add_meta_boxes', 'business_class_register_custom_metabox' );
}

/**
 * Returns the array of metabox arguments.
 */
function business_class_get_metabox_args() {

	$args = array(
		'select_fa_icon'   => array(
			'box_title' => esc_html__( 'Content Icon', 'business-class' ),
		),
		'team_social_link' => array(
			'box_title' => esc_html__( 'Team Details', 'business-class' ),
		),
		'reviewer_post'    => array(
			'box_title' => esc_html__( 'Reviewer Post', 'business-class' ),
		),
	);

	return apply_filters( 'business_class_get_metabox_args', $args );

}

if ( ! function_exists( 'business_class_enable_section_type_metabox' ) ) {

	/**
	 * It enables or disable the metabox according to frontpage sections.
	 */
	function business_class_enable_section_type_metabox( $args ) {

		$unset = array();

		$panel_name = 'front_page';
		$control_id = 'enable_section';

		if ( ! business_class_get_theme_mod( $panel_name, 'why_choose_us', $control_id ) ) {
			$unset[] = 'select_fa_icon';
		}

		if ( ! business_class_get_theme_mod( $panel_name, 'our_team', $control_id ) ) {
			$unset[] = 'team_social_link';
		}

		if ( ! business_class_get_theme_mod( $panel_name, 'testimonials', $control_id ) ) {
			$unset[] = 'reviewer_post';
		}

		if ( is_array( $unset ) && count( $unset ) > 0 ) {
			foreach ( $unset as $key_to_unset ) {
				if ( isset( $args[ $key_to_unset ] ) ) {
					unset( $args[ $key_to_unset ] );
				}
			}
		}

		return $args;

	}
	add_filter( 'business_class_get_metabox_args', 'business_class_enable_section_type_metabox' );
}


if ( ! function_exists( 'business_class_save_post_meta' ) ) {

	/**
	 * Save post metabox value.
	 *
	 * @param int $post_id Current post id.
	 */
	function business_class_save_post_meta( $post_id ) {

		$nonce_field    = "business_class_metabox_nonce_{$post_id}";
		$submitted_data = isset( $_POST[ $nonce_field ] ) && wp_verify_nonce( sanitize_post( wp_unslash( $_POST[ $nonce_field ] ) ), "{$nonce_field}_action" ) ? sanitize_post( wp_unslash( $_POST ) ) : array(); // phpcs:ignore
		$metabox_data   = isset( $submitted_data['business_class_metabox'] ) ? $submitted_data['business_class_metabox'] : false;

		if ( is_array( $metabox_data ) && ! empty( $metabox_data ) ) {
			update_post_meta( $post_id, 'business_class_metabox', $metabox_data );
		}

	}
	add_action( 'save_post', 'business_class_save_post_meta' );
}

