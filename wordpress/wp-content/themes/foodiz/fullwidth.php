<?php
/**
 * Template Name: Page full width
 *
 * @package Foodiz
 * @version 0.1
*/
get_header();
//Breadcrumbs
get_template_part('breadcrumbs');
?>
    <section class="align-blog blog_page mt-5" id="full-width">
        <div class="container">
            <div class="row">
                <!-- right side -->
                <div class="col-lg-12 single-left mt-lg-0 mt-4">
                    <div class="single-left1">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
							get_template_part( 'post', 'page' );
						endwhile;
						endif;
						?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php 
get_footer();