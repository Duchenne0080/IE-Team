<?php
/**
 * Add Single Posts section and it's fields inside Blog section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_single_posts_fields' );

if ( ! function_exists( 'matina_register_single_posts_fields' ) ) :

    /**
     * Register Single Posts section's fields.
     */
    function matina_register_single_posts_fields ( $wp_customize ) {

        /**
         * Single Posts Section
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_single_posts',
                array(
                    'priority'      => 20,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_blog_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Single Posts', 'matina' )
                )
            )
        );

        /**
         * Heading field for Single Posts Layout
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_layout_heading',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Heading(
            $wp_customize, 'matina_single_layout_heading',
                array(
                    'priority'      => 10,
                    'section'       => 'matina_section_single_posts',
                    'settings'      => 'matina_single_layout_heading',
                    'label'         => __( 'Layouts', 'matina' ),
                )
            )
        );

        /**
         * Radio image field for single posts sidebar
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_posts_sidebar_layout',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'right-sidebar',
                'sanitize_callback' => 'matina_sanitize_select',
            )
        );

        $wp_customize->add_control( new Matina_Control_Radio_Image(
            $wp_customize, 'matina_single_posts_sidebar_layout',
                array(
                    'priority'      => 20,
                    'section'       => 'matina_section_single_posts',
                    'settings'      => 'matina_single_posts_sidebar_layout',
                    'label'         => __( 'Sidebar Layout', 'matina' ),
                    'description'   => __( 'Choose from available layouts', 'matina' ),
                    'choices'       => matina_sidebar_layout_choices()
                )
            )
        );

        /**
         * Radio image field for single posts layout
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_posts_layout',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'layout-default',
                'sanitize_callback' => 'matina_sanitize_select',
            )
        );

        $wp_customize->add_control( new Matina_Control_Radio_Image(
            $wp_customize, 'matina_single_posts_layout',
                array(
                    'priority'      => 30,
                    'section'       => 'matina_section_single_posts',
                    'settings'      => 'matina_single_posts_layout',
                    'label'         => __( 'Posts Layout', 'matina' ),
                    'description'   => __( 'Choose from available layouts', 'matina' ),
                    'choices'       => matina_single_posts_layout_choices()
                )
            )
        );

        /**
         * Heading field for Extra Option
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_extra_heading',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Heading(
            $wp_customize, 'matina_single_extra_heading',
                array(
                    'priority'      => 40,
                    'section'       => 'matina_section_single_posts',
                    'settings'      => 'matina_single_extra_heading',
                    'label'         => __( 'Extra Options', 'matina' ),
                )
            )
        );

        /**
         * Select field for single posts mobile sidebar order
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_posts_mobile_sidebar_order',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'content-sidebar',
                'sanitize_callback' => 'matina_sanitize_select'
            )
        );
        
        $wp_customize->add_control( 'matina_single_posts_mobile_sidebar_order',
            array(
                'priority'          => 50,
                'section'           => 'matina_section_single_posts',
                'settings'          => 'matina_single_posts_mobile_sidebar_order',
                'label'             => __( 'Mobile Sidebar Order', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_sidebar_order_choices()
            )
        );

        /**
         * Toggle option for page header title
         *
         * Theme Options > Blog > Single Post
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_post_enable_page_header',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => false,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_single_post_enable_page_header',
                array(
                    'priority'      => 70,
                    'section'       => 'matina_section_single_posts',
                    'settings'      => 'matina_single_post_enable_page_header',
                    'label'         => __( 'Enable Page Header Title', 'matina' )
                )
            )
        );

        /**
         * Heading field for author box
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_author_box_heading',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Heading(
            $wp_customize, 'matina_single_author_box_heading',
                array(
                    'priority'      => 110,
                    'section'       => 'matina_section_single_posts',
                    'settings'      => 'matina_single_author_box_heading',
                    'label'         => __( 'Author Box', 'matina' ),
                )
            )
        );

        /**
         * Toggle option for author box at single posts.
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_posts_author_box_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_single_posts_author_box_option',
                array(
                    'priority'      => 120,
                    'section'       => 'matina_section_single_posts',
                    'settings'      => 'matina_single_posts_author_box_option',
                    'label'         => __( 'Enable Author Box', 'matina' )
                )
            )
        );

        /**
         * Heading field for navigation and author
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_navigation_heading',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Heading(
            $wp_customize, 'matina_single_navigation_heading',
                array(
                    'priority'      => 140,
                    'section'       => 'matina_section_single_posts',
                    'settings'      => 'matina_single_navigation_heading',
                    'label'         => __( 'Navigation', 'matina' ),
                )
            )
        );

        /**
         * Buttonset option for navigation taxonomy
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_posts_navigation_taxonomy',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'category',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Buttonset(
            $wp_customize, 'matina_single_posts_navigation_taxonomy',
                array(
                    'priority'      => 160,
                    'section'       => 'matina_section_single_posts',
                    'settings'      => 'matina_single_posts_navigation_taxonomy',
                    'label'         => __( 'Navigation Taxonomy', 'matina' ),
                    'choices'       => matina_single_posts_taxonomy_choices()
                )
            )
        );

        /**
         * Heading field for single posts related posts
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_related_heading',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Heading(
            $wp_customize, 'matina_single_related_heading',
                array(
                    'priority'      => 170,
                    'section'       => 'matina_section_single_posts',
                    'settings'      => 'matina_single_related_heading',
                    'label'         => __( 'Related Posts', 'matina' ),
                )
            )
        );

        /**
         * Toggle option for single posts related posts section.
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_posts_related_posts_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_single_posts_related_posts_option',
                array(
                    'priority'      => 180,
                    'section'       => 'matina_section_single_posts',
                    'settings'      => 'matina_single_posts_related_posts_option',
                    'label'         => __( 'Enable Related Posts', 'matina' )
                )
            )
        );

        /**
         * Text field for single posts related section title
         *
         * Theme Options > Blog > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_related_title',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => __( 'You May Like', 'matina' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        
        $wp_customize->add_control( 'matina_single_related_title',
            array(
                'priority'          => 190,
                'section'           => 'matina_section_single_posts',
                'settings'          => 'matina_single_related_title',
                'label'             => __( 'Section Title', 'matina' ),
                'type'              => 'text',
                'input_attrs'       => array(
                    'placeholder' => __( 'Related Posts', 'matina' )
                ),
                'active_callback'   => 'matina_cb_enable_single_related_option'
            )
        );
    }

endif;