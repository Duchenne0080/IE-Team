<?php 
/* 	Travel Theme's Archive Page
	Copyright: 2012-2017, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Travel 1.0
*/

get_header(); ?>

<div id="container">

<div id="content">
	<?php if (have_posts()) : ?>
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<h1 class="page-title"><?php the_archive_title(); ?></h1>
		<div class="description"><?php echo the_archive_description(); ?></div>
		<div class="content-ver-sep"></div><br />

		<?php while (have_posts()) : the_post(); ?>
		
			<div <?php post_class(); ?>>
				<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
 <span class="postmetadata"><h3><?php the_time('F j, Y'); ?></h3><div class="content-ver-sep"> </div><h2><?php _e('By', 'travel-lite'); ?>: <?php the_author_posts_link() ?></h2><h5><?php comments_popup_link(__('No Comments Yet&#187;','travel-lite'), __('1 Comment &#187;','travel-lite'), __('% Comments &#187;','travel-lite')); ?></h5><?php _e('Posted in', 'travel-lite'); ?> <?php the_category(', ') ?><?php the_tags(__('<br />Tags: ', 'travel-lite'), ', ', ''); ?><br /><h5><?php edit_post_link(__('Edit This Post', 'travel-lite')); ?></h5></span>	
 <div class="entrytext"><div class="thumb"><?php the_post_thumbnail(); ?></div>
 <?php the_excerpt(); ?>
 <div class="clear"> </div>
 </div></div>
 <div class="content-ver-sep"></div><br />
	
		<?php endwhile; ?>
			
	<div id="page-nav">
	<div class="alignleft"><?php previous_posts_link(__('&laquo; Previous Entries','travel-lite')) ?></div>
	<div class="alignright"><?php next_posts_link(__('Next Entries &raquo;','travel-lite'),'') ?></div>
	</div>

	<?php else : ?>

		<h1 class="arc-post-title"><?php _e('Sorry, we could not find anything that matched...', 'travel-lite'); ?></h1>
		
		<h3 class="arc-src"><span><?php _e('You Can Try the Search...', 'travel-lite'); ?></span></h3>
		<?php get_search_form(); ?><br />
		<p><a href="<?php echo home_url(); ?>" title="<?php _e('Browse the Home Page', 'travel-lite'); ?>">&laquo; <?php _e('Or Return to the Home Page', 'travel-lite'); ?></a></p><br />
		<h2 class="post-title-color"><?php _e('You can also Visit the Following. These are the Featured Contents', 'travel-lite'); ?></h2>
		<div class="content-ver-sep"></div><br />
		<?php get_template_part( 'featured-box' ); ?>

	<?php endif; ?>

</div><!--close content id-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
