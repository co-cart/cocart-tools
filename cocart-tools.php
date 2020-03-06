<?php
/*
 * Plugin Name: CoCart - Tools
 * Plugin URI:  https://cocart.xyz
 * Description: Provides tools to help with testing when developing with CoCart.
 * Author:      Sébastien Dumont
 * Author URI:  https://sebastiendumont.com
 * Version:     1.0.0
 * Text Domain: cocart-tools
 * Domain Path: /languages/
 *
 * WC requires at least: 3.6.0
 * WC tested up to: 3.9.3
 *
 * Copyright: © 2020 Sébastien Dumont, (mailme@sebastiendumont.com)
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! class_exists( 'CoCart_Tools' ) ) {
	class CoCart_Tools {

		/**
		 * @var CoCart_Tools - the single instance of the class.
		 *
		 * @access protected
		 * @static
		 */
		protected static $_instance = null;

		/**
		 * Plugin Version
		 *
		 * @access public
		 * @static
		 */
		public static $version = '1.0.0';

		/**
		 * Required CoCart Version
		 *
		 * @access public
		 * @static
		 */
		public static $required_cocart = '2.0.0';

		/**
		 * Main CoCart Tools Instance.
		 *
		 * Ensures only one instance of CoCart Tools is loaded or can be loaded.
		 *
		 * @access  public
		 * @static
		 * @see     CoCart_Tools()
		 * @return  CoCart_Tools - Main instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Cloning is forbidden.
		 *
		 * @access public
		 * @return void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cloning this object is forbidden.', 'cocart-tools' ), self::$version );
		} // END __clone()

		/**
		 * Unserializing instances of this class is forbidden.
		 *
		 * @access public
		 * @return void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is forbidden.', 'cocart-tools' ), self::$version );
		} // END __wakeup()

		/**
		 * Load the plugin.
		 *
		 * @access public
		 */
		public function __construct() {
			// Setup Constants.
			$this->setup_constants();

			// Include required files.
			add_action( 'init', array( $this, 'includes' ) );

			// Load translation files.
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		} // END __construct()

		/**
		 * Setup Constants
		 *
		 * @access public
		 */
		public function setup_constants() {
			$this->define('COCART_TOOLS_VERSION', self::$version);
			$this->define('COCART_TOOLS_FILE', __FILE__);
			$this->define('COCART_TOOLS_SLUG', 'cocart-tools');
			$this->define('COCART_TOOLS_FILE_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
		} // END setup_constants()

		/**
		 * Define constant if not already set.
		 *
		 * @access private
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		} // END define()

		/**
		 * Includes REST-API Controllers.
		 *
		 * @access public
		 * @return void
		 */
		public function includes() {
			include_once( COCART_TOOLS_FILE_PATH . '/includes/class-cocart-tools-autoloader.php' );
			include_once( COCART_TOOLS_FILE_PATH . '/includes/class-cocart-tools-init.php' );
		} // END includes()

		/**
		 * Make the plugin translation ready.
		 *
		 * Translations should be added in the WordPress language directory:
		 *      - WP_LANG_DIR/plugins/cocart-tools-LOCALE.mo
		 *
		 * @access public
		 * @return void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'cocart-tools', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		} // END load_plugin_textdomain()

	} // END class

} // END if class exists

/**
 * Returns the main instance of CoCart Tools.
 *
 * @return CoCart Tools
 */
function CoCart_Tools() {
	return CoCart_Tools::instance();
}

// Run CoCart Tools
CoCart_Tools();