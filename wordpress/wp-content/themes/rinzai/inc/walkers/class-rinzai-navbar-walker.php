<?php

/**
 * Custom walker class to output markup for UIkit v3 navbar.
 */
class Rinzai_Navbar_Walker extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1 ); // because it counts the first submenu as 0

        // Dropdown animation.
        $dropdown_animation = ( $display_depth >= 1 )
            ? 'data-uk-dropdown="animation: uk-animation-slide-top-small"'
            : '' ;

        // List container classes.
        $ul_container_class_names_array = array(
            ( $display_depth >= 1 ? 'uk-navbar-dropdown' : '' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
        );
        $ul_container_class_names = implode( ' ', $ul_container_class_names_array );

        // List classes.
        $ul_class_names_array = array(
            'uk-nav uk-navbar-dropdown-nav sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth,
        );
        $ul_class_names = implode( ' ', $ul_class_names_array );

        // Build HTML for output.
        $output .= "\n" . $indent . '<div ' . $dropdown_animation . ' class="' . $ul_container_class_names . '"><ul class="' . $ul_class_names . '">' . "\n";
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::end_lvl()
     *
     * @param string   $output Passed by reference. Used to append additional content.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        $output .= "$indent</ul></div>{$n}";
    }
}
