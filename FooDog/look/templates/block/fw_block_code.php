<?php

/**
 * Class look_ruby_fw_block_code
 * render has fullwidth block code
 */
if ( ! class_exists( 'look_ruby_fw_block_code' ) ) {
	class look_ruby_fw_block_code extends look_ruby_block {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * render block layout
		 */
		static function render( $block ) {


			//add block data
			$block['block_type']    = 'full_width';
			$block['block_classes'] = 'fw-block fw-block-code';

			$str = '';
			$str .= parent::open_block( $block );
			$str .= '<div class="ruby-container code-header-outer">';
			$str .= parent::render_header( $block );
			$str .= '</div>';
			$str .= self::render_content( $block );
			$str .= parent::close_block();

			return $str;
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * render block block content
		 */
		static function render_content( $block ) {

			//render
			$str = '';

			$str .= parent::open_block_content();

			if ( empty( $block['block_options']['shortcode'] ) ) {
				if ( ! empty( $block['block_options']['custom_html'] ) ) {
					$str .= '<div class="entry">';
					$str .= stripcslashes( $block['block_options']['custom_html'] );
					$str .= '</div>';
				}
			} else {
				$str .= '<div class="shortcode-box-wrap">';
				$str .= do_shortcode( stripcslashes( $block['block_options']['shortcode'] ) );
				$str .= '</div>';
			}

			$str .= parent::close_block_content();

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array
		 * init block options
		 */
		static function block_config() {
			return array(
				'title'       => '',
				'title_color' => true,
				'title_url'   => true,
				'wrap_mode'   => 1,
				'custom_html' => true,
				'shortcode'   => true
			);
		}
	}
}
