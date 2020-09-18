<?php
/**
 * VW Restaurant Lite Theme Customizer
 *
 * @package VW Restaurant Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_restaurant_lite_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_restaurant_lite_custom_controls' );

function vw_restaurant_lite_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );	

  load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

  //Selective Refresh
  $wp_customize->selective_refresh->add_partial( 'blogname', array( 
    'selector' => '.logo .site-title a', 
    'render_callback' => 'vw_restaurant_lite_customize_partial_blogname', 
  )); 

  $wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
    'selector' => 'p.site-description', 
    'render_callback' => 'vw_restaurant_lite_customize_partial_blogdescription', 
  ));

  $VWRestaurantLiteParentPanel = new VW_Restaurant_Lite_WP_Customize_Panel( $wp_customize, 'vw_restaurant_lite_panel_id', array(
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => 'VW Settings',
    'priority' => 10,
  ));

	//theme Layouts
	$wp_customize->add_section( 'vw_restaurant_lite_left_right', array(
    'title'      => __( 'Theme Layout Settings', 'vw-restaurant-lite' ),
		'priority'   => 30,
		'panel' => 'vw_restaurant_lite_panel_id'
	) );

	$wp_customize->add_setting('vw_restaurant_lite_width_option',array(
    'default' => __('Full Width','vw-restaurant-lite'),
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Restaurant_Lite_Image_Radio_Control($wp_customize, 'vw_restaurant_lite_width_option', array(
    'type' => 'select',
    'label' => __('Width Layouts','vw-restaurant-lite'),
    'description' => __('Here you can change the width layout of Website.','vw-restaurant-lite'),
    'section' => 'vw_restaurant_lite_left_right',
    'choices' => array(
      'Full Width' => get_template_directory_uri().'/images/full-width.png',
      'Wide Width' => get_template_directory_uri().'/images/wide-width.png',
      'Boxed' => get_template_directory_uri().'/images/boxed-width.png',
  ))));

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_restaurant_lite_theme_options',array(
    'default' => __('Right Sidebar','vw-restaurant-lite'),
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'	        
	) );
	$wp_customize->add_control('vw_restaurant_lite_theme_options', array(
    'type' => 'select',
    'label' => __('Post Sidebar Layout','vw-restaurant-lite'),
    'description' => __('Here you can change the sidebar layout for posts. ','vw-restaurant-lite'),
    'section' => 'vw_restaurant_lite_left_right',
    'choices' => array(
      'Left Sidebar' => __('Left Sidebar','vw-restaurant-lite'),
      'Right Sidebar' => __('Right Sidebar','vw-restaurant-lite'),
      'One Column' => __('One Column','vw-restaurant-lite'),
      'Three Columns' => __('Three Columns','vw-restaurant-lite'),
      'Four Columns' => __('Four Columns','vw-restaurant-lite'),
      'Grid Layout' => __('Grid Layout','vw-restaurant-lite')
    ),
	));

	$wp_customize->add_setting('vw_restaurant_lite_page_layout',array(
    'default' => __('One Column','vw-restaurant-lite'),
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'
	));
	$wp_customize->add_control('vw_restaurant_lite_page_layout',array(
    'type' => 'select',
    'label' => __('Page Sidebar Layout','vw-restaurant-lite'),
    'description' => __('Here you can change the sidebar layout for pages. ','vw-restaurant-lite'),
    'section' => 'vw_restaurant_lite_left_right',
    'choices' => array(
      'Left Sidebar' => __('Left Sidebar','vw-restaurant-lite'),
      'Right Sidebar' => __('Right Sidebar','vw-restaurant-lite'),
      'One Column' => __('One Column','vw-restaurant-lite')
    ),
	) );

	//Pre-Loader
	$wp_customize->add_setting( 'vw_restaurant_lite_loader_enable',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_loader_enable',array(
    'label' => esc_html__( 'Pre-Loader','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_left_right'
  )));

	$wp_customize->add_setting('vw_restaurant_lite_loader_icon',array(
    'default' => __('Two Way','vw-restaurant-lite'),
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'
	));
	$wp_customize->add_control('vw_restaurant_lite_loader_icon',array(
    'type' => 'select',
    'label' => __('Pre-Loader Type','vw-restaurant-lite'),
    'section' => 'vw_restaurant_lite_left_right',
    'choices' => array(
      'Two Way' => __('Two Way','vw-restaurant-lite'),
      'Dots' => __('Dots','vw-restaurant-lite'),
      'Rotate' => __('Rotate','vw-restaurant-lite')
    ),
	) );

	//Topbar section
	$wp_customize->add_section('vw_restaurant_lite_topbar_icon',array(
		'title'	=> __('Topbar Section','vw-restaurant-lite'),
		'description'	=> __('Add Top Header Content here','vw-restaurant-lite'),
		'priority'	=> null,
		'panel' => 'vw_restaurant_lite_panel_id',
	));

	$wp_customize->add_setting( 'vw_restaurant_lite_topbar_hide_show',array(
    'default' => 0,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));  
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_topbar_hide_show',array(
    'label' => esc_html__( 'Show / Hide Topbar','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_topbar_icon'
  )));

  $wp_customize->add_setting('vw_restaurant_lite_topbar_padding_top_bottom',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_topbar_padding_top_bottom',array(
    'label' => __('Topbar Padding Top Bottom','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_topbar_icon',
    'type'=> 'text'
  ));

  //Sticky Header
	$wp_customize->add_setting( 'vw_restaurant_lite_sticky_header',array(
    'default' => 0,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ) );
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_sticky_header',array(
    'label' => esc_html__( 'Sticky Header','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_topbar_icon'
  )));

  $wp_customize->add_setting('vw_restaurant_lite_sticky_header_padding',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_sticky_header_padding',array(
    'label' => __('Sticky Header Padding','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-restaurant-lite' ),
        ),
    'section'=> 'vw_restaurant_lite_topbar_icon',
    'type'=> 'text'
  ));

  //Selective Refresh
  $wp_customize->selective_refresh->add_partial('vw_restaurant_lite_contact', array( 
    'selector' => 'span.call', 
    'render_callback' => 'vw_restaurant_lite_customize_partial_vw_restaurant_lite_contact', 
  ));

  $wp_customize->add_setting('vw_restaurant_lite_cont_phone_icon',array(
    'default' => 'fa fa-phone',
    'sanitize_callback' => 'sanitize_text_field'
  )); 
  $wp_customize->add_control(new VW_Restaurant_Lite_Fontawesome_Icon_Chooser($wp_customize,'vw_restaurant_lite_cont_phone_icon',array(
    'label' => __('Add Phone Number Icon','vw-restaurant-lite'),
    'transport' => 'refresh',
    'section' => 'vw_restaurant_lite_topbar_icon',
    'setting' => 'vw_restaurant_lite_cont_phone_icon',
    'type'    => 'icon'
  )));

	$wp_customize->add_setting('vw_restaurant_lite_contact',array(
		'default'	=> '',
		'sanitize_callback'	=> 'vw_restaurant_lite_sanitize_phone_number'
	));
	
	$wp_customize->add_control('vw_restaurant_lite_contact',array(
		'label'	=> __('Add Phone Number','vw-restaurant-lite'),
		'section'	=> 'vw_restaurant_lite_topbar_icon',
		'setting'	=> 'vw_restaurant_lite_contact',
		'type'		=> 'text'
	));

  $wp_customize->add_setting('vw_restaurant_lite_cont_email_icon',array(
    'default' => 'fa fa-envelope',
    'sanitize_callback' => 'sanitize_text_field'
  )); 
  $wp_customize->add_control(new VW_Restaurant_Lite_Fontawesome_Icon_Chooser($wp_customize,'vw_restaurant_lite_cont_email_icon',array(
    'label' => __('Add Email Icon','vw-restaurant-lite'),
    'transport' => 'refresh',
    'section' => 'vw_restaurant_lite_topbar_icon',
    'setting' => 'vw_restaurant_lite_cont_email_icon',
    'type'    => 'icon'
  )));

	$wp_customize->add_setting('vw_restaurant_lite_email',array(
		'default'	=> '',
		'sanitize_callback'	=> 'vw_restaurant_lite_sanitize_email'
	));
	
	$wp_customize->add_control('vw_restaurant_lite_email',array(
		'label'	=> __('Add Email','vw-restaurant-lite'),
		'section'	=> 'vw_restaurant_lite_topbar_icon',
		'setting'	=> 'vw_restaurant_lite_email',
		'type'		=> 'text'
	));
	
	//home page slider
  $wp_customize->add_section( 'vw_restaurant_lite_slidersettings' , array(
    'title'      => __( 'Slider Settings', 'vw-restaurant-lite' ),
    'priority'   => null,
    'panel' => 'vw_restaurant_lite_panel_id'
  ) );

  $wp_customize->add_setting( 'vw_restaurant_lite_slider_hide_show',array(
    'default' => 0,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));  
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_slider_hide_show',array(
    'label' => esc_html__( 'Show / Hide Slider','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_slidersettings'
  )));

  //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_restaurant_lite_slider_hide_show',array(
    'selector' => '.slider .inner_carousel h1',
    'render_callback' => 'vw_restaurant_lite_customize_partial_vw_restaurant_lite_slider_hide_show',
  ));

  for ( $count = 1; $count <= 4; $count++ ) {
    // Add color scheme setting and control.
    $wp_customize->add_setting( 'vw_restaurant_lite_slider_page' . $count, array(
      'default'           => '',
      'sanitize_callback' => 'vw_restaurant_lite_sanitize_dropdown_pages'
    ) );
    $wp_customize->add_control( 'vw_restaurant_lite_slider_page' . $count, array(
      'label'    => __( 'Select Slide Image Page', 'vw-restaurant-lite' ),
      'description' => __('Slider image size (1284 x 546)','vw-restaurant-lite'),
      'section'  => 'vw_restaurant_lite_slidersettings',
      'type'     => 'dropdown-pages'
    ) );
  }

  $wp_customize->add_setting('vw_restaurant_lite_slider_button_text',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_slider_button_text',array(
    'label' => __('Add Slider Button Text','vw-restaurant-lite'),
    'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'vw-restaurant-lite' ),
        ),
    'section'=> 'vw_restaurant_lite_slidersettings',
    'type'=> 'text'
  ));

  //content layout
	$wp_customize->add_setting('vw_restaurant_lite_slider_content_option',array(
    'default' => __('Center','vw-restaurant-lite'),
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Restaurant_Lite_Image_Radio_Control($wp_customize, 'vw_restaurant_lite_slider_content_option', array(
    'type' => 'select',
    'label' => __('Slider Content Layouts','vw-restaurant-lite'),
    'section' => 'vw_restaurant_lite_slidersettings',
    'choices' => array(
      'Left' => get_template_directory_uri().'/images/slider-content1.png',
      'Center' => get_template_directory_uri().'/images/slider-content2.png',
      'Right' => get_template_directory_uri().'/images/slider-content3.png',
  ))));

  //Slider excerpt
	$wp_customize->add_setting( 'vw_restaurant_lite_slider_excerpt_number', array(
		'default'              => 30,
		'transport' 		       => 'refresh',
		'sanitize_callback'    => 'vw_restaurant_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_restaurant_lite_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','vw-restaurant-lite' ),
		'section'     => 'vw_restaurant_lite_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_restaurant_lite_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Opacity
	$wp_customize->add_setting('vw_restaurant_lite_slider_opacity_color',array(
    'default' => 0.5,
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_restaurant_lite_slider_opacity_color', array(
	'label'       => esc_html__( 'Slider Image Opacity','vw-restaurant-lite' ),
	'section'     => 'vw_restaurant_lite_slidersettings',
	'type'        => 'select',
	'settings'    => 'vw_restaurant_lite_slider_opacity_color',
	'choices' => array(
    '0' =>  esc_attr('0','vw-restaurant-lite'),
    '0.1' =>  esc_attr('0.1','vw-restaurant-lite'),
    '0.2' =>  esc_attr('0.2','vw-restaurant-lite'),
    '0.3' =>  esc_attr('0.3','vw-restaurant-lite'),
    '0.4' =>  esc_attr('0.4','vw-restaurant-lite'),
    '0.5' =>  esc_attr('0.5','vw-restaurant-lite'),
    '0.6' =>  esc_attr('0.6','vw-restaurant-lite'),
    '0.7' =>  esc_attr('0.7','vw-restaurant-lite'),
    '0.8' =>  esc_attr('0.8','vw-restaurant-lite'),
    '0.9' =>  esc_attr('0.9','vw-restaurant-lite')
	),
	));

  //Slider height
  $wp_customize->add_setting('vw_restaurant_lite_slider_height',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_slider_height',array(
    'label' => __('Slider Height','vw-restaurant-lite'),
    'description' => __('Specify the slider height (px).','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( '500px', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_slidersettings',
    'type'=> 'text'
  ));

  $wp_customize->add_setting( 'vw_restaurant_lite_slider_speed', array(
    'default'  => 3000,
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_float'
  ) );
  $wp_customize->add_control( 'vw_restaurant_lite_slider_speed', array(
    'label' => esc_html__('Slider Transition Speed','vw-restaurant-lite'),
    'section' => 'vw_restaurant_lite_slidersettings',
    'type'  => 'number',
  ) );

	//we Believe
	$wp_customize->add_section('vw_restaurant_lite_belive',array(
		'title'	=> __('We Believe Section','vw-restaurant-lite'),
		'description'	=> __('Add We Believe sections below.','vw-restaurant-lite'),
		'panel' => 'vw_restaurant_lite_panel_id',
	));

  //Selective Refresh
  $wp_customize->selective_refresh->add_partial( 'vw_restaurant_lite_belive_post_setting', array( 
    'selector' => '.we_belive a.button', 
    'render_callback' => 'vw_restaurant_lite_customize_partial_vw_restaurant_lite_belive_post_setting',
  ));

	$args = array('numberposts' => -1);
	$post_list = get_posts($args);
	$posts[]='Select';	
	foreach($post_list as $post){
		$posts[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('vw_restaurant_lite_belive_post_setting',array(
		'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices',
	));
	$wp_customize->add_control('vw_restaurant_lite_belive_post_setting',array(
		'type'    => 'select',
		'choices' => $posts,
		'label' => __('Select post','vw-restaurant-lite'),
		'section' => 'vw_restaurant_lite_belive',
	));

  $wp_customize->add_setting('vw_restaurant_lite_about_button_text',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_about_button_text',array(
    'label' => __('Add About Button Text','vw-restaurant-lite'),
    'input_attrs' => array(
            'placeholder' => __( 'ABOUT US', 'vw-restaurant-lite' ),
        ),
    'section'=> 'vw_restaurant_lite_belive',
    'type'=> 'text'
  ));

  //Blog Post
  $wp_customize->add_panel( $VWRestaurantLiteParentPanel );

  $BlogPostParentPanel = new VW_Restaurant_Lite_WP_Customize_Panel( $wp_customize, 'blog_post_parent_panel', array(
    'title' => __( 'Blog Post Settings', 'vw-restaurant-lite' ),
    'panel' => 'vw_restaurant_lite_panel_id',
  ));

  $wp_customize->add_panel( $BlogPostParentPanel );

  // Add example section and controls to the middle (second) panel
  $wp_customize->add_section( 'vw_restaurant_lite_post_settings', array(
    'title' => __( 'Post Settings', 'vw-restaurant-lite' ),
    'panel' => 'blog_post_parent_panel',
  ));

  //Selective Refresh
  $wp_customize->selective_refresh->add_partial('vw_restaurant_lite_toggle_postdate', array( 
    'selector' => '.services-box h2 a', 
    'render_callback' => 'vw_restaurant_lite_customize_partial_vw_restaurant_lite_toggle_postdate', 
  ));

	$wp_customize->add_setting( 'vw_restaurant_lite_toggle_postdate',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_toggle_postdate',array(
    'label' => esc_html__( 'Post Date','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_post_settings'
  )));

  $wp_customize->add_setting( 'vw_restaurant_lite_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ) );
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_toggle_author',array(
		'label' => esc_html__( 'Author','vw-restaurant-lite' ),
		'section' => 'vw_restaurant_lite_post_settings'
  )));

  $wp_customize->add_setting( 'vw_restaurant_lite_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ) );
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-restaurant-lite' ),
		'section' => 'vw_restaurant_lite_post_settings'
  )));

  $wp_customize->add_setting( 'vw_restaurant_lite_category_hide_show',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));  
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_category_hide_show',array(
    'label' => esc_html__( 'Category','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_post_settings'
  )));

  $wp_customize->add_setting( 'vw_restaurant_lite_toggle_tags',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_toggle_tags', array(
    'label' => esc_html__( 'Tags','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_post_settings'
  )));

  $wp_customize->add_setting( 'vw_restaurant_lite_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_restaurant_lite_sanitize_number_range'
	));
	$wp_customize->add_control( 'vw_restaurant_lite_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-restaurant-lite' ),
		'section'     => 'vw_restaurant_lite_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_restaurant_lite_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog layout
	$wp_customize->add_setting('vw_restaurant_lite_blog_layout_option',array(
    'default' => __('Default','vw-restaurant-lite'),
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Restaurant_Lite_Image_Radio_Control($wp_customize, 'vw_restaurant_lite_blog_layout_option', array(
    'type' => 'select',
    'label' => __('Blog Layouts','vw-restaurant-lite'),
    'section' => 'vw_restaurant_lite_post_settings',
    'choices' => array(
      'Default' => get_template_directory_uri().'/images/blog-layout1.png',
      'Center' => get_template_directory_uri().'/images/blog-layout2.png',
      'Left' => get_template_directory_uri().'/images/blog-layout3.png',
  ))));

  $wp_customize->add_setting('vw_restaurant_lite_excerpt_settings',array(
    'default' => __('Excerpt','vw-restaurant-lite'),
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'
  ));
  $wp_customize->add_control('vw_restaurant_lite_excerpt_settings',array(
    'type' => 'select',
    'label' => __('Post Content','vw-restaurant-lite'),
    'section' => 'vw_restaurant_lite_post_settings',
    'choices' => array(
      'Content' => __('Content','vw-restaurant-lite'),
      'Excerpt' => __('Excerpt','vw-restaurant-lite'),
      'No Content' => __('No Content','vw-restaurant-lite')
    ),
  ) );

  $wp_customize->add_setting('vw_restaurant_lite_excerpt_suffix',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_excerpt_suffix',array(
    'label' => __('Add Excerpt Suffix','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( '[...]', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_post_settings',
    'type'=> 'text'
  ));

  $wp_customize->add_setting( 'vw_restaurant_lite_blog_pagination_hide_show',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));  
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_blog_pagination_hide_show',array(
    'label' => esc_html__( 'Show / Hide Blog Pagination','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_post_settings'
  )));

  $wp_customize->add_setting( 'vw_restaurant_lite_blog_pagination_type', array(
    'default'     => 'blog-page-numbers',
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'
  ));
  $wp_customize->add_control( 'vw_restaurant_lite_blog_pagination_type', array(
    'section' => 'vw_restaurant_lite_post_settings',
    'type' => 'select',
    'label' => __( 'Blog Pagination', 'vw-restaurant-lite' ),
    'choices'   => array(
      'blog-page-numbers'  => __( 'Numeric', 'vw-restaurant-lite' ),
      'next-prev' => __( 'Older Posts/Newer Posts', 'vw-restaurant-lite' ),
  )));

  // Related Post Settings
  $wp_customize->add_section( 'vw_restaurant_lite_related_posts_settings', array(
    'title' => __( 'Related Posts Settings', 'vw-restaurant-lite' ),
    'panel' => 'blog_post_parent_panel',
  ));

  //Selective Refresh
  $wp_customize->selective_refresh->add_partial('vw_restaurant_lite_related_post_title', array( 
    'selector' => '.related-post h3', 
    'render_callback' => 'vw_restaurant_lite_customize_partial_vw_restaurant_lite_related_post_title', 
  ));

  $wp_customize->add_setting( 'vw_restaurant_lite_related_post',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
    ) );
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_related_post',array(
    'label' => esc_html__( 'Related Post','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_related_posts_settings'
    )));

  $wp_customize->add_setting('vw_restaurant_lite_related_post_title',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_related_post_title',array(
    'label' => __('Add Related Post Title','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( 'Related Post', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_related_posts_settings',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('vw_restaurant_lite_related_posts_count',array(
    'default'=> '3',
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_float'
  ));
  $wp_customize->add_control('vw_restaurant_lite_related_posts_count',array(
    'label' => __('Add Related Post Count','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( '3', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_related_posts_settings',
    'type'=> 'number'
  ));

  // Single Posts Settings
  $wp_customize->add_section( 'vw_restaurant_lite_single_blog_settings', array(
    'title' => __( 'Single Post Settings', 'vw-restaurant-lite' ),
    'panel' => 'blog_post_parent_panel',
  ));

  $wp_customize->add_setting( 'vw_restaurant_lite_single_blog_post_navigation_show_hide',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_single_blog_post_navigation_show_hide', array(
  'label' => esc_html__( 'Post Navigation','vw-restaurant-lite' ),
  'section' => 'vw_restaurant_lite_single_blog_settings'
  )));

  //navigation text
  $wp_customize->add_setting('vw_restaurant_lite_single_blog_prev_navigation_text',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_single_blog_prev_navigation_text',array(
    'label' => __('Post Navigation Text','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( 'PREVIOUS PAGE', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_single_blog_settings',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('vw_restaurant_lite_single_blog_next_navigation_text',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_single_blog_next_navigation_text',array(
    'label' => __('Post Navigation Text','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( 'NEXT PAGE', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_single_blog_settings',
    'type'=> 'text'
  ));

  //404 Page Setting
	$wp_customize->add_section('vw_restaurant_lite_404_page',array(
		'title'	=> __('404 Page Settings','vw-restaurant-lite'),
		'panel' => 'vw_restaurant_lite_panel_id',
	));	

	$wp_customize->add_setting('vw_restaurant_lite_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_restaurant_lite_404_page_title',array(
		'label'	=> __('Add Title','vw-restaurant-lite'),
		'input_attrs' => array(
      'placeholder' => __( '404 Not Found', 'vw-restaurant-lite' ),
    ),
		'section'=> 'vw_restaurant_lite_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_restaurant_lite_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_restaurant_lite_404_page_content',array(
		'label'	=> __('Add Text','vw-restaurant-lite'),
		'input_attrs' => array(
      'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-restaurant-lite' ),
    ),
		'section'=> 'vw_restaurant_lite_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_restaurant_lite_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_restaurant_lite_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-restaurant-lite'),
		'input_attrs' => array(
      'placeholder' => __( 'Return to Home Page', 'vw-restaurant-lite' ),
    ),
		'section'=> 'vw_restaurant_lite_404_page',
		'type'=> 'text'
	));

  //Social Icon Setting
  $wp_customize->add_section('vw_restaurant_lite_social_icon_settings',array(
    'title' => __('Social Icons Settings','vw-restaurant-lite'),
    'panel' => 'vw_restaurant_lite_panel_id',
  )); 

  $wp_customize->add_setting('vw_restaurant_lite_social_icon_font_size',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_social_icon_font_size',array(
    'label' => __('Icon Font Size','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-restaurant-lite' ),
        ),
    'section'=> 'vw_restaurant_lite_social_icon_settings',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('vw_restaurant_lite_social_icon_padding',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_social_icon_padding',array(
    'label' => __('Icon Padding','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-restaurant-lite' ),
        ),
    'section'=> 'vw_restaurant_lite_social_icon_settings',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('vw_restaurant_lite_social_icon_width',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_social_icon_width',array(
    'label' => __('Icon Width','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-restaurant-lite' ),
        ),
    'section'=> 'vw_restaurant_lite_social_icon_settings',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('vw_restaurant_lite_social_icon_height',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_social_icon_height',array(
    'label' => __('Icon Height','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-restaurant-lite' ),
        ),
    'section'=> 'vw_restaurant_lite_social_icon_settings',
    'type'=> 'text'
  ));

  $wp_customize->add_setting( 'vw_restaurant_lite_social_icon_border_radius', array(
    'default'              => '',
    'transport'        => 'refresh',
    'sanitize_callback'    => 'vw_restaurant_lite_sanitize_number_range'
  ) );
  $wp_customize->add_control( 'vw_restaurant_lite_social_icon_border_radius', array(
    'label'       => esc_html__( 'Icon Hover Border Radius','vw-restaurant-lite' ),
    'section'     => 'vw_restaurant_lite_social_icon_settings',
    'type'        => 'range',
    'input_attrs' => array(
      'step'             => 1,
      'min'              => 1,
      'max'              => 50,
    ),
  ) );

	//Responsive Media Settings
	$wp_customize->add_section('vw_restaurant_lite_responsive_media',array(
		'title'	=> __('Responsive Media','vw-restaurant-lite'),
		'panel' => 'vw_restaurant_lite_panel_id',
	));

	$wp_customize->add_setting( 'vw_restaurant_lite_resp_topbar_hide_show',array(
    'default' => 0,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));  
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_resp_topbar_hide_show',array(
    'label' => esc_html__( 'Show / Hide Topbar','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_responsive_media'
  )));

  $wp_customize->add_setting( 'vw_restaurant_lite_stickyheader_hide_show',array(
    'default' => 0,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));  
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_stickyheader_hide_show',array(
    'label' => esc_html__( 'Sticky Header','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_responsive_media'
  )));

  $wp_customize->add_setting( 'vw_restaurant_lite_resp_slider_hide_show',array(
    'default' => 0,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));  
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_resp_slider_hide_show',array(
    'label' => esc_html__( 'Show / Hide Slider','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_responsive_media'
  )));

	$wp_customize->add_setting( 'vw_restaurant_lite_metabox_hide_show',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));  
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_metabox_hide_show',array(
    'label' => esc_html__( 'Show / Hide Metabox','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_responsive_media'
  )));

  $wp_customize->add_setting( 'vw_restaurant_lite_sidebar_hide_show',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));  
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_sidebar_hide_show',array(
    'label' => esc_html__( 'Show / Hide Sidebar','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_responsive_media'
  )));

  $wp_customize->add_setting( 'vw_restaurant_lite_resp_scroll_top_hide_show',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));  
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_resp_scroll_top_hide_show',array(
    'label' => esc_html__( 'Show / Hide Scroll To Top','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_responsive_media'
  )));

  $wp_customize->add_setting('vw_restaurant_lite_res_menu_open_icon',array(
    'default' => 'fas fa-bars',
    'sanitize_callback' => 'sanitize_text_field'
  )); 
  $wp_customize->add_control(new VW_Restaurant_Lite_Fontawesome_Icon_Chooser($wp_customize,'vw_restaurant_lite_res_menu_open_icon',array(
    'label' => __('Add Open Menu Icon','vw-restaurant-lite'),
    'transport' => 'refresh',
    'section' => 'vw_restaurant_lite_responsive_media',
    'setting' => 'vw_restaurant_lite_res_menu_open_icon',
    'type'    => 'icon'
  )));

  $wp_customize->add_setting('vw_restaurant_lite_res_close_menu_icon',array(
    'default' => 'fas fa-times',
    'sanitize_callback' => 'sanitize_text_field'
  )); 
  $wp_customize->add_control(new VW_Restaurant_Lite_Fontawesome_Icon_Chooser($wp_customize,'vw_restaurant_lite_res_close_menu_icon',array(
    'label' => __('Add Close Menu Icon','vw-restaurant-lite'),
    'transport' => 'refresh',
    'section' => 'vw_restaurant_lite_responsive_media',
    'setting' => 'vw_restaurant_lite_res_close_menu_icon',
    'type'    => 'icon'
  )));

	//Content Creation
	$wp_customize->add_section( 'vw_restaurant_lite_content_section' , array(
  	'title' => __( 'Customize Home Page Settings', 'vw-restaurant-lite' ),
		'priority' => null,
		'panel' => 'vw_restaurant_lite_panel_id'
	) );

	$wp_customize->add_setting('vw_restaurant_lite_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new VW_Restaurant_Lite_Content_Creation( $wp_customize, 'vw_restaurant_lite_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-restaurant-lite' ),
		),
		'section' => 'vw_restaurant_lite_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-restaurant-lite' ),
	) ) );

	//footer text
	$wp_customize->add_section('vw_restaurant_lite_footer_section',array(
		'title'	=> __('Footer Text','vw-restaurant-lite'),
		'description'	=> __('Add some text for footer like copyright etc.','vw-restaurant-lite'),
		'panel' => 'vw_restaurant_lite_panel_id'
	));

  //Selective Refresh
  $wp_customize->selective_refresh->add_partial('vw_restaurant_lite_footer_copy', array( 
    'selector' => '.copyright p', 
    'render_callback' => 'vw_restaurant_lite_customize_partial_vw_restaurant_lite_footer_copy', 
  ));
	
	$wp_customize->add_setting('vw_restaurant_lite_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('vw_restaurant_lite_footer_copy',array(
		'label'	=> __('Copyright Text','vw-restaurant-lite'),
		'section'	=> 'vw_restaurant_lite_footer_section',
		'type'		=> 'text'
	));

  $wp_customize->add_setting('vw_restaurant_lite_copyright_alingment',array(
    'default' => __('center','vw-restaurant-lite'),
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'
  ));
  $wp_customize->add_control(new VW_Restaurant_Lite_Image_Radio_Control($wp_customize, 'vw_restaurant_lite_copyright_alingment', array(
    'type' => 'select',
    'label' => __('Copyright Alignment','vw-restaurant-lite'),
    'section' => 'vw_restaurant_lite_footer_section',
    'settings' => 'vw_restaurant_lite_copyright_alingment',
    'choices' => array(
      'left' => get_template_directory_uri().'/images/copyright1.png',
      'center' => get_template_directory_uri().'/images/copyright2.png',
      'right' => get_template_directory_uri().'/images/copyright3.png'
  ))));

  $wp_customize->add_setting('vw_restaurant_lite_copyright_padding_top_bottom',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_copyright_padding_top_bottom',array(
    'label' => __('Copyright Padding Top Bottom','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_footer_section',
    'type'=> 'text'
  ));

	$wp_customize->add_setting( 'vw_restaurant_lite_hide_show_scroll',array(
  	'default' => 1,
  	'transport' => 'refresh',
  	'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
  ));  
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_hide_show_scroll',array(
  	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-restaurant-lite' ),
  	'section' => 'vw_restaurant_lite_footer_section'
  )));

  //Selective Refresh
  $wp_customize->selective_refresh->add_partial('vw_restaurant_lite_scroll_top_icon', array( 
    'selector' => '.scrollup i', 
    'render_callback' => 'vw_restaurant_lite_customize_partial_vw_restaurant_lite_scroll_top_icon', 
  ));

  $wp_customize->add_setting('vw_restaurant_lite_scroll_top_icon',array(
    'default' => 'fas fa-angle-up',
    'sanitize_callback' => 'sanitize_text_field'
  )); 
  $wp_customize->add_control(new VW_Restaurant_Lite_Fontawesome_Icon_Chooser($wp_customize,'vw_restaurant_lite_scroll_top_icon',array(
    'label' => __('Add Scroll to Top Icon','vw-restaurant-lite'),
    'transport' => 'refresh',
    'section' => 'vw_restaurant_lite_footer_section',
    'setting' => 'vw_restaurant_lite_scroll_top_icon',
    'type'    => 'icon'
  )));

  $wp_customize->add_setting('vw_restaurant_lite_scroll_to_top_font_size',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_scroll_to_top_font_size',array(
    'label' => __('Icon Font Size','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_footer_section',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('vw_restaurant_lite_scroll_to_top_padding',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_scroll_to_top_padding',array(
    'label' => __('Icon Top Bottom Padding','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_footer_section',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('vw_restaurant_lite_scroll_to_top_width',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_scroll_to_top_width',array(
    'label' => __('Icon Width','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_footer_section',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('vw_restaurant_lite_scroll_to_top_height',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_scroll_to_top_height',array(
    'label' => __('Icon Height','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_footer_section',
    'type'=> 'text'
  ));

  $wp_customize->add_setting( 'vw_restaurant_lite_scroll_to_top_border_radius', array(
    'default'              => '',
    'transport'        => 'refresh',
    'sanitize_callback'    => 'vw_restaurant_lite_sanitize_number_range'
  ) );
  $wp_customize->add_control( 'vw_restaurant_lite_scroll_to_top_border_radius', array(
    'label'       => esc_html__( 'Icon Border Radius','vw-restaurant-lite' ),
    'section'     => 'vw_restaurant_lite_footer_section',
    'type'        => 'range',
    'input_attrs' => array(
      'step'             => 1,
      'min'              => 1,
      'max'              => 50,
    ),
  ) );

	$wp_customize->add_setting('vw_restaurant_lite_scroll_top_alignment',array(
    'default' => __('Right','vw-restaurant-lite'),
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Restaurant_Lite_Image_Radio_Control($wp_customize, 'vw_restaurant_lite_scroll_top_alignment', array(
    'type' => 'select',
    'label' => __('Scroll To Top','vw-restaurant-lite'),
    'section' => 'vw_restaurant_lite_footer_section',
    'settings' => 'vw_restaurant_lite_scroll_top_alignment',
    'choices' => array(
      'Left' => get_template_directory_uri().'/images/layout1.png',
      'Center' => get_template_directory_uri().'/images/layout2.png',
      'Right' => get_template_directory_uri().'/images/layout3.png'
  ))));

  //Woocommerce settings
  $wp_customize->add_section('vw_restaurant_lite_woocommerce_section', array(
    'title'    => __('WooCommerce Layout', 'vw-restaurant-lite'),
    'priority' => null,
    'panel'    => 'woocommerce',
  ));

  //Woocommerce Shop Page Sidebar
  $wp_customize->add_setting( 'vw_restaurant_lite_woocommerce_shop_page_sidebar',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
    ) );
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_woocommerce_shop_page_sidebar',array(
    'label' => esc_html__( 'Shop Page Sidebar','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_woocommerce_section'
  )));

  //Woocommerce Single Product page Sidebar
  $wp_customize->add_setting( 'vw_restaurant_lite_woocommerce_single_product_page_sidebar',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_switch_sanitization'
    ) );
  $wp_customize->add_control( new VW_Restaurant_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'vw_restaurant_lite_woocommerce_single_product_page_sidebar',array(
    'label' => esc_html__( 'Single Product Sidebar','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_woocommerce_section'
  )));

  //Products per page
  $wp_customize->add_setting('vw_restaurant_lite_products_per_page',array(
    'default'=> '9',
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_float'
  ));
  $wp_customize->add_control('vw_restaurant_lite_products_per_page',array(
    'label' => __('Products Per Page','vw-restaurant-lite'),
    'description' => __('Display on shop page','vw-restaurant-lite'),
    'input_attrs' => array(
      'step'             => 1,
      'min'              => 0,
      'max'              => 50,
    ),
    'section'=> 'vw_restaurant_lite_woocommerce_section',
    'type'=> 'number',
  ));

    //Products per row
  $wp_customize->add_setting('vw_restaurant_lite_products_per_row',array(
    'default'=> '3',
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_choices'
  ));
  $wp_customize->add_control('vw_restaurant_lite_products_per_row',array(
    'label' => __('Products Per Row','vw-restaurant-lite'),
    'description' => __('Display on shop page','vw-restaurant-lite'),
    'choices' => array(
      '2' => '2',
      '3' => '3',
      '4' => '4',
    ),
    'section'=> 'vw_restaurant_lite_woocommerce_section',
    'type'=> 'select',
  ));

  //Products padding
  $wp_customize->add_setting('vw_restaurant_lite_products_padding_top_bottom',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_products_padding_top_bottom',array(
    'label' => __('Products Padding Top Bottom','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-restaurant-lite' ),
    ),
    'section'=> 'vw_restaurant_lite_woocommerce_section',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('vw_restaurant_lite_products_padding_left_right',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('vw_restaurant_lite_products_padding_left_right',array(
    'label' => __('Products Padding Left Right','vw-restaurant-lite'),
    'description' => __('Enter a value in pixels. Example:20px','vw-restaurant-lite'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-restaurant-lite' ),
      ),
    'section'=> 'vw_restaurant_lite_woocommerce_section',
    'type'=> 'text'
  ));

  //Products box shadow
  $wp_customize->add_setting( 'vw_restaurant_lite_products_box_shadow', array(
    'default' => '',
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_number_range'
  ) );
  $wp_customize->add_control( 'vw_restaurant_lite_products_box_shadow', array(
    'label' => esc_html__( 'Products Box Shadow','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_woocommerce_section',
    'type'  => 'range',
    'input_attrs' => array(
      'step' => 1,
      'min'  => 1,
      'max'  => 50,
    ),
  ) );

  //Products border radius
    $wp_customize->add_setting( 'vw_restaurant_lite_products_border_radius', array(
    'default' => '',
    'transport' => 'refresh',
    'sanitize_callback' => 'vw_restaurant_lite_sanitize_number_range'
  ) );
  $wp_customize->add_control( 'vw_restaurant_lite_products_border_radius', array(
    'label' => esc_html__( 'Products Border Radius','vw-restaurant-lite' ),
    'section' => 'vw_restaurant_lite_woocommerce_section',
    'type' => 'range',
    'input_attrs' => array(
      'step' => 1,
      'min'  => 1,
      'max'  => 50,
    ),
  ) );

  // Has to be at the top
  $wp_customize->register_panel_type( 'VW_Restaurant_Lite_WP_Customize_Panel' );
  $wp_customize->register_section_type( 'VW_Restaurant_Lite_WP_Customize_Section' );
	
}
add_action( 'customize_register', 'vw_restaurant_lite_customize_register' );	

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  class VW_Restaurant_Lite_WP_Customize_Panel extends WP_Customize_Panel {
    public $panel;
    public $type = 'vw_restaurant_lite_panel';
    public function json() {

      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
      $array['content'] = $this->get_content();
      $array['active'] = $this->active();
      $array['instanceNumber'] = $this->instance_number;
      return $array;
    }
  }
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  class VW_Restaurant_Lite_WP_Customize_Section extends WP_Customize_Section {
    public $section;
    public $type = 'vw_restaurant_lite_section';
    public function json() {

      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
      $array['content'] = $this->get_content();
      $array['active'] = $this->active();
      $array['instanceNumber'] = $this->instance_number;

      if ( $this->panel ) {
        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
      } else {
        $array['customizeAction'] = 'Customizing';
      }
      return $array;
    }
  }
}

// Enqueue our scripts and styles
function vw_restaurant_lite_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'vw_restaurant_lite_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Restaurant_Lite_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Restaurant_Lite_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(new VW_Restaurant_Lite_Customize_Section_Pro($manager,'example_1',array(
			'priority'   => 1,
			'title'    => esc_html__( 'VW Restaurant Pro', 'vw-restaurant-lite' ),
			'pro_text' => esc_html__( 'UPGRADE PRO','vw-restaurant-lite' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/food-restaurant-wordpress-theme/')
		)));

		// Register sections.
		$manager->add_section(new VW_Restaurant_Lite_Customize_Section_Pro($manager,'example_2',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENATATION', 'vw-restaurant-lite' ),
			'pro_text' => esc_html__( 'DOCS', 'vw-restaurant-lite' ),
			'pro_url'  => esc_url( 'themes.php?page=vw_restaurant_lite_guide' )
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-restaurant-lite-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-restaurant-lite-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Restaurant_Lite_Customize::get_instance();