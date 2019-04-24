<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * add tinymce to wysywyg
 */
if ( ! function_exists( 'look_ruby_add_tinymce' ) ) {

	function look_ruby_add_tinymce() {

		if ( ! class_exists( 'look_ruby_plugin_core' ) ) {
			return false;
		}

		global $typenow;

		if ( 'post' != $typenow && 'page' != $typenow ) {
			return false;
		}

		add_filter( 'mce_buttons', 'look_ruby_tinymce_add_button' );
		add_filter( 'mce_external_plugins', 'look_ruby_tinymce_plugin' );

	}

	add_action( 'admin_head', 'look_ruby_add_tinymce' );
}

if ( ! function_exists( 'look_ruby_tinymce_plugin' ) ) {
	function look_ruby_tinymce_plugin( $plugin_array ) {

		$plugin_array['look_ruby_shortcode'] = get_template_directory_uri() . '/includes/admin/tinymce/tinymce_script.js';

		return $plugin_array;
	}
}

if ( ! function_exists( 'look_ruby_tinymce_add_button' ) ) {
	function look_ruby_tinymce_add_button( $buttons ) {

		array_push( $buttons, 'look_ruby_button_key' );

		return $buttons;
	}
}
