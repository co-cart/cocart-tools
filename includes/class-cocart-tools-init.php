<?php
/**
 * CoCart Tools REST API
 *
 * Handles endpoints requests for /tools/
 *
 * @author   Sébastien Dumont
 * @category API
 * @package  CoCart Tools/API
 * @license  GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CoCart Tools REST API class.
 */
class CoCart_Tools_Rest_API {

	/**
	 * Setup class.
	 *
	 * @access public
	 */
	public function __construct() {
		$this->init();
	} // END __construct()

	/**
	 * Init CoCart Tools REST API.
	 *
	 * @access private
	 */
	private function init() {
		// REST API was included starting WordPress 4.4.
		if ( ! class_exists( 'WP_REST_Server' ) ) {
			return;
		}

		// Include REST API Controllers.
		add_action( 'rest_api_init', array( $this, 'rest_api_includes' ), 10 );

		// Register CoCart Tools  REST API routes.
		add_action( 'rest_api_init', array( $this, 'register_routes' ), 11 );
	}

	/**
	 * Include CoCart Tools REST API controllers.
	 *
	 * @access public
	 */
	public function rest_api_includes() {
		include_once( dirname( __FILE__ ) . '/api/class-cocart-tools-controller.php' );
	}

	/**
	 * Register CoCart Tools REST API routes.
	 *
	 * @access public
	 */
	public function register_routes() {
		$controllers = array(
			'CoCart_Tools_Controller'
		);

		foreach ( $controllers as $controller ) {
			$this->$controller = new $controller();
			$this->$controller->register_routes();
		}
	}

} // END class

return new CoCart_Tools_Rest_API();
