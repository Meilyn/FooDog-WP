<?php
$look_ruby_post_previous = get_adjacent_post( false, '', true );
$look_ruby_post_next     = get_adjacent_post( false, '', false );

if ( empty( $look_ruby_post_next ) && empty( $look_ruby_post_previous ) ) {
	return false;
}
?>

<div class="single-nav single-box row" role="navigation">
	<?php if ( ! empty( $look_ruby_post_previous ) ) : ?>
		<div class="col-sm-6 col-xs-12 nav-el nav-left">
			<div class="nav-arrow">
				<i class="fa fa-angle-left"></i>
				<span class="nav-sub-title"><?php esc_html_e( 'previous article', 'look' ) ?></span>
			</div>
			<h3 class="post-title is-small-title">
				<a href="<?php echo get_permalink($look_ruby_post_previous->ID) ?>" rel="bookmark" title="<?php echo esc_attr(  get_the_title($look_ruby_post_previous->ID) ) ?>">
				<?php echo get_the_title($look_ruby_post_previous->ID); ?>
				</a>
			</h3><!--#module title-->
		</div><!--# left nav -->
	<?php endif; ?>

	<?php if ( ! empty( $look_ruby_post_next ) ) : ?>
		<div class="col-sm-6 col-xs-12 nav-el nav-right">
			<div class="nav-arrow">
				<span class="nav-sub-title"><?php esc_html_e( 'next article', 'look' ) ?></span>
				<i class="fa fa-angle-right"></i>
			</div>
			<h3 class="post-title is-small-title">
				<a href="<?php echo get_permalink($look_ruby_post_next->ID) ?>" rel="bookmark" title="<?php echo esc_attr(get_the_title($look_ruby_post_next->ID) ) ?>">
					<?php echo get_the_title($look_ruby_post_next->ID); ?>
				</a>
			</h3><!--#module title-->
		</div><!--# right nav -->
	<?php endif; ?>
</div><!--#nav wrap -->
<?php wp_reset_postdata(); ?>