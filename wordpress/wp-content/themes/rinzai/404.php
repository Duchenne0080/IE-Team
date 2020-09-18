<?php
/**
 * The template for displaying 404 page.
 */
?>

<?php get_header(); ?>

    <main class="uk-flex uk-flex-center uk-flex-middle" data-uk-height-viewport="expand: true">

        <section class="uk-container uk-section-small">
            <header>
                <h1 class="uk-h1 uk-text-center"><?php _e( 'Oops! That page can&rsquo;t be found.', 'rinzai' ); ?></h1>
            </header>

            <div class="uk-text-center">
                <p><?php _e( 'Looks like nothing was found. Maybe try a search?', 'rinzai' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        </section>

    </main>

<?php get_footer(); ?>
