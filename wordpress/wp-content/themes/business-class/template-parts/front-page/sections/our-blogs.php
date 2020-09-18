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
$section_name = 'our_blogs';

$enable_section = business_class_get_theme_mod( $panel_name, $section_name, 'Enable Section' );

if ( ! $enable_section ) {
	return;
}

$blog_url        = get_post_type_archive_link( 'post' );
$heading         = business_class_get_theme_mod( $panel_name, $section_name, 'heading' );
$sub_heading     = business_class_get_theme_mod( $panel_name, $section_name, 'sub_heading' );
$button_label    = business_class_get_theme_mod( $panel_name, $section_name, 'button_label' );
$number_of_items = business_class_get_theme_mod( $panel_name, $section_name, 'number_of_items' );

$args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => $number_of_items,
	'post__not_in'   => get_option( 'sticky_posts' ), // We need to exclude sticky posts.
);

$the_query = new WP_Query( $args );

?>
<aside id="section-latest-posts" class="section section-latest-posts">
	<div class="container">
		<div class="latest-posts-section">

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

			<div class="inner-wrapper">

				<?php
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						get_template_part( 'template-parts/front-page/loops/content', 'our-blogs' );
					}
				}

				if ( $button_label && $blog_url ) {
					?>
					<div class="more-wrapper clear-fix">
						<a href="<?php echo esc_url( $blog_url ); ?>" class="custom-button "><?php echo esc_html( $button_label ); ?></a>
					</div><!-- .more-wrapper -->
					<?php
				}
				?>

			</div>
			<!-- .inner-wrapper -->
		</div>
		<!-- .container -->
	</div>
	<!-- .latest-posts-section -->
</aside>
<!-- .section -->

<?php
wp_reset_postdata();
