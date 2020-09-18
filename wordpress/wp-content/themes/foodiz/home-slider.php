<section class="hero-area">
    <div class="hero-post-slides owl-carousel">
        <?php
        $foodiz_query = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1));
        if ($foodiz_query->have_posts()) : while ($foodiz_query->have_posts() ) : $foodiz_query->the_post(); ?>

		<?php if(has_post_thumbnail()) :  ?>
        <div class="single-hero-post single_slider slider_img_1">
            <div class="slide-img bg-img" style="background-image: url( '<?php the_post_thumbnail_url(); ?>');">
			</div>
            <!-- Post Content -->
			<div class="single_slider-iner">
            <div class="slider_contant text-center">
                <a href="<?php the_permalink(); ?>" class="post-title">
                    <?php the_title(); ?>
                </a>
            </div>
            </div>
        </div>
		<?php endif;
        endwhile; endif;
        wp_reset_postdata(); ?>
    </div>
</section>