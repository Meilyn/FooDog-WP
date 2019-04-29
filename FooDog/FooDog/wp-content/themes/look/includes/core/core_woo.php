<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * @return WC_Product
 */
if ( ! function_exists( 'look_ruby_woo_global_product' ) ) {
	function look_ruby_woo_global_product() {
		global $product;

		return $product;
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return mixed
 * max number of page
 */
if ( ! function_exists( 'look_ruby_max_number_of_page' ) ) {
	function look_ruby_max_number_of_page() {

		global $wp_query;

		return $wp_query->max_num_pages;
	}
}

/**-------------------------------------------------------------------------------------------------------------------------
 * look_ruby_related_woocommerce_loop
 */
if ( ! function_exists( 'look_ruby_related_woocommerce_loop' ) ) {
	function look_ruby_related_woocommerce_loop( $columns ) {
		global $woocommerce_loop;

		$woocommerce_loop['name']    = 'related';
		$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * look_ruby_upsell_woocommerce_loop
 */
if ( ! function_exists( 'look_ruby_upsell_woocommerce_loop' ) ) {
	function look_ruby_upsell_woocommerce_loop( $columns ) {
		global $woocommerce_loop;

		$woocommerce_loop['name']    = 'up-sells';
		$woocommerce_loop['columns'] = apply_filters( 'woocommerce_up_sells_columns', $columns );
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * woocommerce related product
 */
if ( ! function_exists( 'look_ruby_woo_output_related_products' ) ) {
	// Customize Woocommerce Related Products Output
	function look_ruby_woo_output_related_products() {
		$look_ruby_sidebar_position = look_ruby_core::get_option( 'woocommerce_sidebar_position_product' );
		if ( 'none' == $look_ruby_sidebar_position ) {
			$post_per_page = 4;
		} else {
			$post_per_page = 3;
		}

		woocommerce_related_products(
			array(
				'posts_per_page' => $post_per_page,
				'columns'        => $post_per_page
			)
		);
	}

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 10 );
	add_action( 'woocommerce_after_single_product_summary', 'look_ruby_woo_output_related_products', 20 );
}

/**-------------------------------------------------------------------------------------------------------------------------
 *  Woocommerce up sells total
 */

if ( ! function_exists( 'look_ruby_woo_up_sells_total' ) ) {

	function look_ruby_woo_up_sells_total() {
		$woo_sidebar_position = look_ruby_core::get_option( 'woocommerce_sidebar_position_product' );
		if ( 'none' == $woo_sidebar_position ) {
			return 4;
		} else {
			return 3;
		}
	}

	add_filter( 'woocommerce_up_sells_columns', 'look_ruby_woo_up_sells_total' );
}


/**-------------------------------------------------------------------------------------------------------------------------
 * cross sell posts per page
 */
if ( ! function_exists( 'look_ruby_woo_cross_sells_total' ) ) {
	function look_ruby_woo_cross_sells_total() {
		$woo_sidebar_position = look_ruby_core::get_option( 'woocommerce_sidebar_position_product' );
		if ( 'none' == $woo_sidebar_position ) {
			return 2;
		} else {
			return 1;
		}
	}

	add_filter( 'woocommerce_cross_sells_total', 'look_ruby_woo_cross_sells_total' );
	add_filter( 'woocommerce_cross_sells_column', 'look_ruby_woo_cross_sells_total' );
}


/**-------------------------------------------------------------------------------------------------------------------------
 * change number product per row
 */
if ( ! function_exists( 'look_ruby_woo_loop_columns' ) ) {
	function look_ruby_woo_loop_columns() {
		$woo_sidebar_position = look_ruby_core::get_option( 'woocommerce_sidebar_position_shop' );

		if ( 'none' == $woo_sidebar_position ) {
			return 4;
		} else {
			return 3;
		}
	}

	add_filter( 'loop_shop_columns', 'look_ruby_woo_loop_columns' );
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return mixed|string|void
 * product per page
 */
if ( ! function_exists( 'look_ruby_woo_product_per_page' ) ) {
	function look_ruby_woo_product_per_page() {
		$product_per_page = look_ruby_core::get_option( 'woocommerce_number_of_product' );
		if ( empty( $product_per_page ) ) {
			$product_per_page = get_option( 'posts_per_page' );
		}

		return $product_per_page;
	}

	add_filter( 'loop_shop_per_page', 'look_ruby_woo_product_per_page', 20 );
}


