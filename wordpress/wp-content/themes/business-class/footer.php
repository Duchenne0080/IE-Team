<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package business-class
 */

$total_widgets = 4;


$panel_name   = 'theme_options';
$section_name = 'footer';

$footer_credit = apply_filters( 'business_class_footer_credit_text', business_class_get_theme_mod( $panel_name, $section_name, 'footer_credit_text' ) );

?>
			</div>
		</div>
	</div><!-- #content -->

	<?php if ( business_class_get_theme_mod( $panel_name, $section_name, 'enable_footer_widgets' ) ) { ?>
		<div id="footer-widgets" class="clear-fix">
			<div class="container">
					<div class="footer-widgets-inner">
						<div class="inner-wrapper">
							<?php
							for ( $index = 1; $index <= $total_widgets; $index++ ) {
								$footer_widget_id = "footer-widgets-{$index}";
								if ( is_active_sidebar( $footer_widget_id ) ) {
									dynamic_sidebar( $footer_widget_id );
								}
							}
							?>
						</div>
						<!-- .inner-wrapper -->
					</div>
					<!-- .footer-widgets-inner -->
			</div>
			<!-- .container -->
		</div>
		<!-- #footer-widgets -->
	<?php } ?>

	<?php if ( ! empty( $footer_credit ) ) { ?>
		<footer id="colophon" class="site-footer">
			<div class="container">
				<div class="site-info">
					<?php echo wp_kses_post( $footer_credit ); ?>
				</div><!-- .site-info -->
			</div>
		</footer><!-- #colophon -->
	<?php } ?>

</div><!-- #page -->
<div id="btn-scrollup" style="display: none;">
	<a title="<?php esc_attr_e( 'Go to top', 'business-class' ); ?>" class="scrollup" href="#"><i class="fas fa-angle-up"></i></a>
</div>
<?php wp_footer(); ?>

</body>
</html>
