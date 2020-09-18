<?php
/**
 * Rinzai Customizer functions.
 */

if ( ! function_exists( 'rinzai_customizer_panel_count' ) ) :
    /**
     * Return number of active panels.
     */
    function rinzai_customizer_panel_count() {

    	$panel_count = 0;

        /**
         * Filter number of front page sections in Rinzai theme.
         *
         * @param int $num_sections Number of front page sections.
         */
        $num_sections = apply_filters( 'rinzai_front_page_sections', 4 );

    	// Create a setting and control for each of the sections available in the theme.
    	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
    		if ( get_theme_mod( 'panel_' . $i ) ) {
    			$panel_count++;
    		}
    	}

    	return $panel_count;
    }
endif;

if ( ! function_exists( 'rinzai_customizer_front_page_section' ) ) :
    /**
     * Display a front page panel content.
     *
     * @param WP_Customize_Partial $partial Partial associated with a selective refresh request.
     * @param integer              $id Front page section to display.
     */
    function rinzai_customizer_front_page_section( $partial = null, $id = 0 ) {
        if ( is_a( $partial, 'WP_Customize_Partial' ) ) {
    		// Find out the id and set it up during a selective refresh.
    		global $rinzaicounter;

            $id            = str_replace( 'panel_', '', $partial->id );
    		$rinzaicounter = $id;
    	}

    	global $post; // Modify the global post object before setting up post data.

    	if ( get_theme_mod( 'panel_' . $id ) ) {
    		$post = get_post( get_theme_mod( 'panel_' . $id ) );
    		setup_postdata( $post );
    		set_query_var( 'panel', $id );

    		get_template_part( 'partials/page/content', 'front-page-panel' );

    		wp_reset_postdata();
    	} elseif ( is_customize_preview() ) {
    		// The output placeholder anchor.
    		echo '<article class="panel-placeholder uk-container uk-section-xsmall uk-padding-remove-bottom panel' . $id . '" id="panel' . $id . '"><span class="panel-title">' . sprintf( __( 'Front Page Section %1$s Placeholder', 'rinzai' ), $id ) . '</span></article>';
    	}
    }
endif;

if ( ! function_exists( 'rinzai_customizer_header_video_active_callback' ) ) :
    /**
     * Define where to show custom header with video.
     */
    function rinzai_customizer_header_video_active_callback() {

        if ( is_home() ) {
            return true;
        }

        return false;
    }
endif;

if ( ! function_exists( 'rinzai_customizer_header_video_markup' ) ) :
    /**
     * Display custom header video markup.
     */
    function rinzai_customizer_header_video_markup() {
        /**
    	 * Filter classes applied to header video section.
    	 *
    	 * @param string $custom_header_classes Classes applied to custom header section.
    	 */
        $header_video_classes = apply_filters( 'rinzai_header_video_classes', 'uk-height-large uk-margin-bottom' );

        // Don't show header video on "paged" page.
        if ( is_paged() )
            return;

        if ( has_header_video() || has_custom_header() ) :
        ?>
            <div id="rinzai-header-video" class="<?php echo esc_attr( $header_video_classes ); ?> uk-cover-container uk-flex uk-flex-middle">
                <?php
                if ( has_header_video() ) :
                    get_template_part( 'partials/custom-header/blog', 'video' );
                else :
                    get_template_part( 'partials/custom-header/blog', 'image' );
                endif;

                get_template_part( 'partials/custom-header/blog', 'content' );
                ?>
            </div>
        <?php
        elseif ( get_the_post_thumbnail_url( get_queried_object_id() ) ) :
        ?>
            <div class="<?php echo esc_attr( $header_video_classes ); ?> uk-cover-container uk-flex uk-flex-middle">
                <?php
                get_template_part( 'partials/custom-header/blog', 'featured-image' );
                get_template_part( 'partials/custom-header/blog', 'content' );
                ?>
            </div>
        <?php
        else :
            get_template_part( 'partials/custom-header/blog', 'content-no-featured-image' );
        endif;
    }
endif;

if ( ! function_exists( 'rinzai_customizer_navbar_social_menu_display' ) ) :
    /**
     * Display social menu in the navbar.
     */
    function rinzai_customizer_navbar_social_menu_display() {
        if ( ! has_nav_menu( 'social' ) ) {
            return;
        }

        if ( get_theme_mod( 'rinzai_navbar_social_menu_display' ) == 'yes' ) {
        ?>
            <div id="rinzai-navbar-social-menu" class="uk-visible@m">
                <nav class="uk-navbar-container">
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
            </div>
        <?php
        }
    }
endif;

if ( ! function_exists( 'rinzai_customizer_sanitize_display_toggle' ) ) :
    /**
     * Sanitize the display option.
     *
     * @param string $input Display or not some element on the page.
     */
    function rinzai_customizer_sanitize_display_toggle( $input ) {
    	$valid = array( 'yes', 'no' );

    	if ( in_array( $input, $valid, true ) ) {
    		return $input;
    	}

    	return 'no';
    }
endif;
