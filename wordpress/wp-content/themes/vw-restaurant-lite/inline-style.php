<?php
	
	/*---------------First highlight color---------------*/

	$vw_restaurant_lite_first_color = get_theme_mod('vw_restaurant_lite_first_color');

	$vw_restaurant_lite_custom_css = '';

	if($vw_restaurant_lite_first_color != false){
		$vw_restaurant_lite_custom_css .='.scrollup i,.topheader, .slider .carousel-control-prev-icon i, .slider .carousel-control-next-icon i, .hvr-sweep-to-right:before, .footer input[type="submit"], .copyright, .sidebar input[type="submit"], .pagination .current, .pagination a:hover, .comments input[type="submit"].submit, nav.woocommerce-MyAccount-navigation ul li, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce span.onsale, .footer .custom-social-icons i, .sidebar .tagcloud a:hover, .footer .tagcloud a:hover, input[type="submit"], .sidebar .custom-social-icons i, .comments a.comment-reply-link, .toggle-nav i, .footer input[type="submit"]:hover, .sidebar a.custom_read_more, .footer a.custom_read_more, .wpcf7 form input[type="submit"], .nav-previous a:hover, .nav-next a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover{';
			$vw_restaurant_lite_custom_css .='background-color: '.esc_html($vw_restaurant_lite_first_color).';';
		$vw_restaurant_lite_custom_css .='}';
	}
	if($vw_restaurant_lite_first_color != false){
		$vw_restaurant_lite_custom_css .='a, .main-navigation a:hover, .slider .more-btn a.button, .footer h3, .services .section-title a, .sidebar ul li a:hover, .header .logo a, .woocommerce-message::before, .main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, .comments input[type="submit"].submit:hover, .main-navigation ul.sub-menu a:hover, .sidebar a.custom_read_more:hover, .sidebar .custom-social-icons i:hover, .single-post .nav-previous a:hover, .single-post .nav-next a:hover{';
			$vw_restaurant_lite_custom_css .='color: '.esc_html($vw_restaurant_lite_first_color).';';
		$vw_restaurant_lite_custom_css .='}';
	}
	if($vw_restaurant_lite_first_color != false){
		$vw_restaurant_lite_custom_css .='.slider .more-btn a.button, .woocommerce-message{';
			$vw_restaurant_lite_custom_css .='border-color: '.esc_html($vw_restaurant_lite_first_color).';';
		$vw_restaurant_lite_custom_css .='}';
	}
	if($vw_restaurant_lite_first_color != false){
		$vw_restaurant_lite_custom_css .='.main-navigation ul ul{';
			$vw_restaurant_lite_custom_css .='border-top-color: '.esc_html($vw_restaurant_lite_first_color).';';
		$vw_restaurant_lite_custom_css .='}';
	}
	if($vw_restaurant_lite_first_color != false){
		$vw_restaurant_lite_custom_css .='.header, .footer h3, .main-navigation ul ul{';
			$vw_restaurant_lite_custom_css .='border-bottom-color: '.esc_html($vw_restaurant_lite_first_color).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	/*---------------------------Width Layout -------------------*/

	$vw_restaurant_lite_theme_lay = get_theme_mod( 'vw_restaurant_lite_width_option','Full Width');
    if($vw_restaurant_lite_theme_lay == 'Boxed'){
		$vw_restaurant_lite_custom_css .='body{';
			$vw_restaurant_lite_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_restaurant_lite_custom_css .='}';
	}else if($vw_restaurant_lite_theme_lay == 'Wide Width'){
		$vw_restaurant_lite_custom_css .='body{';
			$vw_restaurant_lite_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_restaurant_lite_custom_css .='}';
	}else if($vw_restaurant_lite_theme_lay == 'Full Width'){
		$vw_restaurant_lite_custom_css .='body{';
			$vw_restaurant_lite_custom_css .='max-width: 100%;';
		$vw_restaurant_lite_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$vw_restaurant_lite_theme_lay = get_theme_mod( 'vw_restaurant_lite_slider_opacity_color','0.5');
	if($vw_restaurant_lite_theme_lay == '0'){
		$vw_restaurant_lite_custom_css .='.slider img{';
			$vw_restaurant_lite_custom_css .='opacity:0';
		$vw_restaurant_lite_custom_css .='}';
		}else if($vw_restaurant_lite_theme_lay == '0.1'){
		$vw_restaurant_lite_custom_css .='.slider img{';
			$vw_restaurant_lite_custom_css .='opacity:0.1';
		$vw_restaurant_lite_custom_css .='}';
		}else if($vw_restaurant_lite_theme_lay == '0.2'){
		$vw_restaurant_lite_custom_css .='.slider img{';
			$vw_restaurant_lite_custom_css .='opacity:0.2';
		$vw_restaurant_lite_custom_css .='}';
		}else if($vw_restaurant_lite_theme_lay == '0.3'){
		$vw_restaurant_lite_custom_css .='.slider img{';
			$vw_restaurant_lite_custom_css .='opacity:0.3';
		$vw_restaurant_lite_custom_css .='}';
		}else if($vw_restaurant_lite_theme_lay == '0.4'){
		$vw_restaurant_lite_custom_css .='.slider img{';
			$vw_restaurant_lite_custom_css .='opacity:0.4';
		$vw_restaurant_lite_custom_css .='}';
		}else if($vw_restaurant_lite_theme_lay == '0.5'){
		$vw_restaurant_lite_custom_css .='.slider img{';
			$vw_restaurant_lite_custom_css .='opacity:0.5';
		$vw_restaurant_lite_custom_css .='}';
		}else if($vw_restaurant_lite_theme_lay == '0.6'){
		$vw_restaurant_lite_custom_css .='.slider img{';
			$vw_restaurant_lite_custom_css .='opacity:0.6';
		$vw_restaurant_lite_custom_css .='}';
		}else if($vw_restaurant_lite_theme_lay == '0.7'){
		$vw_restaurant_lite_custom_css .='.slider img{';
			$vw_restaurant_lite_custom_css .='opacity:0.7';
		$vw_restaurant_lite_custom_css .='}';
		}else if($vw_restaurant_lite_theme_lay == '0.8'){
		$vw_restaurant_lite_custom_css .='.slider img{';
			$vw_restaurant_lite_custom_css .='opacity:0.8';
		$vw_restaurant_lite_custom_css .='}';
		}else if($vw_restaurant_lite_theme_lay == '0.9'){
		$vw_restaurant_lite_custom_css .='.slider img{';
			$vw_restaurant_lite_custom_css .='opacity:0.9';
		$vw_restaurant_lite_custom_css .='}';
		}

	/*---------------------------Slider Content Layout -------------------*/

	$vw_restaurant_lite_theme_lay = get_theme_mod( 'vw_restaurant_lite_slider_content_option','Center');
    if($vw_restaurant_lite_theme_lay == 'Left'){
		$vw_restaurant_lite_custom_css .='.slider .carousel-caption, .slider .inner_carousel{';
			$vw_restaurant_lite_custom_css .='text-align:left; left:15%; right:45%;';
		$vw_restaurant_lite_custom_css .='}';
	}else if($vw_restaurant_lite_theme_lay == 'Center'){
		$vw_restaurant_lite_custom_css .='.slider .carousel-caption, .slider .inner_carousel{';
			$vw_restaurant_lite_custom_css .='text-align:center; left:20%; right:20%;';
		$vw_restaurant_lite_custom_css .='}';
	}else if($vw_restaurant_lite_theme_lay == 'Right'){
		$vw_restaurant_lite_custom_css .='.slider .carousel-caption, .slider .inner_carousel{';
			$vw_restaurant_lite_custom_css .='text-align:right; left:45%; right:15%;';
		$vw_restaurant_lite_custom_css .='}';
	}

	/*---------------------------Slider Height ------------*/

	$vw_restaurant_lite_slider_height = get_theme_mod('vw_restaurant_lite_slider_height');
	if($vw_restaurant_lite_slider_height != false){
		$vw_restaurant_lite_custom_css .='.slider img{';
			$vw_restaurant_lite_custom_css .='height: '.esc_html($vw_restaurant_lite_slider_height).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_restaurant_lite_theme_lay = get_theme_mod( 'vw_restaurant_lite_blog_layout_option','Default');
    if($vw_restaurant_lite_theme_lay == 'Default'){
		$vw_restaurant_lite_custom_css .='.services-box{';
			$vw_restaurant_lite_custom_css .='';
		$vw_restaurant_lite_custom_css .='}';
		$vw_restaurant_lite_custom_css .='.services h2.section-title{';
			$vw_restaurant_lite_custom_css .='text-align:Left;';
		$vw_restaurant_lite_custom_css .='}';
	}else if($vw_restaurant_lite_theme_lay == 'Center'){
		$vw_restaurant_lite_custom_css .='.services-box, .services-text, .services-box h2, .services-box p, .services-box .read-btn, .services-box .post-info, .date-box, .cat-box{';
			$vw_restaurant_lite_custom_css .='text-align:center;';
		$vw_restaurant_lite_custom_css .='}';
		$vw_restaurant_lite_custom_css .='.post-info{';
			$vw_restaurant_lite_custom_css .='margin-top: 10px;';
		$vw_restaurant_lite_custom_css .='}';
	}else if($vw_restaurant_lite_theme_lay == 'Left'){
		$vw_restaurant_lite_custom_css .='.services-box, .services-box h2, .services-box p, .services h2.section-title{';
			$vw_restaurant_lite_custom_css .='text-align:Left;';
		$vw_restaurant_lite_custom_css .='}';
		$vw_restaurant_lite_custom_css .='.post-info{';
			$vw_restaurant_lite_custom_css .='margin-top: 10px;';
		$vw_restaurant_lite_custom_css .='}';
	}

	/*------------------------------Responsive Media -----------------------*/

	$vw_restaurant_lite_resp_topbar = get_theme_mod( 'vw_restaurant_lite_resp_topbar_hide_show',false);
    if($vw_restaurant_lite_resp_topbar == true){
    	$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.topheader{';
			$vw_restaurant_lite_custom_css .='display:block;';
		$vw_restaurant_lite_custom_css .='} }';
	}else if($vw_restaurant_lite_resp_topbar == false){
		$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.topheader{';
			$vw_restaurant_lite_custom_css .='display:none;';
		$vw_restaurant_lite_custom_css .='} }';
	}

	$vw_restaurant_lite_resp_stickyheader = get_theme_mod( 'vw_restaurant_lite_stickyheader_hide_show',false);
    if($vw_restaurant_lite_resp_stickyheader == true){
    	$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.header-fixed{';
			$vw_restaurant_lite_custom_css .='display:block;';
		$vw_restaurant_lite_custom_css .='} }';
	}else if($vw_restaurant_lite_resp_stickyheader == false){
		$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.header-fixed{';
			$vw_restaurant_lite_custom_css .='display:none;';
		$vw_restaurant_lite_custom_css .='} }';
	}

	$vw_restaurant_lite_resp_slider = get_theme_mod( 'vw_restaurant_lite_resp_slider_hide_show',false);
    if($vw_restaurant_lite_resp_slider == true){
    	$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.slider{';
			$vw_restaurant_lite_custom_css .='display:block;';
		$vw_restaurant_lite_custom_css .='} }';
	}else if($vw_restaurant_lite_resp_slider == false){
		$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.slider{';
			$vw_restaurant_lite_custom_css .='display:none;';
		$vw_restaurant_lite_custom_css .='} }';
	}

	$vw_restaurant_lite_resp_metabox = get_theme_mod( 'vw_restaurant_lite_metabox_hide_show',true);
    if($vw_restaurant_lite_resp_metabox == true){
    	$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.date-box{';
			$vw_restaurant_lite_custom_css .='display:block;';
		$vw_restaurant_lite_custom_css .='} }';
	}else if($vw_restaurant_lite_resp_metabox == false){
		$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.date-box{';
			$vw_restaurant_lite_custom_css .='display:none;';
		$vw_restaurant_lite_custom_css .='} }';
	}

	$vw_restaurant_lite_resp_sidebar = get_theme_mod( 'vw_restaurant_lite_sidebar_hide_show',true);
    if($vw_restaurant_lite_resp_sidebar == true){
    	$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.sidebar{';
			$vw_restaurant_lite_custom_css .='display:block;';
		$vw_restaurant_lite_custom_css .='} }';
	}else if($vw_restaurant_lite_resp_sidebar == false){
		$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.sidebar{';
			$vw_restaurant_lite_custom_css .='display:none;';
		$vw_restaurant_lite_custom_css .='} }';
	}

	$vw_restaurant_lite_resp_scroll_top = get_theme_mod( 'vw_restaurant_lite_resp_scroll_top_hide_show',true);
    if($vw_restaurant_lite_resp_scroll_top == true){
    	$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.scrollup i{';
			$vw_restaurant_lite_custom_css .='display:block;';
		$vw_restaurant_lite_custom_css .='} }';
	}else if($vw_restaurant_lite_resp_scroll_top == false){
		$vw_restaurant_lite_custom_css .='@media screen and (max-width:575px) {';
		$vw_restaurant_lite_custom_css .='.scrollup i{';
			$vw_restaurant_lite_custom_css .='display:none !important;';
		$vw_restaurant_lite_custom_css .='} }';
	}

	/*------------- Top Bar Settings ------------------*/

	$vw_restaurant_lite_topbar_padding_top_bottom = get_theme_mod('vw_restaurant_lite_topbar_padding_top_bottom');
	if($vw_restaurant_lite_topbar_padding_top_bottom != false){
		$vw_restaurant_lite_custom_css .='.topheader{';
			$vw_restaurant_lite_custom_css .='padding-top: '.esc_html($vw_restaurant_lite_topbar_padding_top_bottom).'; padding-bottom: '.esc_html($vw_restaurant_lite_topbar_padding_top_bottom).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	/*-------------- Sticky Header Padding ----------------*/

	$vw_restaurant_lite_sticky_header_padding = get_theme_mod('vw_restaurant_lite_sticky_header_padding');
	if($vw_restaurant_lite_sticky_header_padding != false){
		$vw_restaurant_lite_custom_css .='.header-fixed{';
			$vw_restaurant_lite_custom_css .='padding: '.esc_html($vw_restaurant_lite_sticky_header_padding).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	/*------------- Single Blog Page------------------*/

	$vw_restaurant_lite_single_blog_post_navigation_show_hide = get_theme_mod('vw_restaurant_lite_single_blog_post_navigation_show_hide',true);
	if($vw_restaurant_lite_single_blog_post_navigation_show_hide != true){
		$vw_restaurant_lite_custom_css .='.post-navigation{';
			$vw_restaurant_lite_custom_css .='display: none;';
		$vw_restaurant_lite_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_restaurant_lite_copyright_alingment = get_theme_mod('vw_restaurant_lite_copyright_alingment');
	if($vw_restaurant_lite_copyright_alingment != false){
		$vw_restaurant_lite_custom_css .='.copyright p{';
			$vw_restaurant_lite_custom_css .='text-align: '.esc_html($vw_restaurant_lite_copyright_alingment).';';
		$vw_restaurant_lite_custom_css .='}';
	}
	$vw_restaurant_lite_copyright_padding_top_bottom = get_theme_mod('vw_restaurant_lite_copyright_padding_top_bottom');
	if($vw_restaurant_lite_copyright_padding_top_bottom != false){
		$vw_restaurant_lite_custom_css .='.copyright{';
			$vw_restaurant_lite_custom_css .='padding-top: '.esc_html($vw_restaurant_lite_copyright_padding_top_bottom).'; padding-bottom: '.esc_html($vw_restaurant_lite_copyright_padding_top_bottom).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	/*----------------Sroll to top Settings ------------------*/

	$vw_restaurant_lite_scroll_to_top_font_size = get_theme_mod('vw_restaurant_lite_scroll_to_top_font_size');
	if($vw_restaurant_lite_scroll_to_top_font_size != false){
		$vw_restaurant_lite_custom_css .='.scrollup i{';
			$vw_restaurant_lite_custom_css .='font-size: '.esc_html($vw_restaurant_lite_scroll_to_top_font_size).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	$vw_restaurant_lite_scroll_to_top_padding = get_theme_mod('vw_restaurant_lite_scroll_to_top_padding');
	$vw_restaurant_lite_scroll_to_top_padding = get_theme_mod('vw_restaurant_lite_scroll_to_top_padding');
	if($vw_restaurant_lite_scroll_to_top_padding != false){
		$vw_restaurant_lite_custom_css .='.scrollup i{';
			$vw_restaurant_lite_custom_css .='padding-top: '.esc_html($vw_restaurant_lite_scroll_to_top_padding).';padding-bottom: '.esc_html($vw_restaurant_lite_scroll_to_top_padding).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	$vw_restaurant_lite_scroll_to_top_width = get_theme_mod('vw_restaurant_lite_scroll_to_top_width');
	if($vw_restaurant_lite_scroll_to_top_width != false){
		$vw_restaurant_lite_custom_css .='.scrollup i{';
			$vw_restaurant_lite_custom_css .='width: '.esc_html($vw_restaurant_lite_scroll_to_top_width).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	$vw_restaurant_lite_scroll_to_top_height = get_theme_mod('vw_restaurant_lite_scroll_to_top_height');
	if($vw_restaurant_lite_scroll_to_top_height != false){
		$vw_restaurant_lite_custom_css .='.scrollup i{';
			$vw_restaurant_lite_custom_css .='height: '.esc_html($vw_restaurant_lite_scroll_to_top_height).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	$vw_restaurant_lite_scroll_to_top_border_radius = get_theme_mod('vw_restaurant_lite_scroll_to_top_border_radius');
	if($vw_restaurant_lite_scroll_to_top_border_radius != false){
		$vw_restaurant_lite_custom_css .='.scrollup i{';
			$vw_restaurant_lite_custom_css .='border-radius: '.esc_html($vw_restaurant_lite_scroll_to_top_border_radius).'px;';
		$vw_restaurant_lite_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$vw_restaurant_lite_social_icon_font_size = get_theme_mod('vw_restaurant_lite_social_icon_font_size');
	if($vw_restaurant_lite_social_icon_font_size != false){
		$vw_restaurant_lite_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i, .custom-social-icons i{';
			$vw_restaurant_lite_custom_css .='font-size: '.esc_html($vw_restaurant_lite_social_icon_font_size).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	$vw_restaurant_lite_social_icon_padding = get_theme_mod('vw_restaurant_lite_social_icon_padding');
	if($vw_restaurant_lite_social_icon_padding != false){
		$vw_restaurant_lite_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_restaurant_lite_custom_css .='padding: '.esc_html($vw_restaurant_lite_social_icon_padding).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	$vw_restaurant_lite_social_icon_width = get_theme_mod('vw_restaurant_lite_social_icon_width');
	if($vw_restaurant_lite_social_icon_width != false){
		$vw_restaurant_lite_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_restaurant_lite_custom_css .='width: '.esc_html($vw_restaurant_lite_social_icon_width).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	$vw_restaurant_lite_social_icon_height = get_theme_mod('vw_restaurant_lite_social_icon_height');
	if($vw_restaurant_lite_social_icon_height != false){
		$vw_restaurant_lite_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_restaurant_lite_custom_css .='height: '.esc_html($vw_restaurant_lite_social_icon_height).';';
		$vw_restaurant_lite_custom_css .='}';
	}

	$vw_restaurant_lite_social_icon_border_radius = get_theme_mod('vw_restaurant_lite_social_icon_border_radius');
	if($vw_restaurant_lite_social_icon_border_radius != false){
		$vw_restaurant_lite_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_restaurant_lite_custom_css .='border-radius: '.esc_html($vw_restaurant_lite_social_icon_border_radius).'px;';
		$vw_restaurant_lite_custom_css .='}';
	}

	/*----------------Woocommerce Products Settings ------------------*/

	$vw_restaurant_lite_products_padding_top_bottom = get_theme_mod('vw_restaurant_lite_products_padding_top_bottom');
	if($vw_restaurant_lite_products_padding_top_bottom != false){
		$vw_restaurant_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_restaurant_lite_custom_css .='padding-top: '.esc_html($vw_restaurant_lite_products_padding_top_bottom).'!important; padding-bottom: '.esc_html($vw_restaurant_lite_products_padding_top_bottom).'!important;';
		$vw_restaurant_lite_custom_css .='}';
	}

	$vw_restaurant_lite_products_padding_left_right = get_theme_mod('vw_restaurant_lite_products_padding_left_right');
	if($vw_restaurant_lite_products_padding_left_right != false){
		$vw_restaurant_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_restaurant_lite_custom_css .='padding-left: '.esc_html($vw_restaurant_lite_products_padding_left_right).'!important; padding-right: '.esc_html($vw_restaurant_lite_products_padding_left_right).'!important;';
		$vw_restaurant_lite_custom_css .='}';
	}

	$vw_restaurant_lite_products_box_shadow = get_theme_mod('vw_restaurant_lite_products_box_shadow');
	if($vw_restaurant_lite_products_box_shadow != false){
		$vw_restaurant_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
				$vw_restaurant_lite_custom_css .='box-shadow: '.esc_html($vw_restaurant_lite_products_box_shadow).'px '.esc_html($vw_restaurant_lite_products_box_shadow).'px '.esc_html($vw_restaurant_lite_products_box_shadow).'px #ddd;';
		$vw_restaurant_lite_custom_css .='}';
	}

	$vw_restaurant_lite_products_border_radius = get_theme_mod('vw_restaurant_lite_products_border_radius');
	if($vw_restaurant_lite_products_border_radius != false){
		$vw_restaurant_lite_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_restaurant_lite_custom_css .='border-radius: '.esc_html($vw_restaurant_lite_products_border_radius).'px;';
		$vw_restaurant_lite_custom_css .='}';
	}