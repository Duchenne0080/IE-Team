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
$section_name = 'contact_us';

$enable_section = business_class_get_theme_mod( $panel_name, $section_name, 'Enable Section' );

if ( ! $enable_section ) {
	return;
}

$heading     = business_class_get_theme_mod( $panel_name, $section_name, 'heading' );
$sub_heading = business_class_get_theme_mod( $panel_name, $section_name, 'sub_heading' );
$contents    = business_class_get_theme_mod( $panel_name, $section_name, 'contents' );

/**
 * Contact Boxes
 */

// Contact details.
$enable_contacts       = business_class_get_theme_mod( $panel_name, $section_name, 'enable_contacts' );
$contact_box_one_title = business_class_get_theme_mod( $panel_name, $section_name, 'contact_box_one_title' );
$contact_fields        = business_class_get_theme_mod( $panel_name, $section_name, 'contact_fields' );

// Opening Hours.
$enable_opening_hours  = business_class_get_theme_mod( $panel_name, $section_name, 'enable_opening_hours' );
$contact_box_two_title = business_class_get_theme_mod( $panel_name, $section_name, 'contact_box_two_title' );
$opening_hours         = business_class_get_theme_mod( $panel_name, $section_name, 'opening_hours' );

?>

<aside id="section-contact" class="section section-contact">
	<div class="container">
		<!-- .section-title-wrap -->
		<div class="inner-wrapper">

			<?php if ( $enable_contacts || $enable_opening_hours ) { ?>
				<div class="ws-grid-6">
					<div class="contact-info">
						<?php if ( $enable_contacts ) { ?>
							<div class="contact-box">
								<?php if ( $contact_box_one_title ) { ?>
									<h3><?php echo esc_html( $contact_box_one_title ); ?></h3>
								<?php } ?>
								<?php
								if ( is_array( $contact_fields ) && ! empty( $contact_fields ) ) {
									?>
									<ul>
										<?php
										foreach ( $contact_fields as $contact_field ) {
											$icon           = ! empty( $contact_field['icon'] ) ? $contact_field['icon'] : '';
											$contact_type   = ! empty( $contact_field['contact_type'] ) ? $contact_field['contact_type'] : '';
											$contact_detail = ! empty( $contact_field['contact_detail'] ) ? $contact_field['contact_detail'] : '';
											?>
											<li>
												<?php
												if ( ! empty( $icon ) ) {
													?>
													<i class="<?php echo esc_attr( $icon ); ?>"></i> <?php echo esc_html( $contact_detail ); ?>
													<?php
												} else {
													echo esc_html( $contact_detail );
												}
												?>
											</li>
											<?php
										}
										?>
									</ul>
									<?php
								}
								?>
							</div>
						<?php } ?>

						<?php if ( $enable_opening_hours ) { ?>
							<div class="contact-box">
								<?php if ( $contact_box_two_title ) { ?>
									<h3><?php echo esc_html( $contact_box_two_title ); ?></h3>
								<?php } ?>
								<?php
								if ( is_array( $opening_hours ) && ! empty( $opening_hours ) ) {
									?>
									<ul>
										<?php
										foreach ( $opening_hours as $opening_hour ) {
											$icon     = ! empty( $opening_hour['icon'] ) ? $opening_hour['icon'] : '';
											$duration = ! empty( $opening_hour['duration'] ) ? $opening_hour['duration'] : '';
											$time     = ! empty( $opening_hour['time'] ) ? $opening_hour['time'] : '';
											?>
											<li class="openinghour">
												<span class="pull-left">
													<?php if ( $icon ) { ?>
														<i class="<?php echo esc_attr( $icon ); ?>"></i> <?php echo esc_html( $duration ); ?>
														<?php
													} else {
														echo esc_html( $duration );
													}
													?>
												</span>
												<span class="pull-right"><?php echo esc_html( $time ); ?></span>
											</li>
											<?php
										}
										?>
									</ul>
									<?php
								}
								?>
							</div>
						<?php } ?>
					</div><!-- .contact-info -->
				</div>
			<?php } ?>

			<div class="ws-grid-6">
				<div class="contact-info-form">

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

					if ( ! empty( $contents ) ) {
						$the_query = new WP_Query( array( 'page_id' => $contents ) );

						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								the_content();
							}
						}

						wp_reset_postdata();
					}

					?>

				</div>
			</div>

		</div>
	</div>
</aside>
<?php
