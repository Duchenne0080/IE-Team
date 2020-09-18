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
$section_name = 'pre_footer';

$enable_section = business_class_get_theme_mod( $panel_name, $section_name, 'Enable Section' );

if ( ! $enable_section ) {
	return;
}

$social_links_title = business_class_get_theme_mod( $panel_name, $section_name, 'social_links_title' );
$social_links       = business_class_get_theme_mod( $panel_name, $section_name, 'social_links' );

?>

<aside id="newsletter-section" class="section newsletter-section">
	<div class="section-news-letter">
		<div class="container">

			<?php if ( ! empty( $social_links_title ) || ! empty( $social_links[0]['social_link'] ) ) { ?>
				<div class="ws-grid-6 newsletter-text">

					<?php if ( $social_links_title ) { ?>
						<div class="news-letter-title">
							<h3><?php echo esc_html( $social_links_title ); ?></h3>
						</div>
					<?php } ?>

					<?php if ( is_array( $social_links ) && ! empty( $social_links[0]['social_link'] ) ) { ?>
						<div class="social-media brand-color">
							<ul>
							<?php
							foreach ( $social_links as $social_link ) {
								$s_type = ! empty( $social_link['social_link_type'] ) ? $social_link['social_link_type'] : '';
								$s_link = ! empty( $social_link['social_link'] ) ? $social_link['social_link'] : '';

								if ( ! empty( $s_link ) ) {
									?>
									<li>
										<a href="<?php echo esc_url( $s_link ); ?>" title="<?php esc_attr( $s_type ); ?>" rel="noreferrer noopener" target="_blank"><?php echo esc_html( $s_type ); ?></a>
									</li>
									<?php
								}
							}
							?>
							</ul>
						</div><!-- .social-media -->
					<?php } ?>

				</div>
			<?php } ?>

			<?php
			if ( business_class_get_newsletter_form( '', false ) ) {
				$newsletter_title = business_class_get_theme_mod( $panel_name, $section_name, 'newsletter_title' );
				?>
				<div class="ws-grid-6">
					<div class="news-letter-wrapper">
						<?php if ( $newsletter_title ) { ?>
							<div class="news-letter-title">
								<h3><?php echo esc_html( $newsletter_title ); ?></h3>
							</div>
						<?php } ?>
						<?php business_class_get_newsletter_form(); ?>
					</div>
					<!-- .news-letter-wrappers -->
				</div>
				<?php
			}
			?>
		</div>
		<!-- .container -->
	</div>
	<!-- .section-news-letter -->
</aside>
<!-- .section -->
<?php
