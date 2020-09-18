<?php
/**
 * Template is displaying custom header title and subtitle without featured image or custom header video.
 */
?>

<div id="rinzai-custom-header-content" class="uk-section-small uk-padding-remove-bottom">
    <div class="uk-container">
        <?php rinzai_breadcrumb(); ?>
        <h1 class="title uk-h1 uk-margin-small">
            <?php echo get_theme_mod( 'rinzai_blog_title', get_bloginfo( 'name' ) ); ?>
        </h1>
        <div class="subtitle page-content uk-width-xlarge">
            <?php echo get_theme_mod( 'rinzai_blog_subtitle', get_bloginfo( 'description' ) ); ?>
        </div>
    </div>
</div>
