<?php
/**
 * Page banner header part for single page and posts.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$banner_thumbnail = is_singular() && has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : get_header_image();

do_action( 'business_class_before_page_banner' );

?>

<div id="custom-header" style="background: url(<?php echo esc_url( $banner_thumbnail ); ?>);">

	<div class="custom-header-content">

		<div class="container">
			<?php

			business_class_get_banner_title( '<h1 class="page-title">', '</h1>' );

			if ( 'post' === get_post_type() && is_singular() ) :
				?>
				<div class="entry-meta">
					<?php
					business_class_posted_on();
					business_class_posted_by();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>

			<?php

			do_action( 'business_class_before_breadcrumb' );

			business_class_get_breadcrumb();

			do_action( 'business_class_after_breadcrumb' );
			?>

		</div><!-- .container -->

	</div><!-- .custom-header-content -->

</div><!-- #custom-header -->

<?php

do_action( 'business_class_after_page_banner' );
