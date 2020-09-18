<?php
/**
 * Template part for displaying archive layout default.
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

        // article category
        get_template_part( 'template-parts/partials/archive/entry', 'category' );

        // article title
        get_template_part( 'template-parts/partials/archive/entry', 'title' );

        // article content
        get_template_part( 'template-parts/partials/archive/entry', 'content' );

        // article readmore
        get_template_part( 'template-parts/partials/archive/entry', 'readmore' );

        // article entry footer
        get_template_part( 'template-parts/partials/archive/entry', 'footer' );

    ?>

</article><!-- #post-<?php the_ID(); ?> -->
