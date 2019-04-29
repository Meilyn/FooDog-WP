<?php
/*
 * this file render woocommerce shop & product page
 */

//get settings
$look_ruby_page_title = look_ruby_core::get_option( 'woocommerce_title_shop' );
if ( false === is_product() ) {
	$look_ruby_sidebar_name     = look_ruby_core::get_option( 'woocommerce_sidebar_shop' );
	$look_ruby_sidebar_position = look_ruby_core::get_option( 'woocommerce_sidebar_position_shop' );
} else {
	$look_ruby_sidebar_name     = look_ruby_core::get_option( 'woocommerce_sidebar_product' );
	$look_ruby_sidebar_position = look_ruby_core::get_option( 'woocommerce_sidebar_position_product' );
}

if ( empty( $look_ruby_sidebar_name ) ) {
	$look_ruby_sidebar_name = 'look_ruby_sidebar_default';
}

//remove shop title
if ( is_shop() ) {
	function shop_title_false() {
		return false;
	}

	if ( empty( $look_ruby_page_title ) ) {
		add_filter( 'woocommerce_show_page_title', 'shop_title_false' );
	}
};

look_ruby_template_wrapper::open_page_wrap( 'single-wrap', $look_ruby_sidebar_position );
look_ruby_template_wrapper::open_page_inner( 'single-inner', $look_ruby_sidebar_position );
woocommerce_content();
look_ruby_template_wrapper::close_page_inner();

//render sidebar
if ( ! empty( $look_ruby_sidebar_position ) && 'none' != $look_ruby_sidebar_position ) {
	look_ruby_template_wrapper::sidebar( $look_ruby_sidebar_name );
}

look_ruby_template_wrapper::close_page_wrap();
