<?php
/**
 * Search template file.
 */
?>

<?php get_header(); ?>

<main>

    <?php if ( have_posts() ) : ?>

        <div class="uk-container">
            <header class="uk-section uk-section-small uk-padding-remove-bottom">
                <h1 class="uk-h2 uk-margin-small">
                    <span data-uk-icon="icon: search"></span> <?php echo get_search_query(); ?>
                </h1>
            </header>

            <div class="uk-section uk-section-small">
                <div class="uk-grid-medium uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" data-uk-height-match="target: > article; row: true" data-uk-grid>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'partials/post/content', 'search' ); ?>
                    <?php endwhile; ?>
                </div>
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
