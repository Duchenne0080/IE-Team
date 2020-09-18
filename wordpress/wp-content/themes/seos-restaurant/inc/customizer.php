<?php
/**
 * All Purpose Theme Customizer
 *
 * @package All Purpose
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function seos_restaurant_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	

/***********************************************************************************
 * Sanitize Functions
***********************************************************************************/
					
		function seos_restaurant_sanitize_checkbox( $input ) {
			if ( $input ) {
				return 1;
			}
			return 0;
		}
/***********************************************************************************/
		
		function seos_restaurant_sanitize_social( $input ) {
			$valid = array(
				'' => esc_attr__( ' ', 'seos-restaurant' ),
				'_self' => esc_attr__( '_self', 'seos-restaurant' ),
				'_blank' => esc_attr__( '_blank', 'seos-restaurant' ),
			);

			if ( array_key_exists( $input, $valid ) ) {
				return $input;
			} else {
				return '';
			}
		}
		

/******************** Seos Restaurant Gallery ******************************************/

	$wp_customize->add_panel('seos_restaurant_gallery', array(
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
		'title'          => __('Home Page Gallery', 'seos-restaurant')
	));


	$wp_customize->add_section( 'seos_restaurant_gallery_general', array(
		'title'		=> __('General', 'seos-restaurant'),
		'priority'	=> 1,
		'panel'		=> 'seos_restaurant_gallery',
		'capability'     => 'edit_theme_options',
	)); 
	
	
	$wp_customize->add_setting( 'seos_restaurant_gallery_activate', array (
		'sanitize_callback' => 'seos_restaurant_sanitize_checkbox',
	) );
				
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_gallery_activate', array(
		'label'    => __( 'Activate Gallery On Home Page and Hide Default Images:', 'seos-restaurant' ),
		'section'  => 'seos_restaurant_gallery_general',
		'settings' => 'seos_restaurant_gallery_activate',
		'type' => 'checkbox',
	) ) );

		$wp_customize->add_setting( 'seos_restaurant_gallery_section_title', array(
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize, 'seos_restaurant_gallery_section_title', array(
				'label'		=> __('Image Gallery Section Title ', 'seos-restaurant'),
				'section'	=> 'seos_restaurant_gallery_general',
				'settings'	=> 'seos_restaurant_gallery_section_title',
				'type'		=> 'text'
			)
		)
	);

for($i=1;$i<=20;$i++) { 

/******************** Images  ******************************************/

	$wp_customize->add_section( 'seos_restaurant_gallery_'.$i, array(
		'title'		=> __('Image '.$i, 'seos-restaurant'),
		'priority'	=> 1,
		'panel'		=> 'seos_restaurant_gallery',
		'capability'     => 'edit_theme_options',
	)); 
	
	$wp_customize->add_setting( 'seos_restaurant_image_title_'.$i, array(
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize, 'seos_restaurant_image_title_'.$i, array(
				'label'		=> __('Image Title '.$i, 'seos-restaurant'),
				'section'	=> 'seos_restaurant_gallery_'.$i,
				'settings'	=> 'seos_restaurant_image_title_'.$i,
				'type'		=> 'text'
			)
		)
	);

	$wp_customize->add_setting( 'seos_restaurant_image_gallery_'.$i, array(
		'default'			=> '',
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize, 'seos_restaurant_image_gallery_'.$i, array(
				'label'			=> __('Image '.$i, 'seos-restaurant'),
				'description'	=> __(' ', 'seos-restaurant'),
				'section'		=> 'seos_restaurant_gallery_'.$i,
				'settings'		=> 'seos_restaurant_image_gallery_'.$i
			)
		)
	);	

	$wp_customize->add_setting( 'seos_restaurant_image_gallery_link_'.$i, array (
		'default' => '#',
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );
		
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_image_gallery_link_'.$i, array(
		'label'    => __( 'Image URL: '.$i, 'seos-restaurant' ),
		'section'  => 'seos_restaurant_gallery_'.$i,
		'settings' => 'seos_restaurant_image_gallery_link_'.$i,
	) ) );	
		
}

/******************** Seos Restaurant Options Panel ******************************************/

	$wp_customize->add_panel('seos_restaurant_options', array(
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
		'title'          => __('Theme Boxes', 'seos-restaurant')
	));



/******************** Boxes 1  ******************************************/

	$wp_customize->add_section( 'seos_restaurant_frontpage_boxes_section', array(
		'title'		=> __('Frontpage Box 1', 'seos-restaurant'),
		'priority'	=> 1,
		'panel'		=> 'seos_restaurant_options',
		'capability'     => 'edit_theme_options',
	)); 
	
 // Frontpage Box 1 Title
	$wp_customize->add_setting( 'seos_restaurant_box_1_title', array(
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'seos_restaurant_box_1_title', array(
				'label'		=> __('Box 1 Title', 'seos-restaurant'),
				'section'	=> 'seos_restaurant_frontpage_boxes_section',
				'settings'	=> 'seos_restaurant_box_1_title',
				'type'		=> 'text'
			)
		)
	);
	
	// Frontpage Box 1 FA Icon
	$wp_customize->add_setting( 'seos_restaurant_box_1_icon', array(
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'seos_restaurant_box_1_icon', array(
				'label'			=> __('Box 1 FontAwesome Icon', 'seos-restaurant'),
				'description'	=> sprintf('%s <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">here</a> %s', __('Learn More', 'seos-restaurant'), __('for all FontAwesome icon classes. For example copy and paste the text - <b>pause-circle</b>', 'seos-restaurant')),
				'section'		=> 'seos_restaurant_frontpage_boxes_section',
				'settings'		=> 'seos_restaurant_box_1_icon',
				'type'			=> 'text'
			)
		)
	);
	
	// Frontpage Box 1 Icon Color
	$wp_customize->add_setting( 'seos_restaurant_box_1_icon_color', array(
		'default'			=> '',
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'seos_restaurant_box_1_icon_color', array(
				'label'		=> __('Box 1 Icon Color', 'seos-restaurant'),
				'section'	=> 'seos_restaurant_frontpage_boxes_section',
				'settings'	=> 'seos_restaurant_box_1_icon_color'
			)
		)
	);
	
	// Frontpage Box 1 Image
	$wp_customize->add_setting( 'seos_restaurant_1_img', array(
		'default'			=> '',
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'seos_restaurant_1_img', array(
				'label'			=> __('Box 1 Image', 'seos-restaurant'),
				'description'	=> __('You can use image instead of FontAwesome icon, just upload it here.', 'seos-restaurant'),
				'section'		=> 'seos_restaurant_frontpage_boxes_section',
				'settings'		=> 'seos_restaurant_1_img'
			)
		)
	);
	
	// Frontpage Box 1 Text
	$wp_customize->add_setting( 'seos_restaurant_box_1_text', array(
		
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'seos_restaurant_box_1_text', array(
				'label'		=> __('Box 1 Text', 'seos-restaurant'),
				'section'	=> 'seos_restaurant_frontpage_boxes_section',
				'settings'	=> 'seos_restaurant_box_1_text',
				'type'		=> 'textarea'
			)
		)
	);
	
	// Frontpage Box 1 URL
	$wp_customize->add_setting( 'seos_restaurant_box_1_url', array (
		'default' => '#',
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );
		
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_box_1_url', array(
		'label'    => __( 'Feature 1 URL:', 'seos-restaurant' ),
		'description'	=> __(' Feature Area 1 URL.', 'seos-restaurant'),
		'section'  => 'seos_restaurant_frontpage_boxes_section',
		'settings' => 'seos_restaurant_box_1_url',
	) ) );	
	
	
/******************** Boxes 2  ******************************************/
	
		$wp_customize->add_section( 'seos_restaurant_frontpage_boxes_section2', array(
		'title'		=> __('Frontpage Box 2', 'seos-restaurant'),
		'priority'	=> 2,
		'panel'		=> 'seos_restaurant_options',
		'capability'     => 'edit_theme_options',
	)); 
	
 // Frontpage Box 2 Title
	$wp_customize->add_setting( 'seos_restaurant_box_2_title', array(
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'seos_restaurant_box_2_title', array(
				'label'		=> __('Box 2 Title', 'seos-restaurant'),
				'section'	=> 'seos_restaurant_frontpage_boxes_section2',
				'settings'	=> 'seos_restaurant_box_2_title',
				'type'		=> 'text'
			)
		)
	); // Frontpage Box 2 FA Icon
	$wp_customize->add_setting( 'seos_restaurant_box_2_icon', array(
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'seos_restaurant_box_2_icon', array(
				'label'			=> __('Box 2 FontAwesome Icon', 'seos-restaurant'),
				'description'	=> sprintf('%s <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">here</a> %s', __('Learn More', 'seos-restaurant'), __('for all FontAwesome icon classes. For example copy and paste the text - <b>pause-circle</b>', 'seos-restaurant')),				
				'section'		=> 'seos_restaurant_frontpage_boxes_section2',
				'settings'		=> 'seos_restaurant_box_2_icon',
				'type'			=> 'text'
			)
		)
	); // Frontpage Box 2 Icon Color
	$wp_customize->add_setting( 'seos_restaurant_box_2_icon_color', array(
		'default'			=> '',
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'seos_restaurant_box_2_icon_color', array(
				'label'		=> __('Box 2 Icon Color', 'seos-restaurant'),
				'section'	=> 'seos_restaurant_frontpage_boxes_section2',
				'settings'	=> 'seos_restaurant_box_2_icon_color'
			)
		)
	); // Frontpage Box 2 Image
	$wp_customize->add_setting( 'seos_restaurant_2_img', array(
		'default'			=> '',
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'seos_restaurant_2_img', array(
				'label'			=> __('Box 2 Image', 'seos-restaurant'),
				'description'	=> __('You can use image instead of FontAwesome icon, just upload it here.', 'seos-restaurant'),
				'section'		=> 'seos_restaurant_frontpage_boxes_section2',
				'settings'		=> 'seos_restaurant_2_img'
			)
		)
	);// Frontpage Box 2 Text
	$wp_customize->add_setting( 'seos_restaurant_box_2_text', array(	
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'seos_restaurant_box_2_text', array(
				'label'		=> __('Box 2 Text', 'seos-restaurant'),
				'section'	=> 'seos_restaurant_frontpage_boxes_section2',
				'settings'	=> 'seos_restaurant_box_2_text',
				'type'		=> 'textarea'
			)
		)
	); 
	
	// Frontpage Box 2 URL
	$wp_customize->add_setting( 'seos_restaurant_box_2_url', array (
		'default' => '#',
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );
		
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_box_2_url', array(
		'label'    => __( 'Feature 2 URL:', 'seos-restaurant' ),
		'description'	=> __(' Feature Area 2 URL.', 'seos-restaurant'),
		'section'  => 'seos_restaurant_frontpage_boxes_section2',
		'settings' => 'seos_restaurant_box_2_url',
	) ) );		
	
	
/******************** Boxes 3  ******************************************/
	
		$wp_customize->add_section( 'seos_restaurant_frontpage_boxes_section3', array(
		'title'		=> __('Frontpage Box 3', 'seos-restaurant'),
		'priority'	=> 3,
		'panel'		=> 'seos_restaurant_options',
		'capability'     => 'edit_theme_options',
	)); 
	
 // Frontpage Box 3 Title
	$wp_customize->add_setting( 'seos_restaurant_box_3_title', array(
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'seos_restaurant_box_3_title', array(
				'label'		=> __('Box 3 Title', 'seos-restaurant'),
				'section'	=> 'seos_restaurant_frontpage_boxes_section3',
				'settings'	=> 'seos_restaurant_box_3_title',
				'type'		=> 'text'
			)
		)
	); // Frontpage Box 3 FA Icon
	$wp_customize->add_setting( 'seos_restaurant_box_3_icon', array(
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'seos_restaurant_box_3_icon', array(
				'label'			=> __('Box 3 FontAwesome Icon', 'seos-restaurant'),
				'description'	=> sprintf('%s <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">here</a> %s', __('Learn More', 'seos-restaurant'), __('for all FontAwesome icon classes. For example copy and paste the text - <b>pause-circle</b>', 'seos-restaurant')),				
				'section'		=> 'seos_restaurant_frontpage_boxes_section3',
				'settings'		=> 'seos_restaurant_box_3_icon',
				'type'			=> 'text'
			)
		)
	); // Frontpage Box 3 Icon Color
	$wp_customize->add_setting( 'seos_restaurant_box_3_icon_color', array(
		'default'			=> '',
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'seos_restaurant_box_3_icon_color', array(
				'label'		=> __('Box 3 Icon Color', 'seos-restaurant'),
				'section'	=> 'seos_restaurant_frontpage_boxes_section3',
				'settings'	=> 'seos_restaurant_box_3_icon_color'
			)
		)
	); // Frontpage Box 3 Image
	$wp_customize->add_setting( 'seos_restaurant_3_img', array(
		'default'			=> '',
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'seos_restaurant_3_img', array(
				'label'			=> __('Box 3 Image', 'seos-restaurant'),
				'description'	=> __('You can use image instead of FontAwesome icon, just upload it here.', 'seos-restaurant'),
				'section'		=> 'seos_restaurant_frontpage_boxes_section3',
				'settings'		=> 'seos_restaurant_3_img'
			)
		)
	);// Frontpage Box 3 Text
	$wp_customize->add_setting( 'seos_restaurant_box_3_text', array(
		
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'seos_restaurant_box_3_text', array(
				'label'		=> __('Box 3 Text', 'seos-restaurant'),
				'section'	=> 'seos_restaurant_frontpage_boxes_section3',
				'settings'	=> 'seos_restaurant_box_3_text',
				'type'		=> 'textarea'
			)
		)
	); 
	
	// Frontpage Box 3 URL
	$wp_customize->add_setting( 'seos_restaurant_box_3_url', array (
		'default' => '#',
		'capability'		=> 'edit_theme_options',
		'transport'			=> 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );
		
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_box_3_url', array(
		'label'    => __( 'Feature 3 URL:', 'seos-restaurant' ),
		'description'	=> __(' Feature Area 3 URL.', 'seos-restaurant'),
		'section'  => 'seos_restaurant_frontpage_boxes_section3',
		'settings' => 'seos_restaurant_box_3_url',
	) ) );
		
	
		
/***********************************************************************************
 * Social media option
***********************************************************************************/
 
		$wp_customize->add_section( 'seos_restaurant_social_section' , array(
			'title'       => __( 'Social Media', 'seos-restaurant' ),
			'description' => __( 'Social media buttons', 'seos-restaurant' ),
			'priority'   => 64,
		) );
		
		$wp_customize->add_setting( 'social_media_activate_header', array (
			'sanitize_callback' => 'seos_restaurant_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_media_activate_header', array(
			'label'    => __( 'Activate Social Icons in Header:', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'social_media_activate_header',
			'type' => 'checkbox',
		) ) );
		
		$wp_customize->add_setting( 'social_media_activate', array (
			'sanitize_callback' => 'seos_restaurant_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_media_activate', array(
			'label'    => __( 'Activate Social Icons in Footer:', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'social_media_activate',
			'type' => 'checkbox',
		) ) );
		
		$wp_customize->add_setting( 'seos_restaurant_social_link_type', array (
			'sanitize_callback' => 'seos_restaurant_sanitize_social',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_social_link_type', array(
			'label'    => __( 'Link Type', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_social_link_type',
			'type'     =>  'select',
            'choices'  => array(
				'' => esc_attr__( ' ', 'seos-restaurant' ),
				'_self' => esc_attr__( '_self', 'seos-restaurant' ),
				'_blank' => esc_attr__( '_blank', 'seos-restaurant' ),
            ),			
		) ) );
		
		$wp_customize->add_setting( 'social_media_color', array (
			'sanitize_callback' => 'sanitize_hex_color',
		) );
				
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'social_media_color', array(
			'label'    => __( 'Social Icons Color:', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'social_media_color',
		) ) );
				
		$wp_customize->add_setting( 'social_media_hover_color', array (
			'sanitize_callback' => 'sanitize_hex_color',
		) );
				
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'social_media_hover_color', array(
			'label'    => __( 'Social Hover Icons Color:', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'social_media_hover_color',
		) ) );
		
		$wp_customize->add_setting( 'seos_restaurant_facebook', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_facebook', array(
			'label'    => __( 'Enter Facebook url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_facebook',
		) ) );
	
		$wp_customize->add_setting( 'seos_restaurant_twitter', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_twitter', array(
			'label'    => __( 'Enter Twitter url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_twitter',
		) ) );

		$wp_customize->add_setting( 'seos_restaurant_google', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_google', array(
			'label'    => __( 'Enter Google+ url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_google',
		) ) );
		
		$wp_customize->add_setting( 'seos_restaurant_linkedin', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_linkedin', array(
			'label'    => __( 'Enter Linkedin url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_linkedin',
		) ) );


		$wp_customize->add_setting( 'seos_restaurant_rss', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_rss', array(
			'label'    => __( 'Enter RSS url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_rss',
		) ) );
		
		$wp_customize->add_setting( 'seos_restaurant_pinterest', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_pinterest', array(
			'label'    => __( 'Enter Pinterest url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_pinterest',
		) ) );
		
		$wp_customize->add_setting( 'seos_restaurant_youtube', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_youtube', array(
			'label'    => __( 'Enter Youtube url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_youtube',
		) ) );
					
		$wp_customize->add_setting( 'seos_restaurant_vimeo', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_vimeo', array(
			'label'    => __( 'Enter Vimeo url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_vimeo',
		) ) );
		
							
		$wp_customize->add_setting( 'seos_restaurant_instagram', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_instagram', array(
			'label'    => __( 'Enter Ynstagram url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_instagram',
		) ) );
			
		$wp_customize->add_setting( 'seos_restaurant_stumbleupon', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_stumbleupon', array(
			'label'    => __( 'Enter Stumbleupon url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_stumbleupon',
		) ) );
											
		$wp_customize->add_setting( 'seos_restaurant_flickr', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_flickr', array(
			'label'    => __( 'Enter Flickr url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_flickr',
		) ) );
		
													
		$wp_customize->add_setting( 'seos_restaurant_dribbble', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_dribbble', array(
			'label'    => __( 'Enter Dribbble url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_dribbble',
		) ) );
															
		$wp_customize->add_setting( 'seos_restaurant_digg', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_digg', array(
			'label'    => __( 'Enter Digg url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_digg',
		) ) );
																	
		$wp_customize->add_setting( 'seos_restaurant_skype', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_skype', array(
			'label'    => __( 'Enter Skype url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_skype',
		) ) );
																			
		$wp_customize->add_setting( 'seos_restaurant_deviantart', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_deviantart', array(
			'label'    => __( 'Enter Deviantart url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_deviantart',
		) ) );
																					
		$wp_customize->add_setting( 'seos_restaurant_yahoo', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_yahoo', array(
			'label'    => __( 'Enter Yahoo url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_yahoo',
		) ) );
																							
		$wp_customize->add_setting( 'seos_restaurant_reddit_alien', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_reddit_alien', array(
			'label'    => __( 'Enter Reddit Alien url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_reddit_alien',
		) ) );
		
																									
		$wp_customize->add_setting( 'seos_restaurant_paypal', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_paypal', array(
			'label'    => __( 'Enter Paypal url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_paypal',
		) ) );
																											
		$wp_customize->add_setting( 'seos_restaurant_dropbox', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_dropbox', array(
			'label'    => __( 'Enter Dropbox url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_dropbox',
		) ) );
																													
		$wp_customize->add_setting( 'seos_restaurant_soundcloud', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_soundcloud', array(
			'label'    => __( 'Enter Soundcloud url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_soundcloud',
		) ) );
		
																															
		$wp_customize->add_setting( 'seos_restaurant_vk', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_vk', array(
			'label'    => __( 'Enter VK url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_vk',
		) ) );
																																	
		$wp_customize->add_setting( 'seos_restaurant_envelope', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_envelope', array(
			'label'    => __( 'Enter Envelope url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_envelope',
		) ) );
																																			
		$wp_customize->add_setting( 'seos_restaurant_address_book', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_address_book', array(
			'label'    => __( 'Enter Address Book url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_address_book',
		) ) );
																																					
		$wp_customize->add_setting( 'seos_restaurant_address_apple', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_address_apple', array(
			'label'    => __( 'Enter Apple url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_address_apple',
		) ) );
																																							
		$wp_customize->add_setting( 'seos_restaurant_address_apple', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_address_amazon', array(
			'label'    => __( 'Enter Amazon url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_address_amazon',
		) ) );
																																									
		$wp_customize->add_setting( 'seos_restaurant_address_slack', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_address_slack', array(
			'label'    => __( 'Enter Slack url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_address_slack',
		) ) );
																																											
		$wp_customize->add_setting( 'seos_restaurant_address_slideshare', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_address_slideshare', array(
			'label'    => __( 'Enter Slideshare url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_address_slideshare',
		) ) );
																																													
		$wp_customize->add_setting( 'seos_restaurant_address_wikipedia', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_address_wikipedia', array(
			'label'    => __( 'Enter Wikipedia url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_address_wikipedia',
		) ) );
																																															
		$wp_customize->add_setting( 'seos_restaurant_address_wordpress', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_address_wordpress', array(
			'label'    => __( 'Enter Wordpress url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_address_wordpress',
		) ) );
																																																	
		$wp_customize->add_setting( 'seos_restaurant_address_odnoklassniki', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_address_odnoklassniki', array(
			'label'    => __( 'Enter Odnoklassniki url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_address_odnoklassniki',
		) ) );
																																																			
		$wp_customize->add_setting( 'seos_restaurant_address_tumblr', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_address_tumblr', array(
			'label'    => __( 'Enter Tumblr url', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_social_section',
			'settings' => 'seos_restaurant_address_tumblr',
		) ) );
			
	
		
/***********************************************************************************
 * Sidebar Options
***********************************************************************************/
 
		$wp_customize->add_section( 'seos_restaurant_sidebar' , array(
			'title'       => __( 'Sidebar Options', 'seos-restaurant' ),
			'priority'   => 64,
		) );
		
		$wp_customize->add_setting( 'seos_restaurant_sidebar_width', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_sidebar_width', array(
			'label'    => __( 'Sidebar Width:', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_sidebar',		
			'settings' => 'seos_restaurant_sidebar_width',
			'type'     =>  'range',		
			'input_attrs'     => array(
				'min'  => 10,
				'max'  => 50,
				'step' => 1,
	),			
		) ) );
		
		$wp_customize->add_setting( 'seos_restaurant_sidebar_position', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seos_restaurant_sidebar_position', array(
			'label'    => __( 'Sidebar Position', 'seos-restaurant' ),
			'section'  => 'seos_restaurant_sidebar',
			'settings' => 'seos_restaurant_sidebar_position',
			'type' => 'radio',
			'choices' => array(
				'1' => __( 'Left', 'seos-restaurant' ),
				'2' => __( 'Right', 'seos-restaurant' ),
				'3' => __( 'No Sidebar', 'seos-restaurant' ),
				),			
			
		) ) );
		
/********************************************
* Sidebar Title Background
*********************************************/ 
	
		$wp_customize->add_setting('seos_restaurant_aside_background_color', array(         
		'default'     => '',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seos_restaurant_aside_background_color', array(
		'label' => __('Sidebar Title Background Color', 'seos-restaurant'),        
		'section' => 'seos_restaurant_sidebar',
		'settings' => 'seos_restaurant_aside_background_color'
		)));
		
/********************************************
* Sidebar Title Color
*********************************************/ 
	
		$wp_customize->add_setting('seos_restaurant_aside_title_color', array(         
		'default'     => '',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seos_restaurant_aside_title_color', array(
		'label' => __('Sidebar Title Color', 'seos-restaurant'),        
		'section' => 'seos_restaurant_sidebar',
		'settings' => 'seos_restaurant_aside_title_color'
		)));

/********************************************
* Sidebar Background
*********************************************/ 
	
		$wp_customize->add_setting('seos_restaurant_aside_background_color1', array(         
		'default'     => '',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seos_restaurant_aside_background_color1', array(
		'label' => __('Sidebar Background Color', 'seos-restaurant'),        
		'section' => 'seos_restaurant_sidebar',
		'settings' => 'seos_restaurant_aside_background_color1'
		)));
		
/********************************************
* Sidebar Link Color
*********************************************/ 
	
		$wp_customize->add_setting('seos_restaurant_aside_link_color', array(         
		'default'     => '',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seos_restaurant_aside_link_color', array(
		'label' => __('Sidebar Link Color', 'seos-restaurant'),        
		'section' => 'seos_restaurant_sidebar',
		'settings' => 'seos_restaurant_aside_link_color'
		)));
						
/********************************************
* Sidebar Link Hover Color
*********************************************/ 
	
		$wp_customize->add_setting('seos_restaurant_aside_link_hover_color', array(         
		'default'     => '',
		'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'seos_restaurant_aside_link_hover_color', array(
		'label' => __('Sidebar Link Hover Color', 'seos-restaurant'),        
		'section' => 'seos_restaurant_sidebar',
		'settings' => 'seos_restaurant_aside_link_hover_color'
		)));
			
	
	
	
	
	
}
add_action( 'customize_register', 'seos_restaurant_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function seos_restaurant_customize_preview_js() {
	wp_enqueue_script( 'seos_restaurant_customizer', get_template_directory_uri() . '/framework/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'seos_restaurant_customize_preview_js' );


		function seos_restaurant_customize_all_css() {
    ?>
		<style type="text/css">

			<?php if(get_theme_mod('seos_restaurant_aside_background_color')) { ?>#content aside h2 {background:<?php echo esc_html(get_theme_mod('seos_restaurant_aside_background_color')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('seos_restaurant_aside_background_color1')) { ?>#content aside ul, #content .widget {background:<?php echo esc_html(get_theme_mod('seos_restaurant_aside_background_color1')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('seos_restaurant_aside_title_color')) { ?>#content aside h2 {color:<?php echo esc_html(get_theme_mod('seos_restaurant_aside_title_color')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('seos_restaurant_aside_link_color')) { ?>#content aside a {color:<?php echo esc_html(get_theme_mod('seos_restaurant_aside_link_color')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('seos_restaurant_aside_link_hover_color')) { ?>#content aside a:hover {color:<?php echo esc_html(get_theme_mod('seos_restaurant_aside_link_hover_color')); ?>;} <?php } ?> 
			
			<?php if(get_theme_mod('social_media_color')) { ?> .social .fa-icons i {color:<?php echo esc_html(get_theme_mod('social_media_color')); ?> !important;} <?php } ?> 
			<?php if(get_theme_mod('social_media_hover_color')) { ?> .social .fa-icons i:hover {color:<?php echo esc_html(get_theme_mod('social_media_hover_color')); ?> !important;} <?php } ?>

			<?php if(get_theme_mod('seos_restaurant_titles_setting_1')) { ?> .single-title, .sr-no-sidebar .entry-title, .full-p .entry-title { display: none !important;} <?php } ?>

		</style>
		
    <?php	
}
		add_action('wp_head', 'seos_restaurant_customize_all_css');
		
/**************************************
Sidebar Options
**************************************/


	

	function seos_restaurant_sidebar_width () {
		if(get_theme_mod('seos_restaurant_sidebar_width')) {
	
	$seos_restaurant_content_width = 96;
	$seos_restaurant_sidebar_width = esc_html(get_theme_mod('seos_restaurant_sidebar_width'));
	$seos_restaurant_sidebar_sum = $seos_restaurant_content_width - $seos_restaurant_sidebar_width;

	?>
		<style>
			#content aside {width: <?php echo esc_html(get_theme_mod('seos_restaurant_sidebar_width')); ?>% !important;}
			#content main {width: <?php echo $seos_restaurant_sidebar_sum; ?>%  !important;}
		</style>
		
	<?php }
}
	add_action('wp_head','seos_restaurant_sidebar_width');
	

	
/*********************************************************************************************************
* Sidebar Position
**********************************************************************************************************/

	function seos_restaurant_sidebar(){
	$option_sidebar = esc_html(get_theme_mod( 'seos_restaurant_sidebar_position'));		
	if($option_sidebar == '2') { 
		$style_sidebar = wp_enqueue_style( 'seos_restaurant-right-sidebar', get_template_directory_uri() . '/css/right-sidebar.css');
		}
	}
	add_action( 'wp_enqueue_scripts', 'seos_restaurant_sidebar' );
	
	function seos_restaurant_sidebar_1(){
	$option_sidebar = esc_html(get_theme_mod( 'seos_restaurant_sidebar_position'));			
		if($option_sidebar == '3') { 

		$style_sidebar = wp_enqueue_style( 'seos_restaurant-no-sidebar', get_template_directory_uri() . '/css/no-sidebar.css');
		}
	}
	add_action( 'wp_enqueue_scripts', 'seos_restaurant_sidebar_1' );


/***********************************************************************************
 * Seos Restaurant Buy
***********************************************************************************/

		function seos_restaurant_support($wp_customize){
			class seos_restaurant_Customize extends WP_Customize_Control {
				public function render_content() { ?>
				<div class="seos_restaurant-info"> 
						<a href="<?php echo esc_url( '//seosthemes.info/seos-restaurant-free-wordpress-theme/' ); ?>" title="<?php esc_attr_e( 'Seos Restaurant Premium', 'seos-restaurant' ); ?>" target="_blank">
						<?php _e( 'Preview Premium', 'seos-restaurant' ); ?>
						</a>
				</div>
				<?php
				}
			}
		}
		add_action('customize_register', 'seos_restaurant_support');

		function customize_styles_seos_restaurant( $input ) { ?>
			<style type="text/css">
				#customize-theme-controls #accordion-panel-seos_restaurant_buy_panel .accordion-section-title,
				#customize-theme-controls #accordion-panel-seos_restaurant_buy_panel > .accordion-section-title {
					background: #555555;
					color: #FFFFFF;
				}

				.seos_restaurant-info button a {
					color: #FFFFFF;
				}

				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section1 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section2 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section3 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section4 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section5 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section6 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section7 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section8 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section9 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section10 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section11 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section12 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section13 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section14 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section15 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section16 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section17 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section18 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section19 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section20 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section21 .accordion-section-title:after,
				#customize-theme-controls   #accordion-section-seos_restaurant_buy_section22 .accordion-section-title:after {
					font-size: 13px;
					font-weight: bold;
					content: "Premium";
					float: right;
					right: 40px;
					position: relative;
					color: #FF0000;
				}			
				
				#_customize-input-seos_restaurant_setting0 {
					display: none;
				}
				
			</style>
		<?php }
		
		add_action( 'customize_controls_print_styles', 'customize_styles_seos_restaurant');

		if ( ! function_exists( 'seos_restaurant_buy' ) ) :
			function seos_restaurant_buy( $wp_customize ) {
			$wp_customize->add_panel( 'seos_restaurant_buy_panel', array(
				'title'			=> __('Seos Restaurant Premium', 'seos-restaurant'),
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 190,
			));
			
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section0', array(
				'title'			=> __('Preview The Theme', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	<a href="//seosthemes.com/seos-restaurant/" target="_blank">Learn more about Seos Restaurant.</a> ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting0', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,'seos_restaurant_setting0', array(
						'section'	=> 'seos_restaurant_buy_section0',
						'settings'	=> 'seos_restaurant_setting0',
					)
				)
			);
						
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section', array(
				'title'			=> __('Menu Slider', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting', array(
						'label'		=> __('Menu Slider', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section',
						'settings'	=> 'seos_restaurant_setting',
					)
				)
			);
			
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section1', array(
				'title'			=> __('Contacts', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting1', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting1', array(
						'label'		=> __('Contacts', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section1',
						'settings'	=> 'seos_restaurant_setting1',
					)
				)
			);
						
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section2', array(
				'title'			=> __('Animations', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting2', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting2', array(
						'label'		=> __('Animations', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section2',
						'settings'	=> 'seos_restaurant_setting2',
					)
				)
			);
									
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section3', array(
				'title'			=> __('All Google Fonts', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting3', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting3', array(
						'label'		=> __('All Google Fonts', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section3',
						'settings'	=> 'seos_restaurant_setting3',
					)
				)
			);
												
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section4', array(
				'title'			=> __('Banners', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting4', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting4', array(
						'label'		=> __('Banners', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section4',
						'settings'	=> 'seos_restaurant_setting4',
					)
				)
			);
															
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section5', array(
				'title'			=> __('Shortcode Scroll Animation', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting5', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting5', array(
						'label'		=> __('Shortcode Scroll Animation', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section5',
						'settings'	=> 'seos_restaurant_setting5',
					)
				)
			);
																		
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section6', array(
				'title'			=> __('About US Section', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting6', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting6', array(
						'label'		=> __('About US Section', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section6',
						'settings'	=> 'seos_restaurant_setting6',
					)
				)
			);
																					
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section7', array(
				'title'			=> __('Disabel all Comments', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting7', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting7', array(
						'label'		=> __('Disabel all Comments', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section7',
						'settings'	=> 'seos_restaurant_setting7',
					)
				)
			);
																								
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section8', array(
				'title'			=> __('Entry Meta', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting8', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting8', array(
						'label'		=> __('Entry Meta', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section8',
						'settings'	=> 'seos_restaurant_setting8',
					)
				)
			);
			
																											
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section9', array(
				'title'			=> __('Hide All Titles', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting9', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting9', array(
						'label'		=> __('Hide All Titles', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section9',
						'settings'	=> 'seos_restaurant_setting9',
					)
				)
			);
																														
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section10', array(
				'title'			=> __('Mobile Call Now', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting10', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting10', array(
						'label'		=> __('Mobile Call Now', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section10',
						'settings'	=> 'seos_restaurant_setting10',
					)
				)
			);
																																	
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section11', array(
				'title'			=> __('Testimonials Post Type', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting11', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting11', array(
						'label'		=> __('Testimonials Custom Post Type', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section11',
						'settings'	=> 'seos_restaurant_setting11',
					)
				)
			);
																																				
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section12', array(
				'title'			=> __('WooCommerce Colors', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting12', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting12', array(
						'label'		=> __('WooCommerce Colors', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section12',
						'settings'	=> 'seos_restaurant_setting12',
					)
				)
			);
			
																																							
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section13', array(
				'title'			=> __('WooCommerce Options', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting13', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting13', array(
						'label'		=> __('WooCommerce Options', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section13',
						'settings'	=> 'seos_restaurant_setting13',
					)
				)
			);
																																										
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section14', array(
				'title'			=> __('Footer Options', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting14', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting14', array(
						'label'		=> __('Footer Options', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section14',
						'settings'	=> 'seos_restaurant_setting14',
					)
				)
			);
																																													
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section15', array(
				'title'			=> __('Font Sizes', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting15', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting15', array(
						'label'		=> __('Font Sizes', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section15',
						'settings'	=> 'seos_restaurant_setting15',
					)
				)
			);
																																																
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section16', array(
				'title'			=> __('Under Construction', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting16', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting16', array(
						'label'		=> __('Under Construction', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section16',
						'settings'	=> 'seos_restaurant_setting16',
					)
				)
			);
																																																			
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section17', array(
				'title'			=> __('Read More Button Options', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting17', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting17', array(
						'label'		=> __('Read More Button Options', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section17',
						'settings'	=> 'seos_restaurant_setting17',
					)
				)
			);
																																																						
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section18', array(
				'title'			=> __('Pagination Options', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting18', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting18', array(
						'label'		=> __('Pagination Options', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section18',
						'settings'	=> 'seos_restaurant_setting18',
					)
				)
			);
																																																									
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section19', array(
				'title'			=> __('Antispam Login Form', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting19', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting19', array(
						'label'		=> __('Antispam Login Form', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section19',
						'settings'	=> 'seos_restaurant_setting19',
					)
				)
			);
																																																												
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section20', array(
				'title'			=> __('Back To Top Button Options', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting20', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting20', array(
						'label'		=> __('Back To Top Button Options', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section20',
						'settings'	=> 'seos_restaurant_setting20',
					)
				)
			);
																																																															
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section21', array(
				'title'			=> __('Copy Protection', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting21', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting21', array(
						'label'		=> __('Copy Protection', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section21',
						'settings'	=> 'seos_restaurant_setting21',
					)
				)
			);
																																																																		
/******************************************************************************/
		
			$wp_customize->add_section( 'seos_restaurant_buy_section22', array(
				'title'			=> __('Custom JS', 'seos-restaurant'),
				'panel'			=> 'seos_restaurant_buy_panel',
				'description'	=> __('	Learn more about Seos Restaurant. ','seos-restaurant'),
				'priority'		=> 3,
			));			
			
			$wp_customize->add_setting( 'seos_restaurant_setting22', array(
				'capability'		=> 'edit_theme_options',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new seos_restaurant_Customize(
					$wp_customize,'seos_restaurant_setting22', array(
						'label'		=> __('Custom JS', 'seos-restaurant'),
						'section'	=> 'seos_restaurant_buy_section22',
						'settings'	=> 'seos_restaurant_setting22',
					)
				)
			);
			
			
		}
		endif;
		 
		add_action('customize_register', 'seos_restaurant_buy');
		
		
		