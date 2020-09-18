<?php
/**
 * Template is displaying custom header video on blog page.
 */

$video_settings = get_header_video_settings();
?>
<video autoplay loop muted playsinline poster="<?php echo esc_url( $video_settings['posterUrl'] ); ?>" data-uk-cover>
    <source src="<?php echo esc_url( $video_settings['videoUrl'] ); ?>" type="<?php echo esc_attr( $video_settings['mimeType'] ); ?>">
</video>
<div class="uk-overlay uk-overlay-primary uk-position-cover"></div>
