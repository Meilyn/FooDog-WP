<?php
//meta box comments config
if ( ! function_exists( 'look_ruby_metabox_comment_box' ) ) {
	function look_ruby_metabox_comment_box() {
		return array(
			'id'         => 'look_ruby_metabox_comment_box_options',
			'title'      => esc_html__( 'COMMENT OPTIONS', 'look' ),
			'post_types' => array( 'post', 'page' ),
			'priority'   => 'default',
			'context'    => 'side',
			'fields'     => array(
				array(
					'id'      => 'look_ruby_single_box_comment',
					'name'    => esc_html__( 'comment box', 'look' ),
					'desc'    => esc_html__( 'Enable or disable this post comments box, This option will override "Theme Options -> Single Post-> Show Comment Box" option', 'look' ),
					'type'    => 'select',
					'options' => array(
						'default' => esc_html__( 'Default From Theme Options', 'look' ),
						'show'    => esc_html__( 'Show', 'look' ),
						'none'    => esc_html__( 'Hide', 'look' )
					),
					'std'     => 'default'
				)
			)
		);
	}
}