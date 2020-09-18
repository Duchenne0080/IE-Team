<?php
/**
 * Theme helper functions.
 */

if ( ! function_exists( 'rinzai_javascript_detection' ) ) :
    /**
     * Handles JavaScript detection.
     */
    function rinzai_javascript_detection() {
        echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
    }
endif;

if ( ! function_exists( 'rinzai_active_menu_css_class' ) ) :
    /**
     * Add UIkit uk-active class for active element.
     */
    function rinzai_active_menu_css_class( $classes, $item ) {
        if ( in_array( 'current-menu-item', $classes ) ) {
            $classes[] = 'uk-active ';
        }
        return $classes;
    }
endif;

if ( ! function_exists( 'rinzai_social_menu_icons' ) ) :
    /**
    * Add UIkit icons to the social menu links.
    */
    function rinzai_social_menu_icons( $atts, $item, $args ) {

    	// Don't touch offcanvas social menu.
    	if ( $args->walker instanceof Rinzai_Offcanvas_Nav_Walker ) {
    		return $atts;
    	}

        // Check if item url has a certain string and add UIkit icon attribute to link if so.
        if ( $args->theme_location == 'social' ) {
            $atts['target'] = '_blank';
    		$atts['class'] = 'uk-icon-button';

            if ( strpos( $item->url, 'facebook.com' ) ) {
                $atts['data-uk-icon'] = 'icon: facebook; ratio: .8';
            }

            if ( strpos( $item->url, 'twitter.com' ) ) {
                $atts['data-uk-icon'] = 'twitter';
            }

            if ( strpos( $item->url, 'youtube.com' ) ) {
                $atts['data-uk-icon'] = 'youtube';
            }

            if ( strpos( $item->url, 'dribbble.com' ) ) {
                $atts['data-uk-icon'] = 'dribbble';
            }

            if ( strpos( $item->url, 'github.com' ) ) {
                $atts['data-uk-icon'] = 'github';
            }

            if ( strpos( $item->url, 'flickr.com' ) ) {
                $atts['data-uk-icon'] = 'flickr';
            }

            if ( strpos( $item->url, 'behance.net' ) ) {
                $atts['data-uk-icon'] = 'behance';
            }

            if ( strpos( $item->url, 'foursquare.com' ) ) {
                $atts['data-uk-icon'] = 'foursquare';
            }

            if ( strpos( $item->url, 'google.com' ) ) {
                $atts['data-uk-icon'] = 'google';
            }

            if ( strpos( $item->url, 'plus.google.com' ) ) {
                $atts['data-uk-icon'] = 'google-plus';
            }

            if ( strpos( $item->url, 'instagram.com' ) ) {
                $atts['data-uk-icon'] = 'icon: instagram; ratio: .8';
            }

            if ( strpos( $item->url, 'linkedin.com' ) ) {
                $atts['data-uk-icon'] = 'linkedin';
            }

            if ( strpos( $item->url, 'pinterest.com' ) ) {
                $atts['data-uk-icon'] = 'pinterest';
            }

            if ( strpos( $item->url, 'soundcloud.com' ) ) {
                $atts['data-uk-icon'] = 'soundcloud';
            }

            if ( strpos( $item->url, 'tripadvisor.com' ) ) {
                $atts['data-uk-icon'] = 'tripadvisor';
            }

            if ( strpos( $item->url, 'tumblr.com' ) ) {
                $atts['data-uk-icon'] = 'tumblr';
            }

            if ( strpos( $item->url, 'vimeo.com' ) ) {
                $atts['data-uk-icon'] = 'vimeo';
            }

            if ( strpos( $item->url, 'whatsapp.com' ) ) {
                $atts['data-uk-icon'] = 'whatsapp';
            }

            if ( strpos( $item->url, 'wordpress.org' ) ) {
                $atts['data-uk-icon'] = 'wordpress';
            }

            if ( strpos( $item->url, 'xing.com' ) ) {
                $atts['data-uk-icon'] = 'xing';
            }

            if ( strpos( $item->url, 'yelp.com' ) ) {
                $atts['data-uk-icon'] = 'yelp';
            }

            if ( strpos( $item->url, 'vk.com' ) ) {
                $atts['data-uk-icon'] = 'icon: vk; ratio: .8';
            }

            if ( strpos( $item->url, 'odnoklassniki.ru' ) ) {
                $atts['data-uk-icon'] = 'icon: odnoklassniki; ratio: .8';
            }
        }

        return $atts;
    }
endif;

if ( ! function_exists( 'rinzai_navbar_nav_menu_item_args' ) ) :
    /**
     * Add UIkit chevron-down icon to navbar menu item with childrens.
     */
    function rinzai_navbar_nav_menu_item_args( $args, $item, $depth ) {
        // Don't touch social menu links.
        if ( $args->theme_location == 'social' ) {
            return $args;
        }

        // Don't touch offcanvas navigation for now.
        if ( $args->walker instanceof Rinzai_Offcanvas_Nav_Walker ) {
            return $args;
        }

        // Place chevron down icon after link.
    	if ( $args->walker instanceof Rinzai_Navbar_Walker ) {
    	    $args->link_after = ( $args->walker->has_children )
    			? '<span data-uk-icon="icon: chevron-down; ratio: .75"></span>'
    			: '';
    	}

        return $args;
    }
endif;

if ( ! function_exists( 'rinzai_excerpt_length' ) ) :
    /**
     * Change theme excerpt length.
     */
    function rinzai_excerpt_length( $length ) {
    	if ( is_admin() )
            return $length;

        if ( ! has_post_thumbnail() )
            return 40;

    	return 10;
    }
endif;

if ( ! function_exists( 'rinzai_excerpt_more' ) ) :
    /**
     * Change theme excerpt more text.
     */
    function rinzai_excerpt_more( $more ) {
        if ( is_admin() )
            return $more;

        return '&hellip;';
    }
endif;

if ( ! function_exists( 'rinzai_archive_title' ) ) :
    /**
     * Add UIkit classes and icons to archive titles.
     */
    function rinzai_archive_title( $title ) {
        $html_start = '<span class="uk-text-meta uk-button-text">';
        $html_end = '</span>';

    	$title = __( 'Archives', 'rinzai' );

    	if ( is_category() ) {
            $title = single_cat_title( '<span uk-icon="icon: tag"></span> ', false );
        }

    	if ( is_tag() ) {
            $title = single_tag_title( '<span uk-icon="icon: hashtag"></span> ', false );
        }

    	if ( is_author() ) {
            $title = '<span uk-icon="icon: user"></span> <span>' . get_the_author() . '</span>';
        }

    	if ( is_post_type_archive() ) {
            $title = post_type_archive_title( '<span uk-icon="icon: tag"></span> ', false );
        }

    	return $title;

        return $html_start . $title . $html_end;
    }
endif;

if ( ! function_exists( 'rinzai_generate_tag_cloud' ) ) :
    /**
    * Remove size styling from tag cloud widget.
    */
    function rinzai_generate_tag_cloud( $tag_string ) {
        return preg_replace( '/style=("|\')(.*?)("|\')/', '', $tag_string );
    }
endif;

if ( ! function_exists( 'rinzai_move_comment_field_to_bottom' ) ) :
    /**
     * Move comment field to bottom in the comments form.
     */
    function rinzai_move_comment_field_to_bottom( $fields ) {
    	$comment_field = $fields['comment'];
    	unset( $fields['comment'] );
    	$fields['comment'] = $comment_field;

    	return $fields;
    }
endif;

if ( ! function_exists( 'rinzai_header_logotype' ) ) :
    /**
     * Display logotype.
     */
    function rinzai_header_logotype() {
    	?>
        <a class="uk-navbar-item uk-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <?php
            if ( has_custom_logo() ) :
                the_custom_logo();
            else :
                bloginfo( 'name' );
            endif;
            ?>
        </a>
        <?php
    }
endif;

if ( ! function_exists( 'rinzai_header_navbar' ) ) :
    /**
     * Display navigation.
     */
    function rinzai_header_navbar() {
        if ( has_nav_menu( 'main' ) ) {
            wp_nav_menu( array(
                'theme_location' => 'main',
                'container' => false,
                'menu_class' => 'uk-navbar-nav uk-visible@m',
                'walker' => new Rinzai_Navbar_Walker(),
            ) );
        }
    }
endif;

if ( ! function_exists( 'rinzai_header_search_toggle' ) ) :
    /**
     * Display search icon button.
     */
    function rinzai_header_search_toggle() {
        ?>
        <div class="uk-navbar-item">
            <button class="uk-button uk-button-link" id="show-search-modal" data-uk-toggle="target: #search-modal" data-uk-icon="icon: search; ratio: .98" type="button">
                <span class="screen-reader-text"><?php _e( 'Search', 'rinzai' ); ?></span>
            </button>
        </div>
        <?php
    }
endif;

if ( ! function_exists( 'rinzai_header_mobile_nav_toggle' ) ) :
    /**
     * Display mobile navigation icon button.
     */
    function rinzai_header_mobile_nav_toggle() {
        if ( has_nav_menu( 'main' ) ) :
        ?>
            <div class="uk-navbar-item uk-padding-remove-left uk-hidden@m">
                <button class="uk-button uk-button-link uk-padding-small uk-padding-remove-right" data-uk-navbar-toggle-icon data-uk-toggle="target: #offcanvas" type="button"></button>
            </div>
        <?php
        endif;
    }
endif;

if ( ! function_exists( 'rinzai_show_pageviews' ) ) :
    /**
    * Pageviews plugin integration function.
    */
    function rinzai_show_pageviews() {
       if ( ! has_action( 'pageviews' ) )
           return;

       $post = get_post();
       ?>
       <span class="tm-text-xsmall">
           <span data-uk-icon="icon: forward; ratio: .7" style="position: relative; bottom: 1px;"></span> <span class="pageviews"><?php do_action( 'pageviews' ); ?></span>
       </span>
       <?php
    }
endif;

if ( ! function_exists( 'rinzai_breadcrumb' ) ) :
    /**
    * Show Yoast seo breadcrumb, if they are enabled.
    */
    function rinzai_breadcrumb() {
        if ( function_exists( 'yoast_breadcrumb' ) ) {
            yoast_breadcrumb( '<p id="breadcrumbs" class="tm-text-xsmall">','</p>' );
        }
    }
endif;

if ( ! function_exists( 'rinzai_show_post_date' ) ) :
    /**
    * Show posted on date.
    */
    function rinzai_show_post_date() {
        $posted_on = sprintf( '<time class="date uk-margin-small-right tm-text-xsmall" datetime="%1$s">%2$s</time>',
                             esc_attr( get_the_date('c') ),
                             esc_html( get_the_date('j F Y') )
        );
        ?>
        <span data-uk-icon="icon: clock; ratio: .65" style="position: relative; bottom: 1px;"></span> <span class="posted-on"><?php echo $posted_on; ?></span>
        <?php
    }
endif;

if ( ! function_exists( 'rinzai_show_post_author' ) ) :
    /**
    * Show post author.
    */
    function rinzai_show_post_author() {
        $author = sprintf( '<a class="author-link uk-link-muted uk-margin-small-right" href="%1$s">%2$s</a>',
                          esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                          esc_html( get_the_author() )
        );

        $author_html = sprintf( '<p class="uk-text-small">%1$s <span class="author">%2$s</span></p>', __( 'Author:', 'rinzai' ), $author );

        echo $author_html;
    }
endif;

if ( ! function_exists( 'rinzai_show_page_permalink' ) ) :
    /**
    * Show page permalink. Used in search results.
    */
    function rinzai_show_page_permalink() {
        ?>
        <a href="<?php the_permalink(); ?>" class="uk-text-meta uk-margin-small-bottom">
            <?php _e( 'View page', 'rinzai' ); ?>
        </a>
        <?php
    }
endif;

if ( ! function_exists( 'rinzai_show_post_categories' ) ) :
    /**
    * Show post categories.
    */
    function rinzai_show_post_categories() {
        $categories_list = get_the_category_list( __( '</span>, <span class="uk-link-muted uk-text-small">', 'rinzai' ) );

        if ( $categories_list ) {
            echo '<span class="uk-margin-small-right">';
                echo '<span data-uk-icon="icon: tag; ratio: .7" style="position: relative; bottom: 1px;"></span> ';
                echo '<span class="uk-link-muted uk-text-small">' . $categories_list . '</span>';
            echo '</span>';
        }
    }
endif;

if ( ! function_exists( 'rinzai_show_post_tags' ) ) :
    /**
    * Show tags list.
    */
    function rinzai_show_post_tags() {
        $before_text = sprintf( '<p class="uk-text-small">%s <span class="uk-link-muted">', __( 'Tags:', 'rinzai' ) );

        $tag_list = get_the_tag_list( $before_text, '</span>, <span class="uk-link-muted">', '</span></p>' );

        if ( $tag_list )
            echo $tag_list;
    }
endif;

if ( ! function_exists( 'rinzai_show_comments_number' ) ) :
    /**
    * Show comments number.
    */
    function rinzai_show_comments_number() {
        ?>
        <span class="uk-margin-small-right">
            <span data-uk-icon="icon: comment; ratio: .7" style="position: relative; bottom: 1px;"></span>&nbsp;
            <span class="tm-text-xsmall">
                <?php echo get_comments_number(); ?>
            </span>
        </span>
        <?php
    }
endif;

if ( ! function_exists( 'rinzai_post_meta' ) ) :
    /**
     * Post meta info - publishing date, author and categories list.
     */
    function rinzai_post_meta() {
            rinzai_show_post_date();
            rinzai_show_comments_number();
            rinzai_show_pageviews();
    }
endif;

if ( ! function_exists( 'rinzai_post_single_meta' ) ) :
    /**
     * Post single meta - author, categories list, tags list.
     */
    function rinzai_post_single_meta() {
        rinzai_show_post_date();
        rinzai_show_post_categories();
        rinzai_show_post_tags();
    }
endif;

if ( ! function_exists( 'rinzai_print_posts_pagination' ) ) :
    /**
     * Wrap posts pagination with special markup to style it.
     */
    function rinzai_print_posts_pagination() {

        // Display pagination only if there is more than one page.
        if ( $GLOBALS['wp_query']->max_num_pages < 2 )
    		return;
        ?>
        <div class="uk-container">
            <?php the_posts_pagination( array(
                'end_size' => 2,
                'mid_size' => 2,
                'prev_text' => __( '<', 'rinzai' ),
                'next_text' => __( '>', 'rinzai' ),
                'screen_reader_text' => __( 'Posts Navigation', 'rinzai' ),
            ) ); ?>
        </div>
        <?php
    }
endif;

if ( ! function_exists( 'rinzai_comment_nav' ) ) :
    /**
     * Display comment navigation links.
     */
    function rinzai_comment_nav() {
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
            <nav class="comment-navigation">
                <h2 class="comment-nav-title"><?php _e( 'Comment navigation', 'rinzai' ); ?></h2>
                <div class="comment-nav-links">
                    <?php
                    if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'rinzai' ) ) ) :
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    endif;

                    if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'rinzai' ) ) ) :
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    endif;
                    ?>
                </div>
            </nav>
        <?php
        endif;
    }
endif;

if ( ! function_exists( 'rinzai_footer_sidebar_one' ) ) :
    /**
     * Footer widget area 1.
     */
    function rinzai_footer_sidebar_one() {
        if ( is_active_sidebar( 'footer-1' ) ) :
            ?>
            <div id="footer-1-sidebar" class="uk-width-1-2@s uk-width-1-4@m">
            <?php
                dynamic_sidebar( 'footer-1' );
            ?>
            </div>
            <?php
        endif;
    }
endif;

if ( ! function_exists( 'rinzai_footer_sidebar_two' ) ) :
    /**
     * Footer widget area 2.
     */
    function rinzai_footer_sidebar_two() {
        if ( is_active_sidebar( 'footer-2' ) ) :
            ?>
            <div id="footer-2-sidebar" class="uk-width-1-2@s uk-width-1-4@m">
            <?php
                dynamic_sidebar( 'footer-2' );
            ?>
            </div>
            <?php
        endif;
    }
endif;

if ( ! function_exists( 'rinzai_footer_sidebar_three' ) ) :
    /**
     * Footer widget area 3.
     */
    function rinzai_footer_sidebar_three() {
        if ( is_active_sidebar( 'footer-3' ) ) :
            ?>
            <div id="footer-3-sidebar" class="uk-width-1-2@s uk-width-1-4@m">
            <?php
                dynamic_sidebar( 'footer-3' );
            ?>
            </div>
            <?php
        endif;
    }
endif;

if ( ! function_exists( 'rinzai_footer_sidebar_four' ) ) :
    /**
     * Footer widget area 4.
     */
    function rinzai_footer_sidebar_four() {
        if ( is_active_sidebar( 'footer-4' ) ) :
            ?>
            <div id="footer-4-sidebar" class="uk-width-1-2@s uk-width-1-4@m">
            <?php
                dynamic_sidebar( 'footer-4' );
            ?>
            </div>
            <?php
        endif;
    }
endif;

if ( ! function_exists( 'rinzai_print_footer_left_section' ) ) :
    /**
     * Print footer left section.
     */
    function rinzai_print_footer_left_section() {
        ?>
        <div class="copyright uk-flex-last uk-flex-first@m  uk-text-center uk-text-left@m uk-text-small">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a><?php _e( ' works on <a href="https://wordpress.org" target="_blank" rel="nofollow noopener" class="uk-text-small">WordPress</a>', 'rinzai' ); ?>
            <span>&copy; <?php echo date_i18n( __( 'Y', 'rinzai' ) ); ?></span>
        </div>
        <?php
    }
endif;

if ( ! function_exists( 'rinzai_print_footer_center_section' ) ) :
    /**
     * Print footer center section.
     */
    function rinzai_print_footer_center_section() {
        if ( has_nav_menu( 'social' ) ) :
        ?>
            <nav class="uk-width-auto@m uk-navbar-container" data-uk-navbar>
                <?php wp_nav_menu( array(
                    'theme_location' => 'social',
                    'container' => false,
                    'menu_class' => 'uk-navbar-nav uk-navbar-center',
                    'before' => '<div class="uk-display-inline tm-padding-xsmall">',
                    'after' => '</div>',
                    'link_before' => '<span class="screen-reader-text">',
                    'link_after' => '</span>',
                ) ); ?>
            </nav>
        <?php
        endif;
    }
endif;

if ( ! function_exists( 'rinzai_print_footer_right_section' ) ) :
    /**
     * Print footer right section.
     */
    function rinzai_print_footer_right_section() {
        ?>
        <div class="designer uk-text-center uk-text-right@m uk-text-small">
            <?php _e( 'Rinzai theme by <a href="https://ivanfonin.com" target="_blank" rel="nofollow noopener">Ivan Fonin</a>.', 'rinzai' ); ?>
        </div>
        <?php
    }
endif;

if ( ! function_exists( 'rinzai_print_offcanvas_nav' ) ) :
    /**
     * Print offcanvas navigation markup.
     */
    function rinzai_print_offcanvas_nav() {
        get_template_part( 'partials/offcanvas' );
    }
endif;

if ( ! function_exists( 'rinzai_print_search_modal' ) ) :
    /**
     * Print search modal markup.
     */
    function rinzai_print_search_modal() {
        get_template_part( 'partials/search-modal' );
    }
endif;
