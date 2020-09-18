<?php

if ( ! function_exists( 'sidebar_body_classes' ) ) :
function sidebar_body_classes($classes) {
		if ( has_post_thumbnail() ) {
	        $classes[] = 'has-thumbnail';
		}
        return $classes;
}
endif;

add_filter('body_class', 'sidebar_body_classes');


/**
 * Footer Credits
*/
if ( ! function_exists( 'sidebar_footer_credit' ) ) :

function sidebar_footer_credit(){

    $text  = '<div class="copyright">';
	$text .= '<div class="left-text col-lg-6 col-md-6 col-sm-12 col-xs-12">';
    $text .=  esc_html__( 'Copyright &copy; ', 'sidebar' ) . date_i18n( 'Y' );
    $text .= ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
    $text .= '</div><div class="right-text  col-lg-6 col-md-6 col-sm-12 col-xs-12">';
    $text .= '<a href="' . esc_url( 'http://metricthemes.com/theme/sidebar/' ) .'" rel="author" target="_blank">' . esc_html__( 'Sidebar by MetricThemes', 'sidebar' ) .'</a>. '; /* translators: %s: wordpress.org URL */ 
    $text .= sprintf( esc_html__( 'Powered by %s', 'sidebar' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'sidebar' ) ) .'" target="_blank">WordPress</a>.' );
    $text .= '</span></div>';

    echo apply_filters( 'sidebar_footer_text', $text ); // WPCS: xss ok
}

add_action( 'sidebar_footer', 'sidebar_footer_credit' );

endif;

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function sidebar_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'sidebar_pingback_header' );

/**
 * Move textarea of comment form to bottom
 */
function sidebar_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'sidebar_move_comment_field_to_bottom' );


/**
 * Excerpt Length Control
 */

function sidebar_customexcerptlength( $length ) {

	if ( is_admin() ) {
		return $length;
	}
	else {
    	return 30;
	}
}

add_filter('excerpt_length', 'sidebar_customexcerptlength');