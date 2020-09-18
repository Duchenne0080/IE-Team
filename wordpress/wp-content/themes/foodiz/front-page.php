<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Foodiz
 * @version 0.1
*/
get_header();
if ( get_option( 'show_on_front' ) == 'page' ) {
	$foodiz_frontpage_show = get_theme_mod('foodiz_frontpage_show');
	if ( $foodiz_frontpage_show ) {
		get_template_part( 'content', 'frontpage' );
	} else {
		get_template_part( 'page' );
	}
} else { 
	get_template_part( 'index' );
} 
get_footer();