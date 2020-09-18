<?php
/**
 * Template part for displaying single post layout one.
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

        // article categories
        get_template_part( 'template-parts/partials/single/entry', 'category' );

        // article title
        get_template_part( 'template-parts/partials/single/entry', 'title' );

        // article posted on
        matina_posted_on();

        // article featured image
        get_template_part( 'template-parts/partials/single/media/entry-thumbnail', $format );

        // article meta
        get_template_part( 'template-parts/partials/single/entry', 'meta' );

        // article content
        get_template_part( 'template-parts/partials/single/entry', 'content' );
        
        // article tags
        get_template_part( 'template-parts/partials/single/entry', 'tags' );

        // article author box
        get_template_part( 'template-parts/partials/single/entry', 'author-box' );

        // article navigation
        get_template_part( 'template-parts/partials/single/entry', 'navigation' );

        // article comments
        get_template_part( 'template-parts/partials/single/entry', 'comments' );

        // related posts
        get_template_part( 'template-parts/partials/single/entry', 'related-posts' );
    ?>
</article><!-- #post-<?php the_ID(); ?> -->