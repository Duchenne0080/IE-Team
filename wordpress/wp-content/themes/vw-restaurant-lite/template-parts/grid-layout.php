<?php
/**
 * The template part for displaying grid layout
 *
 * @package VW Restaurant Lite 
 * @subpackage vw_restaurant_lite
 * @since VW Restaurant Lite 1.0
 */
?>
<?php 
  $vw_restaurant_lite_archive_year  = get_the_time('Y'); 
  $vw_restaurant_lite_archive_month = get_the_time('m'); 
  $vw_restaurant_lite_archive_day   = get_the_time('d'); 
?>
<div class="col-lg-4 col-md-6">
  <article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="services-box">    
    <h2 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
    <?php if(get_theme_mod('vw_restaurant_lite_toggle_postdate',true)==1){ ?>
  	 <div class="date-box"><i class="fas fa-calendar-alt"></i><a href="<?php echo esc_url( get_day_link( $vw_restaurant_lite_archive_year, $vw_restaurant_lite_archive_month, $vw_restaurant_lite_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></div>
    <?php } ?>
    <div class="box-image">
      <?php 
        if(has_post_thumbnail()) { 
          the_post_thumbnail(); 
        }
      ?>
    </div>
    <div class="new-text">
      <div class="entry-content">
        <p>
          <?php $excerpt = get_the_excerpt(); echo esc_html( vw_restaurant_lite_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_restaurant_lite_excerpt_number','30')))); ?> <?php echo esc_html( get_theme_mod('vw_restaurant_lite_excerpt_suffix','') ); ?>
        </p>
      </div>
    </div>
    <?php if( get_theme_mod('vw_restaurant_lite_category_hide_show',true) != ''){ ?>	
    	<div class="cat-box">
    	  <i class="fas fa-folder-open"></i><?php foreach((get_the_category()) as $category) { echo esc_html($category->cat_name) . ' '; } ?>
    	</div> 
    <?php } ?> 	
    <div class="clearfix"></div>
  </div>
  </article>
</div>