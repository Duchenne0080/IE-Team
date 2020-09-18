<?php
$main_heading_font = get_theme_mod( 'main_heading_font' );
$menu_font = get_theme_mod( 'menu_font');
$theme_title   = get_theme_mod( 'theme_title');
$desc_font_all   = get_theme_mod( 'desc_font_all' );
?>

<style>
#logo_url {
	font-family: <?php echo $main_heading_font; ?>
}
.foodiz-nav li a {
	font-family: <?php echo $menu_font; ?>
}
.slider_contant a.post-title, .cat-link a, .about-section h1.color-pink, .parallex-txt h2, .color-pink, .blog-entry .text h3 a, #sidebar-footer .widget-title, h1.blog-title a, .post-sidebar-area .widget-title, .post-content h4, .breadCrumbBkground  {
	font-family: <?php echo $theme_title; ?>
}
</style>