<?php
/**
 * Add 404 Error Page section and it's fields inside General section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_error_404_fields' );

if ( ! function_exists( 'matina_register_error_404_fields' ) ) :

    /**
     * Register 404 Error Page section's fields.
     */
    function matina_register_error_404_fields ( $wp_customize ) {

        /**
         * 404 Error Page Section
         *
         * Theme Options > General > 404 Error Page
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_404_error',
                array(
                    'priority'      => 70,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_general_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( '404 Error Page', 'matina' )
                )
            )
        );

        /**
         * Text field for 404 page caption
         *
         * Theme Options > General > 404 Error Page
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_404_page_caption',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => __( '404', 'matina' ),
                'sanitize_callback' => 'matina_sanitize_title_field'
            )
        );
        
        $wp_customize->add_control( 'matina_404_page_caption',
            array(
                'priority'          => 20,
                'section'           => 'matina_section_404_error',
                'settings'          => 'matina_404_page_caption',
                'label'             => __( 'Page Caption', 'matina' ),
                'type'              => 'text',
                'input_attrs'       => array(
                    'placeholder' => __( '404', 'matina' )
                )
            )
        );

        /**
         * Text field for 404 page title
         *
         * Theme Options > General > 404 Error Page
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_404_page_title',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => __( "Oops! That page can't be found.", 'matina' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        
        $wp_customize->add_control( 'matina_404_page_title',
            array(
                'priority'          => 30,
                'section'           => 'matina_section_404_error',
                'settings'          => 'matina_404_page_title',
                'label'             => __( 'Page Title', 'matina' ),
                'type'              => 'text',
                'input_attrs'       => array(
                    'placeholder' => __( 'Page Title', 'matina' )
                )
            )
        );

        /**
         * Text field for 404 page content
         *
         * Theme Options > General > 404 Error Page
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_404_page_content',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'matina' ),
                'sanitize_callback' => 'matina_sanitize_textarea'
            )
        );
        
        $wp_customize->add_control( 'matina_404_page_content',
            array(
                'priority'          => 40,
                'section'           => 'matina_section_404_error',
                'settings'          => 'matina_404_page_content',
                'label'             => __( 'Page Content', 'matina' ),
                'type'              => 'textarea',
                'input_attrs'       => array(
                    'placeholder' => __( 'Page Content', 'matina' )
                )
            )
        );

        /**
         * Toggle option for search form
         *
         * Theme Options > General > 404 Error Page
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_enable_404_search',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_enable_404_search',
                array(
                    'priority'      => 50,
                    'section'       => 'matina_section_404_error',
                    'settings'      => 'matina_enable_404_search',
                    'label'         => __( 'Enable Search Form', 'matina' )
                )
            )
        );

        /**
         * Text field for button label
         *
         * Theme Options > General > 404 Error Page
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_404_button_label',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => __( 'Back To Homepage', 'matina' ),
                'sanitize_callback' => 'matina_sanitize_title_field'
            )
        );
        
        $wp_customize->add_control( 'matina_404_button_label',
            array(
                'priority'          => 60,
                'section'           => 'matina_section_404_error',
                'settings'          => 'matina_404_button_label',
                'label'             => __( 'Button label', 'matina' ),
                'type'              => 'text',
                'input_attrs'       => array(
                    'placeholder' => __( 'Button label', 'matina' )
                )
            )
        );

        /**
         * Text field for button link
         *
         * Theme Options > General > 404 Error Page
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_404_button_link',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        
        $wp_customize->add_control( 'matina_404_button_link',
            array(
                'priority'          => 70,
                'section'           => 'matina_section_404_error',
                'settings'          => 'matina_404_button_link',
                'label'             => __( 'Button Link', 'matina' ),
                'type'              => 'text',
                'input_attrs'       => array(
                    'placeholder' => __( 'https://mysterythemes.com/', 'matina' )
                )
            )
        );

        /**
         * Radio image field for 404 page layout
         *
         * Theme Options > General > 404 Error Page
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_404_page_layout',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'layout-default',
                'sanitize_callback' => 'matina_sanitize_select',
            )
        );

        $wp_customize->add_control( new Matina_Control_Radio_Image(
            $wp_customize, 'matina_404_page_layout',
                array(
                    'priority'          => 80,
                    'section'           => 'matina_section_404_error',
                    'settings'          => 'matina_404_page_layout',
                    'label'             => __( 'Page Layout', 'matina' ),
                    'description'       => __( 'Choose from available layouts', 'matina' ),
                    'choices'           => matina_404_page_layout_choices()
                )
            )
        );

    } // end function

endif;