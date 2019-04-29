<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Featured Post
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpfp_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpfp_front_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wpfp_admin_script') );

	}
	
	/**
	 * Function to add style at front side
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_front_style() {
		
		// Registring and enqueing public css
		wp_register_style( 'wpfp-public-style', WPFP_URL.'assets/css/wpfp-public.css', array(), WPFP_VERSION );
		wp_enqueue_style( 'wpfp-public-style' );

	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpfp_admin_script( $hook ) {
		
		global $wp_version, $post_type;

		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts

		// Pages array
		$pages_array = array(WPFP_POST_TYPE);

		// If page is plugin setting page then enqueue script
		if( in_array($post_type, $pages_array) ) {

			// Registring admin script
			wp_register_script( 'wpfp-admin-js', WPFP_URL.'assets/js/wpfp-admin.js', array('jquery'), WPFP_VERSION, true );
			wp_enqueue_script( 'wpfp-admin-js' );
		}
	}

}

$wpfp_script = new Wpfp_Script();