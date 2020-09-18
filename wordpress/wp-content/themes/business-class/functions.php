<?php
/**
 * Business Class functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package business-class
 */

if ( ! defined( 'BUSINESS_CLASS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'BUSINESS_CLASS_VERSION', '1.0.0' );
}

if ( ! function_exists( 'business_class_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function business_class_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Business Class, use a find and replace
		 * to change 'business-class' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'business-class', get_template_directory() . '/languages' );

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

		// Used in archive content, featured content.
		set_post_thumbnail_size( 825, 620, false );

		// Used in slider.
		add_image_size( 'business-class-slider', 1920, 900, false );

		// Used in hero content.
		add_image_size( 'business-class-hero', 600, 650, false );

		// Used in portfolio, team.
		add_image_size( 'business-class-news', 800, 450, false );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'business-class' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'business_class_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'business_class_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function business_class_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'business_class_content_width', 640 );
}
add_action( 'after_setup_theme', 'business_class_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function business_class_widgets_init() {

	$footer_before_widget = '<aside id="%1$s" class="ws-grid-3 footer-widget-area %2$s">';
	$footer_after_widget  = '</aside>';
	$footer_before_title  = '<h3 class="widget-title">';
	$footer_after_title   = '</h3>';

	/**
	 * Theme Sidebar
	 */
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'business-class' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets for theme sidebar.', 'business-class' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	/*
	 * Footer widget areas
	 */
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets One', 'business-class' ),
			'id'            => 'footer-widgets-1',
			'description'   => esc_html__( 'Add footer widgets here.', 'business-class' ),
			'before_widget' => $footer_before_widget,
			'after_widget'  => $footer_after_widget,
			'before_title'  => $footer_before_title,
			'after_title'   => $footer_after_title,
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Two', 'business-class' ),
			'id'            => 'footer-widgets-2',
			'description'   => esc_html__( 'Add footer widgets here.', 'business-class' ),
			'before_widget' => $footer_before_widget,
			'after_widget'  => $footer_after_widget,
			'before_title'  => $footer_before_title,
			'after_title'   => $footer_after_title,
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Three', 'business-class' ),
			'id'            => 'footer-widgets-3',
			'description'   => esc_html__( 'Add footer widgets here.', 'business-class' ),
			'before_widget' => $footer_before_widget,
			'after_widget'  => $footer_after_widget,
			'before_title'  => $footer_before_title,
			'after_title'   => $footer_after_title,
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Four', 'business-class' ),
			'id'            => 'footer-widgets-4',
			'description'   => esc_html__( 'Add footer widgets here.', 'business-class' ),
			'before_widget' => $footer_before_widget,
			'after_widget'  => $footer_after_widget,
			'before_title'  => $footer_before_title,
			'after_title'   => $footer_after_title,
		)
	);
}
add_action( 'widgets_init', 'business_class_widgets_init' );

if ( ! function_exists( 'business_class_get_newsletter_form' ) ) {

	/**
	 * Prints the newsletter form.
	 *
	 * @uses mc4wp_show_form() - MailChimp for WordPress plugin
	 * @link https://www.mc4wp.com/
	 *
	 * @param int  $form_id Form id of mc4wp.
	 * @param bool $echo Return or print the form html.
	 */
	function business_class_get_newsletter_form( $form_id = 0, $echo = true ) {
		if ( ! function_exists( 'mc4wp_show_form' ) ) {
			return;
		}

		if ( ! $echo ) {
			return mc4wp_show_form( $form_id, array(), $echo );
		}
		mc4wp_show_form( $form_id, array(), $echo );
	}
}


if ( ! function_exists( 'business_class_get_post_meta' ) ) {

	/**
	 * Returns the custom post meta data.
	 *
	 * @param int    $post_id Post ID.
	 * @param string $key Array key post saved meta data.
	 */
	function business_class_get_post_meta( $post_id, $key = '' ) {

		if ( ! $post_id ) {
			return;
		}

		$post_meta = get_post_meta( $post_id, 'business_class_metabox', true );

		return $key && isset( $post_meta[ $key ] ) ? $post_meta[ $key ] : '';

	}
}


if ( ! function_exists( 'business_class_menu_fallback' ) ) {

	/**
	 * If no navigation menu is assigned, this function will be used for the fallback.
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_nav_menu/ for available $args arguments.
	 * @param  mixed $args Menu arguments.
	 * @return string $output Return or echo the add menu link.
	 */
	function business_class_menu_fallback( $args ) {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$link  = $args['link_before'];
		$link .= '<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="' . esc_attr__( 'Opens in new tab', 'business-class' ) . '" target="__blank">' . $args['before'] . esc_html__( 'Add a menu', 'business-class' ) . $args['after'] . '</a>';
		$link .= $args['link_after'];

		if ( false !== stripos( $args['items_wrap'], '<ul' ) || false !== stripos( $args['items_wrap'], '<ol' ) ) {
			$link = "<li class='menu-item'>{$link}</li>";
		}

		$output = sprintf( $args['items_wrap'], $args['menu_id'], $args['menu_class'], $link );

		if ( ! empty( $args['container'] ) ) {
			$output = sprintf( '<%1$s class="%2$s" id="%3$s">%4$s</%1$s>', $args['container'], $args['container_class'], $args['container_id'], $output );
		}

		if ( $args['echo'] ) {
			echo wp_kses_post( $output );
		}

		return $output;

	}
}


if ( ! function_exists( 'business_class_get_breadcrumb' ) ) {

	/**
	 * Returns the html for breadcrumbs if $display is provided false else echos it.
	 *
	 * @param bool $display Echo or return the html.
	 */
	function business_class_get_breadcrumb( $display = true ) {

		if ( ! class_exists( 'Business_Class_Breadcrumb_Trail' ) && ! function_exists( 'business_class_breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/inc/breadcrumb-class.php';
		}

		$breadcrumb            = '';
		$use_yoast_breadcrumbs = function_exists( 'yoast_breadcrumb' ) && yoast_breadcrumb( '', '', false ) ? true : false;

		$args = array(
			'container'     => 'div',
			'show_on_front' => false,
			'show_browse'   => false,
			'echo'          => false,
		);

		$breadcrumb_html = business_class_breadcrumb_trail( $args );

		$breadcrumb .= '<!-- Breadcrumb Starts -->';

		if ( $use_yoast_breadcrumbs ) {
			/**
			 * Add support for yoast breadcrumb.
			 */
			$breadcrumb .= yoast_breadcrumb( '<div id="breadcrumb"><div class="breadcrumbs breadcrumb-trail">', '</div></div><!-- Breadcrumbs-end -->', false );
		} else {
			if ( $breadcrumb_html ) {
				$breadcrumb .= '<div id="breadcrumb">';
				$breadcrumb .= '<div class="breadcrumbs breadcrumb-trail">';
				$breadcrumb .= $breadcrumb_html;
				$breadcrumb .= '</div>';
				$breadcrumb .= '</div>';
			}
		}

		$breadcrumb .= '<!-- Breadcrumb Ends -->';

		if ( ! $display ) {
			return $breadcrumb;
		}
		echo $breadcrumb; // phpcs:ignore
	}
}

if ( ! function_exists( 'business_class_get_sidebar_layout' ) ) {

	/**
	 * Returns the option for sidebar layout according to the current page or provided page type.
	 *
	 * @param string $type Manual page type, accepts: archives_layout | page_layout | post_layout.
	 */
	function business_class_get_sidebar_layout( $type = '' ) {

		$panel_name   = 'theme_options';
		$section_name = 'layouts';

		if ( ! $type ) {
			if ( is_page() ) {
				$type = 'page_layout';
			}elseif ( is_single() ) {
				$type = 'post_layout';
			}else{
				$type = 'archives_layout';
			}
		}

		$layout = is_active_sidebar( 'sidebar-1' ) ? business_class_get_theme_mod( $panel_name, $section_name, $type ) : 'no-sidebar';
		return apply_filters( 'business_class_get_sidebar_layout', $layout );
	}
}

if ( ! function_exists( 'business_class_excerpt_more' ) ) {

	/**
	 * Returns the more notation as "..." rather than "[...]" for excerpts.
	 *
	 * @param string $more Excerpt more string.
	 */
	function business_class_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		return '&hellip;';
	}
	add_filter( 'excerpt_more', 'business_class_excerpt_more' );
}


/**
 * Returns an array of fa class.
 */
function business_class_get_fa_classes() {

	$fa_class = array(
		''                                           => __( '-- Select --', 'business-class' ),
		'fab fa-500px'                               => __( '500px', 'business-class' ),
		'fab fa-accessible-icon'                     => __( 'Accessible Icon', 'business-class' ),
		'fab fa-accusoft'                            => __( 'Accusoft', 'business-class' ),
		'fas fa-address-book'                        => __( 'Address Book', 'business-class' ),
		'fas fa-address-card'                        => __( 'Address Card', 'business-class' ),
		'fas fa-adjust'                              => __( 'Adjust', 'business-class' ),
		'fab fa-adn'                                 => __( 'Adn', 'business-class' ),
		'fab fa-adversal'                            => __( 'Adversal', 'business-class' ),
		'fab fa-affiliatetheme'                      => __( 'Affiliatetheme', 'business-class' ),
		'fab fa-algolia'                             => __( 'Algolia', 'business-class' ),
		'fas fa-align-center'                        => __( 'Align Center', 'business-class' ),
		'fas fa-align-justify'                       => __( 'Align Justify', 'business-class' ),
		'fas fa-align-left'                          => __( 'Align Left', 'business-class' ),
		'fas fa-align-right'                         => __( 'Align Right', 'business-class' ),
		'fas fa-allergies'                           => __( 'Allergies', 'business-class' ),
		'fab fa-amazon'                              => __( 'Amazon', 'business-class' ),
		'fab fa-amazon-pay'                          => __( 'Amazon Pay', 'business-class' ),
		'fas fa-ambulance'                           => __( 'Ambulance', 'business-class' ),
		'fas fa-american-sign-language-interpreting' => __( 'American Sign Language', 'business-class' ),
		'fab fa-amilia'                              => __( 'Amilia', 'business-class' ),
		'fas fa-anchor'                              => __( 'Anchor', 'business-class' ),
		'fab fa-android'                             => __( 'Android', 'business-class' ),
		'fab fa-angellist'                           => __( 'Angellist', 'business-class' ),
		'fas fa-angle-double-down'                   => __( 'Angle Double Down', 'business-class' ),
		'fas fa-angle-double-left'                   => __( 'Angle Double Left', 'business-class' ),
		'fas fa-angle-double-right'                  => __( 'Angle Double Right', 'business-class' ),
		'fas fa-angle-double-up'                     => __( 'Angle Double Up', 'business-class' ),
		'fas fa-angle-down'                          => __( 'Angle Down', 'business-class' ),
		'fas fa-angle-left'                          => __( 'Angle Left', 'business-class' ),
		'fas fa-angle-right'                         => __( 'Angle Right', 'business-class' ),
		'fas fa-angle-up'                            => __( 'Angle Up', 'business-class' ),
		'fab fa-angrycreative'                       => __( 'Angrycreative', 'business-class' ),
		'fab fa-angular'                             => __( 'Angular', 'business-class' ),
		'fab fa-app-store'                           => __( 'App Store', 'business-class' ),
		'fab fa-app-store-ios'                       => __( 'App Store Ios', 'business-class' ),
		'fab fa-apper'                               => __( 'Apper', 'business-class' ),
		'fab fa-apple'                               => __( 'Apple', 'business-class' ),
		'fab fa-apple-pay'                           => __( 'Apple Pay', 'business-class' ),
		'fas fa-archive'                             => __( 'Archive', 'business-class' ),
		'fas fa-arrow-alt-circle-down'               => __( 'Arrow Alt Circle Down', 'business-class' ),
		'fas fa-arrow-alt-circle-left'               => __( 'Arrow Alt Circle Left', 'business-class' ),
		'fas fa-arrow-alt-circle-right'              => __( 'Arrow Alt Circle Right', 'business-class' ),
		'fas fa-arrow-alt-circle-up'                 => __( 'Arrow Alt Circle Up', 'business-class' ),
		'fas fa-arrow-circle-down'                   => __( 'Arrow Circle Down', 'business-class' ),
		'fas fa-arrow-circle-left'                   => __( 'Arrow Circle Left', 'business-class' ),
		'fas fa-arrow-circle-right'                  => __( 'Arrow Circle Right', 'business-class' ),
		'fas fa-arrow-circle-up'                     => __( 'Arrow Circle Up', 'business-class' ),
		'fas fa-arrow-down'                          => __( 'Arrow Down', 'business-class' ),
		'fas fa-arrow-left'                          => __( 'Arrow Left', 'business-class' ),
		'fas fa-arrow-right'                         => __( 'Arrow Right', 'business-class' ),
		'fas fa-arrow-up'                            => __( 'Arrow Up', 'business-class' ),
		'fas fa-arrows-alt'                          => __( 'Arrows Alt', 'business-class' ),
		'fas fa-arrows-alt-h'                        => __( 'Arrows Alt H', 'business-class' ),
		'fas fa-arrows-alt-v'                        => __( 'Arrows Alt V', 'business-class' ),
		'fas fa-assistive-listening-systems'         => __( 'Assistive Listening Systems', 'business-class' ),
		'fas fa-asterisk'                            => __( 'Asterisk', 'business-class' ),
		'fab fa-asymmetrik'                          => __( 'Asymmetrik', 'business-class' ),
		'fas fa-at'                                  => __( 'At', 'business-class' ),
		'fab fa-audible'                             => __( 'Audible', 'business-class' ),
		'fas fa-audio-description'                   => __( 'Audio Description', 'business-class' ),
		'fab fa-autoprefixer'                        => __( 'Autoprefixer', 'business-class' ),
		'fab fa-avianex'                             => __( 'Avianex', 'business-class' ),
		'fab fa-aviato'                              => __( 'Aviato', 'business-class' ),
		'fab fa-aws'                                 => __( 'Aws', 'business-class' ),
		'fas fa-backward'                            => __( 'Backward', 'business-class' ),
		'fas fa-balance-scale'                       => __( 'Balance Scale', 'business-class' ),
		'fas fa-ban'                                 => __( 'Ban', 'business-class' ),
		'fas fa-band-aid'                            => __( 'Band Aid', 'business-class' ),
		'fab fa-bandcamp'                            => __( 'Bandcamp', 'business-class' ),
		'fas fa-barcode'                             => __( 'Barcode', 'business-class' ),
		'fas fa-bars'                                => __( 'Bars', 'business-class' ),
		'fas fa-baseball-ball'                       => __( 'Baseball Ball', 'business-class' ),
		'fas fa-basketball-ball'                     => __( 'Basketball Ball', 'business-class' ),
		'fas fa-bath'                                => __( 'Bath', 'business-class' ),
		'fas fa-battery-empty'                       => __( 'Battery Empty', 'business-class' ),
		'fas fa-battery-full'                        => __( 'Battery Full', 'business-class' ),
		'fas fa-battery-half'                        => __( 'Battery Half', 'business-class' ),
		'fas fa-battery-quarter'                     => __( 'Battery Quarter', 'business-class' ),
		'fas fa-battery-three-quarters'              => __( 'Battery Three Quarters', 'business-class' ),
		'fas fa-bed'                                 => __( 'Bed', 'business-class' ),
		'fas fa-beer'                                => __( 'Beer', 'business-class' ),
		'fab fa-behance'                             => __( 'Behance', 'business-class' ),
		'fab fa-behance-square'                      => __( 'Behance Square', 'business-class' ),
		'fas fa-bell'                                => __( 'Bell', 'business-class' ),
		'fas fa-bell-slash'                          => __( 'Bell Slash', 'business-class' ),
		'fas fa-bicycle'                             => __( 'Bicycle', 'business-class' ),
		'fab fa-bimobject'                           => __( 'Bimobject', 'business-class' ),
		'fas fa-binoculars'                          => __( 'Binoculars', 'business-class' ),
		'fas fa-birthday-cake'                       => __( 'Birthday Cake', 'business-class' ),
		'fab fa-bitbucket'                           => __( 'Bitbucket', 'business-class' ),
		'fab fa-bitcoin'                             => __( 'Bitcoin', 'business-class' ),
		'fab fa-bity'                                => __( 'Bity', 'business-class' ),
		'fab fa-black-tie'                           => __( 'Black Tie', 'business-class' ),
		'fab fa-blackberry'                          => __( 'Blackberry', 'business-class' ),
		'fas fa-blind'                               => __( 'Blind', 'business-class' ),
		'fab fa-blogger'                             => __( 'Blogger', 'business-class' ),
		'fab fa-blogger-b'                           => __( 'Blogger B', 'business-class' ),
		'fab fa-bluetooth'                           => __( 'Bluetooth', 'business-class' ),
		'fab fa-bluetooth-b'                         => __( 'Bluetooth B', 'business-class' ),
		'fas fa-bold'                                => __( 'Bold', 'business-class' ),
		'fas fa-bolt'                                => __( 'Bolt', 'business-class' ),
		'fas fa-bomb'                                => __( 'Bomb', 'business-class' ),
		'fas fa-book'                                => __( 'Book', 'business-class' ),
		'fas fa-bookmark'                            => __( 'Bookmark', 'business-class' ),
		'fas fa-bowling-ball'                        => __( 'Bowling Ball', 'business-class' ),
		'fas fa-box'                                 => __( 'Box', 'business-class' ),
		'fas fa-box-open'                            => __( 'Box Open', 'business-class' ),
		'fas fa-boxes'                               => __( 'Boxes', 'business-class' ),
		'fas fa-braille'                             => __( 'Braille', 'business-class' ),
		'fas fa-briefcase'                           => __( 'Briefcase', 'business-class' ),
		'fas fa-briefcase-medical'                   => __( 'Briefcase Medical', 'business-class' ),
		'fab fa-btc'                                 => __( 'Btc', 'business-class' ),
		'fas fa-bug'                                 => __( 'Bug', 'business-class' ),
		'fas fa-building'                            => __( 'Building', 'business-class' ),
		'fas fa-bullhorn'                            => __( 'Bullhorn', 'business-class' ),
		'fas fa-bullseye'                            => __( 'Bullseye', 'business-class' ),
		'fas fa-burn'                                => __( 'Burn', 'business-class' ),
		'fab fa-buromobelexperte'                    => __( 'Buromobelexperte', 'business-class' ),
		'fas fa-bus'                                 => __( 'Bus', 'business-class' ),
		'fab fa-buysellads'                          => __( 'Buysellads', 'business-class' ),
		'fas fa-calculator'                          => __( 'Calculator', 'business-class' ),
		'fas fa-calendar'                            => __( 'Calendar', 'business-class' ),
		'fas fa-calendar-alt'                        => __( 'Calendar Alt', 'business-class' ),
		'fas fa-calendar-check'                      => __( 'Calendar Check', 'business-class' ),
		'fas fa-calendar-minus'                      => __( 'Calendar Minus', 'business-class' ),
		'fas fa-calendar-plus'                       => __( 'Calendar Plus', 'business-class' ),
		'fas fa-calendar-times'                      => __( 'Calendar Times', 'business-class' ),
		'fas fa-camera'                              => __( 'Camera', 'business-class' ),
		'fas fa-camera-retro'                        => __( 'Camera Retro', 'business-class' ),
		'fas fa-capsules'                            => __( 'Capsules', 'business-class' ),
		'fas fa-car'                                 => __( 'Car', 'business-class' ),
		'fas fa-caret-down'                          => __( 'Caret Down', 'business-class' ),
		'fas fa-caret-left'                          => __( 'Caret Left', 'business-class' ),
		'fas fa-caret-right'                         => __( 'Caret Right', 'business-class' ),
		'fas fa-caret-square-down'                   => __( 'Caret Square Down', 'business-class' ),
		'fas fa-caret-square-left'                   => __( 'Caret Square Left', 'business-class' ),
		'fas fa-caret-square-right'                  => __( 'Caret Square Right', 'business-class' ),
		'fas fa-caret-square-up'                     => __( 'Caret Square Up', 'business-class' ),
		'fas fa-caret-up'                            => __( 'Caret Up', 'business-class' ),
		'fas fa-cart-arrow-down'                     => __( 'Cart Arrow Down', 'business-class' ),
		'fas fa-cart-plus'                           => __( 'Cart Plus', 'business-class' ),
		'fab fa-cc-amazon-pay'                       => __( 'Cc Amazon Pay', 'business-class' ),
		'fab fa-cc-amex'                             => __( 'Cc Amex', 'business-class' ),
		'fab fa-cc-apple-pay'                        => __( 'Cc Apple Pay', 'business-class' ),
		'fab fa-cc-diners-club'                      => __( 'Cc Diners Club', 'business-class' ),
		'fab fa-cc-discover'                         => __( 'Cc Discover', 'business-class' ),
		'fab fa-cc-jcb'                              => __( 'Cc Jcb', 'business-class' ),
		'fab fa-cc-mastercard'                       => __( 'Cc Mastercard', 'business-class' ),
		'fab fa-cc-paypal'                           => __( 'Cc Paypal', 'business-class' ),
		'fab fa-cc-stripe'                           => __( 'Cc Stripe', 'business-class' ),
		'fab fa-cc-visa'                             => __( 'Cc Visa', 'business-class' ),
		'fab fa-centercode'                          => __( 'Centercode', 'business-class' ),
		'fas fa-certificate'                         => __( 'Certificate', 'business-class' ),
		'fas fa-chart-area'                          => __( 'Chart Area', 'business-class' ),
		'fas fa-chart-bar'                           => __( 'Chart Bar', 'business-class' ),
		'fas fa-chart-line'                          => __( 'Chart Line', 'business-class' ),
		'fas fa-chart-pie'                           => __( 'Chart Pie', 'business-class' ),
		'fas fa-check'                               => __( 'Check', 'business-class' ),
		'fas fa-check-circle'                        => __( 'Check Circle', 'business-class' ),
		'fas fa-check-square'                        => __( 'Check Square', 'business-class' ),
		'fas fa-chess'                               => __( 'Chess', 'business-class' ),
		'fas fa-chess-bishop'                        => __( 'Chess Bishop', 'business-class' ),
		'fas fa-chess-board'                         => __( 'Chess Board', 'business-class' ),
		'fas fa-chess-king'                          => __( 'Chess King', 'business-class' ),
		'fas fa-chess-knight'                        => __( 'Chess Knight', 'business-class' ),
		'fas fa-chess-pawn'                          => __( 'Chess Pawn', 'business-class' ),
		'fas fa-chess-queen'                         => __( 'Chess Queen', 'business-class' ),
		'fas fa-chess-rook'                          => __( 'Chess Rook', 'business-class' ),
		'fas fa-chevron-circle-down'                 => __( 'Chevron Circle Down', 'business-class' ),
		'fas fa-chevron-circle-left'                 => __( 'Chevron Circle Left', 'business-class' ),
		'fas fa-chevron-circle-right'                => __( 'Chevron Circle Right', 'business-class' ),
		'fas fa-chevron-circle-up'                   => __( 'Chevron Circle Up', 'business-class' ),
		'fas fa-chevron-down'                        => __( 'Chevron Down', 'business-class' ),
		'fas fa-chevron-left'                        => __( 'Chevron Left', 'business-class' ),
		'fas fa-chevron-right'                       => __( 'Chevron Right', 'business-class' ),
		'fas fa-chevron-up'                          => __( 'Chevron Up', 'business-class' ),
		'fas fa-child'                               => __( 'Child', 'business-class' ),
		'fab fa-chrome'                              => __( 'Chrome', 'business-class' ),
		'fas fa-circle'                              => __( 'Circle', 'business-class' ),
		'fas fa-circle-notch'                        => __( 'Circle Notch', 'business-class' ),
		'fas fa-clipboard'                           => __( 'Clipboard', 'business-class' ),
		'fas fa-clipboard-check'                     => __( 'Clipboard Check', 'business-class' ),
		'fas fa-clipboard-list'                      => __( 'Clipboard List', 'business-class' ),
		'fas fa-clock'                               => __( 'Clock', 'business-class' ),
		'fas fa-clone'                               => __( 'Clone', 'business-class' ),
		'fas fa-closed-captioning'                   => __( 'Closed Captioning', 'business-class' ),
		'fas fa-cloud'                               => __( 'Cloud', 'business-class' ),
		'fas fa-cloud-download-alt'                  => __( 'Cloud Download Alt', 'business-class' ),
		'fas fa-cloud-upload-alt'                    => __( 'Cloud Upload Alt', 'business-class' ),
		'fab fa-cloudscale'                          => __( 'Cloudscale', 'business-class' ),
		'fab fa-cloudsmith'                          => __( 'Cloudsmith', 'business-class' ),
		'fab fa-cloudversify'                        => __( 'Cloudversify', 'business-class' ),
		'fas fa-code'                                => __( 'Code', 'business-class' ),
		'fas fa-code-branch'                         => __( 'Code Branch', 'business-class' ),
		'fab fa-codepen'                             => __( 'Codepen', 'business-class' ),
		'fab fa-codiepie'                            => __( 'Codiepie', 'business-class' ),
		'fas fa-coffee'                              => __( 'Coffee', 'business-class' ),
		'fas fa-cog'                                 => __( 'Cog', 'business-class' ),
		'fas fa-cogs'                                => __( 'Cogs', 'business-class' ),
		'fas fa-columns'                             => __( 'Columns', 'business-class' ),
		'fas fa-comment'                             => __( 'Comment', 'business-class' ),
		'fas fa-comment-alt'                         => __( 'Comment Alt', 'business-class' ),
		'fas fa-comment-dots'                        => __( 'Comment Dots', 'business-class' ),
		'fas fa-comment-slash'                       => __( 'Comment Slash', 'business-class' ),
		'fas fa-comments'                            => __( 'Comments', 'business-class' ),
		'fas fa-compass'                             => __( 'Compass', 'business-class' ),
		'fas fa-compress'                            => __( 'Compress', 'business-class' ),
		'fab fa-connectdevelop'                      => __( 'Connectdevelop', 'business-class' ),
		'fab fa-contao'                              => __( 'Contao', 'business-class' ),
		'fas fa-copy'                                => __( 'Copy', 'business-class' ),
		'fas fa-copyright'                           => __( 'Copyright', 'business-class' ),
		'fas fa-couch'                               => __( 'Couch', 'business-class' ),
		'fab fa-cpanel'                              => __( 'Cpanel', 'business-class' ),
		'fab fa-creative-commons'                    => __( 'Creative Commons', 'business-class' ),
		'fas fa-credit-card'                         => __( 'Credit Card', 'business-class' ),
		'fas fa-crop'                                => __( 'Crop', 'business-class' ),
		'fas fa-crosshairs'                          => __( 'Crosshairs', 'business-class' ),
		'fab fa-css3'                                => __( 'Css3', 'business-class' ),
		'fab fa-css3-alt'                            => __( 'Css3 Alt', 'business-class' ),
		'fas fa-cube'                                => __( 'Cube', 'business-class' ),
		'fas fa-cubes'                               => __( 'Cubes', 'business-class' ),
		'fas fa-cut'                                 => __( 'Cut', 'business-class' ),
		'fab fa-cuttlefish'                          => __( 'Cuttlefish', 'business-class' ),
		'fab fa-d-and-d'                             => __( 'D And D', 'business-class' ),
		'fab fa-dashcube'                            => __( 'Dashcube', 'business-class' ),
		'fas fa-database'                            => __( 'Database', 'business-class' ),
		'fas fa-deaf'                                => __( 'Deaf', 'business-class' ),
		'fab fa-delicious'                           => __( 'Delicious', 'business-class' ),
		'fab fa-deploydog'                           => __( 'Deploydog', 'business-class' ),
		'fab fa-deskpro'                             => __( 'Deskpro', 'business-class' ),
		'fas fa-desktop'                             => __( 'Desktop', 'business-class' ),
		'fab fa-deviantart'                          => __( 'Deviantart', 'business-class' ),
		'fas fa-diagnoses'                           => __( 'Diagnoses', 'business-class' ),
		'fab fa-digg'                                => __( 'Digg', 'business-class' ),
		'fab fa-digital-ocean'                       => __( 'Digital Ocean', 'business-class' ),
		'fab fa-discord'                             => __( 'Discord', 'business-class' ),
		'fab fa-discourse'                           => __( 'Discourse', 'business-class' ),
		'fas fa-dna'                                 => __( 'Dna', 'business-class' ),
		'fab fa-dochub'                              => __( 'Dochub', 'business-class' ),
		'fab fa-docker'                              => __( 'Docker', 'business-class' ),
		'fas fa-dollar-sign'                         => __( 'Dollar Sign', 'business-class' ),
		'fas fa-dolly'                               => __( 'Dolly', 'business-class' ),
		'fas fa-dolly-flatbed'                       => __( 'Dolly Flatbed', 'business-class' ),
		'fas fa-donate'                              => __( 'Donate', 'business-class' ),
		'fas fa-dot-circle'                          => __( 'Dot Circle', 'business-class' ),
		'fas fa-dove'                                => __( 'Dove', 'business-class' ),
		'fas fa-download'                            => __( 'Download', 'business-class' ),
		'fab fa-draft2digital'                       => __( 'Draft2digital', 'business-class' ),
		'fab fa-dribbble'                            => __( 'Dribbble', 'business-class' ),
		'fab fa-dribbble-square'                     => __( 'Dribbble Square', 'business-class' ),
		'fab fa-dropbox'                             => __( 'Dropbox', 'business-class' ),
		'fab fa-drupal'                              => __( 'Drupal', 'business-class' ),
		'fab fa-dyalog'                              => __( 'Dyalog', 'business-class' ),
		'fab fa-earlybirds'                          => __( 'Earlybirds', 'business-class' ),
		'fab fa-edge'                                => __( 'Edge', 'business-class' ),
		'fas fa-edit'                                => __( 'Edit', 'business-class' ),
		'fas fa-eject'                               => __( 'Eject', 'business-class' ),
		'fab fa-elementor'                           => __( 'Elementor', 'business-class' ),
		'fas fa-ellipsis-h'                          => __( 'Ellipsis H', 'business-class' ),
		'fas fa-ellipsis-v'                          => __( 'Ellipsis V', 'business-class' ),
		'fab fa-ember'                               => __( 'Ember', 'business-class' ),
		'fab fa-empire'                              => __( 'Empire', 'business-class' ),
		'fas fa-envelope'                            => __( 'Envelope', 'business-class' ),
		'fas fa-envelope-open'                       => __( 'Envelope Open', 'business-class' ),
		'fas fa-envelope-square'                     => __( 'Envelope Square', 'business-class' ),
		'fab fa-envira'                              => __( 'Envira', 'business-class' ),
		'fas fa-eraser'                              => __( 'Eraser', 'business-class' ),
		'fab fa-erlang'                              => __( 'Erlang', 'business-class' ),
		'fab fa-ethereum'                            => __( 'Ethereum', 'business-class' ),
		'fab fa-etsy'                                => __( 'Etsy', 'business-class' ),
		'fas fa-euro-sign'                           => __( 'Euro Sign', 'business-class' ),
		'fas fa-exchange-alt'                        => __( 'Exchange Alt', 'business-class' ),
		'fas fa-exclamation'                         => __( 'Exclamation', 'business-class' ),
		'fas fa-exclamation-circle'                  => __( 'Exclamation Circle', 'business-class' ),
		'fas fa-exclamation-triangle'                => __( 'Exclamation Triangle', 'business-class' ),
		'fas fa-expand'                              => __( 'Expand', 'business-class' ),
		'fas fa-expand-arrows-alt'                   => __( 'Expand Arrows Alt', 'business-class' ),
		'fab fa-expeditedssl'                        => __( 'Expeditedssl', 'business-class' ),
		'fas fa-external-link-alt'                   => __( 'External Link Alt', 'business-class' ),
		'fas fa-external-link-square-alt'            => __( 'External Link Square Alt', 'business-class' ),
		'fas fa-eye'                                 => __( 'Eye', 'business-class' ),
		'fas fa-eye-dropper'                         => __( 'Eye Dropper', 'business-class' ),
		'fas fa-eye-slash'                           => __( 'Eye Slash', 'business-class' ),
		'fab fa-facebook'                            => __( 'Facebook', 'business-class' ),
		'fab fa-facebook-f'                          => __( 'Facebook F', 'business-class' ),
		'fab fa-facebook-messenger'                  => __( 'Facebook Messenger', 'business-class' ),
		'fab fa-facebook-square'                     => __( 'Facebook Square', 'business-class' ),
		'fas fa-fast-backward'                       => __( 'Fast Backward', 'business-class' ),
		'fas fa-fast-forward'                        => __( 'Fast Forward', 'business-class' ),
		'fas fa-fax'                                 => __( 'Fax', 'business-class' ),
		'fas fa-female'                              => __( 'Female', 'business-class' ),
		'fas fa-fighter-jet'                         => __( 'Fighter Jet', 'business-class' ),
		'fas fa-file'                                => __( 'File', 'business-class' ),
		'fas fa-file-alt'                            => __( 'File Alt', 'business-class' ),
		'fas fa-file-archive'                        => __( 'File Archive', 'business-class' ),
		'fas fa-file-audio'                          => __( 'File Audio', 'business-class' ),
		'fas fa-file-code'                           => __( 'File Code', 'business-class' ),
		'fas fa-file-excel'                          => __( 'File Excel', 'business-class' ),
		'fas fa-file-image'                          => __( 'File Image', 'business-class' ),
		'fas fa-file-medical'                        => __( 'File Medical', 'business-class' ),
		'fas fa-file-medical-alt'                    => __( 'File Medical Alt', 'business-class' ),
		'fas fa-file-pdf'                            => __( 'File Pdf', 'business-class' ),
		'fas fa-file-powerpoint'                     => __( 'File Powerpoint', 'business-class' ),
		'fas fa-file-video'                          => __( 'File Video', 'business-class' ),
		'fas fa-file-word'                           => __( 'File Word', 'business-class' ),
		'fas fa-film'                                => __( 'Film', 'business-class' ),
		'fas fa-filter'                              => __( 'Filter', 'business-class' ),
		'fas fa-fire'                                => __( 'Fire', 'business-class' ),
		'fas fa-fire-extinguisher'                   => __( 'Fire Extinguisher', 'business-class' ),
		'fab fa-firefox'                             => __( 'Firefox', 'business-class' ),
		'fas fa-first-aid'                           => __( 'First Aid', 'business-class' ),
		'fab fa-first-order'                         => __( 'First Order', 'business-class' ),
		'fab fa-firstdraft'                          => __( 'Firstdraft', 'business-class' ),
		'fas fa-flag'                                => __( 'Flag', 'business-class' ),
		'fas fa-flag-checkered'                      => __( 'Flag Checkered', 'business-class' ),
		'fas fa-flask'                               => __( 'Flask', 'business-class' ),
		'fab fa-flickr'                              => __( 'Flickr', 'business-class' ),
		'fab fa-flipboard'                           => __( 'Flipboard', 'business-class' ),
		'fab fa-fly'                                 => __( 'Fly', 'business-class' ),
		'fas fa-folder'                              => __( 'Folder', 'business-class' ),
		'fas fa-folder-open'                         => __( 'Folder Open', 'business-class' ),
		'fas fa-font'                                => __( 'Font', 'business-class' ),
		'fab fa-font-awesome'                        => __( 'Font Awesome', 'business-class' ),
		'fab fa-font-awesome-alt'                    => __( 'Font Awesome Alt', 'business-class' ),
		'fab fa-font-awesome-flag'                   => __( 'Font Awesome Flag', 'business-class' ),
		'fab fa-fonticons'                           => __( 'Fonticons', 'business-class' ),
		'fab fa-fonticons-fi'                        => __( 'Fonticons Fi', 'business-class' ),
		'fas fa-football-ball'                       => __( 'Football Ball', 'business-class' ),
		'fab fa-fort-awesome'                        => __( 'Fort Awesome', 'business-class' ),
		'fab fa-fort-awesome-alt'                    => __( 'Fort Awesome Alt', 'business-class' ),
		'fab fa-forumbee'                            => __( 'Forumbee', 'business-class' ),
		'fas fa-forward'                             => __( 'Forward', 'business-class' ),
		'fab fa-foursquare'                          => __( 'Foursquare', 'business-class' ),
		'fab fa-free-code-camp'                      => __( 'Free Code Camp', 'business-class' ),
		'fab fa-freebsd'                             => __( 'Freebsd', 'business-class' ),
		'fas fa-frown'                               => __( 'Frown', 'business-class' ),
		'fas fa-futbol'                              => __( 'Futbol', 'business-class' ),
		'fas fa-gamepad'                             => __( 'Gamepad', 'business-class' ),
		'fas fa-gavel'                               => __( 'Gavel', 'business-class' ),
		'fas fa-gem'                                 => __( 'Gem', 'business-class' ),
		'fas fa-genderless'                          => __( 'Genderless', 'business-class' ),
		'fab fa-get-pocket'                          => __( 'Get Pocket', 'business-class' ),
		'fab fa-gg'                                  => __( 'Gg', 'business-class' ),
		'fab fa-gg-circle'                           => __( 'Gg Circle', 'business-class' ),
		'fas fa-gift'                                => __( 'Gift', 'business-class' ),
		'fab fa-git'                                 => __( 'Git', 'business-class' ),
		'fab fa-git-square'                          => __( 'Git Square', 'business-class' ),
		'fab fa-github'                              => __( 'Github', 'business-class' ),
		'fab fa-github-alt'                          => __( 'Github Alt', 'business-class' ),
		'fab fa-github-square'                       => __( 'Github Square', 'business-class' ),
		'fab fa-gitkraken'                           => __( 'Gitkraken', 'business-class' ),
		'fab fa-gitlab'                              => __( 'Gitlab', 'business-class' ),
		'fab fa-gitter'                              => __( 'Gitter', 'business-class' ),
		'fas fa-glass-martini'                       => __( 'Glass Martini', 'business-class' ),
		'fab fa-glide'                               => __( 'Glide', 'business-class' ),
		'fab fa-glide-g'                             => __( 'Glide G', 'business-class' ),
		'fas fa-globe'                               => __( 'Globe', 'business-class' ),
		'fab fa-gofore'                              => __( 'Gofore', 'business-class' ),
		'fas fa-golf-ball'                           => __( 'Golf Ball', 'business-class' ),
		'fab fa-goodreads'                           => __( 'Goodreads', 'business-class' ),
		'fab fa-goodreads-g'                         => __( 'Goodreads G', 'business-class' ),
		'fab fa-google'                              => __( 'Google', 'business-class' ),
		'fab fa-google-drive'                        => __( 'Google Drive', 'business-class' ),
		'fab fa-google-play'                         => __( 'Google Play', 'business-class' ),
		'fab fa-google-plus'                         => __( 'Google Plus', 'business-class' ),
		'fab fa-google-plus-g'                       => __( 'Google Plus G', 'business-class' ),
		'fab fa-google-plus-square'                  => __( 'Google Plus Square', 'business-class' ),
		'fab fa-google-wallet'                       => __( 'Google Wallet', 'business-class' ),
		'fas fa-graduation-cap'                      => __( 'Graduation Cap', 'business-class' ),
		'fab fa-gratipay'                            => __( 'Gratipay', 'business-class' ),
		'fab fa-grav'                                => __( 'Grav', 'business-class' ),
		'fab fa-gripfire'                            => __( 'Gripfire', 'business-class' ),
		'fab fa-grunt'                               => __( 'Grunt', 'business-class' ),
		'fab fa-gulp'                                => __( 'Gulp', 'business-class' ),
		'fas fa-h-square'                            => __( 'H Square', 'business-class' ),
		'fab fa-hacker-news'                         => __( 'Hacker News', 'business-class' ),
		'fab fa-hacker-news-square'                  => __( 'Hacker News Square', 'business-class' ),
		'fas fa-hand-holding'                        => __( 'Hand Holding', 'business-class' ),
		'fas fa-hand-holding-heart'                  => __( 'Hand Holding Heart', 'business-class' ),
		'fas fa-hand-holding-usd'                    => __( 'Hand Holding Usd', 'business-class' ),
		'fas fa-hand-lizard'                         => __( 'Hand Lizard', 'business-class' ),
		'fas fa-hand-paper'                          => __( 'Hand Paper', 'business-class' ),
		'fas fa-hand-peace'                          => __( 'Hand Peace', 'business-class' ),
		'fas fa-hand-point-down'                     => __( 'Hand Point Down', 'business-class' ),
		'fas fa-hand-point-left'                     => __( 'Hand Point Left', 'business-class' ),
		'fas fa-hand-point-right'                    => __( 'Hand Point Right', 'business-class' ),
		'fas fa-hand-point-up'                       => __( 'Hand Point Up', 'business-class' ),
		'fas fa-hand-pointer'                        => __( 'Hand Pointer', 'business-class' ),
		'fas fa-hand-rock'                           => __( 'Hand Rock', 'business-class' ),
		'fas fa-hand-scissors'                       => __( 'Hand Scissors', 'business-class' ),
		'fas fa-hand-spock'                          => __( 'Hand Spock', 'business-class' ),
		'fas fa-hands'                               => __( 'Hands', 'business-class' ),
		'fas fa-hands-helping'                       => __( 'Hands Helping', 'business-class' ),
		'fas fa-handshake'                           => __( 'Handshake', 'business-class' ),
		'fas fa-hashtag'                             => __( 'Hashtag', 'business-class' ),
		'fas fa-hdd'                                 => __( 'Hdd', 'business-class' ),
		'fas fa-heading'                             => __( 'Heading', 'business-class' ),
		'fas fa-headphones'                          => __( 'Headphones', 'business-class' ),
		'fas fa-heart'                               => __( 'Heart', 'business-class' ),
		'fas fa-heartbeat'                           => __( 'Heartbeat', 'business-class' ),
		'fab fa-hips'                                => __( 'Hips', 'business-class' ),
		'fab fa-hire-a-helper'                       => __( 'Hire A Helper', 'business-class' ),
		'fas fa-history'                             => __( 'History', 'business-class' ),
		'fas fa-hockey-puck'                         => __( 'Hockey Puck', 'business-class' ),
		'fas fa-home'                                => __( 'Home', 'business-class' ),
		'fab fa-hooli'                               => __( 'Hooli', 'business-class' ),
		'fas fa-hospital'                            => __( 'Hospital', 'business-class' ),
		'fas fa-hospital-alt'                        => __( 'Hospital Alt', 'business-class' ),
		'fas fa-hospital-symbol'                     => __( 'Hospital Symbol', 'business-class' ),
		'fab fa-hotjar'                              => __( 'Hotjar', 'business-class' ),
		'fas fa-hourglass'                           => __( 'Hourglass', 'business-class' ),
		'fas fa-hourglass-end'                       => __( 'Hourglass End', 'business-class' ),
		'fas fa-hourglass-half'                      => __( 'Hourglass Half', 'business-class' ),
		'fas fa-hourglass-start'                     => __( 'Hourglass Start', 'business-class' ),
		'fab fa-houzz'                               => __( 'Houzz', 'business-class' ),
		'fab fa-html5'                               => __( 'Html5', 'business-class' ),
		'fab fa-hubspot'                             => __( 'Hubspot', 'business-class' ),
		'fas fa-i-cursor'                            => __( 'I Cursor', 'business-class' ),
		'fas fa-id-badge'                            => __( 'Id Badge', 'business-class' ),
		'fas fa-id-card'                             => __( 'Id Card', 'business-class' ),
		'fas fa-id-card-alt'                         => __( 'Id Card Alt', 'business-class' ),
		'fas fa-image'                               => __( 'Image', 'business-class' ),
		'fas fa-images'                              => __( 'Images', 'business-class' ),
		'fab fa-imdb'                                => __( 'Imdb', 'business-class' ),
		'fas fa-inbox'                               => __( 'Inbox', 'business-class' ),
		'fas fa-indent'                              => __( 'Indent', 'business-class' ),
		'fas fa-industry'                            => __( 'Industry', 'business-class' ),
		'fas fa-info'                                => __( 'Info', 'business-class' ),
		'fas fa-info-circle'                         => __( 'Info Circle', 'business-class' ),
		'fab fa-instagram'                           => __( 'Instagram', 'business-class' ),
		'fab fa-internet-explorer'                   => __( 'Internet Explorer', 'business-class' ),
		'fab fa-ioxhost'                             => __( 'Ioxhost', 'business-class' ),
		'fas fa-italic'                              => __( 'Italic', 'business-class' ),
		'fab fa-itunes'                              => __( 'Itunes', 'business-class' ),
		'fab fa-itunes-note'                         => __( 'Itunes Note', 'business-class' ),
		'fab fa-java'                                => __( 'Java', 'business-class' ),
		'fab fa-jenkins'                             => __( 'Jenkins', 'business-class' ),
		'fab fa-joget'                               => __( 'Joget', 'business-class' ),
		'fab fa-joomla'                              => __( 'Joomla', 'business-class' ),
		'fab fa-js'                                  => __( 'Js', 'business-class' ),
		'fab fa-js-square'                           => __( 'Js Square', 'business-class' ),
		'fab fa-jsfiddle'                            => __( 'Jsfiddle', 'business-class' ),
		'fas fa-key'                                 => __( 'Key', 'business-class' ),
		'fas fa-keyboard'                            => __( 'Keyboard', 'business-class' ),
		'fab fa-keycdn'                              => __( 'Keycdn', 'business-class' ),
		'fab fa-kickstarter'                         => __( 'Kickstarter', 'business-class' ),
		'fab fa-kickstarter-k'                       => __( 'Kickstarter K', 'business-class' ),
		'fab fa-korvue'                              => __( 'Korvue', 'business-class' ),
		'fas fa-language'                            => __( 'Language', 'business-class' ),
		'fas fa-laptop'                              => __( 'Laptop', 'business-class' ),
		'fab fa-laravel'                             => __( 'Laravel', 'business-class' ),
		'fab fa-lastfm'                              => __( 'Lastfm', 'business-class' ),
		'fab fa-lastfm-square'                       => __( 'Lastfm Square', 'business-class' ),
		'fas fa-leaf'                                => __( 'Leaf', 'business-class' ),
		'fab fa-leanpub'                             => __( 'Leanpub', 'business-class' ),
		'fas fa-lemon'                               => __( 'Lemon', 'business-class' ),
		'fab fa-less'                                => __( 'Less', 'business-class' ),
		'fas fa-level-down-alt'                      => __( 'Level Down Alt', 'business-class' ),
		'fas fa-level-up-alt'                        => __( 'Level Up Alt', 'business-class' ),
		'fas fa-life-ring'                           => __( 'Life Ring', 'business-class' ),
		'fas fa-lightbulb'                           => __( 'Lightbulb', 'business-class' ),
		'fab fa-line'                                => __( 'Line', 'business-class' ),
		'fas fa-link'                                => __( 'Link', 'business-class' ),
		'fab fa-linkedin'                            => __( 'Linkedin', 'business-class' ),
		'fab fa-linkedin-in'                         => __( 'Linkedin In', 'business-class' ),
		'fab fa-linode'                              => __( 'Linode', 'business-class' ),
		'fab fa-linux'                               => __( 'Linux', 'business-class' ),
		'fas fa-lira-sign'                           => __( 'Lira Sign', 'business-class' ),
		'fas fa-list'                                => __( 'List', 'business-class' ),
		'fas fa-list-alt'                            => __( 'List Alt', 'business-class' ),
		'fas fa-list-ol'                             => __( 'List Ol', 'business-class' ),
		'fas fa-list-ul'                             => __( 'List Ul', 'business-class' ),
		'fas fa-location-arrow'                      => __( 'Location Arrow', 'business-class' ),
		'fas fa-lock'                                => __( 'Lock', 'business-class' ),
		'fas fa-lock-open'                           => __( 'Lock Open', 'business-class' ),
		'fas fa-long-arrow-alt-down'                 => __( 'Long Arrow Alt Down', 'business-class' ),
		'fas fa-long-arrow-alt-left'                 => __( 'Long Arrow Alt Left', 'business-class' ),
		'fas fa-long-arrow-alt-right'                => __( 'Long Arrow Alt Right', 'business-class' ),
		'fas fa-long-arrow-alt-up'                   => __( 'Long Arrow Alt Up', 'business-class' ),
		'fas fa-low-vision'                          => __( 'Low Vision', 'business-class' ),
		'fab fa-lyft'                                => __( 'Lyft', 'business-class' ),
		'fab fa-magento'                             => __( 'Magento', 'business-class' ),
		'fas fa-magic'                               => __( 'Magic', 'business-class' ),
		'fas fa-magnet'                              => __( 'Magnet', 'business-class' ),
		'fas fa-male'                                => __( 'Male', 'business-class' ),
		'fas fa-map'                                 => __( 'Map', 'business-class' ),
		'fas fa-map-marker'                          => __( 'Map Marker', 'business-class' ),
		'fas fa-map-marker-alt'                      => __( 'Map Marker Alt', 'business-class' ),
		'fas fa-map-pin'                             => __( 'Map Pin', 'business-class' ),
		'fas fa-map-signs'                           => __( 'Map Signs', 'business-class' ),
		'fas fa-mars'                                => __( 'Mars', 'business-class' ),
		'fas fa-mars-double'                         => __( 'Mars Double', 'business-class' ),
		'fas fa-mars-stroke'                         => __( 'Mars Stroke', 'business-class' ),
		'fas fa-mars-stroke-h'                       => __( 'Mars Stroke H', 'business-class' ),
		'fas fa-mars-stroke-v'                       => __( 'Mars Stroke V', 'business-class' ),
		'fab fa-maxcdn'                              => __( 'Maxcdn', 'business-class' ),
		'fab fa-medapps'                             => __( 'Medapps', 'business-class' ),
		'fab fa-medium'                              => __( 'Medium', 'business-class' ),
		'fab fa-medium-m'                            => __( 'Medium M', 'business-class' ),
		'fas fa-medkit'                              => __( 'Medkit', 'business-class' ),
		'fab fa-medrt'                               => __( 'Medrt', 'business-class' ),
		'fab fa-meetup'                              => __( 'Meetup', 'business-class' ),
		'fas fa-meh'                                 => __( 'Meh', 'business-class' ),
		'fas fa-mercury'                             => __( 'Mercury', 'business-class' ),
		'fas fa-microchip'                           => __( 'Microchip', 'business-class' ),
		'fas fa-microphone'                          => __( 'Microphone', 'business-class' ),
		'fas fa-microphone-slash'                    => __( 'Microphone Slash', 'business-class' ),
		'fab fa-microsoft'                           => __( 'Microsoft', 'business-class' ),
		'fas fa-minus'                               => __( 'Minus', 'business-class' ),
		'fas fa-minus-circle'                        => __( 'Minus Circle', 'business-class' ),
		'fas fa-minus-square'                        => __( 'Minus Square', 'business-class' ),
		'fab fa-mix'                                 => __( 'Mix', 'business-class' ),
		'fab fa-mixcloud'                            => __( 'Mixcloud', 'business-class' ),
		'fab fa-mizuni'                              => __( 'Mizuni', 'business-class' ),
		'fas fa-mobile'                              => __( 'Mobile', 'business-class' ),
		'fas fa-mobile-alt'                          => __( 'Mobile Alt', 'business-class' ),
		'fab fa-modx'                                => __( 'Modx', 'business-class' ),
		'fab fa-monero'                              => __( 'Monero', 'business-class' ),
		'fas fa-money-bill-alt'                      => __( 'Money Bill Alt', 'business-class' ),
		'fas fa-moon'                                => __( 'Moon', 'business-class' ),
		'fas fa-motorcycle'                          => __( 'Motorcycle', 'business-class' ),
		'fas fa-mouse-pointer'                       => __( 'Mouse Pointer', 'business-class' ),
		'fas fa-music'                               => __( 'Music', 'business-class' ),
		'fab fa-napster'                             => __( 'Napster', 'business-class' ),
		'fas fa-neuter'                              => __( 'Neuter', 'business-class' ),
		'fas fa-newspaper'                           => __( 'Newspaper', 'business-class' ),
		'fab fa-nintendo-switch'                     => __( 'Nintendo Switch', 'business-class' ),
		'fab fa-node'                                => __( 'Node', 'business-class' ),
		'fab fa-node-js'                             => __( 'Node Js', 'business-class' ),
		'fas fa-notes-medical'                       => __( 'Notes Medical', 'business-class' ),
		'fab fa-npm'                                 => __( 'Npm', 'business-class' ),
		'fab fa-ns8'                                 => __( 'Ns8', 'business-class' ),
		'fab fa-nutritionix'                         => __( 'Nutritionix', 'business-class' ),
		'fas fa-object-group'                        => __( 'Object Group', 'business-class' ),
		'fas fa-object-ungroup'                      => __( 'Object Ungroup', 'business-class' ),
		'fab fa-odnoklassniki'                       => __( 'Odnoklassniki', 'business-class' ),
		'fab fa-odnoklassniki-square'                => __( 'Odnoklassniki Square', 'business-class' ),
		'fab fa-opencart'                            => __( 'Opencart', 'business-class' ),
		'fab fa-openid'                              => __( 'Openid', 'business-class' ),
		'fab fa-opera'                               => __( 'Opera', 'business-class' ),
		'fab fa-optin-monster'                       => __( 'Optin Monster', 'business-class' ),
		'fab fa-osi'                                 => __( 'Osi', 'business-class' ),
		'fas fa-outdent'                             => __( 'Outdent', 'business-class' ),
		'fab fa-page4'                               => __( 'Page4', 'business-class' ),
		'fab fa-pagelines'                           => __( 'Pagelines', 'business-class' ),
		'fas fa-paint-brush'                         => __( 'Paint Brush', 'business-class' ),
		'fab fa-palfed'                              => __( 'Palfed', 'business-class' ),
		'fas fa-pallet'                              => __( 'Pallet', 'business-class' ),
		'fas fa-paper-plane'                         => __( 'Paper Plane', 'business-class' ),
		'fas fa-paperclip'                           => __( 'Paperclip', 'business-class' ),
		'fas fa-parachute-box'                       => __( 'Parachute Box', 'business-class' ),
		'fas fa-paragraph'                           => __( 'Paragraph', 'business-class' ),
		'fas fa-paste'                               => __( 'Paste', 'business-class' ),
		'fab fa-patreon'                             => __( 'Patreon', 'business-class' ),
		'fas fa-pause'                               => __( 'Pause', 'business-class' ),
		'fas fa-pause-circle'                        => __( 'Pause Circle', 'business-class' ),
		'fas fa-paw'                                 => __( 'Paw', 'business-class' ),
		'fab fa-paypal'                              => __( 'Paypal', 'business-class' ),
		'fas fa-pen-square'                          => __( 'Pen Square', 'business-class' ),
		'fas fa-pencil-alt'                          => __( 'Pencil Alt', 'business-class' ),
		'fas fa-people-carry'                        => __( 'People Carry', 'business-class' ),
		'fas fa-percent'                             => __( 'Percent', 'business-class' ),
		'fab fa-periscope'                           => __( 'Periscope', 'business-class' ),
		'fab fa-phabricator'                         => __( 'Phabricator', 'business-class' ),
		'fab fa-phoenix-framework'                   => __( 'Phoenix Framework', 'business-class' ),
		'fas fa-phone'                               => __( 'Phone', 'business-class' ),
		'fas fa-phone-slash'                         => __( 'Phone Slash', 'business-class' ),
		'fas fa-phone-square'                        => __( 'Phone Square', 'business-class' ),
		'fas fa-phone-volume'                        => __( 'Phone Volume', 'business-class' ),
		'fab fa-php'                                 => __( 'Php', 'business-class' ),
		'fab fa-pied-piper'                          => __( 'Pied Piper', 'business-class' ),
		'fab fa-pied-piper-alt'                      => __( 'Pied Piper Alt', 'business-class' ),
		'fab fa-pied-piper-hat'                      => __( 'Pied Piper Hat', 'business-class' ),
		'fab fa-pied-piper-pp'                       => __( 'Pied Piper Pp', 'business-class' ),
		'fas fa-piggy-bank'                          => __( 'Piggy Bank', 'business-class' ),
		'fas fa-pills'                               => __( 'Pills', 'business-class' ),
		'fab fa-pinterest'                           => __( 'Pinterest', 'business-class' ),
		'fab fa-pinterest-p'                         => __( 'Pinterest P', 'business-class' ),
		'fab fa-pinterest-square'                    => __( 'Pinterest Square', 'business-class' ),
		'fas fa-plane'                               => __( 'Plane', 'business-class' ),
		'fas fa-play'                                => __( 'Play', 'business-class' ),
		'fas fa-play-circle'                         => __( 'Play Circle', 'business-class' ),
		'fab fa-playstation'                         => __( 'Playstation', 'business-class' ),
		'fas fa-plug'                                => __( 'Plug', 'business-class' ),
		'fas fa-plus'                                => __( 'Plus', 'business-class' ),
		'fas fa-plus-circle'                         => __( 'Plus Circle', 'business-class' ),
		'fas fa-plus-square'                         => __( 'Plus Square', 'business-class' ),
		'fas fa-podcast'                             => __( 'Podcast', 'business-class' ),
		'fas fa-poo'                                 => __( 'Poo', 'business-class' ),
		'fas fa-pound-sign'                          => __( 'Pound Sign', 'business-class' ),
		'fas fa-power-off'                           => __( 'Power Off', 'business-class' ),
		'fas fa-prescription-bottle'                 => __( 'Prescription Bottle', 'business-class' ),
		'fas fa-prescription-bottle-alt'             => __( 'Prescription Bottle Alt', 'business-class' ),
		'fas fa-print'                               => __( 'Print', 'business-class' ),
		'fas fa-procedures'                          => __( 'Procedures', 'business-class' ),
		'fab fa-product-hunt'                        => __( 'Product Hunt', 'business-class' ),
		'fab fa-pushed'                              => __( 'Pushed', 'business-class' ),
		'fas fa-puzzle-piece'                        => __( 'Puzzle Piece', 'business-class' ),
		'fab fa-python'                              => __( 'Python', 'business-class' ),
		'fab fa-qq'                                  => __( 'Qq', 'business-class' ),
		'fas fa-qrcode'                              => __( 'Qrcode', 'business-class' ),
		'fas fa-question'                            => __( 'Question', 'business-class' ),
		'fas fa-question-circle'                     => __( 'Question Circle', 'business-class' ),
		'fas fa-quidditch'                           => __( 'Quidditch', 'business-class' ),
		'fab fa-quinscape'                           => __( 'Quinscape', 'business-class' ),
		'fab fa-quora'                               => __( 'Quora', 'business-class' ),
		'fas fa-quote-left'                          => __( 'Quote Left', 'business-class' ),
		'fas fa-quote-right'                         => __( 'Quote Right', 'business-class' ),
		'fas fa-random'                              => __( 'Random', 'business-class' ),
		'fab fa-ravelry'                             => __( 'Ravelry', 'business-class' ),
		'fab fa-react'                               => __( 'React', 'business-class' ),
		'fab fa-readme'                              => __( 'Readme', 'business-class' ),
		'fab fa-rebel'                               => __( 'Rebel', 'business-class' ),
		'fas fa-recycle'                             => __( 'Recycle', 'business-class' ),
		'fab fa-red-river'                           => __( 'Red River', 'business-class' ),
		'fab fa-reddit'                              => __( 'Reddit', 'business-class' ),
		'fab fa-reddit-alien'                        => __( 'Reddit Alien', 'business-class' ),
		'fab fa-reddit-square'                       => __( 'Reddit Square', 'business-class' ),
		'fas fa-redo'                                => __( 'Redo', 'business-class' ),
		'fas fa-redo-alt'                            => __( 'Redo Alt', 'business-class' ),
		'fas fa-registered'                          => __( 'Registered', 'business-class' ),
		'fab fa-rendact'                             => __( 'Rendact', 'business-class' ),
		'fab fa-renren'                              => __( 'Renren', 'business-class' ),
		'fas fa-reply'                               => __( 'Reply', 'business-class' ),
		'fas fa-reply-all'                           => __( 'Reply All', 'business-class' ),
		'fab fa-replyd'                              => __( 'Replyd', 'business-class' ),
		'fab fa-resolving'                           => __( 'Resolving', 'business-class' ),
		'fas fa-retweet'                             => __( 'Retweet', 'business-class' ),
		'fas fa-ribbon'                              => __( 'Ribbon', 'business-class' ),
		'fas fa-road'                                => __( 'Road', 'business-class' ),
		'fas fa-rocket'                              => __( 'Rocket', 'business-class' ),
		'fab fa-rocketchat'                          => __( 'Rocketchat', 'business-class' ),
		'fab fa-rockrms'                             => __( 'Rockrms', 'business-class' ),
		'fas fa-rss'                                 => __( 'Rss', 'business-class' ),
		'fas fa-rss-square'                          => __( 'Rss Square', 'business-class' ),
		'fas fa-ruble-sign'                          => __( 'Ruble Sign', 'business-class' ),
		'fas fa-rupee-sign'                          => __( 'Rupee Sign', 'business-class' ),
		'fab fa-safari'                              => __( 'Safari', 'business-class' ),
		'fab fa-sass'                                => __( 'Sass', 'business-class' ),
		'fas fa-save'                                => __( 'Save', 'business-class' ),
		'fab fa-schlix'                              => __( 'Schlix', 'business-class' ),
		'fab fa-scribd'                              => __( 'Scribd', 'business-class' ),
		'fas fa-search'                              => __( 'Search', 'business-class' ),
		'fas fa-search-minus'                        => __( 'Search Minus', 'business-class' ),
		'fas fa-search-plus'                         => __( 'Search Plus', 'business-class' ),
		'fab fa-searchengin'                         => __( 'Searchengin', 'business-class' ),
		'fas fa-seedling'                            => __( 'Seedling', 'business-class' ),
		'fab fa-sellcast'                            => __( 'Sellcast', 'business-class' ),
		'fab fa-sellsy'                              => __( 'Sellsy', 'business-class' ),
		'fas fa-server'                              => __( 'Server', 'business-class' ),
		'fab fa-servicestack'                        => __( 'Servicestack', 'business-class' ),
		'fas fa-share'                               => __( 'Share', 'business-class' ),
		'fas fa-share-alt'                           => __( 'Share Alt', 'business-class' ),
		'fas fa-share-alt-square'                    => __( 'Share Alt Square', 'business-class' ),
		'fas fa-share-square'                        => __( 'Share Square', 'business-class' ),
		'fas fa-shekel-sign'                         => __( 'Shekel Sign', 'business-class' ),
		'fas fa-shield-alt'                          => __( 'Shield Alt', 'business-class' ),
		'fas fa-ship'                                => __( 'Ship', 'business-class' ),
		'fas fa-shipping-fast'                       => __( 'Shipping Fast', 'business-class' ),
		'fab fa-shirtsinbulk'                        => __( 'Shirtsinbulk', 'business-class' ),
		'fas fa-shopping-bag'                        => __( 'Shopping Bag', 'business-class' ),
		'fas fa-shopping-basket'                     => __( 'Shopping Basket', 'business-class' ),
		'fas fa-shopping-cart'                       => __( 'Shopping Cart', 'business-class' ),
		'fas fa-shower'                              => __( 'Shower', 'business-class' ),
		'fas fa-sign'                                => __( 'Sign', 'business-class' ),
		'fas fa-sign-in-alt'                         => __( 'Sign In Alt', 'business-class' ),
		'fas fa-sign-language'                       => __( 'Sign Language', 'business-class' ),
		'fas fa-sign-out-alt'                        => __( 'Sign Out Alt', 'business-class' ),
		'fas fa-signal'                              => __( 'Signal', 'business-class' ),
		'fab fa-simplybuilt'                         => __( 'Simplybuilt', 'business-class' ),
		'fab fa-sistrix'                             => __( 'Sistrix', 'business-class' ),
		'fas fa-sitemap'                             => __( 'Sitemap', 'business-class' ),
		'fab fa-skyatlas'                            => __( 'Skyatlas', 'business-class' ),
		'fab fa-skype'                               => __( 'Skype', 'business-class' ),
		'fab fa-slack'                               => __( 'Slack', 'business-class' ),
		'fab fa-slack-hash'                          => __( 'Slack Hash', 'business-class' ),
		'fas fa-sliders-h'                           => __( 'Sliders H', 'business-class' ),
		'fab fa-slideshare'                          => __( 'Slideshare', 'business-class' ),
		'fas fa-smile'                               => __( 'Smile', 'business-class' ),
		'fas fa-smoking'                             => __( 'Smoking', 'business-class' ),
		'fab fa-snapchat'                            => __( 'Snapchat', 'business-class' ),
		'fab fa-snapchat-ghost'                      => __( 'Snapchat Ghost', 'business-class' ),
		'fab fa-snapchat-square'                     => __( 'Snapchat Square', 'business-class' ),
		'fas fa-snowflake'                           => __( 'Snowflake', 'business-class' ),
		'fas fa-sort'                                => __( 'Sort', 'business-class' ),
		'fas fa-sort-alpha-down'                     => __( 'Sort Alpha Down', 'business-class' ),
		'fas fa-sort-alpha-up'                       => __( 'Sort Alpha Up', 'business-class' ),
		'fas fa-sort-amount-down'                    => __( 'Sort Amount Down', 'business-class' ),
		'fas fa-sort-amount-up'                      => __( 'Sort Amount Up', 'business-class' ),
		'fas fa-sort-down'                           => __( 'Sort Down', 'business-class' ),
		'fas fa-sort-numeric-down'                   => __( 'Sort Numeric Down', 'business-class' ),
		'fas fa-sort-numeric-up'                     => __( 'Sort Numeric Up', 'business-class' ),
		'fas fa-sort-up'                             => __( 'Sort Up', 'business-class' ),
		'fab fa-soundcloud'                          => __( 'Soundcloud', 'business-class' ),
		'fas fa-space-shuttle'                       => __( 'Space Shuttle', 'business-class' ),
		'fab fa-speakap'                             => __( 'Speakap', 'business-class' ),
		'fas fa-spinner'                             => __( 'Spinner', 'business-class' ),
		'fab fa-spotify'                             => __( 'Spotify', 'business-class' ),
		'fas fa-square'                              => __( 'Square', 'business-class' ),
		'fas fa-square-full'                         => __( 'Square Full', 'business-class' ),
		'fab fa-stack-exchange'                      => __( 'Stack Exchange', 'business-class' ),
		'fab fa-stack-overflow'                      => __( 'Stack Overflow', 'business-class' ),
		'fas fa-star'                                => __( 'Star', 'business-class' ),
		'fas fa-star-half'                           => __( 'Star Half', 'business-class' ),
		'fab fa-staylinked'                          => __( 'Staylinked', 'business-class' ),
		'fab fa-steam'                               => __( 'Steam', 'business-class' ),
		'fab fa-steam-square'                        => __( 'Steam Square', 'business-class' ),
		'fab fa-steam-symbol'                        => __( 'Steam Symbol', 'business-class' ),
		'fas fa-step-backward'                       => __( 'Step Backward', 'business-class' ),
		'fas fa-step-forward'                        => __( 'Step Forward', 'business-class' ),
		'fas fa-stethoscope'                         => __( 'Stethoscope', 'business-class' ),
		'fab fa-sticker-mule'                        => __( 'Sticker Mule', 'business-class' ),
		'fas fa-sticky-note'                         => __( 'Sticky Note', 'business-class' ),
		'fas fa-stop'                                => __( 'Stop', 'business-class' ),
		'fas fa-stop-circle'                         => __( 'Stop Circle', 'business-class' ),
		'fas fa-stopwatch'                           => __( 'Stopwatch', 'business-class' ),
		'fab fa-strava'                              => __( 'Strava', 'business-class' ),
		'fas fa-street-view'                         => __( 'Street View', 'business-class' ),
		'fas fa-strikethrough'                       => __( 'Strikethrough', 'business-class' ),
		'fab fa-stripe'                              => __( 'Stripe', 'business-class' ),
		'fab fa-stripe-s'                            => __( 'Stripe S', 'business-class' ),
		'fab fa-studiovinari'                        => __( 'Studiovinari', 'business-class' ),
		'fab fa-stumbleupon'                         => __( 'Stumbleupon', 'business-class' ),
		'fab fa-stumbleupon-circle'                  => __( 'Stumbleupon Circle', 'business-class' ),
		'fas fa-subscript'                           => __( 'Subscript', 'business-class' ),
		'fas fa-subway'                              => __( 'Subway', 'business-class' ),
		'fas fa-suitcase'                            => __( 'Suitcase', 'business-class' ),
		'fas fa-sun'                                 => __( 'Sun', 'business-class' ),
		'fab fa-superpowers'                         => __( 'Superpowers', 'business-class' ),
		'fas fa-superscript'                         => __( 'Superscript', 'business-class' ),
		'fab fa-supple'                              => __( 'Supple', 'business-class' ),
		'fas fa-sync'                                => __( 'Sync', 'business-class' ),
		'fas fa-sync-alt'                            => __( 'Sync Alt', 'business-class' ),
		'fas fa-syringe'                             => __( 'Syringe', 'business-class' ),
		'fas fa-table'                               => __( 'Table', 'business-class' ),
		'fas fa-table-tennis'                        => __( 'Table Tennis', 'business-class' ),
		'fas fa-tablet'                              => __( 'Tablet', 'business-class' ),
		'fas fa-tablet-alt'                          => __( 'Tablet Alt', 'business-class' ),
		'fas fa-tablets'                             => __( 'Tablets', 'business-class' ),
		'fas fa-tachometer-alt'                      => __( 'Tachometer Alt', 'business-class' ),
		'fas fa-tag'                                 => __( 'Tag', 'business-class' ),
		'fas fa-tags'                                => __( 'Tags', 'business-class' ),
		'fas fa-tape'                                => __( 'Tape', 'business-class' ),
		'fas fa-tasks'                               => __( 'Tasks', 'business-class' ),
		'fas fa-taxi'                                => __( 'Taxi', 'business-class' ),
		'fab fa-telegram'                            => __( 'Telegram', 'business-class' ),
		'fab fa-telegram-plane'                      => __( 'Telegram Plane', 'business-class' ),
		'fab fa-tencent-weibo'                       => __( 'Tencent Weibo', 'business-class' ),
		'fas fa-terminal'                            => __( 'Terminal', 'business-class' ),
		'fas fa-text-height'                         => __( 'Text Height', 'business-class' ),
		'fas fa-text-width'                          => __( 'Text Width', 'business-class' ),
		'fas fa-th'                                  => __( 'Th', 'business-class' ),
		'fas fa-th-large'                            => __( 'Th Large', 'business-class' ),
		'fas fa-th-list'                             => __( 'Th List', 'business-class' ),
		'fab fa-themeisle'                           => __( 'Themeisle', 'business-class' ),
		'fas fa-thermometer'                         => __( 'Thermometer', 'business-class' ),
		'fas fa-thermometer-empty'                   => __( 'Thermometer Empty', 'business-class' ),
		'fas fa-thermometer-full'                    => __( 'Thermometer Full', 'business-class' ),
		'fas fa-thermometer-half'                    => __( 'Thermometer Half', 'business-class' ),
		'fas fa-thermometer-quarter'                 => __( 'Thermometer Quarter', 'business-class' ),
		'fas fa-thermometer-three-quarters'          => __( 'Thermometer Three Quarters', 'business-class' ),
		'fas fa-thumbs-down'                         => __( 'Thumbs Down', 'business-class' ),
		'fas fa-thumbs-up'                           => __( 'Thumbs Up', 'business-class' ),
		'fas fa-thumbtack'                           => __( 'Thumbtack', 'business-class' ),
		'fas fa-ticket-alt'                          => __( 'Ticket Alt', 'business-class' ),
		'fas fa-times'                               => __( 'Times', 'business-class' ),
		'fas fa-times-circle'                        => __( 'Times Circle', 'business-class' ),
		'fas fa-tint'                                => __( 'Tint', 'business-class' ),
		'fas fa-toggle-off'                          => __( 'Toggle Off', 'business-class' ),
		'fas fa-toggle-on'                           => __( 'Toggle On', 'business-class' ),
		'fas fa-trademark'                           => __( 'Trademark', 'business-class' ),
		'fas fa-train'                               => __( 'Train', 'business-class' ),
		'fas fa-transgender'                         => __( 'Transgender', 'business-class' ),
		'fas fa-transgender-alt'                     => __( 'Transgender Alt', 'business-class' ),
		'fas fa-trash'                               => __( 'Trash', 'business-class' ),
		'fas fa-trash-alt'                           => __( 'Trash Alt', 'business-class' ),
		'fas fa-tree'                                => __( 'Tree', 'business-class' ),
		'fab fa-trello'                              => __( 'Trello', 'business-class' ),
		'fab fa-tripadvisor'                         => __( 'Tripadvisor', 'business-class' ),
		'fas fa-trophy'                              => __( 'Trophy', 'business-class' ),
		'fas fa-truck'                               => __( 'Truck', 'business-class' ),
		'fas fa-truck-loading'                       => __( 'Truck Loading', 'business-class' ),
		'fas fa-truck-moving'                        => __( 'Truck Moving', 'business-class' ),
		'fas fa-tty'                                 => __( 'Tty', 'business-class' ),
		'fab fa-tumblr'                              => __( 'Tumblr', 'business-class' ),
		'fab fa-tumblr-square'                       => __( 'Tumblr Square', 'business-class' ),
		'fas fa-tv'                                  => __( 'Tv', 'business-class' ),
		'fab fa-twitch'                              => __( 'Twitch', 'business-class' ),
		'fab fa-twitter'                             => __( 'Twitter', 'business-class' ),
		'fab fa-twitter-square'                      => __( 'Twitter Square', 'business-class' ),
		'fab fa-typo3'                               => __( 'Typo3', 'business-class' ),
		'fab fa-uber'                                => __( 'Uber', 'business-class' ),
		'fab fa-uikit'                               => __( 'Uikit', 'business-class' ),
		'fas fa-umbrella'                            => __( 'Umbrella', 'business-class' ),
		'fas fa-underline'                           => __( 'Underline', 'business-class' ),
		'fas fa-undo'                                => __( 'Undo', 'business-class' ),
		'fas fa-undo-alt'                            => __( 'Undo Alt', 'business-class' ),
		'fab fa-uniregistry'                         => __( 'Uniregistry', 'business-class' ),
		'fas fa-universal-access'                    => __( 'Universal Access', 'business-class' ),
		'fas fa-university'                          => __( 'University', 'business-class' ),
		'fas fa-unlink'                              => __( 'Unlink', 'business-class' ),
		'fas fa-unlock'                              => __( 'Unlock', 'business-class' ),
		'fas fa-unlock-alt'                          => __( 'Unlock Alt', 'business-class' ),
		'fab fa-untappd'                             => __( 'Untappd', 'business-class' ),
		'fas fa-upload'                              => __( 'Upload', 'business-class' ),
		'fab fa-usb'                                 => __( 'Usb', 'business-class' ),
		'fas fa-user'                                => __( 'User', 'business-class' ),
		'fas fa-user-circle'                         => __( 'User Circle', 'business-class' ),
		'fas fa-user-md'                             => __( 'User Md', 'business-class' ),
		'fas fa-user-plus'                           => __( 'User Plus', 'business-class' ),
		'fas fa-user-secret'                         => __( 'User Secret', 'business-class' ),
		'fas fa-user-times'                          => __( 'User Times', 'business-class' ),
		'fas fa-users'                               => __( 'Users', 'business-class' ),
		'fab fa-ussunnah'                            => __( 'Ussunnah', 'business-class' ),
		'fas fa-utensil-spoon'                       => __( 'Utensil Spoon', 'business-class' ),
		'fas fa-utensils'                            => __( 'Utensils', 'business-class' ),
		'fab fa-vaadin'                              => __( 'Vaadin', 'business-class' ),
		'fas fa-venus'                               => __( 'Venus', 'business-class' ),
		'fas fa-venus-double'                        => __( 'Venus Double', 'business-class' ),
		'fas fa-venus-mars'                          => __( 'Venus Mars', 'business-class' ),
		'fab fa-viacoin'                             => __( 'Viacoin', 'business-class' ),
		'fab fa-viadeo'                              => __( 'Viadeo', 'business-class' ),
		'fab fa-viadeo-square'                       => __( 'Viadeo Square', 'business-class' ),
		'fas fa-vial'                                => __( 'Vial', 'business-class' ),
		'fas fa-vials'                               => __( 'Vials', 'business-class' ),
		'fab fa-viber'                               => __( 'Viber', 'business-class' ),
		'fas fa-video'                               => __( 'Video', 'business-class' ),
		'fas fa-video-slash'                         => __( 'Video Slash', 'business-class' ),
		'fab fa-vimeo'                               => __( 'Vimeo', 'business-class' ),
		'fab fa-vimeo-square'                        => __( 'Vimeo Square', 'business-class' ),
		'fab fa-vimeo-v'                             => __( 'Vimeo V', 'business-class' ),
		'fab fa-vine'                                => __( 'Vine', 'business-class' ),
		'fab fa-vk'                                  => __( 'Vk', 'business-class' ),
		'fab fa-vnv'                                 => __( 'Vnv', 'business-class' ),
		'fas fa-volleyball-ball'                     => __( 'Volleyball Ball', 'business-class' ),
		'fas fa-volume-down'                         => __( 'Volume Down', 'business-class' ),
		'fas fa-volume-off'                          => __( 'Volume Off', 'business-class' ),
		'fas fa-volume-up'                           => __( 'Volume Up', 'business-class' ),
		'fab fa-vuejs'                               => __( 'Vuejs', 'business-class' ),
		'fas fa-warehouse'                           => __( 'Warehouse', 'business-class' ),
		'fab fa-weibo'                               => __( 'Weibo', 'business-class' ),
		'fas fa-weight'                              => __( 'Weight', 'business-class' ),
		'fab fa-weixin'                              => __( 'Weixin', 'business-class' ),
		'fab fa-whatsapp'                            => __( 'Whatsapp', 'business-class' ),
		'fab fa-whatsapp-square'                     => __( 'Whatsapp Square', 'business-class' ),
		'fas fa-wheelchair'                          => __( 'Wheelchair', 'business-class' ),
		'fab fa-whmcs'                               => __( 'Whmcs', 'business-class' ),
		'fas fa-wifi'                                => __( 'Wifi', 'business-class' ),
		'fab fa-wikipedia-w'                         => __( 'Wikipedia W', 'business-class' ),
		'fas fa-window-close'                        => __( 'Window Close', 'business-class' ),
		'fas fa-window-maximize'                     => __( 'Window Maximize', 'business-class' ),
		'fas fa-window-minimize'                     => __( 'Window Minimize', 'business-class' ),
		'fas fa-window-restore'                      => __( 'Window Restore', 'business-class' ),
		'fab fa-windows'                             => __( 'Windows', 'business-class' ),
		'fas fa-wine-glass'                          => __( 'Wine Glass', 'business-class' ),
		'fas fa-won-sign'                            => __( 'Won Sign', 'business-class' ),
		'fab fa-wordpress'                           => __( 'Wordpress', 'business-class' ),
		'fab fa-wordpress-simple'                    => __( 'Wordpress Simple', 'business-class' ),
		'fab fa-wpbeginner'                          => __( 'Wpbeginner', 'business-class' ),
		'fab fa-wpexplorer'                          => __( 'Wpexplorer', 'business-class' ),
		'fab fa-wpforms'                             => __( 'Wpforms', 'business-class' ),
		'fas fa-wrench'                              => __( 'Wrench', 'business-class' ),
		'fas fa-x-ray'                               => __( 'X Ray', 'business-class' ),
		'fab fa-xbox'                                => __( 'Xbox', 'business-class' ),
		'fab fa-xing'                                => __( 'Xing', 'business-class' ),
		'fab fa-xing-square'                         => __( 'Xing Square', 'business-class' ),
		'fab fa-y-combinator'                        => __( 'Y Combinator', 'business-class' ),
		'fab fa-yahoo'                               => __( 'Yahoo', 'business-class' ),
		'fab fa-yandex'                              => __( 'Yandex', 'business-class' ),
		'fab fa-yandex-international'                => __( 'Yandex International', 'business-class' ),
		'fab fa-yelp'                                => __( 'Yelp', 'business-class' ),
		'fas fa-yen-sign'                            => __( 'Yen Sign', 'business-class' ),
		'fab fa-yoast'                               => __( 'Yoast', 'business-class' ),
		'fab fa-youtube'                             => __( 'Youtube', 'business-class' ),
		'fab fa-youtube-square'                      => __( 'Youtube Square', 'business-class' ),
	);

	return apply_filters( 'business_class_get_fa_classes', $fa_class );
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/register-metaboxes.php';

/**
 * TGMA plugins.
 */
require get_template_directory() . '/inc/tgm-plugin/tgmpa-hook.php';

/**
 * Theme assets.
 */
require get_template_directory() . '/inc/assets.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

