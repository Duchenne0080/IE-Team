<?php
/**
 * Add Top Bar section and it's fields inside Header section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_top_bar_fields' );

if ( ! function_exists( 'matina_register_top_bar_fields' ) ) :

    /**
     * Register Top Bar section's fields.
     */
    function matina_register_top_bar_fields ( $wp_customize ) {

    	/**
         * Top Bar Section
         *
         * Theme Options > Header > Top Bar
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
        	$wp_customize, 'matina_section_header_top_bar',
	            array(
	                'priority'  	=> 5,
	                'panel'     	=> 'matina_theme_options_panel',
	                'section'		=> 'matina_header_group',
	                'capability'    => 'edit_theme_options',
	                'theme_options' => '',
	                'title'     	=> __( 'Top Bar', 'matina' )
	            )
	        )
        );

        /**
         * Toggle option for top bar.
         *
         * Theme Options > Header > Top Bar
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_top_header_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_top_header_option',
                array(
                    'priority'      => 10,
                    'section'       => 'matina_section_header_top_bar',
                    'settings'      => 'matina_top_header_option',
                    'label'         => __( 'Enable Top Bar', 'matina' )
                )
            )
        );

        /**
         * Toggle option for top bar date.
         *
         * Theme Options > Header > Top Bar
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_top_header_date_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_top_header_date_option',
                array(
                    'priority'          => 20,
                    'section'           => 'matina_section_header_top_bar',
                    'settings'          => 'matina_top_header_date_option',
                    'label'             => __( 'Enable Current Date', 'matina' ),
                    'active_callback'   => 'matina_cb_enable_top_header',
                )
            )
        );

        /**
         * Toggle option for top bar social icons.
         *
         * Theme Options > Header > Top Bar
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_top_header_social_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => false,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_top_header_social_option',
                array(
                    'priority'          => 40,
                    'section'           => 'matina_section_header_top_bar',
                    'settings'          => 'matina_top_header_social_option',
                    'label'             => __( 'Enable Social Icons', 'matina' ),
                    'active_callback'   => 'matina_cb_enable_top_header',
                )
            )
        );

        /**
         * Color option for top header background
         *
         * Theme Options > Header > Top Bar
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_top_header_bg_color',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => '#333',
                'sanitize_callback' => 'matina_sanitize_alpha_color',
            )
        );

        $wp_customize->add_control( new Matina_Control_Color(
            $wp_customize, 'matina_top_header_bg_color',
                array(
                    'priority'          => 60,
                    'section'           => 'matina_section_header_top_bar',
                    'settings'          => 'matina_top_header_bg_color',
                    'label'             => __( 'Background Color', 'matina' ),
                    'active_callback'   => 'matina_cb_enable_top_header',
                )
            )
        );

        /**
         * Color option for top header text
         *
         * Theme Options > Header > Top Bar
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_top_header_text_color',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => '#ccc',
                'sanitize_callback' => 'matina_sanitize_alpha_color',
            )
        );

        $wp_customize->add_control( new Matina_Control_Color(
            $wp_customize, 'matina_top_header_text_color',
                array(
                    'priority'          => 70,
                    'section'           => 'matina_section_header_top_bar',
                    'settings'          => 'matina_top_header_text_color',
                    'label'             => __( 'Text Color', 'matina' ),
                    'active_callback'   => 'matina_cb_enable_top_header',
                )
            )
        );
        

    } //end function

endif;