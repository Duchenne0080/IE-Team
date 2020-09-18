<?php
/**
 * Footer Menu
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Hook: matina_before_footer_menu
 *
 * @since 1.0.0
 */
do_action( 'matina_before_footer_menu' );

?>

<nav id="footer-navigation" class="footer-navigation mt-clearfix">
    <?php
        wp_nav_menu( array(
            'theme_location'    => 'matina_footer_menu',
            'menu_id'           => 'footer-menu',
            'depth'             => 1,
            'fallback_cb'       => false
        ) );
    ?>
</nav><!-- #footer-navigation -->

<?php
/**
 * Hook: matina_after_footer_menu
 *
 * @since 1.0.0
 */
do_action( 'matina_after_footer_menu' );