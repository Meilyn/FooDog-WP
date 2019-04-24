<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * render featured area at home page
 */
if ( ! function_exists( 'look_ruby_feat' ) ) {
	function look_ruby_feat() {
		$feat_style = look_ruby_core::get_option( 'feat_style' );

		//render
		$str = '';

		switch ( $feat_style ) {
			case 'slider_fw' :
				$str .= '<div class="feat-wrap feat-slider-fw">';
				$str .= look_ruby_feat_slider_fw();
				$str .= '</div><!--#feat wrap-->';
				break;
			case 'slider_hw' :
				$str .= '<div class="feat-wrap feat-slider-hw">';
				$str .= look_ruby_feat_slider_hw();
				$str .= '</div><!--#feat wrap-->';
				break;
			case 'carousel' :
				$str .= '<div class="feat-wrap feat-carousel">';
				$str .= look_ruby_feat_carousel();
				$str .= '</div><!--#feat wrap-->';
				break;
			case 'grid' :
				$str .= '<div class="feat-wrap feat-grid">';
				$str .= look_ruby_feat_grid();
				$str .= '</div><!--#feat wrap-->';
				break;
			default :
				$str .= '';
				break;
		}

		return $str;
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return WP_Query
 * get featured post data
 */
if ( ! function_exists( 'look_ruby_feat_data' ) ) {
	function look_ruby_feat_data() {
		//get options
		$options = array();

		$feat_style = look_ruby_core::get_option( 'feat_style' );

		$categories = look_ruby_core::get_option( 'feat_cat' );
		if ( is_array( $categories ) ) {
			$options['category_ids'] = implode( ',', $categories );
		}
		$tags = look_ruby_core::get_option( 'feat_tag' );

		if ( is_array( $tags ) ) {
			$options['tag_in'] = $tags;
		}
		$options['orderby'] = look_ruby_core::get_option( 'feat_sort' );

		if ( 'grid' == $feat_style ) {
			$options['posts_per_page'] = 5;
		} else {
			$options['posts_per_page'] = look_ruby_core::get_option( 'feat_num' );
		}

		$options['offset'] = look_ruby_core::get_option( 'feat_offset' );

		$data_query = look_ruby_query::get_custom_query( $options );

		return $data_query;
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * render fullwidth slider
 */
if ( ! function_exists( 'look_ruby_feat_slider_fw' ) ) {
	function look_ruby_feat_slider_fw() {
		$data_query = look_ruby_feat_data();
		$str        = '';
		//check empty
		if ( $data_query->have_posts() ) {

			ob_start();
			?>
			<div class="slider-wrap is-fw-slider">
				<div class="slider-loading"></div>
				<div class="ruby-slider-fw slider-init">
					<?php while ( $data_query->have_posts() ) : ?>
						<?php $data_query->the_post(); ?>
						<?php get_template_part( 'templates/module/fw', 'slider' ); ?>
					<?php endwhile; ?>
				</div>
			</div><!--#fw slider -->

			<?php
			$str .= ob_get_clean();

		} else {
			$str .= look_ruby_block::no_content();
		}

		wp_reset_postdata();

		return $str;
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * render has wrapper slider
 */
if ( ! function_exists( 'look_ruby_feat_slider_hw' ) ) {
	function look_ruby_feat_slider_hw() {
		$data_query = look_ruby_feat_data();
		$str        = '';
		//check empty
		if ( $data_query->have_posts() ) {

			ob_start();
			?>
			<div class="ruby-container">
				<div class="feat-inner">
					<div class="slider-wrap is-hw-slider">
						<div class="slider-loading"></div>
						<div class="ruby-slider-hw slider-init">
							<?php while ( $data_query->have_posts() ) : ?>
								<?php $data_query->the_post(); ?>
								<?php get_template_part( 'templates/module/hw', 'slider' ); ?>
							<?php endwhile; ?>
						</div>
						<div class="ruby-slider-hw-nav slider-init">
							<?php while ( $data_query->have_posts() ) : ?>
								<?php $data_query->the_post(); ?>
								<?php get_template_part( 'templates/module/layout', 'grid_small_s' ); ?>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
			<?php
			$str .= ob_get_clean();

		} else {
			$str .= look_ruby_block::no_content();
		}

		wp_reset_postdata();

		return $str;
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * render carousel
 */
if ( ! function_exists( 'look_ruby_feat_carousel' ) ) {
	function look_ruby_feat_carousel() {
		$data_query = look_ruby_feat_data();
		$str        = '';
		//check empty
		if ( $data_query->have_posts() ) {

			ob_start();
			?>

			<div class="slider-wrap is-carousel">
				<div class="slider-loading"></div>
				<div class="ruby-carousel slider-init">
					<?php while ( $data_query->have_posts() ) : ?>
						<?php $data_query->the_post(); ?>
						<?php get_template_part( 'templates/module/fw', 'carousel' ); ?>
					<?php endwhile; ?>
				</div>
			</div>
			<?php
			$str .= ob_get_clean();

		} else {
			$str .= look_ruby_block::no_content();
		}

		wp_reset_postdata();

		return $str;
	}
}

/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * render featured grid
 */
if ( ! function_exists( 'look_ruby_feat_grid' ) ) {
	function look_ruby_feat_grid() {

		$data_query    = look_ruby_feat_data();
		$str           = '';
		$counter       = 1;
		$counter_right = 1;

		//check empty
		if ( $data_query->have_posts() ) {

			ob_start();
			?>
			<div class="ruby-container">
				<div class="feat-inner">
					<div class="row">
						<?php while ($data_query->have_posts()) : ?>
						<?php $data_query->the_post(); ?>
						<?php if (1 == $counter) : ?>
						<div class="is-left-col col-sm-7 col-xs-12">
							<?php get_template_part( 'templates/module/layout', 'classic_lite' ); ?>
						</div>
						<!--#is left col -->
						<div class="is-right-col col-sm-5 col-xs-12">
							<?php else: ?>
								<div class="is-right-col-el col-xs-6">
									<?php get_template_part( 'templates/module/layout', 'grid_small_s_lite' ); ?>
								</div>
								<?php
								if ( $counter_right % 2 == 0 ) {
									look_ruby_template_part::render_divider();
								};
								$counter_right ++;
								?>
							<?php
							endif;
							?>
							<?php $counter ++; ?>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>

			<?php

			$str .= ob_get_clean();
			wp_reset_postdata();
		} else {
			$str .= look_ruby_block::no_content();
		}

		return $str;
	}

}