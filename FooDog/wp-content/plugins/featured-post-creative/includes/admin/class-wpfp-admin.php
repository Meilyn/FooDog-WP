<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP Featured Post
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpfp_Admin {
	
	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wpfp_blog_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this,'wpfp_save_metabox_value') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wpfp_register_menu'), 9 );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this,'wpfp_register_settings') );

		// Filter for post category columns
		add_filter( 'manage_edit-'.WPFP_CAT.'_columns', array($this, 'wpfp_manage_category_columns') );
		add_filter( 'manage_'.WPFP_CAT.'_custom_column', array($this, 'wpfp_category_data'), 10, 3 );

		// Action to add custom column to post listing
		add_filter( 'manage_'.WPFP_POST_TYPE.'_posts_columns', array($this, 'wpfp_posts_columns') );

		// Action to add custom column data to post listing
		add_action('manage_'.WPFP_POST_TYPE.'_posts_custom_column', array($this, 'wpfp_post_columns_data'), 10, 2);

		// Ajax call to update featured post
		add_action( 'wp_ajax_wpfp_update_featured_post', array($this, 'wpfp_update_featured_post'));
		add_action( 'wp_ajax_nopriv_wpfp_update_featured_post',array( $this, 'wpfp_update_featured_post'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wpfp_plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Featured Post Settings Metabox
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_blog_metabox() {
		add_meta_box( 'wpfp-post-sett', __( 'Featured Post Settings', 'featured-post' ), array($this, 'wpfp_sett_mb_content'), WPFP_POST_TYPE, 'side', 'default' );
	}

	/**
	 * Featured Post Settings Metabox HTML
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_sett_mb_content() {
		include_once( WPFP_DIR .'/includes/admin/metabox/wpfp-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  WPFP_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = WPFP_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$featured_box = !empty($_POST[$prefix.'featured_post']) 		? 1	: 0;

		update_post_meta($post_id, $prefix.'featured_post', $featured_box);
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_register_menu() {

		add_menu_page( __('Featured Post Settings', 'featured-post'), __('Featured Post Settings', 'featured-post'), 'manage_options', 'wpfp-about',  array($this, 'wpfp_settings_page'), 'dashicons-sticky', 6 );

		// Register plugin premium page
		add_submenu_page( 'wpfp-about', __('Upgrade to PRO - Featured Post', 'featured-post'), '<span style="color:#2ECC71">'.__('Upgrade to PRO', 'featured-post').'</span>', 'manage_options', 'wpfp-premium', array($this, 'wpfp_premium_page') );
		
		// Register plugin hire us page
		add_submenu_page( 'wpfp-about', __('Hire Us', 'featured-post'), '<span style="color:#2ECC71">'.__('Hire Us', 'featured-post').'</span>', 'manage_options', 'wpfp-hireus', array($this, 'wpfp_hireus_page') );

	}

	/**
	 * Function register setings
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_register_settings() {
		register_setting( 'wpfp_plugin_options', 'wpfp_options', array($this, 'wpfp_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_validate_options( $input ) {
		
		$input['custom_css'] = isset($input['custom_css'])	? sanitize_textarea_field( $input['custom_css'] ) : '';
		
		return $input;
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_settings_page() {
		include_once( WPFP_DIR . '/includes/admin/settings/wpfp-settings.php' );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package WP Featured Post
	 * @since 1.0
	 */
	function wpfp_premium_page() {
		include_once( WPFP_DIR . '/includes/admin/settings/premium.php' );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package WP Featured Post
	 * @since 1.4
	 */
	function wpfp_hireus_page() {
		include_once( WPFP_DIR . '/includes/admin/settings/hire-us.php' );
	}

	/**
	 * Add extra column to post category
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_manage_category_columns( $columns ) {

	    $new_columns['wpos_shortcode'] = __( 'Featured Category Shortcode', 'featured-post' );

		$columns = wpfp_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to post category
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_category_data($ouput, $column_name, $tax_id) {

	    if( $column_name == 'wpos_shortcode' ){
			$ouput .= $tax_id;
	    }

	    return $ouput;
	}

	/**
	 * Add custom column to Post listing page for Featured Post  
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_posts_columns( $columns ){

	    $new_columns['wpfp_featured'] = __('Featured Post', 'featured-post');

	    $columns = wpfp_add_array( $columns, $new_columns, 4 );

	    return $columns;
	}

	/**
	 * Add custom column data to post listing page for Featured Post
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_post_columns_data( $column, $post_id ) {

	    if( $column == 'wpfp_featured' ){

	        $prefix = WPFP_META_PREFIX; // Metabox prefix
	        $featured_box = get_post_meta( $post_id, $prefix.'featured_post', true );       
	        $featured_box = (!empty($featured_box)) ? 'dashicons-star-filled' : 'dashicons-star-empty' ;
	        
	       	echo "<div class='wpfp-select-featured dashicons {$featured_box}' data-post-id='{$post_id}' style='cursor: pointer;'></div>";
	    }
	}

	/**
	 * Update Featured post
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_update_featured_post() {

		$prefix = WPFP_META_PREFIX; // Taking metabox prefix

		$result 			= array();
		$result['success'] 	= 0;

		if( !empty($_POST['feat_id']) ) {

			update_post_meta($_POST['feat_id'], $prefix.'featured_post', $_POST['is_feat']);

			$result['success'] 	= 1;
		}
		echo json_encode($result);
		exit;
	}
	

	/**
	 * Function to unique number value
	 * 
	 * @package WP Featured Post
	 * @since 1.0.0
	 */
	function wpfp_plugin_row_meta( $links, $file ) {
		
		if ( $file == WPFP_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('http://wponlinesupport.com/pro-plugin-document/document-featured-post-pro/') . '" title="' . esc_attr( __( 'View Documentation', 'featured-post' ) ) . '" target="_blank">' . __( 'Docs', 'featured-post' ) . '</a>',
				'support' => '<a href="' . esc_url('http://wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'featured-post' ) ) . '" target="_blank">' . __( 'Support', 'featured-post' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

}

$wpbaw_pro_admin = new Wpfp_Admin();