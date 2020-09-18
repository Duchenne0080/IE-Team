<?php
/**
 * Rinzai Customizer Class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Rinzai_Customizer' ) ) :

    /**
	 * The Rinzai Customizer class
	 */
	class Rinzai_Customizer {

		/**
		 * Setup class.
		 */
		public function __construct() {
            add_action( 'customize_register',           array( $this, 'customize_register_theme_settings' ), 10 );
            add_action( 'customize_register',           array( $this, 'customize_register_blog_settings' ), 10 );
			add_action( 'customize_register', 			array( $this, 'customize_register_header_video' ), 10 );
			add_action( 'customize_preview_init', 		array( $this, 'customize_preview_script' ) );
        }

        /**
		 * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register_theme_settings( WP_Customize_Manager $wp_customize ) {
			// Change transport for default settings.
			$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

			// Remove colors section for now.
			$wp_customize->remove_section( 'colors' );

            // Define theme settings section.
            $wp_customize->add_section( 'rinzai_settings_section', array(
                'title'             => __( 'Theme Settings', 'rinzai' ),
                'description'       => __( 'Customize the theme to fit your needs.', 'rinzai' ),
                'priority'          => 115,
            ) );

            // Setting for toggling social menu display in navbar.
            $wp_customize->add_setting( 'rinzai_navbar_social_menu_display', array(
                'capability'        => 'edit_theme_options',
                'default'           => false,
				'sanitize_callback' => 'rinzai_customizer_sanitize_display_toggle',
                'transport'         => 'postMessage',
            ) );

            // Control for toggling social menu display in navbar.
            $wp_customize->add_control( 'rinzai_navbar_social_menu_display', array(
                'label'             => __( 'Navbar Social Menu', 'rinzai' ),
                'description'       => __( 'Display social menu in the navbar?', 'rinzai' ),
                'section'           => 'rinzai_settings_section',
                'settings'          => 'rinzai_navbar_social_menu_display',
                'type'              => 'radio',
				'choices' => array(
					'yes' 	=> __( 'Yes', 'rinzai' ),
					'no' 	=> __( 'No', 'rinzai' ),
				),
            ) );

			// Selective refresh for navbar social menu.
			$wp_customize->selective_refresh->add_partial( 'rinzai_navbar_social_menu_display', array(
				'selector' => '#rinzai-navbar-social-menu',
				'render_callback' => 'rinzai_customizer_navbar_social_menu_display',
			) );

			/**
			 * Filter number of front page sections in Rinzai theme.
			 *
			 * @param int $num_sections Number of front page sections.
			 */
			$num_sections = apply_filters( 'rinzai_front_page_sections', 4 );

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$wp_customize->add_setting(
					'panel_' . $i, array(
						'default'           => false,
						'sanitize_callback' => 'absint',
						'transport'         => 'postMessage',
					)
				);

				$wp_customize->add_control(
					'panel_' . $i, array(
						/* translators: %d is the front page section number */
						'label'           => sprintf( __( 'Front Page Section %d Content', 'rinzai' ), $i ),
						'description'     => ( 1 !== $i ? '' : __( 'Select pages from the dropdowns. Add an image to a section by setting a featured image in the page editor if you want it to be shown.', 'rinzai' ) ),
						'section'         => 'rinzai_settings_section',
						'type'            => 'dropdown-pages',
						'allow_addition'  => true,
						'active_callback' => 'rinzai_is_static_front_page',
					)
				);

				$wp_customize->selective_refresh->add_partial(
					'panel_' . $i, array(
						'selector'            => '#panel' . $i,
						'render_callback'     => 'rinzai_customizer_front_page_section',
						'container_inclusive' => true,
					)
				);
			}

        }

        /**
		 * Add custom settings for displaying title and subtitle on the blog page.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register_blog_settings( WP_Customize_Manager $wp_customize ) {
			// Define theme settings section.
            $wp_customize->add_section( 'rinzai_blog_settings_section', array(
                'title'             => __( 'Blog Settings', 'rinzai' ),
                'description'       => __( 'Add title and subtitle for the blog page.', 'rinzai' ),
                'priority'          => 120,
            ) );

            // Setting to store blog title value. Default is bloginfo('name').
            $wp_customize->add_setting( 'rinzai_blog_title', array(
                'capability'        => 'edit_theme_options',
                'default'           => get_bloginfo( 'name' ),
				'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage',
            ) );

            // Control to add text input for blog title.
            $wp_customize->add_control( 'rinzai_blog_title', array(
                'label'             => __( 'Blog title', 'rinzai' ),
                'section'           => 'rinzai_blog_settings_section',
				'settings'			=> 'rinzai_blog_title',
                'type'              => 'text',
				'active_callback' 	=> 'is_home',
            ) );

            // Setting to store blog subtitle value. Default is bloginfo('description').
            $wp_customize->add_setting( 'rinzai_blog_subtitle', array(
                'capability'        => 'edit_theme_options',
                'default'           => get_bloginfo( 'description' ),
				'sanitize_callback' => 'wp_filter_post_kses',
                'transport'         => 'postMessage',
            ) );

            // Control to add text input for blog subtitle.
            $wp_customize->add_control( 'rinzai_blog_subtitle', array(
                'label'             => __( 'Blog subtitle', 'rinzai' ),
                'section'           => 'rinzai_blog_settings_section',
				'settings'			=> 'rinzai_blog_subtitle',
                'type'              => 'textarea',
				'active_callback' 	=> 'is_home',
            ) );
		}

		/**
		 * Added support for custom header video markup.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register_header_video( WP_Customize_Manager $wp_customize ) {

			// Show header image control only on blog page.
			$wp_customize->get_control( 'header_image' )->active_callback = 'is_home';

			// Remove external header video control.
			$wp_customize->remove_control( 'external_header_video' );

			// Add setting for uploading custom header video.
			$wp_customize->add_setting( 'header_video', array(
				'sanitize_callback' => 'absint', // Attachment id is saved.
				'transport' => 'postMessage',
			));

			// Add control for uploading custom header video.
			$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'header_video', array(
					'mime_type'       => 'video',
					'label'           => __( 'Header Video', 'rinzai' ),
					'description'     => __( 'Upload your video in .mp4 format and minimize its file size for best results. This theme recommends a height of 450 pixels.', 'rinzai' ),
					'section'         => 'header_image',
					'priority'        => 0,
				 	'active_callback' => 'rinzai_customizer_header_video_active_callback',
				)
			));

			// Selective refresh support for custom header video.
			$wp_customize->selective_refresh->add_partial(
				'header_video', array(
					'selector'        		=> '#rinzai-header-video',
					'settings'        		=> array( 'header_video' ),
					'render_callback' 		=> 'rinzai_header_video_markup',
					'container_inclusive' 	=> true,
				)
			);

		}

		/**
		 * Customizer preview script.
		 */
		public function customize_preview_script() {
			wp_enqueue_script( 'rinzai-customize-preview', get_theme_file_uri( '/assets/js/admin/customize-preview.js' ), array( 'jquery', 'customize-preview' ), '', true );
		}
    }

endif;

return new Rinzai_Customizer();
