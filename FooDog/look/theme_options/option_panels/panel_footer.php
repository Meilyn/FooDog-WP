<?php
if ( ! function_exists( 'look_ruby_theme_options_footer' ) ) {
	function look_ruby_theme_options_footer() {
		//footer options
		return array(
			'id'     => 'look_ruby_theme_ops_section_footer',
			'title'  => esc_html__( 'Footer Options', 'look' ),
			'desc'   => esc_html__( 'The footer uses sidebars to show information. . To add content to the footer head go to the widgets section and drag widget to the Footer 1, Footer 2 and Footer 3 sidebars.', 'look' ),
			'icon'   => 'el el-th',
			'fields' => array(

				//footer options configs
				array(
					'id'     => 'section_start_footer',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'footer options', 'look' ),
					'indent' => true
				),
				array(
					'id'          => 'footer_background',
					'type'        => 'background',
					'transparent' => false,
					'title'       => esc_html__( 'Footer Background', 'look' ),
					'subtitle'    => esc_html__( 'Footer background with image, color, etc', 'look' ),
					'default'     => array(
						'background-color'      => '#111',
						'background-size'       => 'cover',
						'background-attachment' => 'fixed',
						'background-position'   => 'center center',
						'background-repeat'     => 'no-repeat'
					),
					'output'      => array( '.footer-inner' )
				),
				array(
					'id'       => 'footer_text_style',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Footer Text Style', 'look' ),
					'subtitle' => esc_html__( 'Select text color for footer area.', 'look' ),
					'options'  => look_ruby_theme_config::text_style(),
					'default'  => 'is-light-text'
				),
				array(
					'id'     => 'section_end_footer',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//footer logo bar config
				array(
					'id'     => 'section_start_footer_bar',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'footer logo bar options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'footer_logo',
					'type'     => 'media',
					'title'    => esc_html__( 'Footer Logo', 'look' ),
					'subtitle' => esc_html__( 'Upload your footer logo', 'look' )
				),
				array(
					'id'       => 'footer_social_bar',
					'type'     => 'switch',
					'title'    => esc_html__( 'Footer Social Bar', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable footer social bar', 'look' ),
					'switch'   => true,
					'default'  => 0
				),
				array(
					'id'          => 'footer_social_bar_bg',
					'title'       => esc_html__( 'footer social bar background', 'look' ),
					'subtitle'    => esc_html__( 'select background color for the footer social bar', 'look' ),
					'type'        => 'color',
					'validate'    => 'color',
					'transparent' => false,
					'default'     => ''
				),
				array(
					'id'     => 'section_end_footer_bar',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//back to top
				array(
					'id'     => 'section_start_back_to_top',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'back to top', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'site_back_to_top',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show To Top Button', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable back to top button', 'look' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'site_back_to_top_mobile',
					'type'     => 'switch',
					'required' => array( 'site_back_to_top', '=', '1' ),
					'title'    => esc_html__( 'Enable On Mobile', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable back to top button on touch device', 'look' ),
					'switch'   => true,
					'default'  => 0
				),
				array(
					'id'     => 'section_end_back_to_top',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//footer copyright config
				array(
					'id'     => 'section_start_copyright',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Footer Copyright Options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'site_copyright',
					'type'     => 'textarea',
					'title'    => esc_html__( 'footer copyright text', 'look' ),
					'subtitle' => esc_html__( 'Enter footer copyright text and HTML is allowed (a tag).', 'look' ),
					'default'  => '',
				),
				array(
					'id'     => 'section_end_copyright',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			)
		);
	}
}


