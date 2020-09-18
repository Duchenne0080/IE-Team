<?php
/**
 * Custom functions that act independently of the theme templates
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $ap_classes Classes for the body element.
 * @return array
 */
function seos_restaurant_body_classes( $ap_classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$ap_classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$ap_classes[] = 'hfeed';
	}

	return $ap_classes;
}
add_filter( 'body_class', 'seos_restaurant_body_classes' );
