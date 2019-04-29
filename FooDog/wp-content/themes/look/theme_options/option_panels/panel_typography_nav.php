<?php
if ( ! function_exists( 'look_ruby_theme_options_typography_nav' ) ) {
	function look_ruby_theme_options_typography_nav() {
		return array(
			'id'         => 'look_ruby_theme_options_typography_nav',
			'title'      => esc_html__( 'Menu Typography', 'look' ),
			'icon'       => 'el el-font',
			'subsection' => true,
			'desc'       => html_entity_decode( esc_html__( 'Selecting a font will show a basic preview. Go to <a href="http://www.google.com/webfonts" target="_blank">google fonts directory</a> for more details. It is highly recommended that you choose fonts that have similar heights to the default fonts.<br/><br/>To restore to default font settings, click: <strong>Reset Section</strong>', 'look' ) ),
			'fields'     => array(
				//main navigation font
				array(
					'id'     => 'section_start_main_navigation_font',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'main menu font options', 'look' ),
					'indent' => true
				),
				array(
					'id'             => 'main_nav_font',
					'type'           => 'typography',
					'title'          => esc_html__( 'main menu font', 'look' ),
					'subtitle'       => esc_html__( 'Select font for main menu', 'look' ),
					'google'         => true,
					'font-backup'    => true,
					'text-align'     => false,
					'color'          => false,
					'text-transform' => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'all_styles'     => true,
					'units'          => 'px',
					'default'        => array(
						'font-family'    => 'Raleway',
						'font-size'      => '12px',
						'letter-spacing' => '1px',
						'font-weight'    => '700',
						'text-transform' => 'uppercase',
						'google'         => true,
					),
					'output'         => array(
						'.main-nav-wrap',
						'.off-canvas-nav-wrap'
					)
				),
				array(
					'id'     => 'section_end_main_navigation_font',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//top bar navigation
				array(
					'id'     => 'section_start_top_navigation_bar_font',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'top bar menu font option', 'look' ),
					'indent' => true
				),
				array(
					'id'             => 'top_bar_font',
					'type'           => 'typography',
					'title'          => esc_html__( 'Top bar menu font', 'look' ),
					'subtitle'       => esc_html__( 'Select font for top menu bar', 'look' ),
					'google'         => true,
					'font-backup'    => true,
					'text-align'     => false,
					'color'          => false,
					'text-transform' => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'all_styles'     => true,
					'units'          => 'px',
					'default'        => array(
						'font-family'    => 'Raleway',
						'font-size'      => '13px',
						'font-weight'    => '400',
						'text-transform' => 'capitalize',
						'google'         => true,
					),
					'output'         => array(
						'.top-bar-menu'
					)
				),
				array(
					'id'     => 'section_end_top_navigation_bar_font',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				)
			)
		);
	}
}

