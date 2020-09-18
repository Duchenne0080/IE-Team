<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$panel_name   = 'theme_options';
$section_name = 'header';

$link_type    = business_class_get_theme_mod( $panel_name, $section_name, 'link_type' );
$header_style = business_class_get_theme_mod( $panel_name, $section_name, 'header_style' );

$cta_link = '';
if ( 'custom_links' === $link_type ) {
	$cta_link = business_class_get_theme_mod( $panel_name, $section_name, $link_type );
} elseif ( 'wp_pages' === $link_type ) {
	$cta_page = business_class_get_theme_mod( $panel_name, $section_name, 'cta_page' );
	$cta_link = get_the_permalink( $cta_page );
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'business-class' ); ?></a>

	<?php get_template_part( 'template-parts/header/top-bar' ); ?>
	<header id="masthead" class="overlap-header sticky-enabled <?php echo esc_attr( $header_style ); ?>">

		<div class="container">

			<div class="site-branding pull-left">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$business_class_description = get_bloginfo( 'description', 'display' );
				if ( $business_class_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $business_class_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<div class="header-right pull-right">

				<nav id="site-navigation" class="main-navigation pull-left">

					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php echo esc_html( '&#9776;' ); ?></button>

					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'menu-1',
							'menu_id'         => 'primary-menu',
							'container_class' => 'menu-primary-menu-container',
							'fallback_cb'     => 'business_class_menu_fallback',
						)
					);
					?>

				</nav><!-- #site-navigation -->

				<div class="header-search-wrapper pull-right">

					<?php if ( business_class_get_theme_mod( $panel_name, $section_name, 'enable_header_search' ) ) { ?>
						<div id="header-search" class="pull-left">
							<a href="#" class="search-icon"><i class="fa fa-search"></i></a>
							<div class="search-box-wrap">
								<div class="searchform" role="search">
									<?php get_search_form(); ?>
								</div><!-- .searchform -->
							</div><!-- .search-box-wrap -->
						</div>
					<?php } ?>

					<?php if ( business_class_get_theme_mod( $panel_name, $section_name, 'enable_cta' ) && $cta_link ) { ?>
						<div class="my-account pull-left">
							<a href="<?php echo esc_url( $cta_link ); ?>"><?php echo esc_html( business_class_get_theme_mod( $panel_name, $section_name, 'label' ) ); ?></a>
						</div>
					<?php } ?>

				</div><!-- .header-search-wrapper -->

			</div>

		</div><!-- .container -->

	</header><!-- #masthead -->

