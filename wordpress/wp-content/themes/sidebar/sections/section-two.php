<?php
/**
 * Section for displaying on Homepage
 *
 * @package array
 */
 
$section_two_ed = get_theme_mod( 'sidebar_homepage_section_two_ed', '0' ); 
 
if( !$section_two_ed ) {
    return;
} 

$section_two_cat = get_theme_mod( 'sidebar_homepage_section_two_values' ); 
$section_two_label = get_theme_mod( 'sidebar_homepage_section_two_label' ); 

if ($section_two_cat) { 
?>


<section class="section-one">

 	<div class="container">
 
		<?php if ($section_two_label) { ?>
	        <h3 class="wide-title"><?php echo esc_html($section_two_label); ?></h3>
        <?php } ?>
      
      <div class="row">   
      
				<?php     
				  //Set the counter to 1
				  $i = 1;						        
                $query_args = array(
                'post_type' => 'post',
                'posts_per_page' => 6,
				'ignore_sticky_posts' => true,
				'cat' => $section_two_cat,
                );                            
                $the_query = new WP_Query( $query_args ); ?>                            
                <?php if ( $the_query->have_posts() ) : ?>                            
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>              
      
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="card_one sectiononeheightfit">
                            
                            <?php if ( has_post_thumbnail() ) { ?>
                            <div class="img_holder">
                                <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                    <?php the_post_thumbnail('sidebar-featured', array('class' => 'img-responsive card_one_img')); ?>
                                </a>                            
                            </div>
                            <?php } ?>                                
                            
                            <div class="text_holder">
                                  <p class="category">
                                      <?php
                                        $category_detail=get_the_category($post->ID);//$post->ID
                                        foreach($category_detail as $cd){
                                                echo esc_html($cd->cat_name);
                                        }
                                      ?>                  
                                  </p>                                
                                <a href="<?php the_permalink(); ?>" class="entry-title"><?php echo the_title( '', '' ); ?></a>
                                <?php the_excerpt(); ?>
                            </div>                
                        </div>
                    </div>      
            
				<?php 
     			 if($i % 3 == 0) {echo '<div class="clearfix"></div>';}
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