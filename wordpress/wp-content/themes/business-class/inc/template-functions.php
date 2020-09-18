<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package business-class
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function business_class_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add sidebar class to body.
	$classes[] = esc_attr( business_class_get_sidebar_layout() );

	return $classes;
}
add_filter( 'body_class', 'business_class_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function business_class_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'business_class_pingback_header' );

if ( ! function_exists( 'business_class_frontpage_section_banner_slider' ) ) {

	/**
	 * Section function for static frontpage.
	 */
	function business_class_frontpage_section_banner_slider() {
		get_template_part( 'template-parts/front-page/sections/banner-slider' );
	}
}

if ( ! function_exists( 'business_class_frontpage_section_static_content' ) ) {

	/**
	 * Section function for static frontpage.
	 */
	function business_class_frontpage_section_static_content() {
		get_template_part( 'template-parts/front-page/sections/static-content' );
	}
}

if ( ! function_exists( 'business_class_frontpage_section_why_choose_us' ) ) {

	/**
	 * Section function for static frontpage.
	 */
	function business_class_frontpage_section_why_choose_us() {
		get_template_part( 'template-parts/front-page/sections/why-choose-us' );
	}
}

if ( ! function_exists( 'business_class_frontpage_section_recent_works' ) ) {

	/**
	 * Section function for static frontpage.
	 */
	function business_class_frontpage_section_recent_works() {
		get_template_part( 'template-parts/front-page/sections/recent-works' );
	}
}

if ( ! function_exists( 'business_class_frontpage_section_our_team' ) ) {

	/**
	 * Section function for static frontpage.
	 */
	function business_class_frontpage_section_our_team() {
		get_template_part( 'template-parts/front-page/sections/our-team' );
	}
}

if ( ! function_exists( 'business_class_frontpage_section_our_blogs' ) ) {

	/**
	 * Section function for static frontpage.
	 */
	function business_class_frontpage_section_our_blogs() {
		get_template_part( 'template-parts/front-page/sections/our-blogs' );
	}
}

if ( ! function_exists( 'business_class_frontpage_section_call_to_action' ) ) {

	/**
	 * Section function for static frontpage.
	 */
	function business_class_frontpage_section_call_to_action() {
		get_template_part( 'template-parts/front-page/sections/call-to-action' );
	}
}

if ( ! function_exists( 'business_class_frontpage_section_testimonials' ) ) {

	/**
	 * Section function for static frontpage.
	 */
	function business_class_frontpage_section_testimonials() {
		get_template_part( 'template-parts/front-page/sections/testimonials' );
	}
}

if ( ! function_exists( 'business_class_frontpage_section_contact_us' ) ) {

	/**
	 * Section function for static frontpage.
	 */
	function business_class_frontpage_section_contact_us() {
		get_template_part( 'template-parts/front-page/sections/contact-us' );
	}
}

if ( ! function_exists( 'business_class_frontpage_section_pre_footer' ) ) {

	/**
	 * Section function for static frontpage.
	 */
	function business_class_frontpage_section_pre_footer() {
		get_template_part( 'template-parts/front-page/sections/pre-footer' );
	}
}

if ( ! function_exists( 'business_class_get_sections_list' ) ) {

	/**
	 * Returns the list of default sections of static frontpage.
	 *
	 * @param bool $keys Whether to return array keys only or not.
	 */
	function business_class_get_sections_list( $keys = false ) {

		$sections = array(
			'banner_slider'  => __( 'Banner Slider', 'business-class' ),
			'why_choose_us'  => __( 'Why Choose Us', 'business-class' ),
			'static_content' => __( 'Static Content', 'business-class' ),
			'recent_works'   => __( 'Recent Works', 'business-class' ),
			'our_team'       => __( 'Our Team', 'business-class' ),
			'our_blogs'      => __( 'Our Blogs', 'business-class' ),
			'call_to_action' => __( 'Call To Action', 'business-class' ),
			'testimonials'   => __( 'Testimonials', 'business-class' ),
			'contact_us'     => __( 'Contact Us', 'business-class' ),
			'pre_footer'     => __( 'Pre Footer', 'business-class' ),
		);

		return $keys ? array_keys( $sections ) : $sections;

	}
}


if ( ! function_exists( 'business_class_load_frontpage_sections' ) ) {

	/**
	 * Loads the frontpage section files.
	 */
	function business_class_load_frontpage_sections() {

		/**
		 * Default or sorted sections.
		 */
		$sections = business_class_get_theme_mod( 'Theme Options', 'Sort Sections', 'Sort Sections' );

		$sections = apply_filters( 'business_class_frontpage_sections', $sections );

		if ( is_array( $sections ) && ! empty( $sections ) ) {
			foreach ( $sections as $section ) {
				add_action( 'business_class_frontpage', "business_class_frontpage_section_{$section}" );
			}
		}

	}
	add_action( 'wp_head', 'business_class_load_frontpage_sections' );
}
