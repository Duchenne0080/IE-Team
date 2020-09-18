<?php
/**
 * Template part for displaying archive layout one.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Matina
 */

// define custom post class
$custom_class = 'mt-clearfix ';
$custom_class .= matina_get_post_thumbnail_class();

// get posts format
$format = get_post_format();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $custom_class ); ?>>

    <?php
        // article featured image
        get_template_part( 'template-parts/partials/archive/media/entry-thumbnail', $format );
    ?>
    <div class="post-content-wrapper">
        <div class="posted-on">
            <span class="month"><?php echo get_the_date( 'M' ); ?></span>
            <span class="day"><?php echo get_the_date( 'j' ); ?></span>
        </div><!-- .posted-on -->
        <div class="post-info-wrapper">
            <?php

                // article category
                get_template_part( 'template-parts/partials/archive/entry', 'category' );
                
                // article title
                get_template_part( 'template-parts/partials/archive/entry', 'title' );

                // article content
                get_template_part( 'template-parts/partials/archive/entry', 'content' );

                // article author
                matina_posted_by();

                // article readmore
                get_template_part( 'template-parts/partials/archive/entry', 'readmore' );

                // article entry footer
                get_template_part( 'template-parts/partials/archive/entry', 'footer' );
            ?>
        </div><!-- .post-info-wrapper -->
    </div><!-- .post-content-wrapper -->

</article><!-- #post-<?php the_ID(); ?> -->
