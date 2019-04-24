<?php
/**
 * The file render single post
 * @package look
 * @since   look 1.0
 */
if ( have_posts() ) {

	$look_ruby_infinite_scroll = look_ruby_core::get_option( 'single_post_infinite_scroll' );
	$look_ruby_pre_post        = get_previous_post();

	//render
	if ( ! empty( $look_ruby_infinite_scroll ) && ! empty( $look_ruby_pre_post ) ) {
		$look_ruby_pre_post_id = $look_ruby_pre_post->ID;
		echo '<div id="single-post-infinite" data-next_post_id="' . esc_attr( $look_ruby_pre_post_id ) . '" class="clearfix">';
		while ( have_posts() ) {
			the_post();
			look_ruby_render_single_post();
		}
		echo '</div>';
		echo '<div class="infinite-scroll"><i class="infinite-icon"></i></div><!--#animation-->';
	} else {
		while ( have_posts() ) {
			the_post();
			look_ruby_render_single_post();
		}
	}

}


