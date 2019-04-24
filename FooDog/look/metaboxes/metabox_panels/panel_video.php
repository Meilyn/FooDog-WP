<?php
//meta box post video config
if ( ! function_exists( 'look_ruby_metabox_post_video' ) ) {
	function look_ruby_metabox_post_video() {
		return array(
			'id'         => 'look_ruby_metabox_video_options',
			'title'      => esc_html__( 'VIDEO OPTIONS', 'look' ),
			'post_types' => array( 'post' ),
			'priority'   => 'default',
			'context'    => 'normal',
			'fields'     => array(
				array(
					'id'   => 'look_ruby_single_video_url',
					'name' => esc_html__( 'Video URL', 'look' ),
					'desc' => esc_html__( 'Input link of video, support: Youtube, Vimeo, DailyMotion', 'look' ),
					'type' => 'text',
				),
				array(
					'id'   => 'look_ruby_single_self_host_video',
					'name' => esc_html__( 'Self-Hosted Video', 'look' ),
					'desc' => esc_html__( 'Please upload the mp4, m4v, webm, ogv, wmv, flv video file.', 'look' ),
					'type' => 'file_advanced',
					'std'  => ''
				)
			)
		);
	}
}