<?php
/**
 * Class look_ruby_template_wrapper
 * This file render wrapper for page and single
 */

if ( ! class_exists( 'look_ruby_template_wrapper' ) ) {
	class look_ruby_template_wrapper {


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes_name
		 * @param string $sidebar_position
		 * @param bool $disable_wrapper
		 * open page wrap
		 */
		static function open_page_wrap( $classes_name = '', $sidebar_position = '', $disable_wrapper = false ) {

			//create wrap class
			$classes   = array();
			$classes[] = 'ruby-page-wrap ruby-section row';
			$classes[] = esc_attr( $classes_name );
			$classes[] = 'is-sidebar-' . esc_attr( $sidebar_position );
			if ( false === $disable_wrapper ) {
				$classes[] = 'ruby-container';
			}
			$classes = implode( ' ', $classes );

			//render
			echo '<div class="' . esc_attr( $classes ) . '">';

		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * close page wrap
		 */
		static function close_page_wrap() {
			echo '</div><!--#page wrap-->';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes_name
		 * @param string $sidebar_position
		 * @param string $blog_layout
		 * @param bool $big_first
		 * open page inner
		 */
		static function open_page_inner( $classes_name = '', $sidebar_position = '' ) {

			//create wrap class
			$classes   = array();
			$classes[] = 'ruby-content-wrap';
			$classes[] = esc_attr( $classes_name );
			if ( 'none' == $sidebar_position ) {
				$classes[] = 'content-without-sidebar col-xs-12';
			} else {
				$classes[] = 'col-sm-8 col-xs-12 content-with-sidebar clearfix';
			};

			$classes = implode( ' ', $classes );

			//render
			echo '<div class="' . esc_attr( $classes ) . '">';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * close page inner
		 */
		static function close_page_inner() {
			echo '</div><!--#page inner-->';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $class
		 * @param bool $review
		 * render open single tag
		 */
		static function open_single_wrap( $classes_name = '', $review = false ) {

			if ( false === $review ) {
				echo '<article class="' . implode( ' ', get_post_class( esc_attr( $classes_name ) ) ) . '" ' . look_ruby_schema::markup( 'article', false ) . '>';
			} else {
				echo '<article class="' . implode( ' ', get_post_class( esc_attr( $classes_name ) ) ) . '" ' . look_ruby_schema::markup( 'review', false ) . '>';
			}
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * render close single tag
		 */
		static function close_single_wrap() {
			echo '</article><!--#single post wrap -->';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param      $name
		 * @param bool $disable_markup
		 * render sidebar
		 */
		static function sidebar( $name, $disable_markup = false ) {

			//sticky config
			$sticky = look_ruby_core::get_option( 'sticky_sidebar' );

			//markup
			if ( false === $disable_markup ) {
				$markup = look_ruby_schema::markup( 'sidebar', false );
			} else {
				$markup = '';
			}

			if ( ! empty( $sticky ) ) {
				echo '<div id="sidebar" class="sidebar-wrap col-sm-4 col-xs-12 clearfix" ' . esc_attr( $markup ) . '><div class="ruby-sidebar-sticky">';
				echo '<div class="sidebar-inner">';
				if ( is_active_sidebar( $name ) ) {
					dynamic_sidebar( $name );
				}
				echo '</div><!--#sidebar inner-->';
				echo '</div></div><!--#close sidebar -->';
			} else {
				echo '<div id="sidebar" class="sidebar-wrap col-sm-4 col-xs-12 clearfix" ' . esc_attr( $markup ) . '>';
				echo '<div class="sidebar-inner">';
				if ( is_active_sidebar( $name ) ) {
					dynamic_sidebar( $name );
				}
				echo '</div><!--#sidebar inner-->';
				echo '</div><!--#close sidebar -->';
			}
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 *  open blog wrapper
		 */
		static function open_blog_content_wrap() {
			echo '<div class="blog-content-wrap row">';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * close blog content wrap
		 */
		static function close_blog_content_wrap() {

			echo '</div><!--#blog content wrap -->';
		}

	}
}