<?php
/**
 * The template for displaying the footer
 *
 * @package Foodiz
 * @version 0.1
 */
?>
<!--  Footer Area Start  -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <hr>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <hr>
                <?php if (is_active_sidebar('footer_1')) : ?>
                <div id="sidebar-footer" class="sidebar">                    
                    <?php dynamic_sidebar('footer_1'); ?>
                </div>
            <?php endif; ?>
                
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <hr>
                <?php if (is_active_sidebar('footer_2')) : ?>
                <div id="sidebar-footer" class="sidebar">
                    <?php dynamic_sidebar('footer_2'); ?>
                </div>
				<?php endif; ?>
                
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <hr> 
                <?php if (is_active_sidebar('footer_3')) : ?>
                <div id="sidebar-footer" class="sidebar">
                    <?php dynamic_sidebar('footer_3'); ?>
                </div>
            <?php endif; ?>  
            </div>
            <!-- Footer Widget Area -->
        </div>
        <div class="row footer-copyright">
            <div class="col-12">
                <div class="copywrite-text">
                    <p>
					<?php 
					$footer_copyright = get_theme_mod( 'footer_copyright' );
					$footer_link = get_theme_mod( 'footer_link' );
					$footer_text = get_theme_mod( 'footer_text' );
                    echo esc_html( $footer_copyright ); ?>
					<a href="<?php echo esc_url( $footer_link ); ?>" target="_blank"><?php echo esc_html( $footer_text ); ?></a>
					</p>
                </div>
            </div>
        </div>
    </div>    
    <!-- scroll top icon -->
    <a href="#" id="scroll" class="move-top text-center scrollup" style="">
        <div class="circle"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
    </a>
</footer>
<?php get_template_part('google', 'font'); ?>
<?php wp_footer(); ?>
</body>
</html>