<?php
/**
 * Class look_ruby_template_thumbnail
 * this file handle thumbnail for theme
 */
if ( ! class_exists( 'look_ruby_template_thumbnail' ) ) {
	class look_ruby_template_thumbnail {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $size
		 * @param string $classes_name
		 *
		 * @return string
		 * render featured image
		 */
		static function render_image( $size, $classes_name = '' ) {

			//get config
			if ( ! has_post_thumbnail() ) {
				return false;
			}

			$holder = look_ruby_core::get_option( 'thumb_holder' );

			//create class
			$classes   = array();
			$classes[] = $classes_name;
			$classes[] = 'post-thumb';
			$classes[] = 'is-image';
			if ( ! empty( $holder ) ) {
				$classes[] = 'ruby-holder';
			}
			$classes = implode( ' ', $classes );

			//render
			$str = '';
			$str .= '<div class="' . esc_attr( $classes ) . '">';
			$str .= '<a href="' . get_permalink() . '" title="' . esc_attr( get_the_title() ) . '" rel="bookmark">';
			$str .= '<span class="thumbnail-resize">';
			$str .= get_the_post_thumbnail( get_the_ID(), $size );
			$str .= '</span><!--#thumbnail resize-->';
			$str .= '</a>';
			$str .= '</div><!--#post thumbnail-->';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $size
		 * @param string $classes_name
		 *
		 * @return string
		 * render featured image in single page
		 */
		static function render_image_single( $size ) {

			//check single
			if ( ! has_post_thumbnail() ) {
				return false;
			}

			//get config
			$holder = look_ruby_core::get_option( 'thumb_holder' );

			//create class
			$classes   = array();
			$classes[] = 'post-thumb';
			$classes[] = 'is-image is-image-single';
			if ( ! empty( $holder ) ) {
				$classes[] = 'ruby-holder';
			}
			$classes               = implode( ' ', $classes );
			$full_image_attachment = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

			//render
			$str = '';
			$str .= '<div class="' . esc_attr( $classes ) . '">';
			$str .= '<a href="' . esc_url( $full_image_attachment[0] ) . '" title="' . esc_attr( get_the_title() ) . '" rel="bookmark">';
			$str .= '<span class="thumbnail-resize">';
			$str .= get_the_post_thumbnail( get_the_ID(), $size );
			$str .= '</span><!--#thumbnail resize-->';
			$str .= '</a>';
			$str .= self::render_feat_credit();
			$str .= '</div><!--#post thumbnail-->';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return bool|string
		 * render credit text
		 */
		static function render_feat_credit() {

			//check credit text
			$credit_text = get_post_meta( get_the_ID(), 'look_ruby_credit_text', true );
			if ( ! empty( $credit_text ) ) {
				return '<span class="thumb-caption">' . esc_html( $credit_text ) . '</span>';
			} else {
				//check caption
				$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$attachment   = get_posts( array( 'p' => $thumbnail_id, 'post_type' => 'attachment' ) );
				if ( ! empty( $attachment[0]->post_excerpt ) ) {
					return '<span class="thumb-caption">' . esc_html( $attachment[0]->post_excerpt ) . '</span>';
				} else {
					return false;
				}
			}
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes_name
		 *
		 * @return string
		 * render audio post
		 */
		static function render_audio( $classes_name = '' ) {
			$classes = array();

			if ( ! empty( $classes_name ) ) {
				$classes[] = $classes_name;
			}
			$classes[] = 'post-thumb';
			$classes[] = 'is-audio';
			$classes[] = 'audio-iframe';

			$self_host_audio = get_post_meta( get_the_ID(), 'look_ruby_single_self_host_audio', true );
			if ( ! empty( $self_host_audio ) ) {
				$classes[] = 'is-self-hosted';
			}

			$classes = implode( ' ', $classes );

			//render
			$str = '';
			$str .= '<div class="' . esc_attr( $classes ) . '">';
			$str .= look_ruby_post_format::audio_iframe();
			$str .= '</div>';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes_name
		 *
		 * @return string
		 * render video iframe
		 */
		static function render_video( $classes_name = '' ) {
			$classes = array();

			if ( ! empty( $classes_name ) ) {
				$classes[] = $classes_name;
			}
			$classes[] = 'post-thumb';
			$classes[] = 'is-video';
			$classes[] = 'video-iframe';

			$self_host_video = get_post_meta( get_the_ID(), 'look_ruby_single_self_host_video', true );
			if ( ! empty( $self_host_video ) ) {
				$classes[] = 'is-self-hosted';
			}

			$classes = implode( ' ', $classes );

			//render
			$str = '';
			$str .= '<div class="' . esc_attr( $classes ) . '">';
			$str .= look_ruby_post_format::video_iframe();
			$str .= '</div>';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return mixed
		 * render gallery
		 */
		static function render_gallery( $classes_name = '' ) {

			$gallery_type = get_post_meta( get_the_ID(), 'look_ruby_single_post_gallery_type', true );
			if ( ! empty( $gallery_type ) && 'slider' == $gallery_type ) {
				return self::render_gallery_slider( $classes_name );
			} else {
				return self::render_gallery_grid( $classes_name );
			}
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes_name
		 *
		 * @return string
		 * render gallery slider
		 */
		static function render_gallery_slider( $classes_name = '' ) {
			//create classes
			$classes = array();
			if ( ! empty( $classes_name ) ) {
				$classes[] = $classes_name;
			}
			$classes[] = 'post-thumb is-gallery is-slider';
			$classes   = implode( ' ', $classes );

			//size
			$size    = 'look_ruby_760_510';
			$gallery = get_post_meta( get_the_ID(), 'look_ruby_single_post_gallery_data', false );

			//render
			$str = '';
			$str .= '<div class="' . esc_attr( $classes ) . '">';
			$str .= '<div class="slider-loading"></div>';
			$str .= '<div class="ruby-gallery-slider slider-init">';
			if ( is_array( $gallery ) ) {
				foreach ( $gallery as $gallery_el ) {
					if ( ! empty( $gallery_el ) ) {

						$image_full = wp_get_attachment_image_src( $gallery_el, 'full' );
						$caption    = get_post_field( 'post_excerpt', $gallery_el );

						$str .= '<div class="gallery-slider-el">';
						$str .= '<a class="gallery-popup" href="' . esc_url( $image_full[0] ) . '">';
						$str .= wp_get_attachment_image( $gallery_el, $size );
						$str .= '</a>';

						if ( ! empty( $caption ) ) {
							$str .= '<span class="thumb-caption">';
							$str .= '<i class="fa fa-camera"></i><span>' . esc_html( $caption ) . '</span>';
							$str .= '</span><!--#caption -->';
						}
						$str .= '</div><!--#galler slider el -->';
					}
				}
				$str .= '</div><!--#gallery slider-->';
			}
			$str .= '</div><!--thumb wrap-->';

			return $str;

		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes_name
		 *
		 * @return string
		 * render gallery grid
		 */
		static function render_gallery_grid( $classes_name = '' ) {

			//create class
			$classes   = array();
			$classes[] = $classes_name;
			$classes[] = 'post-thumb is-gallery is-grid';
			$classes = implode( ' ', $classes );

			//size
			$size = 'look_ruby_300_300';
			$gallery = get_post_meta( get_the_ID(), 'look_ruby_single_post_gallery_data', false );

			//render
			$str = '';
			$str .= '<div class="' . esc_attr( $classes ) . '">';
			$str .= '<div class="slider-loading"></div>';
			$str .= '<div class="ruby-gallery-grid slider-init">';
			if ( is_array( $gallery ) ) {
				foreach ( $gallery as $gallery_el ) {
					if ( ! empty( $gallery_el ) ) {
						$image_full = wp_get_attachment_image_src( $gallery_el, 'full' );
						$image      = wp_get_attachment_image_src( $gallery_el, $size );
						$str .= '<a href="' . esc_url( $image_full[0] ) . '"><img alt="" src="' . esc_url( $image[0] ) . '"></a>';
					}
				}
			}
			$str .= '</div>';
			$str .= '</div><!--#gallery grid-->';

			return $str;
		}
	}
}