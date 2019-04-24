<?php
/**
 * look created by ThemeRuby
 * This file display home layout
 */

//get home options
$look_ruby_options                          = array();
$look_ruby_options['big_first']             = look_ruby_core::get_option( 'big_post_first' );
$look_ruby_options['blog_layout']           = look_ruby_core::get_option( 'blog_layout' );
$look_ruby_options['blog_sidebar_name']     = look_ruby_core::get_option( 'blog_sidebar' );
$look_ruby_options['blog_sidebar_position'] = look_ruby_core::get_option( 'blog_sidebar_position' );

if ( 'default' == $look_ruby_options['blog_sidebar_position'] ) {
	$look_ruby_options['blog_sidebar_position'] = look_ruby_core::get_option( 'site_sidebar_position' );
}

//render featured area
echo look_ruby_feat();

//render home columns
get_template_part( 'templates/section', 'column' );

//render layout
look_ruby_blog_layout( $look_ruby_options );


