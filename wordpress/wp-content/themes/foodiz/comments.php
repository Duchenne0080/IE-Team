<?php
/**
 * The template for displaying Comments
 *
 * @package Foodiz
 * @version 0.1
 */

if (post_password_required()) {
    return;
} ?>
<div id="comments" class="comments-area">
    <h3 class="comments-title">
    <?php
			if ( 1 === get_comments_number() ) {
				printf(
				/* translators: %s: The post title. */
					esc_html_e( 'One thought on &ldquo;%s&rdquo;', 'foodiz' ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			} else {
				printf(
				/* translators: %1$s: The number of comments. %2$s: The post title. */
					esc_html( _n( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'foodiz' ) ),
					esc_html( number_format_i18n( get_comments_number() ) ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			}
	?>
    </h3>
    <hr>
    <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
    <ul class="comment-list">
        <?php wp_list_comments('type=comment&callback=foodiz_comment'); ?>
    </ul>
	
	<?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php esc_html_e( 'Comment navigation', 'foodiz' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'foodiz' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'foodiz' ) ); ?></div>
		</nav>
	<?php endif; // check for comment navigation 

    if ( comments_open() ) { ?>
        <div class="leave-coment-form">
			<?php $fields = array(
				'author' => '<div class="row"><div class="col-sm-6 form-group"><input name="author" id="name" type="text" id="exampleInputEmail1" class="form-control" placeholder="'.esc_attr__( 'Name' , 'foodiz' ).'"></div>',
				'email'  => '<div class="col-sm-6 form-group"><input  name="email" id="email" type="text" class="form-control" placeholder="'.esc_attr__( 'Email' , 'foodiz' ).'"></div></div>',
			);
			function foodiz_fields( $fields ) {
				return $fields;
			}

			add_filter( 'foodiz_comment_form', 'foodiz_fields' );
			$defaults = array(
				'fields'         => apply_filters( 'foodiz_comment_form', $fields ),
				'comment_field'  => '<div class="leave-coment-form"><div class="form-group">
				<textarea id="comment" name="comment" class="form-control" placeholder="'.esc_attr__( 'Your comment here...' , 'foodiz' ).'" required=""></textarea></div></div>',
				'logged_in_as'   => '<p class="logged-in-as">' . __( "Logged in as ", 'foodiz' ) . '<a href="' . esc_url( admin_url( 'profile.php' ) ) . '">' . $user_identity . '</a>' . '<a href="' . esc_url( wp_logout_url( get_permalink() ) ) . '" title="Log out of this account">' . __( " Log out?", 'foodiz' ) . '</a>' . '</p>',
				/* translators: %s: reply to name */
				'title_reply_to' => __( 'Leave a Reply to %s', 'foodiz' ),
				'id_submit'      => 'mm_single_submit',
				'label_submit'   => __( 'Post Comment', 'foodiz' ),
				'title_reply'    => '<h3 class="courses-title  mb-4">' . __( 'Leave a Reply', 'foodiz' ) . '</h3>',
				'role_form'      => 'form',
			);
			comment_form( $defaults ); ?>
        </div>
	<?php } else { ?>
        <p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'foodiz' ); ?></p>
	<?php } ?>
</div>