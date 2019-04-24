<?php
//meta box featured credit config
if ( ! function_exists( 'look_ruby_metabox_credit_text' ) ) {
	function look_ruby_metabox_credit_text() {
		return array(
			'id'         => 'look_ruby_metabox_credit_text_options',
			'title'      => esc_html__( 'FEATURED CREDIT OPTION', 'look' ),
			'post_types' => array( 'post' ),
			'priority'   => 'high',
			'context'    => 'normal',
			'fields'     => array(
				array(
					'id'   => 'look_ruby_credit_text',
					'type' => 'text',
					'name' => esc_html__( 'featured credit text', 'look' ),
					'desc' => esc_html__( 'Input credit text for featured image', 'look' ),
					'sdt' => ''
				)
			)
		);
	}
}