<?php
/**
 * This is the call to action section file for the frontpage.
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
$section_name = 'call_to_action';

$enable_section = business_class_get_theme_mod( $panel_name, $section_name, 'Enable Section' );

if ( ! $enable_section ) {
	return;
}

$content      = business_class_get_theme_mod( $panel_name, $section_name, 'Content' );
$button_label = business_class_get_theme_mod( $panel_name, $section_name, 'button_label' );

$the_query = new WP_Query(
	array(
		'page_id' => $content,
	)
);


if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		?>
		<!-- Call to action -->
		<aside class="section cta-section" style="background-image:url(<?php the_post_thumbnail_url(); ?>);">
			<div class="container">
				<div class="cta-inner-wrapper">
					<?php

					the_title(
						'<h2 class="cta-title">',
						'</h2>'
					);

					the_content();
					?>
					<a href="<?php the_permalink(); ?>" class="custom-button"><?php echo esc_html( $button_label ); ?></a>
				</div>
			</div>
		</aside>
		<!-- End of Call to action -->
		<?php
	}
}
wp_reset_postdata();
