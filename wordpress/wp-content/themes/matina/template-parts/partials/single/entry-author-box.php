<?php
/**
 * Partial template for single post entry author box.
 * 
 * @package Matina
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$box_option = get_theme_mod( 'matina_single_posts_author_box_option', true );

if ( false === $box_option ) {
    return;
}

$extra_class = 'mt-clearfix';

$box_layout = apply_filters( 'matina_single_posts_author_box_layout', 'layout-default' );
if ( ! empty( $box_layout ) ) {
    $extra_class .= ' author-box--'.$box_layout;
}

$author_id         = get_the_author_meta( 'ID' );
$author_avatar     = get_avatar( $author_id, 'thumbnail' );
$author_post_link  = get_the_author_posts_link();
$author_bio        = get_the_author_meta( 'description' );
$author_url        = get_the_author_meta( 'user_url' );

/**
 * matina_before_single_entry_author_box hook
 *
 * @since 1.0.0
 */
do_action( 'matina_before_single_entry_author_box' );
?>
<div class="entry-author-box single-author-box <?php echo esc_attr( $extra_class ); ?>" <?php matina_schema_markup( 'author_link' ); ?>>

    <div class="article-author-avatar mt-clearfix">
        
        <?php if ( $author_avatar ) { ?>
            <div class="avatar-wrap" <?php matina_schema_markup( 'avatar' ); ?>>
                <?php echo wp_kses_post( $author_avatar ); ?>
            </div><!-- .m-author-avatar -->
        <?php } ?>
    </div><!-- .article-author-avatar -->

    <div class="post-author-info mt-clearfix">
        <?php if ( $author_post_link ) { ?>
                <h5 class="author-name" <?php matina_schema_markup( 'author_name' ); ?>><?php echo $author_post_link; ?></h5>
        <?php } ?>

        <?php if ( $author_bio ) { ?>
            <div class="author-bio" <?php matina_schema_markup( 'description' ); ?>>
                <?php echo wp_kses_post( $author_bio ); ?>
            </div><!-- .author-bio -->
        <?php } ?>

        <div class="author-meta-wrap">
            <?php if ( $author_url ) { ?>
                <div class="author-website" <?php matina_schema_markup( 'url' ); ?>>
                    <span><?php esc_html_e( 'Website', 'matina' ); ?></span>
                    <a href="<?php echo esc_url( $author_url ); ?>" target="_blank"><?php echo esc_url( $author_url ); ?></a>
                </div><!-- .author-website -->
            <?php } ?>
        </div><!-- .author-meta-wrap -->
    </div><!-- .post-author-info -->

</div><!-- .single-author-box -->
<?php
/**
 * matina_after_single_entry_author_box hook
 *
 * @since 1.0.0
 */
do_action( 'matina_after_single_entry_author_box' );