<?php
/**
 * Foodiz: Customizer
 *
 * @package Foodiz
 * @since 0.1
 */

class foodiz_Customizer {

    public function __construct() {

        add_action('customize_register', array($this, 'foodiz_customize_register'));

    }

    public function init() {
    }

    function foodiz_customize_register(WP_Customize_Manager $wp_customize) {     

         /* Create Panel */
        $wp_customize->add_panel('foodiz_theme_option', array(
            'title' => __('Theme Settings', 'foodiz'),
            'priority' => 1, // Mixed with top-level-section hierarchy.
        ));

        /* Frontpage template Switch */
        $wp_customize->add_section('foodiz_frontpage', array(
            'title' => __(' Frontpage Template', 'foodiz'),
            'panel' => 'foodiz_theme_option',
            'capability' => 'edit_theme_options',
            'priority' => 35,
        ));

        $wp_customize->add_setting('foodiz_frontpage_show', array(
            'type' => 'theme_mod',
            'default' => '',
            'sanitize_callback' => 'foodiz_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('foodiz_frontpage_show', array(
            'label' => __('Enable Frontpage template', 'foodiz'),
            'type' => 'checkbox',
            'section' => 'foodiz_frontpage',
            'settings' => 'foodiz_frontpage_show',
        ));   
		
		$wp_customize->add_setting('foodiz_slider_show', array(
            'type' => 'theme_mod',
            'default' => '',
            'sanitize_callback' => 'foodiz_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('foodiz_slider_show', array(
            'label' => __('Enable Slider on FrontPage', 'foodiz'),
            'type' => 'checkbox',
            'section' => 'foodiz_frontpage',
            'settings' => 'foodiz_slider_show',
        ));
		
    
        /* Category section */
        $wp_customize->add_section('foodiz_category', array(
            'title' => __('Category Section Settings', 'foodiz'),
            'panel' => 'foodiz_theme_option',
            'description' => __('Add All 3 Category Names & Images Below','foodiz'),
            'capability' => 'edit_theme_options',
            'priority' => 35,
        ));


        $wp_customize->add_setting('foodiz_category_show', array(
            'type' => 'theme_mod',
            'default' => '',
            'sanitize_callback' => 'foodiz_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('foodiz_category_show', array(
            'label' => __('Category Section On/Off', 'foodiz'),
            'type' => 'checkbox',
            'input_attrs' => array('value' => 1),
            'section' => 'foodiz_category',
            'settings' => 'foodiz_category_show',
        ));

        for ($i = 1; $i <= 3; $i++) {
            $wp_customize->add_setting('category_select_' . $i, array(
                'default' => 0,
                'sanitize_callback' => 'absint',
            ));

            $wp_customize->add_control(new foodiz_My_Dropdown_Category_Control($wp_customize, 'category_select_' . $i, array(
                'section' => 'foodiz_category',
                'label' => __('Category ','foodiz') . esc_attr($i),
                'description' => esc_html__('Select the category to display', 'foodiz'),
            )));

            $wp_customize->add_setting(
                'category_image_' . $i,
                array(
                    'type' => 'theme_mod',
                    'default' => '',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );

            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'category_image_' . $i, array(
                'label' => __('Category Image ','foodiz') . esc_attr($i),
                'section' => 'foodiz_category',
                'settings' => 'category_image_' . $i
            )));
        } 

         /* About Section */
        $wp_customize->add_section( 'foodiz_about', array(
            'title'      => __( 'About Us Section', 'foodiz' ),
            'panel'      => 'foodiz_theme_option',
            'capability' => 'edit_theme_options',
            'priority'   => 35,
        ) );

        $wp_customize->add_setting( 'foodiz_about_show', array(
            'type'              => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'foodiz_sanitize_checkbox',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( 'foodiz_about_show', array(
            'label'    => __( 'About Section On/Off', 'foodiz' ),
            'description' => __( 'Click above checkbox to show About section on front page', 'foodiz' ),
            'type'     => 'checkbox',
            'section'  => 'foodiz_about',
            'settings' => 'foodiz_about_show',
        ) );

        $wp_customize->add_setting( 'foodiz_about_section',
           array(
            'type'              => 'theme_mod',
              'default' => '',
              'sanitize_callback' => 'absint',
              'capability'        => 'edit_theme_options',
           )
        );
        $wp_customize->add_control( 'foodiz_about_section',
            array(
                'label' => __( 'Select about page','foodiz' ),
                'description' => esc_html__( 'Select page to show on Callout section on frontpage template', 'foodiz' ),
                'section' => 'foodiz_about', 
                'type' => 'dropdown-pages',
        ) );
        

         /* Parallex Sections */ 
         $wp_customize->add_section( 'foodiz_callout', array(
            'title'      => __( 'Callout Sections', 'foodiz' ),
            'description' => __( 'These Sections be displayed on FrontPage', 'foodiz' ),
            'panel'      => 'foodiz_theme_option',
            'capability' => 'edit_theme_options',
            'priority'   => 35,
        ) );

          $wp_customize->add_setting( 'foodiz_parallex_section_show_1', array(
            'type'              => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'foodiz_sanitize_checkbox',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( 'foodiz_parallex_section_show_1', array(
            'label'    => __( 'Parallex Section 1 On/Off', 'foodiz' ),
            'type'     => 'checkbox',
            'section'  => 'foodiz_callout',
            'settings' => 'foodiz_parallex_section_show_1',
        ) );
		
		$wp_customize->add_setting( 'foodiz_callout_section',
           array(
            'type'              => 'theme_mod',
              'default' => '',
              'sanitize_callback' => 'absint',
              'capability'        => 'edit_theme_options',
           )
        );
        $wp_customize->add_control( 'foodiz_callout_section',
            array(
                'label' => __( 'Select page','foodiz' ),
                'description' => esc_html__( 'Select page to show on Callout section on frontpage template', 'foodiz' ),
                'section' => 'foodiz_callout', 
                'type' => 'dropdown-pages',
        ) );

        /* blog section */
		$wp_customize->add_section( 'foodiz_blog', array(
			'title'      => __( 'Blog Options', 'foodiz' ),
			'panel'      => 'foodiz_theme_option',
			'capability' => 'edit_theme_options',
			'priority'   => 35,
		) );

		$wp_customize->add_setting( 'foodiz_blog_title', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'foodiz_blog_title', array(
			'label'    => __( 'Blog Title ', 'foodiz' ),
			'type'     => 'text',
			'section'  => 'foodiz_blog',
			'settings' => 'foodiz_blog_title',
		) );

		$wp_customize->add_setting( 'foodiz_blog_desc', array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'capability'        => 'edit_theme_options',
			)
		);
		$wp_customize->add_control( 'foodiz_blog_desc', array(
			'label'    => __( 'Blog description ', 'foodiz' ),
			'type'     => 'text',
			'section'  => 'foodiz_blog',
			'settings' => 'foodiz_blog_desc',
		) );

        /* Footer Section */
        $wp_customize->add_section('foodiz_footer', array(
            'title' => __('Footer Options', 'foodiz'),
            'panel' => 'foodiz_theme_option',
            'capability' => 'edit_theme_options',
            'priority' => 35,
        ));

        $wp_customize->add_setting('footer_text', array(
            'type' => 'theme_mod',
            'default' => '',
            'sanitize_callback' => 'wp_filter_nohtml_kses',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('footer_text', array(
            'label' => __('Footer Text', 'foodiz'),
            'type' => 'text',
            'section' => 'foodiz_footer',
            'settings' => 'footer_text',
        ));

        $wp_customize->add_setting('footer_copyright', array(
                'type' => 'theme_mod',
                'default' => '',
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'capability' => 'edit_theme_options',
            )
        );
        $wp_customize->add_control('footer_copyright', array(
            'label' => __('Footer Copyright', 'foodiz'),
            'type' => 'text',
            'section' => 'foodiz_footer',
            'settings' => 'footer_copyright',
        ));

        $wp_customize->add_setting('footer_link', array(
                'type' => 'theme_mod',
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
                'capability' => 'edit_theme_options',
            )
        );
        $wp_customize->add_control('footer_link', array(
            'label' => __('Footer Link', 'foodiz'),
            'type' => 'url',
            'section' => 'foodiz_footer',
            'settings' => 'footer_link',
        ));        


        /* contact section */
        $wp_customize->add_section('foodiz_contact', array(
            'title' => __('Topbar Settings', 'foodiz'),
            'panel' => 'foodiz_theme_option',
            'capability' => 'edit_theme_options',
            'priority' => 35,
        ));

        $wp_customize->add_setting('foodiz_contact_show', array(
            'type' => 'theme_mod',
            'default' => '',
            'sanitize_callback' => 'foodiz_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('foodiz_contact_show', array(
            'label' => __('Contact Section On/Off', 'foodiz'),
            'type' => 'checkbox',
            'section' => 'foodiz_contact',
            'settings' => 'foodiz_contact_show',
        ));

        $wp_customize->add_setting('foodiz_phoneno', array(
                'type' => 'theme_mod',
                'default' => '',
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'capability' => 'edit_theme_options',
            )
        );
        $wp_customize->add_control('foodiz_phoneno', array(
            'label' => __('Phone no. ', 'foodiz'),
            'type' => 'text',
            'section' => 'foodiz_contact',
            'settings' => 'foodiz_phoneno',
        ));

        $wp_customize->add_setting('foodiz_address', array(
                'type' => 'theme_mod',
                'default' => '',
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'capability' => 'edit_theme_options',
            )
        );
        $wp_customize->add_control('foodiz_address', array(
            'label' => __('Address ', 'foodiz'),
            'type' => 'text',
            'section' => 'foodiz_contact',
            'settings' => 'foodiz_address',
        ));

        $wp_customize->add_setting('foodiz_email', array(
                'type' => 'theme_mod',
                'default' => '',
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'capability' => 'edit_theme_options',
            )
        );
        $wp_customize->add_control('foodiz_email', array(
            'label' => __('Email ', 'foodiz'),
            'type' => 'email',
            'section' => 'foodiz_contact',
            'settings' => 'foodiz_email',
        ));
		
		/* inner header image */
		$wp_customize->add_section( 'foodiz_inner_banner', array(
			'title'      => __( 'Inner banner', 'foodiz' ),
			'panel'      => 'foodiz_theme_option',
			'capability' => 'edit_theme_options',
			'priority'   => 35,
		) );
		$wp_customize->add_setting( 'foodiz_inner_image', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'foodiz_inner_image', array(
			'label'    => __( 'Inner banner Image', 'foodiz' ),
			'description' => __( 'background image show in breadcrumb area', 'foodiz' ),
			'section'  => 'foodiz_inner_banner',
			'settings' => 'foodiz_inner_image'
		) ) );

		 $wp_customize->add_setting('foodiz_breadcrumb_show', array(
            'type' => 'theme_mod',
            'default' => '1',
            'sanitize_callback' => 'foodiz_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('foodiz_breadcrumb_show', array(
            'label' => __('Enable breadcrumb', 'foodiz'),
            'type' => 'checkbox',
            'section' => 'foodiz_inner_banner',
            'settings' => 'foodiz_breadcrumb_show',
        ));


        //typography
        $wp_customize->add_section( 'foodiz_typography', array(
            'title'      => __( 'Typography', 'foodiz' ),
            'panel'      => 'foodiz_theme_option',
            'capability' => 'edit_theme_options',
            'priority'   => 35,
        ) );
        
        $wp_customize->add_setting('main_heading_font',array(
            'type' => 'theme_mod',
            'sanitize_callback'=>'wp_filter_nohtml_kses',
            'capability'=>'edit_theme_options',
        ));

        $wp_customize->add_control(new foodiz_Font_Control($wp_customize, 'main_heading_font', array(
        'label' => __('Logo Font Style', 'foodiz'),
        /* 'type' => 'select', */
        'section' => 'foodiz_typography',
        'settings' => 'main_heading_font',
        )));
    
        $wp_customize->add_setting(
        'menu_font',
        array(
        'type' => 'theme_mod',
        'sanitize_callback'=>'wp_filter_nohtml_kses',
        'capability'=>'edit_theme_options'
        ));

        $wp_customize->add_control(new foodiz_Font_Control($wp_customize, 'menu_font', array(
        'label' => __('Header Menu Font Style', 'foodiz'),
        'section' => 'foodiz_typography',
        'settings' => 'menu_font'
        )));
        
        $wp_customize->add_setting('theme_title', array(
        'type' => 'theme_mod',
        'sanitize_callback'=>'wp_filter_nohtml_kses',
        'capability'=>'edit_theme_options'
        ));

        $wp_customize->add_control(new foodiz_Font_Control($wp_customize, 'theme_title', array(
        'label' => __('Theme Section Title Font Style', 'foodiz'),
        'section' => 'foodiz_typography',
        'settings' => 'theme_title'
        )));
        
        /*$wp_customize->add_setting('desc_font_all', array(
        'type' => 'theme_mod',
        'sanitize_callback'=>'wp_filter_nohtml_kses',
        'capability'=>'edit_theme_options'
        ));

        $wp_customize->add_control(new foodiz_Font_Control($wp_customize, 'desc_font_all', array(
        'label' => __('Theme Section Description Font Style', 'foodiz'),
        'section' => 'foodiz_typography',
        'settings' => 'desc_font_all'
        )));*/

        
        function foodiz_sanitize_checkbox($input)
        {
            return ( 1 === absint( $input ) ) ? 1 : 0;
        }
    }

}
new foodiz_Customizer();