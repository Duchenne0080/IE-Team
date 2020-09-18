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
$section_name = 'our_team';

$enable_section = business_class_get_theme_mod( $panel_name, $section_name, 'Enable Section' );

if ( ! $enable_section ) {
	return;
}

$heading     = business_class_get_theme_mod( $panel_name, $section_name, 'heading' );
$sub_heading = business_class_get_theme_mod( $panel_name, $section_name, 'sub_heading' );
$contents    = business_class_get_theme_mod( $panel_name, $section_name, 'contents' );
$teams       = business_class_get_theme_mod( $panel_name, $section_name, 'teams' );

?>

<aside id="section-teams" class="section section-teams">
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

		<!-- .section-title-wrap -->
		<div class="teams-section">
				<div class="inner-wrapper">
				<?php
				if ( 'by_repeater' === $contents ) {

					/**
					 * Using repeater.
					 */
					if ( is_array( $teams ) && count( $teams ) > 0 ) {
						foreach ( $teams as $team ) {
							$staff_name     = ! empty( $team['name'] ) ? $team['name'] : '';
							$staff_position = ! empty( $team['position'] ) ? $team['position'] : '';
							$staff_image    = ! empty( $team['image'] ) ? wp_get_attachment_url( $team['image'] ) : '';
							$social_links   = ! empty( $team['social_links'] ) ? explode( ',', $team['social_links'] ) : '';
							?>
							<div class="ws-grid-3 team-item">

								<div class="thumb-summary-wrap box-shadow">

									<?php if ( ! empty( $staff_image ) ) { ?>
										<div class="team-thumb">
											<a>
												<img alt="Team" src="<?php echo esc_url( $staff_image ); ?>">
											</a>
										</div><!-- .team-thumb-->
									<?php } ?>

									<div class="team-text-wrap top-left-right-radius">

										<?php if ( is_array( $social_links ) && ! empty( $social_links ) ) { ?>
											<div class="social-media brand-color circle">
												<ul>
													<?php foreach ( $social_links as $social_link ) { ?>
														<li>
															<a href="<?php echo esc_url( $social_link ); ?>" rel="noopener noreferrer" target="_blank"></a>
														</li>
													<?php } ?>
												</ul>
											</div><!-- .social-media -->
										<?php } ?>

										<?php
											echo $staff_name ? wp_kses_post( "<h3 class='team-title'><a>{$staff_name}</a></h3>" ) : '';
											echo $staff_position ? wp_kses_post( "<p class='team-position'>{$staff_position}</p>" ) : '';
										?>

									</div><!-- .team-text-wrap -->

								</div><!-- .thumb-summary-wrap -->

							</div><!-- .team-item  -->
							<?php
						}
					}
				} else {
					/**
					 * Using Category posts.
					 */
					$category        = business_class_get_theme_mod( $panel_name, $section_name, 'select_category' );
					$number_of_items = business_class_get_theme_mod( $panel_name, $section_name, 'Number Of Items' );

					$args = array(
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'posts_per_page' => $number_of_items,
						'tax_query'      => array( // phpcs:ignore
							array(
								'taxonomy' => 'category',
								'field'    => 'term_id',
								'terms'    => array( $category ),
							),
						),
					);

					if ( ! empty( $category ) ) {
						$the_query = new WP_Query( $args );
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								get_template_part( 'template-parts/front-page/loops/content', 'our-team' );
							}
						}
						wp_reset_postdata();
					}
				}
				?>
				</div>
				<!-- .inner-wrapper -->
		</div>
		<!-- .teams-section -->
	</div>
	<!-- .container -->
</aside>
<!-- .section -->
