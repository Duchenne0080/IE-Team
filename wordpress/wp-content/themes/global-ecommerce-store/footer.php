<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package global ecommerce store
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<aside class="widget-area" role="complementary">
				<div class="row">
					<div class="widget-column footer-widget-1 col-lg-3 col-md-3">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
					<div class="widget-column footer-widget-2 col-lg-3 col-md-3">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>
					<div class="widget-column footer-widget-3 col-lg-3 col-md-3">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>
					<div class="widget-column footer-widget-4 col-lg-3 col-md-3">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div>
				</div>
			</aside>
		</div>
		<div class="container">
			<div class="site-info">
					<?php echo esc_html(get_theme_mod('global_ecommerce_store_footer_copy',__('global ecommerce store WordPress Theme By webcults','global-ecommerce-store'))); ?> 
			</div><!-- .site-info -->
		</div><!-- .container-fluid-->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
