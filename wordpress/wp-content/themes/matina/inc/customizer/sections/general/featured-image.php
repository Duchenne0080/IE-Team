<?php
/**
 * Add Post Featured Image Section and it's fields inside General section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_general_featured_image_fields' );

if ( ! function_exists( 'matina_register_general_featured_image_fields' ) ) :

    /**
     * Register Post Featured Image section's fields.
     */
    function matina_register_general_featured_image_fields ( $wp_customize ) {

        /**
         * Post Featured Image Section
         *
         * Theme Options > General > Post Featured Image
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_featured_image',
                array(
                    'priority'      => 40,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_general_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Post Featured Image', 'matina' )
                )
            )
        );

        /**
         * Toggle option for featured image permalink.
         *
         * Theme Options > General > Post Featured Image
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_image_permalink_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_image_permalink_option',
                array(
                    'priority'      => 30,
                    'section'       => 'matina_section_featured_image',
                    'settings'      => 'matina_image_permalink_option',
                    'label'         => __( 'Enable post permailnk for featured image.', 'matina' )
                )
            )
        );

        /**
         * Toggle option for image hover option.
         *
         * Theme Options > General > Post Featured Image
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_image_hover_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_image_hover_option',
                array(
                    'priority'          => 40,
                    'section'           => 'matina_section_featured_image',
                    'settings'          => 'matina_image_hover_option',
                    'label'             => __( 'Enable image hover option.', 'matina' ),
                    'active_callback'   => 'matina_cb_has_enable_image_permalink_option',
                )
            )
        );

        /**
         * Select field for image hover styles
         *
         * Theme Options > General > Post Featured Image
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_image_hover_style',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'zoomin',
                'sanitize_callback' => 'matina_sanitize_select'
            )
        );
        
        $wp_customize->add_control( 'matina_image_hover_style',
            array(
                'priority'          => 50,
                'section'           => 'matina_section_featured_image',
                'settings'          => 'matina_image_hover_style',
                'label'             => __( 'Image Hover Style', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_image_hover_style_choices(),
                'active_callback'   => 'matina_cb_has_enable_image_hover_option',
            )
        );

    }

endif;