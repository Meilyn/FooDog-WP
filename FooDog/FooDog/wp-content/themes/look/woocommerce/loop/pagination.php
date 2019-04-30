<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$look_ruby_max_num_page = look_ruby_max_number_of_page();
if ( $look_ruby_max_num_page <= 1 ) {
	return false;
}

?>
<nav class="woocommerce-pagination">
    <div class="pagination-wrap clearfix">
        <div class="pagination-num">
            <?php
            echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
	            'base'      => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
	            'format'    => '',
	            'add_args'  => '',
	            'current'   => max( 1, get_query_var( 'paged' ) ),
	            'total'     => $look_ruby_max_num_page,
	            'prev_text' => '<i class="fa fa-angle-double-left"></i>',
	            'next_text' => '<i class="fa fa-angle-double-right"></i>',
	            'type'      => 'plain',
	            'end_size'  => 3,
	            'mid_size'  => 3
            ) ) );

            ?>
    </div><!--#pagination inner-->
    <?php echo '<div class="pagination-text"><span>' . esc_attr__('Page', 'look') . ' ' . max( 1, get_query_var( 'paged' ) ) . esc_attr__(' of ', 'look') . $look_ruby_max_num_page . '</span></div><!--#pagination text-->'; ?>
    </div><!--#pagination wrap -->
</nav>
