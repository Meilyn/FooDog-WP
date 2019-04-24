<?php
/**
 * Class look_ruby_post_view
 * this file support view of post
 */
if ( ! class_exists( 'look_ruby_post_view' ) ) {
	class look_ruby_post_view {


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return bool
		 * add post views
		 */
		static function add_view() {

			//get post id
			$post_id = get_the_ID();
			if ( empty( $post_id ) ) {
				return false;
			}

			//add real view
			$real_count  = get_post_meta( $post_id, 'look_ruby_num_view', true );
			$total_count = get_post_meta( $post_id, 'look_ruby_total_num_view', true );

			if ( ! empty( $real_count ) ) {
				$real_count ++;
				update_post_meta( $post_id, 'look_ruby_num_view', $real_count );

				if ( self::check_forgery_change() ) {
					self::add_new_view_forgery();
				} else {
					$total_count ++;
					update_post_meta( $post_id, 'look_ruby_total_num_view', $total_count );
				}
			} else {

				//add real view
				delete_post_meta( $post_id, 'look_ruby_num_view' );
				add_post_meta( $post_id, 'look_ruby_num_view', 1 );

				if ( self::check_forgery_change() ) {
					self::add_new_view_forgery();
				} else {
					delete_post_meta( $post_id, 'look_ruby_total_num_view' );
					add_post_meta( $post_id, 'look_ruby_total_num_view', 1 );
				}
			}

			return false;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return int|mixed
		 * get view of posts
		 */
		static function get_view() {
			$post_id = get_the_ID();

			//check
			if ( empty( $post_id ) ) {
				return false;
			}

			//check if config has been change
			if ( self::check_forgery_change() ) {
				self::add_new_view_forgery();
			};

			//get total post views
			$total_count = get_post_meta( $post_id, 'look_ruby_total_num_view', true );
			$total_count = look_ruby_core::show_over_100k( $total_count );

			return $total_count;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return bool
		 * check forgery change
		 */
		static function check_forgery_change() {

			$post_id                      = get_the_ID();
			$forgery_view_config          = absint( look_ruby_core::get_option( 'start_view' ) );
			$forgery_view_database_config = get_post_meta( $post_id, 'look_ruby_forgery_post_view', true );

			if ( empty( $forgery_view_config ) ) {
				if ( ! empty( $forgery_view_database_config ) ) {
					delete_post_meta( $post_id, 'look_ruby_forgery_post_view' );

					return true;
				} else {
					return false;
				}

			} else {
				if ( $forgery_view_config != $forgery_view_database_config ) {

					delete_post_meta( $post_id, 'look_ruby_forgery_post_view' );
					add_post_meta( $post_id, 'look_ruby_forgery_post_view', $forgery_view_config );

					return true;

				} else {
					return false;
				}
			}
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return bool
		 * add add_new_view_forgery
		 */
		static function add_new_view_forgery() {
			$post_id = get_the_ID();

			$real_count          = get_post_meta( $post_id, 'look_ruby_num_view', true );
			$forgery_view_config = absint( look_ruby_core::get_option( 'start_view' ) );

			//if empty input then remove random
			if ( ! empty( $forgery_view_config ) ) {
				$rand_forgery = self::create_rand_forgery();
			} else {
				$rand_forgery = 0;
			}

			//add total view to database
			delete_post_meta( $post_id, 'look_ruby_total_num_view' );
			add_post_meta( $post_id, 'look_ruby_total_num_view', intval( $real_count + $rand_forgery ) );

			return false;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return int
		 * create rand forgery
		 */
		static function create_rand_forgery() {

			$post_id             = get_the_ID();
			$forgery_view_config = absint( look_ruby_core::get_option( 'start_view' ) );

			//create random count
			if ( $forgery_view_config - 500 > 0 ) {
				$val = rand( $forgery_view_config - 500, $forgery_view_config + 500 );
			} else {
				$val = rand( 0, $forgery_view_config + 500 );
			};

			delete_post_meta( $post_id, 'look_ruby_start_post_view_data' );
			add_post_meta( $post_id, 'look_ruby_start_post_view_data', true );

			return $val;
		}

	}
}
