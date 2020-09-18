<?php
/**
 * Partial template for single post entry gallery format media.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$featured_image_option = matina_post_format_featured_image_option();

$get_post_id    = get_the_ID();
$gallery        = get_post_gallery( $get_post_id, false );
if ( function_exists( 'register_block_type' ) ) {
    if ( class_exists( 'Classic_Editor' ) ) {
        if ( ! empty( $gallery ) ) {
            $gallery_attachment_ids = explode( ',', $gallery['ids'] );
        } else {
            $gallery_attachment_ids = '';
        }
    } else {
        $post_blocks = parse_blocks( $post->post_content );
        $embed_count = 1;
        foreach ( $post_blocks as $key => $value ) {
            if ( 'core/gallery' === $value['blockName'] && 1 === $embed_count ) {
                $gallery_attachment_ids = $value['attrs']['ids'];
                $embed_count++;
            }
            
        }
    }
} elseif ( !empty( $gallery ) ) {
    $gallery_attachment_ids = explode( ',', $gallery['ids'] );
} else {
    $gallery_attachment_ids = '';
}

$thumbnail_size = 'full';

/**
 * matina_before_single_entry_thumbnail hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_thumbnail' );
?>

<div class="entry-thumbnail single-entry-thumbnail mt-clearfix">
    <?php
        if ( ! empty( $gallery_attachment_ids ) && true === $featured_image_option ) {
    ?>
            <div class="post-format-media post-format-gallery post-format-media--gallery">
                <div class="mt-gallery-slider">
                    <?php foreach ( $gallery_attachment_ids as $gallery_attachment_id ) { ?>
                        <li>
                            <?php echo wp_get_attachment_image( $gallery_attachment_id, $thumbnail_size ); // WPCS xss ok. ?>
                        </li>
                    <?php } ?>
                </div><!-- .mt-gallery-slider -->
            </div><!-- .post-format-gallery -->
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
