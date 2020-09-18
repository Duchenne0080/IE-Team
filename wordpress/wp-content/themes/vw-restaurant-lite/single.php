<?php
/**
 * The Template for displaying all single posts.
 *
 * @package VW Restaurant Lite
 */

get_header(); ?>

<main id="maincontent" role="main">
  <div class="container">
    <div class="singlepage">
    	<?php
        $vw_restaurant_lite_left_right = get_theme_mod( 'vw_restaurant_lite_theme_options','Right Sidebar');
        if($vw_restaurant_lite_left_right == 'Left Sidebar'){ ?>
        <div class="row">
		    	<div class="sidebar col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
  				<div class="col-lg-8 col-md-8 content-vw" >
  					<?php if ( have_posts() ) :
             while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content-single' ); 
             endwhile;

             else :
              get_template_part( 'no-results' );
             endif; 
            ?>
  		    </div>
		    </div>
      <?php }else if($vw_restaurant_lite_left_right == 'Right Sidebar'){ ?>
      	<div class="row">
         	<div class="col-lg-8 col-md-8 content-vw" >
  			    <?php if ( have_posts() ) :
             while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content-single' ); 
             endwhile;

             else :
              get_template_part( 'no-results' );
             endif; 
            ?>
         	</div>
  			  <div class="sidebar col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
  		  </div>
  	  <?php }else if($vw_restaurant_lite_left_right == 'One Column'){ ?>
  	    <div class="content-vw">
  		    <?php if ( have_posts() ) :
           while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content-single' ); 
           endwhile;

           else :
            get_template_part( 'no-results' );
           endif; 
          ?>
       	</div>
      <?php }else if($vw_restaurant_lite_left_right == 'Three Columns'){ ?>
     		<div class="row">
         	<div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1'); ?></div>
         	<div class="col-lg-6 col-md-6 content-vw" >
  			    <?php if ( have_posts() ) :
             while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content-single' ); 
             endwhile;

             else :
              get_template_part( 'no-results' );
             endif; 
            ?>
         	</div>
  		    <div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
  	    </div>
  	  <?php }else if($vw_restaurant_lite_left_right == 'Four Columns'){ ?>
  			<div class="row">
  				<div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1'); ?></div>
  		    <div class="col-lg-3 col-md-3 content-vw" >
  					<?php if ( have_posts() ) :
             while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content-single' ); 
             endwhile;

             else :
              get_template_part( 'no-results' );
             endif; 
            ?>
  		    </div>
  				<div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2'); ?></div>
  				<div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-3'); ?></div>
  			</div>
  	  <?php }else if($vw_restaurant_lite_left_right == 'Grid Layout'){ ?>
  			<div class="row">
  				<div class="col-lg-8 col-md-8 content-vw" >
  					<?php if ( have_posts() ) :
             while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content-single' ); 
             endwhile;

             else :
              get_template_part( 'no-results' );
             endif; 
            ?>
  		    </div>
  				<div class="sidebar col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
  			</div>
    	<?php }else {?>
    		<div class="row">
	       	<div class="col-lg-8 col-md-8 content-vw" >
				    <?php if ( have_posts() ) :
             while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content-single' ); 
             endwhile;

             else :
              get_template_part( 'no-results' );
             endif; 
            ?>
	       	</div>
				  <div class="sidebar col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-1'); ?></div>
			  </div>
    	<?php }?>
  	  <div class="clearfix"></div>
    </div>
  </div>
</main>

<?php get_footer(); ?>