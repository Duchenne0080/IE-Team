<?php
/**
 * The Header template
 */ 
 ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">	
	<?php endif; ?>
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } else { do_action( 'wp_body_open' ); } ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'seos-restaurant' ); ?></a>
	<?php if (get_theme_mod( 'social_media_activate_header' )) { echo seos_restaurant_social_section (); } ?>	
	<header id="masthead" class="site-header" role="banner">				
			<div class="nav-center">

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'seos-restaurant' ); ?></button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->

			</div>
	
<!---------------- Deactivate Header Image ---------------->	
		
		<?php if (get_theme_mod('custom_header_position') != "deactivate" and has_header_image() !="") { ?>
		
<!---------------- All Pages Header Image ---------------->		
	
		<?php if ( get_theme_mod('custom_header_position') == "all" ) : ?>
		
		<div class="header-img" style="background-image: url('<?php header_image(); ?>');">	
		
			<?php if ( get_theme_mod('custom_header_overlay') == "on" ) { ?>
				<div class="dotted">
			<?php } ?>
				
			<div class="site-branding">
			
				<?php if ( has_custom_logo() ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="zoomIn"><?php the_custom_logo(); ?></h1>
						<?php else : ?>
							<p class="site-title"><p class="site-title"><?php the_custom_logo(); ?></p></p>
						<?php endif;

						$ap_description = get_bloginfo( 'description', 'display' );
						if ( $ap_description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="zoomIn"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$ap_description = get_bloginfo( 'description', 'display' );
						if ( $ap_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						
				<?php endif;  endif;  ?>			
			
			</div><!-- .site-branding -->
				
				
			<?php if ( get_theme_mod('custom_header_overlay') == "on" ) { ?>
				</div>
			<?php } ?>
			
		</div>
		
		<?php endif;  ?>
		
<!---------------- Home Page Header Image ---------------->
		
		<?php if ( ( is_front_page() || is_home() ) and get_theme_mod('custom_header_position') == "home" ) { ?>

		<div class="header-img" style="background-image: url('<?php header_image(); ?>');">	

			<?php if ( get_theme_mod('custom_header_overlay') == "on" ) { ?>
				<div class="dotted">
			<?php } ?>					

			<div class="site-branding">
			
				<?php if ( has_custom_logo() ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="zoomIn"><?php the_custom_logo(); ?></h1>
						<?php else : ?>
							<p class="site-title"><p class="site-title"><?php the_custom_logo(); ?></p></p>
						<?php endif;

						$ap_description = get_bloginfo( 'description', 'display' );
						if ( $ap_description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="zoomIn"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$ap_description = get_bloginfo( 'description', 'display' );
						if ( $ap_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						
				<?php endif;  endif;  ?>			
			
			</div><!-- .site-branding -->
						
				
			<?php if ( get_theme_mod('custom_header_overlay') == "on" ) { ?>
				</div>
			<?php } ?>					
		</div>
		
	<?php } 

	} ?> 

<!---------------- Default Header Image ---------------->

		<?php if ( get_theme_mod('custom_header_position') != "deactivate" and has_header_image() !="") { ?>
		
		<?php if ( get_theme_mod('custom_header_position') != "all") { ?>

		<?php if ( ( is_front_page() or is_home() ) and get_theme_mod('custom_header_position') != "home" ) { ?>

		<div class="header-img" style="background-image: url('<?php echo esc_url(get_template_directory_uri()). "/framework/images/header.jpg"; ?>');">	

			<div class="dotted">
			
			<div class="site-branding">
			
				<?php if ( has_custom_logo() ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="zoomIn"><?php the_custom_logo(); ?></h1>
						<?php else : ?>
							<p class="site-title"><p class="site-title"><?php the_custom_logo(); ?></p></p>
						<?php endif;

						$ap_description = get_bloginfo( 'description', 'display' );
						if ( $ap_description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="zoomIn"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$ap_description = get_bloginfo( 'description', 'display' );
						if ( $ap_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $ap_description; /* WPCS: xss ok. */ ?></p>
						
				<?php endif;  endif;  ?>			
			
			</div><!-- .site-branding -->
				
			</div>
							
		</div>
		
		<?php } } } ?>
	
	</header><!-- #masthead -->

			<?php if ( is_front_page() or is_home() or is_page_template( 'full-width-home.php' ) ) : ?>
			
			<?php echo seos_restaurant_gallery (); ?>
			
					<div class="seos-boxes">
					
						<?php if (get_theme_mod( 'seos_restaurant_box_1_title' ) or get_theme_mod( 'seos_restaurant_box_1_icon' ) or get_theme_mod( 'seos_restaurant_1_img' )) : ?>	

								<div class="seos-box">
									
										<a class="seos-hover" href="<?php echo esc_url(get_theme_mod( 'seos_restaurant_box_1_url' )); ?>">
											<?php if (get_theme_mod( 'seos_restaurant_1_img' )) : ?>
												<img class="animated" src="<?php echo esc_url(get_theme_mod( 'seos_restaurant_1_img' )); ?>" alt="icon" />
												<?php else : ?> 
												<i style="color:<?php echo esc_html(get_theme_mod( 'seos_restaurant_box_1_icon_color' )); ?>; " class="fa fa-<?php echo esc_html(get_theme_mod( 'seos_restaurant_box_1_icon' )); ?>"></i>
											<?php endif; ?> 
										</a>
										<h3><?php echo esc_html(get_theme_mod( 'seos_restaurant_box_1_title' )); ?></h3>
										<p><?php echo esc_html(get_theme_mod( 'seos_restaurant_box_1_text' )); ?></p>
									
								</div>
								
						<?php endif; ?>
						
						
						<?php if (get_theme_mod( 'seos_restaurant_box_2_title' ) or get_theme_mod( 'seos_restaurant_box_2_icon' ) or get_theme_mod( 'seos_restaurant_2_img' )) : ?>		
								<div class="seos-box">
									
										<a class="seos-hover" href="<?php echo esc_url(get_theme_mod( 'seos_restaurant_box_2_url' )); ?>">
											<?php if (get_theme_mod( 'seos_restaurant_2_img' )) : ?>
												<img class="animated" src="<?php echo esc_url(get_theme_mod( 'seos_restaurant_2_img' )); ?>" alt="icon" />
												<?php else : ?> 
												<i style="color:<?php echo esc_html(get_theme_mod( 'seos_restaurant_box_2_icon_color' )); ?>; " class="fa fa-<?php echo esc_html(get_theme_mod( 'seos_restaurant_box_2_icon' )); ?>"></i>
											<?php endif; ?> 
										</a>
										<h3><?php echo esc_html(get_theme_mod( 'seos_restaurant_box_2_title' )); ?></h3>
										<p><?php echo esc_html(get_theme_mod( 'seos_restaurant_box_2_text' )); ?></p>
									
								</div>
						<?php endif; ?>

						<?php if (get_theme_mod( 'seos_restaurant_box_3_title' ) or get_theme_mod( 'seos_restaurant_box_3_icon' ) or get_theme_mod( 'seos_restaurant_3_img' )) : ?>
								<div class="seos-box">								
								
										<a class="seos-hover" href="<?php echo esc_url(get_theme_mod( 'seos_restaurant_box_3_url' )); ?>">
											<?php if (get_theme_mod( 'seos_restaurant_3_img' )) : ?>
												<img class="animated" src="<?php echo esc_url(get_theme_mod( 'seos_restaurant_3_img' )); ?>" alt="icon" />
												<?php else : ?> 
												<i style="color:<?php echo esc_html(get_theme_mod( 'seos_restaurant_box_3_icon_color' )); ?>; " class="fa fa-<?php echo esc_html(get_theme_mod( 'seos_restaurant_box_3_icon' )); ?>"></i>
											<?php endif; ?> 
										</a>
										<h3><?php echo esc_html(get_theme_mod( 'seos_restaurant_box_3_title' )); ?></h3>
										<p><?php echo esc_html(get_theme_mod( 'seos_restaurant_box_3_text' )); ?></p>
									
								</div>
						<?php endif; ?> 
					
					</div>
					
				<?php endif; ?>
				
	<div class="clear"></div>
	
	<div id="content" class="site-content">