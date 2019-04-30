<?php

/**
 * Class look_ruby_hs_block_2
 * render has sidebar block 2 (grid layout)
 */
if ( ! class_exists( 'look_ruby_hs_block_2' ) ) {
	class look_ruby_hs_block_2 extends look_ruby_block {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * render block layout
		 */
		static function render( $block ) {


			//add block data
			$block['block_type']    = 'has_sidebar';
			$block['block_classes'] = 'hs-block hs-block-2';

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
			$data_query   = parent::get_data( $block );
			$flag    = true;
			$counter = 1;

			if ( ! empty( $block['block_options']['big_first'] ) ) {
				$big_first = true;
			} else {
				$big_first = false;
			}


			//render
			$str = '';

			$str .= parent::open_block_content( 'row' );

			//check empty
			if ( empty( $data_query->post_count ) ) {
				$str .= parent::no_content();
			} else {
				ob_start();
				?>

				<?php while ( $data_query->have_posts() ) : ?>
					<?php $data_query->the_post();
					//render first post
					if ( ( true === $flag ) && ( true === $big_first ) ) {
						echo '<div class="first-post-wrap col-sx-12">';
						get_template_part( 'templates/module/layout', 'classic_lite' );
						echo '</div>';
						$flag = false;
						continue;
					} else {

						//render block
						echo '<div class="col-sm-6 col-xs-12">';
						get_template_part( 'templates/module/layout', 'grid' );
						echo '</div><!--#grid outer-->';

						if ( 0 == $counter % 2 ) {
							look_ruby_template_part::render_divider();
						}

						$counter ++;
					}


					?>
				<?php endwhile; ?>

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
				'posts_per_page' => 4,
				'offset'         => true,
				'big_first'      => true,
				'view_more'      => true,
				'view_more_text' => true,
				'view_more_link' => true
			);
		}
	}
}
