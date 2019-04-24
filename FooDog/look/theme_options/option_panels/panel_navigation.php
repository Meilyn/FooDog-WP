<?php
if ( ! function_exists( 'look_ruby_theme_options_navigation' ) ) {
	function look_ruby_theme_options_navigation() {
		//Header options config
		return array(
			'id'     => 'look_ruby_theme_ops_section_navigation',
			'title'  => esc_html__( 'Navigation Options', 'look' ),
			'desc'   => esc_html__( 'Select options for main navigation of site', 'look' ),
			'icon'   => 'el el-compass',
			'fields' => array(
				//main navigation
				array(
					'id'     => 'section_start_main_navigation',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'main navigation options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'sticky_navigation',
					'type'     => 'switch',
					'title'    => esc_html__( 'Sticky Navigation', 'look' ),
					'subtitle' => esc_html__( 'This makes main navigation float at the top when the user scrolls up below the fold - essentially making navigation menu always visible', 'look' ),
					'default'  => 1
				),
				array(
					'id'       => 'sticky_navigation_smart',
					'title'    => esc_html__( 'Smart Sticky', 'look' ),
					'subtitle' => esc_html__( 'only sticky navigation when scrolling up', 'look' ),
					'type'     => 'switch',
					'required' => array( 'sticky_navigation', '=', '1' ),
					'default'  => 1
				),
				array(
					'id'     => 'section_end_main_navigation',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//navigation styling
				array(
					'id'     => 'section_start_navigation_styling',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Navigation styling', 'look' ),
					'indent' => true
				),
				array(
					'id'          => 'main_nav_background',
					'title'       => esc_html__( 'Navigation Background', 'look' ),
					'subtitle'    => esc_html__( 'Select background color for navigation, Leave blank if you want to set default', 'look' ),
					'type'        => 'color',
					'validate'    => 'color',
					'transparent' => false,
					'default'     => ''
				),
				array(
					'id'          => 'main_nav_text_color',
					'type'        => 'color',
					'transparent' => false,
					'validate'    => 'color',
					'title'       => esc_html__( 'Navigation text color', 'look' ),
					'subtitle'    => esc_html__( 'Select color for text of navigation.  Leave blank if you want set to default', 'look' ),
				),
				array(
					'id'          => 'main_nav_text_color_hover',
					'type'        => 'color',
					'transparent' => false,
					'validate'    => 'color',
					'title'       => esc_html__( 'Navigation text hover color', 'look' ),
					'subtitle'    => esc_html__( 'Select color for text of navigation when hover and focus.  Leave blank if you want set to default', 'look' ),
				),
				array(
					'id'       => 'main_navigation_height',
					'type'     => 'text',
					'class'    => 'small-text',
					'title'    => esc_html__( 'Navigation Height', 'look' ),
					'subtitle' => esc_html__( 'Select height for main navigation (in px), Leave blank if you want to set default', 'look' ),
					'default'  => '60'
				),
				array(
					'id'     => 'section_end_main_navigation',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//sub navigation
				array(
					'id'     => 'section_start_main_sub_navigation',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'sub level navigation styling', 'look' ),
					'indent' => true
				),
				array(
					'id'          => 'main_sub_nav_background',
					'title'       => esc_html__( 'Sub Level Navigation Background', 'look' ),
					'subtitle'    => esc_html__( 'Select background color for sub navigation font, Leave Blank if you want to set default', 'look' ),
					'type'        => 'color',
					'validate'    => 'color',
					'transparent' => false,
					'default'     => ''
				),
				array(
					'id'          => 'main_nav_sub_level_text_color',
					'type'        => 'color',
					'transparent' => false,
					'validate'    => 'color',
					'title'       => esc_html__( 'Sub Level Navigation text color', 'look' ),
					'subtitle'    => esc_html__( 'Select color for text of sub level navigation.  Leave blank if you want set to default', 'look' ),
				),
				array(
					'id'          => 'main_nav_sub_level_text_color_hover',
					'type'        => 'color',
					'transparent' => false,
					'validate'    => 'color',
					'title'       => esc_html__( 'Sub Level Navigation text hover color', 'look' ),
					'subtitle'    => esc_html__( 'Select color for text of sub level navigation when hover and focus.  Leave blank if you want set to default', 'look' ),
				),
				array(
					'id'       => 'mega_menu_cat_text_style',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Mega Menu Post Text Style', 'look' ),
					'subtitle' => esc_html__( 'Select text style for category mega menu post to suit with background.', 'look' ),
					'options'  => look_ruby_theme_config::text_style(),
					'default'  => 'is-dark-text'
				),
				array(
					'id'     => 'section_end_main_sub_navigation',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				)
			)
		);
	}
}