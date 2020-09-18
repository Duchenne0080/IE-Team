<?php
/**
 * Page template file.
 */
?>

<?php get_header(); ?>

<main>

    <?php if ( have_posts() ) : ?>

        <div class="uk-container uk-section-small">
            <div class="uk-grid-large" data-uk-grid>

                <?php if ( is_active_sidebar( 'page-sidebar' ) ) : ?>

                    <div class="uk-width-2-3@m">
                        <div class="uk-grid-medium uk-child-width-expand@s" data-uk-grid>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php get_template_part( 'partials/page/content', 'page' ); ?>

                                <?php if ( comments_open() || get_comments_number() ) : ?>
                                    <?php comments_template(); ?>
                                <?php endif; ?>

                            <?php endwhile; ?>
                        </div>
                    </div>

                    <div class="uk-width-1-3@m">
                        <?php get_sidebar( 'page' ); ?>
                    </div>

                <?php else : ?>

                    <div class="uk-width-2-3@m uk-margin-auto">
                        <div class="uk-grid-medium uk-child-width-expand" data-uk-grid>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php get_template_part( 'partials/page/content', 'page' ); ?>

                                <?php if ( comments_open() || get_comments_number() ) : ?>
                                    <?php comments_template(); ?>
                                <?php endif; ?>

                            <?php endwhile; ?>
                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>

    <?php else : ?>

        <div class="uk-flex uk-flex-center uk-flex-middle" data-uk-height-viewport="expand: true">
            <?php get_template_part( 'partials/page/content', 'none' ); ?>
        </div>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
