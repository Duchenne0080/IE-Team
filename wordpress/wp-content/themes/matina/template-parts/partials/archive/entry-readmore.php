<?php
/**
 * Partial template for archive posts entry readmore.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$readmore_text = get_theme_mod( 'matina_archive_readmore_label', __( 'Read More', 'matina' ) );

/**
 * matina_before_archive_entry_readmore hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_archive_entry_readmore' );

?>
<div class="entry-readmore archive-entry-readmore mt-clearfix">
    <a class="mt-button" href="<?php the_permalink(); ?>"><?php echo esc_html( $readmore_text ); ?></a>
</div><!-- .entry-readmore -->
<?php
/**
 * matina_after_archive_entry_readmore hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_archive_entry_readmore' );