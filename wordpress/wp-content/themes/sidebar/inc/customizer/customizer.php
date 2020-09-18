<?php
Sidebar_Kirki::add_config( 'sidebar', array(
        'capability'    => 'edit_theme_options',
        'option_type'   => 'theme_mod',
        'disable_output'=> true,
    ) );

/* Option list of all categories */
	$args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
	); 
	$sidebar_option_categories = array();
	$sidebar_category_lists = get_categories( $args );
	$sidebar_option_categories[''] = __( 'Choose Category', 'sidebar' );
	foreach( $sidebar_category_lists as $sidebar_category ){
		$sidebar_option_categories[$sidebar_category->term_id] = $sidebar_category->name;
	}

/**
 * Basic customizations
 */
function sidebar_homepage_customize($wp_customize) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-branding .site-title a',
			'render_callback' => 'sidebar_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'sidebar_customize_partial_blogdescription',
		) );
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	function sidebar_customize_partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */

	function sidebar_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
}
add_action( 'customize_register', 'sidebar_homepage_customize', 10 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sidebar_customize_preview_js() {
	wp_enqueue_script( 'sidebar-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'sidebar_customize_preview_js' );

/**
* Callback for Social Links
*/
function sidebar_social_cb(){

$sidebar_fb_link = get_theme_mod( 'sidebar_socialmedia_fb' ); 
$sidebar_tw_link = get_theme_mod( 'sidebar_socialmedia_tw' ); 
$sidebar_gplus_link = get_theme_mod( 'sidebar_socialmedia_gplus' ); 
$sidebar_insta_link = get_theme_mod( 'sidebar_socialmedia_insta' ); 
$sidebar_linkedin_link = get_theme_mod( 'sidebar_socialmedia_linkedin' ); 
$sidebar_pin_link = get_theme_mod( 'sidebar_socialmedia_pin' ); 
$sidebar_ytube_link = get_theme_mod( 'sidebar_socialmedia_ytube' ); 

    ?>
    <ul class="social-networks col-lg-7 col-md-7 col-sm-12 col-xs-12">
	<?php if ($sidebar_fb_link) { ?><li><a target="_blank" href="<?php echo esc_url($sidebar_fb_link); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/facebook.png" class="social-icon img-responsive" /></a></li><?php } ?>
    <?php if ($sidebar_tw_link) { ?><li><a target="_blank" href="<?php echo esc_url($sidebar_tw_link); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/twitter.png" class="social-icon img-responsive" /></a></li><?php } ?>
    <?php if ($sidebar_gplus_link) { ?><li><a target="_blank" href="<?php echo esc_url($sidebar_gplus_link); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/googleplus.png" class="social-icon img-responsive" /></a></li><?php } ?>
    <?php if ($sidebar_insta_link) { ?><li><a target="_blank" href="<?php echo esc_url($sidebar_insta_link); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/instagram.png" class="social-icon img-responsive" /></a></li><?php } ?>
    <?php if ($sidebar_linkedin_link) { ?><li><a target="_blank" href="<?php echo esc_url($sidebar_linkedin_link); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/linkedin.png" class="social-icon img-responsive" /></a></li><?php } ?>
    <?php if ($sidebar_pin_link) { ?><li><a target="_blank" href="<?php echo esc_url($sidebar_pin_link); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pinterest.png" class="social-icon img-responsive" /></a></li><?php } ?>
    <?php if ($sidebar_ytube_link) { ?><li><a target="_blank" href="<?php echo esc_url($sidebar_ytube_link); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/youtube.png" class="social-icon img-responsive" /></a></li><?php } ?>
	</ul>
<?php    
}
add_action( 'sidebar_social_link', 'sidebar_social_cb' );

/**
 * Customizer List
 */
get_template_part( 'inc/customizer/customize-homepage' );
get_template_part( 'inc/customizer/socialmedia' );