<?php

/* 	Travel Theme's Single Page to display Single Page or Post
	Copyright: 2012-2017, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Travel 1.0
*/


get_header(); ?>

<div id="container">

<div id="content">
          
		  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
          
            <h1 class="page-title"><?php the_title(); ?></h1><div class="content-ver-sep fwtsep"></div>
            <span class="postmetadata"><h3><?php the_time('F j, Y'); ?></h3><div class="content-ver-sep"> </div><h2>By: <?php the_author_posts_link() ?></h2>Posted in <?php the_category(', ') ?><?php the_tags('<br />Tags: ', ', ', ''); ?><br /><h5><?php edit_post_link('Edit'); ?></h5></span>	
            <div class="entrytext"><div class="thumb"><?php the_post_thumbnail(); ?></div>
			<?php the_content(); ?>
            </div>
            <div class="clear"> </div>
            <?php  wp_link_pages( array( 'before' => '<div class="page-link"><span>' . 'Pages:' . '</span>', 'after' => '</div>' ) ); ?>
            <div class="up-bottom-border">
            <div class="content-ver-sep"></div>
			<div class="floatleft"><?php previous_post_link('&laquo; %link ('.__('Previous Post','travel-lite').')'); ?></div>
			<div class="floatright"><?php next_post_link('('.__('Next Post','travel-lite').') %link &raquo;'); ?></div><br />
            <?php if ( is_attachment() ): ?>
            <div class="floatleft"><?php previous_image_link( false, __('&laquo; Previous Image','travel-lite') ); ?></div>
			<div class="floatright"><?php next_image_link( false, __('Next Image &raquo;','travel-lite') ); ?></div> 
            <?php endif; ?>
          	</div>
			 <div class="content-ver-sep"></div><br />
			<?php endwhile;?>
          	            
          <!-- End the Loop. -->          
        	
			<?php comments_template('', true); ?>
            
            <?php if (get_post_meta( get_the_ID(), 'sb_pl', true ) == 'fullwidth' ): echo '<style>#content { width: 950px; } #right-sidebar { display: none; }</style>'; endif; ?>
            
</div>			
<?php get_sidebar(); ?>
<?php get_footer(); ?>