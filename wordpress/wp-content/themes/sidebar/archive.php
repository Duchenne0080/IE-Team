<?php
/**
 * The template for displaying post archives
 *
 * @package sidebar
 */

get_header(); 

if ( ! is_active_sidebar( 'sidebar-main' ) ) {
 	$sidebar_col_class = "col-lg-12 col-md-12 col-xs-12 col-sm-12";
	$sidebar_clear_num = "3";
}
else {
 	$sidebar_col_class = "col-lg-8 col-md-8 col-xs-12 col-sm-12";
	$sidebar_clear_num = "2";
}
?>
<div id="content" class="site-content">

                <section class="section-three archive-header" style="background-image:url(<?php echo esc_url( get_header_image() ); ?>); height:350px;" >
                        <div class="overlay"></div>
                    
                        <div class="container nopadding">                
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 textside">                               
                                <div class="archive-title">
                                    <?php
                                    the_archive_title('<h2>', '</h2>');
                                    the_archive_description( '<div class="archive-description">', '</div>' );
                                    ?>
                                </div>                                
                                
                            </div>            
                            
                        </div>    
                        
                </section>

        <section class="blog-section">
            <div class="container">
	            <div class="<?php echo esc_attr($sidebar_col_class); ?>">            
                    <div class="row">
                 
			          <?php if( have_posts() ) : ?>                                       
                      <?php
                        $count = 1;
                         /* Start the Loop */
                         while ( have_posts() ) : the_post();
                         get_template_part( 'template-parts/content' );			 
                        if ($count % $sidebar_clear_num == 0) {
                            echo "<div class='clearfix'></div>";
                        }
                        $count++;			 
                        endwhile;
                         
                        echo "<div class='clearfix'></div>";			 
                         
                        $post_args =  array(
                            'screen_reader_text' => ' ',
                            'prev_text' => __( '<div class="chevronne"><i class="fa fa-chevron-left"></i></div>', 'sidebar' ),
                            'next_text' => __( '<div class="chevronne"><i class="fa fa-chevron-right"></i></div>', 'sidebar' ),
                            );
                
                            the_posts_pagination( $post_args );        			 		

                        else :
                        get_template_part( 'template-parts/content', 'none' );
                        endif;                 
                         ?>                                                
                        
                    </div>
                </div>
                
                
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
            <?php get_sidebar(); ?>
            </div>                
            </div>
        </section>
</div>        
<?php  get_footer(); ?>