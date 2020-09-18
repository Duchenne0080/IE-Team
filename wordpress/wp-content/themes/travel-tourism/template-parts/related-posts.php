<?php
/**
 * Related posts based on categories and tags.
 * 
 */

$travel_tourism_related_posts_taxonomy = get_theme_mod( 'travel_tourism_related_posts_taxonomy', 'category' );

$travel_tourism_post_args = array(
    'posts_per_page'    => absint( get_theme_mod( 'travel_tourism_related_posts_count', '3' ) ),
    'orderby'           => 'rand',
    'post__not_in'      => array( get_the_ID() ),
);

$travel_tourism_tax_terms = wp_get_post_terms( get_the_ID(), 'category' );
$travel_tourism_terms_ids = array();
foreach( $travel_tourism_tax_terms as $tax_term ) {
	$travel_tourism_terms_ids[] = $tax_term->term_id;
}

$travel_tourism_post_args['category__in'] = $travel_tourism_terms_ids; 

if(get_theme_mod('travel_tourism_related_post',true)==1){

$travel_tourism_related_posts = new WP_Query( $travel_tourism_post_args );

if ( $travel_tourism_related_posts->have_posts() ) : ?>
    <div class="related-post">
        <h3><?php echo esc_html(get_theme_mod('travel_tourism_related_post_title','Related Post'));?></h3>
        <div class="row">
            <?php while ( $travel_tourism_related_posts->have_posts() ) : $travel_tourism_related_posts->the_post(); ?>
                <?php get_template_part('template-parts/grid-layout'); ?>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif;
wp_reset_postdata();

}