<?php
/**
 * look created by ThemeRuby
 * This file display category layout
 */

$look_ruby_page_cat_id = look_ruby_core::get_page_cat_id();
//get home options
$look_ruby_meta_cat = get_option( 'look_ruby_cat_option' ) ? get_option( 'look_ruby_cat_option' ) : array();
if ( array_key_exists( $look_ruby_page_cat_id, $look_ruby_meta_cat ) ) {
	$look_ruby_meta_cat = $look_ruby_meta_cat[ $look_ruby_page_cat_id ];
}

//get settings
$look_ruby_options = array();
if ( ! empty( $look_ruby_meta_cat['look_ruby_cat_layout'] ) && 'default' != $look_ruby_meta_cat['look_ruby_cat_layout'] ) {
	$look_ruby_options['blog_layout'] = $look_ruby_meta_cat['look_ruby_cat_layout'];
} else {
	$look_ruby_options['blog_layout'] = look_ruby_core::get_option( 'category_layout' );
}

$look_ruby_options['blog_sidebar_name']     = look_ruby_core::get_option( 'category_sidebar' );
$look_ruby_options['blog_sidebar_position'] = look_ruby_core::get_option( 'category_sidebar_position' );
$look_ruby_options['big_first']             = look_ruby_core::get_option( 'category_big_post_first' );

if ( 'default' == $look_ruby_options['blog_sidebar_position'] ) {
	$look_ruby_options['blog_sidebar_position'] = look_ruby_core::get_option( 'site_sidebar_position' );
}

//render category header
echo look_ruby_render_page_header_category( $look_ruby_meta_cat );

//render layout
look_ruby_blog_layout( $look_ruby_options );


