<?php


/**
 * Class look_ruby_social_fan
 * this file count fan of website on socials
 */
class look_ruby_social_fan {

	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $url
	 *
	 * @return bool
	 * count facebook follower
	 */
	static function count_facebook( $url ) {
		//check
		if ( empty( $url ) ) {
			return false;
		}

		$params = array(
			'sslverify' => false,
			'timeout'   => 100
		);

		$fb_access_token = 'CAAF5MfMU36oBAKOjOZBWjtck3gWyBMPmK14SYHZATGS3vrqFKS9DyhIyXpBUeKZBcqLlIwtUR5okoIT1P23EB5yiCK72RTytZB6y6kEnky2QaHztDP3YyBZBFMhaZAJTq4khSjWCFkuTPZAkLfbvm9KFumBXbnOffVx5GlbQIPmWg0H7YLiGpri';
		$response             = wp_remote_get( 'https://graph.facebook.com/v2.3/' . urlencode( $url ) . '?access_token=' . $fb_access_token, $params );

		if ( is_wp_error( $response ) || empty( $response['response']['code'] ) || '200' != $response['response']['code'] ) {
			return false;
		}

		$data = json_decode( wp_remote_retrieve_body( $response ) );
		if ( ! empty( $data->likes ) ) {
			return $data->likes;
		} else {
			return false;
		}
	}

	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param       $user
	 *
	 * @return int
	 * count twitter follower
	 */
	static function count_twitter( $user ) {
		//check options
		if ( empty( $user ) ) {
			return false;
		}

		$params = array(
			'timeout'   => 120,
			'sslverify' => false
		);

		$filter   = array(
			'start_1' => 'ProfileNav-item--followers',
			'start_2' => 'title',
			'end'     => '>'
		);
		$response = wp_remote_get( 'https://twitter.com/' . $user, $params );

		//check & return
		if ( is_wp_error( $response ) || empty( $response['response']['code'] ) || '200' != $response['response']['code'] ) {
			return false;
		}
		//get content
		$response = wp_remote_retrieve_body( $response );

		if ( ! empty( $response ) && $response !== false ) {
			foreach ( $filter as $key => $value ) {

				$key = explode( '_', $key );
				$key = $key[0];

				if ( $key == 'start' ) {
					$key = false;
				} else if ( $value == 'end' ) {
					$key = true;
				}
				$key = (bool) $key;

				$index = strpos( $response, $value );
				if ( $index === false ) {
					return false;
				}
				if ( $key ) {
					$response = substr( $response, 0, $index );
				} else {
					$response = substr( $response, $index + strlen( $value ) );
				}
			}

			if ( strlen( $response ) > 100 ) {
				return false;
			}

			$count = self::extract_one_number( $response );

			if ( ! is_numeric( $count ) || strlen( number_format( $count ) ) > 15 ) {
				return false;
			}

			$count = intval( $count );

			return $count;
		} else {
			return false;
		}

	}

	static function extract_one_number( $str ) {
		return intval( preg_replace( '/[^0-9]+/', '', $str ), 10 );
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $api
	 *
	 * @return array
	 * count instagram followers
	 */
	static function count_instagram( $api ) {
		//check option
		if ( empty( $api ) ) {
			return false;
		}

		$users = explode( ".", $api );
		if ( empty( $users[0] ) ) {
			return false;
		}
		$data = array();
		$url  = 'https://api.instagram.com/v1/users/' . $users[0] . '/?access_token=' . $api;

		$params = array(
			'timeout' => 100
		);

		$response = wp_remote_get( $url, $params );

		if ( is_wp_error( $response ) || empty( $response['response']['code'] ) || '200' != $response['response']['code'] ) {
			return false;
		}

		$response = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( empty( $response['data']['counts']['followed_by'] ) || empty( $response['data']['username'] ) ) {
			return false;
		}

		$data['count']     = $response['data']['counts']['followed_by'];
		$data['user_name'] = $response['data']['username'];
		$data['url']       = 'http://instagram.com/' . $data['user_name'];

		return $data;
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $user
	 * @param $token
	 *
	 * @return bool
	 * count dribbble followers
	 */
	static function  count_dribbble( $user, $token ) {
		if ( empty( $user ) || empty( $token ) ) {
			return false;
		}

		$params = array(
			'sslverify' => false,
			'timeout'   => 100,
		);

		$response = wp_remote_get( 'https://api.dribbble.com/v1/users/' . $user . '?access_token=' . $token, $params );

		if ( is_wp_error( $response ) || empty( $response['response']['code'] ) || '200' != $response['response']['code'] ) {
			return false;
		}

		$response = json_decode( wp_remote_retrieve_body( $response ) );
		if ( ! empty( $response->followers_count ) ) {
			return $response->followers_count;
		} else {
			return false;
		}
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $user
	 * @param $channel
	 *
	 * @return bool
	 * count youtube Subscriber
	 */
	static function count_youtube( $user, $channel ) {
		//check
		if ( empty( $user ) && empty ( $channel ) ) {
			return false;
		};

		if ( ! empty( $user ) ) {
			$url = "https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=" . $user . "&key=AIzaSyB9OPUPAtVh3_XqrByTwBTSDrNzuPZe8fo";
		} else {
			$url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&id=' . $channel . '&key=AIzaSyB9OPUPAtVh3_XqrByTwBTSDrNzuPZe8fo';
		};

		$params = array(
			'sslverify' => false,
			'timeout'   => 100
		);

		$response = wp_remote_get( $url, $params );

		if ( is_wp_error( $response ) || empty( $response['response']['code'] ) || '200' != $response['response']['code'] ) {
			return false;
		}

		$response = json_decode( wp_remote_retrieve_body( $response ) );
		if ( ! empty( $response->items[0]->statistics->subscriberCount ) ) {
			return $response->items[0]->statistics->subscriberCount;
		} else {
			return false;
		}
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $user
	 * @param $api
	 *
	 * @return bool
	 * count soundclound follower
	 */
	static function count_soundclound( $user, $api ) {

		//check
		if ( empty( $user ) || empty( $api ) ) {
			return false;
		}

		$url      = 'http://api.soundcloud.com/users/' . $user . '.json?consumer_key=' . $api;
		$response = wp_remote_get( $url, array( 'timeout' => 100 ) );

		if ( is_wp_error( $response ) || empty( $response['response']['code'] ) || '200' != $response['response']['code'] ) {
			return false;
		}

		$response = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( empty( $response['followers_count'] ) || empty( $response['permalink_url'] ) ) {
			return false;
		};
		$data['count'] = esc_attr( $response['followers_count'] );
		$data['url']   = esc_url( $response['permalink_url'] );

		return $data;
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $user
	 *
	 * @return bool|int
	 * counter pinterest followers
	 */
	static function count_pinterest( $user ) {
		//check
		if ( empty( $user ) ) {
			return false;
		}

		$response = get_meta_tags( 'http://pinterest.com/' . $user . '/' );
		if ( ! empty( $response ) && ! empty( $response['pinterestapp:followers'] ) ) {
			return intval( strip_tags( $response['pinterestapp:followers'] ) );
		} else {
			return false;
		}
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $user
	 *
	 * @return bool
	 * count vimeo followers
	 */
	static function count_vimeo( $user ) {
		//check
		if ( empty( $user ) ) {
			return false;
		};
		$url      = 'https://vimeo.com/api/v2/' . $user . '/info.json';
		$response = wp_remote_get( $url, array( 'timeout' => 100 ) );

		if ( is_wp_error( $response ) || empty( $response['response']['code'] ) || '200' != $response['response']['code'] ) {
			return false;
		}

		$response = json_decode( wp_remote_retrieve_body( $response ) );
		if ( ! empty( $response->total_contacts ) ) {
			return $response->total_contacts;
		} else {
			return false;
		}
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param string $social
	 * @param array  $option
	 *
	 * @return array|bool|int|mixed|string
	 * get count for sidebar widget and save to cache.
	 */
	static function get_sidebar_social_counter( $social = '', $option = array() ) {

		$cache_data_name = 'look_ruby_sb_social_fan_' . $social;
		$cache           = get_transient( $cache_data_name );

		if ( false === $cache ) {
			$data        = '';
			$cache_hours = 6;
			switch ( $social ) {
				case 'facebook_page' :
					$data = look_ruby_social_fan::count_facebook( $option['facebook_page'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'twitter' :
					$data = look_ruby_social_fan::count_twitter( $option['twitter_user'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'instagram' :
					$data = look_ruby_social_fan::count_instagram( $option['instagram_api'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'youtube' :
					$data = look_ruby_social_fan::count_youtube( $option['youtube_user'], $option['youtube_channel'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'dribbble' :
					$data = look_ruby_social_fan::count_dribbble( $option['dribbble_user'], $option['dribbble_token'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'pinterest' :
					$data = look_ruby_social_fan::count_pinterest( $option['pinterest_user'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'soundcloud' :
					$data = look_ruby_social_fan::count_soundclound( $option['soundcloud_user'], $option['soundcloud_api'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'vimeo' :
					$data = look_ruby_social_fan::count_vimeo( $option['vimeo_user'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
			}

			return $data;
		} else {
			return $cache;
		}
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param string $social
	 * @param array  $option
	 *
	 * @return array|bool|int|mixed|string
	 * get count for footer widget and save to cache.
	 */
	/*static function get_footer_social_counter( $social = '', $option = array() ) {
		$cache_data_name = 'look_ruby_ft_social_fan_' . $social;
		$cache           = get_transient( $cache_data_name );

		if ( false === $cache ) {
			$data        = '';
			$cache_hours = 6;
			switch ( $social ) {
				case 'facebook_page' :
					$data = look_ruby_social_fan::count_facebook( $option['facebook_page'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'twitter' :
					$data = look_ruby_social_fan::count_twitter( $option['twitter_user'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'instagram' :
					$data = look_ruby_social_fan::count_instagram( $option['instagram_api'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'youtube' :
					$data = look_ruby_social_fan::count_youtube( $option['youtube_user'], $option['youtube_channel'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'dribbble' :
					$data = look_ruby_social_fan::count_dribbble( $option['dribbble_user'], $option['dribbble_token'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'pinterest' :
					$data = look_ruby_social_fan::count_pinterest( $option['pinterest_user'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'soundcloud' :
					$data = look_ruby_social_fan::count_soundclound( $option['soundcloud_user'], $option['soundcloud_api'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
				case 'vimeo' :
					$data = look_ruby_social_fan::count_vimeo( $option['vimeo_user'] );
					set_transient( $cache_data_name, $data, 60 * 60 * $cache_hours );
					break;
			}

			return $data;
		} else {
			return $cache;
		}
	}*/



}