<?php
/**----------------------------------------------------------------------
 * @param $block
 *
 * @return mixed
 * render blocks
 */
if ( ! class_exists( 'look_ruby_composer_block' ) ) {
	class look_ruby_composer_block {
		static function render( $section, $block ) {
			if ( 'section_full_width' == $section ) {
				switch ( $block['block_name'] ) {

					case 'look_ruby_fw_block_ad_box' : {
						return look_ruby_fw_block_ad_box::render( $block );
					}

					case 'look_ruby_fw_block_code' : {
						return look_ruby_fw_block_code::render( $block );
					}

					case 'look_ruby_fw_block_slider_fw' : {
						return look_ruby_fw_block_slider_fw::render( $block );
					}

					case 'look_ruby_fw_block_slider_hw' : {
						return look_ruby_fw_block_slider_hw::render( $block );
					}

					case 'look_ruby_fw_block_carousel' : {
						return look_ruby_fw_block_carousel::render( $block );
					}

					case 'look_ruby_fw_block_grid' : {
						return look_ruby_fw_block_grid::render( $block );
					}

					case 'look_ruby_fw_block_video' : {
						return look_ruby_fw_block_video::render( $block );
					}

					case 'look_ruby_fw_block_1' : {
						return look_ruby_fw_block_1::render( $block );
					}

					case 'look_ruby_fw_block_2' : {
						return look_ruby_fw_block_2::render( $block );
					}

					case 'look_ruby_fw_block_3' : {
						return look_ruby_fw_block_3::render( $block );
					}

					case 'look_ruby_fw_block_4' : {
						return look_ruby_fw_block_4::render( $block );
					}

					default :
						return false;
				}
			} else {
				switch ( $block['block_name'] ) {

					case 'look_ruby_hs_block_ad_box' : {
						return look_ruby_hs_block_ad_box::render( $block );
					}

					case 'look_ruby_hs_block_code' : {
						return look_ruby_hs_block_code::render( $block );
					}

					case 'look_ruby_hs_block_1' : {
						return look_ruby_hs_block_1::render( $block );
					}

					case 'look_ruby_hs_block_2' : {
						return look_ruby_hs_block_2::render( $block );
					}

					case 'look_ruby_hs_block_3' : {
						return look_ruby_hs_block_3::render( $block );
					}

					case 'look_ruby_hs_block_7' : {
						return look_ruby_hs_block_7::render( $block );
					}

					case 'look_ruby_hs_block_5' : {
						return look_ruby_hs_block_5::render( $block );
					}

					case 'look_ruby_hs_block_6' : {
						return look_ruby_hs_block_6::render( $block );
					}

					case 'look_ruby_hs_block_4' : {
						return look_ruby_hs_block_4::render( $block );
					}

					case 'look_ruby_hs_block_8' : {
						return look_ruby_hs_block_8::render( $block );
					}

					default :
						return false;
				}
			}
		}
	}
}

