<?php

/**
 * Class look_ruby_fw_block_slider_hw
 * render full width slider has wrap
 */
if ( ! class_exists( 'look_ruby_fw_block_slider_hw' ) ) {
	class look_ruby_fw_block_slider_hw extends look_ruby_block {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * render block layout
		 */
		static function render( $block ) {


			//add block data
			$block['block_type']                 = 'full_width';
			$block['block_classes']              = 'fw-block fw-block-slider-hw';
			$block['block_options']['wrap_mode'] = 1;

			$str = '';
			$str .= parent::open_block( $block );
			$str .= parent::render_header( $block );
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
			//query data
			$data_query = parent::get_data( $block );

			//render
			$str = '';
			$str .= parent::open_block_content();

			//check empty
			if ( empty( $data_query->post_count ) ) {
				$str .= parent::no_content();
			} else {
				ob_start();
				?>

				<div class="slider-wrap is-hw-slider">
					<div class="slider-loading"></div>
					<div class="ruby-slider-hw slider-init">
						<?php while ( $data_query->have_posts() ) : ?>
							<?php $data_query->the_post(); ?>
							<?php get_template_part( 'templates/module/hw', 'slider' ); ?>
						<?php endwhile; ?>
					</div>
					<div class="ruby-slider-hw-nav slider-init">
						<?php while ( $data_query->have_posts() ) : ?>
							<?php $data_query->the_post(); ?>
							<?php get_template_part( 'templates/module/layout', 'grid_small_s' ); ?>
						<?php endwhile; ?>
					</div>
				</div><!--#hw slider -->

				<?php

				$str .= ob_get_clean();
			}

			$str .= parent::close_block_content();

			//reset post data
			wp_reset_postdata();

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array
		 * init block options
		 */
		static function block_config() {
			return array(
				'title'          => '',
				'title_color'    => true,
				'title_url'      => true,
				'category_id'    => true,
				'category_ids'   => true,
				'tags'           => true,
				'post_format'    => true,
				'authors'        => true,
				'orderby'        => true,
				'posts_per_page' => 6,
				'offset'         => true
			);
		}
	}
}
