<?php 
get_header(); 
//Breadcrumbs
if(get_theme_mod('foodiz_breadcrumb_show','1')) :
    get_template_part('breadcrumbs');
endif;
?>
<section class="blog-content-area section-padding-0" id="content">
    <div class="container">
        <div class="row">
            <!-- Blog Posts Area -->
            <div class="col-md-8 col-lg-8">
                <div class="blog-posts-area">
                    <?php if (have_posts()) : while (have_posts()) : the_post();
                       get_template_part( 'post', 'content' );
					   
					   /*
						* Functions hooked into foodiz_single_blog_navigation action
						*
						* @hooked foodiz_post_navigation
						*/
						do_action( 'foodiz_single_blog_navigation' );

                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                                 
                    endwhile;
                    endif;
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