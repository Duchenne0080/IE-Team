<?php
/**
 * Template file for displaying full-width page content.
 */
?>

<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
        <header class="uk-section-muted uk-light">
            <div class="uk-background-norepeat uk-background-cover uk-cover-container uk-background-center-center uk-section uk-section-xlarge" style="background-image: url('<?php the_post_thumbnail_url( 'rinzai-featured-image' ); ?>');">
                <div class="uk-overlay uk-overlay-primary uk-position-cover uk-light uk-flex uk-flex-middle uk-text-center">
                    <?php rinzai_breadcrumb(); ?>
                    <?php the_title( '<h1 class="uk-width-1-1 uk-margin uk-margin-remove-bottom">', '</h1>' ); ?>
                </div>
            </div>
        </header>
    <?php endif; ?>

    <div class="uk-container uk-container-small">
        <div class="uk-section">
            <?php if ( ! has_post_thumbnail() ) : ?>
                <header>
                    <?php rinzai_breadcrumb(); ?>
                    <?php the_title( '<h1 class="uk-h1">', '</h1>' ); ?>
                </header>
            <?php endif; ?>
            <div class="page-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

    <?php wp_link_pages( array(
        'before'           => '<footer>' . __( 'Pages:', 'rinzai' ),
        'after'            => '</footer>',
        'link_before'      => '',
        'link_after'       => '',
        'next_or_number'   => 'number',
        'separator'        => ' ',
        'nextpagelink'     => __( 'Next page', 'rinzai' ),
        'previouspagelink' => __( 'Previous page', 'rinzai' ),
        'pagelink'         => '%',
        'echo'             => 1
    ) ); ?>

</article>
