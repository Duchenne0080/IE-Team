<?php
/**
 * Template part for displaying page panel with featured image.
 */

global $is_even;
global $is_blog_page; ?>

<div class="uk-section">
    <div class="uk-background-norepeat uk-section uk-section-small <?php echo ( $is_even ) ? 'uk-background-center-left' : 'uk-background-center-right' ?>" data-uk-parallax="bgx: <?php echo ( $is_even ) ? esc_attr( 250 ) : esc_attr( -250 ) ?>; media: @m" style="background-image: url('<?php the_post_thumbnail_url( 'large' ); ?>'); ">
        <div class="uk-width-1-1 uk-position-relative">
            <div class="uk-container">
                <div class="uk-flex-middle uk-grid-stack" data-uk-grid>
                    <?php if ( $is_even ) : ?>
                        <div class="uk-width-expand@m"></div>
                    <?php endif; ?>
                    <div class="uk-width-large@m">
                        <div class="uk-tile-default uk-tile page-content">
                            <?php rinzai_breadcrumb(); ?>
                            <?php the_title( '<h2 class="uk-h1 uk-margin-small">', '</h2>' ); ?>
                            <?php if ( $is_blog_page ) : ?>
                                <div class="blogdescription">
                                    <?php echo get_theme_mod( 'rinzai_blog_subtitle', get_bloginfo( 'description' ) ); ?>
                                </div>
                            <?php else : ?>
                                <?php echo rinzai_get_first_paragraph(); ?>
                            <?php endif; ?>
                            <div class="uk-margin">
                                <a class="uk-button uk-button-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php _e( 'View page', 'rinzai' ); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
