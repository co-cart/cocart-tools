<?php
/**
 * CoCart - Tools controller
 *
 * Handles requests via the /tools endpoint.
 *
 * @author   Sébastien Dumont
 * @category API
 * @package  CoCart Tools/API
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * REST API Tools controller class.
 *
 * @package CoCart Tools/API
 */
class CoCart_Tools_Controller extends CoCart_API_Controller {

	/**
	 * Route base.
	 *
	 * @var string
	 */
	protected $rest_base = 'tools';

	/**
	 * Register routes.
	 *
	 * @access public
	 */
	public function register_routes() {
		// Get Session - cocart/v1/tools/get-session (GET)
		register_rest_route( $this->namespace, '/' . $this->rest_base . '/get-session', array(
			'methods'  => WP_REST_Server::READABLE,
			'callback' => array( $this, 'get_session' )
		) );

		// Destroy Session - cocart/v1/tools/destroy-session (POST)
		register_rest_route( $this->namespace, '/' . $this->rest_base . '/destroy-session', array(
			'methods'  => WP_REST_Server::CREATABLE,
			'callback' => array( $this, 'destroy_session' )
		) );

		// Forget Session - cocart/v1/tools/forget-session (POST)
		register_rest_route( $this->namespace, '/' . $this->rest_base . '/forget-session', array(
			'methods'  => WP_REST_Server::CREATABLE,
			'callback' => array( $this, 'forget_session' )
		) );

		// Clean-up Sessions - cocart/v1/tools/cleanup-sessions (POST)
		register_rest_route( $this->namespace, '/' . $this->rest_base . '/cleanup-sessions', array(
			'methods'  => WP_REST_Server::CREATABLE,
			'callback' => array( $this, 'cleanup_sessions' )
		) );
	} // register_routes()

	/**
	 * Get session.
	 *
	 * @access public
	 * @static
	 * @return WP_REST_Response
	 */
	public static function get_session() {
		$customer_id = WC()->session->get( 'cocart_customer_id' );

		if ( $customer_id > 0 ) {
			$stored_in = 'database';
			$customer_details = new WC_Customer( $customer_id );
		} else {
			$stored_in = 'session';
			$customer_details = new WC_Customer( 0, true );
		}

		$session_data = WC()->session->get_session_data();

		$converted_session_data = array();

		$ignore_convert = array(
			'wc_notices',
		);

		foreach( $session_data as $type => $data ) {
			if ( ! in_array( $type, $ignore_convert ) ) {
				$converted_session_data[ $type ] = unserialize( $data );
			}
		}

		$session_cookies = WC()->session->get_session_cookie();

		$cookies = array();

		foreach( $session_cookies as $key => $value ) {
			if ( $key == 0 ) {
				$cookies[ 'customer_id' ] = $value;
			}
			if ( $key == 1 ) {
				$cookies[ 'session_expiration' ] = $value;
			}
			if ( $key == 2 ) {
				$cookies[ 'session_expiring' ] = $value;
			}
			if ( $key == 3 ) {
				$cookies[ 'cookie_hash' ] = $value;
			}
		}

		return new WP_REST_Response( array(
			'current_user_id' => get_current_user_id(),
			'customer_id'     => $customer_id,
			'loading_from'    => $stored_in,
			'session_cookies' => $cookies,
			'session_data'    => $converted_session_data,
			'cocart_key'      => WC()->session->get( 'cocart_key' ),
			'cocart_email'    => WC()->session->get( 'cocart_email' ),
			'notices'         => wc_get_notices()
		) );
	}

	/**
	 * Destroys all session data for the current user and empties the cart.
	 * This is the same as logging out the current user.
	 *
	 * @access public
	 * @static
	 * @return WP_REST_Response
	 */
	public static function destroy_session() {
		WC()->session->destroy_session();

		return new WP_REST_Response( __( 'Session destroyed', 'cocart-tools' ) );
	}

	/**
	 * Forgets the session data for the current user without destroying it 
	 * and empties the cart.
	 *
	 * @access public
	 * @static
	 * @return WP_REST_Response
	 */
	public static function forget_session() {
		WC()->session->forget_session();

		return new WP_REST_Response( __( 'Session forgotten', 'cocart-tools' ) );
	}

	/**
	 * Clean-up session data from the database and clear caches.
	 *
	 * @access public
	 * @static
	 * @return WP_REST_Response
	 */
	public function cleanup_sessions() {
		WC()->session->cleanup_sessions();

		return new WP_REST_Response( __( 'Sessions cleaned up', 'cocart-tools' ) );
	}

} // END class
