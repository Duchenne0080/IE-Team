<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
<?php if ( get_header_image() ) : ?>
	<div class="custom-header-index">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        </a>
    </div>
<?php endif; ?>

<section class="blog-section site-content">
            <div class="container">
                <div class="<?php echo esc_attr($sidebar_col_class); ?>">     
                    <div class="row">
                    
          <?php

			if( have_posts() ) :
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
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?php get_sidebar(); ?>
                </div>
            </div>
        </section>
</div><!-- #content -->
<?php  get_footer(); ?>