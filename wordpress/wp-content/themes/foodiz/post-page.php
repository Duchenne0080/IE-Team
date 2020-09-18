<div class="post-content mb-50" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- Thumbnail -->
    <div class="post-thumbnail mb-15">
    <?php if (has_post_thumbnail()) {
        the_post_thumbnail(); } ?>
    </div>
    
    <h4><?php the_title(); ?></h4>
    
    <?php the_content(); ?>
    
</div>
