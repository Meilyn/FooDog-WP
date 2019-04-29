<?php
if ( ! class_exists( 'look_ruby_instagram_data' ) ) {
	class look_ruby_instagram_data {

		static function get_data( $instagram_token, $cache_name = '', $num_images = 9, $tags = '' ) {

			if ( ! empty( $instagram_token ) ) {
				$user = explode( ".", $instagram_token );

				if ( empty( $user[0] ) ) {
					return ' <div class="ruby-error">' . esc_html__( 'API error...', 'look' ) . '</div>';
				} else {
					$args_data = array(
						'sslverify' => false,
						'timeout'   => 100
					);

					if ( ! empty( $tags ) ) {
						$response = wp_remote_get( 'https://api.instagram.com/v1/tags/' . $tags . '/media/recent/?access_token=' . $instagram_token . '&count=' . $num_images, $args_data );
					} else {
						$response = wp_remote_get( 'https://api.instagram.com/v1/users/' . $user[0] . '/media/recent/?access_token=' . $instagram_token . '&count=' . $num_images, $args_data );
					}

					if ( is_wp_error( $response ) || empty( $response['response']['code'] ) || 200 != $response['response']['code'] ) {
						return ' <div class="ruby-error">' . esc_html__( 'Configuration error or no pictures...', 'look' ) . '</div>';

					} else {

						$data_images = json_decode( wp_remote_retrieve_body( $response ) );
						set_transient( $cache_name, $data_images, 12000 );

						return $data_images;
					}
				}
			} else {
				return ' <div class="ruby-error">' . esc_html__( 'Empty instagram token...', 'look' ) . '</div>';
			}
		}
	}
}
