<?php
/**
 * Footer site info
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Hook: matina_before_site_info
 *
 * @since 1.0.0
 */
do_action( 'matina_before_site_info' );

?>

<div class="site-info mt-clearfix">
    <?php
        $copyright_text = get_theme_mod( 'matina_copyright_text', __( 'copyright 2020. All Rights Reserved.', 'matina' ) );

        if ( ! empty( $copyright_text ) ) {
            echo esc_html( $copyright_text );
        }
    ?>
        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'matina' ) ); ?>">
            <?php
            /* translators: %s: CMS name, i.e. WordPress. */
            printf( esc_html__( 'Proudly powered by %s', 'matina' ), 'WordPress' );
            ?>
        </a>
        <span class="sep"> | </span>
        <?php
        $designer_url = 'https://mysterythemes.com';
        /* translators: 1: Theme name, 2: Theme author. */
        printf( esc_html__( 'Theme: %1$s by %2$s.', 'matina' ), 'Matina', '<a href="'. esc_url( $designer_url ) .'" rel="designer">Mystery Themes</a>' );
        ?>
</div><!-- .site-info -->

<?php
/**
 * Hook: matina_after_site_info
 *
 * @since 1.0.0
 */
do_action( 'matina_after_site_info' );