<?php
/* 	Travel Theme's Functions
	Copyright: 2012-2017, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Travel 1.0
*/

// Load the D5 Framework Optios Page
	
	require_once ( trailingslashit(get_template_directory()) . 'inc/customize.php' );
	
	function travel_about_page() { 
	add_theme_page( 'Travel Options', 'Travel Options', 'edit_theme_options', 'theme-about', 'travel_theme_about' ); 
	}
	add_action('admin_menu', 'travel_about_page');
	function travel_theme_about() {  require_once ( trailingslashit(get_template_directory()) . 'inc/theme-about.php' ); }


	add_theme_support( "title-tag" ); 
	function travel_setup() {
	load_theme_textdomain( 'travel-lite', get_template_directory() . '/languages' );	
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 600;
	register_nav_menus( array( 'main-menu' => __('Main Menu','travel-lite')) );
// 	Tell WordPress for the Feed Link
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	
// 	This theme uses Featured Contents (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 400, array( 'left', 'top') );
	add_image_size( 'fpage-thumb', 300, 150 );
	add_image_size( 'slide-thumb', 1400, 700 );
	
		
// 	WordPress Custom Background Support	
	$travel_custom_background = array(
	'default-color'          => 'e4e8e9',
	'default-image'          => '',
	);
	add_theme_support( 'custom-background', $travel_custom_background );
	
// 	WordPress Custom Header Support				
	$travel_custom_header = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 300,
	'height'                 => 80,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '000000',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback' 		 => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $travel_custom_header );
	}
	add_action( 'after_setup_theme', 'travel_setup' );
	

// 	Functions for adding script
	function travel_enqueue_scripts() {
	wp_enqueue_style('travel-style', get_stylesheet_uri());
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {  wp_enqueue_script( 'comment-reply' ); }
	wp_enqueue_script( 'travel-menu-style', get_template_directory_uri(). '/js/menu.js', array('jquery'), false );
	wp_register_style('travel-gfonts1', '//fonts.googleapis.com/css?family=Oswald', false );
	wp_register_style('travel-gfonts2', '//fonts.googleapis.com/css?family=Lato:300', false );
	wp_enqueue_style('travel-gfonts1');
	wp_enqueue_style('travel-gfonts2');
	wp_enqueue_script( 'travel-html5', get_template_directory_uri().'/js/html5.js');
    wp_script_add_data( 'travel-html5', 'conditional', 'lt IE 9' );
	if ( travel_get_option('responsive', '0') == '1' ) : wp_enqueue_style('travel-responsive', get_template_directory_uri(). '/style-responsive.css'); endif;
	}
	add_action( 'wp_enqueue_scripts', 'travel_enqueue_scripts' );
	
// 	Functions for adding script to Admin Area
	function travel_admin_style() { wp_enqueue_style( 'travel_admin_css', get_template_directory_uri() . '/inc/admin-style.css', false ); }
	add_action( 'admin_enqueue_scripts', 'travel_admin_style' );


// 	Functions for adding some custom code within the head tag of site
	function travel_custom_code() {
	
	?>
	
	<style type="text/css">
	.site-title a, 
	.site-title a:active, 
	.site-title a:hover {
	
	color: #<?php echo get_header_textcolor(); ?>;
	}
	<?php $fbackimage = travel_get_option('ft-back', get_template_directory_uri() . '/images/thumb-back.jpg'); ?>	
	#container .thumb {background-image: url("<?php if ($fbackimage) : echo $fbackimage; else:  echo  get_template_directory_uri() . '/images/thumb-back.jpg'; endif; ?>");}
	</style>	
	<?php 	
	}
	
	add_action('wp_head', 'travel_custom_code');
	
//	function tied to the excerpt_more filter hook.
	function travel_excerpt_length( $length ) {
	global $blExcerptLength;
	if ($blExcerptLength) {
    return $blExcerptLength;
	} else {
    return 50; //default value
    } }
	add_filter( 'excerpt_length', 'travel_excerpt_length', 999 );
	
	function travel_excerpt_more($more) {
       global $post;
	return '<a href="'. get_permalink($post->ID) . '" class="read-more">'. __('Read More ...','travel-lite') . '</a>';
	}
	add_filter('excerpt_more', 'travel_excerpt_more');

// Content Type Showing
	function travel_content() { the_content('<span class="read-more">'. __('Read More ...','travel-lite') . '</span>'); }
	function travel_creditline() { echo '<span class="credit">| Travel Theme by: <a href="'. esc_url('https://d5creation.com/theme/travel').'" target="_blank"> D5 Creation</a> | Powered by: <a href="http://wordpress.org" target="_blank">WordPress</a></span>'; }

//	Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link
	function travel_page_menu_args( $travel_args ) {
	$travel_args['show_home'] = true;
	return $travel_args;
	}
	add_filter( 'wp_page_menu_args', 'travel_page_menu_args' );


//	Registers the Widgets and Sidebars for the site
	function travel_widgets_init() {

	register_sidebar( array(
		'name' => __('Front Page Right Sidebar','travel-lite'), 
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __('Other Pages Right Sidebar','travel-lite'), 
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __('Footer Area One','travel-lite'),  
		'id' => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __('Footer Area Two','travel-lite'),  
		'id' => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __('Footer Area Three','travel-lite'), 
		'id' => 'sidebar-5',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __('Footer Area Four','travel-lite'), 
		'id' => 'sidebar-6',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	}
	add_action( 'widgets_init', 'travel_widgets_init' );

	add_filter('the_title', 'travel_title');
	function travel_title($title) {
        if ( '' == $title ) {
            return __('(Untitled)','travel-lite');
        } else {
            return $title;
        }
    }
	
	add_filter( 'wp_nav_menu_objects', 'travel_add_menu_parent_class' );
	function travel_add_menu_parent_class( $travelitems ) {
	$travelparents = array();
	foreach ( $travelitems as $travelitem ) {
	if ( $travelitem->menu_item_parent && $travelitem->menu_item_parent > 0 ) {
	$travelparents[] = $travelitem->menu_item_parent;
		}
	}
		
	foreach ( $travelitems as $travelitem ) {
	if ( in_array( $travelitem->ID, $travelparents ) ) {
	$travelitem->classes[] = 'menu-parent-item'; 
			}
		}
		
		return $travelitems;    
	}

//	Remove WordPress Custom Header Support for the theme travel
//	remove_theme_support('custom-header');

