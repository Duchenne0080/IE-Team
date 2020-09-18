<?php
/**
 * Template file for displaying front page content.
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
        <section class="uk-background-norepeat uk-background-cover uk-background-center-center uk-cover-container uk-height-large uk-flex uk-flex-middle" style="background-image: url('<?php the_post_thumbnail_url( 'rinzai-featured-image' ); ?>');">
            <div class="uk-overlay uk-overlay-primary uk-position-cover"></div>
            <div class="uk-position-relative uk-width-1-1 uk-light">
                <div class="uk-container">
                    <?php rinzai_breadcrumb(); ?>
                    <?php the_title( '<h1 class="uk-h1 uk-margin-small">', '</h1>' ); ?>
                    <div class="post-content uk-width-xlarge">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php else : ?>
        <section class="uk-section uk-section-small">
            <div class="uk-container">
                <?php rinzai_breadcrumb(); ?>
                <?php the_title( '<h1 class="uk-h1 uk-margin-remove-top uk-margin-medium-bottom">', '</h1>' ); ?>
                <div class="page-content uk-width-xlarge">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
	// Get each of the panel and show page data.
	if ( 0 !== rinzai_customizer_panel_count() || is_customize_preview() ) : // If we have pages to show.
        /**
         * Filter number of front page sections in Rinzai theme.
         *
         * @param int $num_sections Number of front page sections.
         */
        $num_sections = apply_filters( 'rinzai_front_page_sections', 4 );

        global $rinzaicounter;

        // Create a setting and control for each of the sections available in the theme.
        for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
            $rinzaicounter = $i;
            rinzai_customizer_front_page_section( null, $i );
        }
	endif; // The if ( 0 !== rinzai_customizer_panel_count() ) ends here.
	?>

    <?php
    /**
     * Filter number of recent posts to show on the front page.
     *
     * @param int $num_recent_posts Number of recent posts to show on front page.
     */
    $num_recent_posts = apply_filters( 'rinzai_front_page_recent_posts', 4 );

	// Show three most recent posts.
	$recent_posts = new WP_Query(
		array(
			'posts_per_page'      => $num_recent_posts,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	?>

	<?php if ( $recent_posts->have_posts() ) : ?>

        <section class="recent-posts uk-section">
            <div class="uk-container">
                <h2 class="uk-h1 uk-margin-medium">
                    <?php _e( 'Recent posts', 'rinzai' ); ?>
                </h2>
                <div class="uk-grid-medium uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@l" data-uk-height-match="target: > article; row: true" data-uk-grid>
        			<?php
        			while ( $recent_posts->have_posts() ) :
        				$recent_posts->the_post();
        				get_template_part( 'partials/post/content', get_post_format() );
        			endwhile;
        			wp_reset_postdata();
        			?>
        		</div>
            </div>
        </section> <!-- .recent-posts -->
	<?php endif; ?>

    <?php wp_link_pages( array(
        'before'           => '<footer>' . __( 'Pages:', 'rinzai' ),
        'after'            => '</footer>',
        'link_before'      => '',
        'link_after'       => '',
        'next_or_number'   => 'number',
        'separator'        => ' ',
        'nextpagelink'     => __( 'Next page', 'rinzai' ),
        'previouspagelink' => __( 'Previous page', 'rinzai' ),
        'pagelink'         => '%',
        'echo'             => 1
    ) ); ?>

</div>
