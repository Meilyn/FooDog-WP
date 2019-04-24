<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * Class look_ruby_Walker
 * this file display front end mega menu
 */
class look_ruby_walker extends Walker_Nav_Menu {

	public function start_el( &$output, $object, $depth = 0, $args = array(), $id = 0 ) {

		$look_ruby_enable_category_megamenu  = $object->rubymegamenu_category;
		$look_ruby_enable_column_megamenu    = $object->rubymegamenu_column;
		$look_ruby_enable_column_megamenu_bg = $object->rubymegamenu_column_bg;
		$look_ruby_current_classes           = $object->classes;

		$look_ruby_has_children                 = '';
		$str_category_meta                      = '';
		$look_ruby_mega_query                   = array();
		$look_ruby_mega_query['posts_per_page'] = 4;
		$look_ruby_mega_query['no_found_rows']  = true;

		//check current menu
		if ( is_array( $look_ruby_current_classes ) ) {
			if ( in_array( 'menu-item-has-children', $look_ruby_current_classes ) ) {
				$look_ruby_has_children = 'has-sub-menu';
			}
		}

		//add class
		if ( ( 1 == $look_ruby_enable_category_megamenu ) && ( 0 == $object->menu_item_parent ) ) {
			$object->classes[] = 'is-cat-mega-menu is-mega-menu';
			if ( 'has-sub-menu' == $look_ruby_has_children ) {
				$object->classes[] = 'has-sub-menu';
			}
		}

		if ( ( 1 == $look_ruby_enable_column_megamenu ) && ( 0 == $object->menu_item_parent ) ) {
			$object->classes[] = 'is-col-mega-menu is-mega-menu';
		}

		//render
		parent::start_el( $output, $object, $depth, $args );

		if ( ( 'category' == $object->object ) && ( 1 == $look_ruby_enable_category_megamenu ) && ( 0 == $object->menu_item_parent ) ) {

			//query data
			$look_ruby_mega_query ['category_id'] = $object->object_id;
			$data_query                           = look_ruby_query::get_custom_query( $look_ruby_mega_query );

			$look_ruby_text_style = look_ruby_core::get_option( 'mega_menu_cat_text_style' );

			$look_ruby_el_classes   = array();
			$look_ruby_el_classes[] = 'mega-category-menu mega-menu-wrap sub-menu-wrap is-sub-menu';
			if ( ! empty( $look_ruby_text_style ) ) {
				$look_ruby_el_classes[] = esc_attr( $look_ruby_text_style );
			}

			$look_ruby_el_classes = implode( ' ', $look_ruby_el_classes );

			//render
			$output .= '<div class="' . esc_attr( $look_ruby_el_classes ) . '">';
			if ( $data_query->have_posts() ) {
				while ( $data_query->have_posts() ) {
					$data_query->the_post();
					$str_category_meta .= '<div class="col-xs-3 mega-category-el">';

					//render
					ob_start();
					get_template_part( 'templates/module/layout', 'grid_small_s_lite' );
					$str_category_meta .= ob_get_clean();

					$str_category_meta .= '</div><!--#mega el-->';
				}
			}

			//reset loop
			wp_reset_postdata();

			$output .= '<div class="mega-category-wrap row">';
			$output .= $str_category_meta;
			$output .= '</div><!--#mega category posts-->';
		}

		if ( ( 'custom' == $object->object ) && ( 1 == $look_ruby_enable_column_megamenu ) ) {
			if ( empty( $look_ruby_enable_column_megamenu_bg ) ) {
				$output .= '<div class="mega-col-menu mega-menu-wrap is-sub-menu">';
			} else {
				$output .= '<div class="mega-col-menu mega-menu-wrap is-mega-bg is-sub-menu" style="background-image: url(' . esc_url( $look_ruby_enable_column_megamenu_bg ) . ')">';
			}
		}

		if ( empty( $look_ruby_has_children ) && ( ( 1 == $look_ruby_enable_category_megamenu ) || ( 1 == $look_ruby_enable_column_megamenu ) ) ) {
			$output .= '</div><!--#mega menu -->';
		}
	}


	public function end_el( &$output, $object, $depth = 0, $args = array() ) {

		$look_ruby_enable_category_megamenu = $object->rubymegamenu_category;
		$look_ruby_enable_column_megamenu   = $object->rubymegamenu_column;
		$look_ruby_current_classes          = $object->classes;

		if ( is_array( $look_ruby_current_classes ) ) {
			if ( in_array( 'menu-item-has-children', $look_ruby_current_classes ) ) {
				$look_ruby_has_children = 'has-sub-menu';
			}
		}

		if ( ! empty( $look_ruby_has_children ) && ( ( 1 == $look_ruby_enable_category_megamenu ) || ( 1 == $look_ruby_enable_column_megamenu ) ) ) {
			$output .= '</div><!--#mega menu -->';
		}

		$output .= '</li>';
	}


	//start of the sub menu wrap
	function start_lvl( &$output, $depth = 0, $args = array() ) {

		if ( $depth > 2 ) {
			return;
		}
		if ( $depth == 1 ) {
			$output .= '<ul class="sub-sub-menu-wrap is-sub-menu">';
		}
		if ( $depth == 0 ) {
			$output .= '<div class="sub-menu-wrap is-sub-menu"><ul class="sub-menu-inner">';
		}
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {

		if ( $depth > 2 ) {
			return;
		}
		if ( $depth == 0 ) {
			$output .= '</ul></div><!--#sub menu wrap -->';
		}
		if ( $depth == 1 ) {
			$output .= '</ul><!--#sub menu-->';
		}
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * add category class into menu
 */
if ( ! function_exists( 'look_ruby_category_nav_class' ) ) {
	function look_ruby_category_nav_class( $classes, $item ) {
		if ( 'category' == $item->object ) {
			$classes[] = 'is-category-' . $item->object_id;
		}

		return $classes;
	}
}
add_filter( 'nav_menu_css_class', 'look_ruby_category_nav_class', 10, 2 );


/**-------------------------------------------------------------------------------------------------------------------------
 * fallback navigation
 */
if ( ! function_exists( 'look_ruby_navigation_fallback' ) ) {
	function look_ruby_navigation_fallback() {
		$str = '';
		$str .= '<div class="no-menu is-error">';
		$str .= '<p>' . esc_attr__( 'Please assign a menu to the primary menu location under ', 'look' ) . '<a href="' . get_admin_url( get_current_blog_id(), 'nav-menus.php' ) . '">' . esc_attr__( 'menu', 'look' ) . '</a>' . '</p>';
		$str .= '</div>';

		echo $str;
	}
}
