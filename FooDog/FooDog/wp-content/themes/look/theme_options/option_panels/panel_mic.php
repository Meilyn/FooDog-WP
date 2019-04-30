<?php
//custom script tab config
if ( ! function_exists( 'look_ruby_theme_options_custom_script' ) ) {
	function look_ruby_theme_options_custom_script() {
		return array(
			'id'     => 'look_ruby_theme_ops_section_custom_code',
			'title'  => esc_html__( 'Custom Code', 'look' ),
			'icon'   => 'el el-graph',
			'desc'   => esc_html__( 'Custom CSS will be added at end of all other customizations and thus can be used to overwrite rules', 'look' ),
			'fields' => array(
				array(
					'id'       => 'custom_css',
					'type'     => 'ace_editor',
					'title'    => esc_html__( 'CSS Code', 'look' ),
					'subtitle' => esc_html__( 'Enter your CSS code here.', 'look' ),
					'mode'     => 'css',
					'theme'    => 'monokai',
					'options' => array(
						'minLines' => 20
					),
					'default'  => ""
				),
			),
		);
	}
}

//Import & export tab config
if ( ! function_exists( 'look_ruby_theme_options_import_export' ) ) {
	function look_ruby_theme_options_import_export() {
		return array(
			'id'     => 'look_ruby_theme_ops_section_import_export',
			'title'  => esc_html__( 'Import / Export', 'look' ),
			'desc'   => esc_html__( 'Import and Export your settings from file, text or URL.', 'look' ),
			'icon'   => 'el el-inbox',
			'fields' => array(
				array(
					'id'         => 'ruby-import-export',
					'type'       => 'import_export',
					'title'      => 'Import Export',
					'subtitle'   => esc_html__('Save and restore your options, click 2 times on button when you import setting.','look'),
					'full_width' => false,
				),
			),
		);
	}
}

