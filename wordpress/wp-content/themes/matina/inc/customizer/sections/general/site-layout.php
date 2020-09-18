<?php
/**
 * Add Site Layout section and it's fields inside General section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_site_layout_fields' );

if ( ! function_exists( 'matina_register_site_layout_fields' ) ) :

    /**
     * Register Site Layout section's fields.
     */
    function matina_register_site_layout_fields ( $wp_customize ) {

        /**
         * Site Layout Section
         *
         * Theme Options > General > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_site_style',
                array(
                    'priority'      => 10,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_general_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Site Style', 'matina' )
                )
            )
        );

        /**
         * Radio image field for Site Layout
         *
         * Theme Options > General > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_site_layout',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'full-width',
                'sanitize_callback' => 'matina_sanitize_select',
            )
        );

        $wp_customize->add_control( new Matina_Control_Radio_Image(
            $wp_customize, 'matina_site_layout',
                array(
                    'priority'      => 10,
                    'section'       => 'matina_section_site_style',
                    'settings'      => 'matina_site_layout',
                    'label'         => __( 'Site Layout', 'matina' ),
                    'description'   => __( 'Choose from available layouts', 'matina' ),
                    'choices'       => matina_site_layout_choices()
                )
            )
        );

        /**
         * Range field for main container width
         *
         * Theme Options > General > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_main_container_width',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 1300,
                'sanitize_callback' => 'absint'
            )
        );
        
        $wp_customize->add_control( new Matina_Control_Range(
            $wp_customize, 'matina_main_container_width',
                array(
                    'priority'          => 20,
                    'section'           => 'matina_section_site_style',
                    'settings'          => 'matina_main_container_width',
                    'label'             => __( 'Main Container Width (px)', 'matina' ),
                    'input_attrs'       => array(
                        'min'   => 0,
                        'max'   => 4096,
                        'step'  => 1,
                    ),
                    'active_callback'   => 'matina_cb_hasnt_boxed_layout',
                )
            )
        );

        /**
         * Range field for main content width
         *
         * Theme Options > General > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_main_content_width',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 70,
                'sanitize_callback' => 'absint'
            )
        );
        
        $wp_customize->add_control( new Matina_Control_Range(
            $wp_customize, 'matina_main_content_width',
                array(
                    'priority'          => 30,
                    'section'           => 'matina_section_site_style',
                    'settings'          => 'matina_main_content_width',
                    'label'             => __( 'Main Content Width (%)', 'matina' ),
                    'input_attrs'       => array(
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    )
                )
            )
        );

        /**
         * Range field for sidebar width
         *
         * Theme Options > General > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_sidebar_width',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 27,
                'sanitize_callback' => 'absint'
            )
        );
        
        $wp_customize->add_control( new Matina_Control_Range(
            $wp_customize, 'matina_sidebar_width',
                array(
                    'priority'          => 40,
                    'section'           => 'matina_section_site_style',
                    'settings'          => 'matina_sidebar_width',
                    'label'             => __( 'Sidebar Width (%)', 'matina' ),
                    'input_attrs'       => array(
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    )
                )
            )
        );

        /**
         * Toggle option for dark mode
         *
         * Theme Options > General > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_dark_mode_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => false,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_dark_mode_option',
                array(
                    'priority'      => 50,
                    'section'       => 'matina_section_site_style',
                    'settings'      => 'matina_dark_mode_option',
                    'label'         => __( 'Enable dark mode', 'matina' )
                )
            )
        );

        /**
         * Toggle option for sticky sidebar
         *
         * Theme Options > General > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_sidebar_sticky_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_sidebar_sticky_option',
                array(
                    'priority'      => 60,
                    'section'       => 'matina_section_site_style',
                    'settings'      => 'matina_sidebar_sticky_option',
                    'label'         => __( 'Enable sidebar sticky', 'matina' )
                )
            )
        );

    }// end function

endif;