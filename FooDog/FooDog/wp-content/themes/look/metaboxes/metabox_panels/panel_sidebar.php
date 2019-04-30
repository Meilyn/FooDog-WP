<?php
//meta box sidebar config
if ( ! function_exists( 'look_ruby_metabox_sidebar' ) ) {
	function look_ruby_metabox_sidebar() {
		return array(
			'id'         => 'look_ruby_metabox_sidebar_options',
			'title'      => esc_html__( 'SIDEBAR OPTIONS', 'look' ),
			'post_types' => array( 'post', 'page' ),
			'priority'   => 'default',
			'context'    => 'side',
			'fields'     => array(
				array(
					'id'      => 'look_ruby_single_sidebar',
					'type'    => 'select',
					'name'    => esc_html__( 'sidebar name', 'look' ),
					'desc'    => esc_html__( 'Select sidebar for this post, This option will override "Theme Options -> Single Post -> Default Sidebar" option', 'look' ),
					'options' => look_ruby_theme_config::sidebar_name( true ),
					'std'     => 'look_ruby_default_from_theme_options'
				),
				array(
					'id'       => 'look_ruby_single_sidebar_position',
					'name'     => esc_html__( 'sidebar position', 'look' ),
					'desc'     => esc_html__( 'Select sidebar position for this post, This option will override "Theme Options -> Single Post -> Default Sidebar Position" option', 'look' ),
					'class'    => 'ruby-sidebar-select',
					'type'     => 'image_select',
					'multiple' => false,
					'options'  => look_ruby_theme_config::metabox_sidebar_position(),
					'std'      => 'default'
				),
			)
		);
	}
}