<?php
/**
 * Add Single Pages section and it's fields inside Blog section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_single_pages_fields' );

if ( ! function_exists( 'matina_register_single_pages_fields' ) ) :

    /**
     * Register Single Pages section's fields.
     */
    function matina_register_single_pages_fields ( $wp_customize ) {

        /**
         * Single Pages Section
         *
         * Theme Options > Blog > Single Pages
         *
         * @since 1.0.5
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_single_pages',
                array(
                    'priority'      => 30,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_blog_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Single Pages', 'matina' )
                )
            )
        );

        /**
         * Heading field for Single Pages Layout
         *
         * Theme Options > Blog > Single Pages
         *
         * @since 1.0.5
         */
        $wp_customize->add_setting( 'matina_single_page_layout_heading',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Heading(
            $wp_customize, 'matina_single_page_layout_heading',
                array(
                    'priority'      => 10,
                    'section'       => 'matina_section_single_pages',
                    'settings'      => 'matina_single_page_layout_heading',
                    'label'         => __( 'Layouts', 'matina' ),
                )
            )
        );

        /**
         * Radio image field for single pages sidebar
         *
         * Theme Options > Blog > Single Pages
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_pages_sidebar_layout',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'right-sidebar',
                'sanitize_callback' => 'matina_sanitize_select',
            )
        );

        $wp_customize->add_control( new Matina_Control_Radio_Image(
            $wp_customize, 'matina_single_pages_sidebar_layout',
                array(
                    'priority'      => 20,
                    'section'       => 'matina_section_single_pages',
                    'settings'      => 'matina_single_pages_sidebar_layout',
                    'label'         => __( 'Sidebar Layout', 'matina' ),
                    'description'   => __( 'Choose from available layouts', 'matina' ),
                    'choices'       => matina_sidebar_layout_choices()
                )
            )
        );

    }

endif;