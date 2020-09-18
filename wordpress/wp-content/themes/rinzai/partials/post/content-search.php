<?php
/**
 * Template for displaying content in search results.
 */
?>

<article id="post-<?php the_ID(); ?>" class="uk-margin-remove-bottom">
    <header>
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

        <?php the_title( sprintf( '<h2 class="uk-h5 uk-margin-small"><a class="uk-link-reset" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    </header>
    <div class="uk-text-small tm-excerpt">
        <?php if ( 'post' == get_post_type() ) : ?>
            <div class="uk-article-meta">
                <?php rinzai_post_meta(); ?>
            </div>
        <?php
        endif;
        the_excerpt();
        ?>
    </div>
    <footer class="uk-text-meta">
        <?php
        if ( 'post' == get_post_type() )
            rinzai_show_post_author();

        if ( 'page' == get_post_type() )
            rinzai_show_page_permalink();
        ?>
    </footer>
</article>
