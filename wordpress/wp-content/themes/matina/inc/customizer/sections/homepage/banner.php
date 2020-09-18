<?php
/**
 * Add Banner section and it's fields inside Homepage section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_banner_fields' );

if ( ! function_exists( 'matina_register_banner_fields' ) ) :

    /**
     * Register Banner section's fields.
     *
     * @since 1.0.0
     */
    function matina_register_banner_fields ( $wp_customize ) {

        /**
         * Banner Section
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_homepage_banner',
                array(
                    'priority'      => 10,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_homepage_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Banner Section', 'matina' )
                )
            )
        );

        /**
         * Toggle option for homepage banner
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_homepage_banner_option',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => true,
                'sanitize_callback' => 'matina_sanitize_checkbox'
            )
        );

        $wp_customize->add_control( new Matina_Control_Toggle(
            $wp_customize, 'matina_homepage_banner_option',
                array(
                    'priority'      => 10,
                    'section'       => 'matina_section_homepage_banner',
                    'settings'      => 'matina_homepage_banner_option',
                    'label'         => __( 'Enable Banner', 'matina' )
                )
            )
        );

        /**
         * Select field for homepage banner type
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_banner_type',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'single',
                'sanitize_callback' => 'matina_sanitize_select'
            )
        );
        
        $wp_customize->add_control( 'matina_banner_type',
            array(
                'priority'          => 20,
                'section'           => 'matina_section_homepage_banner',
                'settings'          => 'matina_banner_type',
                'label'             => __( 'Banner Type', 'matina' ),
                'type'              => 'select',
                'choices'           => matina_homepage_banner_type_choices(),
                'active_callback'   => 'matina_cb_enable_homepage_banner',
            )
        );

        /**
         * Image field for single banner image
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_banner_image_url',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => '',
                'sanitize_callback' => 'matina_sanitize_image'
            )
        );

        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            'matina_single_banner_image_url',
                array(
                    'priority'          => 30,
                    'section'           => 'matina_section_homepage_banner',
                    'settings'          => 'matina_single_banner_image_url',
                    'label'             => __( 'Banner Image', 'matina' ),
                    'active_callback'   => 'matina_cb_has_select_single_banner',
                )
            )
        );

        /**
         * Text field for homepage single banner title
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_banner_title',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'matina_sanitize_title_field'
            )
        );
        
        $wp_customize->add_control( 'matina_single_banner_title',
            array(
                'priority'          => 40,
                'section'           => 'matina_section_homepage_banner',
                'settings'          => 'matina_single_banner_title',
                'label'             => __( 'Banner Title', 'matina' ),
                'type'              => 'text',
                'active_callback'   => 'matina_cb_has_select_single_banner',
                'input_attrs'       => array(
                    'placeholder' => __( 'Banner Title', 'matina' )
                )
            )
        );

        /**
         * Textarea field for homepage single banner description
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_single_banner_description',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'matina_sanitize_textarea'
            )
        );
        
        $wp_customize->add_control( 'matina_single_banner_description',
            array(
                'priority'          => 50,
                'section'           => 'matina_section_homepage_banner',
                'settings'          => 'matina_single_banner_description',
                'label'             => __( 'Banner Description', 'matina' ),
                'type'              => 'textarea',
                'active_callback'   => 'matina_cb_has_select_single_banner',
                'input_attrs'       => array(
                    'placeholder' => __( 'Banner Description', 'matina' )
                )
            )
        );

        /**
         * Dropdown categories field for homepage banner category
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_banner_category',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => '0',
                'sanitize_callback' => 'matina_sanitize_number'
            )
        );
        
        $wp_customize->add_control( new Matina_Control_Dropdown_Categories(
            $wp_customize, 'matina_banner_category',
                array(
                    'priority'          => 60,
                    'section'           => 'matina_section_homepage_banner',
                    'settings'          => 'matina_banner_category',
                    'label'             => __( 'Banner Category', 'matina' ),
                    'active_callback'   => 'matina_cb_has_select_category_banner',
                )
            )
        );

        /**
         * Number field for homepage category banner post count
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_category_banner_posts_count',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 3,
                'sanitize_callback' => 'matina_sanitize_number'
            )
        );
        
        $wp_customize->add_control( 'matina_category_banner_posts_count',
            array(
                'priority'          => 70,
                'section'           => 'matina_section_homepage_banner',
                'settings'          => 'matina_category_banner_posts_count',
                'label'             => __( 'No. of posts', 'matina' ),
                'type'              => 'number',
                'active_callback'   => 'matina_cb_has_select_category_banner',
                'input_attrs'       => array(
                    'min' => '-1'
                )
            )
        );

        /**
         * Text field for homepage banner button label
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_banner_button_label',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => __( 'Read More', 'matina' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'matina_sanitize_title_field'
            )
        );
        
        $wp_customize->add_control( 'matina_banner_button_label',
            array(
                'priority'          => 90,
                'section'           => 'matina_section_homepage_banner',
                'settings'          => 'matina_banner_button_label',
                'label'             => __( 'Button Label', 'matina' ),
                'type'              => 'text',
                'active_callback'   => 'matina_cb_enable_homepage_banner',
                'input_attrs'       => array(
                    'placeholder' => __( 'Read More', 'matina' )
                )
            )
        );

        /**
         * Url field for homepage banner button link
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_banner_button_link',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        
        $wp_customize->add_control( 'matina_banner_button_link',
            array(
                'priority'          => 100,
                'section'           => 'matina_section_homepage_banner',
                'settings'          => 'matina_banner_button_link',
                'label'             => __( 'Button Link', 'matina' ),
                'type'              => 'url',
                'active_callback'   => 'matina_cb_has_select_single_banner',
                'input_attrs'       => array(
                    'placeholder' => __( 'https://example.com/', 'matina' )
                )
            )
        );

        /**
         * Radio image field for banner layout
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_banner_layout',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'layout-default',
                'sanitize_callback' => 'matina_sanitize_select',
            )
        );

        $wp_customize->add_control( new Matina_Control_Radio_Image(
            $wp_customize, 'matina_banner_layout',
                array(
                    'priority'          => 105,
                    'section'           => 'matina_section_homepage_banner',
                    'settings'          => 'matina_banner_layout',
                    'label'             => __( 'Banner Layout', 'matina' ),
                    'description'       => __( 'Choose from available layouts', 'matina' ),
                    'choices'           => matina_banner_layout_choices(),
                    'active_callback'   => 'matina_cb_enable_homepage_banner'
                )
            )
        );

        /**
         * Heading field for Slider Settings
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_slider_settings_heading',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Heading(
            $wp_customize, 'matina_slider_settings_heading',
                array(
                    'priority'          => 110,
                    'section'           => 'matina_section_homepage_banner',
                    'settings'          => 'matina_slider_settings_heading',
                    'label'             => __( 'Slider Settings', 'matina' ),
                    'active_callback'   => 'matina_cb_hasnt_select_single_banner'
                )
            )
        );

        /**
         * Buttonset option for banner slide mode
         *
         * Theme Options > Homepage > Banner Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_banner_slide_mode',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => 'fade',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control( new Matina_Control_Buttonset(
            $wp_customize, 'matina_banner_slide_mode',
                array(
                    'priority'          => 115,
                    'section'           => 'matina_section_homepage_banner',
                    'settings'          => 'matina_banner_slide_mode',
                    'label'             => __( 'Slide Mode', 'matina' ),
                    'description'       => __( 'Type of transition', 'matina' ),
                    'choices'           => matina_banner_slide_mode_choices(),
                    'active_callback'   => 'matina_cb_has_select_category_banner'
                )
            )
        );

    } //end function

endif;