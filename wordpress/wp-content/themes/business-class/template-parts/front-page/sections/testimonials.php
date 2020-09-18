<?php
/**
 * Section file for frontpage > Our team section.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$panel_name   = 'front_page';
$section_name = 'testimonials';

$enable_section = business_class_get_theme_mod( $panel_name, $section_name, 'Enable Section' );

if ( ! $enable_section ) {
	return;
}

$heading         = business_class_get_theme_mod( $panel_name, $section_name, 'heading' );
$sub_heading     = business_class_get_theme_mod( $panel_name, $section_name, 'sub_heading' );
$category        = business_class_get_theme_mod( $panel_name, $section_name, 'select_category' );
$number_of_items = business_class_get_theme_mod( $panel_name, $section_name, 'number_of_items' );

$args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => $number_of_items,
);

if ( ! empty( $category ) ) {
	$args['tax_query'] = array( // phpcs:ignore
		array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => array( $category ),
		),
	);
}

$the_query = new WP_Query( $args );


?>

<aside id="section-testimonial" class="section section-testimonial">
	<div class="container">
		<!-- .section-title-wrap -->
		<div class="inner-wrapper">

			<div class="ws-grid-3">
				<?php
				if ( ! empty( $heading ) || ! empty( $sub_heading ) ) {
					?>
					<div class="section-title-wrap title-alignleft">
						<?php if ( $heading ) { ?>
						<h2 class="section-title"><?php echo esc_html( $heading ); ?></h2>
						<?php } ?>
						<?php if ( $sub_heading ) { ?>
							<p class="section-subtitle"><?php echo esc_html( $sub_heading ); ?></p>
						<?php } ?>
					</div>
					<?php
				}
				?>
			</div>


			<div class="ws-grid-9">
				<div class="testimonial-carousel section-carousel-style">

					<?php
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							get_template_part( 'template-parts/front-page/loops/content', 'testimonials' );
						}
					}
					?>

				</div>
				<!-- .testimonial-carousel-wrapper -->
			</div>
		</div>


	</div>
	<!-- .container -->
</aside>
<!-- .section -->

<?php
wp_reset_postdata();
