<?php
//get tag
$look_ruby_tags = get_the_tags();
?>
<?php if ( ! empty( $look_ruby_tags ) && is_array( $look_ruby_tags ) ) : ?>
	<div class="single-tag-wrap">
		<span class="tag-title"><?php esc_html_e( 'Tags :', 'look' ) ?></span>
		<?php
		foreach ( $look_ruby_tags as $look_ruby_tag ) {
			$look_ruby_tag_link = get_tag_link( $look_ruby_tag->term_id );
			echo '<a href="' . esc_url( $look_ruby_tag_link ) . '" title="' . esc_attr( $look_ruby_tag->name ) . '">' . esc_html( $look_ruby_tag->name ) . '</a>';
		} ?>
	</div>
<?php endif; ?>