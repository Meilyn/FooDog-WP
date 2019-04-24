<?php
if ( ! function_exists( 'look_ruby_theme_options_block_styling' ) ) {
	function look_ruby_theme_options_block_styling() {
		//styling config
		return array(
			'id'     => 'look_ruby_theme_ops_section_styling',
			'title'  => esc_html__( 'Block Styling', 'look' ),
			'desc'   => esc_html__( 'Select layout options for all blocks', 'look' ),
			'icon'   => 'el el-magic',
			'fields' => array(

				//block styling
				array(
					'id'     => 'section_start_block_styling',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'block styling options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'post_category_info',
					'title'    => esc_html__( 'Category info', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable category information bar', 'look' ),
					'type'     => 'switch',
					'default'  => 1
				),
				array(
					'id'       => 'post_meta_info_manager',
					'type'     => 'sorter',
					'title'    => esc_html__( 'Entry meta info', 'look' ),
					'subtitle' => esc_html__( 'Organize how you want the main entry meta tags to appear on block', 'look' ),
					'options'  => array(
						'enabled'  => array(
							'date' => esc_html__( 'Date', 'look' ),
						),
						'disabled' => array(
							'cat'     => esc_html__( 'Category', 'look' ),
							'author'  => esc_html__( 'Author', 'look' ),
							'tag'     => esc_html__( 'Tags', 'look' ),
							'view'    => esc_html__( 'View', 'look' ),
							'comment' => esc_html__( 'Comment', 'look' )
						)
					),
				),
				array(
					'id'       => 'post_format_icon',
					'title'    => esc_html__( 'Post format icon', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable post format icon', 'look' ),
					'type'     => 'switch',
					'default'  => 1
				),
				array(
					'id'       => 'thumb_holder',
					'title'    => esc_html__( 'Thumb Holder', 'look' ),
					'subtitle' => esc_html__( 'Hold thumbnail height when loading the site.', 'look' ),
					'type'     => 'switch',
					'default'  => 1
				),
				array(
					'id'       => 'human_time',
					'title'    => esc_html__( 'human time', 'look' ),
					'subtitle' => esc_html__( 'enable or disable human time diff for date post format.', 'look' ),
					'type'     => 'switch',
					'default'  => 1
				),
				array(
					'id'     => 'section_end_block_styling',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//share icon
				array(
					'id'     => 'section_start_share_icon',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'share icon options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'post_share_bar',
					'title'    => esc_html__( 'Share To Social Bar', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share bar', 'look' ),
					'type'     => 'switch',
					'default'  => 1
				),
				array(
					'id'       => 'post_share_bar_total',
					'title'    => esc_html__( 'total sharing counter', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable number of total sharing to social', 'look' ),
					'required' => array( 'post_share_bar', '=', '1' ),
					'type'     => 'switch',
					'default'  => 0
				),
				array(
					'id'       => 'post_share_bar_list',
					'title'    => esc_html__( 'Enable on list layout', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share bar on post list layout', 'look' ),
					'required' => array( 'post_share_bar', '=', '1' ),
					'type'     => 'switch',
					'default'  => 1
				),
				array(
					'id'       => 'post_share_bar_grid',
					'title'    => esc_html__( 'Enable on grid layout', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share bar on post grid layout', 'look' ),
					'required' => array( 'post_share_bar', '=', '1' ),
					'type'     => 'switch',
					'default'  => 0
				),
				array(
					'id'       => 'post_share_bar_classic',
					'title'    => esc_html__( 'Enable on classic layout', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share bar on post classic layout', 'look' ),
					'required' => array( 'post_share_bar', '=', '1' ),
					'type'     => 'switch',
					'default'  => 1
				),
				array(
					'id'     => 'section_end_share_icon',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//review icon
				array(
					'id'     => 'section_start_review_icon',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'review icon options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'post_review_icon',
					'title'    => esc_html__( 'review icon', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable review icon on blog layout', 'look' ),
					'type'     => 'switch',
					'default'  => 1
				),
				array(
					'id'          => 'post_review_icon_color',
					'title'       => esc_html__( 'review icon color', 'look' ),
					'subtitle'    => esc_html__( 'select color for review icon', 'look' ),
					'type'        => 'color',
					'validate'    => 'color',
					'transparent' => false,
					'default'     => '#111'
				),
				array(
					'id'     => 'section_end_review_icon',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//block excerpt section
				array(
					'id'     => 'section_start_block_excerpt_length',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Excerpt Length options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'grid_excerpt_length',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'grid excerpt length', 'look' ),
					'subtitle' => esc_html__( 'select length of excerpt for all grid blocks, leave blank or set is 0 if you want disable excerpt', 'look' ),
					'default'  => 20
				),
				array(
					'id'       => 'list_excerpt_length',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'list excerpt length', 'look' ),
					'subtitle' => esc_html__( 'select length of excerpt for the list layout, leave blank or set is 0 if you want disable excerpt', 'look' ),
					'default'  => 20
				),
				//classic excerpt
				array(
					'id'       => 'classic_summary_type',
					'title'    => esc_html__( 'Classic Summary Types', 'look' ),
					'subtitle' => esc_html__( 'Select summary type for the classic layout. If you use read more tag, you need to add it into post content', 'look' ),
					'type'     => 'switch',
					'on'       => 'Use Read More Tag',
					'off'      => 'Use Excerpt',
					'default'  => 0,
				),
				array(
					'id'       => 'classic_excerpt_length',
					'type'     => 'text',
					'title'    => esc_html__( 'Classic excerpt length', 'look' ),
					'subtitle' => esc_html__( 'Select length of excerpt for all classic blocks, leave blank or set is 0 if you want disable excerpt', 'look' ),
					'required' => array( 'classic_summary_type', '=', 0 ),
					'class'    => 'small-text',
					'validate' => 'numeric',
					'default'  => 100
				),
				array(
					'id'     => 'section_end_block_excerpt_length',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			)
		);
	}
}