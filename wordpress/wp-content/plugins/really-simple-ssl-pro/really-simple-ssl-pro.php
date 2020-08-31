<?php
/**
 * Plugin Name: Really Simple SSL pro
 * Plugin URI: https://www.really-simple-ssl.com/pro
 * Description: Add on for Really Simple SSL
 * Version: 2.1.22
 * Text Domain: really-simple-ssl-pro
 * Domain Path: /languages
 * Author: Really Simple Plugins
 * Author URI: https://www.really-simple-plugins.com
 */

/*  Copyright 2014  Rogier Lankhorst  (email : rogier@rogierlankhorst.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined('ABSPATH') or die("you do not have access to this page!");

register_activation_hook(__FILE__ ,'enable_security_header_options');

class REALLY_SIMPLE_SSL_PRO {

    private static $instance;
    public $rssl_front_end;
    public $rssl_mixed_content_fixer;
    public $rsssl_cache;
    public $rsssl_server;
    public $really_simple_ssl;
    public $rsssl_help;
    public $rsssl_support;
    public $rsssl_licensing;
    public $rsssl_csp_endpoint;

    private function __construct() {}

    public static function instance() {
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof REALLY_SIMPLE_SSL_PRO ) ) {
            self::$instance = new REALLY_SIMPLE_SSL_PRO;
            if (self::$instance->is_compatible()) {

                self::$instance->setup_constants();
                self::$instance->includes();

                if (is_admin()) {
	                self::$instance->rsssl_premium_options = new rsssl_premium_options();
	                self::$instance->rsssl_scan            = new rsssl_scan();
	                self::$instance->rsssl_licensing       = new rsssl_licensing();
	                self::$instance->rsssl_importer        = new rsssl_importer();

	                //Only instance support when PHP version is higher then 5.6, anonymous function may break site if lower version is used.
	                if ( version_compare( phpversion(), '5.6', '>=' ) ) {
		                self::$instance->rsssl_support = new rsssl_support();
	                }
	                //  self::$instance->rsssl_pro_multisite = new rsssl_pro_multisite();

	                // Backwards compatibility for add-ons
	                global $rsssl_licensing;
	                $rsssl_licensing = self::$instance->rsssl_licensing;
                }
                self::$instance->hooks();
            } else {
                add_action('admin_notices', array('REALLY_SIMPLE_SSL_PRO', 'admin_notices'));
                //deactivate_plugins( plugin_basename( __FILE__ ) );
            }

        }

        return self::$instance;
    }

    /*
       Checks if one of the necessary plugins is active, and of the required version.
    */

    private function is_compatible(){
        require_once(ABSPATH.'wp-admin/includes/plugin.php');
        $core_plugin = 'really-simple-ssl/rlrsssl-really-simple-ssl.php';
        if ( is_plugin_active($core_plugin)) $core_plugin_data = get_plugin_data( WP_PLUGIN_DIR .'/'. $core_plugin, false, false );
        if ( is_plugin_active($core_plugin) && version_compare($core_plugin_data['Version'] ,'2.5.11','>') ) {
            return true;
        }

        $per_page_plugin = 'really-simple-ssl-on-specific-pages/really-simple-ssl-on-specific-pages.php';
        if (is_plugin_active($per_page_plugin)) $per_page_plugin_data = get_plugin_data( WP_PLUGIN_DIR .'/'. $per_page_plugin, false, false );
        if (is_plugin_active($per_page_plugin) && version_compare($per_page_plugin_data['Version'] , '1.0.6','>' )) {
            return true;
        }

        //nothing yet? then...sorry, but no, not compatible.
        return false;
    }

    private function setup_constants() {
        require_once(ABSPATH.'wp-admin/includes/plugin.php');
        $plugin_data = get_plugin_data( __FILE__ );

        define('rsssl_pro_url', plugin_dir_url(__FILE__ ));
        define('rsssl_pro_path', plugin_dir_path(__FILE__ ));
        define('rsssl_pro_plugin', plugin_basename( __FILE__ ) );
        define('rsssl_pro_version', $plugin_data['Version'] );
        define('rsssl_pro_plugin_file', __FILE__);

        if (!defined('REALLY_SIMPLE_SSL_URL')) define( 'REALLY_SIMPLE_SSL_URL', 'https://www.really-simple-ssl.com');
        define( 'REALLY_SIMPLE_SSL_PRO', 'Really Simple SSL pro' );
    }

    private function includes() {
        require_once( plugin_dir_path(__FILE__ ) . '/csp-violation-endpoint.php');
        if (is_admin()) {
	        require_once( rsssl_pro_path . '/class-premium-options.php' );
	        // require_once( rsssl_pro_path .  '/class-multisite.php' );
	        require_once( rsssl_pro_path . '/class-licensing.php' );
	        require_once( rsssl_pro_path . '/class-scan.php' );
	        require_once( rsssl_pro_path . '/class-importer.php' );
	        require_once( rsssl_pro_path . '/class-cert-expiration.php' );

	        //Only require support when PHP version is higher then 5.6, anonymous function may break site if lower version is used.
	        if ( version_compare( phpversion(), '5.6', '>=' ) ) {
		        require_once( rsssl_pro_path . '/class-support.php' );
	        }
        }
    }

    private function hooks() {

    }


    /**
     * Handles the displaying of any notices in the admin area
     *
     * @since 1.0.28
     * @access public
     * @return void
     */

    public static function admin_notices() {
        //prevent showing the review on edit screen, as gutenberg removes the class which makes it editable.
        $screen = get_current_screen();
        if ( $screen->parent_base === 'edit' ) return;

        require_once(ABSPATH.'wp-admin/includes/plugin.php');
        $core_plugin = false;
        $per_page_plugin = false;

        $core_plugin = '/really-simple-ssl/rlrsssl-really-simple-ssl.php';
        if (is_plugin_active($core_plugin)) $core_plugin_data = get_plugin_data( WP_PLUGIN_DIR . $core_plugin, false, false );

        $per_page_plugin = 'really-simple-ssl-on-specific-pages/really-simple-ssl-on-specific-pages.php';
        if (is_plugin_active($per_page_plugin)) $per_page_plugin_data = get_plugin_data( WP_PLUGIN_DIR .'/'. $per_page_plugin, false, false );

        if ( !is_plugin_active($core_plugin) && !is_plugin_active($per_page_plugin)) {
            ?>
            <div id="message" class="error notice">
                <h1><?php echo __("Plugin dependency error","really-simple-ssl-pro");?></h1>

                <?php if (!is_rsssl_plugin_active()) {
                    ?> <p> <?php echo __("Really Simple SSL pro is an add-on for Really Simple SSL, and cannot do it on its own :(","really-simple-ssl-pro"); ?> </p>
                    <p> <?php echo __("Please install and activate Really Simple SSL before activating this add-on.","really-simple-ssl-pro"); ?> </p> <?php
                } elseif (!rsssl_uses_default_folder_name()) {
                    $dirname = RSSSL()->really_simple_ssl->get_current_rsssl_free_dirname();
                    echo sprintf(__("The Really Simple SSL plugin folder in the /wp-content/plugins/ directory has been renamed to %s. Therefore Really Simple SSL pro cannot work properly. To fix this you can rename the Really Simple SSL folder back to the default %s", "really-simple-ssl"),"<b>" . $dirname . "</b>" , "<b>really-simple-ssl</b>");
                } ?>

            </div>
            <?php
        }elseif (($core_plugin && version_compare($core_plugin_data['Version'], '2.5.12', '<')) || ($per_page_plugin_data && version_compare($per_page_plugin_data['Version'], '1.0.7', '<'))) {
            ?>
            <div id="message" class="error notice">
                <h1><?php echo __("Plugin dependency error","really-simple-ssl-pro");?></h1>
                <p><?php echo __("Really Simple SSL or Really Simple SSL per page needs to be updated to the latest version to be compatible.","really-simple-ssl-pro");?></p>
                <p><?php echo __("Please upgrade to the latest version to be able use the full functionality of the plugin.","really-simple-ssl-pro");?>
                </p></div>
            <?php
        }

    }
}

if (!class_exists('REALLY_SIMPLE_SSL_PRO_MULTISITE')) {
	function RSSSL_PRO() {
        return REALLY_SIMPLE_SSL_PRO::instance();
    }
    add_action( 'plugins_loaded', 'RSSSL_PRO', 10 );
}

/*
 * Enables the HTTP Strict Transport Security (HSTS) header also on non apache servers.
 *
 * @since 1.0.25
 **/

$wp_hsts = get_option("rsssl_hsts_no_apache");
if ($wp_hsts && is_ssl()) {
    add_action( 'send_headers', 'rsssl_pro_hsts' );
}
if (!function_exists('rsssl_pro_hsts')) {
    function rsssl_pro_hsts() {
        $preload = get_option("rsssl_hsts_preload");
        if (!$preload) {
            header( 'Strict-Transport-Security: max-age=31536000' );
        } else {
            header( 'Strict-Transport-Security: max-age=63072000; includeSubDomains; preload' );
        }
    }
}



/*
*
* Set a secure cookie, but only if the site is enabled for SSL, not per page.
* This setting can be used on multisite as well, as it will decide per site what setting to use.
* @since 2.0.10
* */

add_filter( 'secure_logged_in_cookie', 'rsssl_secure_logged_in_cookie' , 10, 3);
function rsssl_secure_logged_in_cookie($secure_logged_in_cookie, $user_id, $secure){
    $options = get_option("rsssl_options");
    $ssl_enabled = isset($options['ssl_enabled']) ? $options['ssl_enabled'] : false;

    if (!defined('rsssl_pp_version') && $ssl_enabled) {
        return true;
    }
    return $secure_logged_in_cookie;
}

/**
 *
 * Check the current free plugin folder path and compare it to default path to detect if the plugin folder has been renamed
 *
 * @since 3.1
 *
 * @return boolean
 *
 */

function rsssl_uses_default_folder_name()
{
    $default_plugin_path = RSSSL()->really_simple_ssl->plugin_dir;
    $current_plugin_path = RSSSL()->really_simple_ssl->get_current_rsssl_free_dirname();

    if ($default_plugin_path === $current_plugin_path) {
        return true;
    } else {
        return false;
    }
}

/**
 *
 * Check the current free plugin is active
 *
 * @since 3.1
 *
 * @return boolean
 *
 */

function is_rsssl_plugin_active()
{
    if (defined('rsssl_plugin')) {
        return true;
    } else {
        return false;
    }
}

function enable_security_header_options()
{
	update_option('rsssl_x_xss_protection', true);
	update_option('rsssl_x_content_type_options', true);
	update_option('rsssl_no_referrer_when_downgrade', true);
}



