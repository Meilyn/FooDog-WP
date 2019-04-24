<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', esc_attr__( 'Product Description', 'look' ) ) );

?>

<?php if ( $heading ): ?>
	<div class="post-title is-small-title">
		<h2><?php echo esc_html($heading); ?></h2>
	</div>
<?php endif; ?>

<div class="entry">
<?php the_content(); ?>
</div>