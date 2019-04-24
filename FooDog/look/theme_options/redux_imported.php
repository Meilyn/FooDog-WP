<?php
/**-------------------------------------------------------------------------------------------------------------------------
 * @param $demo_active_import
 * setup menu & sidebar
 */
if ( ! function_exists( 'look_ruby_imported_demo' ) ) {
	function look_ruby_imported_demo( $demo_active_import ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );


		$menu_array = array(
			'fashion',
			'craft',
			'beauty'
		);

		if ( isset( $demo_active_import[ $current_key ]['directory'] ) && ! empty( $demo_active_import[ $current_key ]['directory'] ) && in_array( $demo_active_import[ $current_key ]['directory'], $menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'look_ruby_main_navigation'       => $main_menu->term_id,
						'look_ruby_off_canvas_navigation' => $main_menu->term_id,
					)
				);
			}
		}

		/************************************************************************
		 * Set HomePage
		 *************************************************************************/

		$home_pages = array(
			'fashion' => 'Home Page',
			'craft'   => 'Home Page Craft',
			'beauty'  => 'Home Page Beauty'
		);

		if ( isset( $demo_active_import[ $current_key ]['directory'] ) && ! empty( $demo_active_import[ $current_key ]['directory'] ) && array_key_exists( $demo_active_import[ $current_key ]['directory'], $home_pages ) ) {

			if ( ! empty( $home_pages[ $demo_active_import[ $current_key ]['directory'] ] ) ) {
				$page = get_page_by_title( $home_pages[ $demo_active_import[ $current_key ]['directory'] ] );
				if ( ! empty( $page->ID ) ) {
					//setup page
					update_option( 'page_on_front', $page->ID );
					update_option( 'show_on_front', 'page' );

					//setup blog
					$blog = get_page_by_title( 'Blog' );
					if ( ! empty( $blog->ID ) ) {
						update_option( 'page_for_posts', $blog->ID );
					}

				}
			} else {
				update_option( 'page_on_front', 0 );
				update_option( 'show_on_front', 'posts' );
			}
		}

	}

	//setup menu
	add_action( 'wbc_importer_after_content_import', 'look_ruby_imported_demo', 10, 2 );
}


if ( ! function_exists( 'look_ruby_remove_default_widget' ) ) {
	function look_ruby_remove_default_widget() {

		//clear widgets
		$sidebars_widgets['look_ruby_sidebar_default']          = array();
		$sidebars_widgets['look_ruby_sidebar_multi_sb1']        = array();
		$sidebars_widgets['look_ruby_sidebar_multi_sb2']        = array();
		$sidebars_widgets['look_ruby_sidebar_multi_single']        = array();
		$sidebars_widgets['look_ruby_sidebar_off_canvas']       = array();
		$sidebars_widgets['look_ruby_blog_column_1']            = array();
		$sidebars_widgets['look_ruby_blog_column_2']            = array();
		$sidebars_widgets['look_ruby_blog_column_3']            = array();
		$sidebars_widgets['look_ruby_sidebar_footer_fullwidth'] = array();
		$sidebars_widgets['look_ruby_sidebar_footer_1']         = array();
		$sidebars_widgets['look_ruby_sidebar_footer_2']         = array();
		$sidebars_widgets['look_ruby_sidebar_footer_3']         = array();

		update_option( 'sidebars_widgets', $sidebars_widgets );

		//register home sidebar
		register_sidebar(
			array(
				'name'          => 'sb1',
				'id'            => 'look_ruby_sidebar_multi_sb1',
				'before_widget' => '<aside class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget-title block-title"><h3>',
				'after_title'   => '</h3></div>'
			)
		);
		register_sidebar(
			array(
				'name'          => 'sb2',
				'id'            => 'look_ruby_sidebar_multi_sb2',
				'before_widget' => '<aside class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget-title block-title"><h3>',
				'after_title'   => '</h3></div>'
			)
		);
		register_sidebar(
			array(
				'name'          => 'single',
				'id'            => 'look_ruby_sidebar_multi_single',
				'before_widget' => '<aside class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget-title block-title"><h3>',
				'after_title'   => '</h3></div>'
			)
		);

	}

	//remove widget
	add_action( 'wbc_importer_before_widget_import', 'look_ruby_remove_default_widget', 10, 2 );
}
