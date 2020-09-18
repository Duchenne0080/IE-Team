<?php
/**
 * Rinzai Customizer hooks.
 */

/**
 * Header.
 *
 * @see rinzai_customizer_navbar_social_menu_display()
 */
add_action( 'rinzai_header_right',         'rinzai_customizer_navbar_social_menu_display', 20 );

/**
 * Blog.
 *
 * @see rinzai_customizer_header_video_markup()
 */
add_action( 'rinzai_before_blog_posts',     'rinzai_customizer_header_video_markup', 0 );
