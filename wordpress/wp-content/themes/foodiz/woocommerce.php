<?php
/**
 * The template for displaying woocommerce page
 *
 * @package Foodiz
 * @version 0.1
 */

get_header(); 

if(get_theme_mod('foodiz_breadcrumb_show','1')) : ?>

<nav class="breadcrumb_back" aria-label="breadcrumb" style="background:url( <?php if ( get_theme_mod( 'foodiz_inner_image' ) ) {
		     echo esc_url( get_theme_mod( 'foodiz_inner_image' ) );
	     } else {
		     echo esc_url( get_template_directory_uri() ) . "/images/callout.jpg";
	     } ?>);">
    <?php if ( have_posts() ) { ?>
    <ol class="breadcrumb d-flex justify-content-center breadCrumbBkground">
        <li class="breadcrumb-item">
            <?php woocommerce_breadcrumb(); ?>
        </li>
    </ol>
	<?php } ?>
</nav>

<?php endif; ?>

<section class="blog-content-area section-padding-0 woocommerce-content" id="content">
    <div class="container">
        <div class="row d-flex">
            <!-- Blog Posts Area Start -->
            <div class=" col-lg-8">
                <div class="blog-posts-area">
                    <?php woocommerce_content(); ?>
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