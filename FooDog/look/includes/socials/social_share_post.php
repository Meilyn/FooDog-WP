<?php
if ( ! class_exists( 'look_ruby_social_share_post' ) ) {
	class look_ruby_social_share_post {


		static function render_post_share_bar() {

			$twitter_user = get_the_author_meta( 'twitter' );
			if ( empty( $twitter_user ) ) {
				$twitter_user = look_ruby_core::get_option( 'look_ruby_twitter' );
			}

			if ( ! empty( $twitter_user ) ) {
				$pos          = strpos( $twitter_user, 'twitter.com/' );
				$twitter_user = substr( $twitter_user, intval( $pos ) + 12 );
				$twitter_user = str_replace( '/', '', $twitter_user );
			} else {
				$twitter_user = get_bloginfo( 'name' );
			}

			$enable_facebook    = look_ruby_core::get_option( 'share_to_facebook' );
			$enable_twitter     = look_ruby_core::get_option( 'share_to_twitter' );
			$enable_google_plus = look_ruby_core::get_option( 'share_to_google_plus' );
			$enable_linkedin    = look_ruby_core::get_option( 'share_to_linkedin' );
			$enable_pinterest   = look_ruby_core::get_option( 'share_to_pinterest' );
			$enable_tumblr      = look_ruby_core::get_option( 'share_to_tumblr' );
			$enable_vk          = look_ruby_core::get_option( 'share_to_vk' );
			$enable_reddit      = look_ruby_core::get_option( 'share_to_reddit' );
			$enable_email       = look_ruby_core::get_option( 'share_to_email' );

			//render
			$str = '';
			//facebook
			if ( ! empty( $enable_facebook ) ) {
				$str .= '<a class="share-bar-el icon-facebook" href="http://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-facebook color-facebook"></i></a>';
			}
			//twitter
			if ( ! empty( $enable_twitter ) ) {
				$str .= '<a class="share-bar-el icon-twitter" href="https://twitter.com/intent/tweet?text=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '&amp;url=' . urlencode( get_permalink() ) . '&amp;via=' . urlencode( $twitter_user ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-twitter color-twitter"></i></a>';
			}
			//google
			if ( ! empty( $enable_google_plus ) ) {
				$str .= ' <a class="share-bar-el icon-google" href="http://plus.google.com/share?url=' . urlencode( get_permalink() ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-google-plus color-google"></i></a>';
			}
			//pinterest
			if ( ! empty( $enable_pinterest ) ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'look_ruby_840x500' );
				$str .= '<a class="share-bar-el icon-pinterest" href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . '&description=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-pinterest"></i></a>';
			}
			//linkedin
			if ( ! empty ( $enable_linkedin ) ) {
				$str .= '<a class="share-bar-el icon-linkedin" href="http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode( get_permalink() ) . '&amp;title=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-linkedin"></i></a>';
			}
			//tumblr
			if ( ! empty( $enable_tumblr ) ) {
				$str .= ' <a class="share-bar-el icon-tumblr" href="http://www.tumblr.com/share/link?url=' . urlencode( get_permalink() ) . '&amp;name=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '&amp;description=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-tumblr"></i></a>';
			}
			//vk
			if ( ! empty( $enable_vk ) ) {
				$str .= '<a class="share-bar-el icon-vk"  href="http://vkontakte.ru/share.php?url=' . urldecode( get_permalink() ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-vk"></i></a>';
			}
			//reddit
			if ( ! empty( $enable_reddit ) ) {
				$str .= '<a class="share-bar-el icon-reddit" href="http://www.reddit.com/submit?url=' . urlencode( get_permalink() ) . '&title=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-reddit"></i></a>';
			}
			//email
			if ( ! empty( $enable_email ) ) {
				$str .= '<a class="share-bar-el icon-email" href="mailto:?subject=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '&BODY=' . urlencode(esc_html__( 'I found this article interesting and thought of sharing it with you. Check it out:', 'look' )) . urlencode( get_permalink() ) . '"><i class="fa fa-envelope-o"></i></a>';
			}

			return $str;
		}

	}
}

