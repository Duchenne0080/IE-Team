<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Matina
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'matina_skip_content' ) ) :

    /**
     * Skip to content
     *
     * @since 1.0.0
     */
    function matina_skip_content() {
        echo '<a class="skip-link screen-reader-text" href="#content">'. esc_html__( 'Skip to content', 'matina' ) .'</a>';
    }

endif;

add_action( 'matina_before_header', 'matina_skip_content', 10 );

if ( ! function_exists( 'matina_top_header' ) ) :

    /**
     * Display top header
     *
     * @since 1.0.0
     */
    function matina_top_header() {

        get_template_part( 'template-parts/partials/header/top', 'bar' );
    }

endif;

add_action( 'matina_header_section', 'matina_top_header', 10 );

if ( ! function_exists( 'matina_main_header' ) ) :

    /**
     * Display main header
     *
     * @since 1.0.0
     */
    function matina_main_header() {
        $header_layout = get_theme_mod( 'matina_header_layout', 'layout-default' );
        switch ( $header_layout ) {
            case 'layout-one':
                get_template_part( 'layouts/header/layout', 'one' );
                break;
            
            default:
                get_template_part( 'layouts/header/layout', 'default' );
                break;
        }
    }

endif;

add_action( 'matina_header_section', 'matina_main_header', 20 );

if ( ! function_exists( 'matina_banner_section' ) ) :

    /**
     * Display front page banner section
     *
     * @since 1.0.0
     */
    function matina_banner_section() {
        $banner_option = get_theme_mod( 'matina_homepage_banner_option', true );
        if ( false === $banner_option ) {
            return;
        }
        $section_class  = 'mt-front-banner-wrapper mt-clearfix';
        $banner_layout  = get_theme_mod( 'matina_banner_layout', 'layout-default' );
        $banner_type    = get_theme_mod( 'matina_banner_type', 'single' );

        if ( ! empty( $banner_layout ) ) {
            $section_class .= ' banner-'.$banner_layout;
        }
?>
        <div id="banner-section" class="<?php echo esc_attr( $section_class ); ?>">
            <?php
                if ( 'layout-default' !== $banner_layout ) {
                    echo '<div class="mt-container">';
                }
                switch ( $banner_type ) {
                    case 'category':
                        //category banner
                        get_template_part( 'template-parts/banner/category' );
                        break;
                    
                    default:
                        //single banner
                        get_template_part( 'template-parts/banner/single' );
                        break;
                }
                if ( 'layout-default' !== $banner_layout ) {
                    echo '</div><!-- .mt-container -->';
                }
            ?>
        </div><!-- #banner-section -->
<?php
    }

endif;

add_action( 'matina_frontpage_section', 'matina_banner_section', 10 );

if ( ! function_exists( 'matina_featured_section' ) ) :

    /**
     * Display homepage featured section
     *
     * @since 1.0.0
     */
    function matina_featured_section() {

        $featured_option = get_theme_mod( 'matina_homepage_featured_option', true );
        if ( false === $featured_option ) {
            return;
        }

        // featured section
        get_template_part( 'template-parts/featured/content' );
    }

endif;

add_action( 'matina_frontpage_section', 'matina_featured_section', 20 );

if ( ! function_exists( 'matina_preloader' ) ) :

    /**
     * Function to manage the preloader.
     *
     * @since 1.0.0
     */
    function matina_preloader() {
        $matina_preloader_option = get_theme_mod( 'matina_preloader_option', true );
        if ( true != $matina_preloader_option ) {
            return;
        }

        $matina_preloader_style = get_theme_mod( 'matina_preloader_style', 'default' );
?>  
        <div id="preloader-background">
            <div class="preloader-wrapper">

                <?php
                    switch ( $matina_preloader_style ) {

                        case 'three_bounce':
                        ?>
                            <div class="mt-three-bounce">
                                <div class="mt-child mt-bounce1"></div>
                                <div class="mt-child mt-bounce2"></div>
                                <div class="mt-child mt-bounce3"></div>
                            </div>
                            <?php  
                            break;

                        case 'folding_cube':
                        ?>
                            <div class="mt-folding-cube">
                                <div class="mt-cube1 mt-cube"></div>
                                <div class="mt-cube2 mt-cube"></div>
                                <div class="mt-cube4 mt-cube"></div>
                                <div class="mt-cube3 mt-cube"></div>
                            </div>
                            <?php  
                            break;
                        
                        default:
                        ?>
                            <div class="mt-wave">
                                <div class="mt-rect mt-rect1"></div>
                                <div class="mt-rect mt-rect2"></div>
                                <div class="mt-rect mt-rect3"></div>
                                <div class="mt-rect mt-rect4"></div>
                                <div class="mt-rect mt-rect5"></div>
                            </div>
                            <?php
                            break;
                    }
                ?>
                


            </div><!-- .preloader-wrapper -->
        </div><!-- #preloader-background -->
<?php
    }

endif;

add_action( 'matina_before_page', 'matina_preloader', 10 );

if ( ! function_exists( 'matina_scroll_to_top' ) ) :

    /**
     * Function for scroll to top.
     */
    function matina_scroll_to_top() {
        $scroll_top_option = get_theme_mod( 'matina_scroll_top_option', true );
        if ( true !== $scroll_top_option ) {
            return;
        }
        $arrow_icon     = get_theme_mod( 'matina_scroll_top_arrow', 'fas fa-arrow-up' );
        $label_option   = get_theme_mod( 'matina_scroll_top_label_option', false );
        $scroll_label   = get_theme_mod( 'matina_scroll_top_label', __( 'Back to Top', 'matina' ) );
    ?>
        <div id="matina-scroll-to-top" class="mt-scroll scroll-top">
            <?php
                if ( true === $label_option ) {
                    echo '<span class="scroll-label">'. esc_html( $scroll_label ) .'</span>';
                }

                if ( ! empty( $arrow_icon ) ) {
                    echo '<i class="'. esc_attr( $arrow_icon ) .'"></i>';
                }
            ?>
        </div><!-- #matina-scroll-to-top -->
<?php
    }

endif;

add_action( 'matina_after_colophon', 'matina_scroll_to_top', 10 );



if ( ! function_exists( 'matina_page_header' ) ) {

    /**
     * function to display header page title
     *
     * @since 1.0.0
     */
    function matina_page_header() {

        if ( ! is_front_page() ) {
            get_template_part( '/template-parts/partials/header/pagetitle' );
        }
        
    }
    
}

add_action( 'matina_before_content', 'matina_page_header', 10 );