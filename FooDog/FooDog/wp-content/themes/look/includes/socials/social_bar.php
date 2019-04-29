<?php

if ( ! class_exists( 'look_ruby_social_bar' ) ) {
	class look_ruby_social_bar {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param      $social_data
		 * @param      $classes_name
		 * @param bool $new_tab
		 * @param bool $enable_color
		 *
		 * @return string
		 * render social bar
		 */
		static function render( $social_data, $classes_name = '', $new_tab = true, $enable_color = false ) {
			//check empty
			if ( empty( $social_data ) ) {
				return false;
			}

			if ( $new_tab == true ) {
				$newtab = 'target="_blank"';
			} else {
				$newtab = '';
			}

			extract( shortcode_atts(
					array(

						'website'     => '',
						'facebook'    => '',
						'twitter'     => '',
						'google_plus' => '',
						'pinterest'   => '',
						'bloglovin'   => '',
						'linkedin'    => '',
						'tumblr'      => '',
						'flickr'      => '',
						'instagram'   => '',
						'skype'       => '',
						'myspace'     => '',
						'youtube'     => '',
						'vkontakte'   => '',
						'reddit'      => '',
						'snapchat'    => '',
						'digg'        => '',
						'dribbble'    => '',
						'soundcloud'  => '',
						'vimeo'       => '',
						'rss'         => '',
					), $social_data
				)
			);

			$str        = '';
			$str_social = '';

			if ( ! empty( $website ) ) {
				$str_social .= '<a class="color-website" title="Website" href="' . esc_url( $website ) . '" ' . $newtab . '><i class="fa fa-link"></i></a>';
			}
			if ( ! empty( $facebook ) ) {
				$str_social .= '<a class="color-facebook" title="Facebook" href="' . esc_url( $facebook ) . '" ' . $newtab . '><i class="fa fa-facebook"></i></a>';
			}
			if ( ! empty( $twitter ) ) {
				$str_social .= '<a class="color-twitter" title="Twitter" href="' . esc_url( $twitter ) . '" ' . $newtab . '><i class="fa fa-twitter"></i></a>';
			}
			if ( ! empty( $google_plus ) ) {
				$str_social .= '<a class="color-google" title="Google+" href="' . esc_url( $google_plus ) . '" ' . $newtab . '><i class="fa fa-google-plus"></i></a>';
			}
			if ( ! empty( $pinterest ) ) {
				$str_social .= '<a class="color-pinterest" title="Pinterest" href="' . esc_url( $pinterest ) . '" ' . $newtab . '><i class="fa fa-pinterest"></i></a>';
			}
			if ( ! empty( $bloglovin ) ) {
				$str_social .= '<a class="color-bloglovin" title="Bloglovin" href="' . esc_url( $bloglovin ) . '" ' . $newtab . '><i class="fa fa-heart"></i></a>';
			}
			if ( ! empty( $instagram ) ) {
				$str_social .= '<a class="color-instagram" title="Instagram" href="' . esc_url( $instagram ) . '" ' . $newtab . '><i class="fa fa-instagram"></i></a>';
			}
			if ( ! empty( $youtube ) ) {
				$str_social .= '<a class="color-youtube" title="Youtube" href="' . esc_url( $youtube ) . '" ' . $newtab . '><i class="fa fa-youtube"></i></a>';
			}
			if ( ! empty( $vimeo ) ) {
				$str_social .= '<a class="color-vimeo" title="Vimeo" href="' . esc_url( $vimeo ) . '" ' . $newtab . '><i class="fa fa-vimeo-square"></i></a>';
			}
			if ( ! empty( $linkedin ) ) {
				$str_social .= '<a class="color-linkedin" title="LinkedIn" href="' . esc_url( $linkedin ) . '" ' . $newtab . '><i class="fa fa-linkedin"></i></a>';
			}
			if ( ! empty( $tumblr ) ) {
				$str_social .= '<a class="color-tumblr" title="Tumblr" href="' . esc_url( $tumblr ) . '" ' . $newtab . '><i class="fa fa-tumblr"></i></a>';
			}
			if ( ! empty( $vkontakte ) ) {
				$str_social .= '<a class="color-vk" title="Vkontakte" href="' . esc_url( $vkontakte ) . '" ' . $newtab . '><i class="fa fa-vk"></i></a>';
			}
			if ( ! empty( $snapchat ) ) {
				$str_social .= '<a class="color-snapchat" title="Snapchat" href="' . esc_url( $snapchat ) . '" ' . $newtab . '><i class="fa fa-snapchat-ghost"></i></a>';
			}
			if ( ! empty( $reddit ) ) {
				$str_social .= '<a class="color-reddit" title="Reddit" href="' . esc_url( $reddit ) . '" ' . $newtab . '><i class="fa fa-reddit-alien"></i></a>';
			}
			if ( ! empty( $flickr ) ) {
				$str_social .= '<a class="color-flickr" title="Flickr" href="' . esc_url( $flickr ) . '" ' . $newtab . '><i class="fa fa-flickr"></i></a>';
			}
			if ( ! empty( $skype ) ) {
				$str_social .= '<a class="color-skype" title="Skype" href="' . esc_url( $skype ) . '" ' . $newtab . '><i class="fa fa-skype"></i></a>';
			}
			if ( ! empty( $myspace ) ) {
				$str_social .= '<a class="color-myspace" title="Myspace" href="' . esc_url( $myspace ) . '" ' . $newtab . '><i class="fa fa-users"></i></a>';
			}
			if ( ! empty( $digg ) ) {
				$str_social .= '<a class="color-digg" title="Digg" href="' . esc_url( $digg ) . '" ' . $newtab . '><i class="fa fa-digg"></i></a>';
			}
			if ( ! empty( $dribbble ) ) {
				$str_social .= '<a class="color-dribbble" title="Dribbble" href="' . esc_url( $dribbble ) . '" ' . $newtab . '><i class="fa fa-dribbble"></i></a>';
			}
			if ( ! empty( $soundcloud ) ) {
				$str_social .= '<a class="color-soundcloud" title="SoundCloud" href="' . esc_url( $soundcloud ) . '" ' . $newtab . '><i class="fa fa-soundcloud"></i></a>';
			}
			if ( ! empty( $rss ) ) {
				$str_social .= '<a class="color-rss" title="Rss" href="' . esc_url( $rss ) . '" ' . $newtab . '><i class="fa fa-rss"></i></a>';
			}
			if ( ! empty( $str_social ) ) {

				$classes   = array();
				$classes[] = 'social-link-info clearfix';

				if ( ! empty( $classes_name ) ) {
					$classes[] = $classes_name;
				}

				if ( ! empty( $enable_color ) ) {
					$classes[] = 'is-color';
				}

				$classes = implode( ' ', $classes );

				$str .= '<div class="' . esc_attr( $classes ) . '">';
				$str .= $str_social;
				$str .= '</div><!--#social icon-->';
			}

			return $str;
		}
	}
}
