<?php
//meta box post gallery config
if ( ! function_exists( 'look_ruby_metabox_post_gallery' ) ) {
	function look_ruby_metabox_post_gallery() {
		return array(
			'id'         => 'look_ruby_metabox_gallery_options',
			'title'      => esc_html__( 'GALLERY OPTIONS', 'look' ),
			'post_types' => array( 'post' ),
			'priority'   => 'default',
			'context'    => 'normal',
			'fields'     => array(
				array(
					'id'   => 'look_ruby_single_post_gallery_data',
					'name' => esc_html__( 'select gallery', 'look' ),
					'desc' => esc_html__( 'Select your pictures for gallery', 'look' ),
					'type' => 'image_advanced',
				),
				array(
					'id'       => 'look_ruby_single_post_gallery_type',
					'name'     => esc_html__( 'gallery type', 'look' ),
					'desc'     => esc_html__( 'Select type for gallery', 'look' ),
					'type'     => 'select',
					'multiple' => false,
					'options'  => array(
						'slider' => esc_html__( 'Slider', 'look' ),
						'grid'   => esc_html__( 'Grid Images', 'look' )
					),
					'std'      => 'slider',
				)
			)
		);
	}
}