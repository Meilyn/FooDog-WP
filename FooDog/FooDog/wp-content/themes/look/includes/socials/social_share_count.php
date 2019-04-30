<?php
if ( ! class_exists( 'look_ruby_social_share_count' ) ) {
	class look_ruby_social_share_count {

		static function count_all_share() {

			//get URL
			$url = get_permalink();
			if ( empty( $url ) ) {
				return false;
			}

			$url_snip             = look_ruby_multi_sidebar::name_to_id( substr( $url, 0, 40 ) );
			$url_shares_transient = 'look_ruby_share_' . $url_snip;
			$cache            = get_transient( $url_shares_transient );

			if ( $cache !== false ) {
				return $cache;
			} else {

				//facebook
				$json_string = wp_remote_get( 'http://graph.facebook.com/?ids=' . $url, array( 'timeout' => 100 ) );
				if ( ! is_wp_error( $json_string ) && isset( $json_string['body'] ) ) {
					$json              = json_decode( $json_string['body'], true );
					$count['facebook'] = isset( $json[ $url ]['shares'] ) ? intval( ( $json[ $url ]['shares'] ) ) : 0;
				} else {
					$count['facebook'] = 0;
				}

				//linkedin
				$json_string = wp_remote_get( "http://www.linkedin.com/countserv/count/share?url=$url&format=json", array( 'timeout' => 100 ) );
				if ( ! is_wp_error( $json_string ) && isset( $json_string['body'] ) ) {
					$json              = json_decode( $json_string['body'], true );
					$count['linkedin'] = isset( $json['count'] ) ? intval( $json['count'] ) : 0;
				} else {
					$count['linkedin'] = 0;
				}


				//Pinterest
				$json_string = wp_remote_get( 'http://api.pinterest.com/v1/urls/count.json?url=' . $url, array( 'timeout' => 100 ) );
				if ( ! is_wp_error( $json_string ) && isset( $json_string['body'] ) ) {
					$json_string        = preg_replace( '/^receiveCount\((.*)\)$/', "\\1", $json_string['body'] );
					$json               = json_decode( $json_string, true );
					$count['pinterest'] = isset( $json['count'] ) ? intval( $json['count'] ) : 0;
				} else {
					$count['pinterest'] = 0;
				}

				//google plus
				$count['plus_one'] = 0;
				$google_args       = array(
					'headers' => array( 'Content-type' => 'application/json-rpc' ),
					'body'    => '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]',
				);
				$google_url        = 'https://clients6.google.com/rpc?key=AIzaSyCKSbrvQasunBoV16zDH9R33D88CeLr9gQ';
				$json_string       = wp_remote_post( $google_url, $google_args, array( 'timeout' => 100 ) );
				if ( ! is_wp_error( $json_string ) && isset( $json_string['body'] ) ) {
					$data = json_decode( $json_string['body'] );
					if ( ! is_null( $data ) ) {
						if ( is_array( $data ) && count( $data ) == 1 ) {
							$data = array_shift( $data );
						}
						if ( isset( $data->result->metadata->globalCounts->count ) ) {
							$count['plus_one'] = $data->result->metadata->globalCounts->count;
						}
					}
				}

				//count all
				$count['all'] = $count['facebook'] + $count['pinterest'] + $count['plus_one'] + $count['linkedin'];

				set_transient( $url_shares_transient, $count, 60 * 60 * 5 );

				return $count;
			}
		}


	}
}