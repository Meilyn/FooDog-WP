<?php
//featured image
$look_ruby_smooth_display_enable = look_ruby_core::get_option( 'site_smooth_display' );
$look_ruby_smooth_display_style  = look_ruby_core::get_option( 'site_smooth_display_style' );

//create classes
$look_ruby_classes   = array();
$look_ruby_classes[] = 'post-wrap post-overlay post-overlay-small';
if ( ! empty( $look_ruby_smooth_display_enable ) ) {
	$look_ruby_classes[] = 'ruby-animated-image ' . esc_attr( $look_ruby_smooth_display_style );
}
$look_ruby_classes = implode( ' ', $look_ruby_classes );

?>

<article class="<?php echo esc_attr( $look_ruby_classes ); ?>">
	<div class="post-thumb-outer">
		<?php echo look_ruby_template_thumbnail::render_image( 'look_ruby_360_250' ); ?>
		<?php look_ruby_template_part::post_format_info(); ?>
		<?php look_ruby_template_part::post_review_score(); ?>
	</div>
	<div class="is-absolute">
		<div class="post-header is-left is-light-text">
			<?php look_ruby_template_part::post_cat_info( 'is-relative' ); ?>
			<?php look_ruby_template_part::post_title( 'is-medium-title' ); ?>
		</div>
	</div>
</article>