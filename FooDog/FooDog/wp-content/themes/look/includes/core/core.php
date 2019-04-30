<?php
/**
 * Class look_ruby_core
 * this file manager options for theme
 */
if ( ! class_exists( 'look_ruby_core' ) ) {
	class look_ruby_core {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $option_name
		 *
		 * @return string
		 * load value from theme options
		 */
		static function get_option( $option_name ) {

			if ( empty( $GLOBALS['look_ruby_theme_options'] ) ) {
				$GLOBALS['look_ruby_theme_options'] = look_ruby_redux_default_val();
			}

			$look_ruby_theme_options = $GLOBALS['look_ruby_theme_options'];

			//check empty value
			if ( empty( $look_ruby_theme_options[ $option_name ] ) ) {
				return false;
			} else {
				//return option value
				return $look_ruby_theme_options[ $option_name ];
			}
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $number
		 *
		 * @return int|string
		 * show over 100k
		 */
		static function show_over_100k( $number ) {
			$number = intval( $number );
			if ( $number > 100000 ) {
				$number = round( $number / 1000, 1 ) . esc_attr__( 'k', 'look' );
			}

			return $number;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return mixed
		 * get category page id
		 */
		static function get_page_cat_id() {
			global $wp_query;

			return $wp_query->get_queried_object_id();
		}
	}
}
