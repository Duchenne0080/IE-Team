<?php
/**
 * Partial template for single post entry comments.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$related_posts_options = get_theme_mod( 'matina_single_posts_related_posts_option', true );

if ( true !== $related_posts_options ) {
    return;
}

$related_section_title  = get_theme_mod( 'matina_single_related_title', __( 'You May Like', 'matina' ) );
$posts_column           = apply_filters( 'matina_single_related_posts_columns', 3 );
$row_count              = apply_filters( 'matina_single_related_posts_rows', 1 );
$related_taxonomy       = apply_filters( 'matina_single_posts_related_taxonomy', 'category' );
$related_layout         = apply_filters( 'matina_single_posts_related_layout', 'layout-default' );

$extra_class = 'related-posts-wrapper mt-clearfix';

if ( ! empty( $related_layout ) ) {
    $extra_class .= ' related-posts--'.$related_layout;
}

if ( ! empty( $posts_column ) ) {
    $extra_class .= ' column-'.$posts_column;
}

// Create an array of current term ID's
$get_terms     = wp_get_post_terms( get_the_ID(), $related_taxonomy );
$terms_ids = array();
foreach( $get_terms as $get_term ) {
    $terms_ids[] = $get_term->term_id;
}

// total post count
$post_count = $posts_column * $row_count;

$related_args = array(
    'post_type'         => 'post',
    'posts_per_page'    => absint( $post_count ),
    'orderby'           => 'rand',
    'post__not_in'      => array( get_the_ID() ),
    'no_found_rows'     => true,
    'tax_query'         => array (
        'relation'      => 'AND',
        array (
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => array( 'post-format-quote', 'post-format-link' ),
            'operator' => 'NOT IN',
        ),
    )
);

if ( 'post_tag' === $related_taxonomy ) {
    $related_args['tag__in'] = $terms_ids;
} else {
    $related_args['category__in'] = $terms_ids;
}

$related_query = new WP_Query( $related_args );

/**
 * matina_before_single_entry_related_posts hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_related_posts' );
?>
    <div id="single-related-posts" class="<?php echo esc_attr( $extra_class ); ?>">
        <?php
            if ( ! empty( $related_section_title ) ) {
                echo '<div class="section-title"><h2 class="related-section-title">'. esc_html( $related_section_title ) .'</h2></div>';
            }

            if ( $related_query->have_posts() ) {
                while ( $related_query->have_posts() ) {
                    $related_query->the_post();
                    $post_image = get_the_post_thumbnail_url();
                    $extra_class = 'single-post-wrapper related-post mt-clearfix';
                    if ( ! has_post_thumbnail() ) {
                        $extra_class .= ' has-no-image';
                    }
        ?>
                    <article class="<?php echo esc_attr( $extra_class ); ?>">
                        <figure class="post-thumb post-bg-image cover-image" style="background-image:url( <?php echo esc_url( $post_image ); ?> )">
                        </figure>
                        <div class="post-content-wrapper">
                            <?php
                                if ( 'layout-one' === $related_layout ) {
                                    $categories_list = get_the_category_list( esc_html__( ', ', 'matina' ) );
                                    if ( $categories_list ) {
                                        echo '<span class="cat-links">'. wp_kses_post( $categories_list ) .'</span>';
                                    }
                                }
                            ?>
                            <h3 class="related-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                            <?php
                                if ( 'layout-two' === $related_layout ) {
                                    $categories_list = get_the_category_list( esc_html__( ', ', 'matina' ) );
                                    if ( $categories_list ) {
                                        echo '<span class="cat-links">'. wp_kses_post( $categories_list ) .'</span>';
                                    }

                                    // article posted on
                                    matina_posted_on();
                                }
                            ?>
                        </div><!-- .post-content-wrapper -->
                    </article><!-- .single-post-wrapper -->
        <?php
                }
            }
            wp_reset_postdata();
        ?>

    </div><!-- #single-related-posts -->
<?php
/**
 * matina_after_single_entry_related_posts hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_entry_related_posts' );