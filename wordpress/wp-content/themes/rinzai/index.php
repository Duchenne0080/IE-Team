<?php
/**
 * The main template file.
 */

get_header(); ?>

<main>

    <?php
    /**
     * Functions hooked into rinzai_before_blog_posts action
     *
     * @hooked rinzai_customizer_header_video_markup()        - 0
     */
    do_action( 'rinzai_before_blog_posts' ); ?>

    <?php if ( have_posts() ) : ?>

        <div class="uk-container uk-section-small">
            <div class="uk-grid-large" data-uk-grid>

                <?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>

                    <div class="uk-width-2-3@m">
                        <div class="uk-grid-medium uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@l" data-uk-height-match="target: > article; row: true" data-uk-grid>

                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'partials/post/content', get_post_format() ); ?>
                            <?php endwhile; ?>

                        </div>
                    </div>

                    <div class="uk-width-1-3@m">
                        <?php get_sidebar(); ?>
                    </div>

                <?php else : ?>

                    <div class="uk-width-1-1">
                        <div class="uk-grid-medium uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" data-uk-height-match="target: > article; row: true" data-uk-grid>
                            
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'partials/post/content', get_post_format() ); ?>
                            <?php endwhile; ?>

                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>

        <?php rinzai_print_posts_pagination(); ?>

    <?php else : ?>

        <div class="uk-flex uk-flex-center uk-flex-middle" data-uk-height-viewport="expand: true">
            <?php get_template_part( 'partials/post/content', 'none' ); ?>
        </div>

    <?php endif; ?>

</main>


<?php get_footer(); ?>
