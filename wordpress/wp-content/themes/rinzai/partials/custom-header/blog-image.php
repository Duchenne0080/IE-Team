<?php
/**
 * Template is displaying custom header image on blog page.
 */

 $video_settings = get_header_video_settings();
 ?>
<img src="<?php echo esc_url( $video_settings['posterUrl'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" data-uk-cover>
<div class="uk-overlay uk-overlay-primary uk-position-cover"></div>
