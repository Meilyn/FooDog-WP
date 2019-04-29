<?php
/**
 * @description: Class to handle TinyMCE related actions
 */

if ( !class_exists( 'EDS_TinyMCE' ) ):

	class EDS_TinyMCE {	
		
		function add_tinymce_plugin( $plugin_array ){
		
			$plugin_array['edsanimate'] = plugins_url( '/assets/js/edsanimate.tinymce.js', EDS_Animate::$abs_file );
			return $plugin_array;
		
		}
		
		function register_edsanimate_button( $buttons ){
		
			array_push( $buttons, "|", "edsanimate" );
			return $buttons;
		
		}
		
		function refresh_mce( $ver ) {
			
			$ver += 3;			
			return $ver;
		}
		
		function add_edsanimate_button() {
			if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )				
				return;
			
			if ( get_user_option('rich_editing') == 'true') {
				add_filter('mce_external_plugins', array( $this, 'add_tinymce_plugin'  ) );
				add_filter('mce_buttons', array( $this, 'register_edsanimate_button' ) );
			}
		}
		
		function get_popup(){
			
			include_once dirname( EDS_Animate::$abs_file ).'/assets/helper/edsanimate-tinymce-popup.php';
			
			wp_die();
		}	
		
		function add_locale( $locales ) {
			
			$locales['edsanimate'] = plugin_dir_path ( __FILE__ ) . 'eds-tinymce-plugin-langs.php';
			return $locales;
			
		}
	}

	
endif;