<?php
if ( ! function_exists( 'look_ruby_theme_options_category' ) ) {
	function look_ruby_theme_options_category() {
		return array(
			'id'     => 'look_ruby_theme_ops_section_categories',
			'title'  => esc_html__( 'Category Options', 'look' ),
			'desc'   => esc_html__( 'Select options for categories', 'look' ),
			'icon'   => 'el el-folder-close',
			'fields' => array(
				//category layout
				array(
					'id'     => 'section_start_cat_layout',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( ' Category Layout Options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'category_layout',
					'type'     => 'image_select',
					'title'    => esc_html__( ' Category Layout', 'look' ),
					'subtitle' => esc_html__( 'Select the layout for all categories', 'look' ),
					'options'  => look_ruby_theme_config::blog_layout(),
					'default'  => 'layout_list'
				),
				array(
					'id'       => 'category_big_post_first',
					'title'    => esc_html__( '1st Classic Post', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable big classic layout at first of page', 'look' ),
					'type'     => 'switch',
					'default'  => 0
				),
				array(
					'id'       => 'category_header_background',
					'type'     => 'media',
					'title'    => esc_html__( 'Header background', 'look' ),
					'subtitle' => esc_html__( 'Upload header background for all categories. recommended: width is 1366px and height is less than 500px', 'look' )
				),
				array(
					'id'     => 'section_end_cat_layout',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//category sidebar
				array(
					'id'     => 'section_start_cat_sidebar',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( ' Category Sidebar Options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'category_sidebar',
					'type'     => 'select',
					'title'    => esc_html__( 'Category Sidebar', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar for all categories', 'look' ),
					'default'  => 'look_ruby_sidebar_default',
					'options'  => look_ruby_theme_config::sidebar_name()
				),
				//category sidebar position
				array(
					'id'       => 'category_sidebar_position',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Sidebar Position', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar position for all categories. This option will override default sidebar position options.', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_position(),
					'default'  => 'default'
				),
				array(
					'id'     => 'section_end_cat_sidebar',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				)

			)
		);
	}
}
