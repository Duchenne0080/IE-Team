<?php
/**
 * Section for displaying on Homepage
 *
 * @package sidebar
 */
$section_four_ed = get_theme_mod( 'sidebar_homepage_section_four_ed', '0' ); 
 
if( !$section_four_ed ) {
    return;
} 

$section_four_cat = get_theme_mod( 'sidebar_homepage_section_four_values' ); 
$section_four_label = get_theme_mod( 'sidebar_homepage_section_four_label' ); 

if ($section_four_cat) {  
?>

<section class="section-two">

	<div class="container">
    
		<?php if ($section_four_label) { ?>
	        <h3 class="wide-title"><?php echo esc_html($section_four_label); ?></h3>
        <?php } ?> 
    
    	<div class="row">
        
				<?php
					// run query
						$section_query_args = array(
							'post_type' => 'post',
							'posts_per_page' => 9,
							'ignore_sticky_posts' => true,	
							'cat' => $section_four_cat,						
						);
						$the_query_posts = new WP_Query( $section_query_args );
						$sectionposts = $the_query_posts->posts;
				?>
        
        
        	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 videoheightfit">
            
				<?php
                $sliced_array_posts = array_slice($sectionposts, 0, 1);
                foreach($sliced_array_posts as $post) {				
                ?>      
                      
				<article class="card_four" style="background-image:url(<?php the_post_thumbnail_url('sidebar-sectiontwo-big'); ?>); height:500px;">
					<a href="<?php echo esc_url( get_permalink( $post->ID )); ?>">                
                    <div class="overlay"></div>                  
                    </a>
                  <div class="text-holder">
                  <p class="category">
					  <?php
                        $category_detail=get_the_category($post->ID);//$post->ID
                        foreach($category_detail as $cd){
                                echo esc_html($cd->cat_name);
                        }
                      ?>                  
                  </p>
                    <h2><a href="<?php echo esc_url( get_permalink( $post->ID )); ?>"><?php echo esc_html($post->post_title); ?></a></h2>
                  </div>
                </article>  
                <?php } ?>          
            	
            </div>
            
        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 videoheightfit">
            
				<?php
                $sliced_array_posts = array_slice($sectionposts, 1, 2);
                foreach($sliced_array_posts as $post) {				
                ?>                        
            
				<article class="card_four" style="background-image:url(<?php the_post_thumbnail_url('sidebar-sectiontwo-big'); ?>); height:233px;">
	                <a href="<?php echo esc_url( get_permalink( $post->ID )); ?>">
                    <div class="overlay"></div>                  
                    </a>
                  <div class="text-holder">
                  <p class="category">
					  <?php
                        $category_detail=get_the_category($post->ID);//$post->ID
                        foreach($category_detail as $cd){
                                echo esc_html($cd->cat_name);
                        }
                      ?>                  
                  </p>
                    <h2><a href="<?php echo esc_url( get_permalink( $post->ID )); ?>"><?php echo esc_html($post->post_title); ?></a></h2>                    
                  </div>
                </article>    
                
				<?php } ?>                  
                				                      	
            	
            </div>            
        
        </div>
        
        <div class="row">
        
				<?php
                $sliced_array_posts = array_slice($sectionposts, 3, 9);
                foreach($sliced_array_posts as $post) {				
                ?>           
        
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 videoheightfit">
            
				<article class="card_four" style="background-image:url(<?php the_post_thumbnail_url('sidebar-sectiontwo-big'); ?>); height:233px;">
					<a href="<?php echo esc_url( get_permalink( $post->ID )); ?>">                
                    <div class="overlay"></div>                  
                    </a>
                  <div class="text-holder">
                  <p class="category">
					  <?php
                        $category_detail=get_the_category($post->ID);//$post->ID
                        foreach($category_detail as $cd){
                                echo esc_html($cd->cat_name);
                        }
                      ?>                  
                  </p>
                    <h2><a href="<?php echo esc_url( get_permalink( $post->ID )); ?>"><?php echo esc_html($post->post_title); ?></a></h2>                    
                  </div>
                </article>
                
            </div>
            
			<?php } ?>                 
			          
            
			                                  
        
        </div>
        
                <?php wp_reset_postdata(); ?>        
    
    </div>

</section>

<?php } ?>