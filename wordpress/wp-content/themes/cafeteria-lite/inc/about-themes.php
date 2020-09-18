<?php
/**
 * Cafeteria Lite About Theme
 *
 * @package Cafeteria Lite
 */

//about theme info
add_action( 'admin_menu', 'cafeteria_lite_abouttheme' );
function cafeteria_lite_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'cafeteria-lite'), __('About Theme Info', 'cafeteria-lite'), 'edit_theme_options', 'cafeteria_lite_guide', 'cafeteria_lite_mostrar_guide');   
} 

//Info of the theme
function cafeteria_lite_mostrar_guide() { 	
?>
<div class="wrap-GT">
	<div class="gt-left">
   		   <div class="heading-gt">
			  <h3><?php esc_html_e('About Theme Info', 'cafeteria-lite'); ?></h3>
		   </div>
          <p><?php esc_html_e('Cafeteria Lite is a clean, robust, modern, minimalist and powerful theme for food and restaurant website. This food WordPress theme helps to create a professional and elegant websites of food related business. It is capable of handling the needs of food providers, suppliers and creates online presence of your website in unique style. This multi-functional theme is best suited for cafe, restaurants, pubs, fast foods, coffee shops, catering businesses and any other related businesses. Even if it is adaptable for different types of business, a food blog or recipes magazine looks like fit perfect with this theme.', 'cafeteria-lite'); ?></p>
<div class="heading-gt"> <?php esc_html_e('Theme Features', 'cafeteria-lite'); ?></div>
 

<div class="col-2">
  <h4><?php esc_html_e('Theme Customizer', 'cafeteria-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'cafeteria-lite'); ?></div>
</div>

<div class="col-2">
  <h4><?php esc_html_e('Responsive Ready', 'cafeteria-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'cafeteria-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('Cross Browser Compatible', 'cafeteria-lite'); ?></h4>
<div class="description"><?php esc_html_e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'cafeteria-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('E-commerce', 'cafeteria-lite'); ?></h4>
<div class="description"><?php esc_html_e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'cafeteria-lite'); ?></div>
</div>
<hr />  
</div><!-- .gt-left -->
	
<div class="gt-right">    
     <a href="http://www.gracethemesdemo.com/cafeteria/" target="_blank"><?php esc_html_e('Live Demo', 'cafeteria-lite'); ?></a> | 
     <a href="http://www.gracethemesdemo.com/documentation/cafeteria/#homepage-lite" target="_blank"><?php esc_html_e('Documentation', 'cafeteria-lite'); ?></a>    
</div><!-- .gt-right-->
<div class="clear"></div>
</div><!-- .wrap-GT -->
<?php } ?>