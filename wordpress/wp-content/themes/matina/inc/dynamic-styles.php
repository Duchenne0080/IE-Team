<?php
/**
 * Managed the dynamic styles.
 *
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'matina_custom_css' ) ) :

    /**
     * function to handle matina_head_css filter where all the css relation functions are hooked.
     *
     * @since 1.0.0
     */
    function matina_custom_css( $output_css = NULL ) {

        // Add filter matina_head_css for adding custom css via other functions.
        $output_css = apply_filters( 'matina_head_css', $output_css );

        if ( ! empty( $output_css ) ) {
            $output_css = matina_css_strip_whitespace( $output_css );
            echo "<!--Matina CSS -->\n<style type=\"text/css\">\n". $output_css ."\n</style>";
        }
    }

endif;

add_action( 'wp_head', 'matina_custom_css', 9999 );

/*-----------------------------------------------------------------------------*/

if ( ! function_exists( 'matina_general_css' ) ) :

    /**
     * function to handle the general css of all sections.
     *
     * @since 1.0.0
     */
    function matina_general_css( $output_css ) {

        $theme_color                    = get_theme_mod( 'matina_primary_theme_color', '#c97c76' );
        $text_color                     = get_theme_mod( 'matina_body_text_color', '#3d3d3d' );
        $link_color                     = get_theme_mod( 'matina_link_color', '#c97c76' );
        $link_hover_color               = get_theme_mod( 'matina_link_hover_color', '#8e4d48' );
        $header_image_overlay_color     = get_theme_mod( 'matina_header_image_overlay_color' );
        $header_background_color        = get_theme_mod( 'matina_header_background_color', '#ffffff' );
        $header_text_color              = get_theme_mod( 'matina_header_text_color', '#3d3d3d' );
        $footer_bg_image_overlay_color  = get_theme_mod( 'matina_footer_background_image_overlay_color' );
        $footer_background_color        = get_theme_mod( 'matina_footer_background_color', '#333333' );
        $footer_text_color              = get_theme_mod( 'matina_footer_text_color', '#a1a1a1' );
        $footer_bg_type                 = get_theme_mod( 'matina_footer_background_type', 'bg_image' );

        $matina_page_title_bg_title_align = get_theme_mod( 'matina_page_title_bg_title_align', 'center' );

        $top_header_text_color = get_theme_mod( 'matina_top_header_text_color', '#ccc' );

        $main_container_width   = get_theme_mod( 'matina_main_container_width', 1300 );
        $main_content_width     = get_theme_mod( 'matina_main_content_width', 70 );
        $sidebar_width          = get_theme_mod( 'matina_sidebar_width', 27 );

        //define variable for custom css
        $custom_css = '';

        $custom_css .= "#banner-section.banner-layout-default .lSAction>.lSNext:hover,#site-navigation #primary-menu li .sub-menu li:hover>a, #site-navigation #primary-menu li .children li:hover>a,.search--at-footer .search-form-wrap .search-form .search-submit:hover,.banner-layout-one .banner-button,#featured-section .post-title a:hover,.featured-categories--layout-default.featuredCarousel .featured-carousel-control .featuredCarousel-controls:hover,.featured-categories--layout-one.featuredCarousel .featured-carousel-control .featuredCarousel-controls:hover,.archive article .cat-links,.archive article .cat-links a,.archive--layout-default .post .cat-links,.archive--layout-default article .cat-links a,.archive article .entry-title a:hover,.archive--layout-default article .entry-title a:hover,.archive--layout-one article .entry-title a:hover,.archive--layout-default article .entry-readmore a:hover,.archive--layout-one article .cat-links a,.archive--layout-one .entry-readmore .mt-button:hover,.single--layout-one article .cat-links a,.single--layout-one .entry-tags .tags-links a:hover,.entry-author-box .post-author-info .author-name a:hover,.single-post-navigation .nav-links a span.title,.single-post-navigation .nav-links a:hover span.post-title:hover,.related-posts--layout-default .related-post .post-content-wrapper .related-post-title a:hover,.related-posts--layout-one .related-post .post-content-wrapper .related-post-title a:hover,.widget-area ul li a:hover,.widget-area .tagcloud a:hover,#masthead .matina-social-icons-wrapper .single-icon a:hover,.widget.matina_latest_posts .posts-wrapper .single-post-wrap .post-content-wrap .post-title a:hover,.widget-area .widget_categories ul li.cat-item:before,.widget-area ul li:hover >a,.widget-area ul li:hover:before, .navigation .nav-links a.page-numbers:hover,.posts-navigation .nav-links a:hover,#banner-section .banner-title a:hover,.banner-layout-one .lSAction a:hover i, .featured-categories--layout-default .cat-links a, .matina_author_info .matina-social-icons-wrapper .single-icon:hover a, #masthead.has-header-media #site-navigation #primary-menu li a:hover, .cv-block-grid--layout-one .cv-read-more a, .cv-post-title a:hover,.cv-block-list--layout-one .cv-read-more  a:hover,.cv-block-list--layout-one .cv-post-cat a, .default-page-header .breadcrumbs ul li:after, .mt-page-header .breadcrumbs ul li a:hover, .mt-page-header .breadcrumbs ul li:after, .mt-page-header .woocommerce-breadcrumbs .woocommerce-breadcrumbs-wrapper a:hover, .woocommerce ul.products li.product .button.add_to_cart_button,.woocommerce ul.products li.product .button.product_type_grouped,.woocommerce ul.products li.product .button.product_type_external, ul.products li.product .woocommerce-loop-product__title:hover, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce .woocommerce-info a,.woocommerce-info::before, .search .entry-title a:hover,.search .entry-readmore a:hover,.search article .cat-links a, .featured-categories--layout-default .cat-links,.footer-bottom-wrapper .site-info a, #site-navigation #primary-menu li .children li:hover>a, .site-branding a.site-title:hover, #site-navigation ul li:hover > a,#site-navigation ul li.current-menu-item > a,#site-navigation ul li.current-menu-ancestor > a,#site-navigation ul li.current_page_ancestor > a,#site-navigation ul li.current_page_item > a,#site-navigation ul li.current-post-parent > a,#site-navigation ul li.focus>a,a, .archive--layout-default article .entry-readmore a:hover
        { color: ". esc_attr( $theme_color ) ."}\n";


$custom_css .= ".widget-area .search-form .search-submit ,.banner-layout-one .banner-button:after,#banner-section .lSSlideOuter .lSPager.lSpg>li.active a,.featured-repeater--layout-one .single-item-wrap .button-wrapper .mt-button:hover,.featured-categories--layout-one:before,.featured-categories--layout-one .section-title-wrapper .section-title:before,.featured-repeater--layout-default .section-title-wrapper .section-title:before,.featured-repeater--layout-one .section-title-wrapper .section-title:before,.archive--layout-default article .entry-readmore a:after,.single-post .comments-area .comment-list .comment .reply a:hover,.single--layout-default article .cat-links a, .entry-author-box.author-box--layout-default .article-author-avatar .avatar-wrap:after,.related-posts-wrapper .related-section-title:after,#matina-scroll-to-top:hover, .navigation .nav-links span.current,.edit-link a, #featured-section .section-title-wrapper .section-title:before,.search .no-results .search-form .search-submit, .archive .no-results .search-form .search-submit, .post-format-media.post-format-media--quote:before{ background: ". esc_attr( $theme_color ) ."}\n";

        $custom_css .= ".woocommerce #respond input#submit.alt.disabled,
        .woocommerce #respond input#submit.alt.disabled:hover,
        .woocommerce #respond input#submit.alt:disabled,
        .woocommerce #respond input#submit.alt:disabled:hover,
        .woocommerce #respond input#submit.alt[disabled]:disabled,
        .woocommerce #respond input#submit.alt[disabled]:disabled:hover,
        .woocommerce a.button.alt.disabled,
        .woocommerce a.button.alt.disabled:hover,
        .woocommerce a.button.alt:disabled,
        .woocommerce a.button.alt:disabled:hover,
        .woocommerce a.button.alt[disabled]:disabled,
        .woocommerce a.button.alt[disabled]:disabled:hover,
        .woocommerce button.button.alt.disabled,
        .woocommerce button.button.alt.disabled:hover,
        .woocommerce button.button.alt:disabled,
        .woocommerce button.button.alt:disabled:hover,
        .woocommerce button.button.alt[disabled]:disabled,
        .woocommerce button.button.alt[disabled]:disabled:hover,
        .woocommerce input.button.alt.disabled,
        .woocommerce input.button.alt.disabled:hover,
        .woocommerce input.button.alt:disabled,
        .woocommerce input.button.alt:disabled:hover,
        .woocommerce input.button.alt[disabled]:disabled,
        .woocommerce input.button.alt[disabled]:disabled:hover, .woocommerce ul.products li.product .onsale, .woocommerce span.onsale,
        .woocommerce ul.products li.product .button.add_to_cart_button:hover,.woocommerce ul.products li.product .button.product_type_grouped:hover,.woocommerce ul.products li.product .button.product_type_external:hover, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .added_to_cart.wc-forward, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover,.woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce div.product .woocommerce-tabs ul.tabs li.active,.woocommerce-noreviews, p.no-comments,.is-sticky #masthead.header--layout-default.has-header-media, #masthead.header--layout-one.has-header-media .is-sticky #header-sticky,#masthead.header--layout-one.has-header-media .is-sticky #header-sticky::before, #masthead.header--layout-one.has-header-media .is-sticky #header-sticky::after{ background: ". esc_attr( $theme_color ) ."}\n";

        $custom_css .= "body p { color: ". esc_attr( $text_color ) ." }\n";

        $custom_css .= "a { color: ". esc_attr( $link_color ) ."}\n";

        $custom_css .= "a:hover { color: ". esc_attr( $link_hover_color ) ."}\n";

        $custom_css .= "a { border-color: ". esc_attr( $link_color ) ."}\n";

        $custom_css .= "#banner-section .lSSlideOuter .lSPager.lSpg>li.active,.featured-categories--layout-one.featuredCarousel .featured-carousel-control .featuredCarousel-controls:hover,.single--layout-one .entry-tags .tags-links a:hover,.widget-area .tagcloud a:hover,.widget-area .search-form .search-submit,.home .navigation .nav-links span.current,.archive .navigation .nav-links span.current, .navigation .nav-links a.page-numbers:hover, .matina_author_info .matina-social-icons-wrapper .single-icon:hover,.search .no-results .search-form .search-submit,   .entry-author-box.author-box--layout-default  .article-author-avatar .avatar-wrap, .woocommerce ul.products li.product .button.add_to_cart_button:hover,
        .woocommerce ul.products li.product .button.product_type_grouped:hover,
        .woocommerce ul.products li.product .button.product_type_external:hover, .woocommerce ul.products li.product .button.add_to_cart_button,
        .woocommerce ul.products li.product .button.product_type_grouped,
        .woocommerce ul.products li.product .button.product_type_external, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .archive .no-results .search-form .search-submit
        { border-color: ". esc_attr( $theme_color) ."}\n";

        $custom_css .= ".woocommerce .woocommerce-info, .woocommerce .woocommerce-message{ border-top-color: ". esc_attr( $theme_color) ."}\n";

        $custom_css .= "#colophon .widget-area .widget-title:after,.posts-navigation .nav-links a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs::before{ border-bottom-color: ". esc_attr( $theme_color) ."}\n";

        $custom_css .= "#site-navigation #primary-menu li .sub-menu li:hover,#site-navigation #primary-menu li .children li:hover,#site-navigation #primary-menu li .sub-menu li.focus,#site-navigation #primary-menu li .children li.focus ,.entry-author-box.author-box--layout-one, #site-navigation #primary-menu li .children li:hover{ border-left-color: ". esc_attr( $theme_color ) ."}\n";

        $custom_css .= " #site-navigation #primary-menu li .sub-menu li:hover{ border-right-color: ". esc_attr( $theme_color ) ."}\n";

        // Header media overlay color
        if ( ! empty( $header_image_overlay_color ) && 'rgba(0,0,0,0.3)' != $header_image_overlay_color ) {
            $custom_css .= "#masthead.has-header-media .overlay-header-media{background-color:". esc_attr( $header_image_overlay_color ) ."}";
        }

        // Header background color
        if ( ! empty( $header_background_color ) && '#ffffff' != $header_background_color ) {
            $custom_css .= "#masthead,#site-navigation ul li .sub-menu, #site-navigation ul li .children,.is-sticky #masthead.header--layout-default, #masthead.header--layout-one .is-sticky #header-sticky,#masthead.header--layout-one .is-sticky #header-sticky::before, #masthead.header--layout-one .is-sticky #header-sticky::after{background-color:". esc_attr( $header_background_color ) ."}";
        }

        // Header text color
        if ( ! empty( $header_text_color ) && '#3d3d3d' != $header_text_color ) {
            $custom_css .= "#masthead, #site-navigation ul li a, #masthead .matina-social-icons-wrapper .single-icon a, .header-search-wrapper .search-icon a,.menu-toggle a{color:". esc_attr( $header_text_color ) ."}";
        }

        // Footer background image overlay
        if ( ! empty( $footer_bg_image_overlay_color ) && 'rgba(0,0,0,0.3)' != $footer_bg_image_overlay_color ) {
            $custom_css .= "#colophon.has-bg-image .overlay-footer-image{background-color:". esc_attr( $footer_bg_image_overlay_color ) ."}";
        }

        // Footer background color
        if ( ! empty( $footer_background_color ) && 'bg_color' === $footer_bg_type ) {
            $custom_css .= "#colophon{background-color:". esc_attr( $footer_background_color ) ."}";
        }

        // Footer text color
        if ( ! empty( $footer_text_color ) && 'bg_color' === $footer_bg_type ) {
            $custom_css .= "#colophon .widget-area ul li a, #colophon .widget-area ul li, #colophon .widget-area .tagcloud a, #colophon .widget.matina_latest_posts .posts-wrapper .single-post-wrap .post-content-wrap .post-title a, #colophon .widget-area .widget_categories ul li.cat-item::before,#colophon #footer-menu li a,.footer-social-icons .matina-social-icons-wrapper .single-icon a,#colophon #bottom-area .site-info{color:". esc_attr( $footer_text_color ) ."}";
        }

        //page title align while background image active
        if ( ! empty( $matina_page_title_bg_title_align ) ) {
            $custom_css .= '.background-image-page-header .inner-page-header{text-align: '. esc_attr( $matina_page_title_bg_title_align ) .'}';
        }

        // top header element color
        if ( ! empty( $top_header_text_color ) ) {
            $custom_css .= '#mt-topbar .topbar-elements-wrapper, #mt-topbar #topbar-menu li a{color:'. esc_attr( $top_header_text_color ) .'}';
        }

        // container width
        if ( ! empty( $main_container_width ) ) {
            $output_css .= '.mt-container{width:'. absint( $main_container_width ) .'px}';
        }

        // main content width (in %)
        if ( ! empty( $main_content_width ) ) {
            $output_css .= '#primary{width:'. absint( $main_content_width ) .'% !important}';
        }

        // sidebar content width (in %)
        if ( ! empty( $sidebar_width ) ) {
            $output_css .= '#secondary{width:'. absint( $sidebar_width ) .'% !important}';
        }

        if ( ! empty( $custom_css ) ) {
            $output_css .= $custom_css;
        }

        return $output_css;

    }

endif;

add_filter( 'matina_head_css', 'matina_general_css' );

/*-----------------------------------------------------------------------------*/

if ( ! function_exists( 'matina_top_header_css' ) ) :

    /**
     * function to handle top header section style
     *
     * @since 1.0.0
     */
    function matina_top_header_css( $output_css ) {

        $custom_css = '';
        $bg_color   = get_theme_mod( 'matina_top_header_bg_color', '#333' );

        if ( ! empty( $bg_color ) ) {
            $custom_css .= 'background:'. esc_attr( $bg_color ) .';';
        }

        if ( ! empty( $custom_css ) ) {
            $output_css .= '/* Top header background style */#mt-topbar{'. $custom_css .'}';
        }

        return $output_css;
    }

endif;

add_filter( 'matina_head_css', 'matina_top_header_css' );


/*-----------------------------------------------------------------------------*/

if ( ! function_exists( 'matina_header_image_css' ) ) :

    /**
     * function to handle the header image css.
     *
     * @since 1.0.0
     */
    function matina_header_image_css( $output_css ) {

        $custom_css = '';

        $header_image               = get_header_image();
        $header_image_position      = get_theme_mod( 'matina_header_image_position' );
        $header_image_attachment    = get_theme_mod( 'matina_header_image_attachment' );
        $header_image_repeat        = get_theme_mod( 'matina_header_image_repeat' );
        $header_image_size          = get_theme_mod( 'matina_header_image_size' );

        if ( ! empty( $header_image ) ) {
            $custom_css .= 'background-image:url('. esc_url( $header_image ) .');';
        }

        if ( ! empty( $header_image_position ) && 'initial' != $header_image_position ) {
            $custom_css .= 'background-position:'. esc_attr( $header_image_position ) .';';
        }

        if ( ! empty( $header_image_attachment ) && 'initial' != $header_image_attachment ) {
            $custom_css .= 'background-attachment:'. esc_attr( $header_image_attachment ) .';';
        }

        if ( ! empty( $header_image_repeat ) && 'initial' != $header_image_repeat ) {
            $custom_css .= 'background-repeat:'. esc_attr( $header_image_repeat ) .';';
        }

        if ( ! empty( $header_image_size ) && 'initial' != $header_image_size ) {
            $custom_css .= 'background-size:'. esc_attr( $header_image_size ) .';';
        }

        if ( has_header_image() && ! empty( $custom_css ) ) {
            $output_css .= '/* Header Image CSS */#masthead{'. $custom_css .'}';
        }

        return $output_css;

    }

endif;

add_filter( 'matina_head_css', 'matina_header_image_css' );

/*-----------------------------------------------------------------------------*/

if ( ! function_exists( 'matina_typography_css' ) ) :

    /**
     * function to handle the typography css.
     *
     * @since 1.0.0
     */
    function matina_typography_css( $output_css ) {

        $custom_css = '';

        /**
         * Body typography
         */
        $body_font_family          = get_theme_mod( 'body_font_family', 'Open Sans' );
        $body_font_style           = get_theme_mod( 'body_font_style', '400' );
        $body_text_transform       = get_theme_mod( 'body_text_transform', 'none' );

        if ( ! empty( $body_font_style ) ) {
            $body_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $body_font_style );
            if ( isset( $body_font_style_weight[1] ) ) {
                $body_font_style = $body_font_style_weight[1];
            } else {
                $body_font_style = 'normal';
            }

            if ( isset( $body_font_style_weight[0] ) ) {
                $body_font_weight = $body_font_style_weight[0];
            } else {
                $body_font_weight = 400;
            }
        }

        $custom_css .= "body, p {
            font-family:        $body_font_family;
            font-style:         $body_font_style;
            font-weight:        $body_font_weight;
            text-transform:     $body_text_transform;
        }\n";

        /**
         * H1 typography
         */
        $h1_font_family          = get_theme_mod( 'h1_font_family', 'Josefin Sans' );
        $h1_font_style           = get_theme_mod( 'h1_font_style', '400' );
        $h1_text_transform       = get_theme_mod( 'h1_text_transform', 'none' );

        if ( ! empty( $h1_font_style ) ) {
            $h1_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $h1_font_style );
            if ( isset( $h1_font_style_weight[1] ) ) {
                $h1_font_style = $h1_font_style_weight[1];
            } else {
                $h1_font_style = 'normal';
            }

            if ( isset( $h1_font_style_weight[0] ) ) {
                $h1_font_weight = $h1_font_style_weight[0];
            } else {
                $h1_font_weight = 400;
            }
        }

        $custom_css .= "h1, single .entry-title {
            font-family:        $h1_font_family;
            font-style:         $h1_font_style;
            font-weight:        $h1_font_weight;
            text-transform:     $h1_text_transform;
        }\n";

        /**
         * H2 typography
         */
        $h2_font_family          = get_theme_mod( 'h2_font_family', 'Josefin Sans' );
        $h2_font_style           = get_theme_mod( 'h2_font_style', '400' );
        $h2_text_transform       = get_theme_mod( 'h2_text_transform', 'none' );

        if ( ! empty( $h2_font_style ) ) {
            $h2_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $h2_font_style );
            if ( isset( $h2_font_style_weight[1] ) ) {
                $h2_font_style = $h2_font_style_weight[1];
            } else {
                $h2_font_style = 'normal';
            }

            if ( isset( $h2_font_style_weight[0] ) ) {
                $h2_font_weight = $h2_font_style_weight[0];
            } else {
                $h2_font_weight = 400;
            }
        }

        $custom_css .= "h2,.search .entry-title a {
            font-family:        $h2_font_family;
            font-style:         $h2_font_style;
            font-weight:        $h2_font_weight;
            text-transform:     $h2_text_transform;
        }\n";

        /**
         * H3 typography
         */
        $h3_font_family          = get_theme_mod( 'h3_font_family', 'Josefin Sans' );
        $h3_font_style           = get_theme_mod( 'h3_font_style', '400' );
        $h3_text_transform       = get_theme_mod( 'h3_text_transform', 'none' );

        if ( ! empty( $h3_font_style ) ) {
            $h3_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $h3_font_style );
            if ( isset( $h3_font_style_weight[1] ) ) {
                $h3_font_style = $h3_font_style_weight[1];
            } else {
                $h3_font_style = 'normal';
            }

            if ( isset( $h3_font_style_weight[0] ) ) {
                $h3_font_weight = $h3_font_style_weight[0];
            } else {
                $h3_font_weight = 400;
            }
        }

        $custom_css .= "h3 {
            font-family:        $h3_font_family;
            font-style:         $h3_font_style;
            font-weight:        $h3_font_weight;
            text-transform:     $h3_text_transform;
        }\n";

        /**
         * H4 typography
         */
        $h4_font_family          = get_theme_mod( 'h4_font_family', 'Josefin Sans' );
        $h4_font_style           = get_theme_mod( 'h4_font_style', '400' );
        $h4_text_transform       = get_theme_mod( 'h4_text_transform', 'none' );

        if ( ! empty( $h4_font_style ) ) {
            $h4_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $h4_font_style );
            if ( isset( $h4_font_style_weight[1] ) ) {
                $h4_font_style = $h4_font_style_weight[1];
            } else {
                $h4_font_style = 'normal';
            }

            if ( isset( $h4_font_style_weight[0] ) ) {
                $h4_font_weight = $h4_font_style_weight[0];
            } else {
                $h4_font_weight = 400;
            }
        }

        $custom_css .= "h4 {
            font-family:        $h4_font_family;
            font-style:         $h4_font_style;
            font-weight:        $h4_font_weight;
            text-transform:     $h4_text_transform;
        }\n";

        if ( ! empty( $custom_css ) ) {
            $output_css .= '/*/ Typography CSS /*/'. $custom_css;
        }

        return $output_css;
    }

endif;

add_filter( 'matina_head_css', 'matina_typography_css' );