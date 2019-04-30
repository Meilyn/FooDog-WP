<?php
/**
 * this file support multi sidebars
 */
if ( ! class_exists( 'look_ruby_multi_sidebar' ) ) {
	class look_ruby_multi_sidebar {


		/**-------------------------------------------------------------------------------------------------------------------------
		 * save sidebar to database
		 */
		static function save_custom_sidebar() {

			//theme options
			global $look_ruby_theme_options;

			$sidebar_data   = array();
			$sidebar_data[] = array(
				'id'   => 'look_ruby_sidebar_default',
				'name' => esc_html__( 'Default Sidebar', 'look' ),
			);

			//add to array data
			if ( ! empty( $look_ruby_theme_options['look_ruby_multi_sidebar'] ) && is_array( $look_ruby_theme_options['look_ruby_multi_sidebar'] ) ) {
				foreach ( $look_ruby_theme_options['look_ruby_multi_sidebar'] as $sidebar ) {
					array_push( $sidebar_data, array(
							'id'   => 'look_ruby_sidebar_multi_' . self::name_to_id( $sidebar ),
							'name' => esc_attr( strip_tags( $sidebar ) ),
						)
					);
				}
			}

			//save to database
			$multi_sidebar = get_option( 'look_ruby_custom_multi_sidebars', '' );
			if ( ! empty( $multi_sidebar ) ) {
				update_option( 'look_ruby_custom_multi_sidebars', $sidebar_data );
			} else {
				add_option( 'look_ruby_custom_multi_sidebars', $sidebar_data );
			}
		}

		//name to id
		static function name_to_id($name)
		{
			$name = strtolower(strip_tags($name));
			$id = str_replace(array(' ', ',', '.', '"', "'", '/', "\\", '+', '=', ')', '(', '*', '&', '^', '%', '$', '#', '@', '!', '~', '`', '<', '>', '?', '[', ']', '{', '}', '|', ':',), '', $name);
			return $id;
		}
	}
}

// save multi sidebar actions
add_action( 'after_switch_theme', array( 'look_ruby_multi_sidebar', 'save_custom_sidebar' ) );
add_action( 'redux/options/look_ruby_theme_options/saved', array( 'look_ruby_multi_sidebar', 'save_custom_sidebar' ) );
add_action( 'redux/options/look_ruby_theme_options/reset', array( 'look_ruby_multi_sidebar', 'save_custom_sidebar' ) );
add_action( 'redux/options/look_ruby_theme_options/section/reset', array( 'look_ruby_multi_sidebar', 'save_custom_sidebar' ) );

