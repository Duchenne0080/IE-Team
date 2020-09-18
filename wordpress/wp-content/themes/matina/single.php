<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Matina
 */

get_header();

$post_layout = get_theme_mod( 'matina_single_posts_layout', 'layout-default' );
?>
<div class="mt-single-post-wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			switch ( $post_layout ) {
				case 'layout-one':
					get_template_part( 'layouts/single/layout', 'one' );
					break;
				
				default:
					get_template_part( 'layouts/single/layout', 'default' );
					break;
			}
			
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div><!-- .mt-single-post-wrapper -->
<?php
get_footer();
