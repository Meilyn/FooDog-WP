<?php
//registering page composer css and script
if ( ! function_exists( 'look_ruby_register_composer_script' ) ) {
	function look_ruby_register_composer_script( $hook ) {
		if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
			wp_enqueue_style( 'look_ruby_composer_style', get_template_directory_uri() . '/includes/composer/css/composer-style.css', array(), LOOK_THEME_VERSION, 'all' );
			wp_enqueue_script( 'look_ruby_composer_script', get_template_directory_uri() . '/includes/composer/js/composer-script.js', array( 'jquery' ), LOOK_THEME_VERSION, true );
		}
	}
	add_action( 'admin_enqueue_scripts', 'look_ruby_register_composer_script' );
}

