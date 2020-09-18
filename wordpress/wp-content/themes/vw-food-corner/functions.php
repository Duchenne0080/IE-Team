<?php
	add_action( 'wp_enqueue_scripts', 'vw_food_corner_enqueue_styles' );
	function vw_food_corner_enqueue_styles() {
    	$parent_style = 'vw-restaurant-lite-style'; // Style handle of parent theme.
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'vw-food-corner-style', get_stylesheet_uri(), array( $parent_style ) );
	}

	function vw_food_corner_customize_register() {
		global $wp_customize;
		$wp_customize->remove_panel( 'vw_restaurant_lite_typography' ); //Modify this line as needed
		}
	add_action( 'customize_register', 'vw_food_corner_customize_register', 99 );

	function vw_food_corner_customizer ( $wp_customize ) {

		//OUR services
		$wp_customize->add_section('vw_food_corner_services',array(
			'title'	=> __('Look Our Services','vw-food-corner'),
			'description'=> __('This section will appear below the slider.','vw-food-corner'),
			'panel' => 'vw_restaurant_lite_panel_id',
		));

		//Selective Refresh
	  	$wp_customize->selective_refresh->add_partial('vw_food_corner_service_title', array( 
			'selector' => '#our-services h3', 
			'render_callback' => 'vw_restaurant_lite_customize_partial_vw_food_corner_service_title', 
	  	));
			
		$wp_customize->add_setting('vw_food_corner_service_title',array(
			'default'=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
		
		$wp_customize->add_control('vw_food_corner_service_title',array(
			'label'	=> __('Section Title','vw-food-corner'),
			'section'=> 'vw_food_corner_services',
			'setting'=> 'vw_food_corner_service_title',
			'type'=> 'text'
		));

		$wp_customize->add_setting('vw_food_corner_service_text_line',array(
			'default'=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
		
		$wp_customize->add_control('vw_food_corner_service_text_line',array(
			'label'	=> __('Text Line','vw-food-corner'),
			'section'=> 'vw_food_corner_services',
			'setting'=> 'vw_food_corner_service_text_line',
			'type'=> 'text'
		));	

		for ( $count = 0; $count <= 3; $count++ ) {

			$wp_customize->add_setting( 'vw_food_corner_service_page' . $count, array(
				'default'           => '',
				'sanitize_callback' => 'absint'
			));
			$wp_customize->add_control( 'vw_food_corner_service_page' . $count, array(
				'label'    => __( 'Select Service Page', 'vw-food-corner' ),
				'section'  => 'vw_food_corner_services',
				'type'     => 'dropdown-pages'
			));
		}
	}

	add_action( 'customize_register', 'vw_food_corner_customizer' );

	define('VW_FOOD_CORNER_CREDIT',__('https://www.vwthemes.com','vw-food-corner'));

	if ( ! function_exists( 'vw_food_corner_credit' ) ) {
		function vw_food_corner_credit(){
			echo "<a href=".esc_url(VW_FOOD_CORNER_CREDIT)." target='_blank'>". esc_html__('By VWThemes','vw-food-corner') ."</a>";
		}
	}