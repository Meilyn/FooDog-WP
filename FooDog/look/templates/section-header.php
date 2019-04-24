<?php $header_layout_manager = look_ruby_core::get_option( 'header_layout_manager' ); ?>

<div class="header-outer">
	<?php get_template_part( 'templates/header/module', 'top_bar' ); ?>
	<?php if ( ! empty( $header_layout_manager['enabled'] ) && is_array( $header_layout_manager['enabled'] ) ) : ?>
		<div class="header-wrap">
			<?php
			foreach ( $header_layout_manager['enabled'] as $look_ruby_key => $look_ruby_val ) {
				switch ( $look_ruby_key ) {
					case 'logo_area' :
						get_template_part( 'templates/header/module', 'header_banner' );
						break;
					case 'main_nav' :
						get_template_part( 'templates/header/module', 'navigation' );
						break;
				}
			};?>
		</div><!--#header wrap-->
	<?php endif; ?>
	<?php get_template_part( 'templates/header/module', 'ad' ); ?>
</div><!--header outer -->
