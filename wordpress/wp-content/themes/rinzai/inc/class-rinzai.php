<?php
/**
 * Rinzai Class.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Rinzai' ) ) :
    /**
	 * The main Rinzai theme class.
	 */
	class Rinzai
    {
        /**
		 * Construct class.
		 */
		public function __construct()
        {
            add_action( 'after_switch_theme',         array( $this, 'rinzai_theme_activated' ) );
			add_action( 'after_setup_theme',          array( $this, 'setup' ) );
			add_action( 'widgets_init',               array( $this, 'widgets_init' ) );
			add_action( 'wp_enqueue_scripts',         array( $this, 'scripts' ), 10 );
			add_action( 'admin_enqueue_scripts',      array( $this, 'admin_scripts_and_styles' ) );
		}

        /**
		 * Change some default options on theme activation according to theme design.
		 */
		public function rinzai_theme_activated() {
            // Set thumbnail size in settings > media.
            update_option( 'thumbnail_size_w', 280 );
            update_option( 'thumbnail_size_h', 180 );
            update_option( 'thumbnail_crop', 1 );

            // Set medium size in settings > media.
            update_option( 'medium_size_w', 430 );
            update_option( 'medium_size_h', 275 );

            // Set large size in settings > media.
            update_option( 'large_size_w', 860 );
            update_option( 'large_size_h', 630 );

            // Set posts per page and posts per rss options.
            update_option( 'posts_per_page', 12 );
            update_option( 'posts_per_rss', 12 );
        }

        /**
		 * Sets up theme defaults and registers support for various WordPress features.
		 */
		public function setup() {
            /*
			 * Load Localisation files.
			 *
			 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
			 */

			// Loads wp-content/languages/themes/ivanfonin-it_IT.mo.
			load_theme_textdomain( 'rinzai', trailingslashit( WP_LANG_DIR ) . 'themes/' );

			// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
			load_theme_textdomain( 'rinzai', get_stylesheet_directory() . '/languages' );

			// Loads wp-content/themes/ivanfonin/languages/it_IT.mo.
			load_theme_textdomain( 'rinzai', get_template_directory() . '/languages' );

            // Add editor stylesheet.
            add_editor_style( get_theme_file_uri( '/assets/css/admin/editor-style.css' ) );

            // Add default posts and comments RSS feed links to head.
            add_theme_support( 'automatic-feed-links' );

            // Let WordPress manage the document title.
            add_theme_support( 'title-tag' );

            // Enable support for Post Thumbnails on posts and pages.
            add_theme_support( 'post-thumbnails' );

            add_image_size( 'rinzai-featured-image', 2000, 1280, true );

            add_image_size( 'rinzai-post-type-image-thumbnail', 430, 550, true );

            // This theme uses wp_nav_menu() in one location.
            register_nav_menus( array(
                'main' => __( 'Main Menu', 'rinzai' ),
                'social' => __( 'Social Menu', 'rinzai' ),
            ) );

            // Add theme support for Custom Logo.
            add_theme_support( 'custom-logo', array(
                'height'      => 50,
                'width'       => 170,
                'flex-height' => true,
                'flex-width'  => true,
            ) );

            // Output valid HTML5 for search form, comment form, comments and gallery.
            add_theme_support( 'html5', array(
                'caption',
                'comment-form',
                'gallery',
            ) );

            // Enable support for Post Formats.
            add_theme_support( 'post-formats', array(
                'image',
            ) );

            // Enable support for custom header with video.
            add_theme_support( 'custom-header', array(
                'video' => true,
            ));

            // Add theme support for selective refresh for widgets.
            add_theme_support( 'customize-selective-refresh-widgets' );

            // Add support for the Pageviews plugin
    		add_theme_support( 'pageviews' );
		}

        /**
		 * Register widget area.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		public function widgets_init() {
            // Blog sidebar.
            register_sidebar( array(
                'name' => __( 'Blog Sidebar', 'rinzai' ),
                'id' => 'blog-sidebar',
                'description' => '',
                'before_widget' => '<div id="%1$s" class="widget uk-margin-medium-bottom %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<p class="uk-h4 uk-margin-small-top">',
                'after_title' => '</p>',
            ) );

            // Page sidebar.
            register_sidebar( array(
                'name' => __( 'Page Sidebar', 'rinzai' ),
                'id' => 'page-sidebar',
                'description' => '',
                'before_widget' => '<div id="%1$s" class="widget uk-margin-medium-bottom %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<p class="uk-h4 uk-margin-small-top">',
                'after_title' => '</p>',
            ) );

            // Post sidebar.
            register_sidebar( array(
                'name' => __( 'Post Sidebar', 'rinzai' ),
                'id' => 'post-sidebar',
                'description' => '',
                'before_widget' => '<div id="%1$s" class="widget uk-margin-medium-bottom %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<p class="uk-h4 uk-margin-small-top">',
                'after_title' => '</p>',
            ) );

            register_sidebar( array(
                'name' => __( 'Footer 1', 'rinzai' ),
                'id' => 'footer-1',
                'description' => '',
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<p class="uk-h4">',
                'after_title' => '</p>',
            ) );

            register_sidebar( array(
                'name' => __( 'Footer 2', 'rinzai' ),
                'id' => 'footer-2',
                'description' => '',
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<p class="uk-h4">',
                'after_title' => '</p>',
            ) );

            register_sidebar( array(
                'name' => __( 'Footer 3', 'rinzai' ),
                'id' => 'footer-3',
                'description' => '',
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<p class="uk-h4">',
                'after_title' => '</p>',
            ) );

            register_sidebar( array(
                'name' => __( 'Footer 4', 'rinzai' ),
                'id' => 'footer-4',
                'description' => '',
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<p class="uk-h4">',
                'after_title' => '</p>',
            ) );
        }

        /**
		 * Enqueue scripts and styles.
		 */
		public function scripts() {
			global $rinzai_theme_version;

            // Enqueue theme stylesheet.
            wp_enqueue_style( 'rinzai-style', get_stylesheet_uri(), '', $rinzai_theme_version );

			/**
			 * Scripts.
			 */
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

            // Load the html5 shiv.
        	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5'.$suffix.'.js' ) );
        	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

            // Enqueue theme script.
            wp_enqueue_script( 'uikit-script', get_theme_file_uri( '/assets/js/uikit'.$suffix.'.js' ), array( 'jquery' ), '3.0.0-beta.35' );
            wp_enqueue_script( 'uikit-icons-script', get_theme_file_uri( '/assets/js/uikit-icons'.$suffix.'.js' ), array( 'uikit-script' ), '3.0.0-beta.35' );

            // Enqueue theme script.
            wp_enqueue_script( 'rinzai-script', get_theme_file_uri( '/assets/js/rinzai'.$suffix.'.js' ), array( 'uikit-icons-script' ), $rinzai_theme_version, true );

            // Comment reply script.
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        		wp_enqueue_script( 'comment-reply' );
        	}
		}

		/**
		 * Enqueue admin scripts and styles.
		 */
		public function admin_scripts_and_styles() {
            // Registers an editor stylesheet for this theme.
            add_editor_style( get_template_directory_uri() . '/assets/css/admin/editor-style.css' );
		}
    }
endif;

return new Rinzai();
