<?php
/* 	Travel Theme's General Page to display all Pages
	Copyright: 2012-2017, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Travel 1.0
*/

 get_header(); ?>

<div id="container">
	<div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="entrytext">
 <?php the_content(__('<span class="read-more">Read the rest of this page &raquo;</span>','travel-lite')); ?>

				<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','travel-lite').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>
        <?php endwhile; ?><div class="clear"> </div>
	<?php edit_post_link(__('Edit This Entry','travel-lite'), '<p>', '</p>'); ?>
	<?php comments_template('', true); ?>
	<?php else: ?>
		<p><?php _e('Sorry, no pages matched your criteria', 'travel-lite'); ?></p>
	<?php endif; ?>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>