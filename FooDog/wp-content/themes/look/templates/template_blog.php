<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * render blog listing layout
 */
if ( ! function_exists( 'look_ruby_blog_layout' ) ) {
	function look_ruby_blog_layout( $look_ruby_options ) {

		//get settings
		if ( empty( $look_ruby_options['blog_layout'] ) ) {
			$look_ruby_options['blog_layout'] = 'layout_classic';
		}

		if ( empty( $look_ruby_options['blog_sidebar_position'] ) ) {
			$look_ruby_options['blog_sidebar_position'] = 'right';
		}

		if ( empty( $look_ruby_options['blog_sidebar_name'] ) ) {
			$look_ruby_options['blog_sidebar_name'] = 'look_ruby_sidebar_default';
		}

		//create class
		$classes   = array();
		$classes[] = 'blog-wrap';
		$classes[] = 'is-' . esc_attr( $look_ruby_options['blog_layout'] );
		if ( ! empty( $look_ruby_options['big_first'] ) ) {
			$classes[] = 'has-big-first';
		} else {
			$classes[] = 'no-big-first';
		}
		$classes = implode( ' ', $classes );

		//render
		if ( have_posts() ) {
			look_ruby_template_wrapper::open_page_wrap( $classes, $look_ruby_options['blog_sidebar_position'] );
			look_ruby_template_wrapper::open_page_inner( 'blog-inner', $look_ruby_options['blog_sidebar_position'] );

			switch ( $look_ruby_options['blog_layout'] ) {
				case 'layout_classic' :
					look_ruby_blog_layout_classic( $look_ruby_options );
					break;
				case 'layout_classic_lite' :
					look_ruby_blog_layout_classic_lite( $look_ruby_options );
					break;
				case 'layout_list' :
					look_ruby_blog_layout_list( $look_ruby_options );
					break;
				case 'layout_grid' :
					look_ruby_blog_layout_grid( $look_ruby_options );
					break;
				case 'layout_grid_small' :
					look_ruby_blog_layout_grid_small( $look_ruby_options );
					break;
				case 'layout_grid_small_s' :
					look_ruby_blog_layout_grid_small_s( $look_ruby_options );
					break;
				case 'layout_overlay_small' :
					look_ruby_blog_layout_overlay_small( $look_ruby_options );
					break;
			}

			look_ruby_template_wrapper::close_page_inner();

			//render sidebar
			if ( ! empty( $look_ruby_options['blog_sidebar_position'] ) && 'none' != $look_ruby_options['blog_sidebar_position'] ) {
				look_ruby_template_wrapper::sidebar( $look_ruby_options['blog_sidebar_name'] );
			}

			look_ruby_template_wrapper::close_page_wrap();
		} else {
			get_template_part( 'templates/section', 'no_content' );
		}

	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * render blog listing layout for author page include author box
 */
if ( ! function_exists( 'look_ruby_blog_author_layout' ) ) {
	function look_ruby_blog_author_layout( $look_ruby_options ) {

		//get settings
		if ( empty( $look_ruby_options['blog_layout'] ) ) {
			$look_ruby_options['blog_layout'] = 'layout_classic';
		}

		if ( empty( $look_ruby_options['blog_sidebar_position'] ) ) {
			$look_ruby_options['blog_sidebar_position'] = 'right';
		}

		if ( empty( $look_ruby_options['blog_sidebar'] ) ) {
			$look_ruby_options['blog_sidebar'] = 'look_ruby_sidebar_default';
		}

		//create class
		$classes   = array();
		$classes[] = 'blog-wrap';
		$classes[] = 'is-' . esc_attr( $look_ruby_options['blog_layout'] );
		if ( ! empty( $look_ruby_options['big_first'] ) ) {
			$classes[] = 'has-big-first';
		} else {
			$classes[] = 'no-big-first';
		}
		$classes = implode( ' ', $classes );

		//render
		if ( have_posts() ) {
			look_ruby_template_wrapper::open_page_wrap( $classes, $look_ruby_options['blog_sidebar_position'] );
			look_ruby_template_wrapper::open_page_inner( 'blog-inner', $look_ruby_options['blog_sidebar_position'] );

			//author box
			get_template_part( 'templates/single/box', 'author' );

			switch ( $look_ruby_options['blog_layout'] ) {
				case 'layout_classic' :
					look_ruby_blog_layout_classic( $look_ruby_options );
					break;
				case 'layout_classic_lite' :
					look_ruby_blog_layout_classic_lite( $look_ruby_options );
					break;
				case 'layout_list' :
					look_ruby_blog_layout_list( $look_ruby_options );
					break;
				case 'layout_grid' :
					look_ruby_blog_layout_grid( $look_ruby_options );
					break;
				case 'layout_grid_small' :
					look_ruby_blog_layout_grid_small( $look_ruby_options );
					break;
				case 'layout_grid_small_s' :
					look_ruby_blog_layout_grid_small_s( $look_ruby_options );
					break;
				case 'layout_overlay_small' :
					look_ruby_blog_layout_overlay_small( $look_ruby_options );
					break;
			}

			look_ruby_template_wrapper::close_page_inner();

			//render sidebar
			if ( ! empty( $look_ruby_options['blog_sidebar_position'] ) && 'none' != $look_ruby_options['blog_sidebar_position'] ) {
				look_ruby_template_wrapper::sidebar( $look_ruby_options['blog_sidebar_name'] );
			}

			look_ruby_template_wrapper::close_page_wrap();
		} else {
			get_template_part( 'templates/section', 'no_content' );
		}

	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * render classic layout
 */
if ( ! function_exists( 'look_ruby_blog_layout_classic' ) ) {
	function look_ruby_blog_layout_classic( $look_ruby_options ) {
		look_ruby_template_wrapper::open_blog_content_wrap();
		while ( have_posts() ) {
			the_post();
			get_template_part( 'templates/module/layout', 'classic' );
		}
		look_ruby_template_wrapper::close_blog_content_wrap();

		//blog pagination
		echo look_ruby_template_part::page_pagination();
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * render classic layout
 */
if ( ! function_exists( 'look_ruby_blog_layout_classic_lite' ) ) {
	function look_ruby_blog_layout_classic_lite( $look_ruby_options ) {
		look_ruby_template_wrapper::open_blog_content_wrap();
		while ( have_posts() ) {
			the_post();
			get_template_part( 'templates/module/layout', 'classic_lite' );
		}
		look_ruby_template_wrapper::close_blog_content_wrap();

		//blog pagination
		echo look_ruby_template_part::page_pagination();
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * render list layout
 */
if ( ! function_exists( 'look_ruby_blog_layout_list' ) ) {
	function look_ruby_blog_layout_list( $look_ruby_options ) {

		$flag = true;
		look_ruby_template_wrapper::open_blog_content_wrap();
		while ( have_posts() ) {
			the_post();

			if ( ( true === $flag ) && ! empty( $look_ruby_options['big_first'] ) ) {
				get_template_part( 'templates/module/layout', 'classic_lite' );
				$flag = false;
				continue;
			}

			get_template_part( 'templates/module/layout', 'list' );

		}
		look_ruby_template_wrapper::close_blog_content_wrap();

		//blog pagination
		echo look_ruby_template_part::page_pagination();
	}
}

/**-------------------------------------------------------------------------------------------------------------------------
 * render grid layout
 */
if ( ! function_exists( 'look_ruby_blog_layout_grid' ) ) {
	function look_ruby_blog_layout_grid( $look_ruby_options ) {

		$flag    = true;
		$counter = 1;

		//check fullwidth
		if ( ! empty( $look_ruby_options['blog_sidebar_position'] ) && 'none' == $look_ruby_options['blog_sidebar_position'] ) {
			$classes_col      = 'col-sm-4 col-xs-12';
			$divider_step = 3;
		} else {
			$classes_col      = 'col-sm-6 col-xs-12';
			$divider_step = 2;
		}

		look_ruby_template_wrapper::open_blog_content_wrap();

		while ( have_posts() ) {
			the_post();

			if ( ( true === $flag ) && ! empty( $look_ruby_options['big_first'] ) ) {
				echo '<div class="first-post-wrap col-sx-12">';
				get_template_part( 'templates/module/layout', 'classic_lite' );
				echo '</div>';
				$flag = false;
				continue;
			} else {

				//render block
				echo '<div class="' . esc_attr( $classes_col ) . '">';
				get_template_part( 'templates/module/layout', 'grid' );
				echo '</div><!--#grid outer-->';

				if ( 0 == $counter % $divider_step ) {
					look_ruby_template_part::render_divider();
				}

				$counter ++;
			}
		}

		look_ruby_template_wrapper::close_blog_content_wrap();

		//blog pagination
		echo look_ruby_template_part::page_pagination();
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * render gird small layout
 */
if ( ! function_exists( 'look_ruby_blog_layout_grid_small' ) ) {
	function look_ruby_blog_layout_grid_small( $look_ruby_options ) {

		$flag = true;

		if ( ! empty( $look_ruby_options['blog_sidebar_position'] ) && 'none' == $look_ruby_options['blog_sidebar_position'] ) {
			$classes_col = 'col-sm-3 col-xs-6';
		} else {
			$classes_col = 'col-sm-4 col-xs-6';
		}

		look_ruby_template_wrapper::open_blog_content_wrap();

		if ( empty( $look_ruby_options['big_first'] ) ) {
			echo '<div class="blog-content-inner">';
		}

		while ( have_posts() ) {
			the_post();

			if ( ( true === $flag ) && ! empty( $look_ruby_options['big_first'] ) ) {
				echo '<div class="first-post-wrap col-sx-12">';
				get_template_part( 'templates/module/layout', 'classic_lite' );
				echo '</div>';

				echo '<div class="blog-content-inner">';

				$flag = false;
				continue;
			} else {
				//render block
				echo '<div class="' . esc_attr( $classes_col ) . '">';
				get_template_part( 'templates/module/layout', 'grid_small' );
				echo '</div><!--#grid outer-->';
			}
		}

		echo '</div>';

		look_ruby_template_wrapper::close_blog_content_wrap();

		//blog pagination
		echo look_ruby_template_part::page_pagination();
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * render gird small square layout
 */
if ( ! function_exists( 'look_ruby_blog_layout_grid_small_s' ) ) {
	function look_ruby_blog_layout_grid_small_s( $look_ruby_options ) {

		$flag = true;

		if ( ! empty( $look_ruby_options['blog_sidebar_position'] ) && 'none' == $look_ruby_options['blog_sidebar_position'] ) {
			$classes_col = 'col-sm-3 col-xs-6';
		} else {
			$classes_col = 'col-sm-4 col-xs-6';
		}

		look_ruby_template_wrapper::open_blog_content_wrap();

		if ( empty( $look_ruby_options['big_first'] ) ) {
			echo '<div class="blog-content-inner">';
		}

		while ( have_posts() ) {
			the_post();

			if ( ( true === $flag ) && ! empty( $look_ruby_options['big_first'] ) ) {
				echo '<div class="first-post-wrap col-sx-12">';
				get_template_part( 'templates/module/layout', 'classic_lite' );
				echo '</div>';

				echo '<div class="blog-content-inner">';
				$flag = false;
				continue;
			} else {

				//render block
				echo '<div class="' . esc_attr( $classes_col ) . '">';
				get_template_part( 'templates/module/layout', 'grid_small_s' );
				echo '</div><!--#square grid outer-->';

			}
		}

		echo '</div>';

		look_ruby_template_wrapper::close_blog_content_wrap();

		//blog pagination
		echo look_ruby_template_part::page_pagination();
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * render gird overlay small
 */
if ( ! function_exists( 'look_ruby_blog_layout_overlay_small' ) ) {
	function look_ruby_blog_layout_overlay_small( $look_ruby_options ) {

		$flag    = true;
		$counter = 1;

		if ( ! empty( $look_ruby_options['blog_sidebar_position'] ) && 'none' == $look_ruby_options['blog_sidebar_position'] ) {
			$classes_col      = 'col-sm-4 col-xs-12';
			$divider_step = 3;
		} else {
			$classes_col      = 'col-sm-6 col-xs-12';
			$divider_step = 2;
		}

		look_ruby_template_wrapper::open_blog_content_wrap();

		while ( have_posts() ) {
			the_post();

			if ( ( true === $flag ) && ! empty( $look_ruby_options['big_first'] ) ) {
				echo '<div class="first-post-wrap col-sx-12">';
				get_template_part( 'templates/module/layout', 'classic_lite' );
				echo '</div>';
				$flag = false;
				continue;
			} else {

				//render block
				echo '<div class="' . esc_attr( $classes_col ) . '">';
				get_template_part( 'templates/module/layout', 'overlay_small' );
				echo '</div><!--#overlay outer-->';

				if ( 0 == $counter % $divider_step ) {
					look_ruby_template_part::render_divider();
				}

				$counter ++;
			}
		}

		look_ruby_template_wrapper::close_blog_content_wrap();

		//blog pagination
		echo look_ruby_template_part::page_pagination();
	}
}
