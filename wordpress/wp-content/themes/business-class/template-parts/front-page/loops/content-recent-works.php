<?php
/**
 * Loop file for recent works.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$terms      = get_the_terms( get_the_ID(), 'category' );
$term_slugs = wp_list_pluck( $terms, 'slug' );

$implode    = implode( ' ', $term_slugs );
$post_class = "portfolio-item ${implode} isotope-item";

// Need to trim the excerpt manually so that it don't conflict with the layout.
$excerpt_trimmed = wpautop( wp_trim_words( get_the_excerpt(), 15, '...' ) );
?>

<div id="recent-work-item-<?php the_ID(); ?>"  <?php post_class( $post_class ); ?>>
	<div class="item-inner-wrapper">

		<div class="portfolio-thumb-wrap">
			<?php the_post_thumbnail( 'large' ); ?>
		</div>

		<div class="portfolio-content">
			<?php

			the_title(
				'<h3><a href="' . esc_url( get_the_permalink() ) . '">',
				'</a></h3>'
			);

			echo wp_kses_post( $excerpt_trimmed );

			echo wp_kses_post(
				'<a href="' . esc_url( get_the_permalink() ) . '" class="custom-button">' . esc_html__( 'Know More', 'business-class' ) . '</a>'
			);
			?>
		</div>
	</div>
</div>
