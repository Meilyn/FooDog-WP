<?php
if ( ! function_exists( 'look_ruby_theme_options_blog' ) ) {
	function look_ruby_theme_options_blog() {
		//blog blog page option
		return array(
			'title'  => esc_html__( 'Blog Options', 'look' ),
			'id'     => 'look_ruby_theme_ops_section_blog_page',
			'desc'   => esc_html__( 'The settings below apply to blog page that are set to "Your latest posts" in the "Wordpress Settings -> Reading" section.', 'look' ),
			'icon'   => 'el el-laptop',
			'fields' => array(

				//featured area
				array(
					'id'     => 'section_start_header_featured',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Featured Top Area Options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'feat_style',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Featured Area Style', 'look' ),
					'subtitle' => esc_html__( 'Select layout for featured area at the top of the latest blog listing page', 'look' ),
					'options'  => look_ruby_theme_config::feat_type(),
					'default'  => 'none'
				),
				array(
					'id'       => 'feat_cat',
					'type'     => 'select',
					'data'     => 'categories',
					'multi'    => true,
					'title'    => esc_html__( 'Categories Filter', 'look' ),
					'subtitle' => esc_html__( 'Select categories for top featured area, you can select multi category. leave blank if you select all category.', 'look' ),
				),
				array(
					'id'       => 'feat_tag',
					'type'     => 'select',
					'data'     => 'tags',
					'multi'    => true,
					'title'    => esc_html__( 'Tags Filter', 'look' ),
					'subtitle' => esc_html__( 'Select tags for featured top featured area, you can select multi tags. Leave blank if you don\'t select any tags.', 'look' ),
				),
				array(
					'id'       => 'feat_sort',
					'type'     => 'select',
					'title'    => esc_html__( 'Sorted By', 'look' ),
					'subtitle' => esc_html__( 'Select sort type for top featured area', 'look' ),
					'options'  => look_ruby_theme_config::post_orders(),
					'default'  => 'date_post'
				),
				array(
					'id'       => 'feat_num',
					'title'    => esc_html__( 'Number of Posts', 'look' ),
					'subtitle' => esc_html__( 'Select number of post for top featured area, this options will not affect to the featured grid layout', 'look' ),
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'default'  => 5
				),
				array(
					'id'       => 'feat_offset',
					'title'    => esc_html__( 'Offset of Posts', 'look' ),
					'subtitle' => esc_html__( 'Select number of posts to displace or pass over. beginning number is 0', 'look' ),
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'default'  => 0
				),
				array(
					'id'     => 'section_end_header_featured',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				array(
					'id'     => 'section_start_blog_layout',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'latest blog layout options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'blog_layout',
					'type'     => 'image_select',
					'title'    => esc_html__( 'latest blog layout', 'look' ),
					'subtitle' => esc_html__( 'select layout for latest blog listing', 'look' ),
					'options'  => look_ruby_theme_config::blog_layout(),
					'default'  => 'layout_list'
				),
				array(
					'id'       => 'big_post_first',
					'title'    => esc_html__( '1st classic layout', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable big classic layout at first of page, This option will not affect to the classic and classic lite layout', 'look' ),
					'type'     => 'switch',
					'default'  => 0
				),
				array(
					'id'     => 'section_end_blog_layout',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				array(
					'id'     => 'section_start_blog_sidebar',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'latest blog Sidebar options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'blog_sidebar',
					'type'     => 'select',
					'title'    => esc_html__( 'latest blog sidebar', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar for the latest blog listing page.', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_name(),
					'default'  => 'look_ruby_sidebar_default'
				),
				array(
					'id'       => 'blog_sidebar_position',
					'type'     => 'image_select',
					'title'    => esc_html__( 'latest blog sidebar position', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar position for the latest blog listing page.', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_position(),
					'default'  => 'default'
				),
				array(
					'id'     => 'section_end_blog_sidebar',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			)
		);
	}
}