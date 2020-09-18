<?php
/**
 * Template part for displaying posts
 *
 */

?>
<div class="aniview article-home" data-av-animation="fadeInUp">
<article id="post-<?php the_ID(); ?>" <?php if ( is_front_page() || is_home() || is_category()) { post_class((is_sticky()?'sticky':'')); } ?>>

	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php seos_restaurant_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	
	<?php if ( is_front_page() || is_home() || is_category() || is_archive() ) : ?>
		<?php if ( has_post_thumbnail() ) { ?>
		<a class="app-img-effect" href="<?php the_permalink(); ?>">	
			<div class="app-first">
				<div class="app-sub">
					<div class="app-basic">

						 <?php the_post_thumbnail(); ?> 			
						
					</div>
				</div>
			</div>
		</a>
		<?php } ?>
		
	<?php the_excerpt(); ?>
	
	<?php else : ?>
	
	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'seos-restaurant' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seos-restaurant' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	
	<?php endif; ?>
	
	<footer class="entry-footer">
		<?php seos_restaurant_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
</div>