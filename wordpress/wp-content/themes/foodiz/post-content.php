<!-- Post Details Area -->
<div id="post-<?php the_ID(); ?>" <?php post_class( 'foodiz_blog' ); ?>>
<div class="single-post-details-area mb-30">
    <div class="post-content">
		<div class="row">
		<?php if ( is_single() || is_home() ) {
		if( has_post_thumbnail() ) { ?>
			<div class="col-md-3 col-4 blog_info text-right" >
				<p><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><span><?php esc_html_e('By','foodiz'); ?></span> <?php the_author(); ?></a> <i class="fa fa-user-o"></i></p>
			
				<p class="post-date"><?php echo esc_html( get_the_date() ); ?><i class="fa fa-calendar"></i></p>
				
				<p><?php comments_number( '0', '1 comment', '% comments' ); ?> <i class="fa fa-comment-o"></i>
				</p>
			</div>
		<?php } else { ?>
			<div class="col-md-12 col-12 blog_info text-right" >
				<p class="metabox-data">
				<i class="fa fa-user-o"></i> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><span><?php esc_html_e('By','foodiz'); ?></span> <?php the_author(); ?></a> 
			
				<i class="fa fa-calendar"></i> <span class="post-date"><?php echo esc_html( get_the_date() ); ?>
				
				<i class="fa fa-comment-o"></i><?php comments_number( '0', '1 comment', '% comments' ); ?>
				</p>
			</div>
		<?php } } ?>
		
		<?php if (has_post_thumbnail()) { ?>
		<div class="col-md-9 col-8" >
			<div class="post-thumbnail mb-30">
			<?php
				the_post_thumbnail( 'foodiz-blog-thumb' );
			 ?>
			</div>
		</div>
		<?php } ?>
		</div>
		
		<div class="single-detail">
		<?php if(is_single()) : ?>
		<h1 class="blog-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php endif; ?>
		
        <?php if ( is_single() && get_the_category_list() ) { ?>
        <div class="mt-3 category">
            <div class="tag_list">
                <?php the_tags( __( 'Tags : ', 'foodiz' ), ' , ', '<br/>' ); ?>
            </div>
        </div>
		<div class="mt-3 category">
            <div class="category_list">
                <span> <?php esc_html_e( "Categories :", 'foodiz' ); ?> </span>
				<?php the_category( ' , ' ); ?>
            </div>
        </div>
        <?php } 
		 
        if ( is_single() || is_page() ) {
			the_content();
		} else {
			the_excerpt();
		}
		
	    if ( ! is_page() && ! is_single() ) { ?>
        <a class="read-more" target="_blank" href="<?php the_permalink(); ?>"> <?php esc_html_e( 'View More ', 'foodiz' ); ?> </a>
		<?php } ?>
		</div>
		
		<!-- Post Line -->

		<?php if(is_single()) :
		$foodiz_pagination = array(
			'before'           => '<p>' . __( 'Pages:', 'foodiz' ),
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'separator'        => ' ',
			'nextpagelink'     => __( 'Next page', 'foodiz' ),
			'previouspagelink' => __( 'Previous page', 'foodiz' ),
			'pagelink'         => '%',
			'echo'             => 1
		);
		wp_link_pages( $foodiz_pagination );
		endif; 
		?>

    </div>
    </div>
</div>