<?php
/**
 * Template for header layout default
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$social_icon_option = get_theme_mod( 'matina_header_social_option', false );

$layout_class = 'header--layout-default';

?>

<header id="masthead" class="<?php echo esc_attr( matina_header_classes( $layout_class ) ); ?>" <?php matina_schema_markup( 'header' ); ?>>
    <div class="mt-container">
        <div id="header-sticky" class="header-elements-wrapper sticky-elements">

            <div class="header-logo-menu-wrapper left-content">
                <?php

                    // site logo
                    get_template_part( 'template-parts/partials/header/logo' );

                    // primary menu
                    get_template_part( 'template-parts/partials/header/menu' );
                    
                ?>
            </div><!-- .header-logo-menu-wrapper -->

            <div class="social-search-wrapper right-content mt-clearfix">
                <?php
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
            </div><!-- .social-search-wrapper -->
            
        </div><!-- .header-elements-wrapper -->
    </div><!-- .mt-container -->
    <?php
        if ( has_header_image() ) {
            echo '<div class="overlay-header-media"></div>';
        }
    ?>
</header><!-- #masthead -->