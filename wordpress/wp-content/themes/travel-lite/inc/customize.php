<?php

function travel_customize_register($wp_customize){

    
    $wp_customize->add_section('travel_options', array(
        'priority' 		=> 10,
		'capability'     => 'edit_theme_options',
		'title'    		=> __('TRAVEL OPTIONS', 'travel-lite'),
        'description'   => '<div class="infohead">A Theme is an effort of many sleepless nights of Developers. You can contribute on this development translating this theme in your Language. You can send your translation/language file to us. For any kind of Theme Support, Please do not hesitate to <a target="_blank" href="'. esc_url('https://d5creation.com/contact').'">Contact Us</a> anytime<br><br>
    
We appreciate an <a target="_blank" href="'. esc_url('http://wordpress.org/support/view/theme-reviews/travel-lite').'">Honest Review</a> of this Theme if you Love our Work<br> <br>

Need More Features and Options including Exciting Slide and 100+ Advanced Features? Try <a target="_blank" href="'. esc_url('https://d5creation.com/theme/travel/').'"><strong>Travel Extend</strong></a><br> <br> 
        
        
You can Visit the Travel Extend <a target="_blank" href="'. esc_url('http://demo.d5creation.com/themes/?theme=Travel').'"><strong>Demo Here</strong></a> 

        </div>		
		'
    ));
	
//  Responsive Layout
    $wp_customize->add_setting('travel[responsive]', array(
        'default'        	=> '1',
    	'sanitize_callback' => 'esc_html',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_responsive', array(
        'label'      => __('Use Responsive Layout', 'travel-lite'),
        'section'    => 'travel_options',
        'settings'   => 'travel[responsive]',
		'description' => __('Check the Box if you want the Responsive Layout of your Website','travel-lite'),
		'type' 		 => 'checkbox'
    ));


	$fposttype = array( '1' => __('Do not Show any Post or Page in the Front Page', 'travel-lite'), '2' => __('Show Posts or Page in the Front Page as Per WordPress Reading Settings','travel-lite') );
	
//  Front Page Post
    $wp_customize->add_setting('travel[fpostex]', array(
        'default'        	=> '2',
    	'sanitize_callback' => 'esc_html',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_fpostex', array(
        'label'      => __('Front Page Post/Page Visibility', 'travel-lite'),
        'section'    => 'travel_options',
        'settings'   => 'travel[fpostex]',
		'description' => __('Select Option how you want to show or do not show Posts/Pages in the Front Page','travel-lite'),
		'type' 		 => 'radio',
		'choices' 	=> $fposttype
    ));
	
	
	// Common Featured Box Image
    $wp_customize->add_setting('travel[ft-back]', array(
        'default'        	=> get_template_directory_uri() . '/images/thumb-back.jpg',
        'capability'     	=> 'edit_theme_options',
    	'sanitize_callback' => 'esc_url',
        'type'           	=> 'option'

    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'ft-back' , array(
        'label'      	=> __('Post Featured Image Background', 'travel-lite'),
        'section'    	=> 'travel_options',
        'settings'   	=> 'travel[ft-back]',
		'description'  	=> __('Upload an image for the Common Background of Featured/ Thumbnail Image on every Post. 600px X 200px image is recommended','travel-lite')
    )));
	

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

 $wp_customize->add_section('travel_heading', array(
        'priority' 		=> 11,
		'capability'     => 'edit_theme_options',
		'title'    		=> __('&nbsp;&nbsp;&nbsp;&nbsp; - Front Page Heading', 'travel-lite'),
        'description'   => ''
    ));
	
	
// Front Page Heading
    $wp_customize->add_setting('travel[fpheading]', array(
        'default'        	=> '',
        'capability'     	=> 'edit_theme_options',
    	'sanitize_callback' => 'esc_textarea',
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_fpheading' , array(
        'label'      => __('Front Page Heading', 'travel-lite'),
        'section'    => 'travel_heading',
        'settings'   => 'travel[fpheading]'
    ));
	
	
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

 $wp_customize->add_section('travel_social', array(
        'priority' 		=> 12,
		'capability'    => 'edit_theme_options',
		'title'    		=> __('&nbsp;&nbsp;&nbsp;&nbsp; - Social Links', 'travel-lite'),
        'description'   => ''
    ));
	
//  Facebook Link
    $wp_customize->add_setting('travel[facebook-link]', array(
        'default'        	=> '',
    	'sanitize_callback' => 'esc_url',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_facebook-link', array(
        'label'      => __('Facebook Link', 'travel-lite'),
        'section'    => 'travel_social',
        'settings'   => 'travel[facebook-link]'
    ));
	
//  Twitter Link
    $wp_customize->add_setting('travel[twitter-link]', array(
        'default'        	=> '',
    	'sanitize_callback' => 'esc_url',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_twitter-link', array(
        'label'      => __('Twitter Link', 'travel-lite'),
        'section'    => 'travel_social',
        'settings'   => 'travel[twitter-link]'
    ));

//  Google Plus Link
    $wp_customize->add_setting('travel[gplus-link]', array(
        'default'        	=> '',
    	'sanitize_callback' => 'esc_url',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_gplus-link', array(
        'label'      => __('Google Plus Link', 'travel-lite'),
        'section'    => 'travel_social',
        'settings'   => 'travel[gplus-link]'
    ));
	
//  My Contact Link
    $wp_customize->add_setting('travel[con-link]', array(
        'default'        	=> '',
    	'sanitize_callback' => 'esc_url',
        'capability'     	=> 'edit_theme_options',
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_con-link', array(
        'label'      => __('My Contact Link', 'travel-lite'),
        'section'    => 'travel_social',
        'settings'   => 'travel[con-link]'
    ));

  
 // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

 $wp_customize->add_section('travel_fbox', array(
        'priority' 		=> 13,
		'capability'     => 'edit_theme_options',
		'title'    		=> __('&nbsp;&nbsp;&nbsp;&nbsp; - Featured Boxes', 'travel-lite'),
        'description'   => ''
    ));

 	  
// Front Page Fearured Images
	foreach (range(1,3) as $fbsinumber) {
	  
//  Featured Image
    $wp_customize->add_setting('travel[featured-image'. $fbsinumber .']', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'esc_url',
        'type'           	=> 'option'
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'featured-image'. $fbsinumber, array(
        'label'    			=> __('Featured Image', 'travel-lite') . '-' . $fbsinumber,
        'section'  			=> 'travel_fbox',
        'settings' 			=> 'travel[featured-image'. $fbsinumber .']',
		'description'   	=> __('Upload an image for the Featured Box. 400px X 300px image is recommended','travel-lite')
    )));
  
// Featured Image Title
    $wp_customize->add_setting('travel[featured01-title' . $fbsinumber . ']', array(
        'default'        	=> '',
        'capability'     	=> 'edit_theme_options',
    	'sanitize_callback' => 'esc_textarea',
		'description' 		=> __('Input the First Part of Featured Title here. Please limit it within 10 Letters','travel-lite'),
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_featured01-title' . $fbsinumber, array(
        'label'      => __('Featured Title First Part', 'travel-lite'). '-' . $fbsinumber,
        'section'    => 'travel_fbox',
        'settings'   => 'travel[featured01-title' . $fbsinumber .']'
    ));
	
    $wp_customize->add_setting('travel[featured02-title' . $fbsinumber . ']', array(
        'default'        	=> '',
        'capability'     	=> 'edit_theme_options',
    	'sanitize_callback' => 'esc_textarea',
		'description' 		=> __('Input the Second Part of Featured Title here. Please limit it within 10 Letters','travel-lite'),
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_featured02-title' . $fbsinumber, array(
        'label'      => __('Featured Title Second Part', 'travel-lite'). '-' . $fbsinumber,
        'section'    => 'travel_fbox',
        'settings'   => 'travel[featured02-title' . $fbsinumber .']'
    ));

	$wp_customize->add_setting('travel[featured-description' . $fbsinumber . ']', array(
        'default'        	=> '',
        'capability'     	=> 'edit_theme_options',
    	'sanitize_callback' => 'wp_kses_post',
		'description' 		=> __('Input the description','travel-lite'),
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_featured-description' . $fbsinumber, array(
        'label'      => __('Description', 'travel-lite'). '-' . $fbsinumber,
        'section'    => 'travel_fbox',
        'settings'   => 'travel[featured-description' . $fbsinumber .']',
		'type' 		 => 'textarea'
    ));
	
	$wp_customize->add_setting('travel[featured-link' . $fbsinumber . ']', array(
        'default'        	=> '',
        'capability'     	=> 'edit_theme_options',
    	'sanitize_callback' => 'esc_url',
		'description' 		=> __('Input the Link URL','travel-lite'),
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_featured-link' . $fbsinumber, array(
        'label'      => __('Link URL', 'travel-lite'). '-' . $fbsinumber,
        'section'    => 'travel_fbox',
        'settings'   => 'travel[featured-link' . $fbsinumber .']'
    ));

  }
  
  
  // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

 $wp_customize->add_section('travel_fc', array(
        'priority' 		=> 14,
		'capability'     => 'edit_theme_options',
		'title'    		=> __('&nbsp;&nbsp;&nbsp;&nbsp; - Featured Contents', 'travel-lite'),
        'description'   => ''
    ));

// Front Page Fearured Contents
	foreach (range(1,3) as $fbsinumberd) {
	  
//  Featured Image
    $wp_customize->add_setting('travel[fcontent-image'. $fbsinumberd .']', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'esc_url',
        'type'           	=> 'option'
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'fcontent-image'. $fbsinumberd, array(
        'label'    			=> __('Featured Content Image', 'travel-lite') . '-' . $fbsinumberd,
        'section'  			=> 'travel_fc',
        'settings' 			=> 'travel[fcontent-image'. $fbsinumberd .']',
		'description'   	=> __('Upload an image for the Featured Box. 400px X 300px image is recommended','travel-lite')
    )));
  
// Featured Image Title
    $wp_customize->add_setting('travel[fcontent01-title' . $fbsinumberd . ']', array(
        'default'        	=> '',
        'capability'     	=> 'edit_theme_options',
    	'sanitize_callback' => 'esc_textarea',
		'description' 		=> __('Input the First Part of Featured Title here. Please limit it within 10 Letters','travel-lite'),
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_fcontent01-title' . $fbsinumberd, array(
        'label'      => __('Featured Title First Part', 'travel-lite'). '-' . $fbsinumberd,
        'section'    => 'travel_fc',
        'settings'   => 'travel[fcontent01-title' . $fbsinumberd .']'
    ));
	
    $wp_customize->add_setting('travel[fcontent02-title' . $fbsinumberd . ']', array(
        'default'        	=> '',
        'capability'     	=> 'edit_theme_options',
    	'sanitize_callback' => 'esc_textarea',
		'description' 		=> __('Input the Second Part of Featured Title here. Please limit it within 10 Letters','travel-lite'),
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_fcontent02-title' . $fbsinumberd, array(
        'label'      => __('Featured Title Second Part', 'travel-lite'). '-' . $fbsinumberd,
        'section'    => 'travel_fc',
        'settings'   => 'travel[fcontent02-title' . $fbsinumberd .']'
    ));

	$wp_customize->add_setting('travel[fcontent-description' . $fbsinumberd . ']', array(
        'default'        	=> '',
        'capability'     	=> 'edit_theme_options',
    	'sanitize_callback' => 'wp_kses_post',
		'description' 		=> __('Input the description','travel-lite'),
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_fcontent-description' . $fbsinumberd, array(
        'label'      => __('Description', 'travel-lite'). '-' . $fbsinumberd,
        'section'    => 'travel_fc',
        'settings'   => 'travel[fcontent-description' . $fbsinumberd .']',
		'type' 		 => 'textarea'
    ));
	
	$wp_customize->add_setting('travel[fcontent-link' . $fbsinumberd . ']', array(
        'default'        	=> '',
        'capability'     	=> 'edit_theme_options',
    	'sanitize_callback' => 'esc_textarea',
		'description' 		=> __('Input the Link URL','travel-lite'),
        'type'           	=> 'option'

    ));

    $wp_customize->add_control('travel_fcontent-link' . $fbsinumberd, array(
        'label'      => __('Link URL', 'travel-lite'). '-' . $fbsinumberd,
        'section'    => 'travel_fc',
        'settings'   => 'travel[fcontent-link' . $fbsinumberd .']'
    ));

  }


}


add_action('customize_register', 'travel_customize_register');


	if ( ! function_exists( 'travel_get_option' ) ) :
	function travel_get_option( $travel_name, $travel_default = false ) {
	$travel_config = get_option( 'travel' );

	if ( ! isset( $travel_config ) ) : return $travel_default; else: $travel_options = $travel_config; endif;
	if ( isset( $travel_options[$travel_name] ) ):  return $travel_options[$travel_name]; else: return $travel_default; endif;
	}
	endif;