<?php

//get option
$look_ruby_top_bar_header = look_ruby_core::get_option( 'header_top_bar' );
$look_ruby_top_bar_search = look_ruby_core::get_option( 'header_top_bar_search' );
if ( empty( $look_ruby_top_bar_header ) ) {
	return false;
}
?>

<div class="top-bar-wrap clearfix">
	<div class="ruby-container">
		<div class="top-bar-inner clearfix">
			<div class="top-bar-menu">
			<?php
				if ( has_nav_menu( 'look_ruby_top_navigation' ) ) {
					wp_nav_menu(
						array(
							'container'      => false,
							'theme_location' => 'look_ruby_top_navigation',
							'menu_class'     => 'top-bar-menu-inner',
							'depth'          => '3',
							'echo'           => true
						)
					);
			}; ?>
			</div><!-- top bar menu -->

			<?php if(!empty($look_ruby_top_bar_search)) : ?>
				<div id="top-bar-search">
					<?php get_search_form( true ); ?>
				</div><!--#top bar search-->
			<?php endif; ?>
		</div><!--#top bar inner -->
	</div><!--#ruby container-->
</div><!--#top bar wrap-->
	