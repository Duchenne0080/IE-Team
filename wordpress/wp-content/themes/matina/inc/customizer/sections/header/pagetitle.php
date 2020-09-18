<?php
/**
 * Add Page Title section and it's fields inside Header section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_header_page_title_fields' );

if ( ! function_exists( 'matina_register_header_page_title_fields' ) ) :

    /**
     * Register Page Title section's fields.
     */
    function matina_register_header_page_title_fields ( $wp_customize ) {

        /**
         * Page Title Section
         *
         * Theme Options > Header > Page Title
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_header_page_title',
                array(
                    'priority'      => 35,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_header_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Page Title', 'matina' )
                )
            )
        );

        /**
         * Select field for page title heading tag
         *
         * Theme Options > Header > Page Title
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_page_title_heading_tag',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'h1',
                'sanitize_callback' => 'matina_sanitize_select'
            )
        );
        
        $wp_customize->add_control( 'matina_page_title_heading_tag',
            array(
                'priority'          => 10,
                'section'           => 'matina_section_header_page_title',
                'settings'          => 'matina_page_title_heading_tag',
                'label'             => __( 'Heading Tag', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_heading_tag_choices()
            )
        );

        /**
         * Select field for page title style
         *
         * Theme Options > Header > Page Title
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_page_title_style',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'default',
                'sanitize_callback' => 'matina_sanitize_select'
            )
        );
        
        $wp_customize->add_control( 'matina_page_title_style',
            array(
                'priority'          => 20,
                'section'           => 'matina_section_header_page_title',
                'settings'          => 'matina_page_title_style',
                'label'             => __( 'Page Title Style', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_page_title_style_choices()
            )
        );

        /**
         * Heading field for breadcrumb
         *
         * Theme Options > Header > Page Title
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_page_title_breadcrumb_heading',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Heading(
            $wp_customize, 'matina_page_title_breadcrumb_heading',
                array(
                    'priority'      => 90,
                    'section'       => 'matina_section_header_page_title',
                    'settings'      => 'matina_page_title_breadcrumb_heading',
                    'label'         => __( 'Breadcrumbs', 'matina' ),
                )
            )
        );

        /**
         * Toggle option for breadcrumb.
         *
         * Theme Options > Header > Page Title
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_breadcrumbs',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new matina_Control_Toggle(
            $wp_customize, 'matina_breadcrumbs',
                array(
                    'priority'      => 100,
                    'section'       => 'matina_section_header_page_title',
                    'settings'      => 'matina_breadcrumbs',
                    'label'         => __( 'Enable Breadcrumb', 'matina' )
                )
            )
        );

        /**
         * Text field for breadcrumb home label
         *
         * Theme Options > Header > Page Title
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_breadcrumbs_home_lable',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => __( 'Home', 'matina' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        
        $wp_customize->add_control( 'matina_breadcrumbs_home_lable',
            array(
                'priority'          => 120,
                'section'           => 'matina_section_header_page_title',
                'settings'          => 'matina_breadcrumbs_home_lable',
                'label'             => __( 'Translation for Home', 'matina' ),
                'type'              => 'text',
                'active_callback'   => 'matina_cb_has_breadcrumb'
            )
        );

    }

endif;
