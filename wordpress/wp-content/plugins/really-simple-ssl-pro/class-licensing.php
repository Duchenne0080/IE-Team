<?php
/* 100% match ms */
defined('ABSPATH') or die("you do not have access to this page!");

if (!class_exists('EDD_SL_Plugin_Updater')) {
    // load our custom updater
    include(dirname(__FILE__) . '/EDD_SL_Plugin_Updater.php');
}

if (!class_exists("rsssl_licensing")) {
    class rsssl_licensing
    {
        private static $_this;
        public $product_name;
        public $website;
        public $author;

        function __construct()
        {
            if (isset(self::$_this))
                wp_die(sprintf(__('%s is a singleton class and you cannot create a second instance.', 'really-simple-ssl'), get_class($this)));

            self::$_this = $this;

            $this->product_name = 'Really Simple SSL pro';
            $this->website = '';
            $this->author = 'RogierLankhorst';
            update_option( 'rsssl_pro_license_key', 'activated');
			update_option( 'rsssl_pro_license_status', 'valid');
//	if (!is_multisite()){
            add_action('admin_init', array($this, 'plugin_updater'), 0);
            add_action('admin_init', array($this, 'activate_license'), 10, 3);
            add_action('admin_init', array($this, 'register_option'), 20, 3);

            add_action('admin_init', array($this, 'deactivate_license'), 30, 3);
            add_action('admin_notices', array($this, 'error_messages'));

            add_action('wp_ajax_rsssl_pro_dismiss_license_notice', array($this, 'dismiss_license_notice'));
            add_action("admin_notices", array($this, 'show_notice_license'));
            add_filter('rsssl_tabs', array($this, 'add_license_tab'), 20, 3);
            add_action('show_tab_license', array($this, 'add_license_page'));
//}
        }

        static function this()
        {
            return self::$_this;
        }

        public function show_notice_license()
        {
            //prevent showing the review on edit screen, as gutenberg removes the class which makes it editable.
            $screen = get_current_screen();
            if ( $screen->parent_base === 'edit' ) return;

            add_action('admin_print_footer_scripts', array($this, 'dismiss_license_notice_script'));
            $dismissed = get_option('rsssl_pro_license_notice_dismissed');
            if (!$this->license_is_valid() && !$dismissed) { ?>
                <?php if (!is_multisite()) { ?>
                    <div id="message" class="error notice is-dismissible rsssl-pro-dismiss-notice">
                        <p>
                            <?php
                            echo __("You haven't activated your Really Simple SSL pro license yet. To get all future updates, enter your license on the settings page. ", "really-simple-ssl-pro");
                            $link_open_settings = '<a href="options-general.php?page=rlrsssl_really_simple_ssl&tab=license">';
                            $link_open_license = '<a target="blank" href="https://www.really-simple-ssl.com/pro">';
                            printf(__("Go to the %ssettings page%s or %spurchase a license%s.", "really-simple-ssl-pro"), $link_open_settings, '</a>', $link_open_license, '</a>');
                            ?>
                        </p>
                    </div>
                <?php } ?>
                <?php
            }
        }

        /**
         * Process the ajax dismissal of the success message.
         *
         * @since  2.0
         *
         * @access public
         *
         */

        public function dismiss_license_notice()
        {
            check_ajax_referer('rsssl-pro-dismiss-license-notice', 'nonce');
            update_option('rsssl_pro_license_notice_dismissed', true);
            wp_die();
        }

        public function dismiss_license_notice_script()
        {
            $ajax_nonce = wp_create_nonce("rsssl-pro-dismiss-license-notice");
            ?>
            <script type='text/javascript'>
                jQuery(document).ready(function ($) {

                    $(".rsssl-pro-dismiss-notice.notice.is-dismissible").on("click", ".notice-dismiss", function (event) {
                        var data = {
                            'action': 'rsssl_pro_dismiss_license_notice',
                            'nonce': '<?php echo $ajax_nonce; ?>'
                        };

                        $.post(ajaxurl, data, function (response) {

                        });
                    });
                });
            </script>
            <?php
        }


        public function plugin_updater()
        {
            // retrieve our license key from the DB
            $license_key = trim(get_option('rsssl_pro_license_key'));

            // setup the updater

            $edd_updater = new EDD_SL_Plugin_Updater(REALLY_SIMPLE_SSL_URL, rsssl_pro_plugin_file, array(
                    'version' => rsssl_pro_version,                // current version number
                    'license' => $license_key,        // license key (used get_option above to retrieve from DB)
                    'item_name' => REALLY_SIMPLE_SSL_PRO,    // name of this plugin
                    'author' => 'Rogier Lankhorst'  // author of this plugin
                )
            );


        }

        public function add_license_tab($tabs)
        {
            $tabs['license'] = __("License", "really-simple-ssl-pro");
            return $tabs;
        }

        public function add_license_page()
        {
            $license = get_option('rsssl_pro_license_key');

            $status = get_option('rsssl_pro_license_status');

            $license_data = $this->get_latest_license_data();

            ?>
            <form method="post" action="options.php" novalidate>
                <?php wp_nonce_field('rsssl_pro_nonce', 'rsssl_pro_nonce'); ?>
                <?php settings_fields('rsssl_pro_license'); ?>
            <?php
                //expired, revoked, missing, invalid, site_inactive, item_name_mismatch, no_activations_left
                $message = $this->get_error_message($license_data);

                if ($status=='valid' || $license_data->license=='site_inactive') {
                    $upgrade = $license_data->license_limit == 1 ? __("a 5 sites or unlimited sites license", "really-simple-ssl-pro") : __("an unlimited sites license", "really-simple-ssl-pro");
                    if ($license_data->activations_left < $license_data->license_limit) {

                        $this->rsssl_notice(sprintf(__('You have %d activations left on your license. If you need more activations you can upgrade your current license to %s on your %saccount%s page.', "really-simple-ssl-pro"), $license_data->activations_left, $upgrade, '<a href="https://really-simple-ssl.com/account" target="_blank">', '</a>'), 'warning');
                    }
                }

                if ($message) {
                    $this->rsssl_notice($message,'warning');
                } elseif ($license_data->license == 'deactivated'){
                    if ($status=='valid'){
                        $this->rsssl_notice(__("Your license is valid, but not activated on this site", 'really-simple-ssl-pro'));
                    } elseif(!empty($status)) {
                        $this->rsssl_notice(__("Your license does not seem to be valid. Please check your license key", 'really-simple-ssl-pro'));
                    }
                } elseif ($status == 'valid') {
                    $date = $license_data->expires;
                    $date = strtotime($date);
                    $date = date(get_option('date_format'), $date);
                    $this->rsssl_notice(sprintf(__("Your license is valid, and expires on: %s", 'really-simple-ssl-pro'), $date ));
                } elseif ($license_data->license == 'expired') {
                    $link = '<a target="_blank" href="' . $this->website . "/account/" . '">';
                    $this->rsssl_notice(sprintf(__("Your license key has expired. Please renew your license key on %syour account page%s", 'really-simple-ssl-pro'), $link, '</a>'), 'warning');
                } elseif ($license_data->license_limit == '0') {
                    $this->rsssl_notice(sprintf(__("Your license key cannot be activated because you have no activations left. Check on which site your license is currently activated or upgrade to a 5 site or unlimited license on your %saccount%s page.", "really-simple-ssl-pro"), '<a href="https://really-simple-ssl.com/account" target="_blank">', '</a>'), 'warning');
                }
                else {
                    $this->rsssl_notice(__("Enter your license here so you keep receiving updates and support.", 'really-simple-ssl-pro'));
                }

                ?>

                <table class="form-table">
                    <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
                            <?php _e('Really Simple SSL pro license Key'); ?>
                        </th>
                        <td>
                            <input id="rsssl_pro_license_key" name="rsssl_pro_license_key" type="password"
                                   class="regular-text" value="<?php esc_attr_e($license); ?>"/>
                            <?php if (false !== $license) { ?>
                            <?php if ($status && $status == 'valid') { ?>
                                <span style="color:green;"><?php _e('active'); ?></span>
                                <input type="submit" class="button-secondary" name="rsssl_pro_license_deactivate"
                                       value="<?php _e('Deactivate License'); ?>"/>
                            <?php } else { ?>
                                <input type="submit" class="button-secondary" name="rsssl_pro_license_activate"
                                       value="<?php _e('Activate License'); ?>"/>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } else {
                        ?>
                        <label class="description"
                               for="rsssl_pro_license_key"><?php _e('Enter your license key'); ?></label>
                        <?php
                    } ?>
                    </tbody>
                </table>

                <input type="submit" name="rsssl_pro_license_activate" id="submit" class="button button-primary" value="<?php _e("Save changes", "really-simple-ssl-pro"); ?>">
            </form>
            <?php
        }

        public function register_option()
        {
            // creates our settings in the options table
            register_setting('rsssl_pro_license', 'rsssl_pro_license_key', array($this, 'sanitize_license'));
        }

        public function sanitize_license($new)
        {
            $old = get_option('rsssl_pro_license_key');
            if ($old && $old != $new) {
                delete_option('rsssl_pro_license_status'); // new license has been entered, so must reactivate
            }
            return $new;
        }


        /************************************
         * this illustrates how to activate
         * a license key
         *************************************/

        public function activate_license()
        {


            // listen for our activate button to be clicked
            if (isset($_POST['rsssl_pro_license_activate'])) {
                // run a quick security check
                if (!check_admin_referer('rsssl_pro_nonce', 'rsssl_pro_nonce'))
                    return; // get out if we didn't click the Activate button

                // retrieve the license from the database
                $license = sanitize_key(trim($_POST['rsssl_pro_license_key']));
                update_option('rsssl_pro_license_key', $license);
                // data to send in our API request
			$response = new stdClass();
			$response->success = true;
			$response->license = 'valid';
			$response->expires = '2050-01-01 00:00:00';
			$response->license_limit = 'unlimited';
			$response->site_count = 0;
			$response->activations_left = 'unlimited';

            $license_data = $response;

                // $license_data->license will be either "valid" or "invalid"
                update_option('rsssl_pro_license_status', $license_data->license);
                // $license_data->license will be either "deactivated" or "failed"
                if ($license_data->license == 'deactivated') {
                    delete_option('rsssl_pro_license_status');
                }

                wp_redirect(admin_url('options-general.php?page=rlrsssl_really_simple_ssl&tab=license'));
                exit();

            }
        }

        /**
         * This is a means of catching errors from the activation method above and displaying it to the customer
         */
        public function error_messages()
        {
            if (isset($_GET['sl_activation']) && !empty($_GET['message'])) {

                switch ($_GET['sl_activation']) {

                    case 'false':
                        $message = urldecode($_GET['message']);
                        ?>
                        <div class="error">
                            <p><?php echo $message; ?></p>
                        </div>
                        <?php
                        break;

                    case 'true':
                    default:
                        // Developers can put a custom success message here for when activation is successful if they way.
                        break;

                }
            }
        }

        /***********************************************
         * Illustrates how to deactivate a license key.
         * This will decrease the site count
         ***********************************************/


        public function deactivate_license()
        {

            // listen for our deactivate button to be clicked
            if (isset($_POST['rsssl_pro_license_deactivate'])) {

                // run a quick security check
                if (!check_admin_referer('rsssl_pro_nonce', 'rsssl_pro_nonce'))
                    return; // get out if we didn't click the Activate button

                // retrieve the license from the database
                $license = trim(get_option('rsssl_pro_license_key'));

			$response = new stdClass();
			$response->success = true;
			$response->license = 'deactivated';

            $license_data = $response;

                // decode the license data
                $license_data = $response;

                // $license_data->license will be either "deactivated" or "failed"
                if ($license_data->license == 'deactivated') {

                    delete_option('rsssl_pro_license_status');
                    delete_option('rsssl_pro_license_notice_dismissed');
                }


            }
        }


        /************************************
         * this illustrates how to check if
         * a license key is still valid
         * the updater does this for you,
         * so this is only needed if you
         * want to do something custom
         *************************************/

        public function license_is_valid()
        {

            $status = get_option('rsssl_pro_license_status');
            if ($status == "valid") return true;

            //check if any of the multisite sites has a valid license.
            //One with a valid license is enough.

            if (is_multisite()) {
                $sites = $this->get_sites_bw_compatible();
                foreach ($sites as $site) {
                    $this->switch_to_blog_bw_compatible($site);
                    if (is_main_site(get_current_blog_id())) {
                        $status = get_option('rsssl_pro_license_status');
                    }

                    restore_current_blog(); //switches back to previous blog, not current, so we have to do it each loop

                    //but if it's true, we exit immediately.
                    if ($status && $status == "valid") {
                        return true;
                    }
                }
            }

        }

        public
        function get_latest_license_data()
        {

            $license_data = false;
            // retrieve the license from the database
            $license = get_option('rsssl_pro_license_key');

			$response = new stdClass();
			$response->success = true;
			$response->license = 'valid';
			$response->expires = '2050-01-01 00:00:00';
			$response->license_limit = 'unlimited';
			$response->site_count = 0;
			$response->activations_left = 'unlimited';

            // make sure the response came back okay
            if ($response){
                $license_data = $response;
                if ('valid' !== $license_data->license) {
                    delete_transient('rsssl_pro_license_status');
                    //expired, revoked, missing, invalid, site_inactive, item_name_mismatch, no_activations_left
                } else {
                    $date = $license_data->expires;
                    $date = strtotime($date);
                    $date = date(get_option('date_format'), $date);
                    update_option('rsssl_pro_license_expires', $date);
                    set_transient('rsssl_pro_license_status', $license_data->license, WEEK_IN_SECONDS);
                    set_transient('rsssl_pro_license_activation_limit', $license_data->license_limit, WEEK_IN_SECONDS);
                    // $license_data->license will be either "deactivated" or "failed"
                    if ($license_data->license == 'deactivated') {
                        delete_transient('rsssl_pro_license_status');
                    }
                }
            }

            return $license_data;
        }

        public function get_error_message($license_data){
            return;
        }

        public function rsssl_notice($msg, $type='rsssl_notice_license', $hide = false, $echo=true)
        {

            if ($msg == '') return;

            $hide_class = $hide ? "rsssl-hide" : "";
            $html = '<div class="rsssl_notice_license '.$type.' ' . $hide_class . '">' . $msg . '</div>';
            if ($echo) {
                echo $html;
            } else {
                return $html;
            }
        }

//change deprecated function depending on version.

        public function get_sites_bw_compatible()
        {
            global $wp_version;
            $sites = ($wp_version >= 4.6) ? get_sites() : wp_get_sites();
            return $sites;
        }

        /*
                    The new get_sites function returns an object.

        */

        public function switch_to_blog_bw_compatible($site)
        {
            global $wp_version;
            if ($wp_version >= 4.6) {
                switch_to_blog($site->blog_id);
            } else {
                switch_to_blog($site['blog_id']);
            }
        }
    }
} //class closure
