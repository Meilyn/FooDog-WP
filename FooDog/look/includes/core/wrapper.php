<?php

/**
 * @return mixed
 * theme wrapper
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */
if ( ! class_exists( 'look_ruby_base_template_wrapper' ) ) {
	class look_ruby_base_template_wrapper {

		static $main_template;
		static $base;

		static function look_ruby_wrapper( $template ) {
			self::$main_template = $template;

			self::$base = substr( basename( self::$main_template ), 0, - 4 );

			if ( 'index' == self::$base ) {
				self::$base = false;
			}

			$templates = array( 'base.php' );
			if ( self::$base ) {
				array_unshift( $templates, sprintf( 'base-%s.php', self::$base ) );
			}

			return locate_template( $templates );
		}
	}


	//template wrapping
	add_filter( 'template_include', array( 'look_ruby_base_template_wrapper', 'look_ruby_wrapper' ), 99 );
}

if ( ! function_exists( 'look_ruby_base_template_path' ) ) {
	function look_ruby_base_template_path() {
		return look_ruby_base_template_wrapper::$main_template;
	}
}

if ( ! function_exists( 'look_ruby_base_template' ) ) {
	function look_ruby_base_template() {
		return look_ruby_base_template_wrapper::$base;
	}
}


