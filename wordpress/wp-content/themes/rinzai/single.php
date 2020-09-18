<?php
/**
 * Single post template file.
 */
get_header(); ?>

<main>

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="uk-container uk-section-small">
            <div class="uk-grid-large" data-uk-grid>

                <?php if ( is_active_sidebar( 'post-sidebar' ) ) : ?>

                    <div class="uk-width-2-3@m">
                        <?php get_template_part( 'partials/post/content', 'single' ); ?>

                        <?php get_template_part( 'partials/post/content', 'post-links' ); ?>

                        <?php if ( comments_open() || get_comments_number() ) : ?>
                            <?php comments_template(); ?>
                        <?php endif; ?>
                    </div>

                    <div class="uk-width-1-3@m">
                        <?php get_sidebar( 'post' ); ?>
                    </div>

                <?php else : ?>

                    <div class="uk-width-2-3@m uk-margin-auto">
                        <?php get_template_part( 'partials/post/content', 'single' ); ?>

                        <?php get_template_part( 'partials/post/content', 'post-links' ); ?>

                        <?php if ( comments_open() || get_comments_number() ) : ?>
                            <?php comments_template(); ?>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>

            </div>
        </div>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
