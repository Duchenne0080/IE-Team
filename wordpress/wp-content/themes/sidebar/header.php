<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sidebar
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">  
  
  <?php wp_head(); ?>    
   
</head>
<body <?php body_class(); ?>>
<?php
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}
?>    
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sidebar' ); ?></a>  
<header id="masthead" class="site-header" role="banner">  
    <div class="container-fluid">
    
    	<div class="row">
        
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 site-branding">
	            <?php the_custom_logo(); ?>
	            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                <?php endif; ?>                
            </div>      
            
			<div class="navbar navbar-default main-navigation col-lg-5 col-md-5 col-xs-12 col-sm-12">            
						  <?php
                            wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'container'      => 'ul',
								'fallback_cb'    => 'wp_page_menu',
								'menu_class'     => 'nav navbar-nav main-nav',
								'item_wrap'      => '<ul class="%2$s">%3s</ul>',
								'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
								'walker'         => new WP_Bootstrap_Navwalker(),							  
                            ) );
                          ?>               
            </div>
            
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
				<?php
				    $socialheader = get_theme_mod('sidebar_ed_socialmedia', '0');					
                    if ($socialheader) {
                        do_action( 'sidebar_social_link' ); 									
						$search_width_class = "col-lg-5 col-md-5 col-sm-12 col-xs-12";						
                    }
					else {
					$search_width_class = "col-lg-12 col-md-12 col-sm-12 col-xs-12";					
					}					
                ?>   
            	<div class="<?php echo esc_attr($search_width_class); ?>">
                <?php get_search_form();  ?> 
                </div>                                 
            </div>            
        
        
        </div>
    
    </div>
</header>