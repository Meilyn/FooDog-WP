<?php
$look_ruby_count_views = look_ruby_post_view::get_view();
?>

<?php if ( ! empty ( $look_ruby_count_views ) )  : ?>
	<span class="meta-info-el meta-info-view">
		<?php if ( 1 == $look_ruby_count_views ) : ?>
			<a href="<?php echo get_permalink() ?>" title="<?php echo strip_tags( get_the_title() ) ?>">
				<span><?php esc_attr_e( '1 view', 'look' ); ?></span>
			</a>
		<?php else : ?>
			<a href="<?php echo get_permalink() ?>" title="<?php echo strip_tags( get_the_title() ) ?>">
				<span><?php echo esc_attr( $look_ruby_count_views ) . ' ' . esc_attr__( 'views', 'look' ); ?></span>
			</a>
	<?php endif; ?>
	</span><!--#info meta view-->
<?php endif; ?>
