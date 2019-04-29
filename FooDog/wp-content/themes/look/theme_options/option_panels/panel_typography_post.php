<?php
if ( ! function_exists( 'look_ruby_theme_options_typography_post' ) ) {
	function look_ruby_theme_options_typography_post() {
		return array(
			'id'         => 'look_ruby_theme_options_typography_post',
			'title'      => esc_html__( 'Post Typography', 'look' ),
			'icon'       => 'el el-font',
			'subsection' => true,
			'desc'       => html_entity_decode( esc_html__( 'Selecting a font will show a basic preview. Go to <a href="http://www.google.com/webfonts" target="_blank">google fonts directory</a> for more details. It is highly recommended that you choose fonts that have similar heights to the default fonts.<br/><br/>To restore to default font settings, click: <strong>Reset Section</strong>', 'look' ) ),
			'fields'     => array(
				//config
				array(
					'id'     => 'section_start_post_title_font',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'post title font options', 'look' ),
					'indent' => true
				),
				array(
					'id'             => 'post_title_font',
					'type'           => 'typography',
					'title'          => esc_html__( 'Post title font', 'look' ),
					'subtitle'       => esc_html__( 'select font for post title. This option will affect to all post title of the website', 'look' ),
					'google'         => true,
					'font-backup'    => true,
					'text-align'     => false,
					'color'          => true,
					'text-transform' => true,
					'letter-spacing' => true,
					'font-size'      => false,
					'line-height'    => false,
					'all_styles'     => true,
					'units'          => 'px',
					'default'        => array(
						'font-family'    => 'Playfair Display',
						'text-transform' => 'uppercase',
						'font-weight'    => '700',
						'color'          => '#111'
					),
					'output'         => array(
						'.post-title',
						'.product_title',
						'.widget_recent_entries li'
					)
				),
				array(
					'id'     => 'section_end_post_title_font',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//big title font
				array(
					'id'     => 'section_start_post_title_font_big',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'big title font options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'post_title_font_size_big',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Post Title - Big Font Size', 'look' ),
					'subtitle' => esc_html__( 'Select font size for big post title in px, this setting will affect title of the classic layouts', 'look' ),
					'default'  => '26'
				),
				array(
					'id'       => 'post_title_font_lineheight_big',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Post Title - Big Font LineHeight', 'look' ),
					'subtitle' => esc_html__( 'Select line-height for big title (in px), please blank or set 0 if you want set default value', 'look' ),
					'default'  => ''
				),
				array(
					'id'     => 'section_end_post_title_font_big',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//medium font
				array(
					'id'     => 'section_start_post_title_font_medium',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'medium title font options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'post_title_font_size_medium',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Post Title - Medium Font Size', 'look' ),
					'subtitle' => esc_html__( 'Select font size for medium post title in px, this setting will affect title of the list & grid layouts', 'look' ),
					'default'  => '20'
				),
				array(
					'id'       => 'post_title_font_lineheight_medium',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Post Title - Medium Font LineHeight', 'look' ),
					'subtitle' => esc_html__( 'Select line-height for medium title (in px), please blank or set 0 if you want set default value', 'look' ),
					'default'  => ''
				),
				array(
					'id'     => 'section_end_post_title_font_medium',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//small font
				array(
					'id'     => 'section_start_post_title_font_small',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'small title font options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'post_title_font_size_small',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Post Title - Small Font Size', 'look' ),
					'subtitle' => esc_html__( 'Select font size for small post title in px, this setting will affect title of small layouts', 'look' ),
					'default'  => '15'
				),
				array(
					'id'       => 'post_title_font_lineheight_small',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Post Title - Small Font LineHeight', 'look' ),
					'subtitle' => esc_html__( 'Select line-height for small title (in px), please blank or set 0 if you want set default value', 'look' ),
					'default'  => ''
				),
				array(
					'id'     => 'section_end_post_title_font_small',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//single font
				array(
					'id'     => 'section_start_post_title_font_single',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'single title font options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'post_title_font_size_single',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Single Title - Font Size', 'look' ),
					'subtitle' => esc_html__( 'Single font size for big post title in px, this setting will affect to single post and page title', 'look' ),
					'default'  => '32'
				),
				array(
					'id'       => 'post_title_font_lineheight_single',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Single Title - Font LineHeight', 'look' ),
					'subtitle' => esc_html__( 'Select line-height for single title (in px), please blank or set 0 if you want set default value', 'look' ),
					'default'  => ''
				),
				array(
					'id'     => 'section_end_post_title_font_single',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//post meta fonts
				array(
					'id'     => 'section_start_post_meta_font',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'post entry meta font options', 'look' ),
					'indent' => true
				),
				array(
					'id'             => 'post_cat_info_font',
					'type'           => 'typography',
					'title'          => esc_html__( 'Category info font', 'look' ),
					'subtitle'       => esc_html__( 'Select font for category info, this options will affect to category info at the top of blog layouts.', 'look' ),
					'google'         => true,
					'font-backup'    => true,
					'text-align'     => false,
					'color'          => true,
					'text-transform' => true,
					'letter-spacing' => true,
					'font-weight'    => true,
					'all_styles'     => true,
					'line-height'    => false,
					'units'          => 'px',
					'default'        => array(
						'font-size'      => '11px',
						'google'         => true,
						'font-weight'    => '600',
						'color'          => '#111',
						'font-family'    => 'Raleway',
						'text-transform' => 'uppercase'
					),
					'output'         => array(
						'.post-cat-info',
					)
				),
				array(
					'id'             => 'post_meta_info_font',
					'type'           => 'typography',
					'title'          => esc_html__( 'entry meta font', 'look' ),
					'subtitle'       => esc_html__( 'Select font for post meta info. This option will affect to category info, date, author...', 'look' ),
					'google'         => true,
					'font-backup'    => true,
					'text-align'     => false,
					'color'          => true,
					'text-transform' => true,
					'letter-spacing' => true,
					'font-weight'    => true,
					'all_styles'     => true,
					'line-height'    => false,
					'units'          => 'px',
					'default'        => array(
						'font-size'      => '11px',
						'google'         => true,
						'font-weight'    => '400',
						'color'          => '#aaaaaa',
						'font-family'    => 'Raleway',
						'text-transform' => 'uppercase'
					),
					'output'         => array(
						'.post-meta-info',
						'.share-bar-total',
						'.block-view-more',
						'.single-tag-wrap',
						'.author-job',
						'.nav-arrow',
						'.comment-metadata time',
						'.comment-list .reply',
						'.edit-link',
					)
				),
				array(
					'id'     => 'section_end_post_meta_font',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			)
		);
	}
}

