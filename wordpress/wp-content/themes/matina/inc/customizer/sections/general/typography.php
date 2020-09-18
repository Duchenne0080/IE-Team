<?php
/**
 * Add Typography section and it's fields inside General section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_general_typography_fields' );

if ( ! function_exists( 'matina_register_general_typography_fields' ) ) :

    /**
     * Register Typography section's fields.
     */
    function matina_register_general_typography_fields ( $wp_customize ) {

        /**
         * Typography Section
         *
         * Theme Options > General > Typography
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_typography',
                array(
                    'priority'      => 60,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_general_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Typography', 'matina' )
                )
            )
        );
/*=================================================================================*/
        /**
         * body typography Section
         *
         * Theme Options > General > Typography > Body
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_body_typography',
                array(
                    'priority'      => 10,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_section_typography',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Body', 'matina' )
                )
            )
        );

        /**
         * Typography Font filed for body typography
         *
         * Theme Options > General > Typography > Body
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'body_font_family',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'Open Sans',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_setting(
            'body_font_style',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => '400',
                'sanitize_callback' => 'sanitize_key',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_control( new Matina_Control_Typography (
            $wp_customize,
                'body_typography',
                array(
                    'priority'      => 10,
                    'section'       => 'matina_section_body_typography',
                    'settings'      => array(
                        'family'    => 'body_font_family',
                        'style'     => 'body_font_style',
                    ),
                    'description'   => __( 'Select how you want your body fonts to appear.', 'matina' ),
                    'l10n'          => array() // Pass custom labels. Use the setting key (above) for the specific label.
                )
            )
        );

        /**
         * Select field for text transform on body typography
         *
         * Theme Options > General > Typography > Body
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'body_text_transform',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'none',
                'sanitize_callback' => 'matina_sanitize_select',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control( 'body_text_transform',
            array(
                'priority'          => 15,
                'section'           => 'matina_section_body_typography',
                'settings'          => 'body_text_transform',
                'label'             => __( 'Text Transform', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_font_transform_choices()
            )
        );

/*=================================================================================*/
        /**
         * Heading 1 (H1) Typography Section
         *
         * Theme Options > General > Typography > Heading 1 (H1)
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_h1_typography',
                array(
                    'priority'      => 20,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_section_typography',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Heading 1 (H1)', 'matina' )
                )
            )
        );

        /**
         * Typography Font filed for Heading 1 (H1) typography
         *
         * Theme Options > General > Typography > Heading 1 (H1)
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'h1_font_family',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'Josefin Sans',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_setting(
            'h1_font_style',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => '400',
                'sanitize_callback' => 'sanitize_key',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_control( new Matina_Control_Typography (
            $wp_customize,
                'h1_typography',
                array(
                    'priority'      => 35,
                    'section'       => 'matina_section_h1_typography',
                    'settings'      => array(
                        'family'    => 'h1_font_family',
                        'style'     => 'h1_font_style',
                    ),
                    'description'   => __( 'Select how you want your H1 fonts to appear.', 'matina' ),
                    'l10n'          => array() // Pass custom labels. Use the setting key (above) for the specific label.
                )
            )
        );

        /**
         * Select field for text transform on Heading 1 (H1) typography
         *
         * Theme Options > General > Typography > Heading 1 (H1)
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'h1_text_transform',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'none',
                'sanitize_callback' => 'matina_sanitize_select',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control( 'h1_text_transform',
            array(
                'priority'          => 40,
                'section'           => 'matina_section_h1_typography',
                'settings'          => 'h1_text_transform',
                'label'             => __( 'Text Transform', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_font_transform_choices(),
            )
        );

/*=================================================================================*/
        /**
         * Heading 2 (H2) Typography Section
         *
         * Theme Options > General > Typography > Heading 2 (H2)
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new matina_Customize_Section(
            $wp_customize, 'matina_section_h2_typography',
                array(
                    'priority'      => 30,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_section_typography',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Heading 2 (H2)', 'matina' )
                )
            )
        );

        /**
         * Typography Font filed for Heading 2 (H2) typography
         *
         * Theme Options > General > Typography > Heading 2 (H2)
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'h2_font_family',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'Josefin Sans',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_setting(
            'h2_font_style',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => '400',
                'sanitize_callback' => 'sanitize_key',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_control( new Matina_Control_Typography (
            $wp_customize,
                'h2_typography',
                array(
                    'priority'      => 60,
                    'section'       => 'matina_section_h2_typography',
                    'settings'      => array(
                        'family'    => 'h2_font_family',
                        'style'     => 'h2_font_style',
                    ),
                    'description'   => __( 'Select how you want your H2 fonts to appear.', 'matina' ),
                    'l10n'          => array() // Pass custom labels. Use the setting key (above) for the specific label.
                )
            )
        );

        /**
         * Select field for text transform on Heading 2 (H2) typography
         *
         * Theme Options > General > Typography > Heading 2 (H2)
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'h2_text_transform',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'none',
                'sanitize_callback' => 'matina_sanitize_select',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control( 'h2_text_transform',
            array(
                'priority'          => 65,
                'section'           => 'matina_section_h2_typography',
                'settings'          => 'h2_text_transform',
                'label'             => __( 'Text Transform', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_font_transform_choices(),
            )
        );

/*=================================================================================*/
        /**
         * Heading 3 (H3) Typography Section
         *
         * Theme Options > General > Typography > Heading 3 (H3)
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_h3_typography',
                array(
                    'priority'      => 40,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_section_typography',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Heading 3 (H3)', 'matina' )
                )
            )
        );

        /**
         * Typography Font filed for Heading 3 (H3) typography
         *
         * Theme Options > General > Typography > Heading 3 (H3)
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'h3_font_family',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'Josefin Sans',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_setting(
            'h3_font_style',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => '400',
                'sanitize_callback' => 'sanitize_key',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_control( new Matina_Control_Typography (
            $wp_customize,
                'h3_typography',
                array(
                    'priority'      => 80,
                    'section'       => 'matina_section_h3_typography',
                    'settings'      => array(
                        'family'    => 'h3_font_family',
                        'style'     => 'h3_font_style',
                    ),
                    'description'   => __( 'Select how you want your H3 fonts to appear.', 'matina' ),
                    'l10n'          => array() // Pass custom labels. Use the setting key (above) for the specific label.
                )
            )
        );

        /**
         * Select field for text transform on Heading 3 (H3) typography
         *
         * Theme Options > General > Typography > Heading 3 (H3)
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'h3_text_transform',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'none',
                'sanitize_callback' => 'matina_sanitize_select',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control( 'h3_text_transform',
            array(
                'priority'          => 85,
                'section'           => 'matina_section_h3_typography',
                'settings'          => 'h3_text_transform',
                'label'             => __( 'Text Transform', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_font_transform_choices(),
            )
        );

/*=================================================================================*/
        /**
         * Heading 4 (H4) Typography Section
         *
         * Theme Options > General > Typography > Heading 4 (H4)
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_h4_typography',
                array(
                    'priority'      => 50,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_section_typography',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Heading 4 (H4)', 'matina' )
                )
            )
        );

        /**
         * Typography Font filed for Heading 4 (H4) typography
         *
         * Theme Options > General > Typography > Heading 4 (H4)
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'h4_font_family',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'Josefin Sans',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_setting(
            'h4_font_style',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => '400',
                'sanitize_callback' => 'sanitize_key',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_control( new Matina_Control_Typography (
            $wp_customize,
                'h4_typography',
                array(
                    'priority'      => 105,
                    'section'       => 'matina_section_h4_typography',
                    'settings'      => array(
                        'family'    => 'h4_font_family',
                        'style'     => 'h4_font_style',
                    ),
                    'description'   => __( 'Select how you want your H4 fonts to appear.', 'matina' ),
                    'l10n'          => array() // Pass custom labels. Use the setting key (above) for the specific label.
                )
            )
        );

        /**
         * Select field for text transform on Heading 4 (H4) typography
         *
         * Theme Options > General > Typography > Heading 4 (H4)
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'h4_text_transform',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'none',
                'sanitize_callback' => 'matina_sanitize_select',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control( 'h4_text_transform',
            array(
                'priority'          => 110,
                'section'           => 'matina_section_h4_typography',
                'settings'          => 'h4_text_transform',
                'label'             => __( 'Text Transform', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_font_transform_choices(),
            )
        );

    }

endif;
