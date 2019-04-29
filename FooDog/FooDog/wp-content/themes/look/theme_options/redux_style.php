<?php
//register custom theme options style
if ( ! function_exists( 'look_ruby_register_theme_options_style' ) ) {
	function look_ruby_register_theme_options_style() {
		wp_register_style( 'look_ruby_theme_options_style', get_template_directory_uri() . '/theme_options/css/theme-options.css', array( 'redux-admin-css' ), LOOK_THEME_VERSION, 'all' );

		wp_enqueue_style( 'look_ruby_theme_options_style' );
	}

	//Check & do action
	if ( is_admin() ) {
		add_action( 'redux/page/look_ruby_theme_options/enqueue', 'look_ruby_register_theme_options_style' );
	}
};

