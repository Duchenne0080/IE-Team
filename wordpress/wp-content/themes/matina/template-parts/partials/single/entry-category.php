<?php
/**
 * Partial template for single post entry category.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// return if post are not from default post type.
if ( 'post' != get_post_type() ) {
    return;
}

/**
 * matina_before_single_entry_category hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_category' );

/* translators: used between list items, there is a space after the comma */
$categories_list = get_the_category_list();
if ( $categories_list ) {
    /* translators: 1: list of categories. */
    //printf( '<span class="cat-links">' . esc_html__( ' %1$s', 'matina' ) . '</span>', $categories_list ); // WPCS: XSS OK.
?>
    <span class="cat-links"><?php echo wp_kses_post( $categories_list ); ?></span>
<?php
}

/**
 * matina_after_single_entry_category hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_entry_category' );