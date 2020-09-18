<?php
/**
 * Partial template for archive posts entry thumbnail.
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

// post permalink for featured image
$post_permalink_option = get_theme_mod( 'matina_image_permalink_option', true );

/**
 * matina_before_archive_entry_thumbnail hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_archive_entry_thumbnail' );
?>

<div class="entry-thumbnail archive-entry-thumbnail mt-clearfix">
    <figure class="post-thumb post-bg-image cover-image <?php echo matina_get_image_hover_class(); ?>">
        <?php if ( false !== $post_permalink_option ) { ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php } ?>
            <?php the_post_thumbnail( $image_size, $image_args ); ?>
        <?php if ( false !== $post_permalink_option ) { ?>
            </a>
        <?php } ?>
        <?php if ( ! empty( $image_caption ) ) { ?>
            <span class="post-thumb-caption"><?php echo wp_kses_post( $image_caption ); ?></span>
        <?php } ?>
    </figure>
</div><!-- .entry-thumbnail -->

<?php
/**
 * matina_after_archive_entry_thumbnail hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_archive_entry_thumbnail' );
