<?php
//featured image
$look_ruby_featured_attachment = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'look_ruby_1400_800' );
?>

<article class="post-wrap post-slider is-light-text post-slider-hw is-background-post" style="background-image: url(<?php echo esc_url( $look_ruby_featured_attachment[0] ); ?>)">
	<div class="is-table">
		<div class="is-cell is-bottom is-center">
			<div class="post-header">
				<?php look_ruby_template_part::post_cat_info( 'is-relative'); ?>
				<?php look_ruby_template_part::post_title( 'is-big-title' ); ?>
			</div><!--#post header-->
		</div>
	</div>
</article>