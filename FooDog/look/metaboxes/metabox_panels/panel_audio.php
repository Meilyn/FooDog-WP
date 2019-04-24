<?php
//meta box post audio config
if ( ! function_exists( 'look_ruby_metabox_post_audio' ) ) {
	function look_ruby_metabox_post_audio() {
		return array(
			'id'         => 'look_ruby_metabox_audio_options',
			'title'      => esc_html__( 'AUDIO OPTIONS', 'look' ),
			'post_types' => array( 'post' ),
			'priority'   => 'default',
			'context'    => 'normal',
			'fields'     => array(
				array(
					'name' => esc_html__( 'audio URL', 'look' ),
					'desc' => esc_html__( 'Input link of audio, support: SoundCloud, MixCloud', 'look' ),
					'id'   => 'look_ruby_single_audio_url',
					'type' => 'text',
				),
				array(
					'id'   => 'look_ruby_single_self_host_audio',
					'name' => esc_html__( 'Self-Hosted Audio', 'look' ),
					'desc' => esc_html__( 'Please upload the mp3, ogg, wma, m4a, wav audio file.', 'look' ),
					'type' => 'file_advanced',
					'std'  => ''
				)
			)
		);
	}
}