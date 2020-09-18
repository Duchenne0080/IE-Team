<?php
/**
 * Add Bottom Area section and it's fields inside Footer section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_footer_bottom_fields' );

if ( ! function_exists( 'matina_register_footer_bottom_fields' ) ) :

    /**
     * Register Bottom Area section's fields.
     */
    function matina_register_footer_bottom_fields ( $wp_customize ) {

        /**
         * Bottom Area Section
         *
         * Theme Options > Footer > Bottom Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_footer_bottom',
                array(
                    'priority'      => 30,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_footer_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Bottom Area', 'matina' )
                )
            )
        );

        /**
         * Toggle option for footer social icons
         *
         * Theme Options > Footer > Bottom Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_footer_social_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => false,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_footer_social_option',
                array(
                    'priority'      => 40,
                    'section'       => 'matina_section_footer_bottom',
                    'settings'      => 'matina_footer_social_option',
                    'label'         => __( 'Enable Social Icons', 'matina' )
                )
            )
        );

        /**
         * Textarea field for copyright
         *
         * Theme Options > Footer > Bottom Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_copyright_text',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => __( 'copyright 2020. All Rights Reserved.', 'matina' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
                
            )
        );
        
        $wp_customize->add_control( 'matina_copyright_text',
            array(
                'priority'      => 50,
                'section'       => 'matina_section_footer_bottom',
                'settings'      => 'matina_copyright_text',
                'label'         => __( 'Copyright Text', 'matina' ),
                'type'          => 'text',
                'input_attrs'   => array(
                    'placeholder' => __( 'copyright text', 'matina' )
                )
            )
        );

    }

endif;