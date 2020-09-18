<?php
/**
 * Template for header top bar.
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$top_header_option = get_theme_mod( 'matina_top_header_option', true );

// return if hide top bar
if ( false === $top_header_option ) {
    return;
}

$top_header_social_option = get_theme_mod( 'matina_top_header_social_option', false );
?>
<div id="mt-topbar" class="mt-topbar-wrapper mt-clearfix">
    <div class="mt-container">
        <div class="topbar-elements-wrapper">
            <?php
                // top bar date
                get_template_part( 'template-parts/partials/header/date' );

                // top bar menu
                get_template_part( 'template-parts/partials/header/top', 'menu' );

                // top bar social
                if ( true === $top_header_social_option ) {
                    matina_social_icons();
                }
            ?>
        </div><!-- .topbar-elements-wrapper -->
    </div><!-- .mt-container -->
</div><!-- #mt-topbar -->