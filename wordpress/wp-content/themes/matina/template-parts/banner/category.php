<?php
/**
 * Frontpage category banner
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$banner_category = get_theme_mod( 'matina_banner_category' );

if ( empty( $banner_category ) ) {
    return;
}

$banner_post_count      = get_theme_mod( 'matina_category_banner_posts_count', 3 );
$banner_button_lable    = get_theme_mod( 'matina_banner_button_label', __( 'Read More', 'matina' ) );

/**
 * Hook: matina_before_category_banner
 *
 * @since 1.0.0
 */
do_action( 'matina_before_category_banner' );

$banner_args = array(
    'post_type'         => 'post',
    'cat'               => intval( $banner_category ),
    'posts_per_page'    => intval( $banner_post_count ),
    'meta_query'        => array(
        array(
            'key' => '_thumbnail_id'
        )
    )
);

$banner_query = new WP_Query( $banner_args );

if ( $banner_query->have_posts() ) {
?>
    <div class="front-category-banner-wrap bannerSlide cS-hidden mt-clearfix" <?php echo matina_slider_custom_options(); ?>>
        <?php
            while ( $banner_query->have_posts() ) {
                $banner_query->the_post();
                $banner_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        ?>
                <div class="single-banner-wrap">
                    <figure class="banner-image" style="background-image:url( <?php echo esc_url( $banner_image_url ); ?> )"></figure>
                    <div class="banner-content-wrapper mt-clearfix">
                        <div class="banner-content mt-clearfix">
                            <h2 class="banner-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="banner-description banner-content"><?php the_excerpt(); ?></div>
                        </div><!-- .banner-content -->
                        <?php if ( ! empty( $banner_button_lable ) ) { ?>
                            <div class="button-wrapper mt-clearfix">
                                <a class="mt-button banner-button" href="<?php the_permalink(); ?>"><?php echo esc_html( $banner_button_lable ); ?></a>
                            </div><!-- .button-wrapper -->
                        <?php } ?>
                    </div><!-- .banner-content-wrapper -->
                </div><!-- .single-banner-wrap -->
        <?php
            }
        ?>
    </div><!-- .front-category-banner-wrap -->
<?php
}
wp_reset_postdata();

/**
 * Hook: matina_after_category_banner
 *
 * @since 1.0.0
 */
do_action( 'matina_after_category_banner' );