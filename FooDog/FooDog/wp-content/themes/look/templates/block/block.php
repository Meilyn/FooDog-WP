<?php
/**
 * Class look_ruby_block
 * This file manager block for ruby composer
 */
if ( ! class_exists( 'look_ruby_block' ) ) {
	class look_ruby_block {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return bool|string|WP_Query
		 * query block data
		 */
		static function get_data( $block ) {
			if ( empty( $block['block_options'] ) ) {
				return false;
			}

			//fast query
			if ( ! isset( $block['block_options']['no_found_rows'] ) ) {
				$block['block_options']['no_found_rows'] = true;
			}

			//query
			return look_ruby_query::get_custom_query( $block['block_options'] );
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * open block
		 */
		static function open_block( $block ) {

			//check ID
			if ( empty( $block['block_id'] ) ) {
				return false;
			}

			//create class
			$main_classes    = array();
			$inner_classes   = array();
			$main_classes[]  = 'ruby-block-wrap';
			$inner_classes[] = 'ruby-block-inner';

			//create wrapper classes
			if ( ! empty( $block['block_classes'] ) ) {
				$main_classes[] = $block['block_classes'];
			}

			if ( ! empty( $block['block_options']['block_style'] ) ) {
				$main_classes[] = 'is-dark-style';
			}

			if ( ! empty( $block['block_type'] ) && 'full_width' == $block['block_type'] ) {
				if ( ! empty( $block['block_options']['wrap_mode'] ) && 1 == $block['block_options']['wrap_mode'] ) {
					$main_classes[]  = 'is-wrapper';
					$inner_classes[] = 'ruby-container';
				} else {
					$main_classes[] = 'is-full-width';
				}
			}

			$main_classes  = implode( ' ', $main_classes );
			$inner_classes = implode( ' ', $inner_classes );

			$str = '';

			$str .= '<div id="' . esc_attr( $block['block_id'] ) . '" class="' . esc_attr( $main_classes ) . '">';
			$str .= '<div class="' . esc_attr( $inner_classes ) . '">';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * render block header
		 */
		static function render_header( $block ) {

			//check title
			if ( empty( $block['block_options']['title'] ) ) {
				return false;
			}

			if ( ! empty( $block['block_options']['title_color'] ) ) {
				$style = 'style="color: ' . esc_attr( $block['block_options']['title_color'] ) . '"';
			} else {
				$style = '';
			}

			$str = '';
			$str .= '<div class="block-header-wrap">';
			$str .= '<div class="block-header-inner">';

			//block header title
			if ( empty( $block['block_options']['title_url'] ) ) {
				$str .= '<div class="block-title"><h3 ' . $style . '>' . esc_html( $block['block_options']['title'] ) . '</h3>';
				$str .= '</div>';
			} else {
				$str .= '<div class="block-title"><h3 ' . $style . '><a href="' . esc_url( $block['block_options']['title_url'] ) . '" title="' . esc_attr( $block['block_options']['title'] ) . '">';
				$str .= esc_html( $block['block_options']['title'] );
				$str .= '</a></h3>';
				$str .= '</div>';
			}
			$str .= self::render_view_more( $block );
			$str .= '</div>';
			$str .= '</div><!--#block header-->';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * render block view more text
		 */
		static function render_view_more( $block ) {

			//check title
			if ( empty( $block['block_options']['view_more'] ) ) {
				return false;
			}

			$view_more_text = '';

			if ( ! empty( $block['block_options']['view_more_text'] ) ) {
				$view_more_text = $block['block_options']['view_more_text'];
			}

			if ( ! empty( $block['block_options']['view_more_link'] ) ) {
				$view_more_link = esc_url( $block['block_options']['view_more_link'] );
			} else {
				$view_more_link = '#';
			}

			//render
			$str = '';
			$str .= '<div class="block-view-more">';
			$str .= '<a href="' . $view_more_link . '" title="' . esc_attr( $view_more_text ) . '">';
			$str .= esc_html( $view_more_text );
			$str .= '<i class="fa fa-long-arrow-right"></i>';
			$str .= '</a>';
			$str .= '</div>';

			return $str;


		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes_name
		 *
		 * @return string
		 * open block content wrap
		 */
		static function open_block_content( $classes_name = '' ) {
			$look_ruby_classes   = array();
			$look_ruby_classes[] = 'block-content-wrap';
			if ( ! empty( $classes_name ) ) {
				$look_ruby_classes[] = $classes_name;
			}
			$look_ruby_classes = implode( ' ', $look_ruby_classes );

			return '<div class="' . esc_attr( $look_ruby_classes ) . '">';
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * close block content
		 */
		static function close_block_content() {
			return '</div><!-- #block content-->';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * close block
		 */
		static function close_block() {
			return '</div></div><!-- #block wrap-->';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * no content post found
		 */
		static function no_content() {

			return '<div class="ruby-error"><h3>' . esc_attr__( 'Sorry, Posts you requested could not be found...', 'look' ) . '</h3></div>';
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * not enough for post
		 */
		static function not_enough_post() {

			return '<div class="ruby-error"><h3>' . esc_attr__( 'Sorry, Not enough posts for this block, please try to add more posts...', 'look' ) . '</h3></div>';
		}
	}
}
