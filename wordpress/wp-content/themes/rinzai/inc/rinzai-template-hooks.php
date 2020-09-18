<?php

/**
 * General.
 *
 * @see rinzai_javascript_detection()
 * @see rinzai_active_nav_class()
 * @see rinzai_social_menu_icons()
 * @see rinzai_navbar_nav_menu_item_args()
 * @see rinzai_excerpt_length()
 * @see rinzai_excerpt_more()
 * @see rinzai_archive_title()
 * @see rinzai_generate_tag_cloud()
 */
add_action( 'wp_head', 						'rinzai_javascript_detection', 0 );
add_filter( 'nav_menu_css_class' , 			'rinzai_active_menu_css_class' , 10 , 2 );
add_filter( 'nav_menu_link_attributes', 	'rinzai_social_menu_icons', 10, 3 );
add_filter( 'nav_menu_item_args', 			'rinzai_navbar_nav_menu_item_args', 10, 3 );
add_filter( 'excerpt_length', 				'rinzai_excerpt_length', 99 );
add_filter( 'excerpt_more', 				'rinzai_excerpt_more' );
add_filter( 'get_the_archive_title', 		'rinzai_archive_title' );
add_filter( 'wp_generate_tag_cloud', 		'rinzai_generate_tag_cloud', 10, 3 );
add_filter( 'comment_form_fields', 			'rinzai_move_comment_field_to_bottom' );

/**
 * Header.
 *
 * @see rinzai_header_logotype()
 * @see rinzai_header_navbar()
 * @see rinzai_header_search_toggle()
 * @see rinzai_header_mobile_nav_toggle()
 */
add_action( 'rinzai_header_left',           'rinzai_header_logotype', 0 );
add_action( 'rinzai_header_left',           'rinzai_header_navbar', 10 );
add_action( 'rinzai_header_right',          'rinzai_header_search_toggle', 30 );
add_action( 'rinzai_header_right',          'rinzai_header_mobile_nav_toggle', 40 );

/**
 * Footer.
 *
 * @see rinzai_sidebar_footer_one()
 * @see rinzai_sidebar_footer_two()
 * @see rinzai_sidebar_footer_three()
 * @see rinzai_sidebar_footer_four()
 *
 * @see rinzai_print_footer_left_section()
 * @see rinzai_print_footer_center_section()
 * @see rinzai_print_footer_right_section()
 *
 * @see rinzai_print_offcanvas_nav()
 * @see rinzai_print_search_modal()
 */
add_action( 'rinzai_footer_sidebars',   'rinzai_footer_sidebar_one', 0 );
add_action( 'rinzai_footer_sidebars',   'rinzai_footer_sidebar_two', 10 );
add_action( 'rinzai_footer_sidebars',   'rinzai_footer_sidebar_three', 20 );
add_action( 'rinzai_footer_sidebars',   'rinzai_footer_sidebar_four', 30 );

add_action( 'rinzai_footer',            'rinzai_print_footer_left_section', 0 );
add_action( 'rinzai_footer',            'rinzai_print_footer_center_section', 10 );
add_action( 'rinzai_footer',            'rinzai_print_footer_right_section', 20 );

add_action( 'rinzai_after_footer',      'rinzai_print_offcanvas_nav', 0 );
add_action( 'rinzai_after_footer',      'rinzai_print_search_modal', 10 );
