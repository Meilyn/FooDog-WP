<?php
$look_ruby_tags = get_the_tags();
?>

<?php if ( ! empty( $look_ruby_tags ) || is_array( $look_ruby_tags ) ) : ?>
	<span class="meta-info-el meta-info-tag">
	<?php foreach ( $look_ruby_tags as $look_ruby_tag ) : ?>
			<?php $look_ruby_tag_link = get_tag_link( $look_ruby_tag->term_id ); ?>
			<a href="<?php echo esc_url($look_ruby_tag_link); ?>" title="<?php esc_attr(  $look_ruby_tag->name ) ?>"><?php echo esc_attr( $look_ruby_tag->name ); ?></a>
		<?php endforeach; ?>
</span><!--#meta info tag-->
<?php endif; ?>