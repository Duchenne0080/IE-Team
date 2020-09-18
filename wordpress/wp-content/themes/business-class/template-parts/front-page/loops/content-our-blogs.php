<?php
/**
 * Loop file for Our Blogs.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$category = get_the_category();

$term_id  = ! empty( $category[0]->term_id ) ? $category[0]->term_id : '';
$cat_name = ! empty( $category[0]->name ) ? $category[0]->name : '';


?>
<div id="latest-blog-<?php the_ID(); ?>" <?php post_class( 'ws-grid-4 latest-posts-item' ); ?>>
	<div class="latest-posts-wrapper box-shadow">

		<?php if ( has_post_thumbnail() ) { ?>
			<div class="latest-posts-thumb top-left-right-radius">
				<a href="<?php the_permalink(); ?>" class="image-hover-zoom">
					<?php the_post_thumbnail(); ?>
				</a>
			</div><!-- latest-posts-thumb  -->
		<?php } ?>

		<div class="latest-posts-text-content-wrapper">
			<div class="latest-posts-text-content top-left-right-radius">

				<?php if ( $cat_name ) { ?>
					<div class="new-cat">
						<span class="cat-links">
							<a href="<?php echo esc_url( get_category_link( $term_id ) ); ?>" rel="category tag"><?php echo esc_html( $cat_name ); ?></a>
						</span>
					</div>
				<?php } ?>

				<?php
				the_title(
					'<h3 class="latest-posts-title"><a href="' . esc_url( get_the_permalink() ) . '">',
					'</a></h3>'
				);
				?>

				<div class="entry-meta footer-meta">
					<?php
					business_class_posted_by();

					business_class_posted_on();
					?>
				</div>
				<?php
					the_excerpt();
					echo wp_kses_post( '<a href="' . get_the_permalink() . '" class="more-link">' . esc_html__( 'Read More', 'business-class' ) . '</a>' );
				?>
			</div>
			<!-- .latest-posts-text-content -->
		</div>
		<!-- .latest-posts-text-content-wrapper -->
	</div>
	<!-- .latest-posts-wrapper -->
</div>
