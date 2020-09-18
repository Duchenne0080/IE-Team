<?php
/**
 * Partial template for single post entry tags.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * matina_before_single_entry_tags hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_tags' );
?>

<div class="entry-tags single-entry-tags mt-clearfix">
    <?php
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list();
        $single_post_layout = get_theme_mod( 'matina_single_posts_layout', 'layout-default' );
        if ( $tags_list && 'layout-default' == $single_post_layout ) {
            /* translators: 1: list of tags. */
            printf( '<span class="tags-links">' . esc_html__( 'Tags %1$s', 'matina' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        } else {
            echo '<span class="tags-links">'. wp_kses_post( $tags_list ) .'</span>';
        }
    ?>
</div><!-- .single-entry-tags -->

<?php
/**
 * matina_after_single_entry_tags hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_entry_tags' );