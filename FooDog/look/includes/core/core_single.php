<?php

/**
 * Class look_ruby_single
 * This file support feature for single post & page
 */
if ( ! class_exists( 'look_ruby_single' ) ) {
	class look_ruby_single {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return mixed|string
		 * get sidebar position post
		 */
		static function get_sidebar_position_post() {

			//sidebar position
			$post_id          = get_the_ID();
			$sidebar_position = get_post_meta( $post_id, 'look_ruby_single_sidebar_position', true );

			//override sidebar position
			if ( 'default' == $sidebar_position || empty( $sidebar_position ) ) {
				$sidebar_position = look_ruby_core::get_option( 'default_single_post_sidebar_position' );
				if ( 'default' == $sidebar_position ) {
					$sidebar_position = look_ruby_core::get_option( 'site_sidebar_position' );
				}
			}

			return $sidebar_position;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return mixed|string
		 * get sidebar position setting
		 */
		static function get_sidebar_position_page() {

			//sidebar position
			$post_id          = get_the_ID();
			$sidebar_position = get_post_meta( $post_id, 'look_ruby_single_sidebar_position', true );

			//override sidebar position
			if ( 'default' == $sidebar_position || empty( $sidebar_position ) ) {
				$sidebar_position = look_ruby_core::get_option( 'default_single_page_sidebar_position' );

				if ( 'default' == $sidebar_position ) {
					$sidebar_position = look_ruby_core::get_option( 'site_sidebar_position' );
				}
			}

			return $sidebar_position;
		}




		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param bool $disable_makeup
		 * render single post sidebar
		 */
		static function get_sidebar_name_post() {

			//check
			$sidebar_position = self::get_sidebar_position_post();
			if ( 'none' == $sidebar_position ) {
				return false;
			}

			$all_sidebar = look_ruby_theme_config::sidebar_name( true );

			//single sidebar name
			$sidebar_name = get_post_meta( get_the_ID(), 'look_ruby_single_sidebar', true );

			if ( ! array_key_exists( $sidebar_name, $all_sidebar ) ) {
				$sidebar_name = 'look_ruby_default_from_theme_options';
			}
			if ( 'look_ruby_default_from_theme_options' == $sidebar_name || empty( $sidebar_name ) ) {
				$sidebar_name = look_ruby_core::get_option('default_single_post_sidebar');
			}

			return $sidebar_name;
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param bool $disable_makeup
		 * render single sidebar
		 */
		static function get_sidebar_name_page() {

			//check
			$sidebar_position = self::get_sidebar_position_page();
			if ( 'none' == $sidebar_position ) {
				return false;
			}

			$all_sidebar = look_ruby_theme_config::sidebar_name( true );

			//single sidebar name
			$sidebar_name = get_post_meta( get_the_ID(), 'look_ruby_single_sidebar', true );
			if ( ! array_key_exists( $sidebar_name, $all_sidebar ) ) {
				$sidebar_name = 'look_ruby_default_from_theme_options';
			}
			if ( 'look_ruby_default_from_theme_options' == $sidebar_name || empty( $sidebar_name ) ) {
				$sidebar_name = look_ruby_core::get_option('default_single_page_sidebar');
			}

			return $sidebar_name;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return mixed|string
		 * get first_paragraph setting
		 */
		static function check_comment_box_post() {

			$look_ruby_comment_box = get_post_meta( get_the_ID(), 'look_ruby_single_box_comment', true );
			if ( 'default' == $look_ruby_comment_box || empty( $look_ruby_comment_box ) ) {
				$look_ruby_comment_box = look_ruby_core::get_option( 'default_single_post_box_comment' );
			};

			return $look_ruby_comment_box;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return mixed|string
		 * get first_paragraph setting
		 */
		static function check_comment_box_page() {

			$look_ruby_comment_box = get_post_meta( get_the_ID(), 'look_ruby_single_box_comment', true );
			if ( 'default' == $look_ruby_comment_box || empty( $look_ruby_comment_box ) ) {
				$look_ruby_comment_box = look_ruby_core::get_option( 'default_single_page_box_comment' );
			};

			return $look_ruby_comment_box;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return mixed|string
		 * check page title
		 */
		static function check_page_title() {

			if( ! is_singular()){
				return false;
			}

			$page_title = get_post_meta( get_the_ID(), 'look_ruby_page_title', true );
			if ( 'default' == $page_title || empty( $page_title ) ) {
				$page_title = look_ruby_core::get_option( 'default_single_page_title' );
			}

			return $page_title;
		}
	}
}
