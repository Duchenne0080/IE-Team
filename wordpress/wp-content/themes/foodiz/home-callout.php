<?php
$args = array( 
'post_type' => 'page',
'post_status'=>'publish', 
'post__in' => array(get_theme_mod('foodiz_callout_section')));

$foodiz_callout = new WP_Query( $args );
if ( $foodiz_callout->have_posts() ):
while ( $foodiz_callout->have_posts() ):
$foodiz_callout->the_post(); ?>
<section class="section-padding-100">    
    <div class="col-md-12 col-lg-12 parallex" id="img1" style="background:url( <?php if ( has_post_thumbnail() ) {
     the_post_thumbnail_url();
    } else {
    echo esc_url( get_template_directory_uri() ) . "/images/callout.jpg" ;
    } ?>);background-attachment: fixed;background-position: center;background-repeat: no-repeat;background-size: cover;" >
        <div class="parallex-overlay"></div>
        <div class="parallex-txt">
            <h2><?php the_title(); ?></h2>                
            <div>
                <p><?php the_excerpt(); ?></p>           
				
				<p class="mt-3"><a target="_blank" href="<?php the_permalink(); ?>" class="btn btn-black py-2"> <?php esc_html_e('Read More','foodiz'); ?> </a></p>
            </div>
        </div> 
    </div>
</section>    
<?php endwhile; endif;
wp_reset_postdata();