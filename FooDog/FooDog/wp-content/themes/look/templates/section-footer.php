<?php

$look_ruby_footer_bg           = look_ruby_core::get_option( 'footer_background' );
$look_ruby_footer_text_style   = look_ruby_core::get_option( 'footer_text_style' );

//create class
$look_ruby_classes   = array();
$look_ruby_classes[] = 'footer-wrap';
$look_ruby_classes[] = esc_attr($look_ruby_footer_text_style);

if ( ! empty( $look_ruby_footer_bg['background-image'] ) ) {
	$look_ruby_classes[] = 'has-bg-image';
}
$look_ruby_classes = implode( ' ', $look_ruby_classes ); ?>

<footer id="footer" class="<?php echo esc_attr( $look_ruby_classes ); ?>" <?php look_ruby_schema::markup( 'footer', true ); ?>>
	<?php get_template_part( 'templates/footer/module', 'top_footer' ); ?>

	<div class="footer-inner">
		<?php get_template_part( 'templates/footer/module', 'column' ); ?>
		<?php get_template_part( 'templates/footer/module', 'social_bar' ); ?>
	</div>
</footer><!--#footer -->