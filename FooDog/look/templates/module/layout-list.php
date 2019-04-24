<?php
//get settings
$look_ruby_smooth_display_enable = look_ruby_core::get_option( 'site_smooth_display' );
$look_ruby_smooth_display_style  = look_ruby_core::get_option( 'site_smooth_display_style' );
$look_ruby_list_excerpt_length   = look_ruby_core::get_option( 'list_excerpt_length' );
$look_ruby_post_share_bar_list   = look_ruby_core::get_option( 'post_share_bar_list' );

//create classes
$look_ruby_classes   = array();
$look_ruby_classes[] = 'post-wrap post-list row row-eq-height';
if ( ! empty( $look_ruby_smooth_display_enable ) ) {
	$look_ruby_classes[] = 'ruby-animated-image ' . esc_attr( $look_ruby_smooth_display_style );
}
$look_ruby_classes = implode( ' ', $look_ruby_classes );

?>

<article class="<?php echo esc_attr( $look_ruby_classes ); ?>">
	<div class="is-left-col col-sm-6 col-xs-4">
		<div class="post-thumb-outer">
			<?php echo look_ruby_template_thumbnail::render_image( 'look_ruby_360_250' ); ?>
			<?php look_ruby_template_part::post_format_info(); ?>
			<?php look_ruby_template_part::post_review_score(); ?>
		</div>
	</div>
	<!--#left column -->
	<div class="is-right-col col-sm-6 col-xs-8">
		<div class="is-table">
			<div class="is-cell is-middle">
				<div class="post-header">
					<div class="post-header-meta">
						<?php look_ruby_template_part::post_cat_info(); ?>
						<?php look_ruby_template_part::post_meta_info(); ?>
					</div>
					<?php look_ruby_template_part::post_title(); ?>
				</div>
				<?php look_ruby_template_part::post_excerpt( $look_ruby_list_excerpt_length ); ?>
				<?php if ( ! empty( $look_ruby_post_share_bar_list ) ) : ?>
					<?php look_ruby_template_part::post_share_bar(); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!--#right column -->
</article><!--#post list-->