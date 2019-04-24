<?php

//load taxonomy meta
require_once get_template_directory() . '/metaboxes/taxonomy-meta.php';
if ( ! function_exists( 'look_ruby_register_taxonomy_cat' ) ) {
	function look_ruby_register_taxonomy_cat() {

		//check
		if ( ! class_exists( 'RW_Taxonomy_Meta' ) ) {
			return;
		}

		$meta_sections = array();

		// First meta section
		$meta_sections[] = array(
			'title'      => esc_html__( 'LOOK CATEGORY OPTIONS', 'look' ),
			// section title
			'taxonomies' => array( 'category', 'post_tag' ),
			'id'         => 'look_ruby_cat_option',
			'fields'     => array(
				array(
					'name'    => esc_html__( 'Category Layout:', 'look' ),
					'id'      => 'look_ruby_cat_layout',
					'desc'    => esc_html__( 'Select the layout for this category.', 'look' ),
					'type'    => 'select',
					'options' => array(
						'default'              => esc_html__( 'Default Form Theme Options', 'look' ),
						'layout_list'          => esc_html__( 'List Layout', 'look' ),
						'layout_classic'       => esc_html__( 'Classic Layout', 'look' ),
						'layout_classic_lite'  => esc_html__( 'Classic Lite Layout', 'look' ),
						'layout_grid'          => esc_html__( 'Grid Layout', 'look' ),
						'layout_grid_small'    => esc_html__( 'Grid Small Layout', 'look' ),
						'layout_grid_small_s'  => esc_html__( 'Grid Small Square Layout', 'look' ),
						'layout_overlay_small' => esc_html__( 'Grid Overlay Layout', 'look' ),
					),
					'std'     => 'default',
				),
				//category color
				array(
					'name' => esc_html__( 'Category Color Picker:', 'look' ),
					'desc' => esc_html__( 'input color for this category', 'look' ),
					'id'   => 'look_ruby_cat_color_picker',
					'type' => 'color',
					'std'  => '#111111',
				),
				//category color
				array(
					'name' => esc_html__( 'Category Background Image URL:', 'look' ),
					'desc' => esc_html__( 'input background image URL for this category', 'look' ),
					'id'   => 'look_ruby_cat_bg',
					'type' => 'text',
					'std'  => '',
				),
			),
		);

		foreach ( $meta_sections as $meta_section ) {
			new RW_Taxonomy_Meta( $meta_section );
		}
	}

	//add action
	add_action( 'admin_init', 'look_ruby_register_taxonomy_cat' );

}
