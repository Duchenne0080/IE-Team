<?php
/**
 * Template part for displaying page panel without featured image.
 */

global $is_even;
global $is_blog_page; ?>

<div class="uk-section <?php echo ( $is_even ) ? 'uk-section-muted' : 'uk-section-default' ?>">
    <div class="uk-container">
        <?php rinzai_breadcrumb(); ?>
        <?php the_title( '<h2 class="uk-h1 uk-margin-small">', '</h2>' ); ?>
        <div class="page-content uk-width-xlarge">
            <?php if ( $is_blog_page ) : ?>
                <div class="blogdescription">
                    <?php echo get_theme_mod( 'rinzai_blog_subtitle', get_bloginfo( 'description' ) ); ?>
                </div>
            <?php else : ?>
                <?php echo rinzai_get_first_paragraph(); ?>
            <?php endif; ?>
        </div>
        <div class="uk-margin">
            <a class="uk-button uk-button-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php _e( 'View page', 'rinzai' ); ?>
            </a>
        </div>
    </div>
</div>
