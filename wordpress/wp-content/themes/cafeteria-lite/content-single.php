<?php
/**
 * @package Cafeteria Lite
 */
?>
<div class="listview_blogstyle">
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
 		   
    <div class="blog_postmeta">
            <div class="post-date"> <i class="far fa-clock"></i> <?php echo esc_html( get_the_date() ); ?></div><!-- post-date --> 
             <?php if( get_theme_mod( 'cafeteria_lite_hide_postcategory' ) == '') { ?> 
                   <span class="blogpost_cat"> <i class="far fa-folder-open"></i> <?php the_category( __( ', ', 'cafeteria-lite' ));?></span>
              <?php } ?>                   
    </div><!-- .blog_postmeta --> 
    
    <header class="entry-header">
        <?php the_title( '<h3 class="single-title">', '</h3>' ); ?>
    </header><!-- .entry-header -->        

    <div class="entry-content">		
        <?php the_content(); ?>
        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'cafeteria-lite' ),
            'after'  => '</div>',
        ) );
        ?>
        <div class="postmeta">          
            <div class="post-tags"><?php the_tags(); ?> </div>
            <div class="clear"></div>
        </div><!-- postmeta -->
    </div><!-- .entry-content -->
   
    <footer class="entry-meta">
      <?php edit_post_link( __( 'Edit', 'cafeteria-lite' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->

</article>
</div><!-- .listview_blogstyle-->