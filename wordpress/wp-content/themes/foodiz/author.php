<?php
/**
 * The template for displaying author pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Foodiz
 * @since 0.1
 */
get_header(); 
//Breadcrumbs
if(get_theme_mod('foodiz_breadcrumb_show','1')) :
    get_template_part('breadcrumbs');
endif;
?>
<!--  Blogs Section Start  -->
<section class="blog-content-area" id="author">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-8">
                <div class="blog-posts-area">
					<div class="row">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="col-lg-6">
                        <?php
                            get_template_part('content', get_post_format());
                        ?>
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