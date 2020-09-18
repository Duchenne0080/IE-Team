<?php
/**
 * Partial template for single post entry comments.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * matina_before_single_entry_comments hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_comments' );

// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) :
    comments_template();
endif;

/**
 * matina_after_single_entry_comments hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_entry_comments' );