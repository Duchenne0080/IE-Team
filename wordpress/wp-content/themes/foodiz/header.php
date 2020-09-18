<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the header section
 *
 * @package Foodiz
 * @version 0.1
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- skip-link -->
<a class="skip-link screen-reader-text" href="#content" ><?php esc_html_e('Skip to content','foodiz'); ?></a>

<!-- Navabar Start -->
<?php if( get_theme_mod('foodiz_contact_show') == 1 ) : ?>
<div class="header_contact">
    <div class="container">
        <div class="row">
		<?php 
		$foodiz_phoneno = get_theme_mod( 'foodiz_phoneno' );
		$foodiz_address = get_theme_mod( 'foodiz_address' );
		$foodiz_email   = get_theme_mod( 'foodiz_email' );
		?>
            <div class="col-md-8 col-sm-12 email">
				<p> <?php if($foodiz_email) { ?>
				<i class="fa fa-envelope"></i> <a href="<?php echo esc_url(  'mailto:' . sanitize_email($foodiz_email )); ?>"> <?php echo esc_url( sanitize_email( $foodiz_email )); ?></a>&nbsp <?php } ?> 
				<?php if($foodiz_phoneno) { ?>
				<i class="fa fa-phone"></i> <?php echo esc_html( $foodiz_phoneno ); ?> &nbsp  <?php } ?>
				<?php if($foodiz_address) { ?>
                <i class="fa fa-location-arrow"> </i> <?php echo esc_html( $foodiz_address ); ?> </p>
				<?php } ?>
            </div>
            <div class="col-md-4 col-sm-12 social">
            <?php
            if (has_nav_menu('social')) :
                wp_nav_menu(
                    array(
                        'theme_location' => 'social',
                        'menu_class' => 'social-network ',
                        'walker' => new foodiz_WO_Nav_Social_Walker(),
                        'depth' => 1,
                        'link_before' => '<span class="screen-reader-text">',
                        'link_after' => '</span>',
                    )
                );
            endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<section id="main-menu" class="head" >
    <div id="app" class="container-fluid" <?php if ( has_header_image() ) { ?> style="background-image:url(<?php echo esc_url( get_header_image() ); ?>)" <?php } ?>>
	
	<h1 class="title" id="nav-title">
	<a style="color: #<?php echo esc_attr( get_theme_mod( 'header_textcolor' ) ); ?>" id='logo_url' href="<?php echo esc_url( home_url( '/' ) ); ?> ">
	<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id, 'full' );

	if ( has_custom_logo() ) { ?>
    <img class="logo" src="<?php echo esc_url( $image[0] ); ?>"/>
	<?php } elseif ( display_header_text() ) {
	echo esc_html( get_bloginfo( 'name' ) ); } ?>
	</a></h1>
    <!-- Logo End-->
	</div>
	
	<div class="menu1 " id="app1">		
		<!--<div class="menu1" id="main-menu">-->
        <nav class="navbar navbar-expand-lg navbar-light foodiz-nav">
            <button class="navbar-toggler" id="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation','foodiz'); ?>" style="height: 40px;">
                <span class="sr-only"><?php esc_html_e('Toggle navigation', 'foodiz'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
			
			<?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'depth' => 4, // 1 = no dropdowns, 2 = with dropdowns.
                'container' => 'div',
                'container_class' => 'navbar-collapse collapse',
                'container_id' => 'navbarNavDropdown',
                'menu_class' => 'navbar-nav nav-item',
                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                'walker' => new WP_Bootstrap_Navwalker(),
            ));
            ?>
        </nav>
	</div>
</section>
<!-- Navabar End -->