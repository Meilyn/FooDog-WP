<?php
$look_ruby_human_time = look_ruby_core::get_option('human_time');
$look_ruby_date_unix = get_the_time( 'U', get_the_ID() );
?>
<span class="meta-info-el meta-info-date">
<?php if ( ! empty( $look_ruby_human_time ) ) : ?>
	<time class="date updated" datetime="<?php echo date( DATE_W3C, $look_ruby_date_unix ); ?>"><?php echo human_time_diff( get_the_time( 'U',  get_the_ID() ), current_time( 'timestamp' ) ) . ' ' . esc_html__( 'ago', 'look' ); ?></time>
<?php else: ?>
	<time class="date updated" datetime="<?php echo date( DATE_W3C, $look_ruby_date_unix ); ?>"><?php echo get_the_date( '', get_the_ID() ) ?></time>
<?php endif; ?>
</span><!--#date meta-->

