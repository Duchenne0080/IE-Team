<?php
/**
 * sidebar functions and definitions
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package sidebar
 * @subpackage Functions
 * @author     MetricThemes <help@metricthemes.com>
 * @copyright  Copyright (c) 2018, MetricThemes
 * @link       http://metricthemes.com/theme/sidebar
 * @pro-version http://metricthemes.com/theme/sidebar-pro
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

if ( ! function_exists( 'sidebar_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sidebar_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	//Custom Image Sizes
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'sidebar-sectiontwo-big', 780, 500, true );	
	add_image_size( 'sidebar-featured', 700, 500, true );
	add_image_size( 'sidebar-single', 1120, 650, true );	
	add_image_size( 'sidebar-homelong', 600, 840, true );			

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'sidebar' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sidebar_custom_background_args', array(
		'default-color' => 'eeeeee',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 65,
		'width'       => 260,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),				
	) );		

}
endif;
add_action( 'after_setup_theme', 'sidebar_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sidebar_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sidebar_content_width', 660 );
}
add_action( 'after_setup_theme', 'sidebar_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sidebar_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'sidebar' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'Add widgets here.', 'sidebar' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Area 1', 'sidebar' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'sidebar' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Area 2', 'sidebar' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'sidebar' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Area 3', 'sidebar' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'sidebar' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
}
add_action( 'widgets_init', 'sidebar_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sidebar_scripts() {

	$sidebar_theme = wp_get_theme();
    $sidebar_version = $sidebar_theme['Version'];
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'sidebar-cards', get_template_directory_uri() . '/css/sidebar-cards.css' );				
	wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/css/meanmenu.css' );					
	wp_enqueue_style( 'sidebar-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), $sidebar_version, true );
	wp_enqueue_script( 'jquery-matchHeight', get_template_directory_uri() . '/js/jquery.matchHeight.js', array('jquery'), $sidebar_version, true );		
	wp_enqueue_script( 'jquery-meanmenu', get_template_directory_uri() . '/js/jquery.meanmenu.js', array('jquery'), $sidebar_version, true );		
	wp_enqueue_script( 'sidebar-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), $sidebar_version, true );	
		
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sidebar_scripts' );

/**
 * Register custom fonts.
 */
 
function sidebar_fonts_url() {

	$fonts_url = '';
	
	/* Translators: If there are characters in your language that are not
	* supported by IBM Plex Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$ibmplexsans = _x( 'on', 'IBM Plex Sans: on or off', 'sidebar' );	 
	 
	if ( 'off' !== $ibmplexsans ) {
	$font_families = array();	
	 
	if ( 'off' !== $ibmplexsans ) {
	$font_families[] = 'IBM Plex Sans:400,500,600,700';
	}
	 	 
	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);
	 
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	 
	return esc_url_raw( $fonts_url );
}

function sidebar_scripts_styles() {
	wp_enqueue_style( 'sidebar-fonts', sidebar_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'sidebar_scripts_styles' );

/**
 * Bootstrap Walker Class
 * @https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 */
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
 
/**
 * Walker for bootsrap menu
 */
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

/**
 * TGM
 */
require_once get_template_directory() . '/inc/tgm/plugins_recommended.php';

/**
 * Recommend Kirki
 */
include get_theme_file_path( 'inc/kirki-class/kirki-class-recommend.php' );

/**
 * Kirki Fallback
 */
require get_template_directory() . '/inc/kirki-class/class-sidebar-kirki.php';

/**
 * Extra Functions for Sidebar Theme
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * About Theme Page
 */
require get_template_directory() . '/inc/admin/class-sidebar-admin.php';