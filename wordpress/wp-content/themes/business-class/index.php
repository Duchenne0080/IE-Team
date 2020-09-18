<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package business-class
 */

get_header();

$business_class_layout = business_class_get_sidebar_layout();

if ( is_singular() ) {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', 'banner' );
	}
} else {
	get_template_part( 'template-parts/content', 'banner' );
}
?>

<div id="content">

	<div class="container">

		<div class="inner-wrapper">

		<?php
		if ( 'left-sidebar' === $business_class_layout ) {
			get_sidebar();
		}
		?>

			<main id="primary" class="site-main">

				<?php
				if ( have_posts() ) :

					if ( is_home() ) :
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
						<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					is_archive() || is_home() && ! is_singular() ? the_posts_pagination() : the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

			</main><!-- #main -->

<?php
if ( 'right-sidebar' === $business_class_layout ) {
	get_sidebar();
}

get_footer();
