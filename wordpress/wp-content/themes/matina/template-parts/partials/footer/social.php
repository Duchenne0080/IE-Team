<?php
/**
 * Footer social icons
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Hook: matina_before_footer_social_icons
 *
 * @since 1.0.0
 */
do_action( 'matina_before_footer_social_icons' );


$social_icons_option = get_theme_mod( 'matina_footer_social_option', false );

if ( false === $social_icons_option ) {
    return;
}
?>

<div class="footer-social-icons mt-clearfix">
    <?php matina_social_icons(); ?>
</div>

<?php
/**
 * Hook: matina_after_footer_social_icons
 *
 * @since 1.0.0
 */
do_action( 'matina_after_footer_social_icons' );