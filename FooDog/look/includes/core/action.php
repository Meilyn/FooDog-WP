<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * redirect to active plugin
 */
if ( ! function_exists( 'look_ruby_after_theme_active' ) ) {
	function look_ruby_after_theme_active() {

		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

			$first_active = get_option( 'look_ruby_first_active_theme', '' );
			if ( ! empty( $first_active ) ) {
				update_option( 'look_ruby_first_active_theme', '1' );
			} else {
				add_option( 'look_ruby_first_active_theme', '1' );
			}

			//redirect
			wp_redirect( admin_url( 'admin.php?page=look-plugins' ) );
			exit;
		}
	}

	add_action( 'after_switch_theme', 'look_ruby_after_theme_active' );
}


/**-------------------------------------------------------------------------------------------------------------------------
 * Html5 for ie9
 */
if ( ! function_exists( 'look_ruby_add_ie_html5_shim' ) ) {
	function look_ruby_add_ie_html5_shim() {
		echo '<!--[if lt IE 9]>';
		echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
		echo '<![endif]-->';
	}

	add_action( 'wp_head', 'look_ruby_add_ie_html5_shim', 1 );
};


/**-------------------------------------------------------------------------------------------------------------------------
 * @param $body_classes
 *
 * @return array
 * add class to body
 */
if ( ! function_exists( 'look_ruby_body_add_classes' ) ) {
	function look_ruby_body_add_classes( $body_classes ) {

		$body_classes[] = 'ruby-body';
		if ( 'is-boxed' == look_ruby_core::get_option( 'main_site_layout' ) ) {
			$body_classes[] = 'is-boxed';
			$site_bg        = look_ruby_core::get_option( 'site_background' );
			if ( ! empty( $site_bg ) ) {
				$body_classes[] = 'is-site-bg';
			}
			$site_bg_link = look_ruby_core::get_option( 'site_background_link' );
			if ( ! empty( $site_bg_link ) ) {
				$body_classes[] = 'is-site-link';
			}
		} else {
			$body_classes[] = 'is-full-width';
		}

		//sticky navigation
		$sticky_nav = look_ruby_core::get_option( 'sticky_navigation' );
		if ( ! empty( $sticky_nav ) ) {
			$body_classes[] = 'is-sticky-nav';

			//smart sticky
			$sticky_nav_smart = look_ruby_core::get_option( 'sticky_navigation_smart' );
			if ( ! empty( $sticky_nav_smart ) ) {
				$body_classes[] = 'is-smart-sticky';
			}
		}

		//enable smooth scrolling
		$smooth_scroll = look_ruby_core::get_option( 'site_smooth_scroll' );
		if ( ! empty( $smooth_scroll ) ) {
			$body_classes[] = 'is-site-smooth-scroll';
		}

		//enable smooth display
		$smooth_scroll = look_ruby_core::get_option( 'site_smooth_display' );
		if ( ! empty( $smooth_scroll ) ) {
			$body_classes[] = 'is-site-smooth-display';
		}

		//social tooltips
		$social_tooltip = look_ruby_core::get_option( 'social_tooltip' );
		if ( ! empty( $social_tooltip ) ) {
			$body_classes[] = 'is-social-tooltip';
		}

		if ( is_single() ) {
			$infinite_scroll = look_ruby_core::get_option( 'single_post_infinite_scroll' );
			$hide_sidebar    = look_ruby_core::get_option( 'single_post_scroll_hide_sidebar' );
			if ( ! empty( $infinite_scroll ) && ! empty( $hide_sidebar ) ) {
				$body_classes[] = 'is-hide-sidebar';
			}
		}


		//return
		return $body_classes;
	}

	add_filter( 'body_class', 'look_ruby_body_add_classes' );
}


/**-------------------------------------------------------------------------------------------------------------------------
 * add favicon & BookmarkLet to header
 */
if ( ! function_exists( 'look_ruby_wp_header' ) ) {
	function look_ruby_wp_header() {
		//get theme options
		$apple_icon = look_ruby_core::get_option( 'apple_touch_ion' );
		$metro_icon = look_ruby_core::get_option( 'metro_icon' );

		//iso bookmark
		if ( ! empty( $apple_icon['url'] ) ) {
			echo '<link rel="apple-touch-icon" href="' . esc_url( $apple_icon['url'] ) . '" />';
		}

		//metro bookmark
		if ( ! empty( $metro_icon['url'] ) ) {
			echo '<meta name="msapplication-TileColor" content="#ffffff">';
			echo '<meta name="msapplication-TileImage" content="' . esc_url( $metro_icon['url'] ) . '" />';
		}
	}

	add_action( 'wp_head', 'look_ruby_wp_header', 3 );
}


/**-------------------------------------------------------------------------------------------------------------------------
 * Opengraph support
 */
if ( ! function_exists( 'look_ruby_opengraph_meta' ) ) {

	function look_ruby_opengraph_meta() {
		global $post;

		//check enable for theme options
		$open_graph = look_ruby_core::get_option( 'open_graph' );
		if ( ! is_singular() || empty( $open_graph ) ) {
			return false;
		}

		if ( ! empty( $post->post_excerpt ) ) {
			$post_excerpt = wp_trim_words( $post->post_excerpt, 30, '' );
		} else {
			$post_excerpt = wp_trim_words( strip_tags( $post->post_content ), 30, '' );
		}

		echo '<meta property="og:title" content="' . get_the_title() . '"/>';
		echo '<meta property="og:type" content="article"/>';
		echo '<meta property="og:url" content="' . get_permalink() . '"/>';
		echo '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '"/>';
		echo '<meta property="og:description" content="' . strip_tags( esc_attr( $post_excerpt ) ) . '"/>';
		if ( has_post_thumbnail( $post->ID ) ) {
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			echo '<meta property="og:image" content="' . esc_url( $thumbnail_src[0] ) . '"/>';
		} else {
			//load logo when no image found.
			$logo = look_ruby_core::get_option( 'header_logo' );
			if ( ! empty( $logo['url'] ) ) {
				echo '<meta property="og:image" content="' . esc_url( $logo['url'] ) . '"/>';
			}
		}
	}

	add_action( 'wp_head', 'look_ruby_opengraph_meta', 10 );
}


/**-------------------------------------------------------------------------------------------------------------------------
 * remove page in search result
 */
if ( ! function_exists( 'look_ruby_filter_search' ) ) {
	function look_ruby_filter_search() {
		global $wp_post_types;

		$wp_post_types['page']->exclude_from_search = true;
	}

	add_action( 'init', 'look_ruby_filter_search' );
};


/**-------------------------------------------------------------------------------------------------------------------------
 * add options to javascript
 */
if ( ! function_exists( 'look_ruby_script_options_value' ) ) {
	function look_ruby_script_options_value() {
		//get theme options

		//back to top
		$back_to_top        = look_ruby_core::get_option( 'site_back_to_top' );
		$back_to_top_mobile = intval( look_ruby_core::get_option( 'site_back_to_top_mobile' ) );
		$single_image_popup = look_ruby_core::get_option( 'single_post_image_popup' );
		$body_bg_link = look_ruby_core::get_option('site_background_link');

		//move to js script
		wp_localize_script( 'look_ruby_main_script', 'look_ruby_to_top', strval( $back_to_top ) );
		wp_localize_script( 'look_ruby_main_script', 'look_ruby_to_top_mobile', strval( $back_to_top_mobile ) );
		wp_localize_script( 'look_ruby_main_script', 'look_ruby_single_image_popup', strval( $single_image_popup ) );
		wp_localize_script( 'look_ruby_main_script', 'look_ruby_site_bg_link', $body_bg_link );
	}

	add_action( 'wp_footer', 'look_ruby_script_options_value', 10 );
}


/**-------------------------------------------------------------------------------------------------------------------------
 * add span wrap for category number in widget
 */
if ( ! function_exists( 'look_ruby_category_post_count' ) ) {
	function look_ruby_category_post_count( $str ) {
		$pos = strpos( $str, '</a> (' );
		if ( false != $pos ) {
			$str = str_replace( '</a> (', '<span class="number-post-count">', $str );
			$str = str_replace( ')', '</span></a>', $str );
		}

		return $str;
	}

	add_filter( 'wp_list_categories', 'look_ruby_category_post_count' );
};


/**-------------------------------------------------------------------------------------------------------------------------
 * add span wrap for archives number in widget
 */
if ( ! function_exists( 'look_ruby_archives_post_count' ) ) {
	function look_ruby_archives_post_count( $str ) {
		$pos = strpos( $str, '</a>&nbsp;(' );
		if ( false != $pos ) {
			$str = str_replace( '</a>&nbsp;(', '<span class="number-post-count">', $str );
			$str = str_replace( ')', '</span></a>', $str );
		}

		return $str;
	}

	add_filter( 'get_archives_link', 'look_ruby_archives_post_count' );
}


/**-------------------------------------------------------------------------------------------------------------------------
 * registering ajax action
 */
if ( ! function_exists( 'look_ruby_ajax_url' ) ) {
	function look_ruby_ajax_url() {
		echo '<script type="application/javascript">var look_ruby_ajax_url = "' . admin_url( 'admin-ajax.php' ) . '"</script>';
	}

	add_action( 'wp_enqueue_scripts', 'look_ruby_ajax_url' );
}


/**-------------------------------------------------------------------------------------------------------------------------
 * ajax video playlist
 */
if ( ! function_exists( 'look_ruby_playlist_video' ) ) {
	add_action( 'wp_ajax_nopriv_look_ruby_playlist_video', 'look_ruby_playlist_video' );
	add_action( 'wp_ajax_look_ruby_playlist_video', 'look_ruby_playlist_video' );

	function look_ruby_playlist_video() {

		//get and validate request data
		$str = '';

		if ( ! empty( $_POST['post_id'] ) ) {
			$post_id = esc_attr( $_POST['post_id'] );
		}

		if ( ! empty( $post_id ) ) {

			global $post;
			$post = get_post( $post_id );
			setup_postdata( $post );

			$str .= '<div class="post-thumb-outer">';
			$str .= look_ruby_template_thumbnail::render_video();
			$str .= '</div>';
		}

		wp_reset_postdata();

		die( json_encode( $str ) );
	}
}
