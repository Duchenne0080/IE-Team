<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package global_ecommerce_store
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'global-ecommerce-store' ); ?></a>

	<header id="masthead" class="site-header" style="<?php global_ecommerce_store_header_styles(); ?>">
		<div class="contain">
		<div class="top-header">
		
			<div class="row">
				<div class="contact col-md-3">
					<?php $contact = get_theme_mod('global_ecommerce_store_top_header_contact');
					if ($contact) {
					?>
					<div class="phone-number col-md-10">
					<?php 
						
						echo esc_html($contact);
					?>
					</div>
					<?php } ?>
				</div>
				<div class="email col-md-6">
					<?php
						$email = get_theme_mod('global_ecommerce_store_top_header_email');
					if ($email) {
					?>
					<div class="email-address">
					<?php 

						echo esc_html($email);
					?>	
					</div>
					<?php } ?>
				</div>
				<div class="socials col-md-3">
					<?php if(get_theme_mod('global_ecommerce_store_facebook')) : ?><a href="<?php echo esc_url(get_theme_mod('global_ecommerce_store_facebook')); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a><?php endif; ?>
					<?php if(get_theme_mod('global_ecommerce_store_twitter')) : ?><a href="<?php echo esc_url(get_theme_mod('global_ecommerce_store_twitter')); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a><?php endif; ?>
					<?php if(get_theme_mod('global_ecommerce_store_youtube')) : ?><a href="<?php echo esc_url(get_theme_mod('global_ecommerce_store_youtube')); ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a><?php endif; ?>
					<?php if(get_theme_mod('global_ecommerce_store_dribble')) : ?><a href="<?php echo esc_url(get_theme_mod('global_ecommerce_store_dribble')); ?>" target="_blank"><i class="fa fa-dribbble" aria-hidden="true"></i></a><?php endif; ?>
					<?php if(get_theme_mod('global_ecommerce_store_instagram')) : ?><a href="<?php echo esc_url(get_theme_mod('global_ecommerce_store_instagram')); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a><?php endif; ?>
				</div>
			</div>
			
		</div>
	</div>
	<div class="top-border">
		
	</div>
	<div class="contain">
		<div id="middle-header">
		<div class="site-branding">
			<div class="row">
				<div class="col-md-4 col-xs-12 site-logo text-center">			
					<?php 
					if (!has_custom_logo()) {
					    ?>
					    <?php
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$global_ecommerce_store_description = get_bloginfo( 'description', 'display' );
					if ( $global_ecommerce_store_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php  esc_html($global_ecommerce_store_description);?></p>
					<?php endif; ?>
					    <?php
					}else{
					the_custom_logo();
					$global_ecommerce_store_description = get_bloginfo( 'description', 'display' );
					if ( $global_ecommerce_store_description || is_customize_preview() ) :
						?>
						<div class="tagline">
							<p class="site-description"><?php echo  esc_html($global_ecommerce_store_description);  ?></p>
						</div>
					<?php endif; 
					}
					?>
				</div><!-- .site-logo -->

				<div class="col-md-5 col-xs-12 categories-menu ">
					<div class="row border-shadow">
					<div class="col-md-6 category">
					<?php if ( class_exists( 'WooCommerce' ) ) {?>
					<button class="product-btn"><?php echo esc_html_e('ALL CATEGORIES','global-ecommerce-store'); ?><i class="fa fa-angle-down" aria-hidden="true"></i></button>
					        <div class="product-cat">
					          <?php
					            $args = array(
					              'orderby'    => 'title',
					              'order'      => 'ASC',
					              'hide_empty' => 0,
					              'parent'  => 0
					            );
					            $product_categories = get_terms( 'product_cat', $args );
					            $count = count($product_categories);
					            if ( $count > 0 ){
					                foreach ( $product_categories as $product_category ) {
					                  $product_cat_id   = $product_category->term_id;
					                  $cat_link = get_category_link( $product_cat_id );
					                  if ($product_category->category_parent == 0) { ?>
					                <li class="drp_dwn_menu"><a href="<?php echo esc_url(get_term_link( $product_category ) ); ?>">
					                <?php
					              }
					                echo esc_html( $product_category->name ); ?></a><i class="fas fa-chevron-right"></i></li>
					                <?php
					                }
					              }
					          ?>
							</div>	<!-- .categories-menu -->
						
						</div>
						<div class="col-md-6 search-form">
							<?php global_ecommerce_store_product_searchbox();?>
						</div>
						<?php } ?>
					</div>
					</div>
				<div class="col-md-3 col-xs-12 cart-wishlist padding0">
					<?php if ( class_exists( 'WooCommerce' ) ) {?>
					<div class="header-cart row">
						<?php 
						$top_header_options = esc_attr( get_theme_mod( 'global_ecommerce_store_top_header_display_cart_options','yes' ) );
	   		if($top_header_options =='yes'){ ?>
								
						<?php if(function_exists ('wc_get_cart_url')){?>				
							<a href="<?php echo esc_url(wc_get_cart_url());?>" class=""><i class="fas fa-shopping-bag"></i></a>
							<div class="count">

								<div class="count-number">
									<?php global $woocommerce; ?><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>
								</div>
								</div>
							<?php }?>
						
					<?php }?>
					
						<?php 
							do_action( 'global_ecommerce_store_header' ); 
						?>
						
			        </div>
			    <?php }?>
				</div> <!-- .cart-wishlist -->
			</div> <!-- row -->
		</div><!-- .site-branding -->

		</div> <!-- #middle-header -->
	</div> <!-- contain class ends -->


</header><!-- #masthead -->
<div class="navigation-class">
	<nav id="site-navigation" class="main-navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"> <a href="#menubutton" id="menubutton"><i class="fas fa-bars"></i></a>				</button>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'menu-1',
			'menu_id'        => 'primary-menu',
		) );
		?>
	</nav><!-- #site-navigation -->
</div>	

	<div id="content" class="site-content">
