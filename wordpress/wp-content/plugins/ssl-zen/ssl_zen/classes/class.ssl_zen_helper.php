<?php

if ( ! class_exists( 'ssl_zen_helper' ) ) {

	/**
	 * Class to implement useful functionality across the plugin
	 *
	 * @since 2.0
	 */
	class ssl_zen_helper {

		/**
		 * Couple minor steps to check if the website installed locally or the host name is IP address
		 */
		public static function checkIfWebsiteInstalledLocally() {
			if ( SSL_ZEN_PLUGIN_ALLOW_DEV ) {
				return false;
			}

			return (bool) ip2long( $_SERVER['HTTP_HOST'] ) || $_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['SERVER_ADDR'] == '::1';
		}

		/**
		 * Check if tab is available in current stage
		 *
		 * @param $currentTab
		 * @param $tab
		 * @param $allowedTabs
		 *
		 * @return bool
		 */
		public static function isTabAvailableAtThisStage( $currentTab, $tab, $allowedTabs ) {
			return ! empty( $allowedTabs[ $currentTab ] ) && is_array( $allowedTabs[ $currentTab ] ) && in_array( $tab, $allowedTabs[ $currentTab ] );
		}

		/**
		 * Get system requirements status
		 */
		public static function getSystemRequirementsStatus() {
			return [
				'php'     => version_compare( phpversion(), '5.6.2' ) !== - 1,
				'curl'    => function_exists( 'curl_version' ),
				'openssl' => extension_loaded( 'openssl' )
			];
		}

		/**
		 * Get cURL version if it is enabled
		 *
		 * @return array|string
		 */
		public static function getCurlVersion() {
			if ( function_exists( 'curl_version' ) ) {
				$versionArr = curl_version();

				return $versionArr['version'];
			} else {
				return '-';
			}
		}

		/**
		 * Get allow_url_fopen value
		 *
		 * @return string
		 */
		public static function getAllowUrlFOpenActiveStatus() {
			return ! empty( ini_get( 'allow_url_fopen' ) ) ? 'On' : 'No';
		}

		/**
		 * Get shell_exec availability
		 *
		 * @return string
		 */
		public static function getShellExecStatus() {
			return function_exists( 'shell_exec' ) ? 'Available' : 'No';
		}

		/**
		 * Get SSL installation status
		 *
		 * @return string
		 */
		public static function getSslInstallationStatus() {
			if ( ! empty( ssl_zen_certificate::verifyssl( get_option( 'ssl_zen_base_domain', '' ) ) ) ) {
				return 'Successfully installed';
			}

			return 'No';
		}

		/**
		 * Get SSL version
		 *
		 * @return string
		 */
		public static function getSSLversion() {
			return ! empty( OPENSSL_VERSION_TEXT ) ? OPENSSL_VERSION_TEXT : '-';
		}

		/**
		 * Check weather cUrl enabled
		 */
		public static function getCurlActiveStatus() {
			return function_exists( 'curl_version' ) ? __( 'Enabled', 'ssl-zen' ) : 'No';
		}

		/**
		 * Get current server version
		 */
		public static function getServerVersion() {
			return ! empty( $_SERVER['SERVER_SOFTWARE'] ) ? $_SERVER['SERVER_SOFTWARE'] : '-';
		}

		/**
		 * Get cPanel version if is installed on the server
		 */
		public static function getCPanelVersion() {
			return '-';
		}

		/**
		 * Check weather to show steps
		 *
		 * @param $stage
		 *
		 * @return bool
		 */
		public static function stageIsStep( $stage ) {
			return strpos( $stage, 'step' ) !== false;
		}

		/**
		 * @param $stage
		 * @param $allowedTabs
		 * @param $layout
		 *
		 * @return mixed
		 */
		public static function showLayoutPart( $stage, $allowedTabs, $layout ) {
			return isset( $allowedTabs[ $stage ]['layout'] ) ? $allowedTabs[ $stage ]['layout'][ $layout ] : false;
		}

		/**
		 * Function to check the current site cPanel availability.
		 *
		 * @return bool
		 */
		public static function checkCPanelAvailabilityOfCurrentSite() {
			$url      = is_ssl() ? 'https://localhost:2083' : 'http://localhost:2082';
			$response = wp_remote_get( $url, [
				'headers'   => [
					'Connection' => 'close'
				],
				'sslverify' => false
			] );

			if ( is_wp_error( $response ) ) {
				return false;
			} else {
				return true;
			}
		}

		/**
		 * Function to delete all the files and folders within a directory
		 *
		 * @param string $str
		 * @param bool $root
		 *
		 * @since 1.0
		 * @static
		 */
		public static function deleteAll( $str, $root = true ) {
			// It it's a file.
			if ( is_file( $str ) ) {
				// Attempt to delete it.
				unlink( $str );
			} // If it's a directory.
			elseif ( is_dir( $str ) ) {
				// Get a list of the files in this directory.
				$scan = glob( rtrim( $str, '/' ) . '/*' );

				// Loop through the list of files.
				foreach ( $scan as $index => $path ) {
					// Call our recursive function.
					self::deleteAll( $path, false );
					//Remove the directory itself.
				}

				if ( ! $root ) {
					@rmdir( $str );
				}
			}
		}

		/**
		 * Method for getting server status fields
		 *
		 * @return array
		 * @since 2.0
		 */
		public static function getServerStatusFields() {
			return [
				'Primary Domain'  => get_option( 'ssl_zen_base_domain', '' ),
				'IP Address'      => $_SERVER['SERVER_ADDR'], // gethostbyname(get_option( 'ssl_zen_base_domain', '' ));
				// 'cPanel Version'  => self::getCPanelVersion(),
				'Server'          => self::getServerVersion(),
				'PHP version'     => phpversion(),
				'cURL support'    => self::getCurlActiveStatus(),
				'allow_url_fopen' => self::getAllowUrlFOpenActiveStatus(),
				'shell_exec'      => self::getShellExecStatus(),
				'SSL version'     => self::getSSLversion(),
				'Home Directory'  => get_home_path()
			];
		}

		/**
		 * Method for getting WordPress status fields
		 *
		 * @return array
		 * @since 2.0
		 */
		public static function getWordPressStatusFields() {
			global $wp_version;

			return [
				'WordPress address (URL)' => get_option( 'home', '' ),
				'Site address (URL)'      => get_option( 'siteurl', '' ),
				'WordPress version'       => $wp_version,
				'SSL installed'           => self::getSslInstallationStatus(),
				'Plugin version'          => SSL_ZEN_PLUGIN_VERSION
			];
		}

		/**
		 * Check weather the base domain contains www sub domain
		 *
		 * @param $baseDomain
		 *
		 * @return bool
		 * @since 2.0.4
		 *
		 */
		public static function checkWWWSubDomainExistence( $baseDomain ) {
			return strpos( $baseDomain, 'www.' ) === 0;
		}

		/**
		 * Log message.
		 *
		 * @param $msg
		 *
		 */
		public static function log( $msg ) {
			if ( SSL_ZEN_PLUGIN_ALLOW_DEBUG ) {
				error_log( $msg );
			}
		}

	}
}