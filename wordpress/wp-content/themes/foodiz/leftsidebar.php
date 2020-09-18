<?php
/**
 * Template Name: Page With Left Sidebar
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
<section class="blog-content-area" id="contenti">
    <div class="container">
        <div class="row d-flex justify-content-center">
			<div class="col-lg-4">
				<?php get_sidebar(); ?>
			</div>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="blog-posts-area">
                   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    <?php get_template_part( 'post', 'page' ); ?>
						
                <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();