<?php
/**
 * Partial template for archive posts entry content.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post_content_type      = get_theme_mod( 'matina_archive_post_content_type', 'excerpt' );
$post_excerpt_lenght    = get_theme_mod( 'matina_archive_excerpt_lenght', 50 );

/**
 * matina_before_archive_entry_content hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_archive_entry_content' );
?>

<div class="entry-content archive-entry-summary mt-clearfix">
    <?php the_excerpt(); ?>
</div><!-- .entry-content -->

<?php
/**
 * matina_after_archive_entry_content hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_archive_entry_content' );
