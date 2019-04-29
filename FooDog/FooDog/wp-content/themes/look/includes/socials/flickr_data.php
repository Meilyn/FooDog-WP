<?php
if ( ! class_exists( 'look_ruby_flickr_data' ) ) {
	class look_ruby_flickr_data {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $flickr_id
		 * @param int $num_images
		 * @param string $tags
		 *
		 * @return array|mixed
		 * get flickr data
		 */
		static function get_data( $flickr_id, $num_images = 9, $tags = '' ) {
			if ( empty( $flickr_id ) ) {
				return array();
			};

			$look_ruby_args = array( 'timeout' => 100 );

			$response = wp_remote_get( 'http://api.flickr.com/services/feeds/photos_public.gne?format=json&id=' . urlencode( $flickr_id ) . '&nojsoncallback=1&tags=' . urlencode( $tags ), $look_ruby_args );
			if ( is_wp_error( $response ) || '200' != $response['response']['code'] ) {
				return array();
			}
			$response = wp_remote_retrieve_body( $response );
			$response = str_replace( "\\'", "'", $response );
			$content  = json_decode( $response, true );
			if ( is_array( $content ) ) {
				$content = array_slice( $content['items'], 0, $num_images );
				foreach ( $content as $i => $v ) {
					$content[ $i ]['media'] = preg_replace( '/_m\.(jp?g|png|gif)$/', '_s.\\1', $v['media']['m'] );
				}

				return $content;
			} else {
				return array();
			}
		}
	}
}
