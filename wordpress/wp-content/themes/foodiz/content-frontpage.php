<?php
if ( get_theme_mod('foodiz_slider_show') == 1 ):
	get_template_part('home', 'slider');
endif;
if ( get_theme_mod('foodiz_category_show') == 1 ):
	get_template_part('home', 'category');
endif;
	
if ( get_theme_mod('foodiz_about_show') == 1 ):
	get_template_part('home', 'about');
endif;
	
if ( get_theme_mod('foodiz_parallex_section_show_1') == 1 ):
	get_template_part('home', 'callout');
endif;
		
get_template_part('home', 'blog');