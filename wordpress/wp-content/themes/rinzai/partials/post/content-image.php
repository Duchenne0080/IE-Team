<?php
/**
 * Template displaying content for image post type format.
 */
?>

<article id="post-<?php the_ID(); ?>" class="uk-margin-remove-bottom">
    <div class="uk-height-1-1 uk-background-norepeat uk-background-cover uk-background-center-center uk-cover-container" style="background-image: url('<?php the_post_thumbnail_url( $size = 'rinzai-post-type-image-thumbnail' ); ?>');">
        <a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>">
            <div class="uk-overlay uk-overlay-primary uk-position-cover"></div>
            <div class="uk-overlay uk-light uk-position-relative">
                <div class="post-meta">
                    <?php rinzai_post_meta(); ?>
                </div>
                <h2 class="post-title uk-h3 uk-margin-top">
                    <?php the_title(); ?>
                </h2>
                <div class="post-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </a>
    </div>
</article>
