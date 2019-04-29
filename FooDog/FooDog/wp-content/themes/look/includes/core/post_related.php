<?php

/**
 * Class look_ruby_post_related
 * this file support related post
 */
if ( ! class_exists( 'look_ruby_post_related' ) ) {
	class look_ruby_post_related {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array|string
		 * get related data
		 */
		static function get_data() {

			//query related
			$related_where   = look_ruby_core::get_option( 'single_post_related_where' );
			$number_of_post  = look_ruby_core::get_option( 'single_post_related_number_of_post' );
			$categories_data = get_the_category();
			$tags_data       = get_the_tags();
			$category_ids    = '';
			$tags            = '';
			$options         = array();
			$data_query      = '';

			//get string category id
			foreach ( $categories_data as $category ) {
				$category_ids .= $category->term_id . ',';
			}

			$category_ids = substr( $category_ids, 0, - 1 );

			//get string tags
			if ( ! empty( $tags_data ) ) {
				foreach ( $tags_data as $tag ) {
					$tags .= $tag->slug . ',';
				}
				$tags = substr( $tags, 0, - 1 );
			} else {

				//set same category if tags not found
				$related_where = 'categories';
			}

			//get number of related
			if ( empty( $number_of_post ) ) {
				$options['posts_per_page'] = 3;
			} else {
				$options['posts_per_page'] = $number_of_post;
			}

			$options['post_not_in'] = get_the_ID();

			switch ( $related_where ) {

				//case all
				case 'all' : {
					$options['tags'] = $tags;
					$data_query      = look_ruby_query::get_custom_query( $options )->posts;

					//check not enough post by tags
					$count = count( $data_query );

					if ( $count < $options['posts_per_page'] ) {

						//reset query options
						foreach ( $data_query as $post_related ) {
							$options['post_not_in'] .= ',' . $post_related->ID;
						}
						$options['category_ids'] = $category_ids;
						unset( $options['tags'] );
						$options['posts_per_page'] = $options['posts_per_page'] - $count;
						$data_query_more           = look_ruby_query::get_custom_query( $options )->posts;

						//add categories related to tags related
						if ( ! empty( $data_query_more ) ) {
							foreach ( $data_query_more as $data ) {
								$data_query[] = $data;
							}
						}
					};

					break;
				}

				case 'tags' : {
					$options['tags'] = $tags;
					$data_query      = look_ruby_query::get_custom_query( $options )->posts;
					break;
				}

				case 'categories' : {
					$options['category_ids'] = $category_ids;
					$data_query              = look_ruby_query::get_custom_query( $options )->posts;
					break;
				}
			};

			return $data_query;
		}
	}
}