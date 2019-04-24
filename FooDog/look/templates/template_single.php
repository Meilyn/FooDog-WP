<?php
/**
 * Class look_ruby_template_parts
 * This file render some part template for theme
 */

if ( ! class_exists( 'look_ruby_template_single' ) ) {
	class look_ruby_template_single {


		/**-------------------------------------------------------------------------------------------------------------------------
		 * render single post title
		 */
		static function post_title() {
			echo '<div class="single-title post-title is-big-title entry-title">';
			echo '<h1>';
			the_title();
			echo '</h1>';
			echo '</div><!--#single title-->';
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * render single post cate info
		 */
		static function post_cat_info() {

			//check
			$single_post_category_info = look_ruby_core::get_option( 'single_post_category_info' );
			if ( empty( $single_post_category_info ) ) {
				return false;
			}
			look_ruby_template_part::post_cat_info( 'is-relative', false );
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * render single tag bar
		 */
		static function post_meta_info() {
			$single_post_meta_info = look_ruby_core::get_option( 'single_post_meta_info_manager' );
			//render
			if ( ! empty( $single_post_meta_info['enabled'] ) ) {

				//render
				echo '<div class="post-meta-info">';
				foreach ( $single_post_meta_info['enabled'] as $key => $val ) {
					switch ( $key ) {
						case 'date' :
							get_template_part( 'templates/meta/el', 'date' );
							break;
						case 'author' :
							get_template_part( 'templates/meta/el', 'author_single' );
							break;
						case 'cat' :
							look_ruby_meta_el_category();
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
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * render single tag bar
		 */
		static function post_share_bar() {

			//check settings
			$single_post_share_bar = look_ruby_core::get_option( 'single_post_share_bar' );
			if ( empty( $single_post_share_bar ) ) {
				return false;
			}

			$single_post_share_bar_total = look_ruby_core::get_option( 'post_share_bar_total' );
			echo '<div class="single-share-bar clearfix">';

			if ( ! empty( $single_post_share_bar_total ) ) {
				//get total share
				$total_share = look_ruby_social_share_count::count_all_share();

				echo '<span class="single-share-bar-total share-bar-total">';
				echo intval( $total_share['all'] ) . ' ' . '<span class="share-bar-total-text">' . esc_html( 'shares', 'look' ) . '</span>';
				echo '</span><!--#share bar total -->';
			} else {
				echo '<span class="single-share-bar-total share-bar-total">';
				echo '<span class="share-bar-total-text">' . esc_html( 'share', 'look' ) . '</span>';
				echo '</span><!--#share bar total -->';
			}
			echo '<div class="single-share-bar-inner">';
			echo look_ruby_social_share_post::render_post_share_bar();
			echo '</div>';


			echo '</div><!--#single share bar-->';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * render single meta info bar
		 */
		static function post_meta_info_bar() {
			echo '<div class="single-meta-info-bar clearfix">';
			self::post_meta_info();
			self::post_share_bar();
			echo '</div>';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes_name
		 * render single header
		 */
		static function open_header( $classes_name = '' ) {
			echo '<div class="single-header ' . esc_attr( $classes_name ) . '">';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * close single header
		 */
		static function close_header() {
			echo '</div><!--#single header -->';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $size
		 * render single featured
		 */
		static function post_thumb( $size = 'full' ) {

			$single_post_format = look_ruby_post_format::check_post_format();

			echo '<div class="post-thumb-outer single-thumb-outer">';
			switch ( $single_post_format ) {
				case 'gallery' :
					echo look_ruby_template_thumbnail::render_gallery( 'is-single-thumb' );
					break;
				case 'video':
					echo look_ruby_template_thumbnail::render_video( 'is-single-thumb' );
					break;
				case 'audio' :
					echo look_ruby_template_thumbnail::render_audio( 'is-single-thumb' );
					break;
				default :
					echo look_ruby_template_thumbnail::render_image_single( $size );
					break;
			}
			echo '</div><!--#thumb outer-->';
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * render single post content
		 */
		static function post_content() {

			$review          = look_ruby_post_review::has_review();
			$review_position = look_ruby_post_review::review_box_position();

			echo '<div class="entry single-entry">';

			if ( true === $review && 'left_top' == $review_position ) {
				echo self::post_review( 'is-left-top' );
			}

			//remove moretag
			global $more;
			$more = 1;

			the_content();

			//single pagination
			wp_link_pages(
				array(
					'before'      => '<div class="single-page-links"><div class="pagination-num">',
					'after'       => '</div></div>',
					'link_before' => '<span class="page-numbers">',
					'link_after'  => '</span>',
					'echo'        => true
				)
			);

			if ( true === $review && 'bottom' == $review_position ) {
				echo self::post_review( 'is-review-bottom' );
			}

			get_template_part( 'templates/single/box', 'tag' );
			get_template_part( 'templates/single/box', 'like' );

			echo self::schema_markup();
			echo '<div class="clearfix"></div>';
			echo '</div>';
		}


		static function post_review( $classes_name = '' ) {
			$post_id        = get_the_ID();
			$review_summary = get_post_meta( $post_id, 'look_ruby_review_summary', true );
			$total_score    = get_post_meta( $post_id, 'look_ruby_as', true );
			$review_data    = array(
				array(
					'look_ruby_cd' => get_post_meta( $post_id, 'look_ruby_cd1', true ),
					'look_ruby_cs' => get_post_meta( $post_id, 'look_ruby_cs1', true ),
				),
				array(
					'look_ruby_cd' => get_post_meta( $post_id, 'look_ruby_cd2', true ),
					'look_ruby_cs' => get_post_meta( $post_id, 'look_ruby_cs2', true ),
				),
				array(
					'look_ruby_cd' => get_post_meta( $post_id, 'look_ruby_cd3', true ),
					'look_ruby_cs' => get_post_meta( $post_id, 'look_ruby_cs3', true ),
				),
				array(
					'look_ruby_cd' => get_post_meta( $post_id, 'look_ruby_cd4', true ),
					'look_ruby_cs' => get_post_meta( $post_id, 'look_ruby_cs4', true ),
				),
				array(
					'look_ruby_cd' => get_post_meta( $post_id, 'look_ruby_cd5', true ),
					'look_ruby_cs' => get_post_meta( $post_id, 'look_ruby_cs5', true ),
				),
				array(
					'look_ruby_cd' => get_post_meta( $post_id, 'look_ruby_cd6', true ),
					'look_ruby_cs' => get_post_meta( $post_id, 'look_ruby_cs6', true ),
				),
			);

			//render
			$str = '';
			$str .= '<div class="review-box-wrap ' . esc_attr( $classes_name ) . '">';
			$str .= '<div class="review-box-inner">';
			$str .= '<div class="review-title block-title"><h3>' . esc_html__( 'Review overview', 'look' ) . '</h3></div>';
			$str .= '<div class="review-content-wrap">';
			foreach ( $review_data as $data ) {
				if ( ! empty( $data['look_ruby_cd'] ) ) {
					$str .= '<div class="review-el">';
					$str .= '<div class="review-el-inner">';
					$str .= '<span class="review-description">' . esc_attr( $data['look_ruby_cd'] ) . '</span>';
					$str .= '<span class="review-info-score">' . esc_attr( $data['look_ruby_cs'] ) . '</span>';
					$str .= '</div>';
					$str .= '<div class="score-bar-wrap">';
					$str .= '<div class="score-bar" style="width:' . esc_attr( $data['look_ruby_cs'] * 10 ) . '%"></div>';
					$str .= '</div>';
					$str .= '</div><!--#reivew el-->';
				}
			}

			$str .= '<div class="review-summary-wrap">';
			$str .= '<div class="review-summary-inner">';
			$str .= '<h3>' . esc_html__( 'Summary', 'look' ) . '</h3>';
			$str .= '<p class="review-summary-desc">';
			$str .= '<span class="post-review-info">';
			$str .= '<span class="review-info-score">' . esc_attr( $total_score ) . '</span>';
			$str .= '</span><!--#reivew bar wrap-->';
			$str .= esc_html( $review_summary );
			$str .= '</p>';
			$str .= '</div>';
			$str .= '</div><!--#reivew summary wrap -->';
			$str .= '</div>';
			$str .= '</div>';
			$str .= '</div>';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * render single schema makeup
		 */
		static function schema_markup() {

			$http_checker = 'http';
			if ( is_ssl() ) {
				$http_checker = 'https';
			}

			$publisher = get_bloginfo( 'name' );
			if ( ! empty( $publisher ) ) {
				$publisher = get_the_author_meta( 'display_name' );
			}

			//publisher logo
			$logo = look_ruby_core::get_option( 'site_logo' );
			if ( ! empty( $logo['url'] ) ) {
				$publisher_logo = esc_url( $logo['url'] );
			}

			$post_date   = get_the_time( 'U' );
			$post_update = get_the_modified_time( 'U' );

			$full_image_attachment = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

			$str = '';
			$str .= '<meta itemscope itemprop="mainEntityOfPage"  itemType="' . $http_checker . '://schema.org/WebPage" itemid="' . get_permalink() . '"/>';

			//headline
			$str .= '<meta itemprop="headline " content="' . esc_attr( strip_tags( get_the_title() ) ) . '">';

			//author
			$str .= '<span style="display: none;" itemprop="author" itemscope itemtype="' . $http_checker . '://schema.org/Person">';
			$str .= '<meta itemprop="name" content="' . esc_attr( get_the_author_meta( 'display_name' ) ) . '">';
			$str .= '</span>';

			//image
			$str .= '<span style="display: none;" itemprop="image" itemscope itemtype="' . $http_checker . '://schema.org/ImageObject">';
			$str .= '<meta itemprop="url" content="' . $full_image_attachment[0] . '">';
			$str .= '<meta itemprop="width" content="' . $full_image_attachment[1] . '">';
			$str .= '<meta itemprop="height" content="' . $full_image_attachment[2] . '">';
			$str .= '</span>';

			//publisher
			$str .= '<span style="display: none;" itemprop="publisher" itemscope itemtype="' . $http_checker . '://schema.org/Organization">';
			$str .= '<span style="display: none;" itemprop="logo" itemscope itemtype="' . $http_checker . '://schema.org/ImageObject">';
			if ( ! empty( $publisher_logo ) ) {
				$str .= '<meta itemprop="url" content="' . $publisher_logo . '">';
			}
			$str .= '</span>';
			$str .= '<meta itemprop="name" content="' . $publisher . '">';
			$str .= '</span>';

			$str .= '<meta itemprop="datePublished" content="' . date( DATE_W3C, $post_date ) . '"/>';
			$str .= '<meta itemprop="dateModified" content="' . date( DATE_W3C, $post_update ) . '"/>';

			//review
			$enable_review = look_ruby_post_review::has_review();
			if ( ! empty( $enable_review ) ) {
				$total_score    = get_post_meta( get_the_ID(), 'look_ruby_as', true );
				$review_summary = get_post_meta( get_the_ID(), 'look_ruby_review_summary', true );

				$str .= '<span itemprop="itemReviewed" itemscope itemtype="' . $http_checker . '://schema.org/Thing">';
				$str .= '<meta itemprop="name " content = "' . esc_attr( strip_tags( get_the_title() ) ) . '">';
				$str .= '</span>';

				$str .= '<meta itemprop="reviewBody" content = "' . esc_attr( strip_tags( $review_summary ) ) . '">';

				//ratting
				$str .= '<span style="display: none;" itemprop="reviewRating" itemscope itemtype="' . $http_checker . '://schema.org/Rating">';
				$str .= '<meta itemprop="worstRating" content = "1">';
				$str .= '<meta itemprop="bestRating" content = "10">';
				$str .= '<meta itemprop="ratingValue" content = "' . $total_score . '">';
				$str .= '</span>';

			}

			return $str;

		}
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * render single layout
 */
if ( ! function_exists( 'look_ruby_render_single_post' ) ) {
	function look_ruby_render_single_post() {

		look_ruby_post_view::add_view();
		echo '<div class="single-post-outer clearfix" data-post_url="' . esc_url( get_the_permalink() ) . '" data-post_title="' . get_the_title() . '">';
		//single layout
		$look_ruby_single_layout = get_post_meta( get_the_ID(), 'look_ruby_template_single', true );

		if ( empty( $look_ruby_single_layout ) || 'default' == $look_ruby_single_layout ) {

			$look_ruby_single_layout = look_ruby_core::get_option( 'default_single_post_layout' );

			//change layout sticky post
			if ( is_sticky() ) {
				$look_ruby_single_layout = 'style_5';
			};
		}

		switch ( $look_ruby_single_layout ) {
			case 'style_2' :
				get_template_part( 'templates/single/style', '2' );
				break;
			case 'style_3' :
				get_template_part( 'templates/single/style', '3' );
				break;
			case 'style_4' :
				get_template_part( 'templates/single/style', '4' );
				break;
			case 'style_5' :
				get_template_part( 'templates/single/style', '5' );
				break;
			case 'style_6' :
				get_template_part( 'templates/single/style', '6' );
				break;
			default :
				get_template_part( 'templates/single/style', '1' );
				break;
		}

		echo '</div><!--#single outer-->';
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * ajax single
 */
if ( ! function_exists( 'look_ruby_ajax_single_infinite_load' ) ) {
	add_action( 'wp_ajax_nopriv_look_ruby_ajax_single_infinite_load', 'look_ruby_ajax_single_infinite_load' );
	add_action( 'wp_ajax_look_ruby_ajax_single_infinite_load', 'look_ruby_ajax_single_infinite_load' );

	function look_ruby_ajax_single_infinite_load() {

		//get and validate request data
		$data = array();
		global $post;

		if ( ! empty( $_POST['post_id'] ) ) {
			$post_id = esc_attr( $_POST['post_id'] );
		}

		if ( ! empty( $post_id ) ) {
			$post = get_post( $post_id );

			if ( ! empty( $post ) ) {
				//global $post;
				setup_postdata( $post );
				$pre_post = get_previous_post();
				//get pre post
				if ( ! empty( $pre_post ) ) {
					$data['next_post_id'] = $pre_post->ID;
				}

				ob_start();
				look_ruby_render_single_post();
				$data['content'] = ob_get_clean();
				wp_reset_postdata();
			}
		}

		die( json_encode( $data ) );
	}
}

