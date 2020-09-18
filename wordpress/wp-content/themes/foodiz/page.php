<?php
/**
 * The template for displaying all page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
<section class="blog-content-area section-padding-0" id="content">
    <div class="container">
        <div class="row d-flex">
            <!-- Blog Posts Area Start -->
            <div class=" col-lg-8">
                <div class="blog-posts-area">
                    <?php if (have_posts()) : while (have_posts()) : the_post();
                        get_template_part('post', 'page');
                        endwhile; endif;
                    ?>
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