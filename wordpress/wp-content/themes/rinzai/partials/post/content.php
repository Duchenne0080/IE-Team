<?php
/**
 * The default template for displaying content.
 */
?>

<article id="post-<?php the_ID(); ?>" class="uk-margin-remove-bottom">
    <header class="post-header">
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
                <figure class="uk-margin-bottom uk-transition-toggle uk-inline-clip">
                    <?php the_post_thumbnail( 'medium' ); ?>
                    <div class="uk-overlay-default uk-position-cover uk-transition-fade">
                        <div class="uk-position-center">
                            <span data-uk-overlay-icon></span>
                        </div>
                    </div>
                </figure>
            </a>
        <?php endif; ?>
        <h2 class="uk-h5 uk-margin-small">
            <a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
        <div class="uk-article-meta uk-margin-small-bottom">
            <div class="uk-text-meta">
                <?php rinzai_post_meta(); ?>
            </div>
        </div>
    </header>
    <div class="tm-excerpt uk-margin-small-bottom">
        <a class="uk-link-reset" href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
            <?php the_excerpt(); ?>
        </a>
    </div>
    <footer>
        <?php rinzai_show_post_categories(); ?>
    </footer>
</article>
