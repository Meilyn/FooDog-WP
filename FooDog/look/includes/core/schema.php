<?php
/**
 * this file create chema makup for theme
 */
if ( ! class_exists( 'look_ruby_schema' ) ) {
	class look_ruby_schema {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $context
		 * @param $echo
		 *
		 * @return bool|string
		 * schema markup, good for search engine
		 */
		static function markup( $context, $echo = true ) {

			$str  = '';
			$data = array();

			$http_checker = 'http';

			if ( is_ssl() ) {
				$http_checker = 'https';
			}

			switch ( $context ) {
				case 'body' :
					$data['itemscope'] = true;
					$data['itemtype']  = $http_checker . '://schema.org/WebPage';
					break;

				case 'article' :
					$data['itemscope'] = true;
					$data['itemtype']  = $http_checker . '://schema.org/NewsArticle';
					break;

				case 'review' :
					$data['itemscope'] = true;
					$data['itemtype']  = $http_checker . '://schema.org/Review';
					break;

				case 'menu':
					$data['role']      = 'navigation';
					$data['itemscope'] = true;
					$data['itemtype']  = $http_checker . '://schema.org/SiteNavigationElement';
					break;

				case 'header':
					$data['role']      = 'banner';
					$data['itemscope'] = true;
					$data['itemtype']  = $http_checker . '://schema.org/WPHeader';
					break;

				case 'sidebar':
					$data['role']      = 'complementary';
					$data['itemscope'] = true;
					$data['itemtype']  = $http_checker . '://schema.org/WPSideBar';
					break;

				case 'footer':
					$data['itemscope'] = true;
					$data['itemtype']  = $http_checker . '://schema.org/WPFooter';
					break;

				case 'logo' :
					$data['itemscope'] = true;
					$data['itemtype']  = $http_checker . '://schema.org/Organization';
					break;
			};

			if ( empty( $data ) ) {
				return false;
			}

			foreach ( $data as $k => $v ) {
				if ( true === $v ) {
					$str .= ' ' . $k . ' ';
				} else {
					$str .= ' ' . $k . '="' . $v . '" ';
				}
			}

			//check & return
			if ( true === $echo ) {
				echo( $str );
			} else {
				return ( $str );
			}
		}
	}
}