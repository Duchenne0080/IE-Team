<section class="section-padding-100 " id="blog">
<div class="container">
	<div class="row"> 
		<div class="col-lg-12 mt-15 text-center">  
			<?php 
			$foodiz_blog_title = get_theme_mod( 'foodiz_blog_title' );
			$foodiz_blog_desc  = get_theme_mod( 'foodiz_blog_desc' );
			?>
			<h1 class="color-pink blog-title"><?php echo esc_html( $foodiz_blog_title ); ?></h1> 
			<p class="sub-title"><?php echo esc_html( $foodiz_blog_desc ); ?></p>                        
		</div>    
	</div>
	<div class="owl-carousel owl-blog">
	<?php $foodiz_posts_count = wp_count_posts()->publish;
    $foodiz_query = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => $foodiz_posts_count));
    if ($foodiz_query->have_posts()) : while ($foodiz_query->have_posts() ) : $foodiz_query->the_post(); ?>
	<div> 
		<div class="blog-entry">
			<?php if(has_post_thumbnail()) : ?>
			<a href="<?php the_permalink(); ?>" class="img-2">
				<img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid">
			</a> <?php endif; ?>
			
			<div class="text pt-3">
				<p class="meta d-flex">
					<span class="pr-3">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><span><?php esc_html_e('by','foodiz'); ?></span> <?php the_author(); ?></a>
					</span>
					<span class="ml-auto pl-3"><?php echo esc_html( get_the_date() ); ?></span>
				</p>
				
				<h3>
					<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				
				<?php the_excerpt(); ?>
				
				<p class="mb-0">
					<a href="<?php the_permalink(); ?>" class="btn btn-black py-2"> <?php esc_html_e('Read More','foodiz'); ?> </a>
				</p>
			</div>
		</div>
	</div>
	<?php endwhile; endif;
    wp_reset_postdata(); ?>
</div>
</div>
</section>