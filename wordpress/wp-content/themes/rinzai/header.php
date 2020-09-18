<?php
/**
 * Header template file.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <a class="skip-link screen-reader-text" href="#site-content"><?php _e( 'Skip to content', 'rinzai' ); ?></a>

    <div id="app">
        <div class="uk-offcanvas-content">

            <header id="site-header" class="uk-navbar-container uk-box-shadow-small">
                <div class="uk-container">
                    <nav class="uk-navbar" data-uk-navbar>
                        <div class="uk-navbar-left">
                            <?php
                			/**
                			 * Functions hooked into rinzai_header_left action
                			 *
                			 * @hooked rinzai_header_logotype              - 0
                             * @hooked rinzai_header_navbar                - 10
                			 */
                            do_action( 'rinzai_header_left' ); ?>
                        </div>
                        <div class="uk-navbar-right">
                            <?php
                			/**
                			 * Functions hooked into rinzai_header_left action
                			 *
                			 * @hooked rinzai_customizer_navbar_phone_display       - 0
                             * @hooked rinzai_customizer_navbar_email_display       - 10
                             * @hooked rinzai_customizer_navbar_social_menu_display - 20
                             * @hooked rinzai_header_search_toggle                  - 30
                             * @hooked rinzai_header_mobile_nav_toggle              - 40
                			 */
                            do_action( 'rinzai_header_right' ); ?>
                        </div>
                    </nav>
                </div>
            </header> <!-- #site-header -->

            <div id="site-content">
