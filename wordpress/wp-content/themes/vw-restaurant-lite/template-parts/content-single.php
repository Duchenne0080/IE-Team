<?php
/**
 * The template part for displaying single post content
 *
 * @package VW Restaurant Lite 
 * @subpackage vw_restaurant_lite
 * @since VW Restaurant Lite 1.0
 */
?>
<?php 
  $vw_restaurant_lite_archive_year  = get_the_time('Y'); 
  $vw_restaurant_lite_archive_month = get_the_time('m'); 
  $vw_restaurant_lite_archive_day   = get_the_time('d'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>  
	<div class="single-post">
		<h1><?php the_title();?></h1>
		<?php if( get_theme_mod( 'vw_restaurant_lite_toggle_postdate',true) != '' || get_theme_mod( 'vw_restaurant_lite_toggle_author',true) != '' || get_theme_mod( 'vw_restaurant_lite_toggle_comments',true) != '') { ?>
			<div class="metabox">
				<?php if(get_theme_mod('vw_restaurant_lite_toggle_postdate',true)==1){ ?>
					<span class="entry-date"><i class="fas fa-calendar-alt"></i><a href="<?php echo esc_url( get_day_link( $vw_restaurant_lite_archive_year, $vw_restaurant_lite_archive_month, $vw_restaurant_lite_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
				<?php } ?>

				<?php if(get_theme_mod('vw_restaurant_lite_toggle_author',true)==1){ ?>
			      <i class="far fa-user"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
			    <?php } ?>

			    <?php if(get_theme_mod('vw_restaurant_lite_toggle_comments',true)==1){ ?>
			      <i class="fas fa-comments"></i><span class="entry-comments"><?php comments_number( __('0 Comments','vw-restaurant-lite'), __('0 Comments','vw-restaurant-lite'), __('% Comments','vw-restaurant-lite')); ?></span>
			    <?php } ?>
			</div>
		<?php } ?>

		<?php if(has_post_thumbnail()) { ?>
	        <div class="feature-box">   
	          <?php the_post_thumbnail(); ?>
	        </div>
	        <hr>                    
	    <?php } ?> 
	    <div class="entry-content">
	      <?php the_content(); ?>
    	</div> 
    	<?php if(get_theme_mod('vw_restaurant_lite_toggle_tags',true)==1){ ?>
    		<div class="tags"><?php the_tags(); ?></div>
    	<?php } ?>
	    <?php
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'vw-restaurant-lite' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'vw-restaurant-lite' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
			
		if ( is_singular( 'attachment' ) ) {
			// Parent post navigation.
			the_post_navigation( array(
				'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'vw-restaurant-lite' ),
			) );
		} elseif ( is_singular( 'post' ) ) {
			// Previous/next post navigation.
			the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' .esc_html(get_theme_mod('vw_restaurant_lite_single_blog_next_navigation_text','NEXT PAGE')) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Next post:', 'vw-restaurant-lite' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' .esc_html(get_theme_mod('vw_restaurant_lite_single_blog_prev_navigation_text','PREVIOUS PAGE')) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Previous post:', 'vw-restaurant-lite' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
            ) );
		}

		echo '<div class="clearfix"></div>';

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}?>
	</div>
	<?php get_template_part('template-parts/related-posts'); ?>
</article>