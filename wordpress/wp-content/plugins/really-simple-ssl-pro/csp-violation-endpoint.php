<?php defined('ABSPATH') or die("you do not have access to this page!");

/**
 *
 * API for Content Security Policy registration
 * @Since 2.5
 * @return JSON data with Content Security Policy violations
 *
 */

add_action('rest_api_init', 'rsssl_pro_csp_rest_route');
function rsssl_pro_csp_rest_route()
{
	register_rest_route('rsssl/v1/', 'csp/', array(
		'methods' => 'POST',
		'callback' => 'rsssl_track_csp',
		'permission_callback' => '__return_true',
	));
}

/**
 * @param WP_REST_Request $request
 *
 * @Since 2.5
 *
 * Process Content Security Policy violations, add to DB
 *
 */

function rsssl_track_csp(WP_REST_Request $request)
{

    //We have added a query parameter (?xx) after the API endpoint, get that value via get_param() and compare to the option value
    if ($request->get_param('rsssl_apitoken') != get_option('rsssl_csp_report_token') ) return;

    global $wpdb;
    $table_name = $wpdb->prefix . "rsssl_csp_log";

    $row_count = $wpdb->get_var("SELECT count(*) FROM $table_name");
    if ($row_count >= 500) return;

    //CSP-report-only data is contained in php://input stream
    $json_data = file_get_contents('php://input');

    error_log(print_r($json_data, true));

    //Decode to associative array
    $json_data = json_decode($json_data, true);

    $blockeduri = rsssl_sanitize_uri_value($json_data['csp-report']['blocked-uri']);
    $violateddirective = rsssl_sanitize_csp_violated_directive($json_data['csp-report']['violated-directive']);

    //If one of these is empty we cannot generate a CSP rule from it, return
    if (empty($violateddirective) || (empty($blockeduri) ) ) return;

    //Style-src-elem and script-src-elem are implemented behind a browser flag. Therefore save as style-src and script-src since these are used as a fallback. Results in console warnings otherwise
//    if ($violateddirective === 'style-src-elem') {
//        $violateddirective = str_replace('style-src-elem', 'style-src', $violateddirective);
//    }
//
//    if ($violateddirective === 'script-src-elem') {
//        $violateddirective = str_replace('script-src-elem', 'script-src', $violateddirective);
//    }

    //Check if entry already exists
    //$count = $wpdb->get_var($wpdb->prepare("SELECT count(*) FROM %s where blockeduri = '%s' AND violateddirective='%s'", $table_name, $blockeduri, $violateddirective));
    $count = $wpdb->get_var("SELECT count(*) FROM $table_name where blockeduri = '$blockeduri' AND violateddirective='$violateddirective'");
    if ($count>0) return;

    //Insert into table
    $wpdb->insert($table_name, array(
        'time' => current_time('mysql'),
        'documenturi' => esc_url_raw($json_data['csp-report']['document-uri']),
        //Violateddirective and blockeduri are already sanitized earlier in this function
        'violateddirective' => $violateddirective,
        'blockeduri' => $blockeduri,
    ));
}

/**
 * @param $str
 * @return string
 *
 * @Since 2.5
 *
 * Only allow known directives to be returned, otherwise return empty string
 *
 */

function rsssl_sanitize_csp_violated_directive($str){

    //Style-src-elem and script-src-elem are implemented behind a browser flag. Therefore save as style-src and script-src since these are used as a fallback
    if ($str==='style-src-elem') {
        $str = str_replace('style-src-elem', 'style-src', $str);
    }

    if ($str==='script-src-elem') {
        $str = str_replace('script-src-elem', 'script-src', $str);
    }

    //https://www.w3.org/TR/CSP3/#directives-fetch
    $directives = array(
        //Fetch directives
        'child-src',
        'connect-src',
        'default-src',
        'font-src',
        'frame-src',
        'img-src',
        'manifest-src',
        'media-src',
        'prefetch-src',
        'object-src',
        'script-src',
        'script-src-elem',
        'script-src-attr',
        'style-src',
        'style-src-elem',
        'style-src-attr',
        'worker-src',
        //Document directives
        'base-uri',
        'plugin-types',
        'sandbox',
        'form-action',
        'frame-ancestors',
        'navigate-to',
    );

    if (in_array($str, $directives)) return $str;

    return '';
}

/**
 * @param $str
 * @return string
 *
 * @Since 2.5
 *
 * Only allow known directives to be returned, otherwise return empty string
 *
 */

function rsssl_sanitize_csp_blocked_uri($str){

    //Data: needs an : which isn't included automatically, add here
    if ($str==='data') {
        $str = str_replace('data', 'data:', $str);
    }

    //Inline should be unsafe-inline
    if ($str==='inline') {
        $str = str_replace('inline', 'unsafe-inline', $str);
    }

    //Eval should be unsafe-eval
    if ($str==='eval') {
        $str = str_replace('eval', 'unsafe-eval', $str);
    }

    $directives = array(
        //Fetch directives
        'self',
        'data:',
        'unsafe-inline',
        'unsafe-eval',
        'about',
    );

    if (in_array($str, $directives)) return $str;

    return '';

}

/**
 * @param $blockeduri
 * @return string
 *
 * @since 2.5
 *
 * URI can be a domain or a value (e.g. data:). If it's a domain, return the main domain (https://example.com). Otherwise return one of the known uri value.
 */

function rsssl_sanitize_uri_value($blockeduri)
{
    $uri = '';

    //Check if uri starts with http(s)
    if (substr($blockeduri, 0, 4) === 'http') {
        $url = parse_url($blockeduri);
        if ( (isset($url['scheme'])) && isset($url['host']) ) {
            $uri = esc_url_raw($url['scheme'] . "://" . $url['host']);
        }
    } else {
        $uri = rsssl_sanitize_csp_blocked_uri($blockeduri);
    }

    return $uri;
}

if (is_admin()) {

    class rsssl_csp_backend
    {

        private static $_this;

        public $rsssl_csp_db_version = '2';
        private $directives = array();

        function __construct()
        {

            if (isset(self::$_this))
                wp_die(sprintf(__('%s is a singleton class and you cannot create a second instance.', 'really-simple-ssl-pro'), get_class($this)));

            self::$_this = $this;

            //Only add CSP tab if reporting has been enabled
            if (get_option('rsssl_enable_csp_reporting')) {
                add_filter('rsssl_tabs', array($this,'add_csp_tab'),15,3 );
                add_action('show_tab_csp', array($this, 'add_csp_page'));
                add_action('admin_init', array($this, 'update_db_check'), 10, 2);
                add_action('admin_init', array($this, 'add_rules_to_htaccess'));
            }

            //Remove report only rules on option update
            add_action("update_option_rsssl_enable_csp_reporting", array($this, "remove_csp_report_only_from_htaccess"), 30,3);
            //Remove CSP rules on option update
            add_action("update_option_rsssl_add_csp_rules_to_htaccess", array($this, "remove_csp_from_htaccess"), 30,3);

            if (RSSSL()->really_simple_ssl->is_settings_page() ) {
                add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
            }

            add_action('admin_print_footer_scripts-settings_page_rlrsssl_really_simple_ssl', array($this, 'inline_scripts'));

            add_action('wp_ajax_update_in_policy_value', array($this, 'update_in_policy_value'));

            $this->directives = array(
                'child-src'         => "child-src 'self' {uri}; ",
                'connect-src'       => "connect-src 'self' {uri}; ",
                'font-src'          => "font-src 'self' {uri}; ",
                'frame-src'         => "frame-src 'self' {uri}; ",
                'img-src'           => "img-src 'self' data: {uri}; ",
                'manifest-src'      => "manifest-src 'self' {uri}; ",
                'media-src'         => "media-src 'self' {uri}; ",
                'prefetch-src'      => "prefetch-src 'self' {uri}; ",
                'object-src'        => "object-src 'self' {uri}; ",
                'script-src'        => "script-src 'self' {uri}; ",
                'script-src-elem'   => "script-src-elem 'self' {uri}; ",
                'script-src-attr'   => "script-src-attr 'self' {uri}; ",
                'style-src'         => "style-src 'self' {uri}; ",
                'style-src-elem'    => "style-src-elem 'self' {uri}; ",
                'style-src-attr'    => "style-src-attr 'self' {uri}; ",
                'worker-src'        => "worker-src 'self' {uri}; ",
            );
        }

        static function this()
        {
            return self::$_this;
        }

        public function add_csp_tab($tabs)
        {
            $tabs['csp'] = __("Content Security Policy","really-simple-ssl-pro");
            return $tabs;
        }


        /**
         *
         * @since 2.5
         *
         * Add a Content Security Policy page to the 'Content Security Policy' tab.
         * Retrieves data from Content Security Policy database table.
         *
         */

        public function add_csp_page()
        {

        if (!current_user_can('manage_options')) return;

        global $wpdb;
        $table_name = $wpdb->prefix . "rsssl_csp_log";

        ?>
            <div id="rsssl">
                <h2><?php echo __("Content Security Policy configuration", "really-simple-ssl"); ?></h2>
                <table id="rsssl-csp-table">
                  <thead>
                    <tr class="rsssl-csp-tr">
                        <th class="rsssl-csp-th"><?php echo __("Found", "really-simple-ssl-pro")?></th>
                        <!--Document-uri-->
                        <th class="rsssl-csp-th"><?php echo __("On page", "really-simple-ssl-pro")?></th>
                        <!--Violated Directive-->
                        <th class="rsssl-csp-th"><?php echo __("Directive", "really-simple-ssl-pro")?></th>
                        <!--Blocked-uri-->
                        <th class="rsssl-csp-th"><?php echo __("Domain/protocol", "really-simple-ssl-pro")?></th>
                        <th class="rsssl-csp-th"><?php echo __("Add to policy", "really-simple-ssl-pro")?></th>
                    </tr>
                  </thead>
                    <?php

                    $rows = $wpdb->get_results("SELECT * FROM $table_name ORDER BY time DESC LIMIT 100");

                    foreach ($rows as $row) {
                        //Only show results that aren't in policy (which don't have an inpolicy value yet)
                        if ( (!empty($row->inpolicy)) ) {
                            continue;
                        } ?>

                        <tr>
                            <td class="rsssl-csp-td"><?php echo human_time_diff(strtotime($row->time), current_time('timestamp')) . " " . __("ago", "really-simple-ssl-pro"); ?></td>
                            <td class="rsssl-csp-td"><?php echo $row->documenturi ?></td>
                            <td class="rsssl-csp-td"><?php echo $row->violateddirective ?></td>
                            <td class="rsssl-csp-td"><?php echo $row->blockeduri ?></td>
                            <td class="rsssl-csp-td"><button type="button" data-id="<?php echo $row->id ?>" data-path=0 data-url=0 data-token="<?php echo wp_create_nonce('rsssl_fix_post');?>" class="rsssl button button-primary" id="start-add-to-csp"><?php _e("Add to policy", "really-simple-ssl-pro")?></button></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php
        }

        /**
         *
         * Update the 'inpolicy' database value to true after 'Add to policy' button is clicked in Content Security Policy tab
         *
         * @since 2.5
         */

        public function update_in_policy_value()
        {

            if (!current_user_can('manage_options')) return;

            global $wpdb;
            $table_name = $wpdb->prefix . "rsssl_csp_log";

            if (isset($_POST['id'])) {

                //Sanitize, id should always be an int
                $id = intval($_POST['id']);

                $wpdb->update(
                    $table_name,
                    //Value to update
                    array(
                        'inpolicy' => 'true',
                    ),
                    //Update value where ID is
                    array(
                        'ID' => $id,
                    )
                );
            }
        }

        /**
         *
         * Add CSP rules to the htaccess file
         *
         * @since 2.5
         *
         */

        public function add_rules_to_htaccess()
        {
            if (!current_user_can('manage_options')) return;

            if (RSSSL()->really_simple_ssl->do_not_edit_htaccess) return;
            if (!file_exists(RSSSL()->really_simple_ssl->htaccess_file())) return;

            global $wpdb;

            $rules = array();

            //The base content security policy rules, used in later functions to generate the Content Security Policy
            $rules['default-src'] = "default-src 'self';";
            $rules['script-src'] = "script-src 'self' 'unsafe-inline'".";";
            $rules['script-src-elem'] = "script-src-elem 'self';";
            $rules['style-src'] = "style-src 'self' 'unsafe-inline';";
            $rules['style-src-elem'] = "style-src-elem 'self' unsafe-inline".";";

            $table_name = $wpdb->prefix . "rsssl_csp_log";
            $rows = $wpdb->get_results("SELECT * FROM $table_name ORDER BY time DESC");
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    if (!empty($row->inpolicy)) {
                        $violatedirective = $row->violateddirective;
                        $blockeduri = $row->blockeduri;
                        //Get uri value
                        $uri = rsssl_sanitize_uri_value($blockeduri);
                        //Generate CSP rule based on input
                        $rules = $this->generate_csp_rule($violatedirective, $uri, $rules);
                    }
                }
            }

            $rules = implode(" ", $rules);

            //Update CSP-Report-Only rules
            $this->update_csp_report_only_rules($rules);
            //Update CSP rules only when 'Add Content Security Policy to .htaccess option has been enabled.
            if (get_option('rsssl_add_csp_rules_to_htaccess')) {
                $this->update_csp_rules($rules);
            }

        }

        /**
         * @param $rules
         *
         * @since 2.5
         *
         * Update the Content Security Policy Report Only rules in .htaccess file.
         *
         */

        public function update_csp_report_only_rules($rules)
        {
            if (!current_user_can('manage_options')) return;

            if (!get_option('rsssl_enable_csp_reporting')) return;

            $htaccess = RSSSL()->really_simple_ssl->htaccess_file();

            if (!is_writeable($htaccess)) return;

            $htaccess = file_get_contents($htaccess);

            //CSP violated endpoint
            $csp_violation_endpoint = home_url('wp-json/rsssl/v1/csp');

            if (get_option('rsssl_csp_report_token')) {
                $token = get_option('rsssl_csp_report_token');
            } else {
                $token = time();
                update_option('rsssl_csp_report_token', $token);
            }

            //Base CSP-Report-Only rule
            $content_security_policy = " \nHeader always set Content-Security-Policy-Report-Only: \"$rules report-uri $csp_violation_endpoint?rsssl_apitoken=$token \"\n";

            //Check if base CSP-Report-Only rule is present in htaccess
            $pos_csp_report_only = strpos($htaccess,"# Begin Really_Simple_SSL_CSP_Report_Only");

            if ($pos_csp_report_only!==FALSE) {
                $needle_start = "# Begin Really_Simple_SSL_CSP_Report_Only";
                $needle_end = "# End Really_Simple_SSL_CSP_Report_Only";
                $htaccess = $this->replace_csp_in_htaccess($htaccess, $content_security_policy, $needle_start, $needle_end);
            } else{
                //No rules yet, write to htaccess file
                $csp_report_only_rule = "\n" . "# Begin Really_Simple_SSL_CSP_Report_Only" . $content_security_policy . "# End Really_Simple_SSL_CSP_Report_Only" . "\n";
                $htaccess = $htaccess . $csp_report_only_rule;
            }

            file_put_contents(RSSSL()->really_simple_ssl->htaccess_file(), $htaccess);
        }

        /**
         * @param $rules
         *
         * @since 2.5
         *
         * Update Content Security Policy rules in .htaccess file.
         *
         */

        public function update_csp_rules($rules)
        {
            if (!current_user_can('manage_options')) return;

            if (!get_option('rsssl_add_csp_rules_to_htaccess') ) return;

            $htaccess = RSSSL()->really_simple_ssl->htaccess_file();

            if (!is_writeable($htaccess)) return;

            $htaccess = file_get_contents($htaccess);

            //The base CSP rule, no warnings on fresh WP install
            $content_security_policy = " \nHeader always set Content-Security-Policy: \"$rules \"\n";

            //Check if # Begin CSP string is present in htaccess file
            $pos_csp = strpos($htaccess, "# Begin Really_Simple_SSL_Content_Security_Policy");

            if ($pos_csp!==FALSE) {
                $needle_start = "# Begin Really_Simple_SSL_Content_Security_Policy";
                $needle_end = "# End Really_Simple_SSL_Content_Security_Policy";
                //Replace current CSP rules with new one
                $htaccess = $this->replace_csp_in_htaccess($htaccess, $content_security_policy, $needle_start, $needle_end);
            } else {
                //No rules yet, write to htaccess file
                $csp_rule = "\n" . "# Begin Really_Simple_SSL_Content_Security_Policy" . $content_security_policy . "# End Really_Simple_SSL_Content_Security_Policy" . "\n";
                $htaccess = $htaccess . $csp_rule;
            }

            file_put_contents(RSSSL()->really_simple_ssl->htaccess_file(), $htaccess);
        }

        /**
         *
         * @since 2.5
         *
         * Remove Content Security Policy rules from .htaccess when Add Content Security Policy to .htaccess option is not enabled.
         *
         */

        public function remove_csp_from_htaccess()
        {
            if (!current_user_can('manage_options')) return;

            if (!get_option('rsssl_add_csp_rules_to_htaccess') ) {

            $htaccess = RSSSL()->really_simple_ssl->htaccess_file();
            $htaccess = file_get_contents($htaccess);

            $htaccess = preg_replace("/#\s?Begin\s?Really_Simple_SSL_Content_Security_Policy.*?#\s?End\s?Really_Simple_SSL_Content_Security_Policy/s", "", $htaccess);
            $htaccess = preg_replace("/\n+/","\n", $htaccess);

            file_put_contents(RSSSL()->really_simple_ssl->htaccess_file(), $htaccess);

            }
        }

        /**
         *
         * @since 2.5
         *
         * Remove Content Security Policy Report Only rules from .htaccess when Enable Content Security Policy option is not enabled.
         *
         */

        public function remove_csp_report_only_from_htaccess()
        {
            if (!current_user_can('manage_options')) return;

            if (!get_option('rsssl_enable_csp_reporting') ) {

            $htaccess = RSSSL()->really_simple_ssl->htaccess_file();

            if (!is_writeable($htaccess)) return;

            $htaccess = file_get_contents($htaccess);

            $htaccess = preg_replace("/#\s?Begin\s?Really_Simple_SSL_CSP_Report_Only.*?#\s?End\s?Really_Simple_SSL_CSP_Report_Only/s", "", $htaccess);
            $htaccess = preg_replace("/\n+/","\n", $htaccess);

            file_put_contents(RSSSL()->really_simple_ssl->htaccess_file(), $htaccess);

            }
        }

        /**
         * @param string $htaccess
         * @param string $content_security_policy
         * @param string $needle_start
         * @param string $needle_end
         * @return string
         *
         * @since 2.5
         * Replace existing Content-Security-Policy rules with new ones
         *
         */

        public function replace_csp_in_htaccess($htaccess, $content_security_policy, $needle_start, $needle_end)
        {
                $pos_start = strpos($htaccess, $needle_start);

                //if the needle is not actually found, we do nothing. This is the replace function so expects a valid position.
                if ($pos_start === false) {
                    return $htaccess;
                }

	            $pos_start = $pos_start + strlen($needle_start);
                $pos_end = strpos($htaccess, $needle_end, $pos_start);

	            //again, if this needle is not there, exit
	            if ($pos_end === false) {
                    return $htaccess;
                }

                return substr_replace($htaccess, $content_security_policy, $pos_start, $pos_end - $pos_start);
        }

        /**
         * @param string $violateddirective
         * @param string $uri
         * @param array $rules previously detected rules
         * @return array $rules
         *
         * @since 2.5
         * Generate CSP rules
         *
         */

        public function generate_csp_rule($violateddirective, $uri, $rules)
        {

            //Standard CSP rule: default-src. All other possible -src can be set independently.
            //https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/default-src#Examples

            //$rules = array();

            if (isset($this->directives[$violateddirective])){

                if (isset($rules[$violateddirective])) {
                    $rule_template = $this->directives[$violateddirective];
                    //get existing rule
                    $existing_rule = $rules[$violateddirective];
                    //get part of directive before {uri}
                    $rule_part = substr($rule_template, 0, strpos($rule_template, '{uri}'));
                    //replace with this part +  uri
                    $new_rule = str_replace($rule_part, $rule_part.$uri." " , $existing_rule);
                    //insert in array
                    $rules[$violateddirective] = $new_rule;
                } else {
                    $rules[$violateddirective] = str_replace('{uri}', $uri, $this->directives[$violateddirective]);;
                }
            }

            return $rules;
        }

        /**
         *
         * @since 2.5
         *
         * Add inline script required for DataTables
         *
         */

        public function inline_scripts()
        {
        ?>
            <script>
                jQuery(document).ready(function($) {
                    $('#rsssl-csp-table').DataTable({
                        language: {
                            search: "<?php _e("Search", "really-simple-ssl-pro")?>&nbsp;:",
                            sLengthMenu: "<?php printf(__("Show %s results", "really-simple-ssl-pro"), '_MENU_')?>",
                            sZeroRecords: "<?php _e("You have no suggestions for Content Security Policy rules", "really-simple-ssl-pro")?>",
                            sInfo:  "<?php printf(__("%s to %s of %s results", "really-simple-ssl-pro"), '_START_', '_END_', '_TOTAL_')?>",
                            sInfoEmpty: "<?php _e("No results to show", "really-simple-ssl-pro")?>",
                            sInfoFiltered: "<?php printf(__("(filtered from %s results)", "really-simple-ssl-pro"), '_MAX_')?>",
                            InfoPostFix: "",
                            EmptyTable: "<?php _e("No results found in the table", "really-simple-ssl-pro")?>",
                            InfoThousands: ".",
                            paginate: {
                                first: "<?php _e("First", "really-simple-ssl-pro")?>",
                                previous: "<?php _e("Previous", "really-simple-ssl-pro")?>",
                                next: "<?php _e("Next", "really-simple-ssl-pro")?>",
                                last: "<?php _e("Last", "really-simple-ssl-pro")?>",
                            },
                        },
                    });
                });
            </script>
        <?php
        }

        /**
         *
         * @since 2.5
         *
         * Enqueue DataTables scripts and CSS
         *
         */

        public function enqueue_scripts()
        {
            wp_register_style('rsssl-pro-csp-datatables', rsssl_pro_url . 'css/datatables.min.css', "", rsssl_pro_version);
            wp_enqueue_style('rsssl-pro-csp-datatables');
            wp_register_style('rsssl-pro-csp-table-css', rsssl_pro_url . 'css/jquery-table.css', "", rsssl_pro_version);
            wp_enqueue_style('rsssl-pro-csp-table-css');
            wp_enqueue_script('rsssl-pro-csp-datatables', rsssl_pro_url . "js/datatables.min.js", array('jquery'), rsssl_pro_version, false);
        }

        public function update_db_check()
        {
            if (!current_user_can('manage_options')) return;

            if (!get_option('rsssl_csp_db_version') || (get_option('rsssl_csp_db_version') < $this->rsssl_csp_db_version)) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                $this->create_csp_log_table();
                update_option('rsssl_csp_db_version', $this->rsssl_csp_db_version);
            }
        }

        /**
         *
         * @since 2.5
         *
         * Create the Content Security Policy database table
         *
         */

        public function create_csp_log_table()
        {
            if (!current_user_can('manage_options')) return;

            global $rsssl_csp_db_version;
            global $wpdb;

            $table_name = $wpdb->prefix . "rsssl_csp_log";

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
              id mediumint(9) NOT NULL AUTO_INCREMENT,
              time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
              documenturi text  NOT NULL,
              violateddirective text  NOT NULL,
              blockeduri text  NOT NULL,
              inpolicy text NOT NULL,
              PRIMARY KEY  (id)
            ) $charset_collate";

            dbDelta($sql);

            add_option('rsssl_csp_db_version', $rsssl_csp_db_version);

        }

    } //Class closure
    $rsssl_csp_backend = new rsssl_csp_backend();
}
