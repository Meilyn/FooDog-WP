<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * @param $meta_cat
 *
 * @return string
 * render header category page
 */
if ( ! function_exists( 'look_ruby_render_page_header_category' ) ) {
	function look_ruby_render_page_header_category( $meta_cat ) {

		$cat_id = look_ruby_core::get_page_cat_id();;
		$header_bg = array();

		//get blog options
		$cat_name = get_cat_name( $cat_id );
		$cat_desc = category_description();
		if ( ! empty( $meta_cat['look_ruby_cat_bg'] ) ) {
			$header_bg['url'] = $meta_cat['look_ruby_cat_bg'];
		} else {
			$header_bg = look_ruby_core::get_option( 'category_header_background' );
		}

		//render
		$str = '';
		if ( ! empty( $header_bg['url'] ) ) {
			$str .= '<div class="archive-page-header is-light-text has-bg-image" style="background-image: url(' . esc_url( $header_bg['url'] ) . ')">';
		} else {
			$str .= '<div class="archive-page-header">';
		};
		$str .= '<div class="archive-title-wrap">';
		$str .= '<h1 class="archive-title post-title">';
		$str .= esc_attr( $cat_name );
		$str .= '</h1>';
		if ( ! empty( $cat_desc ) ) {
			$str .= '<div class="archive-desc">';
			$str .= html_entity_decode( esc_html( $cat_desc ) );
			$str .= '</div>';
		}

		$str .= '</div>';
		$str .= '</div><!--category header-->';

		return $str;
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * render header archive page
 */
if ( ! function_exists( 'look_ruby_render_header_page_archive' ) ) {
	function look_ruby_render_header_page_archive() {

		//get blog options
		$archive_name = look_ruby_render_archive_title();
		$header_bg    = look_ruby_core::get_option( 'archive_header_background' );

		//render
		$str = '';
		if ( ! empty( $header_bg['url'] ) ) {
			$str .= '<div class="archive-page-header is-light-text has-bg-image" style="background-image: url(' . esc_url( $header_bg['url'] ) . '">';
		} else {
			$str .= '<div class="archive-page-header">';
		};
		$str .= '<div class="archive-title-wrap">';
		$str .= '<h1 class="archive-title post-title">';
		$str .= esc_attr( $archive_name );
		$str .= '</h1>';
		$str .= '</div>';
		$str .= '</div><!--archive header-->';

		return $str;
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * render archive title
 */
if ( ! function_exists( 'look_ruby_render_archive_title' ) ) {
	function look_ruby_render_archive_title() {

		if ( is_category() ) :
			return single_cat_title( '', false );
		elseif ( is_tag() ) :
			return single_tag_title( '', false );
		elseif ( is_author() ) :
			return get_the_author();
		elseif ( is_day() ) :
			return get_the_date();
		elseif ( is_month() ) :
			return get_the_date( 'F Y' );
		elseif ( is_year() ) :
			return get_the_date( 'Y' );
		elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
			return esc_html__( 'Asides', 'look' );
		elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
			return esc_html__( 'Galleries', 'look' );
		elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
			return esc_html__( 'Images', 'look' );
		elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
			return esc_html__( 'Videos', 'look' );
		elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
			return esc_html__( 'Quotes', 'look' );
		elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
			return esc_html__( 'Links', 'look' );
		elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
			return esc_html__( 'Statuses', 'look' );
		elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
			return esc_html__( 'Audios', 'look' );
		elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
			return esc_html__( 'Chats', 'look' );
		else :
			return esc_html__( 'Archives', 'look' );
		endif;
	}

}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * render search header page
 */
if ( ! function_exists( 'look_ruby_render_page_header_search' ) ) {
	function look_ruby_render_page_header_search() {
		$search_title = get_search_query();
		$str          = '';
		$str .= '<div class="search-page-header">';
		$str .= '<div class="ruby-container">';
		$str .= '<div class="search-page-header-inner">';
		$str .= '<div class="search-decs">' . esc_html__( 'search result for:', 'look' ) . '</div>';
		$str .= '<div class="post-title is-big-title">';
		$str .= '<h3>' . esc_html( $search_title ) . '</h3>';
		$str .= '</div>';
		$str .= '</div>';
		$str .= '</div>';
		$str .= '</div>';

		return $str;

	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * render search not found
 */
if ( ! function_exists( 'look_ruby_render_search_not_found' ) ) {
	function look_ruby_render_search_not_found() {

		$str = '';
		$str .= '<div id="main-content-wrap" class="row clearfix">';
		$str .= '<div class="ruby-container">';
		$str .= '<div class="search-no-result-content">';
		$str .= '<div class="search-no-result post-title">';
		$str .= '<h3>' . esc_html__( 'Oops! It looks like nothing was found!', 'look' ) . '</h3>';
		$str .= '</div>';
		$str .= '<p>' . esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'look' ) . '</p>';
		$str .= get_search_form( false );
		$str .= '</div>';
		$str .= '</div>';
		$str .= '</div>';

		return $str;
	}
}
