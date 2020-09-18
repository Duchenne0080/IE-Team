<?php
/**
 * Template for header layout one
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$social_icon_option = get_theme_mod( 'matina_header_social_option', false );

$layout_class = 'header--layout-one';
?>

<header id="masthead" class="<?php echo esc_attr( matina_header_classes( $layout_class ) ); ?>">
    <div class="mt-container">
        <div class="header-elements-wrapper">

            <div class="header-logo-wrapper mt-clearfix">
                <?php
                    // site logo
                    get_template_part( 'template-parts/partials/header/logo' );
                ?>
            </div><!-- .header-logo-wrapper -->

            <div id="header-sticky" class="header-menu-icons-wrapper sticky-elements">
                <?php
                    // primary menu
                    get_template_part( 'template-parts/partials/header/menu' );


                    if ( true === $social_icon_option ) {
                ?>
                        <div class="header-social-wrapper">
                            <?php
                                $social_label = get_theme_mod( 'matina_header_social_label', __( 'Follow Us: ', 'matina' ) );
                                if ( ! empty( $social_label ) ) {
                                    echo '<span class="social-label">'. esc_html( $social_label ) .'</span>';
                                }
                                
                                // social icons
                                matina_social_icons();
                            ?>
                        </div><!-- .header-social-wrapper -->
                <?php
                    }

                    // search form
                    get_template_part( 'template-parts/partials/header/search' );
                ?>
            </div><!-- .header-menu-icons-wrapper -->
            
        </div><!-- .header-elements-wrapper -->
    </div><!-- .mt-container -->
    <?php
        if ( has_header_image() ) {
            echo '<div class="overlay-header-media"></div>';
        }
    ?>
</header><!-- #masthead -->