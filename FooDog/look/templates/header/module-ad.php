<?php
$look_ruby_ads_type   = look_ruby_core::get_option( 'header_ads_type' );
$look_ruby_google_ads = look_ruby_core::get_option( 'header_google_ads' );
$look_ruby_img_ads    = look_ruby_core::get_option( 'header_image_ads' );
$look_ruby_url_ads    = look_ruby_core::get_option( 'header_url_ads' );
?>

<?php if ( ! empty( $look_ruby_img_ads['url'] ) || ! empty( $look_ruby_google_ads ) ) : ?>
	<div class="header-ads-wrap">
		<div class="header-ads-inner">
			<?php if ( ! empty( $look_ruby_img_ads['url'] ) && empty( $look_ruby_ads_type ) ) : ?>
				<?php if ( ! empty( $look_ruby_url_ads ) ) : ?>
					<a class="image-ads" href="<?php echo esc_url( $look_ruby_url_ads ) ?>" target="_blank">
						<img src="<?php echo esc_url( $look_ruby_img_ads['url'] ) ?>" alt="<?php bloginfo( 'name' ); ?>">
					</a>
				<?php else : ?>
					<div class="image-ads">
						<img src="<?php echo esc_url( $look_ruby_img_ads['url'] ) ?>" alt="<?php bloginfo( 'name' ); ?>">
					</div>
				<?php endif; ?>
			<?php else : ?>
				<?php echo html_entity_decode( stripcslashes( look_ruby_ad_support::render_google_ads( $look_ruby_google_ads, 'header_ads' ) ) ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
