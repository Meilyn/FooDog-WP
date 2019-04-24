<?php
$logo        = look_ruby_core::get_option( 'logo_mobile' );
$logo_retina = look_ruby_core::get_option( 'logo_retina_mobile' );
?>

<div class="header-logo-mobile-wrap">
	<?php
	if ( ! empty( $logo['url'] ) ) {
		if ( empty( $logo_retina['url'] ) ) {
			echo '<a class="logo-image-mobile" href="' . get_home_url() . '">';
			echo '<img class="logo-img-data" data-no-retina src="' . esc_url( $logo['url'] ) . '" alt="' . get_bloginfo( 'name' ) . '" height="' . esc_attr($logo['height']) . '" width="' . esc_attr($logo['width']) . '">';
			echo '</a>';
		} else {
			echo '<a class="logo-image-mobile" href="' . get_home_url() . '">';
			echo '<img class="logo-img-data" data-at2x="' . esc_url( $logo_retina['url'] ) . '" src="' . esc_url( $logo['url'] ) . '" alt="' . get_bloginfo( 'name' ) . '" height="' . esc_attr($logo['height']) . '" width="' . esc_attr($logo['width']) . '"/>';
			echo '</a>';
		}
	} else {
		echo '<div class="logo-text-mobile-wrap">';
		echo '<strong class="logo-text"><a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a></strong>';
		echo '</div>';
	} ?>
</div><!--# logo mobile wrap -->		