<?php
/**
 * Section for displaying on Homepage
 *
 * @package array
 */
  
$section_one_ed = get_theme_mod( 'sidebar_homepage_section_one_ed', '0' ); 
 
if( !$section_one_ed ) {
    return;
} 

$section_one_cat = get_theme_mod( 'sidebar_homepage_section_one_values' ); 

if ($section_one_cat) {
?>

<section class="section-five">

<div class="container-fluid nopadding">

	<div class="row1">
    
				<?php     
				  //Set the counter to 1
				  $i = 1;						        
                $query_args = array(
                'post_type' => 'post',
                'posts_per_page' => 4,
				'ignore_sticky_posts' => true,
				'cat' => $section_one_cat,
                );                            
                $the_query = new WP_Query( $query_args ); ?>                            
                <?php if ( $the_query->have_posts() ) : ?>                            
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>          
    
    	<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 nopadding">
        
        	<article class="card_three videoheightfit">                  
					<?php the_post_thumbnail('sidebar-homelong', array('class' => 'img-responsive')); ?>                    
                    <a href="<?php the_permalink(); ?>">
	                    <div class="overlay"></div>         
                    </a>         
                    <a href="<?php the_permalink(); ?>">                    
                 	<div class="text-holder">
                      <p class="category">
                          <?php
                            $category_detail=get_the_category($post->ID);//$post->ID
                            foreach($category_detail as $cd){
                                    echo esc_html($cd->cat_name);
                            }
                          ?>                  
                      </p>                        
                   	<h2><a href="<?php the_permalink(); ?>" class="entry-title"><?php echo the_title( '', '' ); ?></a></h2>
                  </div>
                    </a>                           
                  
                </article>
        
        </div>
        
				<?php 
     			 if($i % 4 == 0) {echo '<div class="clearfix"></div>';}
				$i++; endwhile; ?>
                <!-- end of the loop -->                            
                <?php wp_reset_postdata(); ?>                            
                <?php else:  ?>
                <p><center><?php echo esc_html( 'Sorry, no posts matched your criteria.', 'sidebar' ); ?></center></p>
                <?php endif;   ?>         
        
    </div>

</div>

    
</section>
<?php } ?>