<?php
/**
 * Header Menu
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Hook: matina_before_primary_menu
 *
 * @since 1.0.0
 */
do_action( 'matina_before_primary_menu' );

?>

<nav id="site-navigation" class="main-navigation" <?php matina_schema_markup( 'site_navigation' ); ?>>
    <div class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><a href="javascript:void(0);"><i class="fas fa-bars"></i></a></div>
    <div class="primary-menu-wrap">
        <div class="main-menu-close hide" data-focus="#masthead .menu-toggle a"><a href="javascript:void(0);"><i class="far fa-window-close"></i></a></div>
        <?php
            wp_nav_menu( array(
                'theme_location' => 'matina_primary_menu',
                'menu_id'        => 'primary-menu',
            ) );
        ?>
    </div><!-- .primary-menu-wrap -->
</nav><!-- #site-navigation -->

<?php
/**
 * Hook: matina_after_primary_menu
 *
 * @since 1.0.0
 */
do_action( 'matina_after_primary_menu' );