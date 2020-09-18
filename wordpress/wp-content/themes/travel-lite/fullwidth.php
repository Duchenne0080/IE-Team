<?php
/*
	Template Name: Full Width
 	Travel Theme's Full Width Page to show the Pages Selected Full Width
	Copyright: 2012-2017, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Travel 1.0
*/
get_header(); ?>

<div id="container">
<div id="content-full">
 <?php if (have_posts()) : while (have_posts()) : the_post();?>
 
 <h1 id="post-<?php the_ID(); ?>" class="page-title"><?php the_title();?></h1>
 <div class="entrytext">
 <?php the_content(); ?>
 </div><div class="clear"> </div>
 <?php edit_post_link(__('Edit This Post', 'travel-lite'), '<p>', '</p>'); ?>
<?php comments_template('', true); ?>
 <?php endwhile; endif; ?>
 



</div>
<?php get_footer(); ?>