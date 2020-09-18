<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package business-class
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner-wrapper">


	<div class="post-thumb">
		<?php ! is_singular() ? business_class_post_thumbnail() : ''; ?>
	</div>
	<div class="entry-container">
	<header class="entry-header">
		<?php ! is_singular() ? the_title( '<h1 class="entry-title">', '</h1>' ) : ''; ?>
	</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			the_content();

			is_singular() ? wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-class' ),
					'after'  => '</div>',
				)
			) : '';
			?>
		</div><!-- .entry-content -->

		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer entry-meta">
				<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'business-class' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					),
					'<span class="edit-link">',
					'</span>'
				);
				?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
