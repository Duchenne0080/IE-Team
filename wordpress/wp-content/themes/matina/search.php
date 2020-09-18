<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Matina
 */

get_header();
?>
<div class="mt-archive-wrapper">
	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<?php

			$archive_layout = get_theme_mod( 'matina_archive_layout', 'layout-default' );

			echo '<div class="mt-archive-posts-wrapper">';

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				switch ( $archive_layout ) {
					case 'layout-one':
						get_template_part( 'layouts/archive/layout', 'one' );
						break;
					
					default:
						get_template_part( 'layouts/archive/layout', 'default' );
						break;
				}

			endwhile;

			echo '</div><!-- .mt-archive-posts-wrapper -->';

			matina_the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>
</div><!-- .mt-archive-wrapper -->
<?php
get_footer();
