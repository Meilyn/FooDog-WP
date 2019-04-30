<?php
//page option
if ( ! function_exists( 'look_ruby_theme_options_page' ) ) {
	function look_ruby_theme_options_page() {

		return array(
			'id'    => 'look_ruby_theme_ops_section_pages',
			'title' => esc_html__( 'Pages Options', 'look' ),
			'desc'  => esc_html__( 'Select options for Pages', 'look' ),
			'icon'  => 'el el-gift',
		);
	}
}

//default page
if ( ! function_exists( 'look_ruby_default_page_config' ) ) {
	function look_ruby_default_page_config() {
		return array(
			'id'         => 'look_ruby_theme_ops_section_single_page',
			'title'      => esc_html__( 'single page options', 'look' ),
			'desc'       => esc_html__( 'Select options for Pages', 'look' ),
			'subsection' => true,
			'icon'       => 'el el-list-alt',
			'fields'     => array(
				array(
					'id'     => 'section_start_single_page_section',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'single page options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'default_single_page_title',
					'type'     => 'switch',
					'title'    => esc_html__( 'Single page title', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable page title', 'look' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'default_single_page_box_comment',
					'type'     => 'switch',
					'title'    => esc_html__( 'Comment Box', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable the comments on the pages, Default this option is enable', 'look' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'default_single_page_sidebar',
					'type'     => 'select',
					'title'    => esc_html__( 'Single page sidebar', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar for default page', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_name(),
					'default'  => 'look_ruby_sidebar_default',
				),
				array(
					'id'       => 'default_single_page_sidebar_position',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Single Page Sidebar Position', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar position for default page. This option will override default sidebar position options.', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_position(),
					'default'  => 'default'
				),
				array(
					'id'     => 'section_end_single_page_section',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			),
		);
	}
}


//author page
if ( ! function_exists( 'look_ruby_author_page_config' ) ) {
	function look_ruby_author_page_config() {
		return array(
			'id'         => 'look_ruby_theme_ops_section_author_page',
			'title'      => esc_html__( 'author page options', 'look' ),
			'desc'       => esc_html__( 'Select options for author page', 'look' ),
			'subsection' => true,
			'icon'       => 'el el-list-alt',
			'fields'     => array(
				array(
					'id'     => 'section_start_author_page',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Author Page options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'author_layout',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Author page layout', 'look' ),
					'subtitle' => esc_html__( 'Select the layout for this page', 'look' ),
					'options'  => look_ruby_theme_config::blog_layout(),
					'default'  => 'layout_list'
				),
				array(
					'id'       => 'author_sidebar',
					'type'     => 'select',
					'title'    => esc_html__( 'Author Page Sidebar', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar for this page', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_name(),
					'default'  => 'look_ruby_sidebar_default'
				),
				array(
					'id'       => 'author_sidebar_position',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Author Sidebar Position', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar position for this page. This option will override default sidebar position options.', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_position(),
					'default'  => 'default'
				),
				array(
					'id'     => 'section_end_author_page',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			)
		);
	}
}


//archive page
if ( ! function_exists( 'look_ruby_archive_page_config' ) ) {
	function look_ruby_archive_page_config() {
		return array(
			'id'         => 'look_ruby_theme_ops_section_archive_page',
			'title'      => esc_html__( 'Archive page options', 'look' ),
			'desc'       => esc_html__( 'Select options for archive page', 'look' ),
			'subsection' => true,
			'icon'       => 'el el-list-alt',
			'fields'     => array(
				array(
					'id'     => 'section_start_archive_page',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Archive Page options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'archive_layout',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Archive page Layout', 'look' ),
					'subtitle' => esc_html__( 'Select the layout for this page', 'look' ),
					'options'  => look_ruby_theme_config::blog_layout(),
					'default'  => 'layout_list'
				),
				array(
					'id'       => 'archive_sidebar',
					'type'     => 'select',
					'title'    => esc_html__( 'Archive Page Sidebar', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar for this page', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_name(),
					'default'  => 'look_ruby_sidebar_default'
				),
				array(
					'id'       => 'archive_sidebar_position',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Archive Sidebar Position', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar position for this page. This option will override default sidebar position option.', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_position(),
					'default'  => 'default'
				),
				array(
					'id'       => 'archive_header_background',
					'type'     => 'media',
					'title'    => esc_html__( 'Archive header BG', 'look' ),
					'subtitle' => esc_html__( 'Upload header background for header area.', 'look' )
				),
				array(
					'id'     => 'section_end_archive_page',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			)
		);
	}
}


//Search page
if ( ! function_exists( 'look_ruby_search_page_config' ) ) {
	function look_ruby_search_page_config() {
		return array(
			'id'         => 'look_ruby_theme_ops_section_search_page',
			'title'      => esc_html__( 'Search page options', 'look' ),
			'desc'       => esc_html__( 'Select options for search page', 'look' ),
			'subsection' => true,
			'icon'       => 'el el-list-alt',
			'fields'     => array(
				array(
					'id'     => 'section_start_search_page',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Search Page options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'search_layout',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Search page layout', 'look' ),
					'subtitle' => esc_html__( 'Select the layout for this page', 'look' ),
					'options'  => look_ruby_theme_config::blog_layout(),
					'default'  => 'layout_grid_small_s'
				),
				array(
					'id'       => 'search_sidebar',
					'type'     => 'select',
					'title'    => esc_html__( 'Search Page Sidebar', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar for this page', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_name(),
					'default'  => 'look_ruby_sidebar_default'
				),
				array(
					'id'       => 'search_sidebar_position',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Search Sidebar Position', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar position for this page. This option will override default sidebar position option.', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_position(),
					'default'  => 'none'
				),
				array(
					'id'     => 'section_end_search_page',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			)
		);
	}
}

//team author page
if ( ! function_exists( 'look_ruby_author_team_page_config' ) ) {
	function look_ruby_author_team_page_config() {
		return array(
			'id'         => 'look_ruby_theme_ops_section_author_team_page',
			'title'      => esc_html__( 'Author team options', 'look' ),
			'desc'       => esc_html__( 'Select options for author team page, to create author team page, please go to page -> add new and then assign "Author Team" Template in Page Attributes option  for that page', 'look' ),
			'subsection' => true,
			'icon'       => 'el el-list-alt',
			'fields'     => array(
				array(
					'id'       => 'excepted_author_team_id',
					'type'     => 'text',
					'title'    => esc_html__( 'Excepted Author IDs', 'look' ),
					'subtitle' => esc_html__( 'Input author id if you do not want to display theme in this page, Separated by commas (example: 1,2,3) ', 'look' ),
				)
			)
		);
	}
}
