<?php if( ! defined( 'ABSPATH' ) ) exit;
/**
 * Functions and definitions
 */
/*******************************
Basic
********************************/

if ( ! function_exists( 'seos_restaurant_setup' ) ) :

function seos_restaurant_setup() {

	load_theme_textdomain( 'seos-restaurant', SEOS_RESTAURANT_THEME_URI . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );	
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	register_nav_menu('primary', esc_html__( 'Primary', 'seos-restaurant' ) );

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
	add_theme_support( 'custom-background', apply_filters( 'seos_restaurant_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'seos_restaurant_setup' );

/*******************************
$content_width
********************************/

function seos_restaurant_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'seos_restaurant_content_width', 640 );
}
add_action( 'after_setup_theme', 'seos_restaurant_content_width', 0 );


/*******************************
* Register widget area.
********************************/


	function seos_restaurant_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'seos-restaurant' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'seos-restaurant' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	
}
add_action( 'widgets_init', 'seos_restaurant_widgets_init' );
	
/*******************************
* Enqueue scripts and styles.
********************************/
 
function seos_restaurant_scripts() {

		wp_enqueue_style( 'seos-restaurant-style', get_stylesheet_uri());
		wp_enqueue_style( 'animate', SEOS_RESTAURANT_THEME_URI . '/framework/css/animate.css');
		wp_enqueue_style( 'animate-image', SEOS_RESTAURANT_THEME_URI . '/css/style.css');
		wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css' );
		wp_enqueue_style( 'genericons', SEOS_RESTAURANT_THEME_URI . '/framework/genericons/genericons.css', array(), '3.4.1' );	
		wp_enqueue_style( 'seos-restaurant-woocommerce', SEOS_RESTAURANT_THEME_URI . '/inc/woocommerce/woo-css.css' );
		wp_enqueue_style( 'seos-restaurant-to-top-css', SEOS_RESTAURANT_THEME_URI . '/css/to-top.css' );
		wp_enqueue_style( 'seos-restaurant-font-Montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );

		wp_enqueue_script( 'seos-restaurant-navigation', SEOS_RESTAURANT_THEME_URI . '/framework/js/navigation.js', array(), '20120206', true );
		wp_enqueue_script( 'seos-restaurant-skip-link-focus-fix', SEOS_RESTAURANT_THEME_URI . '/framework/js/skip-link-focus-fix.js', array(), '20130115', true );
		wp_enqueue_script( 'seos-restaurant-to-top', SEOS_RESTAURANT_THEME_URI . '/framework/js/back-to-top.js', array('jquery' ), '', true );
		wp_enqueue_script( 'aniview', SEOS_RESTAURANT_THEME_URI . '/framework/js/jquery.aniview.js' );

		if ( is_singular() && wp_attachment_is_image() ) {
			wp_enqueue_script( 'seos-restaurant-keyboard-image-navigation', SEOS_RESTAURANT_THEME_SCRIPTS_URI . '/keyboard-image-navigation.js', array( 'jquery' ), '20151104' );
		}
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
}

add_action( 'wp_enqueue_scripts', 'seos_restaurant_scripts' );


function seos_restaurant_admin_scripts() {
	
		wp_enqueue_style( 'seos-restaurant-admin', SEOS_RESTAURANT_THEME_URI . '/inc/css/admin.css');
}		
add_action( 'admin_enqueue_scripts', 'seos_restaurant_admin_scripts' );


/*******************************
* Includes.
*******************************/

	require SEOS_RESTAURANT_THEME . '/inc/template-tags.php';
	require SEOS_RESTAURANT_THEME . '/inc/extras.php';
	require SEOS_RESTAURANT_THEME . '/inc/customizer.php';
	require SEOS_RESTAURANT_THEME . '/inc/jetpack.php';
	require SEOS_RESTAURANT_THEME . '/inc/custom-header.php';
	require SEOS_RESTAURANT_THEME . '/inc/woocommerce/woo-functions.php';
	require SEOS_RESTAURANT_THEME . '/inc/social.php';
	require SEOS_RESTAURANT_THEME . '/inc/image-gallery.php';
	
/*********************************************************************************************************
* Excerpt Read More
**********************************************************************************************************/

function seos_restaurant_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'seos-restaurant' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'seos_restaurant_excerpt_more' );

		
/* ----------------------------------------------------------------------
Back to top Button
---------------------------------------------------------------------- */			
	
function seos_restaurant_back_to_top() {
    echo '<a id="totop" href="#"><i class="fa fa-chevron-up"></i></a>';
    }

