<?php

/**
 * Class look_ruby_hs_block_8
 * render has sidebar block 4
 */
if ( ! class_exists( 'look_ruby_hs_block_8' ) ) {
	class look_ruby_hs_block_8 extends look_ruby_block {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * render block layout
		 */
		static function render( $block ) {


			//add block data
			$block['block_type']                      = 'has_sidebar';
			$block['block_classes']                   = 'hs-block hs-block-8';
			$block['block_options']['posts_per_page'] = 3;

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
			$flag       = true;


			//render
			$str = '';
			$str .= parent::open_block_content( 'row' );


			//check empty
			if ( empty( $data_query->post_count ) || ( $data_query->post_count < 2 ) ) {
				$str .= parent::not_enough_post();
			} else {
				ob_start();
				?>
				<?php while ( $data_query->have_posts() ) : ?>
					<?php $data_query->the_post(); ?>

					<?php if ( true === $flag ) : ?>
						<div class="is-left-col col-sm-8 col-sx-12">
							<?php get_template_part( 'templates/module/layout', 'classic_lite_1' ); ?>
						</div><!--#left column-->

						<div class="is-right-col col-sm-4 col-xs-12">
						<?php $flag = false; ?>
					<?php else: ?>
						<div class="post-outer col-sm-12 col-xs-6">
							<?php get_template_part( 'templates/module/layout', 'grid_small_s_lite_1' ); ?>
						</div>
					<?php endif; ?>

				<?php endwhile; ?>
				</div><!--#right column-->

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
				'title'          => esc_html__( 'latest posts', 'look' ),
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
