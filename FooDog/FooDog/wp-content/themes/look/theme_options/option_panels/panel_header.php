<?php
if ( ! function_exists( 'look_ruby_theme_options_header' ) ) {
	function look_ruby_theme_options_header() {
		return array(
			'id'     => 'look_ruby_theme_ops_section_header',
			'title'  => esc_html__( 'Header Options', 'look' ),
			'desc'   => esc_html__( 'Select options for site header', 'look' ),
			'icon'   => 'el el-th',
			'fields' => array(
				//header layout
				array(
					'id'     => 'section_start_header_layout_manager',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Header Options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'header_layout_manager',
					'type'     => 'sorter',
					'title'    => esc_html__( 'header layout manager', 'look' ),
					'subtitle' => esc_html__( 'Organize how you want the header to appear on your site', 'look' ),
					'options'  => array(
						'enabled'  => array(
							'logo_area' => esc_html__( 'logo area', 'look' ),
							'main_nav'  => esc_html__( 'navigation', 'look' ),
						),
						'disabled' => array(),
					),
				),
				array(
					'id'     => 'look_ruby_theme_ops_section_header_layout_manager',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//top bar
				array(
					'id'     => 'section_start_header_top',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'top bar options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'header_top_bar',
					'title'    => esc_html__( 'Top bar', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable top bar', 'look' ),
					'type'     => 'switch',
					'default'  => 1
				),
				array(
					'id'       => 'header_top_bar_search',
					'type'     => 'switch',
					'title'    => esc_html__( 'Top bar search', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable search field in header top navigation bar', 'look' ),
					'default'  => 0
				),
				array(
					'id'     => 'section_end_header_top',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//Logo area
				array(
					'id'     => 'section_start_header_logo_area',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Logo Area Options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'logo',
					'type'     => 'media',
					'title'    => esc_html__( 'Header logo', 'look' ),
					'subtitle' => esc_html__( 'Upload site logo, recommended size is (335*100)px, allowed extensions are .jpg, .png and .gif', 'look' )
				),
				array(
					'id'       => 'logo_retina',
					'type'     => 'media',
					'title'    => esc_html__( 'Header logo Retina', 'look' ),
					'subtitle' => esc_html__( 'Upload site retina logo, (x2 size of your logo), allowed extensions are .jpg, .png and .gif', 'look' )
				),
				array(
					'id'       => 'logo_mobile',
					'type'     => 'media',
					'title'    => esc_html__( 'Header mobile logo', 'look' ),
					'subtitle' => esc_html__( 'Upload site mobile logo, allowed extensions are .jpg, .png and .gif', 'look' )
				),
				array(
					'id'       => 'logo_retina_mobile',
					'type'     => 'media',
					'title'    => esc_html__( 'Header mobile logo Retina', 'look' ),
					'subtitle' => esc_html__( 'Upload site retina mobile logo, (x2 size of your logo), allowed extensions are .jpg, .png and .gif', 'look' )
				),
				array(
					'id'       => 'logo_padding',
					'title'    => esc_html__( 'Top & Bottom Logo Padding', 'look' ),
					'subtitle' => esc_html__( 'Select padding (px) top and bottom for logo, Use this option if you want control height of logo area.', 'look' ),
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'default'  => ''
				),
				array(
					'id'          => 'header_background',
					'type'        => 'background',
					'transparent' => false,
					'title'       => esc_html__( 'Logo Area Background', 'look' ),
					'subtitle'    => esc_html__( 'logo area background with image, color, etc', 'look' ),
					'default'     => array(
						'background-color'      => '#fff',
						'background-size'       => 'inherit',
						'background-attachment' => 'fixed',
						'background-position'   => 'center center',
						'background-repeat'     => 'repeat'
					),
					'output'      => array( '.header-banner-wrap' ),
				),
				array(
					'id'       => 'logo_area_social_bar',
					'type'     => 'switch',
					'title'    => esc_html__( 'Header Social Bar', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable social icons in the logo area section.', 'look' ),
					'default'  => 1
				),
				array(
					'id'       => 'logo_area_search_icon',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show Search Icon', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable search icon in logo area', 'look' ),
					'default'  => 1
				),
				array(
					'id'       => 'off_canvas_button',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show Off Canvas Button', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable MENU (Off canvas) button at logo area.', 'look' ),
					'default'  => 1
				),
				array(
					'id'     => 'section_end_header_logo_area',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//main navigation
				array(
					'id'     => 'section_start_off_canvas_section',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'off canvas options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'off_canvas_style',
					'type'     => 'select',
					'title'    => esc_html__( 'off canvas style', 'look' ),
					'subtitle' => esc_html__( 'select style for off canvas section', 'look' ),
					'options'  => array(
						'light' => esc_html__( 'Light Style', 'look' ),
						'dark'  => esc_html__( 'Dark Style', 'look' )
					),
					'default'  => 'light'
				),
				array(
					'id'       => 'off_canvas_social_bar',
					'type'     => 'switch',
					'title'    => esc_html__( 'off canvas social bar', 'look' ),
					'subtitle' => esc_html__( 'enable or disable social bar on off canvas section', 'look' ),
					'default'  => 1
				),
				array(
					'id'       => 'off_canvas_widget_section',
					'type'     => 'switch',
					'title'    => esc_html__( 'off canvas widget section', 'look' ),
					'subtitle' => esc_html__( 'enable or disable widget section on off canvas section', 'look' ),
					'default'  => 1
				),
				array(
					'id'     => 'section_end_off_canvas_section',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//Header ads
				array(
					'id'     => 'section_start_header_ad',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'header advertising Options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'header_ad',
					'type'     => 'switch',
					'title'    => esc_html__( 'Google Ads/Custom Ads', 'look' ),
					'subtitle' => esc_html__( 'Select type of ads at top header. This option only available in Top Header', 'look' ),
					'default'  => 1,
					'on'       => esc_html__( 'Google Ads', 'look' ),
					'off'      => esc_html__( 'Custom Ads', 'look' ),
				),
				array(
					'id'       => 'header_google_ads',
					'type'     => 'textarea',
					'validate' => 'js',
					'required' => array( 'header_ad', '=', '1' ),
					'title'    => esc_html__( 'Google Ads Code', 'look' ),
					'subtitle' => esc_html__( 'Paste in your entire Google ads Code here, The Theme support Ads Responsive', 'look' ),
				),
				array(
					'id'       => 'header_image_ads',
					'type'     => 'media',
					'required' => array( 'header_ad', '=', '0' ),
					'title'    => esc_html__( 'Ads Image ', 'look' ),
					'subtitle' => esc_html__( 'Enter the image URL', 'look' ),
				),
				array(
					'id'       => 'header_url_ads',
					'type'     => 'text',
					'required' => array( 'header_ad', '=', '0' ),
					'title'    => esc_html__( 'Ads Url ', 'look' ),
					'subtitle' => esc_html__( 'Enter the custom Ads Url', 'look' ),
					'validate' => 'url',
					'default'  => '',
				),
				array(
					'id'     => 'section_end_header_ad',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			)
		);
	}
}