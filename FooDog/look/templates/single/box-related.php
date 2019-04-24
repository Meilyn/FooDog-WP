<?php
//get settings
$look_ruby_single_post_related_box = look_ruby_core::get_option( 'single_post_related_box' );
if ( empty( $look_ruby_single_post_related_box ) ) {
	return false;
}
//get data
$look_ruby_single_related_data = look_ruby_post_related::get_data();
$look_ruby_related_box_text    = look_ruby_core::get_option( 'single_post_related_box_title' );

if ( ! empty( $look_ruby_single_related_data ) ) :
	?>
	<div class="single-related-wrap single-box">
		<div class="single-related-header block-title">
			<h3><?php echo esc_html( $look_ruby_related_box_text ); ?></h3>
		</div>
		<div class="single-related-content row">

			<?php foreach ( $look_ruby_single_related_data as $post ) : ?>
				<?php setup_postdata( $post ); ?>
				<div class="col-sm-4 col-xs-6">
					<?php get_template_part( 'templates/module/layout', 'grid_small_s' ); ?>
				</div>
			<?php endforeach; ?>

		</div>
	</div><!-- related wrap -->
<?php endif; ?>
<?php wp_reset_postdata(); ?>