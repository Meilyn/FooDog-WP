<?php
//meta box post config
if ( ! function_exists( 'look_ruby_metabox_single_post' ) ) {
	function look_ruby_metabox_single_post() {
		return array(
			'id'         => 'look_ruby_metabox_single_post_options',
			'title'      => esc_html__( 'POST OPTIONS', 'look' ),
			'post_types' => array( 'post' ),
			'priority'   => 'high',
			'context'    => 'normal',
			'fields'     => array(

				array(
					'id'      => 'look_ruby_template_single',
					'type'    => 'image_select',
					'name'    => esc_html__( 'post layout', 'look' ),
					'desc'    => esc_html__( 'Select layout for this post', 'look' ),
					'options' => look_ruby_theme_config::metabox_single_layout(),
					'std'     => 'default'
				),
				array(
					'name'        => esc_html__( 'Primary Category', 'look' ),
					'id'          => 'look_ruby_single_primary_category',
					'type'        => 'taxonomy_advanced',
					'taxonomy'    => 'category',
					'placeholder' => esc_html__( 'Select a category', 'look' ),
					'desc'        => esc_html__( 'If the posts has multiple category, You can one select here and it will appears in the meta category info.', 'look' ),
					'field_type'  => 'select',
					'std'         => ''
				),
			),
		);
	}
}