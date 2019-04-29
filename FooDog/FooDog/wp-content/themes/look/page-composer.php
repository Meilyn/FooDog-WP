<?php
/*
Template Name: Page Composer
*/
echo look_ruby_composer_render::render_page();

//render latest loop
$look_ruby_composer_latest_loop = get_post_meta( get_the_ID(), 'look_ruby_composer_latest', true );
if ( 1 == $look_ruby_composer_latest_loop ) {
	echo look_ruby_template_composer_loop::render();
}

