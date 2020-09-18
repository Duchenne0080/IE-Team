<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>
<?php do_action( 'global_ecommerce_store_above_slider' ); ?>

	
<?php 		
if( get_theme_mod('global_ecommerce_store_slider_display') != ''){ ?>
<section id="slider">
  	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
	    <?php $slider_pages = array();
	      	for ( $count = 1; $count <= 4; $count++ ) {
		        $mod = intval( get_theme_mod( 'global_ecommerce_store_slider' . $count ));
		        if ( 'page-none-selected' != $mod ) {
		          $slider_pages[] = $mod;
		        }
	      	}
	      	if( !empty($slider_pages) ) :
	        $args = array(
	          	'post_type' => 'page',
	          	'post__in' => $slider_pages,
	          	'orderby' => 'post__in'
	        );
	        $query = new WP_Query( $args );
	        if ( $query->have_posts() ) :
	          $i = 1;
	    ?>
	    <div class="">
	    
	    <div class="carousel-inner" role="listbox">
	    	<div class="row">
	      	<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
	        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
	        	<div class="slider-image">
	          	<img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?> post thumbnail image"/>
	          	</div>
	          	<div class="carousel-caption">
		            <div class="inner_carousel">
		            	<h6><?php the_excerpt();?></h6>	
		              	<h1><?php the_title();?></h1>	
		            </div>
		            <div class="btn btn-black rounded-0">
	            		<a href="<?php the_permalink();?>" title="<?php esc_attr_e( 'SHOP NOW', 'global-ecommerce-store' ); ?>" alt="<?php the_title_attribute(); ?>"><?php esc_html_e('SHOP NOW','global-ecommerce-store'); ?><span class="screen-reader-text"><?php the_title(); ?></span></a>
			       	</div>
	          	</div>

	        </div>
	      	<?php $i++; endwhile; 
	      	wp_reset_postdata();?>
	      </div>
	    </div>
		
		</div>
	    <?php else : ?>
	    <div class="no-postfound"></div>
	      <?php endif;
	    endif;?>
	    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      		<span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
      		<span class="screen-reader-text"><?php esc_html( 'Previous','global-ecommerce-store' );?></span>
	    </a>
	    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      		<span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
      		<span class="screen-reader-text"><?php esc_html( 'Next','global-ecommerce-store' );?></span>
	    </a>
  	</div>  
  	<div class="clearfix"></div>
</section>
	<?php 
}
	do_action('global_ecommerce_store_below_slider'); ?>

<!-- product categories -->
<?php if( get_theme_mod('global_ecommerce_store_categories_display',true) != ''){ ?>
<section id="product-categories">
	
	<div class="container">
		<?php

			
			$args =array(
				'taxonomy'=>'product_cat',
				'hide_empty' => false
			);

			$results= get_terms($args);

			?>
			<div class="container">
			<div class="category-title center">
			<?php if(get_theme_mod('global_ecommerce_store_category_title')) : 
				$category_title=(get_theme_mod('global_ecommerce_store_category_title'));
				?>
				<h2><?php echo esc_html($category_title)?></h2>
			<?php endif; ?>
			</div>
			
		<div class="row">
				
			<?php if ( class_exists( 'WooCommerce' ) ) {?>
			<?php
			
			
		 	foreach ($results as $cats) {
	 		$term_link = get_term_link( $cats,'product_cat' );
	 		$cat_thumb_id = get_term_meta($cats->term_id, 'thumbnail_id',true);
		 	$shop_catalog_img_arr = wp_get_attachment_image_src($cat_thumb_id,'shop_catalog');
		 	$cat_img = $shop_catalog_img_arr[0];

		 	$cond= $cats-> slug ;
		 	for ( $count = 1; $count <= 6; $count++ ) {
			get_theme_mod('global_ecommerce_store_product_category'. $count);
			

		 	if ( $cond ===  get_theme_mod('global_ecommerce_store_product_category'. $count)) {
		 		?>

		 		<div class="col-md-4 center col-sm-6" id="product-image">
		 			
		 			
		 				<a href="<?php echo esc_url($term_link); ?>" class="product-category" id="product-category">
		 					<?php 
		 					echo esc_html($cats-> name .' ('.$cats->count.')');
		 				?>
		 				</a>
		 				<img src="<?php echo esc_url($cat_img);?>" class="cat-image" id="cat-image">
		 				
		 			
		 			
		 			
		 		</div>


		 		<?php
		 		} //condition ends
		 	} // count loop ends
		 	} // foreach loop ends
		 } // woocommerce class check condition ends
		?>
		</div> <!-- row class ends -->

	</div>
	</div>
</section>
<?php } ?>
<?php get_footer(); ?>