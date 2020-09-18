<?php
/**
 * Search Icon
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$search_option = get_theme_mod( 'matina_header_search_option', true );
if ( false === $search_option ) {
    return;
}

/**
 * Hook: matina_before_header_search
 *
 * @since 1.0.0
 */
do_action( 'matina_before_header_search' );
?>

<div class="header-search-wrapper">
    <span class="search-icon"><a href="javascript:void(0)"><i class="fa fa-search"></i></a></span>
    <div class="search-form-wrap">
        <div class="mt-container">
            <span class="search-close" data-focus=".header-search-wrapper .search-icon a"><a href="javascript:void(0)"><i class="fa fa-times"></i></a></span>
            <?php get_search_form(); ?>
        </div><!-- .mt-container -->
    </div><!-- .search-form-wrap -->
</div><!-- .header-search-wrapper -->

<?php
/**
 * Hook: matina_after_header_search
 *
 * @since 1.0.0
 */
do_action( 'matina_after_header_search' );