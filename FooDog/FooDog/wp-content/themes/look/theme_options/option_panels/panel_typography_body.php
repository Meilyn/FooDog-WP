<?php
if ( ! function_exists( 'look_ruby_theme_options_typography_body' ) ) {
	function look_ruby_theme_options_typography_body() {
		return array(
			'id'         => 'look_ruby_theme_options_typography_body',
			'title'      => esc_html__( 'Body Typography', 'look' ),
			'icon'       => 'el el-font',
			'subsection' => true,
			'desc'       => html_entity_decode( esc_html__( 'Selecting a font will show a basic preview. Go to <a href="http://www.google.com/webfonts" target="_blank">google fonts directory</a> for more details. It is highly recommended that you choose fonts that have similar heights to the default fonts.<br/><br/>To restore to default font settings, click: <strong>Reset Section</strong>', 'look' ) ),
			'fields'     => array(
				//Body font config
				array(
					'id'     => 'section_start_body_font',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'body content font options', 'look' ),
					'indent' => true
				),
				array(
					'id'             => 'body_font',
					'type'           => 'typography',
					'title'          => esc_html__( 'body text font', 'look' ),
					'subtitle'       => esc_html__( 'This font of option will affect to post and page content of your site', 'look' ),
					'google'         => true,
					'font-backup'    => true,
					'text-align'     => false,
					'color'          => true,
					'text-transform' => true,
					'letter-spacing' => true,
					'line-height'    => true,
					'all_styles'     => true,
					'units'          => 'px',
					'default'        => array(
						'font-family' => 'Raleway',
						'font-size'   => '16px',
						'font-weight' => '400',
						'color'       => '#242424',
						'line-height'    => '26px',
					),
					'output'         => array( 'body' )
				),
				array(
					'id'     => 'section_end_body_font',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//block excerpt text
				array(
					'id'     => 'section_start_block_excerpt_font',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'excerpt font options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'post_excerpt_font_size',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Post Excerpt - Font Size', 'look' ),
					'subtitle' => esc_html__( 'Select font size for post excerpt(px), this options will not affect to classic layout', 'look' ),
					'default'  => '14'
				),
				array(
					'id'       => 'post_excerpt_font_lineheight',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Post Excerpt - Font LineHeight', 'look' ),
					'subtitle' => esc_html__( 'Select line-height for post excerpt (in px), please blank or set 0 if you want set default value', 'look' ),
					'default'  => ''
				),
				array(
					'id'     => 'section_end_block_excerpt_font',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				)
			)
		);
	}
}

