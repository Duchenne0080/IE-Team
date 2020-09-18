<?php
/**
 * Template is displaying custom header video on blog page.
 */

$img_url = get_the_post_thumbnail_url( get_queried_object_id(), 'rinzai-featured-image' );

if ( $img_url ) :
?>
    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" data-uk-cover>
    <div class="uk-overlay uk-overlay-primary uk-position-cover"></div>
<?php
endif;
