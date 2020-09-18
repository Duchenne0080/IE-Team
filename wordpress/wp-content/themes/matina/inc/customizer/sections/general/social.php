<?php
/**
 * Add Social Icons section and it's fields inside General section group.
 * 
 * @package Matina
 */

add_action( 'customize_register', 'matina_register_social_icons_fields' );

if ( ! function_exists( 'matina_register_social_icons_fields' ) ) :

    /**
     * Register social icons section's fields.
     */
    function matina_register_social_icons_fields ( $wp_customize ) {

        /**
         * Social Icons Section
         *
         * Theme Options > General > Social Icons
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Matina_Customize_Section(
            $wp_customize, 'matina_section_social_icons',
                array(
                    'priority'      => 50,
                    'panel'         => 'matina_theme_options_panel',
                    'section'       => 'matina_general_group',
                    'capability'    => 'edit_theme_options',
                    'theme_options' => '',
                    'title'         => __( 'Social Icons', 'matina' )
                )
            )
        );
        
        /**
         * Repeater field for Social Icons
         *
         * Theme Options > General > Social Icons
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'matina_social_media',
            array(
                'capability'        => 'edit_theme_options',
                'theme_options'     => '',
                'default'           => array(
                    array(
                        'mt_item_icon'      => '',
                        'mt_item_link'      => '',
                        'mt_item_title'     => '',
                        'mt_item_checkbox'  => ''
                    )
                ),
                'sanitize_callback' => 'matina_sanitize_repeater'
            )
        );

        $wp_customize->add_control( new Matina_Control_Repeater(
            $wp_customize, 
            'matina_social_media',
                array(
                    'priority'                      => 20,
                    'section'                       => 'matina_section_social_icons',
                    'settings'                      => 'matina_social_media',
                    'label'                         => __( 'Social Icons', 'matina' ),
                    'matina_box_label_text'         => __( 'Social Icon','matina' ),
                    'matina_box_add_control_text'   => __( 'Add New Icon','matina' )
                ),
                array(
                    'mt_item_icon' => array(
                        'type'        => 'social_icon',
                        'label'       => __( 'Icon', 'matina' ),
                        'description' => __( 'Choose required icon from available list.', 'matina' )
                    ),
                    'mt_item_link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Icon Link', 'matina' ),
                        'description' => __( 'Add social icon link.', 'matina' )
                    ),
                    'mt_item_title' => array(
                        'type'        => 'text',
                        'label'       => __( 'Icon Title', 'matina' ),
                        'description' => __( 'Add social icon title.', 'matina' )
                    ),
                    'mt_item_checkbox' => array(
                        'type'        => 'checkbox',
                        'label'       => __( 'Checked to open link on new tab.', 'matina' )
                    )
                )
            )
        );

    }

endif;