<?php
/**
 * The template for displaying site footer
 *
 * @package sidebar
 */
?>
        <footer id="colophon" class="site-footer" role="contentinfo">
                
				<?php get_sidebar('footer'); ?>                                	
				
                <div class="site-info">
	                <div class="container">                
						<?php do_action ('sidebar_footer'); ?>                                
    	            </div>
                </div>
                
        </footer>
<?php wp_footer(); ?>
</body>
</html>
