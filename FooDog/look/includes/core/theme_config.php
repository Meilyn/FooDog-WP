<?php
/**
 * this file register config options for theme
 */
if ( ! class_exists( 'look_ruby_theme_config' ) ) {
	class look_ruby_theme_config {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return mixed
		 * get all sidebar after load
		 */
		static function get_all_sidebar() {

			if ( ! is_admin() ) {
				return false;
			}

			return $GLOBALS['wp_registered_sidebars'];
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * select category
		 */
		static function category_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			$categories = get_categories( array(
				'hide_empty' => 0,
			) );

			$category_array_walker = new look_ruby_category_array_walker;
			$category_array_walker->walk( $categories, 4 );
			$categories_buffer = $category_array_walker->cat_array;

			//render
			$str = '';
			$str .= '<select class="ruby-field ruby-field-select">';
			$str .= '<option value="0" selected="selected">' . esc_html__( '-- All categories --', 'look' ) . '</option>';
			foreach ( $categories_buffer as $category_name => $category_id ) {
				$str .= '<option value="' . esc_attr( $category_id ) . '">';
				$str .= esc_html( $category_name );
				$str .= '</option>';
			}

			$str .= '</select><!--#category select-->';

			return $str;

		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * select category
		 */
		static function categories_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			if ( ! is_admin() ) {
				return false;
			}

			$categories = get_categories( array(
				'hide_empty' => 0,
			) );

			$category_array_walker = new look_ruby_category_array_walker;
			$category_array_walker->walk( $categories, 4 );
			$categories_buffer = $category_array_walker->cat_array;

			//render
			$str = '';
			$str .= '<select class="ruby-field ruby-field-select" multiple="multiple">';
			$str .= '<option value="0" selected="selected">' . esc_html__( '-- None --', 'look' ) . '</option>';
			foreach ( $categories_buffer as $category_name => $category_id ) {
				$str .= '<option value="' . esc_attr( $category_id ) . '">';
				$str .= esc_html( $category_name );
				$str .= '</option>';
			}

			$str .= '</select><!--#categories select-->';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * post format dropdown select
		 */
		static function post_format_dropdown_select() {

			//render
			$str = '';
			$str .= '<select class="ruby-field ruby-field-select">';
			$str .= '<option value="0" selected="selected">' . esc_html__( '-- All --', 'look' ) . '</option>';
			$str .= '<option value="default">' . esc_html__( 'Default', 'look' ) . '</option>';
			$str .= '<option value="gallery">' . esc_html__( 'Gallery', 'look' ) . '</option>';
			$str .= '<option value="video">' . esc_html__( 'Video', 'look' ) . '</option>';
			$str .= '<option value="audio">' . esc_html__( 'Audio', 'look' ) . '</option>';
			$str .= '</select><!--#post format select-->';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * Order config
		 */
		static function orderby_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			$orderby_data = array(
				'date_post'               => esc_html__( 'Latest Post', 'look' ),
				'comment_count'           => esc_html__( 'Popular Comment', 'look' ),
				'popular'                 => esc_html__( 'Popular View', 'look' ),
				'top_review'              => esc_html__( 'Top Reviews', 'look' ),
				'last_review'             => esc_html__( 'Latest Reviews', 'look' ),
				'post_type'               => esc_html__( 'Post Type', 'look' ),
				'rand'                    => esc_html__( 'Random', 'look' ),
				'author'                  => esc_html__( 'Author', 'look' ),
				'alphabetical_order_decs' => esc_html__( 'Title DECS', 'look' ),
				'alphabetical_order_asc'  => esc_html__( 'Title ACS', 'look' )
			);

			$str = '';
			$str .= '<select class="ruby-field ruby-field-select">';
			foreach ( $orderby_data as $val => $title ) {
				$str .= '<option value="' . esc_attr( $val ) . '">' . esc_html( $title ) . '</option>';
			}
			$str .= '</select>';

			return $str;
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array
		 * post order config
		 */
		static function post_orders() {

			if ( ! is_admin() ) {
				return false;
			}

			return array(
				'date_post'               => esc_html__( 'Latest Post', 'look' ),
				'comment_count'           => esc_html__( 'Popular Comment', 'look' ),
				'popular'                 => esc_html__( 'Popular View', 'look' ),
				'top_review'              => esc_html__( 'Top Reviews', 'look' ),
				'last_review'             => esc_html__( 'Latest Reviews', 'look' ),
				'post_type'               => esc_html__( 'Post Type', 'look' ),
				'rand'                    => esc_html__( 'Random', 'look' ),
				'author'                  => esc_html__( 'Author', 'look' ),
				'alphabetical_order_decs' => esc_html__( 'Title DECS', 'look' ),
				'alphabetical_order_asc'  => esc_html__( 'Title ACS', 'look' )
			);
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * select author
		 */
		static function author_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			return wp_dropdown_users(
				array(
					'show_option_all' => esc_html__( 'All Authors', 'look' ),
					'orderby'         => 'ID',
					'class'           => 'ruby-field',
					'echo'            => 0,
					'hierarchical'    => true
				)
			);
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $display_default
		 *
		 * @return array
		 * sidebar name options config
		 */
		static function sidebar_name( $display_default = false ) {

			$sidebar_options = array();
			$custom_sidebars = get_option( 'look_ruby_custom_multi_sidebars', '' );

			//add default sidebar
			if ( true === $display_default ) {
				$sidebar_options['look_ruby_default_from_theme_options'] = esc_html__( 'Default From Theme Options', 'look' );
			};

			//handle sidebar option
			if ( ! empty( $custom_sidebars ) && is_array( $custom_sidebars ) ) {
				foreach ( $custom_sidebars as $sidebar ) {
					$sidebar_options[ $sidebar['id'] ] = $sidebar['name'];
				};
			};

			return $sidebar_options;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param bool $default
		 *
		 * @return array
		 * sidebar position config
		 */
		static function sidebar_position( $default = true ) {

			if ( ! is_admin() ) {
				return false;
			}

			$sidebar = array(
				'right' => array(
					'alt'   => 'right sidebar',
					'img'   => get_template_directory_uri() . '/theme_options/images/right-sidebar.png',
					'title' => esc_html__( 'Right', 'look' )
				),
				'left'  => array(
					'alt'   => 'left sidebar',
					'img'   => get_template_directory_uri() . '/theme_options/images/left-sidebar.png',
					'title' => esc_html__( 'Left', 'look' )
				),
				'none'  => array(
					'alt'   => 'none sidebar',
					'img'   => get_template_directory_uri() . '/theme_options/images/none-sidebar.png',
					'title' => esc_html__( 'None', 'look' )
				)
			);

			//load default setting
			if ( true === $default ) {
				$sidebar['default'] = array(
					'alt'   => 'Default',
					'img'   => get_template_directory_uri() . '/theme_options/images/default-sidebar.png',
					'title' => esc_html__( 'Default', 'look' )
				);
			};

			return $sidebar;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array
		 * metabox sidebar sidebar potions config value
		 */
		static function metabox_sidebar_position() {

			if ( ! is_admin() ) {
				return false;
			}

			return array(
				'default' => get_template_directory_uri() . '/theme_options/images/default-sidebar.png',
				'none'    => get_template_directory_uri() . '/theme_options/images/none-sidebar.png',
				'left'    => get_template_directory_uri() . '/theme_options/images/left-sidebar.png',
				'right'   => get_template_directory_uri() . '/theme_options/images/right-sidebar.png',
			);
		}

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array
		 * metabox sidebar sidebar potions config value
		 */
		static function metabox_composer_sidebar_position() {

			if ( ! is_admin() ) {
				return false;
			}

			return array(
				'left'  => get_template_directory_uri() . '/theme_options/images/left-sidebar.png',
				'right' => get_template_directory_uri() . '/theme_options/images/right-sidebar.png',
			);
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * enable or disable select option
		 */
		static function enable_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="ruby-field ruby-field-select">';
			$str .= '<option value="0" selected="selected">' . esc_html__( '--Disable--', 'look' ) . '</option>';
			$str .= '<option value="1">' . esc_html__( 'Enable', 'look' ) . '</option>';
			$str .= '</select>';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * wrapmode dropdown select
		 */
		static function wrapmode_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="ruby-field ruby-field-select">';
			$str .= '<option value="0">' . esc_html__( 'Full Width', 'look' ) . '</option>';
			$str .= '<option value="1" selected="selected">' . esc_html__( 'Has Wrapper', 'look' ) . '</option>';
			$str .= '</select>';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * pagination dropdown select
		 */
		static function pagination_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="ruby-field ruby-field-select">';
			$str .= '<option value="0" selected="selected">' . esc_html__( ' -- none -- ', 'look' ) . '</option>';
			$str .= '<option value="next_prev">' . esc_html__( 'Next Prev', 'look' ) . '</option>';
			$str .= '<option value="load_more">' . esc_html__( 'Load More', 'look' ) . '</option>';
			$str .= '<option value="infinite_scroll">' . esc_html__( 'infinite Scroll', 'look' ) . '</option>';
			$str .= '</select>';

			return $str;

		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array|bool
		 * text color style
		 */
		static function text_style() {

			if ( ! is_admin() ) {
				return false;
			}

			return array(
				'is-light-text' => array(
					'alt'   => 'text light',
					'img'   => get_template_directory_uri() . '/theme_options/images/text-light.png',
					'title' => esc_html__( 'Light', 'look' )
				),
				'is-dark-text'  => array(
					'alt'   => 'text dark',
					'img'   => get_template_directory_uri() . '/theme_options/images/text-dark.png',
					'title' => esc_html__( 'Dark', 'look' )
				),
			);
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array
		 * single post layout config for metabox
		 */
		static function metabox_single_layout() {

			if ( ! is_admin() ) {
				return false;
			}

			return array(
				'default' => get_template_directory_uri() . '/theme_options/images/default.png',
				'style_1' => get_template_directory_uri() . '/theme_options/images/single-style-1.png',
				'style_2' => get_template_directory_uri() . '/theme_options/images/single-style-2.png',
				'style_3' => get_template_directory_uri() . '/theme_options/images/single-style-3.png',
				'style_4' => get_template_directory_uri() . '/theme_options/images/single-style-4.png',
				'style_5' => get_template_directory_uri() . '/theme_options/images/single-style-5.png',
				'style_6' => get_template_directory_uri() . '/theme_options/images/single-style-6.png',
			);
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array
		 * single post layout config for theme options
		 */
		static function single_layout() {

			if ( ! is_admin() ) {
				return false;
			}

			return array(
				'style_1' => array(
					'alt'   => 'classic layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/single-style-1.png',
					'title' => esc_html__( 'classic', 'look' )
				),
				'style_2' => array(
					'alt'   => 'classic layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/single-style-2.png',
					'title' => esc_html__( 'classic (crop featured)', 'look' ),
				),
				'style_3' => array(
					'alt'   => 'left title layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/single-style-3.png',
					'title' => esc_html__( 'left title', 'look' ),
				),
				'style_4' => array(
					'alt'   => 'left title layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/single-style-4.png',
					'title' => esc_html__( 'left title (crop featured)', 'look' ),
				),
				'style_5' => array(
					'alt'   => 'fw featured layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/single-style-5.png',
					'title' => esc_html__( 'full featured', 'look' ),
				),
				'style_6' => array(
					'alt'   => 'hide featured layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/single-style-6.png',
					'title' => esc_html__( 'hide featured', 'look' ),
				),
			);
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array|bool
		 * review position
		 */
		static function metabox_review_position() {

			if ( ! is_admin() ) {
				return false;
			}

			return array(
				'default'  => get_template_directory_uri() . '/theme_options/images/default.png',
				'left_top' => get_template_directory_uri() . '/theme_options/images/review-left-top.png',
				'bottom'   => get_template_directory_uri() . '/theme_options/images/review-bottom.png',
			);
		}


		//review box position config values
		static function review_position() {

			if ( ! is_admin() ) {
				return false;
			}

			return array(
				'left_top' => array(
					'alt'   => 'left top position',
					'img'   => get_template_directory_uri() . '/theme_options/images/review-left-top.png',
					'title' => esc_html__( 'Left Top', 'look' )
				),
				'bottom'   => array(
					'alt'   => 'bottom position',
					'img'   => get_template_directory_uri() . '/theme_options/images/review-bottom.png',
					'title' => esc_html__( 'Bottom', 'look' )
				)
			);
		}

		//page layout config values
		static function blog_layout() {

			if ( ! is_admin() ) {
				return false;
			}

			return array(
				'layout_list'          => array(
					'alt'   => 'list layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/layout-list.png',
					'title' => esc_html__( 'list', 'look' )
				),
				'layout_classic'       => array(
					'alt'   => 'classic layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/layout-classic.png',
					'title' => esc_html__( 'Classic', 'look' )
				),
				'layout_classic_lite'  => array(
					'alt'   => 'classic lite layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/layout-classic-lite.png',
					'title' => esc_html__( 'Classic lite', 'look' )
				),
				'layout_grid'          => array(
					'alt'   => 'grid layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/layout-grid.png',
					'title' => esc_html__( 'grid', 'look' )
				),
				'layout_grid_small_s'  => array(
					'alt'   => 'small grid square layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/layout-grid-small-s.png',
					'title' => esc_html__( 'small grid (square)', 'look' )
				),
				'layout_grid_small'    => array(
					'alt'   => 'small grid layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/layout-grid-small.png',
					'title' => esc_html__( 'small grid', 'look' )
				),
				'layout_overlay_small' => array(
					'alt'   => 'List and grid layout',
					'img'   => get_template_directory_uri() . '/theme_options/images/layout-overlay.png',
					'title' => esc_html__( 'overlay grid', 'look' )
				),
			);
		}


		//page layout config values
		static function metabox_blog_layout() {

			if ( ! is_admin() ) {
				return false;
			}

			return array(
				'layout_list'          => get_template_directory_uri() . '/theme_options/images/layout-list.png',
				'layout_classic'       => get_template_directory_uri() . '/theme_options/images/layout-classic.png',
				'layout_classic_lite'  => get_template_directory_uri() . '/theme_options/images/layout-classic-lite.png',
				'layout_grid'          => get_template_directory_uri() . '/theme_options/images/layout-grid.png',
				'layout_grid_small_s'  => get_template_directory_uri() . '/theme_options/images/layout-grid-small-s.png',
				'layout_grid_small'    => get_template_directory_uri() . '/theme_options/images/layout-grid-small.png',
				'layout_overlay_small' => get_template_directory_uri() . '/theme_options/images/layout-overlay.png',
			);
		}


		//featured type config values
		static function feat_type() {
			return array(
				'none'      => array(
					'alt'   => 'none',
					'img'   => get_template_directory_uri() . '/theme_options/images/feat-none.png',
					'title' => esc_attr__( 'None', 'look' )
				),
				'slider_fw' => array(
					'alt'   => 'fullwidth slider',
					'img'   => get_template_directory_uri() . '/theme_options/images/feat-slider-fw.png',
					'title' => esc_attr__( 'FullWidth slider', 'look' )
				),
				'slider_hw' => array(
					'alt'   => 'has wrapper slider',
					'img'   => get_template_directory_uri() . '/theme_options/images/feat-slider-hw.png',
					'title' => esc_attr__( 'Wrapper slider', 'look' )
				),
				'carousel'  => array(
					'alt'   => 'carousel',
					'img'   => get_template_directory_uri() . '/theme_options/images/feat-carousel.png',
					'title' => esc_attr__( 'FullWidth carousel', 'look' )
				),
				'grid'      => array(
					'alt'   => 'grid',
					'img'   => get_template_directory_uri() . '/theme_options/images/feat-grid.png',
					'title' => esc_attr__( 'Wrapper Grid', 'look' )
				)
			);
		}
	}
}


if ( ! class_exists( 'look_ruby_category_array_walker' ) ) {
	class look_ruby_category_array_walker extends Walker {
		var $tree_type = 'category';
		var $cat_array = array();
		var $db_fields = array(
			'id'     => 'term_id',
			'parent' => 'parent'
		);

		public function start_lvl( &$output, $depth = 0, $args = array() ) {
		}

		public function end_lvl( &$output, $depth = 0, $args = array() ) {
		}

		public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
			$this->cat_array[ str_repeat( ' - ', $depth ) . $object->name . ' - [ ID: ' . $object->term_id . ' / Posts: ' . $object->category_count . ' ]' ] = $object->term_id;
		}

		public function end_el( &$output, $object, $depth = 0, $args = array() ) {
		}

	}
}
