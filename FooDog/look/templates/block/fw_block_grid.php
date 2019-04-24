<?php

/**
 * Class look_ruby_fw_block_grid
 * render fw block grid
 */
if ( ! class_exists( 'look_ruby_fw_block_grid' ) ) {
	class look_ruby_fw_block_grid extends look_ruby_block {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * render block layout
		 */
		static function render( $block ) {


			//add block data
			$block['block_type']                      = 'full_width';
			$block['block_classes']                   = 'fw-block fw-block-grid';
			$block['block_options']['wrap_mode']      = 1;
			$block['block_options']['posts_per_page'] = 5;

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
			$data_query    = parent::get_data( $block );
			$counter       = 1;
			$counter_right = 1;
			//render
			$str = '';
			$str .= parent::open_block_content();

			//check empty
			if ( empty( $data_query->post_count ) ) {
				$str .= parent::no_content();
			} else {
				ob_start();
				?>
				<div class="row">
					<?php while ($data_query->have_posts()) : ?>
					<?php $data_query->the_post(); ?>
					<?php if (1 == $counter) : ?>
					<div class="is-left-col col-sm-7 col-xs-12">
						<?php get_template_part( 'templates/module/layout', 'classic_lite_1' ); ?>
					</div>
					<!--#is left col -->
					<div class="is-right-col col-sm-5 col-xs-12">
						<?php else: ?>
							<div class="is-right-col-el col-xs-6">
								<?php get_template_part( 'templates/module/layout', 'grid_small_s_lite' ); ?>
							</div>
							<?php
							if ( $counter_right % 2 == 0 ) {
								look_ruby_template_part::render_divider();
							};
							$counter_right ++;
							?>
						<?php
						endif; ?>
						<?php $counter ++; ?>
						<?php endwhile; ?>
					</div>
					<!--#is right col -->
				</div>
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
				'offset'         => true,
				'view_more'      => true,
				'view_more_text' => true,
				'view_more_link' => true
			);
		}
	}
}
