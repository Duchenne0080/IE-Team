<?php
/**
 * Customizer helper where define functions related to customizer panel, sections and settings.
 * 
 * @package Matina
 */

if ( ! function_exists( 'matina_site_layout_choices' ) ) :

    /**
     * function to return choices of site layout.
     *
     * @since 1.0.0
     */
    function matina_site_layout_choices() {

        $site_layouts = apply_filters( 'matina_site_layout_choices',
            array(
                'full-width'    => array(
                    'title'     => __( 'Fullwidth', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/full-width.png'
                ),
                'boxed-layout'  => array(
                    'title'     => __( 'Boxed', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/boxed-layout.png'
                )
            )
        );

        return $site_layouts;

    }

endif;

if ( ! function_exists( 'matina_date_format_choices' ) ) :

    /**
     * function to return choices of date format.
     *
     * @since 1.0.0
     */
    function matina_date_format_choices() {

        $date_format = apply_filters( 'matina_date_format_choices',
            array(
                'default'       => __( 'Default', 'matina' ),
                'format-1'      => __( 'Format 1', 'matina' ),
                'format-2'     => __( 'Format 2', 'matina' )
            )
        );

        return $date_format;

    }

endif;

if ( ! function_exists( 'matina_search_style_choices' ) ) :

    /**
     * function to return choices of search form style.
     *
     * @since 1.0.0
     */
    function matina_search_style_choices() {

        $search_style = apply_filters( 'matina_search_style_choices',
            array(
                'drop-down'     => __( 'Drop Down', 'matina' ),
                'at-footer'     => __( 'At Footer', 'matina' ),
                'overlay'       => __( 'Overlay', 'matina' )
            )
        );

        return $search_style;

    }

endif;

if ( ! function_exists( 'matina_header_active_menu_item_style_choices' ) ) :

    /**
     * function to return choices of active menu item style.
     *
     * @since 1.0.0
     */
    function matina_header_active_menu_item_style_choices() {

        $current_menu_item_style = apply_filters( 'matina_header_active_menu_item_style_choices',
            array(
                'none'          => __( 'None', 'matina' ),
                'underline'     => __( 'Underline', 'matina' ),
                'left-border'   => __( 'Left Border', 'matina' ),
                'right-border'  => __( 'Right Border', 'matina' )
            )
        );

        return $current_menu_item_style;

    }

endif;

if ( ! function_exists( 'matina_header_layout_choices' ) ) :

    /**
     * function to return choices of header layout.
     *
     * @since 1.0.0
     */
    function matina_header_layout_choices() {

        $header_layouts = apply_filters( 'matina_header_layout_choices',
            array(
                'layout-default'    => array(
                    'title'     => __( 'Layout Default', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/header-layout-default.png'
                ),
                'layout-one'  => array(
                    'title'     => __( 'Layout One', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/header-layout-one.png'
                )
            )
        );

        return $header_layouts;

    }

endif;

if ( ! function_exists( 'matina_bg_image_position_choices' ) ) :

    /**
     * function to return choices of background image position.
     *
     * @since 1.0.0
     */
    function matina_bg_image_position_choices() {

        $bg_image_position = apply_filters( 'matina_bg_image_position_choices',
            array(
                'initial'           => __( 'Default', 'matina' ),
                'top left'          => __( 'Top Left', 'matina' ),
                'top center'        => __( 'Top Center', 'matina' ),
                'top right'         => __( 'Top Right', 'matina' ),
                'center left'       => __( 'Center Left', 'matina' ),
                'center center'     => __( 'Center Center', 'matina' ),
                'center right'      => __( 'Center Right', 'matina' ),
                'bottom left'       => __( 'Bottom Left', 'matina' ),
                'bottom center'     => __( 'Bottom Center', 'matina' ),
                'bottom right'      => __( 'Bottom Right', 'matina' ),
            )
        );

        return $bg_image_position;

    }

endif;

if ( ! function_exists( 'matina_bg_image_attachment_choices' ) ) :

    /**
     * function to return choices of background image attachment.
     *
     * @since 1.0.0
     */
    function matina_bg_image_attachment_choices() {

        $bg_image_attachment = apply_filters( 'matina_bg_image_attachment_choices',
            array(
                'initial'   => __( 'Default', 'matina' ),
                'scroll'    => __( 'Scroll', 'matina' ),
                'fixed'     => __( 'Fixed', 'matina' )
            )
        );

        return $bg_image_attachment;

    }

endif;

if ( ! function_exists( 'matina_bg_image_repeat_choices' ) ) :

    /**
     * function to return choices of background image repeat.
     *
     * @since 1.0.0
     */
    function matina_bg_image_repeat_choices() {

        $bg_image_repeat = apply_filters( 'matina_bg_image_repeat_choices',
            array(
                'initial'   => __( 'Default', 'matina' ),
                'no-repeat' => __( 'No-repeat', 'matina' ),
                'repeat'    => __( 'Repeat', 'matina' ),
                'repeat-x'  => __( 'Repeat-x', 'matina' ),
                'repeat-y'  => __( 'Repeat-y', 'matina' ),
            )
        );

        return $bg_image_repeat;

    }

endif;

if ( ! function_exists( 'matina_bg_image_size_choices' ) ) :

    /**
     * function to return choices of background image size.
     *
     * @since 1.0.0
     */
    function matina_bg_image_size_choices() {

        $bg_image_size = apply_filters( 'matina_bg_image_size_choices',
            array(
                'initial'   => __( 'Default', 'matina' ),
                'auto'      => __( 'Auto', 'matina' ),
                'cover'     => __( 'Cover', 'matina' ),
                'contain'   => __( 'Contain', 'matina' ),
            )
        );

        return $bg_image_size;

    }

endif;

if ( ! function_exists( 'matina_homepage_banner_type_choices' ) ) :

    /**
     * function to return choices of homepage banner type.
     *
     * @since 1.0.0
     */
    function matina_homepage_banner_type_choices() {

        $banner_type = apply_filters( 'matina_homepage_banner_type_choices',
            array(
                'single'    => __( 'Single Banner', 'matina' ),
                'category'  => __( 'Category Posts', 'matina' )
            )
        );

        return $banner_type;

    }

endif;

if ( ! function_exists( 'matina_banner_layout_choices' ) ) :

    /**
     * function to return choices of banner layout.
     *
     * @since 1.0.0
     */
    function matina_banner_layout_choices() {

        $banner_layouts = apply_filters( 'matina_banner_layout_choices',
            array(
                'layout-default'    => array(
                    'title'     => __( 'Layout Default', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/banner-layout-default.png'
                ),
                'layout-one'  => array(
                    'title'     => __( 'Layout One', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/banner-layout-one.png'
                )
            )
        );

        return $banner_layouts;

    }

endif;

if ( ! function_exists( 'matina_banner_slide_mode_choices' ) ) :

    /**
     * function to return choices of homepage banner slide mode.
     *
     * @since 1.0.0
     */
    function matina_banner_slide_mode_choices() {

        $banner_slide_mode = apply_filters( 'matina_banner_slide_mode_choices',
            array(
                'slide' => __( 'Slide', 'matina' ),
                'fade'  => __( 'Fade', 'matina' )
            )
        );

        return $banner_slide_mode;

    }

endif;

if ( ! function_exists( 'matina_featured_categories_layout_choices' ) ) :

    /**
     * function to return choices of featured categories layout.
     *
     * @since 1.0.0
     */
    function matina_featured_categories_layout_choices() {

        $featured_layouts = apply_filters( 'matina_featured_categories_layout_choices',
            array(
                'layout-default'    => array(
                    'title'     => __( 'Layout Default', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/featured-categories-default.png'
                ),
                'layout-one'  => array(
                    'title'     => __( 'Layout One', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/featured-categories-one.png'
                )
            )
        );

        return $featured_layouts;

    }

endif;

if ( ! function_exists( 'matina_default_categories_choices' ) ) :

    /**
     * function to return choices of default categories.
     *
     * @return array()
     * @since 1.0.0
     */
    function matina_default_categories_choices() {
        $get_categories     = get_categories();
        $categories_lists   = array();
        foreach( $get_categories as $category ) {
            $categories_lists[esc_attr( $category->term_id )] = esc_html( $category->name ). ' ('. absint( $category->count ) .')';
        }
        return $categories_lists;
    }

endif;

if ( ! function_exists( 'matina_sidebar_layout_choices' ) ) :

    /**
     * function to return choices of archive sidebar layout.
     *
     * @since 1.0.0
     */
    function matina_sidebar_layout_choices() {

        $sidebar_layouts = apply_filters( 'matina_sidebar_layout_choices',
            array(
                'right-sidebar'    => array(
                    'title'     => __( 'Right Sidebar', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/right-sidebar.png'
                ),
                'left-sidebar'  => array(
                    'title'     => __( 'Left Sidebar', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/left-sidebar.png'
                ),
                'no-sidebar'  => array(
                    'title'     => __( 'No Sidebar', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/no-sidebar.png'
                ),
                'no-sidebar-center'  => array(
                    'title'     => __( 'No Sidebar Center', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/no-sidebar-center.png'
                )
            )
        );

        return $sidebar_layouts;

    }

endif;

if ( ! function_exists( 'matina_archive_style_choices' ) ) :

    /**
     * function to return choices of archive style.
     *
     * @since 1.0.0
     */
    function matina_archive_style_choices() {

        $archive_style = apply_filters( 'matina_archive_style_choices',
            array(
                'masonry' => __( 'Masonry Style', 'matina' ),
                'grid'    => __( 'Grid Style', 'matina' ),
            )
        );

        return $archive_style;

    }

endif;

if ( ! function_exists( 'matina_archive_layout_choices' ) ) :

    /**
     * function to return choices of archive layout.
     *
     * @since 1.0.0
     */
    function matina_archive_layout_choices() {

        $archive_layouts = apply_filters( 'matina_archive_layout_choices',
            array(
                'layout-default'    => array(
                    'title'     => __( 'Layout Default', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/archive-layout-default.png'
                ),
                'layout-one'  => array(
                    'title'     => __( 'Layout One', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/archive-layout-one.png'
                )
            )
        );

        return $archive_layouts;

    }

endif;

if ( ! function_exists( 'matina_heading_tag_choices' ) ) :

    /**
     * function to return choices of heading tag.
     *
     * @since 1.0.0
     */
    function matina_heading_tag_choices() {

        $heading_tag = apply_filters( 'matina_heading_tag_choices',
            array(
                'h1'    => __( 'H1', 'matina' ),
                'h2'    => __( 'H2', 'matina' ),
                'h3'    => __( 'H3', 'matina' ),
                'h4'    => __( 'H4', 'matina' ),
                'h5'    => __( 'H5', 'matina' ),
                'h6'    => __( 'H6', 'matina' ),
                'div'   => __( 'div', 'matina' ),
                'span'  => __( 'span', 'matina' ),
                'p'     => __( 'p', 'matina' )
            )
        );

        return $heading_tag;

    }

endif;

if ( ! function_exists( 'matina_page_title_style_choices' ) ) :

    /**
     * function to return choices of page title style.
     *
     * @since 1.0.0
     */
    function matina_page_title_style_choices() {

        $title_style = apply_filters( 'matina_page_title_style_choices',
            array(
                'default'           => __( 'Default', 'matina' ),
                'centered'          => __( 'Centered', 'matina' ),
                'hidden'            => __( 'Hidden', 'matina' )
            )
        );

        return $title_style;

    }

endif;

if ( ! function_exists( 'matina_post_content_type_choices' ) ) :

    /**
     * function to return choices of post content.
     *
     * @since 1.0.0
     */
    function matina_post_content_type_choices() {

        $post_content_type = apply_filters( 'matina_post_content_type_choices',
            array(
                'full-content'  => __( 'Full Content', 'matina' ),
                'excerpt'       => __( 'Excerpt', 'matina' )
            )
        );

        return $post_content_type;

    }

endif;

if ( ! function_exists( 'matina_archive_pagination_choices' ) ) :

    /**
     * function to return choices of archive pagination.
     *
     * @since 1.0.0
     */
    function matina_archive_pagination_choices() {

        $pagination_type = apply_filters( 'matina_archive_pagination_choices',
            array(
                'default'   => __( 'Default', 'matina' ),
                'numeric'   => __( 'Numeric', 'matina' )
            )
        );

        return $pagination_type;

    }

endif;

if ( ! function_exists( 'matina_single_posts_layout_choices' ) ) :

    /**
     * function to return choices of single post layout.
     *
     * @since 1.0.0
     */
    function matina_single_posts_layout_choices() {

        $single_post_layouts = apply_filters( 'matina_single_posts_layout_choices',
            array(
                'layout-default'    => array(
                    'title'     => __( 'Layout Default', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/single-post-layout-default.png'
                ),
                'layout-one'  => array(
                    'title'     => __( 'Layout One', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/single-post-layout-one.png'
                )
            )
        );

        return $single_post_layouts;

    }

endif;

if ( ! function_exists( 'matina_sidebar_order_choices' ) ) :

    /**
     * function to return choices of sidebar order style.
     *
     * @since 1.0.0
     */
    function matina_sidebar_order_choices() {

        $sidebar_order = apply_filters( 'matina_sidebar_order_choices',
            array(
                'content-sidebar'   => __( 'Content / Sidebar', 'matina' ),
                'sidebar-content'   => __( 'Sidebar / Content', 'matina' )
            )
        );

        return $sidebar_order;

    }

endif;

if ( ! function_exists( 'matina_single_posts_taxonomy_choices' ) ) :

    /**
     * function to return choices of single posts taxonomy.
     *
     * @since 1.0.0
     */
    function matina_single_posts_taxonomy_choices() {

        $single_posts_taxonomy = apply_filters( 'matina_single_posts_taxonomy_choices',
            array(
                'category'  => __( 'Category', 'matina' ),
                'post_tag'  => __( 'Tag', 'matina' )
            )
        );

        return $single_posts_taxonomy;

    }

endif;

if ( ! function_exists( 'matina_404_page_layout_choices' ) ) :

    /**
     * function to return choices of 404 page layout.
     *
     * @since 1.0.0
     */
    function matina_404_page_layout_choices() {

        $error_page_layouts = apply_filters( 'matina_404_page_layout_choices',
            array(
                'layout-default'    => array(
                    'title'     => __( 'Layout Default', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/404-layout-default.png'
                ),
                'layout-one'  => array(
                    'title'     => __( 'Layout One', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/404-layout-one.png'
                )
            )
        );

        return $error_page_layouts;

    }

endif;

if ( ! function_exists( 'matina_footer_widget_layout_choices' ) ) :

    /**
     * function to return choices of footer widget area layout.
     *
     * @since 1.0.0
     */
    function matina_footer_widget_layout_choices() {

        $footer_widget_layouts = apply_filters( 'matina_footer_widget_layout_choices', array(
                'one-column'    => array(
                    'title'     => __( 'One Column', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/one-column.png'
                ),
                'two-columns'  => array(
                    'title'     => __( 'Two Columns', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/two-column.png'
                ),
                'three-columns'  => array(
                    'title'     => __( 'Three Columns', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/three-column.png'
                ),
                'four-columns'  => array(
                    'title'     => __( 'Four Columns', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/four-column.png'
                )
            )
        );

        return $footer_widget_layouts;

    }

endif;

if ( ! function_exists( 'matina_footer_layout_choices' ) ) :

    /**
     * function to return choices of footer area layout.
     *
     * @since 1.0.0
     */
    function matina_footer_layout_choices() {

        $footer_layouts = apply_filters( 'matina_footer_layout_choices',
            array(
                'layout-default'    => array(
                    'title'     => __( 'Layout Default', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/footer-layout-default.png'
                ),
                'layout-one'        => array(
                    'title'     => __( 'Layout One', 'matina' ),
                    'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/footer-layout-one.png'
                )
            )
        );

        return $footer_layouts;

    }

endif;

if ( ! function_exists( 'matina_preloader_style_choices' ) ) :

    /**
     * function to return choices of preloader style.
     *
     * @since 1.0.0
     */
    function matina_preloader_style_choices() {

        $preloader_style = apply_filters( 'matina_preloader_style_choices',
            array(
                'three_bounce'      => __( '3 Bounce', 'matina' ),
                'wave'              => __( 'Wave', 'matina' ),
                'folding_cube'      => __( 'Folding Cube', 'matina' )
            )
        );

        return $preloader_style;

    }

endif;

if ( ! function_exists( 'matina_scroll_top_arrow_choices' ) ) :

    /**
     * function to return choices of scroll top arrow.
     *
     * @since 1.0.0
     */
    function matina_scroll_top_arrow_choices() {

        $scroll_top_arrows = apply_filters( 'matina_scroll_top_arrow_choices',
            array(
                'fas fa-chevron-up'             => 'fas fa-chevron-up',
                'fas fa-angle-double-up'        => 'fas fa-angle-double-up',
                'fas fa-arrow-up'               => 'fas fa-arrow-up',
            )
        );

        return $scroll_top_arrows;

    }

endif;

if ( ! function_exists( 'matina_font_transform_choices' ) ) :

    /**
     * function to return choices of font transform.
     *
     * @since 1.0.0
     */
    function matina_font_transform_choices() {

        $font_transform = apply_filters( 'matina_font_transform_choices',
            array(
                'none'          => __( 'None', 'matina' ),
                'uppercase'     => __( 'Uppercase', 'matina' ),
                'lowercase'     => __( 'Lowercase', 'matina' ),
                'capitalize'    => __( 'Capitalize', 'matina' )
            )
        );

        return $font_transform;

    }

endif;

if ( ! function_exists( 'matina_font_decoration_choices' ) ) :

    /**
     * function to return choices of font decoration.
     *
     * @since 1.0.0
     */
    function matina_font_decoration_choices() {

        $font_decoration = apply_filters( 'matina_font_decoration_choices',
            array(
                'none'          => __( 'None', 'matina' ),
                'underline'     => __( 'Underline', 'matina' ),
                'line-through'  => __( 'Line-through', 'matina' ),
                'overline'      => __( 'Overline', 'matina' )
            )
        );

        return $font_decoration;

    }

endif;

if ( ! function_exists( 'matina_background_type_choices' ) ) :

    /**
     * function to return choices of background type.
     *
     * @since 1.0.0
     */
    function matina_background_type_choices() {

        $background_type = apply_filters( 'matina_background_type_choices',
            array(
                'none'      => __( 'None', 'matina' ),
                'bg_color'  => __( 'Color', 'matina' )
            )
        );

        return $background_type;

    }

endif;

if ( ! function_exists( 'matina_image_hover_style_choices' ) ) :

    /**
     * function to return choices of image hover type.
     *
     * @since 1.0.0
     */
    function matina_image_hover_style_choices() {

        $image_hover_type = apply_filters( 'matina_image_hover_style_choices',
            array(
                'zoomin'        => __( 'Zoom In', 'matina' ),
                'shine'         => __( 'Shine', 'matina' ),
                'opacity'       => __( 'Opacity', 'matina' )
            )
        );

        return $image_hover_type;

    }

endif;

if ( ! function_exists( 'matina_page_title_bg_title_align_choices' ) ) :

    /**
     * function to return choices of page title bg title align.
     *
     * @since 1.0.0
     */
    function matina_page_title_bg_title_align_choices() {

        $page_title_align = apply_filters( 'matina_page_title_bg_title_align_choices', array(
                'left'      => __( 'Left', 'matina' ),
                'center'    => __( 'Center', 'matina' ),
                'right'     => __( 'Right', 'matina' )
            )
        );

        return $page_title_align;

    }

endif;
