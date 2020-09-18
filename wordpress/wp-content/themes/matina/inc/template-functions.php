<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Matina
 */

if ( ! function_exists( 'matina_body_classes' ) ) :

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 *
	 * @since 1.0.0
	 */
	function matina_body_classes( $classes ) {

        global $post;

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}

		$matina_site_layout = get_theme_mod( 'matina_site_layout', 'full-width' );
    	$classes[] = 'site--'.esc_attr( $matina_site_layout );

    	if ( is_archive() || is_front_page() || is_search() ) {
	        $archive_sidebar   = get_theme_mod( 'matina_archive_sidebar_layout', 'right-sidebar' );
	        $archive_layout    = get_theme_mod( 'matina_archive_layout', 'layout-default' );
            $archive_style    = get_theme_mod( 'matina_archive_style', 'masonry' );
	        $classes[] = esc_attr( $archive_sidebar );
	        $classes[] = 'archive--'. esc_attr( $archive_layout );
            $classes[] = 'archive-style--'. esc_attr( $archive_style );
	    }

        if ( is_404() ) {
            $error_page_layout = get_theme_mod( 'matina_404_page_layout', 'layout-default' );
            $classes[] = 'error--'. esc_attr( $error_page_layout );
        }

        if ( is_single() ) {
            $post_layout            = get_theme_mod( 'matina_single_posts_layout', 'layout-default' );
            $single_meta_layout     = get_post_meta( $post->ID, 'post_layout', true );
            $single_meta_layout = empty( $single_meta_layout ) ? 'default-layout' : $single_meta_layout;
            if ( 'default-layout' !== $single_meta_layout ) {
                $post_layout = $single_meta_layout;
            }
            $single_sidebar         = get_theme_mod( 'matina_single_posts_sidebar_layout', 'right-sidebar' );
            $single_meta_sidebar    = get_post_meta( $post->ID, 'post_sidebar', true );
            $single_meta_sidebar = empty( $single_meta_sidebar ) ? 'default-sidebar' : $single_meta_sidebar;
            if ( 'default-sidebar' !== $single_meta_sidebar ) {
                $single_sidebar = $single_meta_sidebar;
            }
            $classes[] = esc_attr( $single_sidebar );
            $classes[] = 'single--'. esc_attr( $post_layout );
        }

        if ( is_page() && ! is_front_page() ) {
            $single_sidebar = get_theme_mod( 'matina_single_pages_sidebar_layout', 'right-sidebar' );
            $classes[] = esc_attr( $single_sidebar );
        }

        if ( wp_is_mobile() ) {
            $mobile_sidebar_order = get_theme_mod( 'matina_single_posts_mobile_sidebar_order', 'content-sidebar' );
            $classes[] = 'mobile-layout--'.esc_attr( $mobile_sidebar_order );
        }

		return $classes;
	}

endif;

add_filter( 'body_class', 'matina_body_classes' );

if ( ! function_exists( 'matina_pingback_header' ) ) :
	
	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 *
	 * @since 1.0.0
	 */
	function matina_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

endif;
add_action( 'wp_head', 'matina_pingback_header' );

/**
 * Enqueue admin scripts and styles.
 */
function matina_admin_scripts( $hook ) {

    // Only needed on these admin screens
    if ( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) {
        return;
    }

    global $matina_theme_version;

    wp_enqueue_script( 'jquery-ui-button' );

    wp_enqueue_style( 'matina-metabox-style', get_template_directory_uri() . '/inc/metaboxes/assets/css/mt-metabox.css', array(), esc_attr( $matina_theme_version ) );

    wp_enqueue_script( 'matina-metabox-script', get_template_directory_uri() . '/inc/metaboxes/assets/js/mt-metabox.js', array( 'jquery' ), esc_attr( $matina_theme_version ), true );
}
add_action( 'admin_enqueue_scripts', 'matina_admin_scripts' );

/**
 * Enqueue scripts and styles.
 */
function matina_scripts() {

	global $matina_theme_version;

    wp_enqueue_style( 'matina-google-fonts', matina_enqueue_google_fonts(), array(), null );

    // Remove font awesome style from plugins
    wp_deregister_style( 'font-awesome' );
    wp_deregister_style( 'fontawesome' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/all.min.css', '', '5.10.2', 'all' );

	wp_enqueue_style( 'lightslider-style', get_template_directory_uri() . '/assets/library/lightslider/css/lightslider.min.css', array(), '1.1.3' );

    wp_enqueue_style( 'matina-preloader', get_template_directory_uri() . '/assets/css/mt-preloader.min.css', array(), esc_attr( $matina_theme_version ) );

    $dark_mod_option = get_theme_mod( 'matina_dark_mode_option', false );
  
    wp_enqueue_style( 'matina-style', get_stylesheet_uri() );

    wp_enqueue_style( 'matina-responsive-style', get_template_directory_uri() . '/assets/css/mt-responsive.css', array(), esc_attr( $matina_theme_version ) );
    
    if ( true === $dark_mod_option ) {
        wp_enqueue_style( 'matina-dark-mod', get_template_directory_uri() . '/assets/css/mt-dark-styles.css', array(), esc_attr( $matina_theme_version ) );
    }

    wp_enqueue_script( 'lightslider', get_template_directory_uri() . '/assets/library/lightslider/js/lightslider.min.js', array( 'jquery' ), '1.1.6' );

    wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/library/sticky-sidebar/theia-sticky-sidebar.min.js', array( 'jquery' ), '1.7.0' );

	wp_enqueue_script( 'imagesloaded' );

	wp_enqueue_script( 'masonry' );

	wp_enqueue_script( 'matina-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'matina-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'matina-scripts', get_template_directory_uri() . '/assets/js/matina-scripts.js', array( 'jquery' ), esc_attr( $matina_theme_version ), true );

    $sidebar_sticky_option = get_theme_mod( 'matina_sidebar_sticky_option', true );
    if ( true === $sidebar_sticky_option  ) {
        $sidebar_sticky = 'true';
    } else {
        $sidebar_sticky = 'false';
    }

    $header_sticky = get_theme_mod( 'matina_sticky_header_option', true );
    if ( true === $header_sticky ) {
        $header_sticky = 'true';
        wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/assets/library/sticky/jquery.sticky.min.js', array( 'jquery' ), '1.0.2' );
    } else {
        $header_sticky = 'false';
    }

    wp_localize_script( 'matina-scripts', 'MT_JSObject', array( 'sidebar_sticky' => $sidebar_sticky, 'header_sticky' => $header_sticky ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'matina_scripts' );

if ( ! function_exists( 'matina_get_schema_markup' ) ) :

	/**
	 * Return correct schema markup
	 *
	 * @since 1.0.0
	 */
	function matina_get_schema_markup( $location ) {

		// Default
		$schema = $itemprop = $itemtype = '';

		// HTML
		if ( 'html' == $location ) {
			if ( is_home() || is_front_page() ) {
				$schema = 'itemscope="itemscope" itemtype="https://schema.org/WebPage"';
			}
			elseif ( is_category() || is_tag() ) {
				$schema = 'itemscope="itemscope" itemtype="https://schema.org/Blog"';
			}
			elseif ( is_singular( 'post') ) {
				$schema = 'itemscope="itemscope" itemtype="https://schema.org/Article"';
			}
			elseif ( is_page() ) {
				$schema = 'itemscope="itemscope" itemtype="https://schema.org/WebPage"';
			}
			else {
				$schema = 'itemscope="itemscope" itemtype="https://schema.org/WebPage"';
			}
		}

		// Header
		elseif ( 'header' == $location ) {
			$schema = 'itemscope="itemscope" itemtype="https://schema.org/WPHeader"';
		}

		// Logo
		elseif ( 'logo' == $location ) {
			$schema = 'itemscope itemtype="https://schema.org/Brand"';
		}

		// Navigation
		elseif ( 'site_navigation' == $location ) {
			$schema = 'itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement"';
		}

		// Main
		elseif ( 'main' == $location ) {
			$itemtype = 'https://schema.org/WebPageElement';
			$itemprop = 'mainContentOfPage';
		}

		// Sidebar
		elseif ( 'sidebar' == $location ) {
			$schema = 'itemscope="itemscope" itemtype="https://schema.org/WPSideBar"';
		}

		// Footer widgets
		elseif ( 'footer' == $location ) {
			$schema = 'itemscope="itemscope" itemtype="https://schema.org/WPFooter"';
		}

		// Headings
		elseif ( 'headline' == $location ) {
			$schema = 'itemprop="headline"';
		}

		// Posts
		elseif ( 'entry_content' == $location ) {
			$schema = 'itemprop="text"';
		}

		// Publish date
		elseif ( 'publish_date' == $location ) {
			$schema = 'itemprop="datePublished"';
		}

		// Author name
		elseif ( 'author_name' == $location ) {
			$schema = 'itemprop="name"';
		}

		// Author link
		elseif ( 'author_link' == $location ) {
			$schema = 'itemprop="author" itemscope="itemscope" itemtype="https://schema.org/Person"';
		}

		// Item
		elseif ( 'item' == $location ) {
			$schema = 'itemprop="item"';
		}

		// Url
		elseif ( 'url' == $location ) {
			$schema = 'itemprop="url"';
		}

		// Position
		elseif ( 'position' == $location ) {
			$schema = 'itemprop="position"';
		}

		// Image
		elseif ( 'image' == $location ) {
			$schema = 'itemprop="image"';
		}

        // Avatar
        elseif ( 'avatar' == $location ) {
            $schema = 'itemprop="avatar"';
        }

        // Description
        elseif ( 'description' == $location ) {
            $schema = 'itemprop="description"';
        }

		return ' ' . apply_filters( 'matina_schema_markup_items', $schema );

	}

endif;

if ( ! function_exists( 'matina_schema_markup' ) ) :

	/**
	 * Outputs correct schema markup
	 *
	 * @since 1.0.0
	 */
	function matina_schema_markup( $location ) {

		echo matina_get_schema_markup( $location );

	}

endif;

if ( ! function_exists( 'matina_header_classes' ) ) :
    
    /**
     * Add classes to the header wrap
     *
     * @since 1.0.0
     */
    function matina_header_classes( $input_class = '' ) {

        // Setup classes array
        $classes = array();

        if ( ! empty( $input_class ) ) {
            $classes[] = $input_class;
        }

        $search_option  = get_theme_mod( 'matina_header_search_option', true );
        if ( true === $search_option ) {
            $classes[] = 'search--drop-down';
        }

        if ( has_header_image() ) {
            $classes[] = 'has-header-media';
        }

        $classes[] = 'site-header mt-clearfix';

        $classes = array_combine( $classes, $classes );

        $classes = implode( ' ', $classes );

        return $classes;

    }

endif;

if ( ! function_exists( 'matina_font_awesome_social_icon_array' ) ) :

    /**
     * Define font awesome social icons
     *
     * @return array();
     * @since 1.0.0
     */
    function matina_font_awesome_social_icon_array() {

        $social_icon_array = array( "fab fa-tumblr-square","fab fa-tumblr","fab fa-facebook-square","fab fa-facebook-messenger","fab fa-facebook-f","fab fa-facebook","fab fa-linkedin-in","fab fa-linkedin","fab fa-instagram","fab fa-pinterest-square","fab fa-pinterest-p","fab fa-pinterest","fab fa-whatsapp-square","fab fa-whatsapp","fab fa-twitter-square","fab fa-twitter","fab fa-flickr","fab fa-snapchat-square","fab fa-snapchat-ghost","fab fa-snapchat","fab fa-viber","fab fa-digg","fab fa-yelp","fab fa-scribd","fab fa-stumbleupon-circle","fab fa-stumbleupon","fab fa-reddit-square","fab fa-reddit-alien","fab fa-reddit","fab fa-vine","fab fa-vk","fab fa-xing-square","fab fa-xing", "fab fa-youtube-square","fab fa-youtube","fab fa-mix","fab fa-quora","fab fa-meetup","fab fa-twitch","fab fa-skype","fab fa-soundcloud","fab fa-qq","fab fa-line","fab fa-telegram-plane","fab fa-telegram","fab fa-foursquare","fab fa-ravelry","fab fa-deviantart" );

        return $social_icon_array;
    }
    
endif;

if ( ! function_exists( 'matina_social_icons' ) ) :
    
    /**
     * function to display the social icons.
     *
     * @return HTML         Social icons HTML
     * @since 1.0.0
     */
    function matina_social_icons() {
        $default_value = array(
            array(
                'mt_item_icon'      => '',
                'mt_item_link'      => '',
                'mt_item_title'     => '',
                'mt_item_checkbox'  => ''
            )
        );
        $get_social_icons = get_theme_mod( 'matina_social_media', $default_value );
        if ( empty( $get_social_icons ) ) {
            return;
        }
?>
        <div class="matina-social-icons-wrapper mt-clearfix">
            <?php 
                foreach ( $get_social_icons as $social_icon ) {
                    $social_icon_class  = $social_icon['mt_item_icon'];
                    $social_icon_url    = $social_icon['mt_item_link'];
                    $social_icon_title  = $social_icon['mt_item_title'];
                    $social_icon_target = $social_icon['mt_item_checkbox'];
                    if ( '1' == $social_icon_target ) {
                        $target = '_blank';
                    } else {
                        $target = '_self';
                    }
                    echo '<div class="single-icon"><a href="'.esc_url( $social_icon_url ).'" title="'. esc_attr( $social_icon_title ) .'" target="'. esc_attr( $target ) .'"><i class="'.esc_attr( $social_icon_class ).'" aria-hidden="true"></i></a></div>';
                }
            ?>
        </div><!-- .matina-social-icons-wrapper -->
<?php
    }

endif;

if ( ! function_exists( 'matina_slider_custom_options' ) ) :

	/**
	 * function to manage custom option for banner
	 *
	 * @return html
	 * @since 1.0.0
	 */
	function matina_slider_custom_options() {

		// slider control
		$slide_auto_option 		= apply_filters( 'matina_slide_auto_option', 'true' );
		$slider_pager_option    = apply_filters( 'matina_slider_pager_option', 'false' );
		$slider_control_option  = apply_filters( 'matina_slider_control_option', 'true' );
		$slide_pause            = apply_filters( 'matina_slide_pause', '7500' );
		$slide_speed            = apply_filters( 'matina_slide_speed', '2500' );
        $slider_mode_option     = get_theme_mod( 'matina_banner_slide_mode', 'fade' );

		$banner_layout  		= get_theme_mod( 'matina_banner_layout', 'layout-default' );
		$slide_item = 1;
        $slide_mode = $slider_mode_option;

		$slider_data = '';

		$slider_data .= ' data-auto="'. esc_attr( $slide_auto_option ) .'"';
        $slider_data .= ' data-mode="'. esc_attr( $slide_mode ) .'"';
		$slider_data .= ' data-pager="'. esc_attr( $slider_pager_option ) .'"';
		$slider_data .= ' data-control="'. esc_attr( $slider_control_option ) .'"';
		$slider_data .= ' data-pause="'. esc_attr( $slide_pause ) .'"';
		$slider_data .= ' data-speed="'. esc_attr( $slide_speed ) .'"';
		$slider_data .= ' data-item="'. esc_attr( $slide_item ) .'"';

		return $slider_data;

	}

endif;

if ( ! function_exists( 'matina_the_posts_navigation' ) ) :

    /**
     * function to display the archive pagination
     *
     * @since 1.0.0
     */
    function matina_the_posts_navigation() {

        $archive_pagination_type = get_theme_mod( 'matina_archive_pagination_type', 'default' );

        if ( 'default' == $archive_pagination_type ) {
            the_posts_navigation();
        } else {
            the_posts_pagination();
        }
    }

endif;

if ( ! function_exists( 'matina_get_google_font_variants' ) ) :

    /**
     * get Google font variants
     *
     * @since 1.0.0
     */

    function matina_get_google_font_variants() {
        $matina_font_list = get_option( 'matina_google_font' );
        
        $font_family = $_REQUEST['font_family'];

        $variants_array = $matina_font_list[$font_family]['0'];

        $options_array = array();
        foreach ( $variants_array as $variant ) {
            $variant_html = matina_convert_font_variants( $variant );
            $options_array .= '<option value="'.esc_attr( $variant ).'">'. esc_html( $variant_html ).'</option>';
        }
        echo $options_array;
        die();
    }

endif;
add_action( "wp_ajax_get_google_font_variants", "matina_get_google_font_variants" );

if ( ! function_exists( 'matina_convert_font_variants' ) ) :

    /**
     * function to manage the variant name according to their value.
     *
     * @param $value  - string
     * @return string - variant name
     * @since 1.0.0
     */
    function matina_convert_font_variants( $value ) {
        switch ( $value ) {
            case '100':
                return __( 'Thin 100', 'matina' );
                break;

            case '100italic':
                return __( '100 Italic', 'matina' );
                break;

            case '200':
                return __( 'Extra-Light 200', 'matina' );
                break;

            case '200italic':
                return __( '200 Italic', 'matina' );
                break;

            case '300':
                return __( 'Light 300', 'matina' );
                break;

            case '300italic':
                return __( '300 Italic', 'matina' );
                break;

            case '400':
                return __( 'Normal 400', 'matina' );
                break;

            case '400italic':
                return __( '400 Italic', 'matina' );
                break;

            case 'italic':
                return __( '400 Italic', 'matina' );
                break;

            case '500':
                return __( 'Medium 500', 'matina' );
                break;

            case '500italic':
                return __( '500 Italic', 'matina' );
                break;

            case '600':
                return __( 'Semi-Bold 600', 'matina' );
                break;

            case '600italic':
                return __( '600 Italic', 'matina' );
                break;

            case '700':
                return __( 'Bold 700', 'matina' );
                break;

            case '700italic':
                return __( '700 Italic', 'matina' );
                break;

            case '800':
                return __( 'Extra-Bold 800', 'matina' );
                break;

            case '800italic':
                return __( '800 Italic', 'matina' );
                break;

            case '900':
                return __( 'Ultra-Bold 900', 'matina' );
                break;

            case '900italic':
                return __( '900 Italic', 'matina' );
                break;
            
            default:
                break;
        }
    }

endif;

if ( ! function_exists( 'matina_enqueue_google_fonts' ) ) :

    /**
     * Load google fonts from typography sections.
     *
     * @since 1.0.0
     */
    function matina_enqueue_google_fonts() {

        $body_font_family = get_theme_mod( 'body_font_family', 'Open Sans' );
        $body_font_style = get_theme_mod( 'body_font_style', '400' );
        $body_typo = $body_font_family.":".$body_font_style;

        $h1_font_family = get_theme_mod( 'h1_font_family', 'Josefin Sans' );
        $h1_font_style = get_theme_mod( 'h1_font_style', '400' );
        $h1_typo = $h1_font_family.":".$h1_font_style;

        $h2_font_family = get_theme_mod( 'h2_font_family', 'Josefin Sans' );
        $h2_font_style = get_theme_mod( 'h2_font_style', '400' );
        $h2_typo = $h2_font_family.":".$h2_font_style;

        $h3_font_family = get_theme_mod( 'h3_font_family', 'Josefin Sans' );
        $h3_font_style = get_theme_mod( 'h3_font_style', '400' );
        $h3_typo = $h3_font_family.":".$h3_font_style;

        $h4_font_family = get_theme_mod( 'h4_font_family', 'Josefin Sans' );
        $h4_font_style = get_theme_mod( 'h4_font_style', '400' );
        $h4_typo = $h4_font_family.":".$h4_font_style;

        $get_fonts = array( $body_typo , $h1_typo, $h2_typo, $h3_typo, $h4_typo );

        $font_weight_array = array();

        foreach ( $get_fonts as $fonts ) {
            $each_font = explode( ':', $fonts );
            if ( ! isset ( $font_weight_array[$each_font[0]] ) ) {
                $font_weight_array[$each_font[0]][] = $each_font[1];
            } else {
                if ( ! in_array( $each_font[1], $font_weight_array[$each_font[0]] ) ) {
                    $font_weight_array[$each_font[0]][] = $each_font[1];
                }
            }
        }

        $final_font_array = array();
        
        foreach ( $font_weight_array as $font => $font_weight ) {
            $each_font_string = $font.':'.implode( ',', $font_weight );
            $final_font_array[] = $each_font_string;
        }

        $final_font_string = implode( '|', $final_font_array );

        $google_fonts_url = '';

        if ( $final_font_string ) {
            $query_args = array(
                'family' => urlencode( $final_font_string ),
                'subset' => urlencode( 'latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic,khmer,devanagari,arabic,hebrew,telugu' )
            );

            $google_fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $google_fonts_url;
    }

endif;

if ( ! function_exists( 'matina_css_strip_whitespace' ) ) :
    
    /**
     * Get minified css and removed space
     *
     * @since 1.0.0
     */
    function matina_css_strip_whitespace( $css ) {
        $replace = array(
            "#/\*.*?\*/#s" => "",  // Strip C style comments.
            "#\s\s+#"      => " ", // Strip excess whitespace.
        );
        $search = array_keys( $replace );
        $css    = preg_replace( $search, $replace, $css );

        $replace = array(
            ": "  => ":",
            "; "  => ";",
            " {"  => "{",
            " }"  => "}",
            ", "  => ",",
            "{ "  => "{",
            ";}"  => "}", // Strip optional semicolons.
            ",\n" => ",", // Don't wrap multiple selectors.
            "\n}" => "}", // Don't wrap closing braces.
            "} "  => "}\n", // Put each rule on it's own line.
        );

        $search = array_keys( $replace );
        $css    = str_replace( $search, $replace, $css );

        return trim( $css );
    }

endif;

if ( ! function_exists( 'matina_get_image_hover_class' ) ) :

    /**
     * function to manage the image hover class
     *
     * @since 1.0.0
     */
    function matina_get_image_hover_class() {
        $hover_class = '';

        $hover_option = get_theme_mod( 'matina_image_hover_option', true );
        $permalink_option = get_theme_mod( 'matina_image_permalink_option', true );
        
        if ( false !== $hover_option && false !== $permalink_option ) {
            $hover_class = get_theme_mod( 'matina_image_hover_style', 'zoomin' );
        }

        return apply_filters( 'matina_image_hover_class', $hover_class );
    }

endif;

if ( ! function_exists( 'matina_get_post_thumbnail_class' ) ) :

    /**
     * get post extra class according to their post thumbnail or fallback image.
     *
     * @since 1.0.0
     */
    function matina_get_post_thumbnail_class() {

        if ( has_post_thumbnail() ) {
            $custom_class = 'has-thumbnail';
        } else {
            $custom_class = 'no-thumbnail';
        }

        return $custom_class;

    }

endif;

if ( ! function_exists( 'matina_layout_three_thumbnail' ) ) :

    /**
     * function to manage the thumbnail section above container
     *
     * @since 1.0.0
     */
    function matina_layout_three_thumbnail() {

        if ( ! is_single() ) {
            return;
        }

        wp_reset_postdata();
        global $post;

        $author_id      = $post->post_author;
        $author_name    = get_the_author_meta( 'display_name' , $author_id );

        // get posts format
        $format = get_post_format();

        echo '<div class="layout-thumbnail-wrapper">';

        // article featured image
        get_template_part( 'template-parts/partials/single/media/entry-thumbnail', $format );
    ?>
        <div class="image-content-wrapper">
            <?php
                // article categories
                get_template_part( 'template-parts/partials/single/entry', 'category' );

                // article title
                get_template_part( 'template-parts/partials/single/entry', 'title' );
            ?>
            <div class="meta-content-wrapper">
                <div class="posted-on">
                    <span class="day"><?php echo get_the_date( 'j' ); ?></span>
                    <span class="month"><?php echo get_the_date( 'M' ); ?></span>
                </div><!-- .posted-on -->
                <?php
                    // article author
                    matina_posted_by();
                    
                    // article comment link
                    matina_post_comments_link();
                ?>
            </div><!-- .meta-content-wrapper -->
        </div><!-- .image-content-wrapper -->
    <?php
        echo '</div><!-- .layout-thumbnail-wrapper -->';
    }

endif;

$post_layout = get_theme_mod( 'matina_single_posts_layout', 'layout-default' );

if ( 'layout-three' === $post_layout ) {
    add_action( 'matina_before_content_container', 'matina_layout_three_thumbnail', 10 );
}


if ( ! function_exists( 'matina_post_format_featured_image_option' ) ) :

    /**
     * function to manage the post featured image by post format content.
     *
     * @since 1.0.0
     */
    function matina_post_format_featured_image_option() {
        if ( is_archive() || is_home() ) {
            $featured_image_option = get_theme_mod( 'general_archive_featured_image_option', false );
        } else {
            $featured_image_option = apply_filters( 'general_single_featured_image_option', false );
        }

        return $featured_image_option;
    }

endif;

if ( ! function_exists( 'matina_get_the_title' ) ) {

    /**
     * function to return page title
     *
     * @since 1.0.0
     */
    function matina_get_the_title() {

        $post_id = get_the_ID();

        if ( is_front_page() && ! is_singular( 'page' ) ) {
            $title = get_bloginfo( 'description' );
        } elseif ( is_home() && ! is_singular( 'page' ) ) {
            $page_for_posts_id = get_option( 'page_for_posts', true );
            $title = get_the_title( $page_for_posts_id );
        } elseif ( is_archive() ) {
            $title = get_the_archive_title();
        } elseif ( is_search() ) {
            $title = sprintf( esc_html__( 'Search Results for: %s', 'matina' ), '<span>' . get_search_query() . '</span>' );
        } elseif ( is_404() ) {
            $title = esc_html( '404 Error', 'matina' );
        } else {
            $title = get_the_title(  $post_id );
        }

        $get_the_title = $title ? $title : get_the_title();

        return $get_the_title;

    }

}

if ( ! function_exists( 'matina_breadcrumb_content' ) ) :

    /**
     * Function to display breadcrumbs
     *
     * @since 1.0.0
     */
    function matina_breadcrumb_content() {
        $matina_breadcrumbs = get_theme_mod( 'matina_breadcrumbs', true );
        if ( false == $matina_breadcrumbs || is_front_page() ) {
            return;
        }
        
        if ( matina_is_active_woocommerce() && is_woocommerce() ) {
            $bread_home_text = get_theme_mod( 'matina_breadcrumbs_home_lable', __( 'Home', 'matina' ) );
            $args = array (
                'wrap_before'   => '<div class="woocommerce-breadcrumbs"> <div class="mt-container"> <div class="woocommerce-breadcrumbs-wrapper">',
                'wrap_after'    => '</div> </div> </div>',
                'home'          => $bread_home_text
            );
            woocommerce_breadcrumb( $args );
        } else {
            if ( ! function_exists( 'breadcrumb_trail' ) ) {
                require_once get_template_directory() . '/inc/class-breadcrumbs.php';
            }

            $breadcrumb_args = array (
                'container'   => 'div',
                'before'      => '<div class="mt-container">',
                'after'       => '</div>',
                'show_browse' => false,
            );
            breadcrumb_trail( $breadcrumb_args );
        }
    }

endif;

if ( ! function_exists( 'matina_breadcrumbs_labels' ) ) :

    /**
     * Custom breadcrumbs labels
     *
     * @since 1.0.0
     */
    function matina_breadcrumbs_labels( $defaults ) {

        $defaults['home'] = get_theme_mod( 'matina_breadcrumbs_home_lable', __( 'Home', 'matina' ) );

        return $defaults;
    }

endif;

add_filter( 'breadcrumb_trail_labels', 'matina_breadcrumbs_labels' );

if ( ! function_exists( 'matina_is_active_woocommerce' ) ) :
    
    /**
     * Check if woocommerce is activated.
     */
    function matina_is_active_woocommerce() {
        if ( class_exists( 'WooCommerce' ) ) {
            return true;
        } else {
            return false;
        }
    }

endif;

if ( ! function_exists( 'matina_get_footer_classes' ) ) :

    /**
     * function to return footer extra class according to bg image
     *
     * @since 1.0.0
     */
    function matina_get_footer_classes( $classes = NULL ) {

        $bg_type = get_theme_mod( 'matina_footer_background_type', 'bg_image' );
        $bg_image = get_theme_mod( 'matina_footer_background_image_url' );

        if ( 'bg_image' === $bg_type && !empty( $bg_image ) ) {
            $classes .= ' has-bg-image';
        }
        
        return $classes;
    }

endif;

if ( ! function_exists( 'matina_footer_overlay' ) ) :

    /**
     * function to display footer overlay div structure while bg image has been selected.
     *
     * @since 1.0.0
     */
    function matina_footer_overlay() {
        $footer_bg_type             = get_theme_mod( 'matina_footer_background_type', 'bg_image' );
        $footer_background_image    = get_theme_mod( 'matina_footer_background_image_url' );

        if ( 'bg_image' === $footer_bg_type && !empty( $footer_background_image ) ) {
            echo '<div class="overlay-footer-image"></div>';
        } else {
            return;
        }
    }

endif;

add_filter( 'wp_kses_allowed_html', 'matina_wp_kses_post_tags' , 10, 2 );

if ( ! function_exists( 'matina_wp_kses_post_tags' ) ) :
    
    /**
     * Add iFrame to allowed wp_kses_post tags
     *
     * @param array  $tags Allowed tags, attributes, and/or entities.
     * @param string $context Context to judge allowed tags by. Allowed values are 'post'.
     *
     * @return array
     *
     * @since 1.0.3
     */
    function matina_wp_kses_post_tags( $tags, $context ) {

        if ( 'post' === $context ) {
            $tags['iframe'] = array(
                'src'             => true,
                'height'          => true,
                'width'           => true,
                'frameborder'     => true,
                'allowfullscreen' => true
            );
            $tags['time'] = array(
                'class'     => true,
                'datetime'  => true
            );
        }

        return $tags;
    }

endif;

if ( ! function_exists( 'matina_get_string' ) ) :

    /**
     * get the required strings from content string.
     *
     * @return string $found
     *
     * @since 1.0.0
     */
    function matina_get_string( $string, $start, $end ) {
        $found = array();
        $pos = 0;
        while( true ) {
            $pos = strpos( $string, $start, $pos );
            if ( $pos === false ) { // Zero is not exactly equal to false...
                return $found;
            }
            $pos += strlen( $start );
            $len = strpos( $string, $end, $pos ) - $pos;
            $found[] = substr( $string, $pos, $len );
        }
    }

endif;