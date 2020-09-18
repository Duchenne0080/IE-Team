<?php
/**
 * The front page template file.
 */

get_header(); ?>

<main>
    <?php
	// Show the selected front page content.
	if ( have_posts() ) :

        if ( rinzai_is_static_front_page() ) :
            the_post();
            get_template_part( 'partials/page/content', 'front-page' );
        else :
            /**
             * Functions hooked into rinzai_before_blog_posts action
             *
             * @hooked rinzai_customizer_header_video_markup()        - 0
             */
            do_action( 'rinzai_before_blog_posts' );
            ?>
            <div class="uk-container uk-section-small">
                <div class="uk-grid-medium uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" data-uk-height-match="target: > article; row: true" data-uk-grid>
                    <?php
                    while ( have_posts() ) :
            			the_post();
                        get_template_part( 'partials/post/content', get_post_format() );
            		endwhile;
                    ?>
                </div>
            </div>
            <?php
        endif;
        rinzai_print_posts_pagination();
    else :
        ?>
        <div class="uk-flex uk-flex-center uk-flex-middle" data-uk-height-viewport="expand: true">
            <?php get_template_part( 'partials/page/content', 'none' ); ?>
        </div>
        <?php
    endif;
	?>
</main>


<?php get_footer(); ?>
