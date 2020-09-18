<?php
/**
 * Default layout template for the header top bar.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$panel_name   = 'theme_options';
$section_name = 'top_bar';

$enable_section = business_class_get_theme_mod( $panel_name, $section_name, 'Enable Top Bar' );

if ( ! $enable_section ) {
	return;
}

$address        = business_class_get_theme_mod( $panel_name, $section_name, 'address' );
$email          = business_class_get_theme_mod( $panel_name, $section_name, 'email' );
$contact_number = business_class_get_theme_mod( $panel_name, $section_name, 'contact_number' );
$social_links   = business_class_get_theme_mod( $panel_name, $section_name, 'social_links' );


?>
<header class="header-top">
	<div class="container">
		<div class="header-top-wrapper">


			<?php if ( $address || $email || $contact_number ) { ?>
				<ul class="contact-info">
					<?php if ( $address ) { ?>
						<li>
							<a href="javascript:void(0);">
								<i class="fas fa-map-marker-alt"></i>
								<span><?php echo esc_html( $address ); ?></span>
							</a>
						</li>
					<?php } ?>
					<?php if ( $email ) { ?>
						<li>
							<a href="javascript:void(0);">
								<i class="far fa-envelope"></i>
								<span><?php echo esc_html( $email ); ?></span>
							</a>
						</li>
					<?php } ?>
					<?php if ( $contact_number ) { ?>
					<li>
						<a href="javascript:void(0);">
							<i class="fas fa-phone"></i>
							<span><?php echo esc_html( $contact_number ); ?></span>
						</a>
					</li>
					<?php } ?>
				</ul>
			<?php } ?>



			<?php if ( is_array( $social_links ) && ! empty( $social_links[0]['social_link'] ) ) { ?>
				<div class="social-media circle">
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
	</div>
</header>
