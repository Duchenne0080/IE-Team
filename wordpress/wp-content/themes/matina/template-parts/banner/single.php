<?php
/**
 * Frontpage single banner
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$banner_image = get_theme_mod( 'matina_single_banner_image_url' );

// Generate image URL if using ID
if ( is_numeric( $banner_image ) ) {
    $banner_image = wp_get_attachment_image_src( $banner_image, 'full' );
    $banner_image = $banner_image[0];
}

$banner_image = $banner_image ? $banner_image : null;

// return if single banner image is not available
if ( empty( $banner_image ) ) {
    return;
}

/**
 * Hook: matina_before_single_banner
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_banner' );

$banner_title       = get_theme_mod( 'matina_single_banner_title' );
$banner_description = get_theme_mod( 'matina_single_banner_description' );
$banner_button_label = get_theme_mod( 'matina_banner_button_label', __( 'Read More', 'matina' ) );
$banner_button_link = get_theme_mod( 'matina_banner_button_link' );
?>
    <div class="front-single-banner-wrap mt-clearfix">
        <figure class="banner-image" style="background-image:url( <?php echo esc_url( $banner_image ); ?> )"></figure>
        <div class="banner-content-wrapper mt-clearfix">
            <div class="banner-content mt-clearfix">
                <h2 class="banner-title"><a href="<?php echo esc_url( $banner_button_link ); ?>"><?php echo wp_kses_post( $banner_title ); ?></a></h2>
                <div class="banner-description banner-content"><?php echo wp_kses_post( $banner_description ); ?></div>
            </div><!-- .banner-content -->
            <?php
                if ( ! empty( $banner_button_label ) ) {
            ?>
                    <div class="button-wrapper mt-clearfix">
                        <a class="mt-button banner-button" href="<?php echo esc_url( $banner_button_link ); ?>"><?php echo esc_html( $banner_button_label ); ?></a>
                    </div><!-- .button-wrapper -->
            <?php
                }
            ?>
        </div><!-- .banner-content-wrapper -->
    </div><!-- .front-single-banner-wrap -->
<?php
/**
 * Hook: matina_after_single_banner
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_banner' );