<?php
/**
 * Loop file for Our teams.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$social_link_strings = business_class_get_post_meta( get_the_ID(), 'team_social_link' );
$social_links        = ! empty( $social_link_strings ) ? explode( ',', $social_link_strings ) : '';

?>
<div <?php post_class( 'ws-grid-3 team-item' ); ?>>
	<div class="thumb-summary-wrap box-shadow">

		<?php if ( has_post_thumbnail() ) { ?>
			<div class="team-thumb">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'large' ); ?>
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
			the_title(
				'<h3 class="team-title"><a href="' . esc_url( get_the_permalink() ) . '">',
				'</a></h3>'
			);

			the_content();

			?>

		</div><!-- .team-text-wrap -->

	</div>
	<!-- .team-item -->
</div><!-- .team-item  -->
