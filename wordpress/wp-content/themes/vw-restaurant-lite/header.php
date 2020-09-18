<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package VW Restaurant Lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) 
  {
    wp_body_open();
  }else{
    do_action('wp_body_open');
  } 
?>

<header role="banner">
  <a class="screen-reader-text skip-link" href="#maincontent"><?php esc_html_e( 'Skip to content', 'vw-restaurant-lite' ); ?></a> 

  <?php if( get_theme_mod('vw_restaurant_lite_topbar_hide_show') != ''){ ?>
    <div class="topheader">
      <div class="container">
        <div class="row">
          <div class="top-contact col-lg-6 col-md-6">
            <?php if( get_theme_mod( 'vw_restaurant_lite_contact','' ) != '') { ?>
              <span class="call"><i class="<?php echo esc_attr(get_theme_mod('vw_restaurant_lite_cont_phone_icon','fa fa-phone')); ?>"></i><?php echo esc_html( get_theme_mod('vw_restaurant_lite_contact','')); ?></span>
             <?php } ?>
          </div>   
          <div class="top-email col-lg-6 col-md-6">
            <?php if( get_theme_mod( 'vw_restaurant_lite_email','' ) != '') { ?>
              <span class="email"><i class="<?php echo esc_attr(get_theme_mod('vw_restaurant_lite_cont_email_icon','fa fa-envelope')); ?>"></i><?php echo esc_html( get_theme_mod('vw_restaurant_lite_email','') ); ?></span>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="header <?php if( get_theme_mod( 'vw_restaurant_lite_sticky_header') != '') { ?> header-sticky"<?php } else { ?>close-sticky <?php } ?>">
    <div class="container">
      <div class="row">
        <div class="logo col-lg-2 col-md-3 col-8">
          <?php if ( has_custom_logo() ) : ?>
              <div class="site-logo"><?php the_custom_logo(); ?></div>
            <?php endif; ?>
            <?php $blog_info = get_bloginfo( 'name' ); ?>
              <?php if ( ! empty( $blog_info ) ) : ?>
                <?php if ( is_front_page() && is_home() ) : ?>
                  <?php if( get_theme_mod('vw_restaurant_lite_logo_title_hide_show',true) != ''){ ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                  <?php } ?>
                <?php else : ?>
                  <?php if( get_theme_mod('vw_restaurant_lite_logo_title_hide_show',true) != ''){ ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                  <?php } ?>
                <?php endif; ?>
              <?php endif; ?>
            <?php
              $description = get_bloginfo( 'description', 'display' );
              if ( $description || is_customize_preview() ) :
            ?>
            <?php if( get_theme_mod('vw_restaurant_lite_tagline_hide_show',true) != ''){ ?>
              <p class="site-description">
                <?php echo esc_html($description); ?>
              </p>
            <?php } ?>
          <?php endif; ?>
        </div>
        <div class="menubox col-lg-7 col-md-5 col-4">
          <?php if(has_nav_menu('primary')){ ?>
            <div class="toggle-nav mobile-menu">
              <button onclick="vw_restaurant_lite_menu_open_nav()" class="responsivetoggle"><i class="<?php echo esc_attr(get_theme_mod('vw_restaurant_lite_res_menu_open_icon','fas fa-bars')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Open Button','vw-restaurant-lite'); ?></span></button>
            </div>
          <?php } ?>
          <div id="mySidenav" class="nav sidenav">
            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'vw-restaurant-lite' ); ?>">
              <?php 
                if(has_nav_menu('primary')){
                  wp_nav_menu( array( 
                    'theme_location' => 'primary',
                    'container_class' => 'main-menu clearfix' ,
                    'menu_class' => 'clearfix',
                    'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                    'fallback_cb' => 'wp_page_menu',
                  ) ); 
                }
              ?>
              <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="vw_restaurant_lite_menu_close_nav()"><i class="<?php echo esc_attr(get_theme_mod('vw_restaurant_lite_res_close_menu_icon','fas fa-times')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Button','vw-restaurant-lite'); ?></span></a>
            </nav>
          </div>
        </div>
        <div class="col-lg-3 col-md-4">
          <?php dynamic_sidebar( 'social-icon' ); ?>
        </div>
      </div>
    </div>
  </div>
</header>

<?php if(get_theme_mod('vw_restaurant_lite_loader_enable',true)==1){ ?>
  <div class="spinner-wrapper">
    <div class="spinner">
      <?php $vw_restaurant_lite_theme_lay = get_theme_mod( 'vw_restaurant_lite_loader_icon','Two Way');
        if($vw_restaurant_lite_theme_lay == 'Two Way'){ ?>

          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/two-way.gif" alt="" role="img"/>

      <?php }else if($vw_restaurant_lite_theme_lay == 'Dots'){ ?>

        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/dots.gif" alt="" role="img"/>

      <?php }else if($vw_restaurant_lite_theme_lay == 'Rotate'){ ?>

        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/rotate.gif" alt="" role="img"/>
        
      <?php } ?>
    </div>
  </div>
<?php } ?>

  <?php if ( is_singular() && has_post_thumbnail() ) : ?>
    <?php
      $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'vw-restaurant-lite-post-image-cover' );
      $post_image = $thumb['0'];
    ?>
    <div class="header-image bg-image" style="background-image: url(<?php echo esc_url( $post_image ); ?>)">

      <?php the_post_thumbnail( 'vw-restaurant-lite-post-image' ); ?>

    </div>

  <?php elseif ( get_header_image() ) : ?>
  <div class="header-image bg-image" style="background-image: url(<?php header_image(); ?>)">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
      <img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" role="img" alt="<?php the_title(); ?> post thumbnail image">
    </a>
  </div>
  <?php endif; // End header image check. ?>