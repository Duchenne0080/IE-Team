<?php
/**
 * Partial template for single post entry thumbnail.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! has_post_thumbnail() ) {
    return;
}

// Image size
$image_size = 'full';

// Image args
$image_args = array(
    'alt' => get_the_title(),
);

if ( matina_get_schema_markup( 'image' ) ) {
    $image_args['itemprop'] = 'image';
}

// Image Caption
$image_caption = get_the_post_thumbnail_caption();

/**
 * matina_before_single_entry_thumbnail hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_thumbnail' );
?>

<div class="entry-thumbnail single-entry-thumbnail mt-clearfix">
    <figure class="post-thumb cover-image">
        <?php

            the_post_thumbnail( $image_size, $image_args );

            if ( ! empty( $image_caption ) ) {
        ?>
            <span class="post-thumb-caption"><?php echo wp_kses_post( $image_caption ); ?></span>
        <?php } ?>
    </figure>
</div><!-- .single-entry-thumbnail -->

<?php
/**
 * matina_after_single_entry_thumbnail hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_entry_thumbnail' );
