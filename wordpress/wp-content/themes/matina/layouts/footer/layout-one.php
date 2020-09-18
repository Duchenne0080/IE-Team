<?php
/**
 * Template for footer layout one.
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$custom_class = 'site-footer footer--layout-one mt-clearfix';
$custom_class .= matina_get_footer_classes();
?>
<footer id="colophon" class="<?php echo esc_attr( $custom_class ); ?>" <?php matina_schema_markup( 'footer' ); ?>>
    
    <?php
        // footer widget area
        get_template_part( 'template-parts/partials/footer/widget', 'area' );
    ?>

    <div id="bottom-area" class="footer-bottom-wrapper mt-clearfix">
        <div class="mt-container">
            <div class="bottom-elements-wrapper mt-clearfix">
                <?php
                    // footer menu
                    get_template_part( 'template-parts/partials/footer/menu' );

                    // footer social icons
                    get_template_part( 'template-parts/partials/footer/social' );

                    // footer site info
                    get_template_part( 'template-parts/partials/footer/copyright' );
                ?>
            </div><!-- .bottom-elements-wrapper -->
        </div><!-- .mt-container -->
    </div><!-- #bottom-area -->

    <?php
        matina_footer_overlay();
    ?>
    
</footer><!-- #colophon -->
