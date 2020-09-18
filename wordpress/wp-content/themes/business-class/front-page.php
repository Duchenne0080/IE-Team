<?php
/**
 * Template for Front page
 *
 * Template name: Frontpage
 *
 * @package business-class
 */

if ( 'posts' === get_option( 'show_on_front' ) ) {
	get_template_part( 'index' );
} else {
	get_header();
	?>

	<div id="home-sections">
		<?php
			/**
			 * Hook - business_class_frontpage.
			 *
			 * @see business_class_load_frontpage_sections()
			 */
			do_action( 'business_class_frontpage' );
		?>

	</div><!-- #home-sections -->

	<?php
	get_footer();
}
