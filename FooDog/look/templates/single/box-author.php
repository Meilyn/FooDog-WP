<?php

//check settings
$look_ruby_single_post_box_author = look_ruby_core::get_option( 'single_post_box_author' );
if ( empty( $look_ruby_single_post_box_author )) {
	return false;
}

$look_ruby_author_id          = get_the_author_meta( 'ID' );
$look_ruby_author_name        = get_the_author_meta( 'display_name' );
$look_ruby_author_job         = '';
$look_ruby_author_decs        = '';
$look_ruby_author_social_data = look_ruby_social_data::author_data( $look_ruby_author_id );
$look_ruby_render_social      = look_ruby_social_bar::render( $look_ruby_author_social_data );

if ( ! empty( $look_ruby_author_social_data['job'] ) ) {
	$look_ruby_author_job = $look_ruby_author_social_data['job'];
}
if ( ! empty( $look_ruby_author_social_data['description'] ) ) {
	$look_ruby_author_decs = $look_ruby_author_social_data['description'];
}

//remove if empty
if ( empty( $look_ruby_author_decs ) && empty( $look_ruby_render_social ) ) {
	return false;
}

?>

<div class="single-author-wrap single-box">
	<div class="single-author-inner clearfix">
		<div class="author-thumb-wrap">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 140, '', $look_ruby_author_name ); ?>
		</div>
		<div class="author-content-wrap">
			<div class="author-title">
				<a href="<?php echo get_author_posts_url( $look_ruby_author_id ); ?>">
					<h3><?php echo esc_html( $look_ruby_author_name ) ?></h3></a>
				<?php if(!empty($look_ruby_author_job)) : ?>
				<span class="author-job"><?php echo esc_html( $look_ruby_author_job ); ?></span>
				<?php endif; ?>
			</div>
			<?php if ( ! empty( $look_ruby_author_decs ) ) : ?>
				<div class="author-description"><?php echo( $look_ruby_author_decs ); ?></div>
			<?php endif; ?>
			<?php if ( ! empty( $look_ruby_render_social ) ) : ?>
				<div class="author-social"><?php echo( $look_ruby_render_social ); ?></div>
			<?php endif; ?>
		</div>
	</div>
</div><!--#author box -->
