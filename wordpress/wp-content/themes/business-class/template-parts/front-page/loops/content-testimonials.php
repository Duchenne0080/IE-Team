<?php
/**
 * Loop file for testimonial section.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$reviewer_post = business_class_get_post_meta( get_the_ID(), 'reviewer_post' );

?>

<div class="ws-grid-6 testimonial-item">
	<div class="testimonial-wrapper">

		<div class="testimonial-summary">
			<?php the_content(); ?>
		</div><!-- .testimonial-summary -->


		<div class="testimonial-thumb">
			<?php the_post_thumbnail(); ?>
			<div class="clien-info-wrap">
				<div class="clinet-info">
					<?php
					the_title(
						'<h4 class="testimonial-title">',
						'</h4>'
					);

					echo $reviewer_post ? wp_kses_post( "<p class='testimonial-position'>{$reviewer_post}</p>" ) : '';
					?>
				</div><!-- .clinet-info -->
			</div><!-- .clien-info-wrap -->
		</div><!-- .testimonial-thumb -->

	</div><!-- .testimonial-wrapper -->
</div><!-- .testimonial-item  -->
