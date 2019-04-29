<?php
//check options
$look_ruby_post_format            = look_ruby_post_format::check_post_format();
$look_ruby_smooth_display_enable  = look_ruby_core::get_option( 'site_smooth_display' );
$look_ruby_smooth_display_style   = look_ruby_core::get_option( 'site_smooth_display_style' );
$look_ruby_post_share_bar_classic = look_ruby_core::get_option( 'post_share_bar_classic' );

//classic summary type
$look_ruby_classic_excerpt_length = look_ruby_core::get_option( 'classic_excerpt_length' );
$look_ruby_classic_summary_type   = look_ruby_core::get_option( 'classic_summary_type' );


//create classes
$look_ruby_classes   = array();
$look_ruby_classes[] = 'post-wrap post-classic';

if ( ! empty( $look_ruby_smooth_display_enable ) ) {
	$look_ruby_classes[] = 'ruby-animated-image ' . esc_attr( $look_ruby_smooth_display_style );
}
$look_ruby_classes = implode( ' ', $look_ruby_classes );

?>

<article class="<?php echo esc_attr( $look_ruby_classes ); ?>">
	<div class="post-thumb-outer">
		<?php switch ( $look_ruby_post_format ) {
			case 'gallery' :
				echo look_ruby_template_thumbnail::render_gallery();
				break;
			case 'video':
				echo look_ruby_template_thumbnail::render_video();
				break;
			case 'audio' :
				echo look_ruby_template_thumbnail::render_audio();
				break;
			default :
				echo look_ruby_template_thumbnail::render_image( 'look_ruby_760_510' );
				look_ruby_template_part::post_review_score();
				break;
		} ?>
	</div>
	<!--#thumb outer-->
	<div class="post-header is-center">
		<?php look_ruby_template_part::post_cat_info(); ?>
		<?php look_ruby_template_part::post_title( 'is-big-title' ); ?>
		<?php look_ruby_template_part::post_meta_info(); ?>
	</div>
	<?php if ( ! empty( $look_ruby_classic_summary_type ) ) : ?>
		<?php look_ruby_template_part::post_content(); ?>
		<?php if ( ! empty( $look_ruby_post_share_bar_classic ) ) : ?>
			<?php look_ruby_template_part::post_share_bar(); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php look_ruby_template_part::post_excerpt( $look_ruby_classic_excerpt_length ); ?>
		<?php if ( ! empty( $look_ruby_post_share_bar_classic ) ) : ?>
			<?php look_ruby_template_part::post_share_bar(); ?>
		<?php endif; ?>
	<?php endif; ?>
</article><!--#post classic lite-->
