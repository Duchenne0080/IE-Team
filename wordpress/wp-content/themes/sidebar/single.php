<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sidebar
 */
get_header(); 

if ( ! is_active_sidebar( 'sidebar-main' ) ) {
 	$sidebar_col_class = "col-lg-8 col-md-8 col-xs-12 col-sm-12 col-lg-offset-2 col-md-offset-2";
}
else {
 	$sidebar_col_class = "col-lg-8 col-md-8 col-xs-12 col-sm-12";
}

?>

<?php while ( have_posts() ) : the_post(); //main loop ?>                                    
<div id="content" class="site-content">
		        <?php if ( has_post_thumbnail() ) { ?>
                <section class="section-three" style="background-image:url(<?php the_post_thumbnail_url(''); ?>); height:700px;" >
                        <div class="overlay"></div>
                    
                        <div class="container nopadding">                
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 textside">
                                  <p class="category">
									<?php the_category( ', ' ); ?>                 
                                  </p>
                                <h1 class="entry-title"><?php the_title( '', '' ); ?></h1>
                                
								<div class="author">
	 	 						<div class="author-img">
	 	 							<img src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ), array("size" => '69') ) ); ?>" class="img-responsive img-circle" alt="">
	 	 						</div>
	 	 						<div class="author-details">
	 	 							<h2 class="name"><?php the_author(); ?></h2>
									<p class="author-content"><?php the_author_meta( 'nickname' ); ?></p>                                    
	 	 							<p class="author-date"><?php echo esc_html('Published on', 'sidebar');?> <?php echo get_the_date(); ?></p>
	 	 					
	 	 						</div>
	 	 					</div>                                                                
                                
                            </div>            
                            
                        </div>    
                        
                </section>
                <?php } ?>


	<div class="container">
		<div class="row">
            <div class="<?php echo esc_attr($sidebar_col_class); ?>">            
			<article id="post-<?php the_ID(); ?>" <?php post_class('single-post-wrapper'); ?>>               
				<div id="primary" class="content-area">
					<main id="main" class="site-main">

			        <?php if ( !has_post_thumbnail() ) { ?>
					<div class="no-featuredimage-header">
                      <p class="category">
						<?php the_category( ', ' ); ?>                   
                      </p>                    
                    <h1 class="entry-title"><?php the_title( '', '' ); ?></h1>                    
                        <div class="entry-meta">
                        	<ul>
                            <li><?php echo get_the_date(); ?></li>
                            <li><?php the_author(); ?></li>
                            <li><?php comments_number( 'no responses', 'one response', '% responses' ); ?>.</li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
					</div>
                    <?php } ?>
					<?php get_template_part( 'template-parts/content', 'single' ); ?> 


					</main><!-- #main -->
				</div><!-- #primary -->
	        </article><!-- #post-<?php the_ID(); ?> -->                                                		                                    
            <?php
					if ( comments_open() || get_comments_number() ) :
                    comments_template();
                    endif; 			
			?>
	    	</div><!-- .col-md-8 -->
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
            <?php get_sidebar(); ?>
            </div>
    	</div><!-- .row -->
  </div><!-- .container -->
</div><!-- #content -->
<?php endwhile; // End of the loop. ?>                        
        
<?php  get_footer(); ?>