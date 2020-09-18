<?php
/**
 * Section file for frontpage > banner slider section.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$header_style = business_class_get_theme_mod( 'Theme Options', 'Header', 'header_style' );

$panel_name   = 'front_page';
$section_name = 'banner_slider';

$enable_section = business_class_get_theme_mod( $panel_name, $section_name, 'Enable Section' );

if ( ! $enable_section ) {
	return;
}

$category        = business_class_get_theme_mod( $panel_name, $section_name, 'Select Category' );
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

<aside class="section no-padding">
	<div class="section-featured-slider layout-light <?php echo esc_attr( $header_style ); ?>">
		<div id="main-slider" class="overlay-enabled featrued-slider normal-carousel">

			<?php
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					get_template_part( 'template-parts/front-page/loops/content', 'banner-slider' );
				}
			}
			?>

		</div>
		<!-- #main-slider -->
	</div>
	<!-- .section-featured-slider -->
</aside>
<!-- .section-featured-slider -->
<?php
wp_reset_postdata();
