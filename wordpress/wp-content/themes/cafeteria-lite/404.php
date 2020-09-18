<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Cafeteria Lite
 */

get_header(); ?>

<div class="container">
    <div id="theme_content_navigator">
        <div class="content_leftarea">
            <header class="page-header">
                <h1 class="entry-title"><?php esc_html_e( '404 Not Found', 'cafeteria-lite' ); ?></h1>                
            </header><!-- .page-header -->
            <div class="page-content">
                <p><?php esc_html_e( 'Looks like you have taken a wrong turn....Dont worry... it happens to the best of us.', 'cafeteria-lite' ); ?></p>  
            </div><!-- .page-content -->
        </div><!-- content_leftarea-->   
        <?php get_sidebar();?>       
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>