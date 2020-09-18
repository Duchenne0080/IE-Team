<?php
/**
 * Partial template for single post entry video format media.
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
$get_video   = get_media_embedded_in_content( $get_content, array( 'video', 'object', 'embed', 'iframe' ) );

/**
 * matina_before_single_entry_thumbnail hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_thumbnail' );
?>

<div class="entry-thumbnail single-entry-thumbnail mt-clearfix">
    <?php
        if ( ! empty( $get_video ) && true === $featured_image_option ) {
    ?>
        <div class="post-format-media post-format-media-video">
            <div class="post-format-video">
                <?php echo wp_kses_post( $get_video[0] ); // WPCS xss ok. ?>
            </div>
        </div> <!-- .post-format-media post-format-media-video -->
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
