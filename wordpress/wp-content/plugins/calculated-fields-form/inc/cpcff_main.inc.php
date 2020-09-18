<?php
/**
 * Main class with main actions and filters: CPCFF_MAIN class
 *
 * @package CFF.
 * @since 1.0.170
 */

if(!class_exists('CPCFF_MAIN'))
{
	/**
	 * Class that defines the main actions and filters, and plugin's functionalities.
	 *
	 * @since  1.0.170
	 */
	class CPCFF_MAIN
	{
		/**
		 * Counter of forms in a same page
		 * Metaclass property.
		 *
		 * @since 1.0.170
		 * @var int $form_counter
		 */
		public static $form_counter = 0;

		/**
		 * Instance of the CPCFF_MAIN class
		 * Metaclass property to implement a singleton.
		 *
		 * @since 1.0.179
		 * @var object $_instance
		 */
		private static $_instance;

		/**
		 * Identifies if the class was instanciated from the public website or WordPress
		 * Instance property.
		 *
		 * @sinze 1.0.170
		 * @var bool $_is_admin
		 */
		private $_is_admin = false;

		/**
		 * Plugin URL
		 * Instance property.
		 *
		 * @sinze 1.0.170
		 * @var string $_plugin_url
		 */
		private $_plugin_url;

		/**
		 * Flag to know if the public resources were included
		 * Instance property.
		 *
		 * @sinze 1.0.170
		 * @var bool $_are_resources_loaded default false
		 */
		private $_are_resources_loaded = false;

		/**
		 * Forms list.
		 * List of instances of the CPCFF_FORM class.
		 * Instance property.
		 *
		 * @sinze 1.0.179
		 * @var object $_active_form
		 */
		private $_forms = array();

		/**
		 * Instance of the CPCFF_AMP class to manage the forms in AMP pages
		 * Instance property.
		 *
		 * @sinze 1.0.230
		 * @var object $_amp
		 */
		private $_amp;

		/**
		 * Constructs a CPCFF_MAIN object, and define the hooks to the filters and actions.
		 * The constructor is private because this class is a singleton
		 */
		private function __construct()
		{
			require_once CP_CALCULATEDFIELDSF_BASE_PATH.'/inc/cpcff_form.inc.php';
			require_once CP_CALCULATEDFIELDSF_BASE_PATH.'/inc/cpcff_amp.inc.php';

			// Initializes the $_is_admin property
			$this->_is_admin = is_admin();

			// Initializes the $_plugin_url property
			$this->_plugin_url = plugin_dir_url(CP_CALCULATEDFIELDSF_MAIN_FILE_PATH);

			// Plugin activation/deactivation
			$this->_activate_deactivate();

			// Load the language file
			add_action( 'plugins_loaded', array($this, 'plugins_loaded') );

			// Instanciate the AMP object
			$this->_amp = new CPCFF_AMP($this);

			// Run the initialization code
			add_action( 'init', array($this, 'init'), 1 );

			// Run the initialization code of widgets
			add_action( 'widgets_init', array($this, 'widgets_init'), 1 );

			// Fix different troubleshoots
			$this->troubleshoots();

			// Integration with Page Builders
			require_once CP_CALCULATEDFIELDSF_BASE_PATH.'/inc/cpcff_page_builders.inc.php';
			CPCFF_PAGE_BUILDERS::run();

		} // End __construct

		/**
		 * Returns the instance of the singleton.
		 *
		 * @since 1.0.179
		 * @return object self::$_instance
		 */
		public static function instance()
		{
			if(!isset(self::$_instance))
			{
				self::$_instance = new self();
			}
			return self::$_instance;
		} // End instance

		/**
		 * Loads the primary resources, previous to the plugin's initialization
		 *
		 * Loads resources like the laguages files, etc.
		 *
		 * @return void.
		 */
		public function plugins_loaded()
		{
			// Load the language file
			$this->_textdomain();

			// Load controls scripts
			$this->_load_controls_scrips();
		} // End plugins_loaded

		/**
		 * Initializes the plugin, runs as soon as possible.
		 *
		 * Initilize the plugin's sections, intercepts the submissions, generates the resources etc.
		 *
		 * @return void.
		 */
		public function init()
		{
			CPCFF_AUXILIARY::clean_transients_hook(); // Set the hook for clearing the expired transients

			if ( $this->_is_admin ) // Initializes the WordPress modules.
			{
				if(
					false === ($CP_CALCULATEDFIELDSF_VERSION = get_option('CP_CALCULATEDFIELDSF_VERSION')) ||
					$CP_CALCULATEDFIELDSF_VERSION != CP_CALCULATEDFIELDSF_VERSION
				)
				{
					if(class_exists('CPCFF_INSTALLER')) CPCFF_INSTALLER::install(is_multisite());
					update_option('CP_CALCULATEDFIELDSF_VERSION', CP_CALCULATEDFIELDSF_VERSION);
				}

				// Adds the plugin links in the plugins sections
				add_filter( 'plugin_action_links_'.CP_CALCULATEDFIELDSF_BASE_NAME, array($this, 'links' ) );

				// Creates the menu entries in the WordPress menu.
				add_action( 'admin_menu', array( $this, 'admin_menu' ) );

				// Displays the shortcode insertion buttons.
				add_action( 'media_buttons', array( $this, 'media_buttons' ) );

				// Loads the admin resources
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_resources' ), 1 );
			}
			$this->_define_shortcodes();
		} // End init

		/**
		 * Registers the widgets.
		 *
		 * Registers the widget to include the forms on sidebars, and for loading the data collected by the forms in the dashboard.
		 *
		 * @since 1.0.178
		 *
		 * @return void.
		 */
		public function widgets_init()
		{
			// Replace the shortcodes into the text widgets.
			if(!$this->_is_admin) add_filter('widget_text', 'do_shortcode');
		} // End widgets_init

		/**
		 * Adds the plugin's links in the plugins section.
		 *
		 * Links for accessing to the help, settings, developers website, etc.
		 *
		 * @param array $links.
		 *
		 * @return array.
		 */
		public function links( $links )
		{
			array_unshift(
				$links,
				'<a href="https://cff.dwbooster.com/customization" target="_blank">'.__('Request custom changes').'</a>',
				'<a href="admin.php?page=cp_calculated_fields_form">'.__('Settings').'</a>',
				'<a href="https://cff.dwbooster.com/download" target="_blank">'.__('Upgrade').'</a>',
				'<a href="https://wordpress.org/support/plugin/calculated-fields-form#new-post" target="_blank">'.__('Help').'</a>'
			);
			return $links;
		} // End links

		/**
		 * Prints the buttons for inserting the different shortcodes into the pages/posts contents.
		 *
		 * Prints the HTML code that appears beside the media button with the icons and code to insert the shortcodes:
		 *
		 * - CP_CALCULATED_FIELDS
		 * - CP_CALCULATED_FIELDS_VAR
		 *
		 * @return void.
		 */
		public function media_buttons()
		{
			print '<a href="javascript:cp_calculatedfieldsf_insertForm();" title="'.esc_attr__('Insert Calculated Fields Form', 'calculated-fields-form' ).'"><img src="'.$this->_plugin_url.'images/cp_form.gif" alt="'.esc_attr__('Insert Calculated Fields Form', 'calculated-fields-form' ).'" /></a><a href="javascript:cp_calculatedfieldsf_insertVar();" title="'.esc_attr__('Create a JavaScript var from POST, GET, SESSION, or COOKIE var', 'calculated-fields-form' ).'"><img src="'.$this->_plugin_url.'images/cp_var.gif" alt="'.esc_attr__('Create a JavaScript var from POST, GET, SESSION, or COOKIE var', 'calculated-fields-form' ).'" /></a>';
		} // End media_buttons

		/**
		 * Generates the entries in the WordPress menu.
		 *
		 * @return void.
		 */
		public function admin_menu()
		{
			// Settings page
			add_options_page('Calculated Fields Form Options', 'Calculated Fields Form', 'manage_options', 'cp_calculated_fields_form', array($this, 'admin_pages') );

			// Menu option
			add_menu_page( 'Calculated Fields Form Options', 'Calculated Fields Form', 'manage_options', 'cp_calculated_fields_form', array($this, 'admin_pages') );

			// Submenu options
			add_submenu_page( 'cp_calculated_fields_form', 'Documentation', 'Documentation', 'manage_options', "cp_calculated_fields_form_sub2", array($this, 'admin_pages') );

			add_submenu_page( 'cp_calculated_fields_form', 'Online Help', 'Online Help', 'manage_options', "cp_calculated_fields_form_sub4", array($this, 'admin_pages') );

			add_submenu_page( 'cp_calculated_fields_form', 'Upgrade', 'Upgrade', 'manage_options', "cp_calculated_fields_form_sub3", array($this, 'admin_pages') );

		} // End admin_menu

		/**
		 * Loads the corresponding pages in the WordPress or redirects the user to the external URLs.
		 *
		 * Loads the webpage with the list of forms, addons activation, general settings, etc.
		 * or redirects to external webpages like plugin's documentation
		 *
		 * @since 1.0.181
		 */
		public function admin_pages()
		{
			// Settings page of the plugin
			if (isset($_GET["cal"]) && $_GET["cal"] != '')
			{
				@include_once CP_CALCULATEDFIELDSF_BASE_PATH . '/inc/cpcff_admin_int.inc.php';
			}
			else
			{
				// Redirecting outer website
				if (isset($_GET["page"]) && $_GET["page"] == 'cp_calculated_fields_form_sub3')
				{
					if(@wp_redirect('https://cff.dwbooster.com/download')) exit;
				}
				else if (isset($_GET["page"]) && $_GET["page"] == 'cp_calculated_fields_form_sub2')
				{
					if(@wp_redirect('https://cff.dwbooster.com/documentation')) exit;
				}
				else if (isset($_GET["page"]) && $_GET["page"] == 'cp_calculated_fields_form_sub4')
				{
					if(@wp_redirect('https://wordpress.org/support/plugin/calculated-fields-form#new-post')) exit;
				}
				else
					@include_once CP_CALCULATEDFIELDSF_BASE_PATH . '/inc/cpcff_admin_int_list.inc.php';
			}
		} // End admin_pages

		/**
		 * Loads the javascript and style files.
		 *
		 * Checks if there is the settings page of the plugin for loading the corresponding JS and CSS files,
		 * or if it is a post or page the script for inserting the shortcodes in the content's editor.
		 *
		 * @since 1.0.171
		 *
		 * @param string $hook.
		 * @return void.
		 */
		public function admin_resources( $hook )
		{
			// Checks if it is the plugin's page
			if(isset($_GET['page']))
			{
				if('cp_calculated_fields_form' == $_GET['page'])
				{
					wp_enqueue_script( "jquery" );
					wp_enqueue_script( "jquery-ui-core" );
					wp_enqueue_script( "jquery-ui-sortable" );
					wp_enqueue_script( "jquery-ui-tabs" );
					wp_enqueue_script( "jquery-ui-droppable" );
					wp_enqueue_script( "jquery-ui-button" );
					wp_enqueue_script( "jquery-ui-datepicker" );
					wp_deregister_script('query-stringify');
					wp_register_script('query-stringify', plugins_url('/js/jQuery.stringify.js', CP_CALCULATEDFIELDSF_MAIN_FILE_PATH));
					wp_enqueue_script( "query-stringify" );

					//ULR to the admin resources
					$admin_resources = admin_url( "admin.php?page=cp_calculated_fields_form&cp_cff_resources=admin" );
					wp_enqueue_script( 'cp_calculatedfieldsf_builder_script', $admin_resources, array("jquery","jquery-ui-core","jquery-ui-sortable","jquery-ui-tabs","jquery-ui-droppable","jquery-ui-button", "jquery-ui-accordion","jquery-ui-datepicker","query-stringify") );
					wp_enqueue_script( 'cp_calculatedfieldsf_builder_script_caret', plugins_url('/js/jquery.caret.js', CP_CALCULATEDFIELDSF_MAIN_FILE_PATH),array("jquery"));
					wp_enqueue_style('cp_calculatedfieldsf_builder_style', plugins_url('/css/style.css', CP_CALCULATEDFIELDSF_MAIN_FILE_PATH));
					wp_enqueue_style('jquery-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
				}
				// Checks if it is to an external page
				elseif(
					in_array(
						$_GET["page"],
						array(
							'cp_calculated_fields_form_sub2',
							'cp_calculated_fields_form_sub3',
							'cp_calculated_fields_form_sub4'
						)
					)
				)
				{
					$cpcff_redirect = array();
					switch($_GET["page"])
					{
						case 'cp_calculated_fields_form_sub2':
							$cpcff_redirect['url'] = 'https://cff.dwbooster.com/documentation';
						break;
						case 'cp_calculated_fields_form_sub3':
							$cpcff_redirect['url'] = 'https://cff.dwbooster.com/download';
						break;
						case 'cp_calculated_fields_form_sub4':
							$cpcff_redirect['url'] = 'https://wordpress.org/support/plugin/calculated-fields-form#new-post';
						break;
					}
					wp_enqueue_script('cp_calculatedfieldsf_redirect_script', plugins_url('/js/redirect_script.js', CP_CALCULATEDFIELDSF_MAIN_FILE_PATH));
					wp_localize_script(
						'cp_calculatedfieldsf_redirect_script',
						'cpcff_redirect',
						$cpcff_redirect
					);
				}
			}

			// Checks if it is a page or post
			if( 'post.php' == $hook  || 'post-new.php' == $hook )
			{
				wp_enqueue_script( 'cp_calculatedfieldsf_script', plugins_url('/js/cp_calculatedfieldsf_scripts.js', CP_CALCULATEDFIELDSF_MAIN_FILE_PATH) );
			}
		} // End admin_resources

		public function form_preview( $atts )
		{
			if(isset($atts['shortcode_atts']))
			{
				error_reporting(E_ERROR|E_PARSE);
				global  $wp_styles, $wp_scripts;
				if(!empty($wp_scripts)) $wp_scripts->reset();
				$message = $this->public_form($atts['shortcode_atts']);
				ob_start();
				if(!empty($wp_styles))  $wp_styles->do_items();
				if(!empty($wp_scripts)) $wp_scripts->do_items();
				if(class_exists('Error'))
				{
					try{ wp_footer(); } catch(Error $err) {}
				}
				$message .= ob_get_contents();
				ob_end_clean();
				$page_title = (!empty($atts['page_title'])) ? $atts['page_title'] : '';
				remove_all_actions('shutdown');
				if(!empty($atts['wp_die']))
				{
					wp_die($message, $page_title, 200);
				}
				elseif(!empty($atts['page']))
				{
					print '<!DOCTYPE html><html><head profile="http://gmpg.org/xfn/11"><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"></head><body>';
					print $message;
					print '</body></html>';
					exit;
				}
				else
				{
					print $message;
					exit;
				}
			}
		} // End form_preview

		/**
		 * Returns the public version of the form wih its resources.
		 *
		 * The method calls the filters: cpcff_pre_form, and cpcff_the_form
		 * @since 1.0.171
		 * @param array $atts includes the attributes required to identify the form, and create the variables.
		 * @return string $content a text with the public version of the form and resources.
		 */
		public function public_form( $atts )
		{
			// If the website is being visited by crawler, display empty text.
			if( CPCFF_AUXILIARY::is_crawler() ) return '';
			if( empty($atts) ) $atts = array();
			if(!$this->_is_admin && $this->_amp->is_amp())
			{
				$content = $this->_amp->get_iframe($atts);
			}
			else
			{
				global $wpdb, $cpcff_default_texts_array;

				if( empty( $atts[ 'id' ] ) ) // if was not passed the form's id get all.
				{
					$myrows = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix.CP_CALCULATEDFIELDSF_FORMS_TABLE );
				}
				else
				{
					$myrows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix.CP_CALCULATEDFIELDSF_FORMS_TABLE." WHERE id=%d",$atts[ 'id' ] ) );
				}

				if( empty( $myrows ) ) return ''; // The form does not exists, or there are no forms.
				$atts[ 'id' ] = $myrows[0]->id; // If was not passed the form's id, uses the if of first form.
				$id = $atts[ 'id' ]; // Alias for the $atts[ 'id' ] variable.

				self::$form_counter++; // Current form

				/**
				 * Filters applied before generate the form,
				 * is passed as parameter an array with the forms attributes, and return the list of attributes
				 */
				$atts = apply_filters( 'cpcff_pre_form',  $atts );

				ob_start();

				// Constant defined to protect the "inc/cpcff_public_int.inc.php" file against direct accesses.
				if ( !defined('CP_AUTH_INCLUDE') ) define('CP_AUTH_INCLUDE', true);

				$this->_public_resources($id); // Load form scripts and other resources

				/* TO-DO: This method should be analyzed after moving other functions to the main class . */
				@include CP_CALCULATEDFIELDSF_BASE_PATH . '/inc/cpcff_public_int.inc.php';

				$content = ob_get_contents();

				// The attributes excepting "id" are converted in javascript variables with a global scope
				if( count( $atts ) > 1 )
				{
					$content .= '<script>';
					foreach( $atts as $i => $v )
					{
						if( $i != 'id' && $i != 'class' && !is_numeric( $i ) )
						{
							$nV = ( is_numeric( $v ) ) ? $v : json_encode( $v ); // Sanitizing the attribute's value
							$content .= $i.'='.$nV.';';
							$content .= 'if(typeof '.$i.'_arr == "undefined") '.$i.'_arr={}; '.$i.'_arr["_'.self::$form_counter.'"]='.$nV.';';
						}
					}
					$content .= '</script>';
				}
				ob_end_clean();

				/**
				 * Filters applied after generate the form,
				 * is passed as parameter the HTML code of the form with the corresponding <LINK> and <SCRIPT> tags,
				 * and returns the HTML code to includes in the webpage
				 */
				$content = apply_filters( 'cpcff_the_form', $content,  $atts[ 'id' ] );
			}

			return $content;
		} // End  public_form

		/**
		 * Creates a javascript variable, from: Post, Get, Session or Cookie or directly.
		 *
		 * If the webpage is visited from a crawler or search engine spider, the shortcode is replaced by an empty text.
		 *
		 * @since 1.0.175
		 * @param array $atts includes the records:
		 *				- name, the variable's name.
		 *				- value, to create a variable splicitly with the value passed as attribute.
		 *				- from, identifies the variable source (POST, GET, SESSION or COOKIE), it is optional.
		 *				- default_value, used in combination with the from attribute to populate the variable
		 *								 with the default value of the source does not exist.
		 *
		 * @return string <script> tag with the variable's definition.
		 */
		public function create_variable_shortcode( $atts )
		{
			if(
				!CPCFF_AUXILIARY::is_crawler() && // Checks for crawlers or search engine spiders
				!empty($atts[ 'name' ]) &&
				($var = trim($atts[ 'name' ])) != ''
			)
			{
				if( isset( $atts[ 'value' ] ) )
				{
					$value = json_encode( $atts[ 'value' ] );
				}
				else
				{
					$from = '_';
					if( isset($atts['from'])) $from .= strtoupper(trim($atts['from']));
					if( in_array( $from, array( '_POST', '_GET', '_SESSION', '_COOKIE' ) ) )
					{
						if( isset( $GLOBALS[ $from ][ $var ] ) ) $value = json_encode($GLOBALS[ $from ][ $var ]);
						elseif( isset( $atts[ 'default_value' ] ) ) $value = json_encode($atts[ 'default_value' ]);
					}
					else
					{
						if( isset( $_POST[ $var ] ) ) 				$value = json_encode($_POST[ $var ]);
						elseif( isset( $_GET[ $var ] ) ) 			$value = json_encode($_GET[ $var ]);
						elseif( isset( $_SESSION[ $var ] ) )		$value = json_encode($_SESSION[ $var ]);
						elseif( isset( $_COOKIE[ $var ] ) ) 		$value = json_encode($_COOKIE[ $var ]);
						elseif( isset( $atts[ 'default_value' ] ) ) $value = json_encode($atts[ 'default_value' ]);
					}
				}
				if(isset( $value ))
				{
					return '
					<script>
						try{
						window["'.esc_js($var).'"]='.$value.';
						}catch( err ){}
					</script>
					';
				}
			}
			return '';
		} // End create_variable_shortcode

		/**
		 * Returns an instance of the active form
		 *
		 * If there is not an active form generates the instance.
		 *
		 * @since 1.0.179
		 * @return object
		 */
		public function get_form( $id )
		{
			if(!isset($this->_forms[$id]))
			{
				$this->_forms[$id] = new CPCFF_FORM($id);
			}
			return $this->_forms[$id];
		} // End get_active_form

		/**
		 * Creates a new form calling the static method CPCFF_FORM::create_default
		 *
		 * @since 1.0.179
		 *
		 * @param string $form_name, the name of form.
		 * @return mixed, an instance of the created form or false.
		 */
		public function create_form($form_name)
		{
			$form = CPCFF_FORM::create_default($form_name);
			if($form) $this->_forms[$form->get_id()] = $form;
			return $form;
		} // End create_form

		/**
		 * Deletes the form.
		 * The methods throw the cpcff_delete_form hook after delete the form.
		 *
		 * @since 1.0.179
		 * @param integer $id, the form's id.
		 * @return mixed, the number of delete rows or false.
		 */
		public function delete_form( $id )
		{
			$deleted = $this->get_form($id)->delete_form();
			if($deleted)
			{
				do_action( 'cpcff_delete_form', $id);
				unset( $this->_forms[$id]);
			}
			return $deleted;
		} // End delete_form

		/**
		 * Clones a form.
		 *
		 * @since 1.0.179
		 * @param integer $id, the form's id.
		 * @return mixed, an instance of cloned form or false.
		 */
		public function clone_form($id)
		{
			if(!isset($this->_forms[$id])) $this->_forms[$id] = new CPCFF_FORM($id);
			$cloned_form = $this->_forms[$id]->clone_form();
			if($cloned_form)
			{
				/**
				 * Passes as parameter the original form's id, and the new form's id
				 */
				do_action( 'cpcff_clone_form', $id, $cloned_form->get_id());
			}
			return $cloned_form;
		} // End clone_form

		/*********************************** PRIVATE METHODS  ********************************************/

		/**
		 * Defines the activativation/deactivation hooks, and new blog hook.
		 *
		 * Requires the cpcff_install_uninstall.inc.php file with the activate/deactivate code, and the code to run with new blogs.
		 *
		 * @sinze 1.0.171
		 * @return void.
		 */
		private function _activate_deactivate()
		{
			require_once CP_CALCULATEDFIELDSF_BASE_PATH.'/inc/cpcff_install_uninstall.inc.php';
			register_activation_hook(CP_CALCULATEDFIELDSF_MAIN_FILE_PATH,array('CPCFF_INSTALLER','install'));
			register_deactivation_hook(CP_CALCULATEDFIELDSF_MAIN_FILE_PATH,array('CPCFF_INSTALLER','uninstall'));
			add_action('wpmu_new_blog', array('CPCFF_INSTALLER', 'new_blog'), 10, 6);
		} // End _activate_deactivate

		/**
		 * Loads the language file.
		 *
		 * Loads the language file associated to the plugin, and creates the textdomain.
		 *
		 * @return void.
		 */
		private function _textdomain()
		{
			load_plugin_textdomain( 'calculated-fields-form', FALSE, dirname( CP_CALCULATEDFIELDSF_BASE_NAME ) . '/languages/' );
		} // End _textdomain

		/**
		 * Loads the controls scripts.
		 *
		 * Checks if there is defined the "cp_cff_resources" parameter, and loads the public or admin scripsts for the controls.
		 * If the scripsts are loaded the plugin exits the PHP execution.
		 *
		 * @return void.
		 */
		private function _load_controls_scrips()
		{
			if( isset( $_REQUEST[ 'cp_cff_resources' ] ) )
			{
				if(!defined('WP_DEBUG') || true != WP_DEBUG)
				{
					error_reporting(E_ERROR|E_PARSE);
				}
				// Set the corresponding header
				if(!headers_sent())
				{
					header("Content-type: application/javascript");
				}

				if(!$this->_is_admin || $_REQUEST[ 'cp_cff_resources' ] == 'public')
				{
					require_once CP_CALCULATEDFIELDSF_BASE_PATH.'/js/fbuilder-loader-public.php';
				}
				else
				{
					require_once CP_CALCULATEDFIELDSF_BASE_PATH.'/js/fbuilder-loader-admin.php';
				}
				remove_all_actions('shutdown');
				exit;
			}
		} // End _load_controls_scrips

		/**
		 * Defines the shortcodes used by the plugin's code:
		 *
		 * - CP_CALCULATED_FIELDS
		 * - CP_CALCULATED_FIELDS_VAR
		 *
		 * @return void.
		 */
		private function _define_shortcodes()
		{
			add_shortcode( 'CP_CALCULATED_FIELDS', array($this,'public_form') );
			add_shortcode( 'CP_CALCULATED_FIELDS_VAR', array($this,'create_variable_shortcode') );
		} // End _define_shortcodes
		/**
		 * Returns a JSON object with the configuration object.
		 *
		 * Uses the global variable $cpcff_default_texts_array, defined in the "config/cpcff_config.cfg.php"
		 *
		 * @sinze 1.0.171
		 * @param int $formid the form's id.
		 * @return string $json
		 */
		private function _get_form_configuration( $formid )
		{
			global $cpcff_default_texts_array;
			$form_obj = $this->get_form($formid);
			$previous_label = $form_obj->get_option('vs_text_previousbtn', 'Previous');
			$previous_label = ( $previous_label=='' ? 'Previous' : $previous_label );
			$next_label = $form_obj->get_option('vs_text_nextbtn', 'Next');
			$next_label = ( $next_label == '' ? 'Next' : $next_label );

			$cpcff_texts_array = $form_obj->get_option('vs_all_texts', $cpcff_default_texts_array);
			$cpcff_texts_array = CPCFF_AUXILIARY::array_replace_recursive(
				$cpcff_default_texts_array,
				( is_string( $cpcff_texts_array ) && is_array( unserialize( $cpcff_texts_array ) ) )
					? unserialize( $cpcff_texts_array )
					: ( ( is_array( $cpcff_texts_array ) ) ? $cpcff_texts_array : array() )
			);

			$obj = array(
					"pub"=>true,
					"identifier"=>'_'.self::$form_counter,
					"messages"=> array(
						"required" => $form_obj->get_option('vs_text_is_required', CP_CALCULATEDFIELDSF_DEFAULT_vs_text_is_required),
						"email" => $form_obj->get_option('vs_text_is_email', CP_CALCULATEDFIELDSF_DEFAULT_vs_text_is_email),
						"datemmddyyyy" => $form_obj->get_option('vs_text_datemmddyyyy', CP_CALCULATEDFIELDSF_DEFAULT_vs_text_datemmddyyyy),
						"dateddmmyyyy" => $form_obj->get_option('vs_text_dateddmmyyyy', CP_CALCULATEDFIELDSF_DEFAULT_vs_text_dateddmmyyyy),
						"number" => $form_obj->get_option('vs_text_number', CP_CALCULATEDFIELDSF_DEFAULT_vs_text_number),
						"digits" => $form_obj->get_option('vs_text_digits', CP_CALCULATEDFIELDSF_DEFAULT_vs_text_digits),
						"max" => $form_obj->get_option('vs_text_max', CP_CALCULATEDFIELDSF_DEFAULT_vs_text_max),
						"min" => $form_obj->get_option('vs_text_min', CP_CALCULATEDFIELDSF_DEFAULT_vs_text_min),
						"previous" => $previous_label,
						"next" => $next_label,
						"pageof" => $cpcff_texts_array[ 'page_of_text' ][ 'text' ],
						"minlength" => $cpcff_texts_array[ 'errors' ][ 'minlength' ][ 'text' ],
						"maxlength" => $cpcff_texts_array[ 'errors' ][ 'maxlength' ][ 'text' ],
						"equalTo" => $cpcff_texts_array[ 'errors' ][ 'equalTo' ][ 'text' ],
						"accept" => $cpcff_texts_array[ 'errors' ][ 'accept' ][ 'text' ],
						"upload_size" => $cpcff_texts_array[ 'errors' ][ 'upload_size' ][ 'text' ],
						"phone" => $cpcff_texts_array[ 'errors' ][ 'phone' ][ 'text' ],
						"currency" => $cpcff_texts_array[ 'errors' ][ 'currency' ][ 'text' ]
					)
				);
				return json_encode( $obj );
		} // End _get_form_configuration

		/**
		 * Loads the javascript and style files used by the public forms.
		 *
		 * Checks if the plugin was configured for loading HTML tags directly, or to use the WordPress functions.
		 *
		 * @since 1.0.171
		 * @param int $formid the form's id.
		 * @return void.
		 */
		private function _public_resources( $formid )
		{
			/* TO-DO: This method should be analyzed after moving other functions to the main class . */
			$public_js_path = (
					get_option( 'CP_CALCULATEDFIELDSF_USE_CACHE', CP_CALCULATEDFIELDSF_USE_CACHE ) &&
					file_exists( CP_CALCULATEDFIELDSF_BASE_PATH.'/js/cache/all.js' )
				) ? plugins_url('/js/cache/all.js', CP_CALCULATEDFIELDSF_MAIN_FILE_PATH)
				  : CPCFF_AUXILIARY::wp_current_url().( ( strpos( CPCFF_AUXILIARY::wp_current_url(),'?' ) === false ) ? '/?' : '&' ).'cp_cff_resources=public&min='.get_option( 'CP_CALCULATEDFIELDSF_USE_CACHE', CP_CALCULATEDFIELDSF_USE_CACHE );

			$config_json = $this->_get_form_configuration($formid);

			if ($GLOBALS['CP_CALCULATEDFIELDSF_DEFAULT_DEFER_SCRIPTS_LOADING'])
			{
				wp_enqueue_script( "jquery" );
				wp_enqueue_script( "jquery-ui-core" );
				wp_enqueue_script( "jquery-ui-button" );
				wp_enqueue_script( "jquery-ui-widget" );
				wp_enqueue_script( "jquery-ui-position" );
				wp_enqueue_script( "jquery-ui-tooltip" );
				wp_enqueue_script( "jquery-ui-datepicker" );
				wp_enqueue_script( "jquery-ui-slider" );

				wp_deregister_script('query-stringify');
				wp_register_script('query-stringify', plugins_url('/js/jQuery.stringify.js', CP_CALCULATEDFIELDSF_MAIN_FILE_PATH), array('jquery'), 'pro');

				wp_deregister_script('cp_calculatedfieldsf_validate_script');
				wp_register_script('cp_calculatedfieldsf_validate_script', plugins_url('/js/jquery.validate.js', CP_CALCULATEDFIELDSF_MAIN_FILE_PATH), array('jquery'), 'pro');
				wp_enqueue_script( 'cp_calculatedfieldsf_builder_script', $public_js_path, array("jquery","jquery-ui-core","jquery-ui-button","jquery-ui-widget","jquery-ui-position","jquery-ui-tooltip","query-stringify","cp_calculatedfieldsf_validate_script", "jquery-ui-datepicker", "jquery-ui-slider"), CP_CALCULATEDFIELDSF_VERSION, true );

				wp_localize_script('cp_calculatedfieldsf_builder_script', 'cp_calculatedfieldsf_fbuilder_config_'.self::$form_counter, array('obj' => $config_json));
			}
			else
			{
				// This code won't be used in most cases. This code is for preventing problems in wrong WP themes and conflicts with third party plugins.
				if( !$this->_are_resources_loaded ) // Load the resources only one time
				{
					$this->_are_resources_loaded = true; // Resources loaded

					$includes_url = includes_url();

					// Used for compatibility with old versions of WordPress
					$prefix_ui = (@file_exists(CP_CALCULATEDFIELDSF_BASE_PATH.'/../../../wp-includes/js/jquery/ui/jquery.ui.core.min.js')) ? 'jquery.ui.' : '';

					if(!wp_script_is('jquery', 'done'))
						print '<script type="text/javascript" src="'.$includes_url.'js/jquery/jquery.js"></script>';
					if(!wp_script_is('jquery-ui-core', 'done'))
						print '<script type="text/javascript" src="'.$includes_url.'js/jquery/ui/'.$prefix_ui.'core.min.js"></script>';
					if(!wp_script_is('jquery-ui-datepicker', 'done'))
						print '<script type="text/javascript" src="'.$includes_url.'js/jquery/ui/'.$prefix_ui.'datepicker.min.js"></script>';
					if(!wp_script_is('jquery-ui-widget', 'done'))
						print '<script type="text/javascript" src="'.$includes_url.'js/jquery/ui/'.$prefix_ui.'widget.min.js"></script>';
					if(!wp_script_is('jquery-ui-position', 'done'))
						print '<script type="text/javascript" src="'.$includes_url.'js/jquery/ui/'.$prefix_ui.'position.min.js"></script>';
					if(!wp_script_is('jquery-ui-tooltip', 'done'))
						print '<script type="text/javascript" src="'.$includes_url.'js/jquery/ui/'.$prefix_ui.'tooltip.min.js"></script>';
					if(!wp_script_is('jquery-ui-mouse', 'done'))
						print '<script type="text/javascript" src="'.$includes_url.'js/jquery/ui/'.$prefix_ui.'mouse.min.js"></script>';
					if(!wp_script_is('jquery-ui-slider', 'done'))
						print '<script type="text/javascript" src="'.$includes_url.'js/jquery/ui/'.$prefix_ui.'slider.min.js"></script>';
				?>
					<script>if( typeof fbuilderjQuery == 'undefined') var fbuilderjQuery = jQuery.noConflict( );</script>
					<script type='text/javascript' src='<?php echo plugins_url('js/jquery.validate.js', CP_CALCULATEDFIELDSF_MAIN_FILE_PATH); ?>'></script>
					<script type='text/javascript' src='<?php echo plugins_url('js/jQuery.stringify.js', CP_CALCULATEDFIELDSF_MAIN_FILE_PATH); ?>'></script>
					<script type='text/javascript' src='<?php echo $public_js_path.(( strpos( $public_js_path, '?' ) == false ) ? '?' : '&' ).'ver='.CP_CALCULATEDFIELDSF_VERSION; ?>'></script>
				<?php
				}
				?>
				<pre style="display:none !important;"><script type='text/javascript'>
					/* <![CDATA[ */
					<?php
						print 'var cp_calculatedfieldsf_fbuilder_config_'.self::$form_counter.'={"obj":'.$config_json.'};';
					?>
					/* ]]> */
				</script></pre>
				<?php
			}
		} // End _public_resources

		/** TROUBLESHOOTS SECTION **/
		public function compatibility_warnings()
		{
			require_once CP_CALCULATEDFIELDSF_BASE_PATH.'/inc/cpcff_compatibility.inc.php';
			return CPCFF_COMPATIBILITY::warnings();
		} // End compatibility_warnings

		private function troubleshoots()
		{
			if(
				!$this->_is_admin &&
				get_option('CP_CALCULATEDFIELDSF_OPTIMIZATION_PLUGIN', CP_CALCULATEDFIELDSF_OPTIMIZATION_PLUGIN)*1
			)
			{
				// Solves a conflict caused by the "Speed Booster Pack" plugin
				add_filter('option_sbp_settings', 'CPCFF_MAIN::speed_booster_pack_troubleshoot');

				// Solves a conflict caused by the "Autoptimize" plugin
				if(
					class_exists('autoptimizeOptionWrapper') &&
					(
						autoptimizeOptionWrapper::get_option( 'autoptimize_js' ) ||
						autoptimizeOptionWrapper::get_option( 'autoptimize_html' )
					)
				)
				{
					$GLOBALS['CP_CALCULATEDFIELDSF_DEFAULT_DEFER_SCRIPTS_LOADING'] = true;
					add_filter( 'autoptimize_js_include_inline', 'CPCFF_MAIN::autoptimize_js_include_inline');
				}

				// Solves a conflict caused by the "WP Rocket" plugin
				add_filter( 'rocket_exclude_js', 'CPCFF_MAIN::rocket_exclude_js' );
				add_filter( 'rocket_exclude_defer_js', 'CPCFF_MAIN::rocket_exclude_js' );
			}
		} // End troubleshoots

		public static function autoptimize_js_include_inline($include_inline)
		{
			return false;
		} // autoptimize_js_include_inline

		public static function speed_booster_pack_troubleshoot($option)
		{
			if(is_array($option) && isset($option['jquery_to_footer'])) unset($option['jquery_to_footer']);
			return $option;
		} // End speed_booster_pack_troubleshoot

		public static function rocket_exclude_js($excluded_js)
		{
			$excluded_js[] = '(.*)/jquery.js';
			return $excluded_js;
		} // End rocket_exclude_js

	} // End CPCFF_MAIN
}