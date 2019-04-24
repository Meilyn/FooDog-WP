<?php

//registering admin css and script
if ( ! function_exists( 'look_ruby_register_backend_script' ) ) {
	function look_ruby_register_backend_script( $hook ) {
		wp_register_style( 'look_ruby_admin_style', get_template_directory_uri() . '/includes/admin/css/admin-style.css', array(), LOOK_THEME_VERSION, 'all' );
		wp_enqueue_style( 'look_ruby_admin_style' );

		//only load in post
		if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
			wp_register_script( 'look_ruby_admin_script', get_template_directory_uri() . '/includes/admin/js/admin-script.js', array( 'jquery' ), LOOK_THEME_VERSION, true );
			wp_enqueue_script( 'look_ruby_admin_script' );
		}
	}

	//check & do action
	if ( is_admin() ) {
		add_action( 'admin_enqueue_scripts', 'look_ruby_register_backend_script' );
	}
};
