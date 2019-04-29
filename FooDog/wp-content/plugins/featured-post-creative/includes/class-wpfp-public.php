<?php
/**
 * Public Class
 *
 * Handles the public side functionality of plugin
 *
 * @package WP Featured Post
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpfp_Public {
	
	function __construct() {

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wpfp_custom_css'), 20 );
	}

	/**
	 * Add custom css to head
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_custom_css() {

		$custom_css = wpfp_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wpbaw_pro_public = new Wpfp_Public();