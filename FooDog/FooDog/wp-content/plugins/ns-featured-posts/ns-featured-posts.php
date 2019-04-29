<?php
/**
 * NS Featured Posts Plugin.
 *
 * Plugin Name: NS Featured Posts
 * Plugin URI: https://nilambar.net/2014/07/ns-featured-posts-wordpress-plugin.html
 * Description: Plugin to make your posts, pages and custom post types Featured
 * Version: 1.4.1
 * Author: Nilambar Sharma
 * Author URI: https://nilambar.net
 * Text Domain: ns-featured-posts
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package NS_Featured_Posts
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-ns-featured-posts.php' );
require_once( plugin_dir_path( __FILE__ ) . 'class-ns-featured-posts-admin.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'NS_Featured_Posts', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'NS_Featured_Posts', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'NS_Featured_Posts', 'get_instance' ) );
add_action( 'plugins_loaded', array( 'NS_Featured_Posts_Admin', 'get_instance' ) );
