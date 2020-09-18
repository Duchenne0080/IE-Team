<?php
/**
 * Add Featured section and it's fields inside Homepage section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_featured_fields' );

if ( ! function_exists( 'matina_register_featured_fields' ) ) :

    /**
     * Register Featured section's fields.
     *
     * @since 1.0.0
     */
    function matina_register_featured_fields ( $wp_customize ) {

        /**
         * Featured Section
         *
         * Theme Options > Homepage > Featured Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_homepage_featured',
                array(
                    'priority'      => 20,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_homepage_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Featured Section', 'matina' )
                )
            )
        );

        /**
         * Toggle option for homepage featured section
         *
         * Theme Options > Homepage > Featured Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_homepage_featured_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_homepage_featured_option',
                array(
                    'priority'      => 10,
                    'section'       => 'matina_section_homepage_featured',
                    'settings'      => 'matina_homepage_featured_option',
                    'label'         => __( 'Enable Featured', 'matina' )
                )
            )
        );

        /**
         * Text field for homepage featured section title
         *
         * Theme Options > Homepage > Featured Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_featured_section_title',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'matina_sanitize_title_field'
            )
        );
        
        $wp_customize->add_control( 'matina_featured_section_title',
            array(
                'priority'          => 20,
                'section'           => 'matina_section_homepage_featured',
                'settings'          => 'matina_featured_section_title',
                'label'             => __( 'Section Title', 'matina' ),
                'type'              => 'text',
                'active_callback'   => 'matina_cb_has_enable_featured',
                'input_attrs'       => array(
                    'placeholder' => __( 'Featured Posts', 'matina' )
                )
            )
        );

        /**
         * Multicheckbox field for homepage featured categories
         *
         * Theme Options > Homepage > Featured Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_featured_categories',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'matina_sanitize_multicheck'
            )
        );
        
        $wp_customize->add_control( new Matina_Control_Multicheck(
            $wp_customize, 'matina_featured_categories',
                array(
                    'priority'          => 50,
                    'section'           => 'matina_section_homepage_featured',
                    'settings'          => 'matina_featured_categories',
                    'label'             => __( 'Featured Categories', 'matina' ),
                    'description'       => __( 'Choose available categories for featured section.', 'matina' ),
                    'choices'           => matina_default_categories_choices(),
                    'active_callback'   => 'matina_cb_has_enable_featured',
                )
            )
        );

        /**
         * Heading field for featured style
         *
         * Theme Options > Homepage > Featured Section
         */
        $wp_customize->add_setting( 'matina_featured_style_heading',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Heading(
            $wp_customize, 'matina_featured_style_heading',
                array(
                    'priority'          => 80,
                    'section'           => 'matina_section_homepage_featured',
                    'settings'          => 'matina_featured_style_heading',
                    'label'             => __( 'Featured Style', 'matina' ),
                    'active_callback'   => 'matina_cb_has_enable_featured'
                )
            )
        );

        /**
         * Radio image field for categories featured layout
         *
         * Theme Options > Homepage > Featured Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_featured_cat_layout',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'layout-default',
                'sanitize_callback' => 'matina_sanitize_select',
            )
        );

        $wp_customize->add_control( new Matina_Control_Radio_Image(
            $wp_customize, 'matina_featured_cat_layout',
                array(
                    'priority'          => 90,
                    'section'           => 'matina_section_homepage_featured',
                    'settings'          => 'matina_featured_cat_layout',
                    'label'             => __( 'Featured Layout', 'matina' ),
                    'description'       => __( 'Choose from available layouts', 'matina' ),
                    'choices'           => matina_featured_categories_layout_choices(),
                    'active_callback'   => 'matina_cb_has_enable_featured'
                )
            )
        );

    } // end function

endif;