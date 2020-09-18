<?php
/**
 * Partial template for archive post entry title.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$page_header_title_option = get_theme_mod( 'matina_single_post_enable_page_header', false );

if ( false !== $page_header_title_option ) {
    return;
}

/**
 * matina_before_single_entry_title hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_title' );

?>
    <header class="entry-header single-entry-header mt-clearfix">
        <h1 class="entry-title singe-post-title"<?php matina_schema_markup( 'headline' ); ?>><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
<?php

/**
 * matina_after_single_entry_title hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_entry_title' );