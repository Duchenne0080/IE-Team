<?php
/**
 * Add Main Area section and it's fields inside Footer section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_footer_main_fields' );

if ( ! function_exists( 'matina_register_footer_main_fields' ) ) :

    /**
     * Register Main Area section's fields.
     */
    function matina_register_footer_main_fields ( $wp_customize ) {

        /**
         * Main Area Section
         *
         * Theme Options > Footer > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_footer_main',
                array(
                    'priority'      => 20,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_footer_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Main Area', 'matina' )
                )
            )
        );

        /**
         * Toggle option for widget area
         *
         * Theme Options > Footer > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_footer_widget_area_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => false,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_footer_widget_area_option',
                array(
                    'priority'      => 10,
                    'section'       => 'matina_section_footer_main',
                    'settings'      => 'matina_footer_widget_area_option',
                    'label'         => __( 'Enable Widget Area', 'matina' )
                )
            )
        );

        /**
         * Radio image field for footer widget area.
         *
         * Theme Options > Footer > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_footer_widget_layout',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'four-columns',
                'sanitize_callback' => 'matina_sanitize_select',
            )
        );

        $wp_customize->add_control( new Matina_Control_Radio_Image(
            $wp_customize, 'matina_footer_widget_layout',
                array(
                    'priority'          => 20,
                    'section'           => 'matina_section_footer_main',
                    'settings'          => 'matina_footer_widget_layout',
                    'label'             => __( 'Widget Area Layout', 'matina' ),
                    'description'       => __( 'Choose layout from available options.', 'matina' ),
                    'choices'           => matina_footer_widget_layout_choices(),
                    'active_callback'   => 'matina_cb_has_enable_footer_widget'
                )
            )
        );

    } // end function

endif;