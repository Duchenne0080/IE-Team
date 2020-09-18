<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package business-class
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner-wrapper">
		<div class="post-thumb">
			<?php
			! is_singular() ? business_class_post_thumbnail() : false;
			?>
		</div>
		<div class="entry-container">
			<header class="entry-header">
				<?php
				if ( ! is_singular() ) :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() && is_archive() ) :
					?>
					<div class="entry-meta">
						<?php
						business_class_posted_on();
						business_class_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
				if ( is_single() ) {
					the_content();
				} else {
					the_excerpt();
				}
				?>
			</div><!-- .entry-content -->
			<footer class="entry-footer entry-meta">
				<?php business_class_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
