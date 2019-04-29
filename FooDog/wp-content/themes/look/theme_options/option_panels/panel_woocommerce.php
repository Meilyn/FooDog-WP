<?php
if ( ! function_exists( 'look_ruby_theme_options_woocommerce' ) ) {
	function look_ruby_theme_options_woocommerce() {

		//woocommerce config
		return array(
			'id'     => 'look_ruby_theme_ops_section_woocommerce',
			'title'  => esc_html__( 'Woocommerce', 'look' ),
			'desc'   => html_entity_decode( esc_html__( 'Select options for Wocommerce pages.<br/><br/><strong>Note: </strong> Page options custom fields in page editor is not available in shop page. Please, Settings in here.', 'look' ) ),
			'icon'   => 'el el-shopping-cart',
			'fields' => array(

				//shop page config
				array(
					'id'     => 'section_start_woocommerce_shop_page',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Woocommerce Shop Options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'woocommerce_title_shop',
					'type'     => 'switch',
					'title'    => esc_html__( 'Shop Page Title', 'look' ),
					'subtitle' => esc_html__( 'enable or disable shop title', 'look' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'woocommerce_number_of_product',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Number of products', 'look' ),
					'subtitle' => esc_html__( 'Number of product to show per page', 'look' ),
					'switch'   => true,
					'default'  => ''
				),
				array(
					'id'       => 'woocommerce_sidebar_shop',
					'type'     => 'select',
					'title'    => esc_html__( 'Shop Sidebar', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar for Woocommerce pages. This option effect all Woocommerce pages, excepted product page.', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_name(),
					'default'  => 'look_ruby_sidebar_default',
				),
				array(
					'id'       => 'woocommerce_sidebar_position_shop',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Shop Sidebar Position', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar position for this page. This option will override default sidebar position setting.', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_position( false ),
					'default'  => 'none'
				),
				array(
					'id'     => 'section_end_woocommerce_shop_page',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//product page config
				array(
					'id'     => 'section_start_woocommerce_product_page',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Woocommerce product options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'woocommerce_sidebar_product',
					'type'     => 'select',
					'title'    => esc_html__( 'Product Sidebar', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar for author page', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_name(),
					'default'  => 'look_ruby_sidebar_default',
				),
				array(
					'id'       => 'woocommerce_sidebar_position_product',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Product Sidebar Position', 'look' ),
					'subtitle' => esc_html__( 'Select sidebar position for product page. This option will override default sidebar position setting.', 'look' ),
					'options'  => look_ruby_theme_config::sidebar_position(),
					'default'  => 'none'
				),
				array(
					'id'       => 'woocommerce_review_box',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show Review Box', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable the review box on the product pages, Default this option is enable', 'look' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'     => 'section_end_woocommerce_product_page',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),

			)
		);
	}
}