<?php
/**
 * Template Name: Full Width Page
 *
 * Page template without sidebar.
 */
__( 'Full Width Page', 'rinzai' ); ?>

<?php get_header(); ?>

    <main>
        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'partials/page/content', 'full-width' ); ?>

            <?php if ( comments_open() || get_comments_number() ) : ?>
                <?php comments_template(); ?>
            <?php endif; ?>

        <?php endwhile; ?>
    </main>

<?php get_footer(); ?>
