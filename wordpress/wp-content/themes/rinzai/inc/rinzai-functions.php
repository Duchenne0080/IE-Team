<?php
/**
 * Rinzai functions.
 */

if ( ! function_exists( 'rinzai_is_static_front_page' ) ) :
    /**
     * Return whether we're previewing the front page and it's a static page.
     */
    function rinzai_is_static_front_page() {
        return ( is_front_page() && ! is_home() );
    }
endif;

if ( ! function_exists( 'rinzai_get_first_paragraph' ) ) :
    /**
    * Get first paragraph of the queried page or post.
    */
    function rinzai_get_first_paragraph() {
        global $post;

        $str = wpautop( get_the_content() );
        $str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
        $str = strip_tags( $str, '<a><strong><em>' );

        return '<p>' . $str . '</p>';
    }
endif;
