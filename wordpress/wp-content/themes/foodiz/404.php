<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
<section class="blog-content-area section-padding-100-0" id="content">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Blog Posts Area Start -->
            <div class="col-sm-12 col-md-6 col-lg-8">
                <div class="text_404">
					<h1 class="text_tile_404 text-center"> <?php esc_html_e( 'Oops! The page you requested was not found.', 'foodiz' ); ?></h1>
					<h2 class="text_tile_404 text-center"><?php esc_html_e( '404', 'foodiz' ); ?></h2>
					
					<?php get_search_form(); ?>
					<div class="hom">
						<a href="<?php echo esc_url( home_url("/") ); ?>"> <?php esc_html_e( 'Go Home', 'foodiz' ); ?></a>
					</div>
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