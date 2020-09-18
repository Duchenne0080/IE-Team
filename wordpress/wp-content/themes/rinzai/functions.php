<?php
/**
 * Theme initialization.
 */

/**
 * Assign the Rinzai theme version to a variable.
 */
$rinzai_theme = wp_get_theme( 'rinzai' );
$rinzai_theme_version = $rinzai_theme[ 'Version' ];

/**
 * Set the content width.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 780;
}

$rinzai = (object) array(
	'version' => $rinzai_theme_version,

	/**
	 * Initialize all the things.
	 */
	'main' => require 'inc/class-rinzai.php',
    'customizer' => require 'inc/customizer/class-rinzai-customizer.php',
);

// Theme functions and hooks.
require 'inc/rinzai-functions.php';
require 'inc/rinzai-template-hooks.php';
require 'inc/rinzai-template-functions.php';

// WordPress Customizer functions and hooks.
require 'inc/customizer/rinzai-customizer-hooks.php';
require 'inc/customizer/rinzai-customizer-functions.php';

// Theme custom walkers.
require 'inc/walkers/class-rinzai-navbar-walker.php';
require 'inc/walkers/class-rinzai-comments-walker.php';
require 'inc/walkers/class-rinzai-offcanvas-nav-walker.php';
