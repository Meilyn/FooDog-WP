<?php
if ( ! function_exists( 'look_ruby_theme_options_typography_block_header' ) ) {
	function look_ruby_theme_options_typography_block_header() {
		return array(
			'id'         => 'look_ruby_theme_options_typography_block_header',
			'title'      => esc_html__( 'block typography', 'look' ),
			'icon'       => 'el el-font',
			'subsection' => true,
			'desc'       => html_entity_decode( esc_html__( 'Selecting a font will show a basic preview. Go to <a href="http://www.google.com/webfonts" target="_blank">google fonts directory</a> for more details. It is highly recommended that you choose fonts that have similar heights to the default fonts.<br/><br/>To restore to default font settings, click: <strong>Reset Section</strong>', 'look' ) ),
			'fields'     => array(
				array(
					'id'     => 'section_start_block_header_font',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'block header font options', 'look' ),
					'indent' => true
				),
				array(
					'id'             => 'block_header_font',
					'type'           => 'typography',
					'title'          => esc_html__( 'Block & widget header font', 'look' ),
					'subtitle'       => esc_html__( 'Select font for block header', 'look' ),
					'google'         => true,
					'font-backup'    => true,
					'text-align'     => false,
					'color'          => true,
					'text-transform' => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'units'          => 'px',
					'default'        => array(
						'font-family'    => 'Raleway',
						'font-size'      => '12px',
						'color'          => '#111',
						'google'         => true,
						'font-weight'    => '700',
						'letter-spacing' => '1px',
						'text-transform' => 'uppercase'
					),
					'output'         => array(
						'.block-title',
						'.widget-title'
					)
				),
				array(
					'id'     => 'section_end_block_header_font',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			)
		);
	}
}

