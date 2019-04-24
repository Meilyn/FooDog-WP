<?php
$enable_off_canvas = look_ruby_core::get_option( 'off_canvas_button' );
?>

<div class="header-banner-wrap clearfix">
	<?php if ( ! empty( $enable_off_canvas ) ) : ?>
		<?php get_template_part( 'templates/header/module', 'off_canvas_btn' ); ?>
	<?php endif; ?>
	<?php get_template_part( 'templates/header/module', 'banner_social_bar' ); ?>
	<?php get_template_part( 'templates/header/module', 'logo' ); ?>
</div>
