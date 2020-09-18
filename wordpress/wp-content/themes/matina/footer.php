<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Matina
 */

?>

		</div><!-- .mt-container -->
	</div><!-- #content -->
	<?php
		/**
		 * Hook: matina_after_content
		 *
		 * @since 1.0.0
		 */
		do_action( 'matina_after_content' );

		/**
		 * Hook: matina_before_colophon
		 *
		 * @since 1.0.0
		 */
		do_action( 'matina_before_colophon' );

		// footer layout option
		$footer_layout = get_theme_mod( 'matina_footer_section_layout', 'layout-default' );

		switch ( $footer_layout ) {
			case 'layout-one':
				get_template_part( 'layouts/footer/layout', 'one' );
				break;
			
			default:
				get_template_part( 'layouts/footer/layout', 'default' );
				break;
		}

		/**
		 * Hook: matina_after_colophon
		 *
		 * @hooked - matina_scroll_to_top - 10
		 *
		 * @since 1.0.0
		 */
		do_action( 'matina_after_colophon' );

	?>
	
</div><!-- #page -->

<?php
	/**
	 * Hook: matina_after_page
	 *
	 * @since 
	 */
	do_action( 'matina_after_page' );

	wp_footer();
?>

</body>
</html>
