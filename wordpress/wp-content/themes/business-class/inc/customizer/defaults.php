<?php
/**
 * This file handles the defaults values for the customizer.
 *
 * @package business-class/customizer/
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'business_class_customizer_defaults' ) ) {

	/**
	 * Returns the customizer default data.
	 *
	 * @param string $panel   Panel id name.
	 * @param string $section Section id name.
	 * @param string $field   Field id name.
	 * @return string  Default value.
	 */
	function business_class_customizer_defaults( $panel, $section, $field ) {
		$panel   = business_class_format_string_id_ready( $panel );
		$section = business_class_format_string_id_ready( $section );
		$field   = business_class_format_string_id_ready( $field );

		$footer_credit_text = sprintf( 'Business Class ' . __( 'by', 'business-class' ) . ' <a href="' . esc_url( '//www.bunnytemplates.com' ) . '">Bunny Templates</a> | ' . __( 'Powered by', 'business-class' ) . ' <a href="' . esc_url( '//wordpress.org/' ) . '">WordPress</a>' );

		$defaults = array(
			'front_page'        => array(
				'banner_slider'  => array(
					'enable_section'  => false,
					'align_contents'  => 'text-alignleft',
					'number_of_items' => 3,
				),
				'why_choose_us'  => array(
					'enable_section'  => false,
					'heading'         => '',
					'sub_heading'     => '',
					'number_of_items' => 6,
					'contents_box'    => array(
						array(
							'title'   => '',
							'icon'    => 'fab fa-500px',
							'content' => '',
							'link'    => '',
						),
					),
				),
				'recent_works'   => array(
					'enable_section' => false,
					'heading'        => '',
					'sub_heading'    => '',
				),
				'price_table'    => array(
					'enable_section'   => false,
					'heading'          => '',
					'sub_heading'      => '',
					'table_head_color' => false,
					'packages'         => array(
						array(
							'title'     => '',
							'price'     => '',
							'duration'  => '',
							'features'  => '',
							'btn_label' => '',
							'btn_link'  => '',
						),
					),
				),
				'our_team'       => array(
					'enable_section'  => false,
					'heading'         => '',
					'sub_heading'     => '',
					'contents'        => 'by_category',
					'number_of_items' => 4,
					'teams'           => array(
						array(
							'name'         => '',
							'position'     => '',
							'image'        => '',
							'social_links' => '',
						),
					),
				),
				'our_blogs'      => array(
					'enable_section'  => false,
					'heading'         => '',
					'sub_heading'     => '',
					'number_of_items' => 3,
					'button_label'    => esc_html__( 'Explore More', 'business-class' ),
				),
				'stats'          => array(
					'enable_section' => false,
					'stats'          => array(
						array(
							'title' => '',
							'count' => '',
							'icon'  => '',
						),
					),
				),
				'call_to_action' => array(
					'enable_section' => false,
					'button_label'   => esc_html__( 'Enroll Now', 'business-class' ),
				),
				'testimonials'   => array(
					'enable_section'  => false,
					'heading'         => '',
					'sub_heading'     => '',
					'number_of_items' => 4,
				),
				'contact_us'     => array(
					'enable_section'        => false,
					'heading'               => '',
					'sub_heading'           => '',
					'contact_box_one'       => '<h2 style="padding:15px 10px; background:#fff; margin:0;">' . __( 'Contacts', 'business-class' ) . '</h2>',
					'contact_box_one_title' => '',
					'contact_box_two'       => '<h2 style="padding:15px 10px; background:#fff; margin:0;">' . __( 'Opening Hours', 'business-class' ) . '</h2>',
					'contact_box_two_title' => '',
					'contact_fields'        => array(
						array(
							'icon'           => '',
							'contact_type'   => '',
							'contact_detail' => '',
						),
					),
					'opening_hours'         => array(
						array(
							'icon'     => '',
							'duration' => '',
							'time'     => '',
						),
					),
				),
				'pre_footer'     => array(
					'enable_section'     => false,
					'social_links_title' => '',
					'social_links'       => array(
						array(
							'social_link_type' => '',
							'social_link'      => '',
						),
					),
					'newsletter'         => '<h2 style="padding:15px 10px; background:#fff; margin:15px 0 0 0;">' . __( 'Newsletter', 'business-class' ) . '</h2>',
					'newsletter_title'   => '',

				),
			),
			'theme_options'     => array(
				'top_bar'       => array(
					'enable_top_bar' => true,
					'social_links'   => array(
						array(
							'social_link_type' => '',
							'social_link'      => '',
						),
					),
				),
				'header'        => array(
					'header_style'         => 'solid',
					'enable_header_search' => true,
					'cta_label'            => '<h2 style="padding:15px 10px; background:#fff; margin:15px 0 0 0;">' . __( 'Call To Action', 'business-class' ) . '</h2>',
					'enable_cta'           => true,
					'label'                => '',
				),
				'layouts'       => array(
					'post_layout'     => 'right-sidebar',
					'page_layout'     => 'right-sidebar',
					'archives_layout' => 'right-sidebar',
				),
				'footer'        => array(
					'enable_footer_widgets' => true,
					'footer_credit_text'    => $footer_credit_text,
				),
				'sort_sections' => array(
					'sort_sections' => business_class_get_sections_list( true ),
				),
			),
			'colors'            => array(
				'colors' => array(
					'frontpage_background_color' => '#f8f9fe',
					'primary_color'              => '#3358cd',
					'secondary_color'            => '#254bc6',
				),
			),
			'static_front_page' => array(
				'static_front_page' => array(
					'display_static_content' => true,
				),
			),
		);

		return isset( $defaults[ $panel ][ $section ][ $field ] ) && ! empty( $defaults[ $panel ][ $section ][ $field ] ) ? $defaults[ $panel ][ $section ][ $field ] : '';
	}
}
