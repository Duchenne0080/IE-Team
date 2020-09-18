<?php
/**
 * The template for displaying 404 error pages
 *
 *
 * @package sidebar
 */
get_header(); ?>

<div id="content" class="site-content">
	<div class="container">
		<div class="row">

					<section class="error-404 not-found">
					
                    		<h1 class="page-title"><?php esc_html_e( '404', 'sidebar' ); ?></h1>
							<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'sidebar' ); ?></h2>
							<p><?php esc_html_e( 'Go back to the homepage.', 'sidebar' ); ?></p>
                            <a class="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Homepage', 'sidebar' ); ?></a>  
					</section><!-- .error-404 -->		    
        
    	</div><!-- .row -->
  </div><!-- .container -->
</div><!-- #content -->

        
<?php  get_footer(); ?>