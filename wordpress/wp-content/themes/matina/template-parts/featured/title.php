<?php
/**
 * Frontpage featured section title.
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_title          = get_theme_mod( 'matina_featured_section_title' );
$featured_cat_layout    = get_theme_mod( 'matina_featured_cat_layout', 'layout-default' );

/**
 * Hook: matina_before_featured_title
 *
 * @since 1.0.0
 */
do_action( 'matina_before_featured_title' );
?>
<div class="section-title-wrapper featured-title ">
    <?php
        if ( ! empty( $section_title ) ) {
            echo '<h2 class="section-title">'. wp_kses_post( $section_title ) .'</h2>';
        }
    ?>
</div><!-- .section-title-wrapper -->
<?php
/**
 * Hook: matina_after_featured_title
 *
 * @since 1.0.0
 */
do_action( 'matina_after_featured_title' );