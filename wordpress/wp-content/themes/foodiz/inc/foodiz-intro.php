<?php if (!function_exists('foodiz_info_page')) {
	function foodiz_info_page() {
	$page1=add_theme_page(__('Welcome to Foodiz', 'foodiz'), __('<span style="color:#ffe100">About Foodiz</span>', 'foodiz'), 'edit_theme_options', 'foodiz', 'foodiz_display_theme');
	
	add_action('admin_print_styles-'.$page1, 'foodiz_pro_info');
	}	
}
add_action('admin_menu', 'foodiz_info_page');

function foodiz_pro_info(){
	// CSS
	wp_enqueue_style('bootstrap',  get_template_directory_uri() .'/css/bootstrap.css');
	wp_enqueue_style('admin',  get_template_directory_uri() .'/css/admin-themes.css');
	wp_enqueue_style('font-awesome',  get_template_directory_uri() .'/css/font-awesome.min.css');
	//JS
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap-js',get_template_directory_uri() .'/js/bootstrap/bootstrap.js');

} 
if (!function_exists('foodiz_display_theme')) {
	function foodiz_display_theme() {
		$theme_data = wp_get_theme(); ?>
	<div class="wrap elw-page-welcome about-wrap seting-page">

	    <div class="row foodiz-pro">
	        <div class=" col-md-6">
	            <?php $wl_th_info = wp_get_theme(); ?>
					<h2><span class="foodiz-title"><?php esc_html_e('Foodiz - ','foodiz'); ?> <?php echo esc_html( $wl_th_info->get('Version') ); ?> </span></h2>						
				</p>
			</div>
			<div class=" col-md-6">
	            <p class="desc"><?php esc_html_e('Light and Easy to Customize WordPress Theme','foodiz'); ?></p>
			</div>
		</div> 
		
		<div class="container pl-0 pr-0">
			<div class="row intro-section">
				<div class="col-md-9 document pl-0">
				<section id="tabs">
				<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">

						<a class="nav-item nav-link active" id="nav-plugin-tab" data-toggle="tab" href="#nav-plugin" role="tab" aria-controls="nav-plugin" aria-selected="true"><?php esc_html_e('General Setting','foodiz'); ?></a>

						<a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><?php esc_html_e('Documentation','foodiz'); ?></a>
						<a class="nav-item nav-link" id="nav-support-tab" data-toggle="tab" href="#nav-support" role="tab" aria-controls="nav-support" aria-selected="true"><?php esc_html_e('Support Forum','foodiz'); ?></a>	
						
					</div>
				</nav>
				<div class="tab-content py-3 px-3" id="nav-tabContent">

					<!-- plugin -->
					<div class="tab-pane fade show active" id="nav-plugin" role="tabpanel" aria-labelledby="nav-plugin-tab">
						<div class="column-width-3">
							<h3><?php esc_html_e( 'Theme Demo Preview', 'foodiz' ); ?></h3>
							<p>
								
							</p>
							<a class="demo_btn" target="_blank" href="http://demo.mywebapp.in/foodiz/">Theme Demo Preview</a>

							<div class="Customize pt-4">
								<h3><?php esc_html_e( 'Theme Customizer', 'foodiz' ); ?></h3>
								<p> <?php esc_html_e( 'Theme Customizer Foodiz supports the Theme Customizer for all theme settings. Click "Customize" to personalize your site.','foodiz' ); ?> </p>
								<a class="demo_btn" href="<?php echo admin_url() .'customize.php'; ?>">Start Customizing</a>
							</div>
						</div>
					</div>

					<!-- documentation -->
					<div class="tab-pane fade show " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						<ol>
							<li> <?php esc_html_e('Create a New Page > Home','foodiz'); ?> </li>
							<li> <?php esc_html_e('Go to Appearance -> Customize > Homepage Settings -> select A static page option. Select Page which is created in last step','foodiz'); ?> </li>
							<li> <?php esc_html_e('Now Go to Customize -> Theme Settings -> Frontpage Template.','foodiz'); ?> </li>
							<li> <?php esc_html_e('Select Enable Frontpage template option','foodiz'); ?> </li>
							<li> <?php esc_html_e('Save changes','foodiz'); ?> </li>
						</ol>
						<a class="add_page" target="_blank" href="<?php echo admin_url('/post-new.php?post_type=page') ?>"><?php esc_html_e('Add New Page','foodiz'); ?></a>
					</div>

					<!-- support forum -->
					<div class="tab-pane fade show" id="nav-support" role="tabpanel" aria-labelledby="nav-support-tab">
						<div class="info-box1">
							<p class="support-text">
						 	<?php esc_html_e('You are absolutely free to contact us and Foodiz team will be happy to help you.','foodiz'); ?> </p>
							<p class="support-text1"> <?php esc_html_e('We resolve your issues ASAP.','foodiz'); ?></p>
							<p style="display: block;padding-top: 10px;"> <a class="support-btn" target="_blank" href="<?php echo esc_url('https://wordpress.org/support/theme/foodiz/'); ?>"><?php esc_html_e('Free Support','foodiz'); ?></a></p>
						</div>
					</div>

				</div>
				</section>	
			</div>
			<div class="col-md-3">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/foodiz-custom-homepage.png">
			</div>
		</div>
	</div>

	<div class="container pl-0 pr-0 mt-3">
		<div class="row">
			<div class="col-md-12 info-box">
				<div class="mywebapp-info">
					<h3><?php esc_html_e('Visit Our Latest Project','foodiz'); ?></h3>
					<p><?php esc_html_e('Our Aim is to be the most client-focused organisation, where we deliver extra importance to our client that gains their esteem and loyalty','foodiz'); ?></p>
					<a target="_blank" class="mywebapp-btn" href="<?php echo esc_url('http://mywebapp.in/'); ?>"><?php esc_html_e('Visit Our Site','foodiz'); ?></a>
				</div>		
			</div>
		</div>
	</div>
<?php
	}
}