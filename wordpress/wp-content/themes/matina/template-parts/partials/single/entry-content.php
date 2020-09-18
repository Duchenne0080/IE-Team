<?php
/**
 * Partial template for single post entry content.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * matina_before_single_entry_content hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_content' );
?>

<div class="entry-content single-entry-summary mt-clearfix" <?php matina_schema_markup( 'entry_content' ); ?>>
    <?php
        the_content();

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'matina' ),
            'after'  => '</div>',
        ) );
    ?>
</div><!-- .single-entry-summary -->

<?php
/**
 * matina_after_single_entry_content hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_entry_content' );