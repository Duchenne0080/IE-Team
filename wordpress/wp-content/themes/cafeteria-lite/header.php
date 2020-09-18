<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Cafeteria Lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>
<a class="skip-link screen-reader-text" href="#theme_content_navigator">
<?php esc_html_e( 'Skip to content', 'cafeteria-lite' ); ?>
</a>
<?php
$cafeteria_lite_show_hdrcontact_sections 	   = esc_attr( get_theme_mod('cafeteria_lite_show_hdrcontact_sections', false) );
$cafeteria_lite_show_hdrsocial_sections        = esc_attr( get_theme_mod('cafeteria_lite_show_hdrsocial_sections', false) ); 
$cafeteria_lite_show_homesldr_section 	       = esc_attr( get_theme_mod('cafeteria_lite_show_homesldr_section', false) );
$cafeteria_lite_show_4columncircle_sections    = esc_attr( get_theme_mod('cafeteria_lite_show_4columncircle_sections', false) );
?>
<div id="sitelayout" <?php if( get_theme_mod( 'cafeteria_lite_site_layout_options' ) ) { echo 'class="boxlayout"'; } ?>>
<?php
if ( is_front_page() && !is_home() ) {
	if( !empty($cafeteria_lite_show_homesldr_section)) {
	 	$inner_cls = '';
	}
	else {
		$inner_cls = 'siteinner';
	}
}
else {
$inner_cls = 'siteinner';
}
?>

<div class="site-header <?php echo esc_attr($inner_cls); ?> "> 
  <div class="container">   
    <div class="hdr_topstrip">         
     <?php if( $cafeteria_lite_show_hdrcontact_sections != ''){ ?>   
      <div class="left">       
         <?php 
            $cafeteria_lite_header_address = get_theme_mod('cafeteria_lite_header_address');
               if( !empty($cafeteria_lite_header_address) ){ ?>                
                 <div class="infobox">
                     <i class="fas fa-map-marker-alt"></i>
                     <span>			      
                      <?php echo esc_html($cafeteria_lite_header_address); ?>
                    </span> 
                </div>            
             <?php } ?>
             
          <?php $cafeteria_lite_header_phoneno = get_theme_mod('cafeteria_lite_header_phoneno');
               if( !empty($cafeteria_lite_header_phoneno) ){ ?>              
                 <div class="infobox">
                     <i class="fas fa-phone-volume"></i>               
                     <span><?php echo esc_html($cafeteria_lite_header_phoneno); ?></span>   
                 </div>       
         <?php } ?> 
      </div><!--end .left-->                 
    <?php } ?>               
          
          
          <?php if( $cafeteria_lite_show_hdrsocial_sections != ''){ ?>
                <div class="right">
                    <div class="hdr_social">                                                
					   <?php $cafeteria_lite_facebook_link = get_theme_mod('cafeteria_lite_facebook_link');
                        if( !empty($cafeteria_lite_facebook_link) ){ ?>
                        <a class="fab fa-facebook-f" target="_blank" href="<?php echo esc_url($cafeteria_lite_facebook_link); ?>"></a>
                       <?php } ?>
                    
                       <?php $cafeteria_lite_twitter_link = get_theme_mod('cafeteria_lite_twitter_link');
                        if( !empty($cafeteria_lite_twitter_link) ){ ?>
                        <a class="fab fa-twitter" target="_blank" href="<?php echo esc_url($cafeteria_lite_twitter_link); ?>"></a>
                       <?php } ?>
                
                      <?php $cafeteria_lite_googleplus_link = get_theme_mod('cafeteria_lite_googleplus_link');
                        if( !empty($cafeteria_lite_googleplus_link) ){ ?>
                        <a class="fab fa-google-plus" target="_blank" href="<?php echo esc_url($cafeteria_lite_googleplus_link); ?>"></a>
                      <?php }?>
                
                      <?php $cafeteria_lite_linkedin_link = get_theme_mod('cafeteria_lite_linkedin_link');
                        if( !empty($cafeteria_lite_linkedin_link) ){ ?>
                        <a class="fab fa-linkedin" target="_blank" href="<?php echo esc_url($cafeteria_lite_linkedin_link); ?>"></a>
                      <?php } ?> 
                      
                      <?php $cafeteria_lite_instagram_link = get_theme_mod('cafeteria_lite_instagram_link');
                        if( !empty($cafeteria_lite_instagram_link) ){ ?>
                        <a class="fab fa-instagram" target="_blank" href="<?php echo esc_url($cafeteria_lite_instagram_link); ?>"></a>
                      <?php } ?> 
                      </div><!--end .hdr_social-->                       
                   </div><!--end .right-->                 
             <?php } ?>            
            <div class="clear"></div>     
     </div><!--end .hdr_topstrip-->    
  </div><!-- .container --> 
  
 <div class="container"> 
     <div class="logo">
           <?php cafeteria_lite_the_custom_logo(); ?>
            <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <p><?php echo esc_html($description); ?></p>
            <?php endif; ?>
     </div><!-- logo --> 
  
     <div id="mainnavigator">       
		   <button class="menu-toggle" aria-controls="main-navigation" aria-expanded="false" type="button">
			<span aria-hidden="true"><?php esc_html_e( 'Menu', 'cafeteria-lite' ); ?></span>
			<span class="dashicons" aria-hidden="true"></span>
		   </button>

		  <nav id="main-navigation" class="site-navigation primary-navigation" role="navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container' => 'ul',
				'menu_id' => 'primary',
				'menu_class' => 'primary-menu menu',
			) );
			?>
		  </nav><!-- .site-navigation -->
	    </div><!-- #mainnavigator -->
       <div class="clear"></div>       
  </div><!-- .container --> 
</div><!--.site-header --> 
 
<?php 
if ( is_front_page() && !is_home() ) {
if($cafeteria_lite_show_homesldr_section != '') {
	for($i=1; $i<=3; $i++) {
	  if( get_theme_mod('cafeteria_lite_homesldrpage'.$i,false)) {
		$slider_Arr[] = absint( get_theme_mod('cafeteria_lite_homesldrpage'.$i,true));
	  }
	}
?> 
<div class="slider-main">  
              
<?php if(!empty($slider_Arr)){ ?>
<div id="slider" class="nivoSlider">
<?php 
$i=1;
$slidequery = new WP_Query( array( 'post_type' => 'page', 'post__in' => $slider_Arr, 'orderby' => 'post__in' ) );
while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); 
$thumbnail_id = get_post_thumbnail_id( $post->ID );
$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); 
?>
<?php if(!empty($image)){ ?>
<img src="<?php echo esc_url( $image ); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php }else{ ?>
<img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider-default.jpg" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php } ?>
<?php $i++; endwhile; ?>
</div>   

<?php 
$j=1;
$slidequery->rewind_posts();
while( $slidequery->have_posts() ) : $slidequery->the_post(); ?>                 
    <div id="slidecaption<?php echo esc_attr( $j ); ?>" class="nivo-html-caption">         
    	<h2><?php the_title(); ?></h2>
    	<?php the_excerpt(); ?>
		<?php
        $cafeteria_lite_homesldrmorebtn = get_theme_mod('cafeteria_lite_homesldrmorebtn');
        if( !empty($cafeteria_lite_homesldrmorebtn) ){ ?>
            <a class="slide_morebtn" href="<?php the_permalink(); ?>"><?php echo esc_html($cafeteria_lite_homesldrmorebtn); ?></a>
        <?php } ?>                  
    </div>   
<?php $j++; 
endwhile;
wp_reset_postdata(); ?>   
<?php } ?>
 </div><!-- .slider_wrapper -->    
<?php } } ?>

   
        
<?php if ( is_front_page() && ! is_home() ) { ?>
   <?php if( $cafeteria_lite_show_4columncircle_sections != ''){ ?> 
     <section id="front_services_boxes">
     <div class="container">   
       <?php
        $cafeteria_lite_services_section_title = get_theme_mod('cafeteria_lite_services_section_title');
        if( !empty($cafeteria_lite_services_section_title) ){ ?>
            <h2 class="services_title"><?php echo esc_html($cafeteria_lite_services_section_title); ?></h2>
        <?php } ?>      
             
               <?php 
                for($n=1; $n<=4; $n++) {    
                if( get_theme_mod('cafeteria_lite_4column_circlebox'.$n,false)) {      
                    $queryvar = new WP_Query('page_id='.absint(get_theme_mod('cafeteria_lite_4column_circlebox'.$n,true)) );		
                    while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>     
                    <div class="fourcolbx <?php if($n % 4 == 0) { echo "last_column"; } ?>">                                       
                        <?php if(has_post_thumbnail() ) { ?>
                        <div class="thumbbx"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>        
                        <?php } ?>
                        <div class="boxdescription">              	
                          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>                          
                        </div>                      
                    </div>
                    <?php endwhile;
                    wp_reset_postdata();                                  
                } } ?>                                 
            <div class="clear"></div>
  
    </div><!-- .container -->
</section><!-- #front_services_boxes -->
      <?php } ?>
<?php } ?>