<?php
/**
 * Partial template for single post entry quote format media.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$featured_image_option = matina_post_format_featured_image_option();

$get_content = apply_filters( 'the_content', get_the_content() );

if ( function_exists( 'register_block_type' ) ) {
    if ( class_exists( 'Classic_Editor' ) ) {
        $quote_string = matina_get_string( $get_content, '<blockquote>','</blockquote>' );
    } else {
        $quote_string = matina_get_string( $get_content, '<blockquote class="wp-block-quote">','</blockquote>' );
    }
} else {
    $quote_string = matina_get_string( $get_content, '<blockquote>','</blockquote>' );
}

/**
 * matina_before_single_entry_thumbnail hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_thumbnail' );
?>

<div class="entry-thumbnail single-entry-thumbnail mt-clearfix">
    <?php
        if ( ! empty( $quote_string ) && true === $featured_image_option ) {
    ?>
        <div class="post-format-media post-format-media--quote">
            <?php echo '<blockquote>'. $quote_string[0] . '</blockquote>'; ?>
        </div><!-- .post-format-media--quote -->
    <?php
        } else {
            // article featured image
            get_template_part( 'template-parts/partials/single/media/entry', 'thumbnail' );
        }
    ?>
</div><!-- .single-entry-thumbnail -->

<?php
/**
 * matina_after_single_entry_thumbnail hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_entry_thumbnail' );
