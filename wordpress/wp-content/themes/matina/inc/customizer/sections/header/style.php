<?php
/**
 * Add Style section and it's fields inside Header section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_header_style_fields' );

if ( ! function_exists( 'matina_register_header_style_fields' ) ) :

    /**
     * Register Style section's fields.
     */
    function matina_register_header_style_fields ( $wp_customize ) {

        /**
         * Style Section
         *
         * Theme Options > Header > Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_header_style',
                array(
                    'priority'      => 30,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_header_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Style', 'matina' )
                )
            )
        );

        /**
         * Radio image field for header layout
         *
         * Theme Options > Header > Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_header_layout',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'layout-default',
                'sanitize_callback' => 'matina_sanitize_select',
            )
        );

        $wp_customize->add_control( new Matina_Control_Radio_Image(
            $wp_customize, 'matina_header_layout',
                array(
                    'priority'      => 10,
                    'section'       => 'matina_section_header_style',
                    'settings'      => 'matina_header_layout',
                    'label'         => __( 'Header Layout', 'matina' ),
                    'description'   => __( 'Choose from available layouts', 'matina' ),
                    'choices'       => matina_header_layout_choices()
                )
            )
        );

        /**
         * Color option for header background
         *
         * Theme Options > Header > Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_header_background_color',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => '#ffffff',
                'sanitize_callback' => 'matina_sanitize_alpha_color'
            )
        );

        $wp_customize->add_control( new Matina_Control_Color(
            $wp_customize, 'matina_header_background_color',
                array(
                    'priority'          => 40,
                    'section'           => 'matina_section_header_style',
                    'settings'          => 'matina_header_background_color',
                    'label'             => __( 'Header Background Color', 'matina' )
                )
            )
        );

        /**
         * Color option for header text color
         *
         * Theme Options > Header > Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_header_text_color',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => '#3d3d3d',
                'sanitize_callback' => 'matina_sanitize_alpha_color'
            )
        );

        $wp_customize->add_control( new Matina_Control_Color(
            $wp_customize, 'matina_header_text_color',
                array(
                    'priority'          => 50,
                    'section'           => 'matina_section_header_style',
                    'settings'          => 'matina_header_text_color',
                    'label'             => __( 'Header Text Color', 'matina' )
                )
            )
        );

        /**
         * Toggle option for sticky header
         *
         * Theme Options > Header > Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_sticky_header_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_sticky_header_option',
                array(
                    'priority'      => 60,
                    'section'       => 'matina_section_header_style',
                    'settings'      => 'matina_sticky_header_option',
                    'label'         => __( 'Enable sticky header', 'matina' )
                )
            )
        );

    } // end function

endif;