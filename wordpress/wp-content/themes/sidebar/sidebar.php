<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sidebar
 */

if ( ! is_active_sidebar( 'sidebar-main' ) ) {
 	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'sidebar-main' ); ?>
</div>
