<?php
/**
 * The template for displaying the footer
 */

?>

	</div><!-- #content -->
	
	<?php if (get_theme_mod( 'social_media_activate' )) { echo seos_restaurant_social_section (); } ?>
	
	<footer id="colophon"  role="contentinfo">
	
		<div class="site-info">

				<?php esc_html_e('All rights reserved', 'seos-restaurant'); ?>  &copy; <?php bloginfo('name'); ?>
							
				<a title="Seos Themes" href="<?php echo esc_url(__('https://seosthemes.com/', 'seos-restaurant')); ?>" target="_blank"><?php esc_html_e('Theme by Seos Themes', 'seos-restaurant'); ?></a>
			
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
	
</div><!-- #page -->

	<?php echo seos_restaurant_back_to_top(); ?>
	
<?php wp_footer(); ?>

</body>
</html>
