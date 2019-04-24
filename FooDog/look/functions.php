<?php
/**
 * look functions and definitions
 * @package look
 */

//theme version
define( 'LOOK_THEME_VERSION', '1.0' );

//set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

//make theme can be translated
load_theme_textdomain( 'look', get_template_directory() . '/languages' );

//including theme components
require_once get_template_directory() . '/includes/theme_includes.php';

// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );

//title tag
add_theme_support( 'title-tag' );

// html5 support
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//post format support
add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

//featured image
add_theme_support( 'post-thumbnails' );

//Woocommerce support
add_theme_support( 'woocommerce' );

//registering theme navigation
register_nav_menu( 'look_ruby_main_navigation', esc_html( 'Main Navigation', 'look' ) );
register_nav_menu( 'look_ruby_off_canvas_navigation', esc_html( 'Off Canvas Navigation', 'look' ) );
register_nav_menu( 'look_ruby_top_navigation', esc_html( 'Top Navigation', 'look' ) );

//registering theme thumbnail sizes
add_image_size( 'look_ruby_1400_800', 1400, 800, true );
add_image_size( 'look_ruby_1400_580', 1400, 580, true );
add_image_size( 'look_ruby_760_510', 760, 510, true );
add_image_size( 'look_ruby_300_300', 300, 300, true );
add_image_size( 'look_ruby_300_270', 300, 270, true );
add_image_size( 'look_ruby_360_250', 360, 250, true );
add_image_size( 'look_ruby_320_400', 320, 400, true );
add_image_size( 'look_ruby_110x85', 110, 85, true );


