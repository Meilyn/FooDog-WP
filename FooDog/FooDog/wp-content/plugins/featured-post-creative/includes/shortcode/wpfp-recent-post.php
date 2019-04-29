<?php
/**
 * 'featured_post' Shortcode
 * 
 * @package WP Featured Post
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpfp_featured_post( $atts, $content = null ) {
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		"limit" 				=> '5',
		"category" 				=> '',
		"design" 				=> '',
		"show_author" 			=> 'true',
		"show_date" 			=> 'true',
		"show_category_name" 	=> 'true',
		"order"					=> 'DESC',
		"orderby"				=> 'post_date',
		"image_height"			=> '500',
		), $atts));

	$shortcode_designs 	= wpfp_featured_post_designs();
	$posts_per_page 	= !empty($limit) 	? $limit 	: '20';
	$cat 				= (!empty($category))				? explode(',',$category) 	: '';
	$postdesign 		= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-1';
	$showDate 			= ( $show_date == 'false' ) 			? 'false' 	: 'true';
	$showCategory 		= ( $show_category_name == 'false' ) 	? 'false' 	: 'true';
	$showAuthor 		= ( $show_author == 'true' ) 		? 'true' : 'false';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 	: 'DESC';
	$orderby 			= !empty($orderby) ? $orderby : 'post_date';
	$image_height 		= (!empty($image_height)) ? $image_height : '500';

	// Shortcode file
	$wpfp_design_file_path 	= WPFP_DIR . '/templates/box-grid/' . $postdesign . '.php';
	$design_file 			= (file_exists($wpfp_design_file_path)) ? $wpfp_design_file_path : '';

	global $post;

	// Taking some variables
	$count 			= 0;
	$wpfpcount 		= 0;
	$i 				= 1;
	$grid_count		= 1;
	$prefix			= WPFP_META_PREFIX; // Metabox prefix

	// Query Parameter
	$args = array ( 
					'post_type'      	=> WPFP_POST_TYPE,
					'orderby'        	=> $orderby,
					'order'          	=> $order,
					'posts_per_page' 	=> $posts_per_page,
					'ignore_sticky_posts' => 1,
				);

	// Meta Query
	$args['meta_query'] = array(
								array(
										'key'     => $prefix.'featured_post',
										'value'   => 1,
										'compare' => '=',
								));


	// Category Parameter
	if($cat != "") {
		
		$args['tax_query'] = array(
									array(
											'taxonomy' 	=> WPFP_CAT,
											'field' 	=> 'id',
											'terms' 	=> $cat
									));

	}

	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>

		<div class="wpfp-featured-post <?php echo $postdesign; ?> wpfp-clearfix">

						<?php while ( $query->have_posts() ) : $query->the_post();

							$count++;
							$terms 		= get_the_terms( $post->ID, WPFP_CAT );
							$feat_image = wpfp_get_post_featured_image( $post->ID, 'large' );
							$wpfp_link	= array();

							if($terms) {
								foreach ( $terms as $term ) {
									$term_link = get_term_link( $term );
									$wpfp_link[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
								}
							}
							$cate_name = join( " ", $wpfp_link );

                			// Include shortcode html file
                			if( $design_file ) {
								include( $wpfp_design_file_path );
							}

							$wpfpcount++;
							$i++;
							$grid_count++;

						endwhile; ?>

		</div><!-- end .wpfp-featured-post -->

	<?php } // End of if have posts
		
		wp_reset_postdata(); // Reset WP Query
		
		$content .= ob_get_clean();
		return $content;
}

// Featured Post shortcode
add_shortcode('fpc_post_block', 'wpfp_featured_post');