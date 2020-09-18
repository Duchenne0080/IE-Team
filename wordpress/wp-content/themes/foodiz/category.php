<?php
/**
 * The template for displaying category pages
 *
 * @package Foodiz
 * @since 0.1
*/
get_header(); 
if(get_theme_mod('foodiz_breadcrumb_show','1')) :
	get_template_part('breadcrumbs');
endif;
?>
<!--  Blogs Section Start  -->
<section class="blog-content-area" id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8">
				<div class="blog-posts-area">
					<div class="row">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="col-lg-6">
                            <?php get_template_part('content', get_post_format()); ?>            
                        </div>
                    <?php endwhile; endif; 
					/*
					* Functions hooked into foodiz_pagination action
					*
					* @hooked foodiz_navigation
					*/
					do_action('foodiz_pagination'); ?>
					</div>
                </div>
            </div>
            <div class="col-lg-4">
				<?php get_sidebar(); ?>
			</div>   
        </div>
    </div>
</section>
<?php 
get_footer();