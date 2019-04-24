<?php
//check options
$look_ruby_smooth_display_enable = look_ruby_core::get_option( 'site_smooth_display' );
$look_ruby_smooth_display_style  = look_ruby_core::get_option( 'site_smooth_display_style' );
$look_ruby_grid_excerpt_length   = look_ruby_core::get_option( 'grid_excerpt_length' );
$look_ruby_post_share_bar_grid   = look_ruby_core::get_option( 'post_share_bar_grid' );

//create classes
$look_ruby_classes   = array();
$look_ruby_classes[] = 'post-wrap post-grid is-center';

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
	<!--#thumb outer-->
	<div class="post-header">
		<?php look_ruby_template_part::post_cat_info(); ?>
		<?php look_ruby_template_part::post_title( 'is-medium-title' ); ?>
		<?php look_ruby_template_part::post_meta_info(); ?>
	</div>
	<?php look_ruby_template_part::post_excerpt( $look_ruby_grid_excerpt_length ); ?>
	<?php if ( ! empty( $look_ruby_post_share_bar_grid ) ) : ?>
		<?php look_ruby_template_part::post_share_bar(); ?>
	<?php endif; ?>
</article><!--#post grid-->
