<?php
/**
 * this file support google ads responsive
 */

if ( ! class_exists( 'look_ruby_ad_support' ) ) {
	class look_ruby_ad_support {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $google_ads_code
		 *
		 * @return array|bool
		 * get spot id of google
		 */
		static function get_spot_id( $google_ads_code ) {
			$ads_data = array();
			if ( empty( $google_ads_code ) ) {
				return false;
			}

			$google_ads_code = html_entity_decode( stripcslashes( $google_ads_code ) );

			//check google ads code
			if ( preg_match( '/googlesyndication.com/', $google_ads_code ) ) {

				//get ads client
				$array_ad_client_code = explode( 'data-ad-client', $google_ads_code );
				if ( empty( $array_ad_client_code[1] ) ) {
					return false;
				}
				preg_match( '/"([a-zA-Z0-9-\s]+)"/', $array_ad_client_code[1], $match_data_ad_client );
				$data_ad_client = str_replace( array( '"', ' ' ), array( '' ), $match_data_ad_client[1] );

				//get ads slot
				$array_ad_slot_code = explode( 'data-ad-slot', $google_ads_code );
				if ( empty( $array_ad_slot_code[1] ) ) {
					return false;
				}
				preg_match( '/"([a-zA-Z0-9\s]+)"/', $array_ad_slot_code[1], $match_data_add_slot );
				$data_ad_slot = str_replace( array( '"', ' ' ), array( '' ), $match_data_add_slot[1] );

				if ( ! empty( $data_ad_client ) && ! empty( $data_ad_slot ) ) {
					$ads_data['data_ad_client'] = $data_ad_client;
					$ads_data['data_ad_slot']   = $data_ad_slot;
				}

				return $ads_data;

			} else {
				//not google ads
				return false;
			}
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $type
		 *
		 * @return array
		 * get ads size
		 */
		static function get_size_ads( $type ) {
			if ( empty( $type ) ) {
				$type = 'header_ad';
			}
			$size = array();
			switch ( $type ) {
				case 'header_ad' :
				case 'content_ad' :
				case 'footer_ad' :
					$size = array(
						'des_w'   => '728',
						'des_h'   => '90',
						'table_w' => '468',
						'table_h' => '60',
						'phone_w' => '300',
						'phone_h' => '50'
					);
					break;
				case 'sidebar_ad' :
					$size = array(
						'des_w'   => '300',
						'des_h'   => '250',
						'table_w' => '160',
						'table_h' => '600',
						'phone_w' => '300',
						'phone_h' => '250'
					);
					break;
			}

			return $size;
		}


		/**
		 * @param $google_ads_code
		 * @param $type
		 *
		 * @return string
		 * render google ads code
		 */
		static function render_google_ads( $google_ads_code, $type = 'sidebar_ad' ) {
			//check empty
			if ( empty( $google_ads_code ) ) {
				return false;
			}

			$ads_data = self::get_spot_id( $google_ads_code );
			//check google code
			if ( empty( $ads_data['data_ad_client'] ) ) {
				return $google_ads_code;
			}

			//get google ads cache
			$ads_cache = get_transient( 'look_ruby_ads_data_' . strip_tags( $ads_data['data_ad_client'] ) . '_' . $type );

			if ( empty( $ads_cache ) ) {

				$ad_cache_time = 6; //hour

				$size = self::get_size_ads( $type );
				//is not google ads code
				if ( empty( $ads_data['data_ad_client'] ) || empty( $ads_data['data_ad_slot'] ) ) {
					return $google_ads_code;
				}

				$str = '';
				$str .= '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
				$str .= '<!--header-->';
				$str .= '<script type="text/javascript">' . "\n";
				$str .= 'var screen_width = document.body.clientWidth;' . "\n";
				$str .= ' if ( screen_width >= 1110 ) {
                        document.write(\'<ins class="adsbygoogle" style="display:inline-block;width:' . $size['des_w'] . 'px;height:' . $size['des_h'] . 'px" data-ad-client="' . $ads_data['data_ad_client'] . '" data-ad-slot="' . $ads_data['data_ad_slot'] . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }';
				$str .= 'if ( screen_width >= 768  && screen_width < 1110 ) {
                        document.write(\'<ins class="adsbygoogle" style="display:inline-block;width:' . $size['table_w'] . 'px;height:' . $size['table_h'] . 'px" data-ad-client="' . $ads_data['data_ad_client'] . '" data-ad-slot="' . $ads_data['data_ad_slot'] . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }';

				$str .= 'if ( screen_width < 768 ) {
                        document.write(\'<ins class="adsbygoogle" style="display:inline-block;width:' . $size['phone_w'] . 'px;height:' . $size['phone_h'] . 'px" data-ad-client="' . $ads_data['data_ad_client'] . '" data-ad-slot="' . $ads_data['data_ad_slot'] . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }';

				$str .= '</script>' . "\n";

				//save to cache
				set_transient( 'look_ruby_ads_data_' . esc_attr( $ads_data['data_ad_client'] ) . '_' . $type, $str, $ad_cache_time * 3600 );

				return $str;

			} else {
				return $ads_cache;
			}
		}

	}
}
