<?php function seos_restaurant_gallery () { 

if (get_theme_mod( 'seos_restaurant_gallery_activate' )) {  ?>
	
	<div class="sr-gallery-section">
	
		<?php if (get_theme_mod('seos_restaurant_gallery_section_title')) { ?> <h2><?php echo esc_html(get_theme_mod('seos_restaurant_gallery_section_title')); ?></h2><?php } ?>

	
			<?php for($i=1;$i<=20;$i++) {
					
				if (get_theme_mod('seos_restaurant_image_gallery_'.$i)) { ?>
					
					<div class="sr-gallery">
					<div class="aniview"  data-av-animation="flipInX">					
						<a href="<?php echo esc_url(get_theme_mod('seos_restaurant_image_gallery_link_'.$i)); ?>">			
							<img alt="gallery-image-1" src="<?php echo esc_url(get_theme_mod('seos_restaurant_image_gallery_'.$i)); ?>" />
							<div class="sr-gallery-title animated zoomInDown"><?php echo  esc_html(get_theme_mod('seos_restaurant_image_title_'.$i)); ?></div>
						</a>
					</div>
					</div>
					
				<?php }
			
			} ?>

	</div>
	
<?php }

/***************** Default ************/

if (!get_theme_mod( 'seos_restaurant_gallery_activate' )) {  ?>
	
	<div class="sr-gallery-section">
	

	
			<?php for($i=1;$i<=3;$i++) { ?>
					
					<div class="sr-gallery">
					<div class="aniview"  data-av-animation="flipInX">							
						<a href="#">			
							<img alt="gallery-image-1" src="<?php echo SEOS_RESTAURANT_THEME_URI . '/framework/images/no-image.jpg'; ?>" />
							<div class="sr-gallery-title animated zoomInDown"><?php _e('Read More about this image.', 'seos-restaurant'); ?></div>
						</a>
					</div>
					</div>
					
				<?php 
			
			} ?>
			
	</div>
	
<?php }

}
