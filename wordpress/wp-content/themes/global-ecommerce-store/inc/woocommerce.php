<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package global_ecommerce_store
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function global_ecommerce_store_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'global_ecommerce_store_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function global_ecommerce_store_woocommerce_scripts() {
	wp_enqueue_style( 'global-ecommerce-store-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = esc_url(WC()->plugin_url() . '/assets/fonts/');
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'global-ecommerce-store-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'global_ecommerce_store_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function global_ecommerce_store_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'global_ecommerce_store_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function global_ecommerce_store_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'global_ecommerce_store_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function global_ecommerce_store_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'global_ecommerce_store_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function global_ecommerce_store_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'global_ecommerce_store_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function global_ecommerce_store_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'global_ecommerce_store_woocommerce_related_products_args' );

if ( ! function_exists( 'global_ecommerce_store_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function global_ecommerce_store_woocommerce_product_columns_wrapper() {
		$columns = global_ecommerce_store_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'global_ecommerce_store_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'global_ecommerce_store_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function global_ecommerce_store_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'global_ecommerce_store_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'global_ecommerce_store_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function global_ecommerce_store_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'global_ecommerce_store_woocommerce_wrapper_before' );

if ( ! function_exists( 'global_ecommerce_store_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function global_ecommerce_store_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'global_ecommerce_store_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
 */

if ( ! function_exists( 'global_ecommerce_store_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function global_ecommerce_store_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		global_ecommerce_store_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'global_ecommerce_store_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'global_ecommerce_store_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function global_ecommerce_store_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'global-ecommerce-store' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'global-ecommerce-store' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'global_ecommerce_store_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function global_ecommerce_store_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php global_ecommerce_store_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}


/*top header*/
/**
 * Top header area
*/
if ( ! function_exists( 'global_ecommerce_store_top_header' ) ) {
	
	function global_ecommerce_store_top_header() { 
	   		$top_header_options = esc_attr( get_theme_mod( 'global_ecommerce_store_top_header_display_options','yes' ) );
	   		if($top_header_options =='yes'){ 
	   	?>
			<div class="ges-topright">
				<ul id="topright">
				    <?php
				        $whislist_options = intval( get_theme_mod( 'global_ecommerce_store_display_wishlist', 1 ) );
				        $account_options = intval( get_theme_mod('global_ecommerce_store_display_myaccount_login', 1 ) );
				        if( $whislist_options == 1 ){	   					            
				    ?>
				    <?php if(function_exists( 'global_ecommerce_store_products_wishlist' )) { ?>
				        <li>	   					        	
				            <?php global_ecommerce_store_products_wishlist(); ?>
				        </li>
				    <?php } }  
				    	if( $account_options == 1 ){ 
				      	if (is_user_logged_in()) { 
				    ?>
				        <li>
				        	<span class="icon-user"></span>
				        	<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><i class="fas fa-user-circle"></i></a>
				        </li>
				        <li>
				        	<span class="icon-logout"></span>
				        	<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><i class="fas fa-sign-out-alt"></i></a>
				        </li> 
				    <?php } else{ ?>
				        <li>
				        	<span class="icon-login"></span>
				        	<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php esc_html_e('Login','global-ecommerce-store'); ?></a>
				        </li>
				        <li>
				        	<span class="icon-user"></span>
				        	<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php esc_html_e('Register','global-ecommerce-store'); ?></a>
				        </li>
				    <?php } } ?>                 
				</ul>						
			</div><!-- Left section end -->	

	   	<?php } 
	}
}
add_action( 'global_ecommerce_store_header', 'global_ecommerce_store_top_header', 15 );



/*YITH*/




  /**
   * Wishlist Header Count Ajax Function
  **/
  if ( ! function_exists( 'global_ecommerce_store_products_wishlist' ) ) {
      function global_ecommerce_store_products_wishlist() {
        if ( function_exists( 'YITH_WCWL' ) ) { 
              $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>
              <div class="top-wishlist text-right">                
                <a href="<?php echo esc_url( $wishlist_url ); ?>" data-toggle="tooltip">
                  <div class="count-wishlist pull-left">
                    <div class="gescounter">
                        <i class="fas fa-heart"></i>
                        <div class="counter-wish">
                        	<?php echo " (" . intval(yith_wcwl_count_products()) . ") "; ?>
                        </div>
                      </div>
                  </div>
                </a>
              </div>
          <?php
          }
      }
  }
  add_action( 'wp_ajax_yith_wcwl_update_single_product_list', 'global_ecommerce_store_products_wishlist' );
  add_action( 'wp_ajax_nopriv_yith_wcwl_update_single_product_list', 'global_ecommerce_store_products_wishlist' );



if (!function_exists('global_ecommerce_store_product_searchbox')) {

    function global_ecommerce_store_product_searchbox($search_options = array())
    {
        
        ?>
    <div class="search-box">

        <?php

        if (class_exists('WooCommerce')) { 

            ?>

            <div class="product-search-wrapper">

                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <?php $placeholder = __( 'Search', 'global-ecommerce-store' ); ?>
                    <input type="text" class="search-field products-search"
                           placeholder="<?php echo esc_html($placeholder); ?>"
                           value="<?php echo get_search_query(); ?>" name="s"/>



                    <button type="submit" class="search-submit"><span
                                class="screen-reader-text"><?php echo esc_html_x('Search', 'submit button', 'global-ecommerce-store'); ?></span><i
                                class="fa fa-search" aria-hidden="true"></i></button>
                </form>


            </div> <!-- .product-search-wrapper -->
        <?php } ?>

        </div><?php
    }
}

function global_ecommerce_store_getWooCategories($isObject = true, $id=0, $isParents = 0, $itemPerPagenumber = -1, $orderby='name', $order='ASC', $hideEmpty = false){
    $categories = array();
    $args = array(
        'taxonomy' => 'product_cat',
        'orderby' => $orderby,
        'hide_empty' => $hideEmpty,
        'number'=> 0
    );

    if($isParents == 0 ){
        $args['parent'] = $isParents;
    }

    if(!empty($id) && $id >0 ){
        $args['term_taxonomy_id'] = $id;
    }
    $parent_terms = get_terms($args);

    foreach ($parent_terms as $pterm) {
        if($isObject === true){
            $categories[] = $pterm;
        }elseif(!empty($pterm->term_id)){
            $categories[$pterm->term_id] = $pterm->name;
   
        }
        
    }
    return $categories;
}    