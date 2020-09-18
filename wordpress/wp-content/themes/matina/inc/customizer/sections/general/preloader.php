<?php
/**
 * Add Preloader section and it's fields inside General section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_preloader_fields' );

if ( ! function_exists( 'matina_register_preloader_fields' ) ) :

    /**
     * Register Preloader section's fields.
     */
    function matina_register_preloader_fields ( $wp_customize ) {

        /**
         * Preloader Section
         *
         * Theme Options > General > Preloader
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_preloader',
                array(
                    'priority'      => 20,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_general_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Preloader', 'matina' )
                )
            )
        );

        /**
         * Toggle option for preloader.
         *
         * Theme Options > General > Preloader
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_preloader_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_preloader_option',
                array(
                    'priority'      => 10,
                    'section'       => 'matina_section_preloader',
                    'settings'      => 'matina_preloader_option',
                    'label'         => __( 'Enable Preloader', 'matina' )
                )
            )
        );

        /**
         * Select field for preloader styles
         *
         * Theme Options > General > Preloader
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_preloader_style',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'wave',
                'sanitize_callback' => 'matina_sanitize_select'
            )
        );
        
        $wp_customize->add_control( 'matina_preloader_style',
            array(
                'priority'          => 20,
                'section'           => 'matina_section_preloader',
                'settings'          => 'matina_preloader_style',
                'label'             => __( 'Preloader Style', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_preloader_style_choices(),
                'active_callback'   => 'matina_cb_has_enable_preloader',
            )
        );

    }

endif;