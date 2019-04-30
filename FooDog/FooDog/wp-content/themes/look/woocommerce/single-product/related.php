<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$look_ruby_product = look_ruby_woo_global_product();

if ( empty( $look_ruby_product ) || ! $look_ruby_product->exists() ) {
	return;
}

if ( ! $related = $look_ruby_product->get_related( $posts_per_page ) ) {
	return;
}

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $related,
	'post__not_in'        => array( $look_ruby_product->id )
) );

$look_ruby_products               = new WP_Query( $args );

//look_ruby_related_woocommerce_loop
look_ruby_related_woocommerce_loop($columns);

if ( $look_ruby_products->have_posts() ) : ?>

	<div class="related products ">
		<div class="block-title">
			<h3><?php esc_html_e( 'Related Products', 'look' ); ?></h3>
		</div>

		<?php woocommerce_product_loop_start(); ?>

		<?php while ( $look_ruby_products->have_posts() ) : $look_ruby_products->the_post(); ?>

			<?php wc_get_template_part( 'content', 'product' ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();

