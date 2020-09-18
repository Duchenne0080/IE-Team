<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="maincontent">
  <?php /** slider section **/ ?>
  <?php if( get_theme_mod('vw_restaurant_lite_slider_hide_show') != ''){ ?>
    <section class="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <?php $slider_page = array();
          for ( $count = 1; $count <= 4; $count++ ) {
            $mod = intval( get_theme_mod( 'vw_restaurant_lite_slider_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $slider_page[] = $mod;
            }
          }
          if( !empty($slider_page) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $slider_page,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <img src="<?php the_post_thumbnail_url('full'); ?>"/>
              <div class="carousel-caption">
                <div class="inner_carousel">
                  <h1><?php the_title(); ?></h1>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_restaurant_lite_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_restaurant_lite_slider_excerpt_number','30')))); ?></p>
                  <?php if( get_theme_mod('vw_restaurant_lite_slider_button_text','READ MORE') != ''){ ?>
                    <div class="more-btn">              
                      <a class="button hvr-sweep-to-right" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('vw_restaurant_lite_slider_button_text',__('READ MORE','vw-food-corner')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_restaurant_lite_slider_button_text',__('READ MORE','vw-food-corner')));?></span></a>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
            <div class="no-postfound"></div>
          <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous','vw-food-corner' );?></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next','vw-food-corner' );?></span>
        </a>
      </div>  
      <div class="clearfix"></div>
    </section> 
  <?php }?>

  <?php /** second section **/ ?>
    <section class="we_belive">
      <div class="container">
        <?php
        $postData1=  get_theme_mod('vw_restaurant_lite_belive_post_setting');
          if($postData1){
          $args = array( 'name' => esc_html($postData1 ,'vw-restaurant-lite'));
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="row">
            <?php if(has_post_thumbnail()){ 
              $thumb_col = 'col-md-5 col-sm-5';
              $desc_col = 'col-md-7 col-sm-7';
              }else{
                $desc_col = 'col-md-12';
            } ?>
            <div class="<?php echo esc_attr($thumb_col); ?>">
              <img src="<?php the_post_thumbnail_url('full'); ?>"/>
            </div>
            <div class="<?php echo esc_attr($desc_col); ?>">
              <h3><q><?php the_title(); ?></q></h3>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_restaurant_lite_string_limit_words( $excerpt,25 ) ); ?></p>
              <div class="clearfix"></div>
              <?php if( get_theme_mod('vw_restaurant_lite_about_button_text','ABOUT US') != ''){ ?>
                <div><a class="button hvr-sweep-to-right"  href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('vw_restaurant_lite_about_button_text',__('ABOUT US','vw-food-corner')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_restaurant_lite_about_button_text',__('ABOUT US','vw-food-corner')));?></span></a>
                </div>
              <?php } ?>
            </div>
          </div>
          <?php endwhile; 
          wp_reset_postdata();?>
          <?php else : ?>
             <div class="no-postfound"></div>
           <?php
          endif; } ?>
          <div class="clearfix"></div>
      </div> 
    </section>

  <?php /*--OUR SERVICES--*/?>
  <section id="our-services">
    <div class="container">
      <?php if( get_theme_mod('vw_food_corner_service_title') != ''){ ?>
        <h3><?php echo esc_html(get_theme_mod('vw_food_corner_service_title',__('Look Our Services','vw-food-corner'))); ?></h3>
      <?php }?>
      <?php if( get_theme_mod('vw_food_corner_service_text_line') != ''){ ?>
        <p><?php echo esc_html(get_theme_mod('vw_food_corner_service_text_line',__('Lorem Ipsum has been the industry standard dummy text ever since the 1500s','vw-food-corner'))); ?></p>
      <?php }?>
      <div class="row">
        <?php $services_page = array();
          for ( $count = 0; $count <= 3; $count++ ) {
            $mod = intval( get_theme_mod( 'vw_food_corner_service_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $services_page[] = $mod;
            }
          }
          if( !empty($services_page) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $services_page,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $count = 0;
              while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="col-md-3 col-sm-3">
                  <div class="page-box">
                    <div class="image-div">
                      <img src="<?php the_post_thumbnail_url('full'); ?>"/>
                    </div>
                    <h4><?php the_title(); ?></h4>
                    <p><?php the_excerpt(); ?></p>
                  </div>
                </div>
              <?php $count++; endwhile; 
              wp_reset_postdata();?>
            <?php else : ?>
                <div class="no-postfound"></div>
            <?php endif;
        endif;?>
      </div>
      <div class="clearfix"></div>
    </div> 
  </section>

  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </div>
</main>

<?php get_footer(); ?>