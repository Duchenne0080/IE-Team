<?php
/**
 * Section file for frontpage > Price table section.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$display = business_class_get_theme_mod( 'static_front_page', 'static_front_page', 'display_static_content' );

if ( have_posts() && $display ) {
	while ( have_posts() ) {
		the_post();
		?>
		<aside id="section-static-content" class="section" style="background: url(<?php the_post_thumbnail_url( 'full' ); ?>);">
			<div class="section-static-content">
				<div class="container">

					<div class="section-title-wrap">
						<?php
						the_title( '<h2 class="section-title">', '</h2>' );
						?>
					</div>

					<div class="static-contents-wrapper">
						<?php the_content(); ?>
					</div>

				</div>
			</div>
		</aside>
		<?php
	}
}
