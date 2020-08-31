<?php
/*
    not currently included in the plugin.
*/
defined('ABSPATH') or die("you do not have access to this page!");

if ( ! class_exists( 'rsssl_pro_multisite' ) ) {

  class rsssl_pro_multisite {
    private static $_this;


  function __construct() {
    if ( isset( self::$_this ) )
        wp_die( sprintf( __( '%s is a singleton class and you cannot create a second instance.','really-simple-ssl' ), get_class( $this ) ) );

    self::$_this = $this;
    if (is_network_admin()) {
      add_action('admin_init', array($this, 'add_pro_settings'),60);
      add_action('admin_init', array($this, 'process_switch'),70);
      //add_action("rsssl_show_network_tab_sites", array($this, "show_sites_tab"));
      //add_filter('rsssl_network_tabs', array($this, 'add_sites_tab'));
    }

  }

  static function this() {
    return self::$_this;
  }

  public function process_switch(){
    if (!current_user_can("manage_network_plugins")) return;

    if (!isset($_GET['rsssl_switch_blog_nonce']) || !wp_verify_nonce($_GET['rsssl_switch_blog_nonce'], 'rsssl_switch_blog')) return;

    if (isset($_GET['blog_id']) && isset($_GET['action'])) {
      $action = false;
      if ($_GET['action']=="activate") $action = "activate";
      if ($_GET['action']=="deactivate") $action = "deactivate";

      $blog_id = intval($_GET['blog_id']);
      if (!$action) return;

      switch_to_blog( $blog_id );

      if ($action=="deactivate") {
        RSSSL()->really_simple_ssl->deactivate_ssl();
      } else {
        RSSSL()->really_simple_ssl->activate_ssl();
      }
      restore_current_blog();
    }
  }


  public function add_sites_tab($tabs){
  $tabs['sites'] = __("Sites overview","really-simple-ssl-pro");
  return $tabs;
  }

/*
 * Shows a tab with all sites
 * @TODO retrieve $total_blog_count from free class-multisite
 *
 */

  public function show_sites_tab(){
    ?>
    <p><?php _e("Here you can see the current status of the sites in your network.", "really-simple-ssl-pro")?><p>
    <?php

    global $wp_version;
    if ($wp_version < 4.6 ) {
      echo "this feature needs WordPress 4.6 or higher";
      return;
    }

    $p=0;
    $sites_per_page = 40;
    $html = "";

    $enabled = '<img class="rsssl-icons" src="' . rsssl_pro_url . "img/check-icon.png" .'">';
    $disabled = '<img class="rsssl-icons" src="' . rsssl_pro_url . "img/cross-icon.png" .'">';

    if (isset($_GET['p'])) $p = intval($_GET["p"]);

    $args = array(
      'number' => $sites_per_page,
      'offset' => $p*$sites_per_page,
    );

    $sites = get_sites($args);

    if (RSSSL()->rsssl_multisite->ssl_enabled_networkwide) {
      $snippet = '<tr><td>[ACTIVE]</td><td>[NAME]</td><td></td></tr>';
    } else {
      $snippet = '<tr><td>[ACTIVE]</td><td>[NAME]</td><td><a href="[URL]" class="button">[SWITCH]</a></td></tr>';
    }

    ?>

    <?php
		foreach ( $sites as $site ) {
      switch_to_blog( $site->blog_id);

      //$site->blog_id, domain, path.
      $options = get_option('rlrsssl_options');
      if (isset($options)) {
        $ssl_enabled               = isset($options['ssl_enabled']) ? $options['ssl_enabled'] : FALSE;
      }
      $active = $ssl_enabled ? $enabled : $disabled;
      $action = $ssl_enabled ? "deactivate" : "activate";
      $switch = $ssl_enabled ? __("deactivate", "really-simple-ssl-pro") : __("activate", "really-simple-ssl-pro");
      $url = wp_nonce_url(network_admin_url("settings.php?page=really-simple-ssl&tab=sites&p=".$p."&action=".$action."&blog_id=".$site->blog_id), "rsssl_switch_blog", "rsssl_switch_blog_nonce");
      $html .= str_replace(array("[ACTIVE]", "[NAME]", "[URL]", "[SWITCH]"), array($active, home_url(), $url, $switch), $snippet);
			restore_current_blog(); //switches back to previous blog, not current, so we have to do it each loop

		}
    ?>
    <p>
      <table>
        <thead>
          <tr>
             <th><?php _e("Active", "really-simple-ssl-pro")?></th>
             <th><?php _e("Site", "really-simple-ssl-pro")?></th>
             <th></th>
          </tr>
         </thead>
        <?php echo $html;?>
      </table>
    </p>

    <?php
      $url = network_admin_url("settings.php?page=really-simple-ssl&tab=sites&p=");

      $networks = get_networks();

      //Get the total blog count from all multisite networks, otherwise not all sites will show when using a multi-network.
      $total_blog_count = 0;

      foreach($networks as $network){

          $network_id = ($network->__get('id'));
          $blog_count = get_blog_count($network_id);
          $total_blog_count += $blog_count;
      }

      if ($total_blog_count>$sites_per_page) {?>
      <a href="<?php echo $url.($p-1)?>">< <?php _e("previous","really-simple-ssl-pro")?></a>&nbsp;<a href="<?php echo $url.($p+1)?>"><?php _e("next","really-simple-ssl-pro")?> ></a>
    <?php }?>
    <?php
  }




  public function add_pro_settings(){
    if (!RSSSL()->rsssl_multisite->plugin_network_wide_active()) return;

    // register_setting( RSSSL()->rsssl_multisite->option_group, 'rsssl_options');
    // add_settings_section('rsssl_network_settings', __("Settings","really-simple-ssl"), array($this,'section_text'), RSSSL()->rsssl_multisite->page_slug);

    if (RSSSL()->really_simple_ssl->site_has_ssl) {
      add_settings_field('id_autoreplace_mixed_content', __("Auto replace mixed content","really-simple-ssl"), array($this,'get_option_autoreplace_mixed_content'), RSSSL()->rsssl_multisite->page_slug, 'rsssl_network_settings');
      add_settings_field('id_hide_menu_for_subsites', __("Hide menu for subsites","really-simple-ssl"), array($this,'get_option_hide_menu_for_subsites'), RSSSL()->rsssl_multisite->page_slug, 'rsssl_network_settings');

      //add_settings_field('id_301_redirect', __("Enable WordPress 301 redirection to SSL for all SSL sites","really-simple-ssl"), array($this,'get_option_wp_redirect'), RSSSL()->rsssl_multisite->page_slug, 'rsssl_network_settings');
      //add_settings_field('id_javascript_redirect', __("Enable javascript redirection to SSL","really-simple-ssl"), array($this,'get_option_javascript_redirect'), RSSSL()->rsssl_multisite->page_slug, 'rsssl_network_settings');
      //add_settings_field('id_cert_expiration_warning', __("Receive an email when your certificate is about to expire","really-simple-ssl"), array($this,'get_option_cert_expiration_warning'), RSSSL()->rsssl_multisite->page_slug, 'rsssl_network_settings');
      add_settings_field('id_mixed_content_admin', __("Enable the mixed content fixer on the WordPress back-end","really-simple-ssl"), array($this,'get_option_mixed_content_admin'), RSSSL()->rsssl_multisite->page_slug, 'rsssl_network_settings');

      if (RSSSL()->rsssl_multisite->selected_networkwide_or_per_site && RSSSL()->rsssl_server->uses_htaccess()) {
        add_settings_field('id_htaccess_redirect', __("Enable htacces redirection to SSL on the network","really-simple-ssl"), array($this,'get_option_htaccess_redirect'), RSSSL()->rsssl_multisite->page_slug, 'rsssl_network_settings');
        add_settings_field('id_do_not_edit_htaccess', __("Stop editing the .htaccess file","really-simple-ssl"), array($this,'get_option_do_not_edit_htaccess'), RSSSL()->rsssl_multisite->page_slug, 'rsssl_network_settings');
      }

      if (RSSSL()->rsssl_multisite->ssl_enabled_networkwide || !RSSSL()->rsssl_multisite->is_multisite_subfolder_install()){
        add_settings_field('id_hsts', __("Turn HTTP Strict Transport Security on","really-simple-ssl"), array($this,'get_option_hsts'), RSSSL()->rsssl_multisite->page_slug, 'rsssl_network_settings');
      }
    }
  }



  public function get_option_htaccess_redirect(){
      echo '<input id="rlrsssl_options" name="rlrsssl_network_options[htaccess_redirect]" size="40" type="checkbox" value="1"' . checked( 1, RSSSL()->rsssl_multisite->htaccess_redirect, false ) ." />";

      if(RSSSL()->rsssl_multisite->ssl_enabled_networkwide) {
        rsssl_help::this()->get_help_tip(__("Enable this if you want to redirect ALL websites to SSL using .htaccess", "really-simple-ssl"));
      } else {
        rsssl_help::this()->get_help_tip(__("Enable this if you want to redirect SSL websites using .htaccess. ", "really-simple-ssl"));
      }
    }

  public function get_option_wp_redirect(){

    echo '<input id="rlrsssl_options" name="rlrsssl_network_options[wp_redirect]" size="40" type="checkbox" value="1"' . checked( 1, RSSSL()->rsssl_multisite->wp_redirect, false ) ." />";
    rsssl_help::this()->get_help_tip(__("Enable this if you want to use the internal WordPress 301 redirect for all SSL websites. Needed on NGINX servers, or if the .htaccess redirect cannot be used.", "really-simple-ssl"));

  }

  public function get_option_autoreplace_mixed_content(){
    echo '<input id="rlrsssl_options" name="rlrsssl_network_options[autoreplace_mixed_content]" size="40" type="checkbox" value="1"' . checked( 1, RSSSL()->rsssl_multisite->autoreplace_mixed_content, false ) ." />";
    rsssl_help::this()->get_help_tip(__("Enable this if you want to automatically replace mixed content.", "really-simple-ssl"));
  }

  public function  get_option_javascript_redirect(){
    echo '<input id="rlrsssl_options" name="rlrsssl_network_options[javascript_redirect]" size="40" type="checkbox" value="1"' . checked( 1, RSSSL()->rsssl_multisite->javascript_redirect, false ) ." />";
    rsssl_help::this()->get_help_tip(__("Enable this if you want to enable javascript redirection.", "really-simple-ssl"));
  }

  public function get_option_hsts(){
    echo '<input id="rlrsssl_options" name="rlrsssl_network_options[hsts]" size="40" type="checkbox" value="1"' . checked( 1, RSSSL()->rsssl_multisite->hsts, false ) ." />";
    rsssl_help::this()->get_help_tip(__("Enable this if you want to enable HSTS.", "really-simple-ssl"));
  }

  public function get_option_mixed_content_admin(){
    echo '<input id="rlrsssl_options" name="rlrsssl_network_options[mixed_content_admin]" size="40" type="checkbox" value="1"' . checked( 1, RSSSL()->rsssl_multisite->mixed_content_admin, false ) ." />";
    rsssl_help::this()->get_help_tip(__("Enable this if you want the mixed content fixer for admin.", "really-simple-ssl"));
  }

  public function get_option_cert_expiration_warning(){
    echo '<input id="rlrsssl_options" name="rlrsssl_network_options[cert_expiration_warning]" size="40" type="checkbox" value="1"' . checked( 1, RSSSL()->rsssl_multisite->cert_expiration_warning, false ) ." />";
    rsssl_help::this()->get_help_tip(__("Enable this if you want to enable certificate expiration notices.", "really-simple-ssl"));

  }

  public function get_option_hide_menu_for_subsites(){
    echo '<input id="rlrsssl_options" name="rlrsssl_network_options[hide_menu_for_subsites]" size="40" type="checkbox" value="1"' . checked( 1, RSSSL()->rsssl_multisite->hide_menu_for_subsites, false ) ." />";
    rsssl_help::this()->get_help_tip(__("Enable this if you want to hide menus on subsites.", "really-simple-ssl"));
  }


  public function get_option_do_not_edit_htaccess(){
    echo '<input id="rlrsssl_options" name="rlrsssl_network_options[do_not_edit_htaccess]" size="40" type="checkbox" value="1"' . checked( 1, RSSSL()->rsssl_multisite->do_not_edit_htaccess, false ) ." />";
    rsssl_help::this()->get_help_tip(__("Enable this if you want to block the htaccess file from being edited.", "really-simple-ssl"));
  }

  public function sanitize_boolean($value)
  {
    if ($value == true) {
      return true;
    } else {
      return false;
    }
  }



  } //class closure
}
