<?php
$look_ruby_off_canvas_style          = look_ruby_core::get_option( 'off_canvas_style' );
$look_ruby_off_canvas_social         = look_ruby_core::get_option( 'off_canvas_social_bar' );
$look_ruby_off_canvas_widget_section = look_ruby_core::get_option( 'off_canvas_widget_section' );

if ( 'light' == $look_ruby_off_canvas_style ) {
	$look_ruby_classes = 'off-canvas-wrap is-dark-text';
} else {
	$look_ruby_classes = 'off-canvas-wrap is-light-text';
}
?>
<div class="<?php echo esc_attr( $look_ruby_classes ); ?>">
	<div class="off-canvas-inner">

		<a href="#" id="ruby-off-canvas-close-btn"><i class="ruby-close-btn" aria-hidden="true"></i></a>

		<?php if ( ! empty( $look_ruby_off_canvas_social ) ) : ?>
			<?php $look_ruby_social_data = look_ruby_social_data::web_data(); ?>
			<?php if ( ! empty( $look_ruby_social_data ) ) : ?>
				<?php echo look_ruby_social_bar::render( $look_ruby_social_data, 'off-canvas-social-wrap' ); ?>
			<?php endif; ?>
		<?php endif; ?>

		<div id="off-canvas-navigation" class="off-canvas-nav-wrap">
			<?php wp_nav_menu(
				array(
					'theme_location' => 'look_ruby_off_canvas_navigation',
					'container'      => '',
					'menu_class'     => 'off-canvas-nav-inner',
					'depth'          => 4,
					'echo'           => true,
					'fallback_cb'    => 'look_ruby_navigation_fallback'
				)
			); ?>
		</div>
		<!--#off canvas navigation-->

		<?php if ( ! empty( $look_ruby_off_canvas_widget_section ) ) : ?>
			<div class="off-canvas-widget-section-wrap sidebar-wrap">
				<div class="sidebar-inner">
					<?php if ( is_active_sidebar( 'look_ruby_sidebar_off_canvas' ) ) : ?>
						<?php dynamic_sidebar( 'look_ruby_sidebar_off_canvas' ); ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

	</div>
	<!--#off canvas inner -->
</div><!--#off canvas wrap -->