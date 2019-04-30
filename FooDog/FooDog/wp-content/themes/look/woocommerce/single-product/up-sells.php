<?php
/**
 * Single Product Up-Sells
 *
 */
$look_ruby_woo_product = look_ruby_woo_global_product();

if ( ! $upsells = $look_ruby_woo_product->get_upsells() ) {
	return;
}

$look_ruby_woo_sidebar_position = look_ruby_core::get_option( 'woocommerce_sidebar_position_product' );
if ( 'none' == $look_ruby_woo_sidebar_position ) {
	$look_ruby_posts_per_page = 4;
} else {
	$look_ruby_posts_per_page = 3;
}

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $look_ruby_posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $look_ruby_woo_product->id ),
	'meta_query'          => WC()->query->get_meta_query()
);

$products = new WP_Query( $args );

//look_ruby_related_woocommerce_loop
look_ruby_upsell_woocommerce_loop( $columns );

if ( $products->have_posts() ) : ?>

	<div class="up-sells upsells products">
		<div class=" widget-title block-title">
			<h3><?php _e( 'You may also like&hellip;', 'look' ) ?></h3>
		</div>

		<?php woocommerce_product_loop_start(); ?>

		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

			<?php wc_get_template_part( 'content', 'product' ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();