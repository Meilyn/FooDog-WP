<?php
/**
 * Class look_ruby_template_parts
 * This file render some part template for theme
 */

if ( ! class_exists( 'look_ruby_template_part' ) ) {
	class look_ruby_template_part {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $position
		 * @param $style
		 * render display category info bar
		 */
		static function post_cat_info( $position = 'is-relative', $primary = true ) {

			//check
			$post_category_info = look_ruby_core::get_option( 'post_category_info' );

			if ( empty( $post_category_info ) ) {
				return false;
			}

			$categories = get_the_category();

			if ( empty( $categories ) ) {
				return false;
			}

			//create class
			$classes   = array();
			$classes[] = 'post-cat-info';
			$classes[] = esc_attr( $position );

			$classes = implode( ' ', $classes );

			//render
			echo '<div class="' . esc_attr( $classes ) . '">';
			look_ruby_info_el_category( $primary );
			echo '</div><!--post cate info-->';

		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes
		 * render post title
		 */
		static function post_title( $classes = 'is-medium-title' ) {

			//render
			echo '<h3 class="post-title ' . esc_attr( $classes ) . '">';
			echo '<a href="' . get_permalink() . '" rel="bookmark" title="' . esc_attr( get_the_title() ) . '">';
			the_title();
			echo '</a></h3><!--#post title-->';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param array $override
		 * @param bool $primary_category
		 * render post meta information bar
		 */
		static function post_meta_info( $override = array(), $primary_category = true ) {

			$post_meta_info_manager = look_ruby_core::get_option( 'post_meta_info_manager' );

			//override default setting
			if ( ! empty( $override ) ) {
				$post_meta_info_manager['enabled'] = $override;
			}

			//check
			if ( empty( $post_meta_info_manager['enabled'] ) || ! is_array( $post_meta_info_manager['enabled'] ) ) {
				return false;
			}

			//render
			echo '<div class="post-meta-info">';
			foreach ( $post_meta_info_manager['enabled'] as $key => $val ) {
				switch ( $key ) {
					case 'date' :
						get_template_part( 'templates/meta/el', 'date' );
						break;
					case 'author' :
						get_template_part( 'templates/meta/el', 'author' );
						break;
					case 'cat' :
						look_ruby_meta_el_category( $primary_category );
						break;
					case 'tag' :
						get_template_part( 'templates/meta/el', 'tag' );
						break;
					case 'view' :
						get_template_part( 'templates/meta/el', 'view' );
						break;
					case 'comment' :
						get_template_part( 'templates/meta/el', 'comment' );
						break;
				};
			}
			echo '</div><!--#post meta info-->';
		}


		/**
		 * @param string $classes
		 * render post format icon
		 */
		static function post_format_info() {

			//check
			$post_format_icon = look_ruby_core::get_option( 'post_format_icon' );
			if ( empty( $post_format_icon ) ) {
				return false;
			}

			//render
			get_template_part( 'templates/meta/el', 'post_format' );
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes_name
		 * render post share bar
		 */
		static function post_share_bar( $classes_name = '' ) {

			$post_share_bar = look_ruby_core::get_option( 'post_share_bar' );
			//check settings
			if ( empty( $post_share_bar ) ) {
				return false;
			}

			$post_share_bar_total = look_ruby_core::get_option( 'post_share_bar_total' );

			$classes   = array();
			$classes[] = 'post-share-bar';
			$classes[] = esc_attr( $classes_name );
			$classes[] = 'clearfix';
			$classes   = implode( ' ', $classes );

			echo '<div class="' . esc_attr( $classes ) . '">';
			echo '<div class="post-share-bar-inner">';
			echo look_ruby_social_share_post::render_post_share_bar();
			echo '</div>';

			//render post share total
			if ( ! empty( $post_share_bar_total ) ) {
				$total_share = look_ruby_social_share_count::count_all_share();

				echo '<span class="share-bar-total">';
				echo intval( $total_share['all'] ) . ' ' . esc_html__( 'shares', 'look' );
				echo '</span><!--#share bar total -->';
			} else {
				echo '<span class="share-bar-total">';
				esc_html_e( 'shares', 'look' );
				echo '</span><!--#share bar total -->';
			}

			echo '</div><!--#post share bar-->';

		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * post review score
		 */
		static function post_review_score() {

			$enable_review = look_ruby_core::get_option( 'post_review_icon' );
			if ( empty( $enable_review ) ) {
				return false;
			}
			$review = look_ruby_post_review::has_review();
			if ( false === $review ) {
				return false;
			}
			$total_score = get_post_meta( get_the_ID(), 'look_ruby_as', true );

			echo '<span class="post-review-score">';
			echo '<span class="post-review-score-inner">';
			echo esc_html( $total_score );
			echo '</span><!--#share bar total -->';
			echo '</span><!--#share bar total -->';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param      $excerpt_length
		 * @param bool $display_shortcode
		 * excerpt
		 */
		static function post_excerpt( $excerpt_length = 15, $display_shortcode = false ) {

			//check
			if ( empty( $excerpt_length ) ) {
				return false;
			}

			//render
			global $post;

			if ( ! empty( $post->post_excerpt ) ) {
				echo '<div class="post-excerpt">' . esc_html( $post->post_excerpt ) . '</div><!--#excerpt-->';
			} else {
				$post_content = $post->post_content;
				if ( ! $display_shortcode ) {
					$post_content = preg_replace( '`\[[^\]]*\]`', '', $post->post_content );
				}
				$post_content = stripslashes( wp_filter_nohtml_kses( $post_content ) );

				echo '<div class="post-excerpt">' . esc_html( wp_trim_words( $post_content, $excerpt_length, '' ) ) . '</div><!--#excerpt-->';
			}
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * render excerpt length
		 */
		static function post_content() {

			//render
			echo '<div class="entry">';
			ob_start();
			the_content( '' );
			echo ob_get_clean();
			echo '</div><!--#excerpt-->';

		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes
		 *
		 * @return string
		 * render divider
		 */
		static function render_divider( $classes = '' ) {
			echo '<div class="' . esc_attr( $classes ) . ' is-divider clearfix"></div><!--#divider-->';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * render page pagination as html
		 */
		static function page_pagination( $custom_query = null ) {
			global $wp_query, $wp_rewrite;
			$str = '';

			if ( ! empty( $custom_query ) ) {
				$get_query = $custom_query;
			} else {
				$get_query = $wp_query;
			}

			if ( is_single() || ( $get_query->max_num_pages < 2 ) ) {
				return false;
			}

			//render pagination
			$str .= '<div class="pagination-wrap clearfix">';
			$str .= '<div class="pagination-num">';
			$get_query->query_vars['paged'] > 1 ? $current = $get_query->query_vars['paged'] : $current = 1;
			$pagination = array(
				'base'      => @add_query_arg( 'paged', '%#%' ),
				'format'    => '',
				'total'     => $get_query->max_num_pages,
				'current'   => $current,
				'mid_size'  => 1,
				'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
				'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
				'type'      => 'plain'
			);
			if ( $wp_rewrite->using_permalinks() ) {
				$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
			}
			if ( ! empty( $get_query->query_vars['s'] ) ) {
				$pagination['add_args'] = array( 's' => urlencode( get_query_var( 's' ) ) );
			}
			$str .= paginate_links( $pagination );
			$str .= '</div><!--#pagination number-->';
			$str .= '</div><!--#pagination-wrap-->';

			return $str;
		}
	}
}