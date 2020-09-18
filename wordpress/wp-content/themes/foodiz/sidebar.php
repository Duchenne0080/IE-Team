<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Foodiz
 * @version 0.1
 */
?>
<!-- Blog Sidebar Area Right-->
<div class="post-sidebar-area">
    <?php if (is_active_sidebar('primary')) :
        dynamic_sidebar('primary'); 
	else : ?>
	<div class="single-widget-area">
        <?php the_widget( 'WP_Widget_Categories', 'dropdown=1&count=1' ); ?>
    </div>

    <div class="single-widget-area">                
        <?php  $foodiz_widget = array(
               'before_widget' => '<div id="%1$s" class="widget-pages">',
               'after_widget'  => '</div>',
               'before_title'  => '<h3>',
               'after_title'   => '</h3>'
        );
        the_widget( 'WP_Widget_Pages', null, $foodiz_widget );?>
    </div>
    <?php endif; ?>
</div>