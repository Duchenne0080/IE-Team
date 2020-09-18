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

$heading_tag = get_theme_mod( 'matina_archive_posts_heading_tag', 'h2' );

/**
 * matina_before_archive_entry_title hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_archive_entry_title' );

?>
    <header class="entry-header archive-entry-header mt-clearfix">
        <<?php echo esc_attr( $heading_tag ) ;?> class="entry-title cover-font"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></<?php echo esc_attr( $heading_tag ); ?>>
    </header><!-- .entry-header -->
<?php

/**
 * matina_after_archvie_entry_title hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_archvie_entry_title' );