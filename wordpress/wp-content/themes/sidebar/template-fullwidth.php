<?php
/**
 * Template Name: FullWidth Template
 *
 * This is a home page template which uses slider with featured posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package sidebar
 */
get_header(); 

?>

<div id="content" class="site-content">
	<div class="container">
		<div class="row">

			<article id="post-<?php the_ID(); ?>" <?php post_class('single-post-wrapper'); ?>>               
			<?php while ( have_posts() ) : the_post(); //main loop ?>            
			<?php  if ( has_post_thumbnail() ) {?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('sidebar-single', array('class' => 'img-responsive')); ?>
                </div>
            <?php } ?>
			
            <div class="col-lg-9 col-md-9 col-xs-12 col-sm-12 col-lg-offset-1 col-md-offset-1">            
				<div id="primary" class="content-area">
					<main id="main" class="site-main">


					<?php 
					get_template_part( 'template-parts/content', 'page' );                     
                    
					if ( comments_open() || get_comments_number() ) :
                    comments_template();
                    endif; 
					?> 


					</main><!-- #main -->
				</div><!-- #primary -->
	    	</div><!-- .col-md-8 -->
			<?php endwhile; // End of the loop. ?>                        
        </article><!-- #post-<?php the_ID(); ?> -->     		
        
    	</div><!-- .row -->
  </div><!-- .container -->
</div><!-- #content -->

        
<?php  get_footer(); ?>