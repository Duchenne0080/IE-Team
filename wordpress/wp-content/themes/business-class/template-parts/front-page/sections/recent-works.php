<?php
/**
 * Section file for frontpage > recent work section.
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
$section_name = 'recent_works';

$enable_section = business_class_get_theme_mod( $panel_name, $section_name, 'Enable Section' );

if ( ! $enable_section ) {
	return;
}

$all_terms   = array();
$heading     = business_class_get_theme_mod( $panel_name, $section_name, 'heading' );
$sub_heading = business_class_get_theme_mod( $panel_name, $section_name, 'sub_heading' );
$categories  = business_class_get_theme_mod( $panel_name, $section_name, 'Select Category' );

$args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'tax_query'      => array( // phpcs:ignore
		array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => array(),
		),
	),

);

if ( is_array( $categories ) && ! empty( $categories ) ) {
	foreach ( $categories as $key => $term_id ) {
		$all_terms[ $key ] = get_term_by( 'term_id', $term_id, 'category', ARRAY_A );
		array_push( $args['tax_query'][0]['terms'], $term_id );
	}
}

$the_query = new WP_Query( $args );

?>

<aside class="section">
	<div class="section-portfolio">
		<div class="container">

			<?php
			if ( ! empty( $heading ) || ! empty( $sub_heading ) ) {
				?>
				<div class="section-title-wrap">
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

			<?php if ( is_array( $all_terms ) && ! empty( $all_terms ) ) { ?>

			<!-- .section-title-wrap -->
			<div class="portfolio-main-wrapper">

				<nav class="portfolio-filter">
					<ul>
						<li><a class="current filter" data-filter="*"><span></span> All</a></li>
						<?php
						foreach ( $all_terms as $all_term ) {
							$term_name = ! empty( $all_term['name'] ) ? $all_term['name'] : '';
							$term_slug = ! empty( $all_term['slug'] ) ? $all_term['slug'] : '';
							?>
							<li>
								<a class="filter" data-filter=".<?php echo esc_attr( $term_slug ); ?>"><span></span> <?php echo esc_html( ucfirst( $term_name ) ); ?></a>
							</li>
							<?php
						}
						?>
					</ul>
				</nav>

				<div id="portfolio" class="masonry-wrapper portfolio-container row-fluid wow fadeInUp isotope">

				<?php
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						get_template_part( 'template-parts/front-page/loops/content', 'recent-works' );
					}
				}
				?>

				</div>

			</div>
			<!-- .portfolio-main-wrapper -->

			<?php } ?>

		</div>
		<!-- .container -->
	</div>
	<!-- .section-portfolio -->
</aside>
<!-- .section -->

<?php
wp_reset_postdata();
