<?php if( ! defined( 'ABSPATH' ) ) exit;

	function seos_restaurant_social_section () { ?>

		<div class="social">
		
			<div class="fa-icons">
			
				<?php if (get_theme_mod( 'seos_restaurant_facebook' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' ) == "_blank"){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_facebook' )); ?>"><i class="fab fa-facebook-f"></i></a>
				<?php endif; ?>
							
				<?php if (get_theme_mod( 'seos_restaurant_twitter' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_twitter' )); ?>"><i class="fab fa-twitter"></i></a>
				<?php endif; ?>
											
				<?php if (get_theme_mod( 'seos_restaurant_google' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_google' )); ?>"><i class="fab fa-google-plus-g"></i></a>
				<?php endif; ?>
															
				<?php if (get_theme_mod( 'seos_restaurant_youtube' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_youtube' )); ?>"><i class="fab fa-youtube"></i></a>
				<?php endif; ?>
																			
				<?php if (get_theme_mod( 'seos_restaurant_vimeo' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_vimeo' )); ?>"><i class="fab fa-vimeo"></i></a>
				<?php endif; ?>
																			
				<?php if (get_theme_mod( 'seos_restaurant_pinterest' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_pinterest' )); ?>"><i class="fab fa-pinterest"></i></a>
				<?php endif; ?>	
				
				<?php if (get_theme_mod( 'seos_restaurant_instagram' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_instagram' )); ?>"><i class="fab fa-instagram" aria-hidden="true"></i></a>
				<?php endif; ?>
																			
				<?php if (get_theme_mod( 'seos_restaurant_linkedin' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_linkedin' )); ?>"><i class="fab fa-linkedin"></i></a>
				<?php endif; ?>
																			
				<?php if (get_theme_mod( 'seos_restaurant_rss' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_rss' )); ?>"><i class="fas fa-rss"></i></a>
				<?php endif; ?>
																			
				<?php if (get_theme_mod( 'seos_restaurant_stumbleupon' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_stumbleupon' )); ?>"><i class="fab fa-stumbleupon"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_kirki_social_10' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_kirki_social_10' )); ?>"><i class="fab fa-flickr" aria-hidden="true"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_dribbble' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_dribbble' )); ?>"><i class="fab fa-dribbble"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_digg' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_digg' )); ?>"><i class="fab fa-digg"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_skype' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_skype' )); ?>"><i class="fab fa-skype"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_deviantart' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_deviantart' )); ?>"><i class="fab fa-deviantart"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_yahoo' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_yahoo' )); ?>"><i class="fab fa-yahoo"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_reddit_alien' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_reddit_alien' )); ?>"><i class="fab fa-reddit-alien"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_paypal' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_paypal' )); ?>"><i class="fab fa-paypal"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_dropbox' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_dropbox' )); ?>"><i class="fab fa-dropbox"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_soundcloud' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_soundcloud' )); ?>"><i class="fab fa-soundcloud"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_vk' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_vk' )); ?>"><i class="fab fa-vk"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_envelope' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_envelope' )); ?>"><i class="fas fa-envelope"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_address_book' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_address_book' )); ?>"><i class="fas fa-address-book" aria-hidden="true"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_address_apple' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_address_apple' )); ?>"><i class="fab fa-apple"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_address_amazon' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_address_amazon' )); ?>"><i class="fab fa-amazon"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_address_slack' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_address_slack' )); ?>"><i class="fab fa-slack"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_address_slideshare' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_address_slideshare' )); ?>"><i class="fab fa-slideshare"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_address_wikipedia' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_address_wikipedia' )); ?>"><i class="fab fa-wikipedia-w"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_address_wordpress' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_address_wordpress' )); ?>"><i class="fab fa-wordpress"></i></a>
				<?php endif; ?>
																							
				<?php if (get_theme_mod( 'seos_restaurant_address_odnoklassniki' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_address_odnoklassniki' )); ?>"><i class="fab fa-odnoklassniki"></i></a>
				<?php endif; ?>
																											
				<?php if (get_theme_mod( 'seos_restaurant_address_tumblr' )) : ?>
					<a target="<?php if(get_theme_mod( 'seos_restaurant_social_link_type' )){echo esc_html(get_theme_mod( 'seos_restaurant_social_link_type' )); } else {echo "_self"; } ?>" href="<?php echo esc_html(get_theme_mod( 'seos_restaurant_address_tumblr' )); ?>"><i class="fab fa-tumblr"></i></a>
				<?php endif; ?>
				
			</div>
	
		</div>
		
<?php }  ?>