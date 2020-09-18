<?php
/**
 * Partial template for single post entry meta.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post_layout = get_theme_mod( 'matina_single_posts_layout', 'layout-default' );

/**
 * matina_before_single_entry_meta hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_meta' );
?>
    <div class="entry-meta single-entry-meta">

        <?php if ( 'layout-two' === $post_layout ) { ?>
            <div class="entry-meta-posted-on posted-on-wrap">
                <?php matina_posted_on(); ?>
            </div><!-- .posted-on-wrap -->
        <?php } ?>

        <div class="entry-meta-posted-by posted-by-wrap">
            <?php
                if ( 'layout-one' === $post_layout ) {
                    $author_id      = get_the_author_meta( 'ID' );
                    $author_avatar  = get_avatar( $author_id, 'thumbnail' );
                    echo $author_avatar;
                }
            ?>
            <span class="byline">
                <span class="author vcard">
                    <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
                </span>
            </span>
        </div><!-- .posted-by-wrap -->

        <div class="entry-meta-comment comment-mark">
            <?php
                if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
                    echo '<span class="comments-link">';
                    comments_popup_link(
                        sprintf(
                            wp_kses(
                                /* translators: %s: post title */
                                __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'matina' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post( get_the_title() )
                        )
                    );
                    echo '</span>';
                }
            ?>
        </div><!-- .comment-mark -->

    </div><!-- .single-entry-meta -->
<?php
/**
 * matina_after_single_entry_meta hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_entry_meta' );