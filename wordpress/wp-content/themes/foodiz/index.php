<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Foodiz
 * @version 0.1
 */
get_header(); 
//Breadcrumbs
if(get_theme_mod('foodiz_breadcrumb_show','1')) :
    get_template_part('breadcrumbs');
endif;
?>
<!--  Blogs Section Start  -->
<section class="blog-content-area" id="content">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <!-- Blog Posts Area Start -->
            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="blog-posts-area">
                   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                        <?php get_template_part( 'post', 'content' ); ?>
						
                <?php endwhile; endif; 
					/*
					* Functions hooked into foodiz_pagination action
					*
					* @hooked foodiz_navigation
					*/
					do_action('foodiz_pagination'); ?>
                </div>
            </div>
            <!-- Blog Posts Area End -->
            <div class="col-lg-4">
				<?php get_sidebar(); ?>
			</div>
        </div>
    </div>
</section>
<?php
get_footer();