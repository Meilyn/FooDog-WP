<?php

if ( ! class_exists( 'look_ruby_post_review' ) ) {
	class look_ruby_post_review {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return bool
		 * check review
		 */
		static function has_review() {

			//check
			$post_id       = get_the_ID();
			$total_score   = get_post_meta( $post_id, 'look_ruby_as', true );
			$enable_review = get_post_meta( $post_id, 'look_ruby_enable_review', true );
			if ( ( $total_score ) && ( $enable_review ) ) {
				return true;
			} else {
				return false;
			}
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return mixed|string
		 * review box position
		 */
		static function review_box_position() {

			$review_box_position = get_post_meta( get_the_ID(), 'look_ruby_review_box_position', true );
			if ( empty( $review_box_position ) || 'default' == $review_box_position ) {
				$review_box_position = look_ruby_core::get_option( 'default_single_post_review_position' );
			}

			return $review_box_position;
		}

	}
}