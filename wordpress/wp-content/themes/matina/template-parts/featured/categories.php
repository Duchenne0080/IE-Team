<?php
/**
 * Frontpage categories featured section.
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$featured_categories    = get_theme_mod( 'matina_featured_categories' );
$featured_cat_layout    = get_theme_mod( 'matina_featured_cat_layout', 'layout-default' );
$featured_post_count    = apply_filters( 'matina_category_featured_posts_count', 3 );

$featured_args = array(
    'post_type'         => 'post',
    'cat'     => implode( ",", $featured_categories ),
    'posts_per_page'    => intval( $featured_post_count )
);

$featured_query = new WP_Query( $featured_args );

/**
 * Hook: matina_before_category_featured
 *
 * @since 1.0.0
 */
do_action( 'matina_before_category_featured' );

if ( $featured_query->have_posts() ) {
    echo'<div class="featured-items-wrapper featured-category">';
    while ( $featured_query->have_posts() ) {
        $featured_query->the_post();
        $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
?>
        <div class="single-featured-wrap">
            <figure class="featured-image" style="background-image:url( <?php echo esc_url( $featured_image ); ?> )">
            </figure>
            <div class="featured-content-wrapper">
                <?php
                    get_template_part( 'template-parts/partials/archive/entry', 'category' );
                ?>
                <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php matina_posted_on(); ?>
            </div><!-- .featured-content-wrapper -->
        </div><!-- .single-featured-wrap -->
<?php
    }
    echo '</div><!-- .featured-items-wrapper -->';
}
wp_reset_postdata();

/**
 * Hook: matina_after_category_featured
 *
 * @since 1.0.0
 */
do_action( 'matina_after_category_featured' );