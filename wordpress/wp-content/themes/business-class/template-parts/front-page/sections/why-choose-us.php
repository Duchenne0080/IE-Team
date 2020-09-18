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

$panel_name   = 'front_page';
$section_name = 'why_choose_us';

$enable_section = business_class_get_theme_mod( $panel_name, $section_name, 'Enable Section' );

if ( ! $enable_section ) {
	return;
}

$content_box     = array();
$heading         = business_class_get_theme_mod( $panel_name, $section_name, 'heading' );
$sub_heading     = business_class_get_theme_mod( $panel_name, $section_name, 'sub_heading' );
$content_type    = business_class_get_theme_mod( $panel_name, $section_name, 'Content Type' );
$number_of_items = business_class_get_theme_mod( $panel_name, $section_name, 'number_of_items' );


if ( 'by_category' === $content_type ) {
	$category = business_class_get_theme_mod( $panel_name, $section_name, 'Select Category' );

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

	if ( $the_query->have_posts() ) {
		$index = 0;
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$content_box[ $index ] = array(
				'title'   => get_the_title(),
				'content' => get_the_excerpt(),
				'link'    => get_the_permalink(),
				'icon'    => business_class_get_post_meta( get_the_ID(), 'fa_icon' ),
			);
			$index++;
		}
	}

	wp_reset_postdata();

} elseif ( 'manual_entry' === $content_type ) {
	$content_box = business_class_get_theme_mod( $panel_name, $section_name, 'Contents Box' );
}

?>

<aside id="section-services" class="section">
	<div class="section-services">
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


			<?php if ( is_array( $content_box ) && ! empty( $content_box ) ) { ?>
				<div class="service-block-list section-boxed clear-fix">
					<div class="inner-wrapper">
						<?php foreach ( $content_box as $content_values ) { ?>
							<?php
								$box_title   = ! empty( $content_values['title'] ) ? $content_values['title'] : '';
								$box_link    = ! empty( $content_values['link'] ) ? esc_url( $content_values['link'] ) : '';
								$box_content = ! empty( $content_values['content'] ) ? $content_values['content'] : '';
								$box_icon    = ! empty( $content_values['icon'] ) ? $content_values['icon'] : '';
							?>
							<div class="ws-grid-4 service-block-item">
								<div class="service-block-inner">

									<?php
									if ( ! empty( $box_icon ) ) {
										if ( ! empty( $box_link ) ) {
											echo wp_kses_post( "<a class='service-icon' href='{$box_link}' ><i class='{$box_icon}'></i></a>" );
										} else {
											echo wp_kses_post( "<a class='service-icon'><i class='{$box_icon}'></i></a>" );
										}
									}
									?>

									<div class="service-block-inner-content">

										<?php if ( ! empty( $box_title ) ) { ?>
											<h3 class="service-item-title">
												<?php
												if ( ! empty( $box_link ) ) {
													echo wp_kses_post( "<a href='{$box_link}'>{$box_title}</a>" );
												} else {
													echo esc_html( $box_title );
												}
												?>
											</h3>
										<?php } ?>

										<div class="service-block-item-excerpt">
											<?php
											if ( ! empty( $box_content ) ) {
												echo wp_kses_post( "<p>{$box_content}</p>" );
											}

											if ( ! empty( $box_link ) ) {
												?>
												<a href="<?php echo esc_url( $box_link ); ?>" class="more-link" tabindex="0">
													<?php esc_html_e( 'Know More', 'business-class' ); ?>
												</a>
											<?php } ?>
										</div><!-- .service-block-item-excerpt -->

									</div>
									<!-- .service-block-inner-content -->
								</div>
								<!-- .service-block-inner -->
							</div>
						<?php } ?>
						</div>
						<!-- .inner-wrapper -->
					</div>
					<!-- .service-block-list -->
			<?php } ?>
		</div>
		<!-- .container -->
	</div>
	<!-- .section-services  -->
</aside>
<!-- .section -->

<?php
