<?php
$args = array( 
'post_type' => 'page',
'post_status'=>'publish', 
'post__in' => array(get_theme_mod('foodiz_about_section')));

$foodiz_about = new WP_Query( $args );
if ( $foodiz_about->have_posts() ): while ( $foodiz_about->have_posts() ):
$foodiz_about->the_post(); ?>
<section class="section-padding-100 " id="content">
    <div class="container">
        <div class="row about-section" id="content">
		<?php 
		if (has_post_thumbnail()) { 
		$i=6; ?>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="about-us" >
                <img src="<?php the_post_thumbnail_url(); ?>">
            </div>
        </div> 
		<?php } else {
			$i=12;
		} ?>
        <div class="col-sm-12 col-md-12 col-lg-<?php echo esc_attr($i); ?>">
            <div class="row"> 
                <div class="col-lg-12 mt-15">  
                    <h1 class="color-pink"><?php the_title(); ?></h1>                         
                </div>    
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p style="text-align: justify;"><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>" class="read-more"> <?php esc_html_e('View More','foodiz'); ?> </a>
                </div>    
            </div>
        </div>                   
        </div>
    </div>
</section>
<?php endwhile; endif;