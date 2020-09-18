<?php    
/**
 *cafeteria-lite Theme Customizer
 *
 * @package Cafeteria Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cafeteria_lite_customize_register( $wp_customize ) {	
	
	function cafeteria_lite_sanitize_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );
	
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function cafeteria_lite_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	} 
	
	function cafeteria_lite_sanitize_phone_number( $phone ) {
		// sanitize phone
		return preg_replace( '/[^\d+]/', '', $phone );
	} 
		
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	 //Panel for section & control
	$wp_customize->add_panel( 'cafeteria_lite_panel_section', array(
		'priority' => null,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options Panel', 'cafeteria-lite' ),		
	) );
	
	//Site Layout Options
	$wp_customize->add_section('cafeteria_lite_layout_option',array(
		'title' => __('Site Layout Options','cafeteria-lite'),			
		'priority' => 1,
		'panel' => 	'cafeteria_lite_panel_section',          
	));		
	
	$wp_customize->add_setting('cafeteria_lite_site_layout_options',array(
		'sanitize_callback' => 'cafeteria_lite_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'cafeteria_lite_site_layout_options', array(
    	'section'   => 'cafeteria_lite_layout_option',    	 
		'label' => __('Check to Show Box Layout','cafeteria-lite'),
		'description' => __('If you want to show box layout please check the Box Layout Option.','cafeteria-lite'),
    	'type'      => 'checkbox'
     )); //Site Layout Options 
	
	$wp_customize->add_setting('cafeteria_lite_site_color_codes',array(
		'default' => '#ff8400',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'cafeteria_lite_site_color_codes',array(
			'label' => __('Color Options','cafeteria-lite'),			
			'description' => __('More color options available in PRO Version','cafeteria-lite'),
			'section' => 'colors',
			'settings' => 'cafeteria_lite_site_color_codes'
		))
	);
	
	$wp_customize->add_setting('cafeteria_lite_site_hovercolor_codes',array(
		'default' => '#ffba00',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'cafeteria_lite_site_hovercolor_codes',array(
			'label' => __('Hover Color Options','cafeteria-lite'),			
			'description' => __('More color options in PRO Version','cafeteria-lite'),
			'section' => 'colors',
			'settings' => 'cafeteria_lite_site_hovercolor_codes'
		))
	);		
	
	//Header Contact info section
	$wp_customize->add_section('cafeteria_lite_hdrcontact_sections',array(
		'title' => __('Header Contact Sections','cafeteria-lite'),				
		'priority' => null,
		'panel' => 	'cafeteria_lite_panel_section',
	));	
	
	$wp_customize->add_setting('cafeteria_lite_header_address',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	
	$wp_customize->add_control('cafeteria_lite_header_address',array(
		'type' => 'text',
		'label' => __('enter contact address here.','cafeteria-lite'),
		'section' => 'cafeteria_lite_hdrcontact_sections'
	));	
	
	$wp_customize->add_setting('cafeteria_lite_header_phoneno',array(
		'default' => null,
		'sanitize_callback' => 'cafeteria_lite_sanitize_phone_number'	
	));
	
	$wp_customize->add_control('cafeteria_lite_header_phoneno',array(	
		'type' => 'text',
		'label' => __('enter phone number here','cafeteria-lite'),
		'section' => 'cafeteria_lite_hdrcontact_sections',
		'setting' => 'cafeteria_lite_header_phoneno'
	));		
	
	$wp_customize->add_setting('cafeteria_lite_show_hdrcontact_sections',array(
		'default' => false,
		'sanitize_callback' => 'cafeteria_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'cafeteria_lite_show_hdrcontact_sections', array(
	   'settings' => 'cafeteria_lite_show_hdrcontact_sections',
	   'section'   => 'cafeteria_lite_hdrcontact_sections',
	   'label'     => __('Check To show This Section','cafeteria-lite'),
	   'type'      => 'checkbox'
	 ));//Show Header Contact section
	 
	 
	 //Header Social icons
	$wp_customize->add_section('cafeteria_lite_hdrsocial_sections',array(
		'title' => __('Header social Sections','cafeteria-lite'),
		'description' => __( 'Add social icons link here to display icons in header.', 'cafeteria-lite' ),			
		'priority' => null,
		'panel' => 	'cafeteria_lite_panel_section', 
	));
	
	$wp_customize->add_setting('cafeteria_lite_facebook_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'	
	));
	
	$wp_customize->add_control('cafeteria_lite_facebook_link',array(
		'label' => __('Add facebook link here','cafeteria-lite'),
		'section' => 'cafeteria_lite_hdrsocial_sections',
		'setting' => 'cafeteria_lite_facebook_link'
	));	
	
	$wp_customize->add_setting('cafeteria_lite_twitter_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('cafeteria_lite_twitter_link',array(
		'label' => __('Add twitter link here','cafeteria-lite'),
		'section' => 'cafeteria_lite_hdrsocial_sections',
		'setting' => 'cafeteria_lite_twitter_link'
	));
	
	$wp_customize->add_setting('cafeteria_lite_googleplus_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('cafeteria_lite_googleplus_link',array(
		'label' => __('Add google plus link here','cafeteria-lite'),
		'section' => 'cafeteria_lite_hdrsocial_sections',
		'setting' => 'cafeteria_lite_googleplus_link'
	));
	
	$wp_customize->add_setting('cafeteria_lite_linkedin_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('cafeteria_lite_linkedin_link',array(
		'label' => __('Add linkedin link here','cafeteria-lite'),
		'section' => 'cafeteria_lite_hdrsocial_sections',
		'setting' => 'cafeteria_lite_linkedin_link'
	));
	
	$wp_customize->add_setting('cafeteria_lite_instagram_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('cafeteria_lite_instagram_link',array(
		'label' => __('Add instagram link here','cafeteria-lite'),
		'section' => 'cafeteria_lite_hdrsocial_sections',
		'setting' => 'cafeteria_lite_instagram_link'
	));
	
	$wp_customize->add_setting('cafeteria_lite_show_hdrsocial_sections',array(
		'default' => false,
		'sanitize_callback' => 'cafeteria_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'cafeteria_lite_show_hdrsocial_sections', array(
	   'settings' => 'cafeteria_lite_show_hdrsocial_sections',
	   'section'   => 'cafeteria_lite_hdrsocial_sections',
	   'label'     => __('Check To show This Section','cafeteria-lite'),
	   'type'      => 'checkbox'
	 ));//Show Header Social icons area
	
	
	// Header Slider Section		
	$wp_customize->add_section( 'cafeteria_lite_homesldr_section', array(
		'title' => __('Homepage Slider Sections', 'cafeteria-lite'),
		'priority' => null,
		'description' => __('Default image size for slider is 1400 x 860 pixel.','cafeteria-lite'), 
		'panel' => 	'cafeteria_lite_panel_section',           			
    ));
	
	$wp_customize->add_setting('cafeteria_lite_homesldrpage1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'cafeteria_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('cafeteria_lite_homesldrpage1',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider 1:','cafeteria-lite'),
		'section' => 'cafeteria_lite_homesldr_section'
	));	
	
	$wp_customize->add_setting('cafeteria_lite_homesldrpage2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'cafeteria_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('cafeteria_lite_homesldrpage2',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider 2:','cafeteria-lite'),
		'section' => 'cafeteria_lite_homesldr_section'
	));	
	
	$wp_customize->add_setting('cafeteria_lite_homesldrpage3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'cafeteria_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('cafeteria_lite_homesldrpage3',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider 3:','cafeteria-lite'),
		'section' => 'cafeteria_lite_homesldr_section'
	));	// Homepage Slider Section
	
	$wp_customize->add_setting('cafeteria_lite_homesldrmorebtn',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('cafeteria_lite_homesldrmorebtn',array(	
		'type' => 'text',
		'label' => __('enter slider Read more button name here','cafeteria-lite'),
		'section' => 'cafeteria_lite_homesldr_section',
		'setting' => 'cafeteria_lite_homesldrmorebtn'
	)); // Home Slider Read More Button Text
	
	$wp_customize->add_setting('cafeteria_lite_show_homesldr_section',array(
		'default' => false,
		'sanitize_callback' => 'cafeteria_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'cafeteria_lite_show_homesldr_section', array(
	    'settings' => 'cafeteria_lite_show_homesldr_section',
	    'section'   => 'cafeteria_lite_homesldr_section',
	     'label'     => __('Check To Show This Section','cafeteria-lite'),
	   'type'      => 'checkbox'
	 ));//Show Home Slider Section	
	 
	 
	 //Four circle column Section
	$wp_customize->add_section('cafeteria_lite_4columncircle_sections', array(
		'title' => __('Four circle column Section','cafeteria-lite'),
		'description' => __('Select pages from the dropdown for 4 column circle sections','cafeteria-lite'),
		'priority' => null,
		'panel' => 	'cafeteria_lite_panel_section',          
	));	
	
	
	$wp_customize->add_setting('cafeteria_lite_services_section_title',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('cafeteria_lite_services_section_title',array(	
		'type' => 'text',
		'label' => __('enter services section title here','cafeteria-lite'),
		'section' => 'cafeteria_lite_4columncircle_sections',
		'setting' => 'cafeteria_lite_services_section_title'
	)); //Services sections title
	
	
	$wp_customize->add_setting('cafeteria_lite_4column_circlebox1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'cafeteria_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'cafeteria_lite_4column_circlebox1',array(
		'type' => 'dropdown-pages',			
		'section' => 'cafeteria_lite_4columncircle_sections',
	));		
	
	$wp_customize->add_setting('cafeteria_lite_4column_circlebox2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'cafeteria_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'cafeteria_lite_4column_circlebox2',array(
		'type' => 'dropdown-pages',			
		'section' => 'cafeteria_lite_4columncircle_sections',
	));
	
	$wp_customize->add_setting('cafeteria_lite_4column_circlebox3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'cafeteria_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'cafeteria_lite_4column_circlebox3',array(
		'type' => 'dropdown-pages',			
		'section' => 'cafeteria_lite_4columncircle_sections',
	));
	
	$wp_customize->add_setting('cafeteria_lite_4column_circlebox4',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'cafeteria_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'cafeteria_lite_4column_circlebox4',array(
		'type' => 'dropdown-pages',			
		'section' => 'cafeteria_lite_4columncircle_sections',
	));	
	
	$wp_customize->add_setting('cafeteria_lite_show_4columncircle_sections',array(
		'default' => false,
		'sanitize_callback' => 'cafeteria_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'cafeteria_lite_show_4columncircle_sections', array(
	   'settings' => 'cafeteria_lite_show_4columncircle_sections',
	   'section'   => 'cafeteria_lite_4columncircle_sections',
	   'label'     => __('Check To Show This Section','cafeteria-lite'),
	   'type'      => 'checkbox'
	 ));//Show four box Services Area
	 
	 
	//Sidebar Settings
	$wp_customize->add_section('cafeteria_lite_sidebar_options', array(
		'title' => __('Sidebar Options','cafeteria-lite'),		
		'priority' => null,
		'panel' => 	'cafeteria_lite_panel_section',          
	));	
	
	$wp_customize->add_setting('cafeteria_lite_hidesidebar_from_homepage',array(
		'default' => false,
		'sanitize_callback' => 'cafeteria_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'cafeteria_lite_hidesidebar_from_homepage', array(
	   'settings' => 'cafeteria_lite_hidesidebar_from_homepage',
	   'section'   => 'cafeteria_lite_sidebar_options',
	   'label'     => __('Check to hide sidebar from latest post page','cafeteria-lite'),
	   'type'      => 'checkbox'
	 ));// Hide sidebar from latest post page
	 
	 
	 $wp_customize->add_setting('cafeteria_lite_hidesidebar_singlepost',array(
		'default' => false,
		'sanitize_callback' => 'cafeteria_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'cafeteria_lite_hidesidebar_singlepost', array(
	   'settings' => 'cafeteria_lite_hidesidebar_singlepost',
	   'section'   => 'cafeteria_lite_sidebar_options',
	   'label'     => __('Check to hide sidebar from single post','cafeteria-lite'),
	   'type'      => 'checkbox'
	 ));// hide sidebar single post	 

		 
}
add_action( 'customize_register', 'cafeteria_lite_customize_register' );

function cafeteria_lite_custom_css(){ 
?>
	<style type="text/css"> 					
        a, .listview_blogstyle h2 a:hover,
        #sidebar ul li a:hover,						
        .listview_blogstyle h3 a:hover,		
        .postmeta a:hover,
		.site-navigation .menu a:hover,
		.site-navigation .menu a:focus,
		.site-navigation .menu ul a:hover,
		.site-navigation .menu ul a:focus,
		.site-navigation ul li a:hover, 
		.site-navigation ul li.current-menu-item a,
		.site-navigation ul li.current-menu-parent a.parent,
		.site-navigation ul li.current-menu-item ul.sub-menu li a:hover, 			
        .button:hover,
		.nivo-caption h2 span,
		h2.services_title span,
		.fourcolbx:hover h3 a,		
		.blog_postmeta a:hover,		
		.site-footer ul li a:hover, 
		.site-footer ul li.current_page_item a		
            { color:<?php echo esc_html( get_theme_mod('cafeteria_lite_site_color_codes','#ff8400')); ?>;}					 
            
        .pagination ul li .current, .pagination ul li a:hover, 
        #commentform input#submit:hover,		
        .nivo-controlNav a.active,
		.sd-search input, .sd-top-bar-nav .sd-search input,			
		a.blogreadmore,			
		.nivo-caption .slide_morebtn,
		.learnmore:hover,
		.fourcolbx .thumbbx,
		.copyrigh-wrapper:before,
		.infobox a.get_an_enquiry:hover,									
        #sidebar .search-form input.search-submit,				
        .wpcf7 input[type='submit'],				
        nav.pagination .page-numbers.current,		
		.blogreadbtn:hover,		
        .toggle a	
            { background-color:<?php echo esc_html( get_theme_mod('cafeteria_lite_site_color_codes','#ff8400')); ?>;}
			
		
		.tagcloud a:hover,		
		.hdr_social a:hover,
		.site-footer h5::after,		
		h3.widget-title::after
            { border-color:<?php echo esc_html( get_theme_mod('cafeteria_lite_site_color_codes','#ff8400')); ?>;}
			
		 button:focus,
		input[type="button"]:focus,
		input[type="reset"]:focus,
		input[type="submit"]:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		textarea:focus,
		a:focus
            { outline:thin dotted <?php echo esc_html( get_theme_mod('cafeteria_lite_site_color_codes','#ff8400')); ?>;}				
	
    </style> 
<?php                                                                     
}
         
add_action('wp_head','cafeteria_lite_custom_css');	 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cafeteria_lite_customize_preview_js() {
	wp_enqueue_script( 'cafeteria_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '19062019', true );
}
add_action( 'customize_preview_init', 'cafeteria_lite_customize_preview_js' );