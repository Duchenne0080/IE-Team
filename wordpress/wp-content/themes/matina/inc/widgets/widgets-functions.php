<?php
/**
 * Function file for handle the widget related content. 
 * 
 * @package Matina
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @since 1.0.0
 */
function matina_widgets_init() {
    /**
     * Register Main Sidebar
     *
     * @since 1.0.0
     */
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'matina' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'matina' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    /**
     * Register Footer Sidebars.
     *
     * @since 1.0.0
     */
    register_sidebars( 4, array(
        'name'          => esc_html__( 'Footer Sidebar %d', 'matina' ),
        'id'            => 'footer-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'matina' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    // register MT: Latest Posts widget
    register_widget( 'Matina_Latest_Posts' );

    // register MT: Author Info widget
    register_widget( 'Matina_Author_Info' );
}

add_action( 'widgets_init', 'matina_widgets_init' );

/**
 * Load widgets file
 */
require get_template_directory().'/inc/widgets/mt-widgets-helper.php';
require get_template_directory().'/inc/widgets/mt-latest-posts.php';
require get_template_directory().'/inc/widgets/mt-author-info.php';

