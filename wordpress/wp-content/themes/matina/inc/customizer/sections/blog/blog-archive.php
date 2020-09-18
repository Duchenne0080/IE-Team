<?php
/**
 * Add Blog/Archive section and it's fields inside Blog section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_blog_archive_fields' );

if ( ! function_exists( 'matina_register_blog_archive_fields' ) ) :

    /**
     * Register Blog/Archive section's fields.
     */
    function matina_register_blog_archive_fields ( $wp_customize ) {

        /**
         * Blog/Archive Section
         *
         * Theme Options > Blog > Blog/Archive
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_blog_archive',
                array(
                    'priority'      => 10,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_blog_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Blog/Archive', 'matina' )
                )
            )
        );

        /**
         * Heading field for Archive Layout
         *
         * Theme Options > Blog > Blog/Archive
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_blog_archive_heading',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Heading(
            $wp_customize, 'matina_blog_archive_heading',
                array(
                    'priority'      => 10,
                    'section'       => 'matina_section_blog_archive',
                    'settings'      => 'matina_blog_archive_heading',
                    'label'         => __( 'Layouts', 'matina' ),
                )
            )
        );

        /**
         * Radio image field for archive sidebar
         *
         * Theme Options > Blog > Blog/Archive
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_archive_sidebar_layout',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'right-sidebar',
                'sanitize_callback' => 'matina_sanitize_select',
            )
        );

        $wp_customize->add_control( new Matina_Control_Radio_Image(
            $wp_customize, 'matina_archive_sidebar_layout',
                array(
                    'priority'      => 20,
                    'section'       => 'matina_section_blog_archive',
                    'settings'      => 'matina_archive_sidebar_layout',
                    'label'         => __( 'Archive Sidebar Layout', 'matina' ),
                    'description'   => __( 'Choose from available layouts', 'matina' ),
                    'choices'       => matina_sidebar_layout_choices()
                )
            )
        );

        /**
         * Select field for archive page style
         *
         * Theme Options > Blog > Blog/Archive
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_archive_style',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'masonry',
                'sanitize_callback' => 'matina_sanitize_select'
            )
        );
        
        $wp_customize->add_control( 'matina_archive_style',
            array(
                'priority'          => 30,
                'section'           => 'matina_section_blog_archive',
                'settings'          => 'matina_archive_style',
                'label'             => __( 'Archive Style', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_archive_style_choices()
            )
        );

        /**
         * Radio image field for archive layout
         *
         * Theme Options > Blog > Blog/Archive
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_archive_layout',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'layout-default',
                'sanitize_callback' => 'matina_sanitize_select',
            )
        );

        $wp_customize->add_control( new Matina_Control_Radio_Image(
            $wp_customize, 'matina_archive_layout',
                array(
                    'priority'      => 40,
                    'section'       => 'matina_section_blog_archive',
                    'settings'      => 'matina_archive_layout',
                    'label'         => __( 'Archive Posts Layout', 'matina' ),
                    'description'   => __( 'Choose from available layouts', 'matina' ),
                    'choices'       => matina_archive_layout_choices()
                )
            )
        );

        /**
         * Heading field for Extra layouts
         *
         * Theme Options > Blog > Blog/Archive
         */
        $wp_customize->add_setting( 'matina_blog_extra_heading',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Heading(
            $wp_customize, 'matina_blog_extra_heading',
                array(
                    'priority'      => 50,
                    'section'       => 'matina_section_blog_archive',
                    'settings'      => 'matina_blog_extra_heading',
                    'label'         => __( 'Extra Options', 'matina' ),
                )
            )
        );

        /**
         * Select field for archive posts heading tag
         *
         * Theme Options > Blog > Blog/Archive
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_archive_posts_heading_tag',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'h2',
                'sanitize_callback' => 'matina_sanitize_select'
            )
        );
        
        $wp_customize->add_control( 'matina_archive_posts_heading_tag',
            array(
                'priority'          => 70,
                'section'           => 'matina_section_blog_archive',
                'settings'          => 'matina_archive_posts_heading_tag',
                'label'             => __( 'Heading Tag', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_heading_tag_choices()
            )
        );

        /**
         * Toggle option for replace featured image by post format related content.
         *
         * Theme Options > Blog > Blog/Archive
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'general_archive_featured_image_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => false,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'general_archive_featured_image_option',
                array(
                    'priority'      => 100,
                    'section'       => 'matina_section_blog_archive',
                    'settings'      => 'general_archive_featured_image_option',
                    'label'         => __( 'Replace featured image by post format content.', 'matina' )
                )
            )
        );

        /**
         * Text field for archive post read more
         *
         * Theme Options > Blog > Blog/Archive
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_archive_readmore_label',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => __( 'Read More', 'matina' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        
        $wp_customize->add_control( 'matina_archive_readmore_label',
            array(
                'priority'          => 130,
                'section'           => 'matina_section_blog_archive',
                'settings'          => 'matina_archive_readmore_label',
                'label'             => __( 'Read More Label', 'matina' ),
                'type'              => 'text',
                'input_attrs'       => array(
                    'placeholder' => __( 'Read More', 'matina' )
                )
            )
        );

        /**
         * Select field for archive pagination type
         *
         * Theme Options > Blog > Blog/Archive
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_archive_pagination_type',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'default',
                'sanitize_callback' => 'matina_sanitize_select'
            )
        );
        
        $wp_customize->add_control( 'matina_archive_pagination_type',
            array(
                'priority'          => 140,
                'section'           => 'matina_section_blog_archive',
                'settings'          => 'matina_archive_pagination_type',
                'label'             => __( 'Pagination Type', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_archive_pagination_choices()
            )
        );


    } // end function

endif;