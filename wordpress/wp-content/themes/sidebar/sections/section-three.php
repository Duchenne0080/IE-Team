<?php
/**
 * Section for displaying on Homepage
 *
 * @package array
 */
$section_three_ed = get_theme_mod( 'sidebar_homepage_section_three_ed', '0' ); 
 
if( !$section_three_ed ) {
    return;
} 

$section_three_cat = get_theme_mod( 'sidebar_homepage_section_three_values' ); 

if ($section_three_cat) {  
?>

				<?php     	        
                $query_args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
				'ignore_sticky_posts' => true,
				'cat' => $section_three_cat,
                );                            
                $the_query = new WP_Query( $query_args ); ?>                            
                <?php if ( $the_query->have_posts() ) : ?>                            
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>    



                <section class="section-three" style="background-image:url(<?php the_post_thumbnail_url(''); ?>);" >
                        <div class="overlay"></div>
                    
                        <div class="container nopadding">                
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 textside">
                                  <p class="category">
                                      <?php
                                        $category_detail=get_the_category($post->ID);//$post->ID
                                        foreach($category_detail as $cd){
                                                echo esc_html($cd->cat_name);
                                        }
                                      ?>                  
                                  </p>
                                <h4><a href="<?php the_permalink(); ?>" class="entry-title"><?php the_title( '', '' ); ?></a></h4>
                                <?php the_excerpt(); ?>                
                            </div>            
                            
                        </div>    
                        
                </section>

				<?php endwhile; ?>
                <!-- end of the loop -->                            
                <?php wp_reset_postdata(); ?>                            
                <?php else:  ?>
                <p><center><?php echo esc_html( 'Sorry, no posts matched your criteria.', 'sidebar' ); ?></center></p>
                <?php endif;   ?>               
                
<?php } ?>                