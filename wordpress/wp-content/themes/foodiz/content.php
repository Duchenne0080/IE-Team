<!-- Content -->
<div class="post-content mb-50" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- Thumbnail -->
    <div class="post-thumbnail mb-15">
        <a href="<?php the_permalink(); ?>">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail( 'foodiz-about-thumb' );
            }
            ?>
        </a>
    </div>
    <!-- Title -->
    <a href="<?php the_permalink(); ?>" class="post-title">
        <h4><?php the_title(); ?></h4>
    </a>
    <p class="post-date"><?php echo esc_html( get_the_date() ); ?>
		<span class="comment-no">
			<i class="fa fa-comments"></i><?php echo esc_html( get_comments_number()); ?>  
		</span>
	</p>
    <div class="post-meta">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><span><?php esc_html_e('by','foodiz'); ?></span> <?php the_author(); ?></a>
		
    </div>
    <div class="post-excerpt">
    <?php the_excerpt(); ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e('View More','foodiz'); ?></a>
</div>

<!-- Post Line -->
<div class="post-line mb-50">
<?php wp_link_pages( array(
    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'foodiz' ) . '</span>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
    ) );
?>
    <hr>
</div>