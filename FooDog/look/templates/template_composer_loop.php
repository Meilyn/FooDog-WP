<?php
/**
 * Class look_ruby_template_parts
 * This file render some part template for theme
 */

if ( ! class_exists( 'look_ruby_template_composer_loop' ) ) {
	class look_ruby_template_composer_loop {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * render latest blog section
		 */
		static function render() {

			global $paged;
			$post_id   = get_the_ID();
			$get_paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$get_page  = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;

			//get settings
			$composer_latest_title            = get_post_meta( $post_id, 'look_ruby_composer_latest_title', true );
			$composer_latest_layout           = get_post_meta( $post_id, 'look_ruby_composer_latest_layout', true );
			$composer_latest_number           = get_post_meta( $post_id, 'look_ruby_composer_latest_number', true );
			$composer_latest_offset           = get_post_meta( $post_id, 'look_ruby_composer_latest_offset', true );
			$composer_latest_sidebar          = get_post_meta( $post_id, 'look_ruby_composer_latest_sidebar', true );
			$composer_latest_sidebar_position = get_post_meta( $post_id, 'look_ruby_composer_latest_sidebar_position', true );

			if ( $get_paged > $get_page ) {
				$paged = $get_paged;
			} else {
				$paged = $get_page;
			}

			if ( empty( $composer_latest_layout ) ) {
				$composer_latest_layout = 'layout_classic';
			}

			if ( empty( $composer_latest_number ) ) {
				$composer_latest_number = get_option( 'posts_per_page' );
			}

			if ( empty( $composer_latest_sidebar ) ) {
				$composer_latest_sidebar = 'look_ruby_sidebar_default';
			}

			if ( empty( $composer_latest_sidebar_position ) ) {
				$composer_latest_sidebar_position = 'right';
			}

			if ( empty( $composer_latest_offset ) ) {
				$composer_latest_offset = 0;
			} else {
				$composer_latest_offset = intval( esc_attr( $composer_latest_offset ) );
			}

			//query data
			$param      = array(
				'posts_per_page' => $composer_latest_number,
				'no_found_rows'  => false,
				'offset'         => $composer_latest_offset
			);
			$data_query = look_ruby_query::get_custom_query( $param, $paged );


			//render
			$str = '';
			$str .= look_ruby_composer_render::open_section_hs( 'ruby-composer-latest-blog', $composer_latest_sidebar_position );
			$str .= look_ruby_composer_render::open_section_hs_content( $composer_latest_sidebar_position );

			$str .= '<div class="ruby-block-wrap block-composer-latest-blog ' . esc_attr( $composer_latest_layout ) . '">';
			$str .= '<div class="ruby-block-inner">';
			//block title
			if ( ! empty( $composer_latest_title ) ) {
				$str .= self::render_block_title( $composer_latest_title );
			}

			//blog content
			$str .= '<div class="block-content-wrap">';
			if ( $data_query->have_posts() ) {
				switch ( $composer_latest_layout ) {
					case 'layout_classic':
						$str .= self::render_layout_classic( $data_query );
						break;
					case 'layout_classic_lite':
						$str .= self::render_layout_classic_lite( $data_query );
						break;
					case 'layout_list' :
						$str .= self::render_layout_list( $data_query );
						break;
					case 'layout_grid' :
						$str .= self::render_layout_grid( $data_query );
						break;
					case 'layout_grid_small_s' :
						$str .= self::render_layout_grid_small_s( $data_query );
						break;
					case 'layout_grid_small' :
						$str .= self::render_layout_grid_small( $data_query );
						break;
					case 'layout_overlay_small':
						$str .= self::render_layout_overlay_small( $data_query );
						break;

				}
			}

			$str .= look_ruby_template_part::page_pagination( $data_query );

			wp_reset_postdata();

			$str .= '</div>';
			$str .= '</div>';
			$str .= '</div>';

			$str .= look_ruby_composer_render::close_section_hs_content();
			//render sidebar
			$str .= look_ruby_composer_render::open_sidebar();
			$str .= look_ruby_composer_render::render_sidebar( $composer_latest_sidebar );
			$str .= look_ruby_composer_render::close_sidebar();

			//close section
			$str .= look_ruby_composer_render::close_section_hs();

			return $str;

		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $block_title
		 *
		 * @return string
		 * render header
		 */
		static function render_block_title( $block_title = '' ) {
			$str = '';
			$str .= '<div class="block-header-wrap">';
			$str .= '<div class="block-header-inner">';
			$str .= '<div class="block-title"><h3>' . esc_html( $block_title ) . '</h3></div>';
			$str .= '</div>';
			$str .= '</div>';

			return $str;
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $data_query
		 *
		 * @return string
		 * render layout classic
		 */
		static function render_layout_classic( $data_query ) {
			ob_start();
			while ( $data_query->have_posts() ) :
				$data_query->the_post();
				get_template_part( 'templates/module/layout', 'classic' );
			endwhile;

			return ob_get_clean();
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $data_query
		 *
		 * @return string
		 * render layout classic lite
		 */
		static function render_layout_classic_lite( $data_query ) {
			ob_start();
			while ( $data_query->have_posts() ) :
				$data_query->the_post();
				get_template_part( 'templates/module/layout', 'classic_lite' );
			endwhile;

			return ob_get_clean();
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $data_query
		 *
		 * @return string
		 * render layout list
		 */
		static function render_layout_list( $data_query ) {
			ob_start();
			while ( $data_query->have_posts() ) :
				$data_query->the_post();
				get_template_part( 'templates/module/layout', 'list' );
			endwhile;

			return ob_get_clean();
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $data_query
		 *
		 * @return string
		 * render layout grid
		 */
		static function render_layout_grid( $data_query ) {

			ob_start();
			while ( $data_query->have_posts() ) :
				$data_query->the_post();

				//render block
				echo '<div class="col-sm-6 col-xs-12 post-outer">';
				get_template_part( 'templates/module/layout', 'grid' );
				echo '</div><!--#grid outer-->';

			endwhile;

			return ob_get_clean();
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $data_query
		 *
		 * @return string
		 * render layout grid small
		 */
		static function render_layout_grid_small( $data_query ) {

			ob_start();
			while ( $data_query->have_posts() ) :
				$data_query->the_post();

				//render block
				echo '<div class="col-sm-4 col-xs-6 post-outer">';
				get_template_part( 'templates/module/layout', 'grid_small' );
				echo '</div><!--#grid outer-->';

			endwhile;

			return ob_get_clean();
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $data_query
		 *
		 * @return string
		 * render layout grid small square
		 */
		static function render_layout_grid_small_s( $data_query ) {

			ob_start();
			while ( $data_query->have_posts() ) :
				$data_query->the_post();

				//render block
				echo '<div class="col-sm-4 col-xs-6 post-outer">';
				get_template_part( 'templates/module/layout', 'grid_small_s' );
				echo '</div><!--#grid outer-->';

			endwhile;

			return ob_get_clean();
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $data_query
		 *
		 * @return string
		 * render layout overlay small
		 */
		static function render_layout_overlay_small( $data_query ) {

			ob_start();
			while ( $data_query->have_posts() ) :
				$data_query->the_post();

				//render block
				echo '<div class="col-sm-6 col-xs-12 post-outer">';
				get_template_part( 'templates/module/layout', 'overlay_small' );
				echo '</div><!--#grid outer-->';

			endwhile;

			return ob_get_clean();
		}

	}
}