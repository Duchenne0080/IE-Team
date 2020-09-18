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


        <section class="blog-section">
            <div class="container">         
            
	            <div class="<?php echo esc_attr($sidebar_col_class); ?>">            
                    <div class="row">
                 
			          <?php if( have_posts() ) : ?>                                       
                      
                        <div class="search-heading">
                        <?php /* translators: %s: search term */ ?>
                        <h1 class="search-title"><?php printf( esc_html( 'Search Results for: %s', 'sidebar' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>                    
                        </div>                          
                      
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