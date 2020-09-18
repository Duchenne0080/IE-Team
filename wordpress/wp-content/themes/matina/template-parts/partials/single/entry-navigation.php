<?php
/**
 * Partial template for single post entry author box.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post_nav_style     = apply_filters( 'matina_single_posts_navigation_style', 'layout-default' );
$post_nav_taxonomy  = get_theme_mod( 'matina_single_posts_navigation_taxonomy', 'category' );

$extra_class = 'mt-clearfix';

if ( ! empty( $post_nav_style ) ) {
    $extra_class .= ' post-navigation--'.$post_nav_style;
}

$next_post = get_next_post();
$prev_post = get_previous_post();
$prev_text_value = '';
$next_text_value = '';

$prev_text_value = '<span class="title"><i class="fas fa-angle-double-left" aria-hidden="true"></i>'. esc_html__( 'Previous Post', 'matina' ) .'</span><span class="post-title">%title</span>';
$next_text_value = '<span class="title">'. esc_html__( 'Next Post', 'matina' ) .'<i class="fas fa-angle-double-right" aria-hidden="true"></i></span><span class="post-title">%title</span>';

$nav_args = apply_filters( 'matina_single_post_navigation_args',
    array(
        'prev_text'             => $prev_text_value,
        'next_text'             => $next_text_value,
        'in_same_term'          => true,
        'taxonomy'              => $post_nav_taxonomy,
        'screen_reader_text'    => esc_html__( 'Read more articles', 'matina' )
    )
);

/**
 * matina_before_single_entry_navigation hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_navigation' );
?>
<div class="entry-navigation single-post-navigation <?php echo esc_attr( $extra_class ); ?>">
    <?php
        the_post_navigation( $nav_args );
    ?>
</div><!-- .single-post-navigation -->
<?php
/**
 * matina_after_single_entry_navigation hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_entry_navigation' );