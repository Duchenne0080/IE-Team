<?php
/**
 * Loads the assets and custom css and scripts here.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue scripts and styles.
 */
function business_class_scripts() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	$localized = array(
		'is_rtl' => is_rtl() ? 'yes' : '',
	);

	/**
	 * Styles.
	 */

	// Third party CSS.
	wp_enqueue_style( 'business-class-font-poppins', 'https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,900', array(), '1.0.0' );
	wp_enqueue_style( 'business-class-font-roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,500,600,700,900', array(), '1.0.0' );
	wp_enqueue_style( 'business-class-fontawesome', get_template_directory_uri() . "/third-party/fontawesome/all{$min}.css", array(), '5.2.0' );
	wp_enqueue_style( 'business-class-jquery-slick', get_template_directory_uri() . "/third-party/slick/css/slick{$min}.css", array(), '1.6.0' );

	// Custom CSS.
	wp_enqueue_style( 'business-class-style', get_stylesheet_uri(), array(), BUSINESS_CLASS_VERSION );
	wp_enqueue_style( 'business-class-templates', get_template_directory_uri() . '/css/templates.css', array(), BUSINESS_CLASS_VERSION );
	wp_style_add_data( 'business-class-style', 'rtl', 'replace' );

	/**
	 * Scripts.
	 */

	// Core JS.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Third party JS.
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'business-class-jquery-counterup', get_template_directory_uri() . '/third-party/counter-up/js/jquery.counterup' . $min . '.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'business-class-waypoints', get_template_directory_uri() . '/third-party/counter-up/js/waypoints' . $min . '.js', array( 'jquery' ), '2.0.3', true );
	wp_enqueue_script( 'business-class-isotope', get_template_directory_uri() . '/third-party/isotope/js/isotope.pkgd' . $min . '.js', array( 'jquery' ), '1.5.25', true );
	wp_enqueue_script( 'business-class-jquery-slick', get_template_directory_uri() . '/third-party/slick/js/slick' . $min . '.js', array( 'jquery' ), '1.6.0', true );

	// Custom JS.
	wp_enqueue_script( 'business-class-navigation-navigation', get_template_directory_uri() . '/js/navigation' . $min . '.js', array( 'jquery' ), BUSINESS_CLASS_VERSION, true );
	wp_enqueue_script( 'business-class-navigation-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $min . '.js', array( 'jquery' ), BUSINESS_CLASS_VERSION, true );
	wp_register_script( 'business-class-custom', get_template_directory_uri() . '/js/custom' . $min . '.js', array( 'jquery' ), BUSINESS_CLASS_VERSION, true );
	wp_localize_script( 'business-class-custom', 'business_class_localized', $localized );
	wp_enqueue_script( 'business-class-custom' );

}
add_action( 'wp_enqueue_scripts', 'business_class_scripts' );


if ( ! function_exists( 'business_class_custom_css' ) ) {

	/**
	 * Add assets codes to wp head.
	 */
	function business_class_custom_css() {

		$unminify = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;

		$frontpage_background_color = sanitize_hex_color( business_class_get_theme_mod( 'colors', 'colors', 'frontpage_background_color' ) );
		$primary_color              = sanitize_hex_color( business_class_get_theme_mod( 'colors', 'colors', 'primary_color' ) );
		$secondary_color            = sanitize_hex_color( business_class_get_theme_mod( 'colors', 'colors', 'secondary_color' ) );

		$primary_color_light = business_class_colors_hex2rgba( $primary_color, 0.8 );

		$background_color_selectors = '
		.custom-button,
		.custom-button:visited,
		button,
		a.button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.woocommerce #respond input#submit,
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button,
		.woocommerce #respond input#submit.alt,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt,
		.custom-button.button-secondary:hover,
		.custom-button.button-secondary:active,
		.custom-button.button-secondary:focus,
		#main-nav .main-navigation ul ul li.current-menu-item>a,
		#main-nav .main-navigation ul ul li.current-menu-ancestor>a,
		#main-nav .main-navigation ul ul li.current_page_item>a,
		#main-nav .main-navigation ul ul li:hover>a,
		#main-nav .main-navigation ul ul li a:hover,
		#main-nav .main-navigation ul ul li a:focus,
		#main-nav .main-navigation ul ul li a:active,
		#main-nav .main-navigation ul ul li.current-menu-item>a,
		#main-nav .main-navigation ul ul li.current-menu-ancestor>a,
		#main-nav .main-navigation ul ul li.current_page_item>a,
		#main-nav .main-navigation ul ul li:hover>a,
		#main-nav .main-navigation ul ul li a:hover,
		#main-nav .main-navigation ul ul li a:focus,
		#main-nav .main-navigation ul ul li a:active,
		.pagination .nav-links .current,
		.pagination .nav-links a:hover,
		.pagination .nav-links a:active,
		.pagination .nav-links a:focus,
		a.comment-reply-link,
		#footer-widgets, #footer-widgets:after,
		a.scrollup:hover,
		a.scrollup:focus,
		a.scrollup:active,
		.sidebar .widget-title:after,
		.section-featured-slider .slick-prev:hover,
		.section-featured-slider .slick-next:hover,
		.section-latest-posts span.cat-links a:focus,
		.section-latest-posts span.cat-links a:hover,
		.section-latest-posts span.cat-links a:active,
		.section-carousel-style .slick-dots li.slick-active button,
		.section-carousel-style .slick-dots li button:hover,
		#masthead.overlap-header.sticky-enabled.sticky-header,
		.section-featured-slider .slick-dots li.slick-active button, .section-featured-slider .slick-dots li button:hover,
		.social-media.brand-color ul li a:hover,
		.header-top,.section-plan.layout-bg .pricing-plan-item .pricing-plan-header,
		.cta-section .cta-title::before
		';

		$color_selectors = '
		a, a:visited,
		h1 a:hover,
		h2 a:hover,
		h3 a:hover,
		h4 a:hover,
		h5 a:hover,
		h6 a:hover,
		h1 a:focus,
		h2 a:focus,
		h3 a:focus,
		h4 a:focus,
		h5 a:focus,
		h6 a:hover,
		h1 a:active,
		h2 a:active,
		h3 a:active,
		h4 a:active,
		h5 a:active,
		h6 a:active,
		.main-navigation ul li.current-menu-item>a,
		.main-navigation ul li.current-menu-ancestor>a,
		.main-navigation ul li.current_page_item>a,
		.main-navigation ul li:hover>a,
		.main-navigation ul li:hover>a,
		.main-navigation ul li:hover>a,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-title a:active,
		.comment-metadata>a:hover,
		.comment-metadata>a:focus,
		.comment-metadata>a:active,
		#breadcrumb li a:hover,
		#breadcrumb li a:focus,
		#breadcrumb li a:active,
		.sidebar ul li a:hover,
		.sidebar ul li a:focus,
		.sidebar ul li a:active,
		.portfolio-content h3 a:hover,
		.portfolio-content h3 a:focus,
		.portfolio-content h3 a:active,
		.section-counter .counter-icon i,
		.contact-info li i,
		#search-toggle.toggled-on i.far.fa-times-circle,
		.portfolio-filter a.current,
		.portfolio-filter a:hover,
		.section-featured-slider .overlay-enabled h3 a:hover,
		.section-featured-slider .overlay-enabled h3 a:focus,
		.section-featured-slider .overlay-enabled h3 a:active,
		#masthead.light .my-account a,
		#masthead.light #header-search .search-icon,
		#masthead.light a:hover
		';

		$border_color_selector = '
		.pagination .nav-links .current,
		.pagination .nav-links a:hover,
		.pagination .nav-links a:active,
		.pagination .nav-links a:focus,
		.section-featured-slider .slick-prev:hover,
		.section-featured-slider .slick-next:hover
		';

		/**
		 * Quick fix for the header links colors using the dynamic primary color value.
		 */
		$header_color_selector = '
		.overlap-header .main-navigation ul li a,
		.overlap-header #header-search a.search-icon,
		.overlap-header .main-navigation ul li a:visited,
		.overlap-header .site-title a,
		.overlap-header .site-title a:visited,
		.overlap-header p.site-description,
		.overlap-header .my-account a,
		.overlap-header .my-account a:visited
		';

		$masthead_overlap_selectors = '
		#masthead.overlap-header,
		#masthead.overlap-header:after
		';

		$custom_css  = business_class_render_custom_css( $background_color_selectors, 'background-color', $primary_color, $unminify );
		$custom_css .= business_class_render_custom_css( $border_color_selector, 'border-color', $primary_color, $unminify );
		$custom_css .= business_class_render_custom_css( $masthead_overlap_selectors, 'background-color', $primary_color_light, $unminify );
		$custom_css .= business_class_render_custom_css( '#colophon', 'background-color', $secondary_color, $unminify );
		$custom_css .= business_class_render_custom_css( $color_selectors, 'color', $primary_color, $unminify );
		$custom_css .= business_class_render_custom_css( '#masthead.transparent.sticky-header', 'background-color', "{$primary_color} !important", $unminify );

		if ( 'page' === get_option( 'show_on_front' ) ) {
			$custom_css .= business_class_render_custom_css( '#home-sections, aside#section-services', 'background-color', $frontpage_background_color, $unminify );
		}

		if ( 'no-sidebar' === business_class_get_sidebar_layout() ) {
			$custom_css .= business_class_render_custom_css( '#primary', 'width', '100%', $unminify );
		}

		/**
		 * Quick fix for the header links colors using the dynamic primary color value.
		 */
		$custom_css .= business_class_render_custom_css( $header_color_selector, 'color', '#f3f3f3', $unminify );

		?>
		<style id="<?php echo esc_attr( __FUNCTION__ ); ?>">
			<?php echo $custom_css; //phpcs:ignore ?>
		</style>
		<?php

	}
	add_action( 'wp_head', 'business_class_custom_css', 25 );
}

/**
 * Renders the css.
 *
 * @param string $selector CSS selector.
 * @param string $property CSS property eg: background-color.
 * @param string $value CSS property value eg: #ffffff.
 * @param bool   $unminify Whether to return minified or unminified css string. Default is false.
 */
function business_class_render_custom_css( $selector, $property, $value, $unminify = false ) {

	$custom_css = $selector . '{ ' . $property . ':' . $value . '; }';

	if ( ! $unminify ) {
		// Replace all new lines and spaces.
		$custom_css = str_replace( '; ', ';', $custom_css );
		$custom_css = str_replace( ' }', '}', $custom_css );
		$custom_css = str_replace( '{ ', '{', $custom_css );
		$custom_css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_css ) );
	}

	return $custom_css;
}

/**
 * Convert hexdec color string to rgb(a) string.
 *
 * @link https://mekshq.com/how-to-convert-hexadecimal-color-code-to-rgb-or-rgba-using-php/
 *
 * @param string $color Color in hex value | eg: #ffffff or #fff.
 * @param string $opacity Color opacity for RGBA value. If false provided, it will return RGB value.
 */
function business_class_colors_hex2rgba( $color, $opacity = false ) {

	$default = 'rgb(0,0,0)';

	// Return default if no color provided.
	if ( empty( $color ) ) {
		return $default;
	}

	// Sanitize $color if "#" is provided.
	if ( '#' === $color[0] ) {
		$color = substr( $color, 1 );
	}

	// Check if color has 6 or 3 characters and get values.
	if ( strlen( $color ) === 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) === 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	// Convert hexadec to rgb.
	$rgb = array_map( 'hexdec', $hex );

	// Check if opacity is set(rgba or rgb).
	if ( $opacity ) {
		if ( abs( $opacity ) > 1 ) {
			$opacity = 1.0;
		}
		$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
	} else {
		$output = 'rgb(' . implode( ',', $rgb ) . ')';
	}

	// Return rgb(a) color string.
	return $output;
}
