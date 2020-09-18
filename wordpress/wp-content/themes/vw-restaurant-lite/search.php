<?php
/**
 * The template for displaying Search Results pages.
 * @package VW Restaurant
 * @subpackage vw-restaurant-lite
 * @since vw-restaurant-lite 1.0
 */

get_header(); ?>

<main id="maincontent" role="main">
  <div class="container">
    <?php
      $vw_restaurant_lite_left_right = get_theme_mod( 'vw_restaurant_lite_theme_options','Right Sidebar');
      if($vw_restaurant_lite_left_right == 'Left Sidebar'){ ?>
      <div class="row">
        <div class="col-lg-4 col-md-4"><?php get_sidebar(); ?></div>
        <div class="services col-lg-8 col-md-8">
          <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-restaurant-lite'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
          <?php if ( have_posts() ) :
            /* Start the Loop */
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content', get_post_format() ); 
            endwhile;

            else :
              get_template_part( 'no-results' ); 
            endif; 
          ?>
          <?php if( get_theme_mod( 'vw_restaurant_lite_blog_pagination_hide_show',true) != '') { ?>
            <div class="navigation">
              <?php vw_restaurant_lite_blog_posts_pagination(); ?>
              <div class="clearfix"></div>
            </div>
          <?php } ?>
        </div>
      </div>
    <?php }else if($vw_restaurant_lite_left_right == 'Right Sidebar'){ ?>
      <div class="row">
        <div class="services col-lg-8 col-md-8">
          <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-restaurant-lite'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
          <?php if ( have_posts() ) :
            /* Start the Loop */
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content', get_post_format() ); 
            endwhile;

            else :
              get_template_part( 'no-results' ); 
            endif; 
          ?>
          <?php if( get_theme_mod( 'vw_restaurant_lite_blog_pagination_hide_show',true) != '') { ?>
            <div class="navigation">
              <?php vw_restaurant_lite_blog_posts_pagination(); ?>
              <div class="clearfix"></div>
            </div>
          <?php } ?>
        </div>
        <div class="col-lg-4 col-md-4"><?php get_sidebar(); ?></div>
      </div>
    <?php }else if($vw_restaurant_lite_left_right == 'One Column'){ ?>
      <div class="services">
        <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-restaurant-lite'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
        <?php if ( have_posts() ) :
          /* Start the Loop */
          while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content', get_post_format() );
          endwhile;

          else :
            get_template_part( 'no-results' ); 
          endif; 
        ?>
        <?php if( get_theme_mod( 'vw_restaurant_lite_blog_pagination_hide_show',true) != '') { ?>
          <div class="navigation">
            <?php vw_restaurant_lite_blog_posts_pagination(); ?>
            <div class="clearfix"></div>
          </div>
        <?php } ?>
      </div>
    <?php }else if($vw_restaurant_lite_left_right == 'Three Columns'){ ?>
      <div class="row">
        <div  class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
        <div class="services col-lg-6 col-md-6">
          <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-restaurant-lite'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
          <?php if ( have_posts() ) :
            /* Start the Loop */
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content', get_post_format() ); 
            endwhile;

            else :
              get_template_part( 'no-results' ); 
            endif; 
          ?>
          <?php if( get_theme_mod( 'vw_restaurant_lite_blog_pagination_hide_show',true) != '') { ?>
            <div class="navigation">
              <?php vw_restaurant_lite_blog_posts_pagination(); ?>
              <div class="clearfix"></div>
            </div>
          <?php } ?>
        </div>
        <div  class="col-lg-3 col-md-3"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
      </div>
    <?php }else if($vw_restaurant_lite_left_right == 'Four Columns'){ ?>
      <div class="row">
        <div  class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
        <div class="services col-lg-3 col-md-3">
          <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-restaurant-lite'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
          <?php if ( have_posts() ) :
            /* Start the Loop */
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content', get_post_format() ); 
            endwhile;

            else :
              get_template_part( 'no-results' ); 
            endif; 
          ?>
          <?php if( get_theme_mod( 'vw_restaurant_lite_blog_pagination_hide_show',true) != '') { ?>
            <div class="navigation">
              <?php vw_restaurant_lite_blog_posts_pagination(); ?>
              <div class="clearfix"></div>
            </div>
          <?php } ?>
        </div>
        <div  class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
        <div  class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar( 'sidebar-3' ); ?></div>
      </div>
    <?php }else if($vw_restaurant_lite_left_right == 'Grid Layout'){ ?>
      <div class="services">
        <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-restaurant-lite'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
        <div class="row">
          <div class="col-lg-8 col-md-8">
            <div class="row">
              <?php if ( have_posts() ) :
                /* Start the Loop */
                while ( have_posts() ) : the_post();
                  get_template_part( 'template-parts/grid-layout' ); 
                endwhile;

                else :
                  get_template_part( 'no-results' ); 
                endif; 
              ?>
            </div>
            <?php if( get_theme_mod( 'vw_restaurant_lite_blog_pagination_hide_show',true) != '') { ?>
              <div class="navigation">
                <?php vw_restaurant_lite_blog_posts_pagination(); ?>
                <div class="clearfix"></div>
              </div>
            <?php } ?>
          </div>
          <div class="col-lg-4 col-md-4"><?php get_sidebar(); ?></div>
        </div>
      </div>
    <?php }else {?>
      <div class="row">
        <div class="services col-lg-8 col-md-8">
          <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-restaurant-lite'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
          <?php if ( have_posts() ) :
            /* Start the Loop */
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content', get_post_format() ); 
            endwhile;

            else :
              get_template_part( 'no-results' ); 
            endif; 
          ?>
          <?php if( get_theme_mod( 'vw_restaurant_lite_blog_pagination_hide_show',true) != '') { ?>
            <div class="navigation">
              <?php vw_restaurant_lite_blog_posts_pagination(); ?>
              <div class="clearfix"></div>
            </div>
          <?php } ?>
        </div>
        <div class="col-lg-4 col-md-4"><?php get_sidebar(); ?></div>
      </div>
    <?php }?>
  </div>
</main>
<div class="clearfix"></div>

<?php get_footer(); ?>