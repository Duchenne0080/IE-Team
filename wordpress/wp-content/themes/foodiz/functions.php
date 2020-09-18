<?php
/**
 * Foodiz functions and code
 *
 * @package Foodiz
 * @version 0.1
*/
require(get_template_directory() . '/inc/class_nav_social_walker.php');

require(get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php');

// Customizer class
require(get_template_directory() . '/inc/class-foodiz-customizer.php');

if (is_admin()) {
    require_once('inc/foodiz-intro.php');
}

function foodiz_setup_theme() {

	global $content_width;

	if ( ! isset( $content_width ) ) {
		$content_width = 900;
	}
	
	register_nav_menus(
        array(
            'primary' => __('Header Menu Area, menu_depth is 4', 'foodiz'),
            'social' => __('Social Icon Menu Area', 'foodiz')
        )
    );
	
	/* image size */
	add_image_size( 'foodiz-blog-thumb', 540, 360, true );
	add_image_size( 'foodiz-about-thumb', 350, 233, true );

    /* woocommerce */
    add_theme_support( 'woocommerce' );
        
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
		
	$args = array(
		'default-text-color' => '#131230',
		'width'              => 1000,
		'height'             => 250,
		'flex-width'         => true,
		'flex-height'        => true,
	);
	add_theme_support( 'custom-logo', array() );

	$args = array(
		'default-text-color' => '#353535',
		'width'              => 1000,
		'height'             => 250,
		'flex-width'         => true,
		'flex-height'        => true,
	);
	add_theme_support( 'custom-header', $args );

	add_theme_support( "custom-background", $args );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'customize-selective-refresh-widgets' );

	add_editor_style();

	if ( is_singular() ) {
		wp_enqueue_script( "comment-reply" );
	}
	
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme','foodiz_setup_theme');

//Foodiz stylesheets & Scripts
function foodiz_styles_and_scripts()
{
    // Enqueue Stylesheets
    wp_enqueue_style('bootstrap-min', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.3');

    wp_enqueue_style('font-awesome-min', get_template_directory_uri() . '/css/font-awesome.min.css');

    wp_enqueue_style('owl-carousal-min', get_template_directory_uri() . '/css/owl.carousel.min.css');

    wp_enqueue_style('foodiz-style', get_stylesheet_uri());

    //Enqueue Scripts
    wp_enqueue_script( 'jquery' );

    wp_enqueue_script('bootstrap-min-js', get_template_directory_uri() . '/js/bootstrap/bootstrap.min.js');

    wp_enqueue_script('owl-carousel-min-js', get_template_directory_uri() . '/js/owl.carousel.min.js');

    wp_enqueue_script('foodiz-js', get_template_directory_uri() . '/js/foodiz.js');

    wp_enqueue_script('foodiz-script-js', get_template_directory_uri() . '/js/foodiz-script.js');

    wp_enqueue_script( 'foodiz-footer-script', get_template_directory_uri() . '/js/foodiz-footer-script.js','','','true' );


    /* web font */
        $font_var          = '300,400,600,700,900,300italic,400italic,600italic,700italic,900italic';
        $http              = ( ! empty( $_SERVER['HTTPS'] ) ) ? "https" : "http";
        $main_heading_font1 = get_theme_mod('main_heading_font','Playfair Display');
        $main_heading_font = str_replace( ' ' , '+', $main_heading_font1 );
        $menu_font1 = get_theme_mod('menu_font', 'Playfair Display');
        $menu_font         = str_replace( ' ' , '+', $menu_font1 );
        $theme_title1 = get_theme_mod('theme_title', 'Playfair Display');
        $theme_title       = str_replace( ' ' , '+', $theme_title1 );
        $desc_font_all1 = get_theme_mod('desc_font_all', 'Playfair Display');
        $desc_font_all     = str_replace( ' ' , '+', $desc_font_all1 );
        
        wp_enqueue_style('googleFonts', $http . '://fonts.googleapis.com/css?family=' . $main_heading_font . ':' . $font_var);  
        wp_enqueue_style('menu_font', $http . '://fonts.googleapis.com/css?family=' . $menu_font . ':' . $font_var);    
        wp_enqueue_style('theme_title', $http . '://fonts.googleapis.com/css?family=' . $theme_title . ':' . $font_var);
        wp_enqueue_style('desc_font_all', $http . '://fonts.googleapis.com/css?family=' . $desc_font_all . ':' . $font_var);


}
add_action('wp_enqueue_scripts', 'foodiz_styles_and_scripts');


//Foodiz Sidebar
function foodiz_register_sidebars()
{
    /* Register the 'primary' sidebar. */
    register_sidebar(
        array(
            'id' => 'primary',
            'name' => __('Sidebar Widget Area', 'foodiz'),
            'description' => __('A short description of the sidebar.', 'foodiz'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );

    register_sidebar(
        array(
            'id' => 'footer_1',
            'name' => __('Footer Widget Area 1', 'foodiz'),
            'description' => __('Add max four Widgets here', 'foodiz'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );

    register_sidebar(
        array(
            'id' => 'footer_2',
            'name' => __('Footer Widget Area 2', 'foodiz'),
            'description' => __('Add max four Widgets here', 'foodiz'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );

    register_sidebar(
        array(
            'id' => 'footer_3',
            'name' => __('Footer Widget Area 3', 'foodiz'),
            'description' => __('Add max four Widgets here', 'foodiz'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action('widgets_init', 'foodiz_register_sidebars');

/* comment code */
function foodiz_comment($comment, $args, $depth)
{?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard">
		
			<div class="thumb">
           <?php echo get_avatar($comment, $size = '64'); ?>
		   </div>
		   
		   <div class="comment-content">
           <span class="fn"><?php comment_author(); ?> </span>
		   <ul class="my-2 reply-date">
                <li class="font-weight-bold"><?php comment_date(); ?>
					<?php esc_html_e( 'at', 'foodiz' ); ?>&nbsp;<?php comment_time( 'g:i a' ); ?></li>
            </ul>
           <p class="comment_text"><?php comment_text(); ?></p>
		   <div class="reply">
            <?php comment_reply_link(array_merge($args, array('depth' => $depth,
                'max_depth' => $args['max_depth']))); ?>
        </div>
		   </div>
        </div>

        <?php if ($comment->comment_approved == '0') : ?>
            <em><?php esc_html_e('Your comment is awaiting moderation.','foodiz'); ?></em>
        <?php endif; ?>

        
    </div>
    <?php
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'foodiz_My_Dropdown_Category_Control' ) ) :
class foodiz_My_Dropdown_Category_Control extends WP_Customize_Control
{
    public function render_content(){ ?>
		<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
		<?php  $enigma_category = get_categories(); ?>
		<select <?php $this->link(); ?> >
			<?php foreach($enigma_category as $category){ ?>
				<option value= "<?php echo esc_attr($category->term_id); ?>" <?php if($this->value()=='') echo 'selected="selected"';?> ><?php echo esc_html($category->cat_name); ?></option>
			<?php } ?>
		</select> <?php
	}  /* public function ends */
}/*   class ends */
endif;

/* pagination link for index, author, category, tag pages */
function foodiz_navigation() { ?>
    <div class="navigation">
		<?php posts_nav_link(); ?>
    </div>
	<?php
}
add_action( 'foodiz_pagination', 'foodiz_navigation' );

/* single post navigation */
function foodiz_post_navigation() { ?>
    <div class="navigation">
        <div class="single_left alignleft">
			<?php previous_post_link(); ?>
        </div>
        <div class="single_right alignright">
			<?php next_post_link(); ?>
        </div>
    </div>
	<?php
}
add_action( 'foodiz_single_blog_navigation', 'foodiz_post_navigation' );

/* wp_body_open function check */
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function foodiz_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'foodiz_skip_link_focus_fix' );

/**
 * display notice
 **/
global $pagenow;
if ( $pagenow == 'themes.php' && is_admin() ) {
    if ( get_option( 'foodiz_notice_dismiss_notice' ) != true ) {
        add_action( 'admin_notices', 'foodiz_activation_notice' );
        add_action( 'admin_enqueue_scripts', 'foodiz_notice_script' );
    }
}

function foodiz_activation_notice(){
$my_theme = wp_get_theme(); 
?>
<style>
    .foodiz-notice {
    padding: 12px 0 25px 0;
    text-align: center;
}
</style>
   <div class="notice notice-success my-dismiss-notice is-dismissible foodiz-notice">
        <h3> <?php _e('Thank you for installing', 'foodiz'); ?> <?php echo $my_theme->get( 'Name' ); ?>
        <?php echo esc_html_e('Version - ','foodiz'); ?>
        <?php echo esc_html( $my_theme->get('Version') ); ?>
        </h3>
                
        <p style="margin: 1em 0;"><?php _e(' Are you are enjoying Foodiz? We would love to hear your feedback. Big thanks in advance.','foodiz'); ?> 
        </p>

        <a style="text-decoration: none;padding: 5px 10px;background: #ffb606;color: #fff;" target="_blank" href="https://wordpress.org/support/theme/foodiz/reviews/#new-post"> <?php _e('Submit a review','foodiz'); ?> </a>
                
        <a style="margin-left: 18px;text-decoration: none;padding: 5px 10px;background: #ffb606;color: #fff;" target="_blank" href="https://wordpress.org/support/theme/foodiz/" > <?php _e('Any help?','foodiz'); ?> </a>

        <a style="margin-left: 18px;text-decoration: none;padding: 5px 10px;background: #ffb606;color: #fff;" target="_blank" href="<?php echo admin_url('/themes.php?page=foodiz'); ?>" > <?php _e('Welcome Page & View Demo','foodiz'); ?> </a>
                
        <button type="button" class="notice-dismiss">
            <span class="screen-reader-text">Dismiss this notice.</span>
        </button>
    </div>
<?php } 

add_action( 'admin_enqueue_scripts', 'foodiz_notice_script' );
function foodiz_notice_script() {
    wp_register_script( 'notice-update', get_template_directory_uri() . '/js/update-notice.js' );
   wp_localize_script( 'notice-update', 'notice_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ) );
    wp_enqueue_script( 'notice-update' );
}

add_action( 'wp_ajax_foodiz_dismiss_notice', 'foodiz_notice_dismiss_notice' );
function foodiz_notice_dismiss_notice() {
    update_option( 'foodiz_notice_dismiss_notice', true );
}

/* class for font-family */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'foodiz_Font_Control' ) ) :
class foodiz_Font_Control extends WP_Customize_Control 
{  
 public function render_content() 
 {?>
   <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
  <?php  $google_api_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCEf2B8_jirXe78wunEHiuyYV0Jrqcw16g';
            //lets fetch it
            $response = wp_remote_retrieve_body( wp_remote_get($google_api_url, array('sslverify' => false )));
            if($response==''){ echo '<script>jQuery(document).ready(function() {alert("Something went wrong! this works only when you are connected to Internet....!!");});</script>'; }
            if( is_wp_error( $response ) ) {
               echo 'Something went wrong!';
            } else {
            $json_fonts = json_decode($response,  true);
            // that's it
            $items = $json_fonts['items'];
            $i = 0; ?>
   <select <?php $this->link(); ?> >
   <?php foreach( $items as $item) { $i++; $str = $item['family']; ?>
    <option  value="<?php echo esc_attr($str); ?>" <?php if($this->value()== $str) echo 'selected="selected"';?>><?php echo esc_html($str); ?></option>
   <?php } ?>
    </select>
    <?php 
 }
}
}
endif;