<?php
/**
 * This file has the callback functions for the theme metaboxes.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'business_class_metabox_select_fa_icon_cb' ) ) {

	/**
	 * Callback function for Content Icon.
	 */
	function business_class_metabox_select_fa_icon_cb() {
		$fa_classes     = business_class_get_fa_classes();
		$nonce_field    = 'business_class_metabox_nonce_' . get_the_ID();
		$selected_value = business_class_get_post_meta( get_the_ID(), 'fa_icon' );
		?>
		<div class="container">
			<p class="description">
				<?php esc_html_e( 'Select an Icon for your frontpage "Why Choose Us" section.', 'business-class' ); ?>
			</p>
			<select class="business-class-select" name="business_class_metabox[fa_icon]">
				<?php
				if ( is_array( $fa_classes ) && count( $fa_classes ) > 0 ) {
					foreach ( $fa_classes as $fa_class => $fa_label ) {
						$selected = selected( $selected_value, $fa_class, false );
						echo "<option {$selected} value='{$fa_class}'>{$fa_label}</option>"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				}
				?>
			</select>
			<?php wp_nonce_field( "{$nonce_field}_action", $nonce_field ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'business_class_metabox_team_social_link_cb' ) ) {

	/**
	 * Callback function for Team Details.
	 */
	function business_class_metabox_team_social_link_cb() {
		$nonce_field  = 'business_class_metabox_nonce_' . get_the_ID();
		$social_links = business_class_get_post_meta( get_the_ID(), 'team_social_link' );

		?>
		<div class="container">
			<p class="description">
				<?php esc_html_e( 'Enter staff social links separated with comma. ex: facebook.com/john-doe, instagram.com/john-doe', 'business-class' ); ?>
			</p>
			<textarea name="business_class_metabox[team_social_link]" rows="4"><?php echo esc_html( $social_links ); ?></textarea>
			<?php wp_nonce_field( "{$nonce_field}_action", $nonce_field ); ?>
		</div>
		<?php
	}
}


if ( ! function_exists( 'business_class_metabox_reviewer_post_cb' ) ) {

	/**
	 * Callback function for Team Details.
	 */
	function business_class_metabox_reviewer_post_cb() {
		$nonce_field   = 'business_class_metabox_nonce_' . get_the_ID();
		$reviewer_post = business_class_get_post_meta( get_the_ID(), 'reviewer_post' );
		?>
		<div class="container">
			<p class="description">
				<?php esc_html_e( 'Enter your testimonial provider post.', 'business-class' ); ?>
			</p>
			<input type="text" name="business_class_metabox[reviewer_post]" value="<?php echo esc_attr( $reviewer_post ); ?>" placeholder="<?php esc_attr_e( ' Ex: CEO and Founder', 'business-class' ); ?>">
			<?php wp_nonce_field( "{$nonce_field}_action", $nonce_field ); ?>
		</div>
		<?php
	}
}
