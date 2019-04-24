<?php

//meta box page config
if ( ! function_exists( 'look_ruby_metabox_single_page' ) ) {
	function look_ruby_metabox_single_page() {
		return array(
			'id'         => 'look_ruby_metabox_single_page_options',
			'title'      => esc_html__( 'PAGE OPTIONS', 'look' ),
			'post_types' => array( 'page' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields'     => array(
				array(
					'id'      => 'look_ruby_page_title',
					'type'    => 'select',
					'name'    => esc_html__( 'page title', 'look' ),
					'desc'    => esc_html__( 'Enable or disable for this page, This option will override "Theme Options -> Page Settings -> Single Page -> Title" option', 'look' ),
					'options' => array(
						'default' => esc_html__( 'Default From Theme Options', 'look' ),
						'show'    => esc_html__( 'Show', 'look' ),
						'none'    => esc_html__( 'None', 'look' )
					),
					'std'     => 'default'
				),
				array(
					'id'   => 'look_ruby_page_content_width',
					'type' => 'text',
					'name' => esc_html__( 'content max width', 'look' ),
					'desc' => esc_html__( 'input max width value (in px) of the content of this page when you disable sidebar. Please blank or set O if you want set default value.', 'look' ),
					'std'  => ''
				),
			)
		);
	}
}