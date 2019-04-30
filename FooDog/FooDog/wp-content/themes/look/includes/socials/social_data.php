<?php

if ( ! class_exists( 'look_ruby_social_data' ) ) {
	class look_ruby_social_data {

		/**
		 * @param $author_id
		 *
		 * @return array
		 * get author social data
		 */
		static function author_data( $author_id ) {
			$social_data                = array();
			$social_data['job']         = get_the_author_meta( 'job', $author_id );
			$social_data['website']     = get_the_author_meta( 'user_url', $author_id );
			$social_data['facebook']    = get_the_author_meta( 'facebook', $author_id );
			$social_data['twitter']     = get_the_author_meta( 'twitter', $author_id );
			$social_data['google_plus'] = get_the_author_meta( 'google_plus', $author_id );
			$social_data['pinterest']   = get_the_author_meta( 'pinterest', $author_id );
			$social_data['bloglovin']   = get_the_author_meta( 'bloglovin', $author_id );
			$social_data['linkedin']    = get_the_author_meta( 'linkedin', $author_id );
			$social_data['tumblr']      = get_the_author_meta( 'tumblr', $author_id );
			$social_data['flickr']      = get_the_author_meta( 'flickr', $author_id );
			$social_data['instagram']   = get_the_author_meta( 'instagram', $author_id );
			$social_data['skype']       = get_the_author_meta( 'skype', $author_id );
			$social_data['myspace']     = get_the_author_meta( 'myspace', $author_id );
			$social_data['youtube']     = get_the_author_meta( 'youtube', $author_id );
			$social_data['vkontakte']   = get_the_author_meta( 'vkontakte', $author_id );
			$social_data['reddit']      = get_the_author_meta( 'Reddit', $author_id );
			$social_data['snapchat']    = get_the_author_meta( 'Snapchat', $author_id );
			$social_data['digg']        = get_the_author_meta( 'Digg', $author_id );
			$social_data['dribbble']    = get_the_author_meta( 'dribbble', $author_id );
			$social_data['soundcloud']  = get_the_author_meta( 'soundcloud', $author_id );
			$social_data['vimeo']       = get_the_author_meta( 'vimeo', $author_id );
			$social_data['rss']         = get_the_author_meta( 'rss', $author_id );
			$social_data['description'] = get_the_author_meta( 'description', $author_id );

			return $social_data;
		}


		static function web_data() {
			$social_data = array();

			if ( 1 == look_ruby_core::get_option( 'site_social' ) ) {
				$social_data['facebook']    = look_ruby_core::get_option( 'look_ruby_facebook' );
				$social_data['twitter']     = look_ruby_core::get_option( 'look_ruby_twitter' );
				$social_data['google_plus'] = look_ruby_core::get_option( 'look_ruby_google_plus' );
				$social_data['pinterest']   = look_ruby_core::get_option( 'look_ruby_pinterest' );
				$social_data['bloglovin']   = look_ruby_core::get_option( 'look_ruby_bloglovin' );
				$social_data['instagram']   = look_ruby_core::get_option( 'look_ruby_instagram' );
				$social_data['youtube']     = look_ruby_core::get_option( 'look_ruby_youtube' );
				$social_data['vimeo']       = look_ruby_core::get_option( 'look_ruby_vimeo' );
				$social_data['flickr']      = look_ruby_core::get_option( 'look_ruby_flickr' );
				$social_data['linkedin']    = look_ruby_core::get_option( 'look_ruby_linkedin' );
				$social_data['tumblr']      = look_ruby_core::get_option( 'look_ruby_tumblr' );
				$social_data['vkontakte']   = look_ruby_core::get_option( 'look_ruby_vkontakte' );
				$social_data['snapchat']    = look_ruby_core::get_option( 'look_ruby_snapchat' );
				$social_data['reddit']      = look_ruby_core::get_option( 'look_ruby_reddit' );
				$social_data['skype']       = look_ruby_core::get_option( 'look_ruby_skype' );
				$social_data['rss']         = look_ruby_core::get_option( 'look_ruby_rss' );
			}

			return $social_data;
		}

	}
}