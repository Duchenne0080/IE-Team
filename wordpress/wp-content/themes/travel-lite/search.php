<?php 
/* Travel Theme's Search Page
	Copyright: 2012-2017, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Travel 1.0
*/

get_header(); ?>

<div id="container">
		<?php if (have_posts()) : ?>
		<div id="content">
        <h1 class="arc-post-title"><?php _e('Search Results', 'travel-lite'); ?></h1>
		
		<?php $counter = 0; ?>
		<?php query_posts($query_string . "&posts_per_page=20"); ?>
		<?php while (have_posts()) : the_post();
			if($counter == 0) {
				$numposts = $wp_query->found_posts; // count # of search results ?>
				<h3 class="arc-src"><span><?php _e('Search Term: ', 'travel-lite'); ?></span><?php the_search_query(); ?></h3>
				<h3 class="arc-src"><span><?php _e('Number of Results: ', 'travel-lite'); ?></span><?php echo $numposts; ?></h3> <div class="content-ver-sep"></div><br />
				<?php } //endif ?>
			
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
 <span class="postmetadata"><h3><?php the_time('F j, Y'); ?></h3><div class="content-ver-sep"> <div class="content-ver-sep"> </div><h2><?php _e('By', 'travel-lite'); ?>: <?php the_author_posts_link() ?></h2><h5><?php comments_popup_link(__('No Comments Yet&#187;','travel-lite'), __('1 Comment &#187;','travel-lite'), __('% Comments &#187;','travel-lite')); ?></h5><?php _e('Posted in', 'travel-lite'); ?> <?php the_category(', ') ?><?php the_tags(__('<br />Tags: ', 'travel-lite'), ', ', ''); ?><br /><h5><?php edit_post_link(__('Edit This Post', 'travel-lite')); ?></h5></span>	
 <div class="entrytext"><div class="thumb"><?php the_post_thumbnail(); ?></div>
 <?php the_excerpt(); ?>
 <div class="clear"> </div>
 </div></div>
 <div class="content-ver-sep"></div><br />
				
		<?php $counter++; ?>
 		
		<?php endwhile; ?>
		</div>		
		<?php get_sidebar(); ?>
        <?php else: ?>
		<br /><br /><h1 class="arc-post-title"><?php _e('Sorry, we could not find anything that matched...', 'travel-lite'); ?></h1>
		
		<h3 class="arc-src"><span><?php _e('You Can Try the Search...', 'travel-lite'); ?></span></h3>
		<?php get_search_form(); ?><br />
		<p><a href="<?php echo home_url(); ?>" title="<?php _e('Browse the Home Page', 'travel-lite'); ?>">&laquo; <?php _e('Or Return to the Home Page', 'travel-lite'); ?></a></p><br />
		<h2 class="post-title-color"><?php _e('You can also Visit the Following. These are the Featured Contents', 'travel-lite'); ?></h2>
		<div class="content-ver-sep"></div><br />
		<?php get_template_part( 'featured-box' ); ?>

	<?php endif; ?>
	
<?php get_footer(); ?>