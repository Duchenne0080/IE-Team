<?php
/**
 * Template for footer widget area.
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$widget_option = get_theme_mod( 'matina_footer_widget_area_option', false );

if ( false === $widget_option ) {
    return;
}

if ( ! is_active_sidebar( 'footer-sidebar' ) && ! is_active_sidebar( 'footer-sidebar-2' ) && ! is_active_sidebar( 'footer-sidebar-3' ) && ! is_active_sidebar( 'footer-sidebar-4' ) ) {
    return;
}

$footer_widget_layout = get_theme_mod( 'matina_footer_widget_layout', 'four-columns' );
?>
<div id="footer-widget-area" class="widget-area mt-clearfix <?php echo 'footer-widget--'.esc_attr( $footer_widget_layout ); ?>">
    <div class="mt-container">
        <div class="footer-widget-wrapper">
            <?php
                if ( is_active_sidebar( 'footer-sidebar' ) ) {
                    echo '<div class="footer-widget mt-clearfix">';
                        dynamic_sidebar( 'footer-sidebar' );
                    echo '</div><!-- .footer-widget -->';
                }

                
                if ( is_active_sidebar( 'footer-sidebar-2' ) ) {
                    if ( 'one-column' != $footer_widget_layout ) {
                        echo '<div class="footer-widget mt-clearfix">';
                            dynamic_sidebar( 'footer-sidebar-2' );
                        echo '</div><!-- .footer-widget -->';
                    }
                }

                if ( is_active_sidebar( 'footer-sidebar-3' ) ) {
                    if ( 'one-column' != $footer_widget_layout && 'two-columns' != $footer_widget_layout ) {
                        echo '<div class="footer-widget mt-clearfix">';
                            dynamic_sidebar( 'footer-sidebar-3' );
                        echo '</div><!-- .footer-widget -->';
                    }
                }

                if ( is_active_sidebar( 'footer-sidebar-4' ) ) {
                    if ( 'four-columns' == $footer_widget_layout ) {
                        echo '<div class="footer-widget mt-clearfix">';
                            dynamic_sidebar( 'footer-sidebar-4' );
                        echo '</div><!-- .footer-widget -->';
                    }
                }
            ?>
        </div><!-- footer-widget-wrapper -->
    </div><!-- mt-container -->
</div><!-- #footer-widget-area -->