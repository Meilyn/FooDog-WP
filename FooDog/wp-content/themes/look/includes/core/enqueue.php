<?php
//frontend script
if ( ! function_exists( 'look_ruby_register_frontend_script' ) ) {
	function look_ruby_register_frontend_script() {

		//load theme styles
		wp_enqueue_style( 'look_ruby_external_style', get_template_directory_uri() . '/assets/external/external-style.css', array(), LOOK_THEME_VERSION, 'all' );
		wp_enqueue_style( 'look_ruby_main_style', get_template_directory_uri() . '/assets/css/theme-style.css', array( 'look_ruby_external_style' ), LOOK_THEME_VERSION, 'all' );
		wp_enqueue_style( 'look_ruby_responsive_style', get_template_directory_uri() . '/assets/css/theme-responsive.css', array('look_ruby_external_style','look_ruby_main_style'), LOOK_THEME_VERSION, 'all' );
		wp_enqueue_style( 'look_ruby_default_style', get_stylesheet_uri(), array('look_ruby_external_style','look_ruby_main_style','look_ruby_responsive_style'), LOOK_THEME_VERSION );

		//woocommerce support
		if ( class_exists( 'Woocommerce' ) ) {
			wp_register_style( 'look_ruby_woocommerce_style', get_template_directory_uri() . '/woocommerce/css/theme-woocommerce.css', array(), LOOK_THEME_VERSION, 'all' );
			wp_enqueue_style( 'look_ruby_woocommerce_style' );
		}

		//load comment script
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		//load theme script
		wp_enqueue_script( 'look_ruby_external_script', get_template_directory_uri() . '/assets/external/external-script.js', array( 'jquery' ), LOOK_THEME_VERSION, true );
		//load theme script
		wp_enqueue_script( 'look_ruby_main_script', get_template_directory_uri() . '/assets/js/theme-script.js', array('jquery','look_ruby_external_script',), LOOK_THEME_VERSION, true );

		//check & enable retina lib
		if ( 1 == get_option( 'look_ruby_retina_support_option', false ) ) {
			wp_enqueue_script( 'retina_script', get_template_directory_uri() . '/assets/external/retina.min.js', array( 'jquery' ), '1.3.0', true );
		}
	}

	if ( ! is_admin() ) {
		add_action( 'wp_enqueue_scripts', 'look_ruby_register_frontend_script' );
	}
}
