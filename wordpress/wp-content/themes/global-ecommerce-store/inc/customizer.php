<?php
/**
 * global ecommerce store Theme Customizer
 *
 * @package global_ecommerce_store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function global_ecommerce_store_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'global_ecommerce_store_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'global_ecommerce_store_customize_partial_blogdescription',
		) );
	}


/*Social settings*/
$wp_customize->add_section( 'global_ecommerce_store_social' ,
array(
    'title'      => esc_html__('Social Links', 'global-ecommerce-store'),
    'priority'   => 1,
    ) 
);

$wp_customize->add_setting(
    'global_ecommerce_store_facebook',
    array(
        'default'     => '',
        'description' => __( 'Enter your social media link(URL. Icons will not show if left blank.', 'global-ecommerce-store' ),
        'sanitize_callback' => 'esc_url_raw'
        )
    );


$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'global_ecommerce_store_facebook',
        array(
            'label'      => esc_html__('Facebook', 'global-ecommerce-store'),
            'section'    => 'global_ecommerce_store_social',
            'description' => __( 'Icons will not show if left blank. Enter your social media link(URL). . For example http://google.com/', 'global-ecommerce-store' ),
            'settings'   => 'global_ecommerce_store_facebook',
            'type'       => 'url',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_setting(
    'global_ecommerce_store_twitter',
    array(
        'default'     => '',
        'description' => __( 'Enter your social media link(URL. Icons will not show if left blank.', 'global-ecommerce-store' ),
        'sanitize_callback' => 'esc_url_raw'
        )
    );


$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'global_ecommerce_store_twitter',
        array(
            'label'      => esc_html__('Twitter', 'global-ecommerce-store'),
            'section'    => 'global_ecommerce_store_social',
            'description' => __( 'Icons will not show if left blank. Enter your social media link(URL). . For example http://google.com/', 'global-ecommerce-store' ),
            'settings'   => 'global_ecommerce_store_twitter',
            'type'       => 'url',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_setting(
    'global_ecommerce_store_dribble',
    array(
        'default'     => '',
        'description' => __( 'Enter your social media link(URL. Icons will not show if left blank.', 'global-ecommerce-store' ),
        'sanitize_callback' => 'esc_url_raw'
        )
    );


$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'global_ecommerce_store_dribble',
        array(
            'label'      => esc_html__('Dribble', 'global-ecommerce-store'),
            'section'    => 'global_ecommerce_store_social',
            'description' => __( 'Icons will not show if left blank. Enter your social media link(URL). . For example http://google.com/', 'global-ecommerce-store' ),
            'settings'   => 'global_ecommerce_store_dribble',
            'type'       => 'url',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_setting(
    'global_ecommerce_store_youtube',
    array(
        'default'     => '',
        'description' => __( 'Enter your social media link(URL. Icons will not show if left blank.', 'global-ecommerce-store' ),
        'sanitize_callback' => 'esc_url_raw'
        )
    );


$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'global_ecommerce_store_youtube',
        array(
            'label'      => esc_html__('youtube', 'global-ecommerce-store'),
            'section'    => 'global_ecommerce_store_social',
            'description' => __( 'Icons will not show if left blank. Enter your social media link(URL). . For example http://google.com/', 'global-ecommerce-store' ),
            'settings'   => 'global_ecommerce_store_youtube',
            'type'       => 'url',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_setting(
    'global_ecommerce_store_instagram',
    array(
        'default'     => '',
        'description' => __( 'Enter your social media link(URL. Icons will not show if left blank.', 'global-ecommerce-store' ),
        'sanitize_callback' => 'esc_url_raw'
        )
    );


$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'global_ecommerce_store_instagram',
        array(
            'label'      => esc_html__('Instagram', 'global-ecommerce-store'),
            'section'    => 'global_ecommerce_store_social',
            'description' => __( 'Icons will not show if left blank. Enter your social media link(URL). . For example http://google.com/', 'global-ecommerce-store' ),
            'settings'   => 'global_ecommerce_store_instagram',
            'type'       => 'url',
            'priority'   => 99
            )
        )
    );
/*Top Header Contact settings*/
$wp_customize->add_section( 'global_ecommerce_store_header' ,
array(
    'title'      => esc_html__('Top Header', 'global-ecommerce-store'),
    'priority'   => 3,
    ) 
);

    $wp_customize->add_setting(
        'global_ecommerce_store_top_header_contact',
        array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'global_ecommerce_store_sanitize_phone_number'
            )
        );
    $wp_customize->add_control( 'global_ecommerce_store_top_header_contact', array(
        'label'    => __( "Contact Number", 'global-ecommerce-store' ),
        'section'  => 'global_ecommerce_store_header',
        'description' => __( 'Contact number will not appear if left blank.', 'global-ecommerce-store' ),
        'type'     => 'text',
        'priority' => 1,
        ) );

    $wp_customize->add_setting(
        'global_ecommerce_store_top_header_email',
        array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'global_ecommerce_store_sanitize_email'
            )
        );
    $wp_customize->add_control( 'global_ecommerce_store_top_header_email', array(
        'label'    => __( "Email", 'global-ecommerce-store' ),
        'section'  => 'global_ecommerce_store_header',
        'description' => __( 'Email will not appear if left blank.', 'global-ecommerce-store' ),
        'type'     => 'text',
        'priority' => 1,
        ) );

 $wp_customize->add_setting('global_ecommerce_store_top_header_display_options', array(
         'default' => 'yes',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'global_ecommerce_store_radio_sanitize' // done
      ));

  $wp_customize->add_control('global_ecommerce_store_top_header_display_options', array(
     'type'         => 'radio',
     'label'        => esc_html__('Enable/Disable Whishlist and My account options','global-ecommerce-store'),
     'description'  => esc_html__('Choose the option as you want', 'global-ecommerce-store'),
     'section'      => 'global_ecommerce_store_header',
     'choices' => array(
        'yes' => esc_html__('Enable', 'global-ecommerce-store'),
        'no' => esc_html__('Disable', 'global-ecommerce-store'),        
     )
  ));
  $wp_customize->add_setting('global_ecommerce_store_top_header_display_cart_options', array(
         'default' => 'yes',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'global_ecommerce_store_radio_sanitize' // done
      ));

  $wp_customize->add_control('global_ecommerce_store_top_header_display_cart_options', array(
     'type'         => 'radio',
     'label'        => esc_html__('Enable/Disable Cart options','global-ecommerce-store'),
     'description'  => esc_html__('Choose the option as you want', 'global-ecommerce-store'),
     'section'      => 'global_ecommerce_store_header',
     'choices' => array(
        'yes' => esc_html__('Enable', 'global-ecommerce-store'),
        'no' => esc_html__('Disable', 'global-ecommerce-store'),        
     )
  ));

/* Slider Settings*/
$wp_customize->add_section( 'global_ecommerce_store_slider' ,
array(
    'title'      => esc_html__('Slider Settngs', 'global-ecommerce-store'),
    'priority'   => 1,
    ) 
);

    $wp_customize->add_setting('global_ecommerce_store_slider_display',array(
        'default' => 'true',
        'sanitize_callback' => 'global_ecommerce_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('global_ecommerce_store_slider_display',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide slider','global-ecommerce-store'),
        'description' => __('Image Size ( 1400px x 800px )','global-ecommerce-store'),
        'section' => 'global_ecommerce_store_slider',
    ));

    for ( $count = 1; $count <= 4; $count++ ) {

        $wp_customize->add_setting( 'global_ecommerce_store_slider' . $count, array(
            'default'           => '',
            'sanitize_callback' => 'global_ecommerce_store_sanitize_dropdown_pages'
        ) );

        $wp_customize->add_control( 'global_ecommerce_store_slider' . $count, array(
            'label'    => __( 'Select Slide Image Page', 'global-ecommerce-store' ),
            'section'  => 'global_ecommerce_store_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

/* Categories Settings*/
$wp_customize->add_section( 'global_ecommerce_store_categories' ,
array(
    'title'      => esc_html__('Product Categories Settngs', 'global-ecommerce-store'),
    'priority'   => 1,
    ) 
);

    $wp_customize->add_setting('global_ecommerce_store_categories_display',array(
        'default' => 'true',
        'sanitize_callback' => 'global_ecommerce_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('global_ecommerce_store_categories_display',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Product Categories','global-ecommerce-store'),
        'description' => __('select categories to Display','global-ecommerce-store'),
        'section' => 'global_ecommerce_store_categories',
    ));

    $wp_customize->add_setting(
        'global_ecommerce_store_category_title',
        array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
            )
        );
    $wp_customize->add_control( 'global_ecommerce_store_category_title', array(
        'label'    => __( "Product categories Title", 'global-ecommerce-store' ),
        'section'  => 'global_ecommerce_store_categories',
        'description' => __( 'Title will not appear if left blank.', 'global-ecommerce-store' ),
        'type'     => 'text',
        'priority' => 1,
        ) );



$cats = array();
$args =array(
                'taxonomy'=>'product_cat',
                'hide_empty' => false,
            );
 if ( class_exists( 'WooCommerce' ) ) {
    $results= get_terms($args);
    $i = 0;
    foreach($results as $cat){
        
        $cats[$cat->slug] =  $cat-> name ;
        if($i==0){
            $default = esc_html('Uncategorized','global-ecommerce-store');
            $i++;
        }
    }
}else{
    $default='';
}

for ( $count = 1; $count <= 6; $count++ ) {

        $wp_customize->add_setting('global_ecommerce_store_product_category'. $count, array(
            'default'        => $default,
            'sanitize_callback' => 'global_ecommerce_store_sanitize_choices'
        ));

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'global_ecommerce_store_product_category'. $count, array(
            'label' => 'Select Product Categories',
            'description' => 'Choose categories to display, Make sure woocoommerce plugin is active',
            'section' => 'global_ecommerce_store_categories',
            'settings' => 'global_ecommerce_store_product_category'. $count,
            'type'    => 'select',
            'choices' => $cats
        )));
    }

}
add_action( 'customize_register', 'global_ecommerce_store_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function global_ecommerce_store_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function global_ecommerce_store_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function global_ecommerce_store_customize_preview_js() {
	wp_enqueue_script( 'global-ecommerce-store-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'global_ecommerce_store_customize_preview_js' );
