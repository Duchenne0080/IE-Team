<?php
/**
 * Template part for displaying page panels on front page.
 */

global $rinzaicounter;
global $is_even;
global $is_blog_page;

$is_even = ( $rinzaicounter % 2 == 0 ) ? true : false;
$is_blog_page = ( get_the_ID() === (int) get_option( 'page_for_posts' ) ) ? true : false;
?>

<section id="panel-<?php echo $rinzaicounter; ?>" <?php post_class( 'rinzai-panel ' ); ?> >
    <?php
    if ( has_post_thumbnail() ) :
        get_template_part( 'partials/page/content', 'front-page-panel-with-featured-image' );
    else :
        get_template_part( 'partials/page/content', 'front-page-panel-no-image' );
    endif;
    ?>
</section>
