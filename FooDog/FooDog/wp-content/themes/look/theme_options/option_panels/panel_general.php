<?php
/**
 * this is general config
 */
if ( ! function_exists( 'look_ruby_theme_options_general' ) ) {
	function look_ruby_theme_options_general() {
		return array(
			'id'     => 'look_ruby_theme_ops_section_general',
			'title'  => esc_html__( 'General Options', 'look' ),
			'desc'   => esc_html__( 'Select options for general options', 'look' ),
			'icon'   => 'el el-icon-globe',
			'fields' => array(

				//Site width section config
				array(
					'id'     => 'section_start_site_width',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Site Width Options', 'look' ),
					'indent' => true,
				),
				array(
					'id'       => 'main_site_layout',
					'type'     => 'select',
					'title'    => esc_html__( 'Main Site Layout', 'look' ),
					'subtitle' => esc_html__( 'Select layout for your site', 'look' ),
					'options'  => array(
						'is-full-width' => esc_html__( 'Full Width', 'look' ),
						'is-boxed'      => esc_html__( 'Boxed', 'look' )
					),
					'default'  => 'is-full-width'
				),
				array(
					'id'          => 'site_background',
					'type'        => 'background',
					'transparent' => false,
					'title'       => esc_html__( 'Site Background', 'look' ),
					'subtitle'    => esc_html__( 'Site background with image, color, etc', 'look' ),
					'required'    => array( 'main_site_layout', '!=', 'is-full-width' ),
					'default'     => array(
						'background-color'      => '#fff',
						'background-size'       => 'cover',
						'background-attachment' => 'fixed',
						'background-position'   => 'left top',
						'background-repeat'     => 'no-repeat'
					),
					'output'      => array( 'body' ),
				),
				array(
					'id'       => 'site_background_link',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'main_site_layout', '!=', 'is-full-width' ),
					'title'    => esc_html__( 'BG Navigate URL', 'look' ),
					'subtitle' => esc_html__( 'Navigate to URL when click on site background ', 'look' ),
					'default'  => ''
				),
				array(
					'id'            => 'site_container_width',
					'type'          => 'slider',
					'title'         => esc_html__( 'Max width of Content', 'look' ),
					'subtitle'      => esc_html__( 'Controls the overall site width. In px, ex: 1080px. default value is 1200px', 'look' ),
					'default'       => 1200,
					'min'           => 960,
					'max'           => 1200,
					'step'          => 10,
					'display_value' => 'text',
				),
				array(
					'id'     => 'section_end_site_width',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
				//Smooth style section config
				array(
					'id'     => 'section_start_smooth_style',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Smooth Style Options', 'look' ),
					'indent' => true,
				),
				array(
					'id'       => 'site_smooth_scroll',
					'type'     => 'switch',
					'title'    => esc_html__( 'Smooth Scroll', 'look' ),
					'subtitle' => esc_html__( 'Smooth scrolling with the mouse wheel in all browsers', 'look' ),
					'switch'   => true,
					'default'  => 0
				),
				array(
					'id'       => 'site_smooth_display',
					'type'     => 'switch',
					'title'    => esc_html__( 'Smooth Display', 'look' ),
					'subtitle' => esc_html__( 'Add animation to display images when scrolling down a page', 'look' ),
					'switch'   => true,
					'default'  => 0
				),
				array(
					'id'       => 'site_smooth_display_style',
					'type'     => 'select',
					'title'    => esc_html__( 'Animation Style', 'look' ),
					'required' => array( 'site_smooth_display', '=', '1' ),
					'subtitle' => esc_html__( 'Select animation style for display images when scrolling down', 'look' ),
					'options'  => array(
						'ruby-fade'   => esc_html__( 'Fade In', 'look' ),
						'ruby-zoom'   => esc_html__( 'Zoom In', 'look' ),
						'ruby-bottom' => esc_html__( 'Fade Form Bottom', 'look' )
					),
					'default'  => 'ruby-fade'
				),
				array(
					'id'     => 'section_end_smooth_style',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false,
				),
				//Miscellaneous section config
				array(
					'id'     => 'section_start_miscellaneous',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Miscellaneous options', 'look' ),
					'indent' => true,
				),
				array(
					'id'       => 'apple_touch_ion',
					'type'     => 'media',
					'title'    => esc_html__( 'iOS Bookmarklet Icon', 'look' ),
					'subtitle' => esc_html__( 'Upload icon for the Apple touch (72 x 72px), allowed extensions are .jpg, .png, .gif', 'look' ),
					'desc'     => esc_html__( '72 x 72px', 'look' )
				),
				array(
					'id'       => 'metro_icon',
					'type'     => 'media',
					'title'    => esc_html__( 'Metro UI Bookmartlet Icon', 'look' ),
					'subtitle' => esc_html__( 'Upload icon for the Metro interface (144 x 144px), allowed extensions are .jpg, .png, .gif', 'look' ),
					'desc'     => esc_html__( '144 x 144px', 'look' )
				),
				array(
					'id'       => 'retina_support',
					'type'     => 'switch',
					'title'    => esc_html__( 'Retina Support', 'look' ),
					'subtitle' => esc_html__( 'Enable this option if you want to show higher quality images on high resolution screens. This option can increase media data', 'look' ),
					'desc'     => html_entity_decode(esc_html__( 'Please run <a href="https://wordpress.org/plugins/regenerate-thumbnails/">regenerate thumbnails</a> once if you enable or disable this option!', 'look' )),
					'default'  => 0,
				),
				array(
					'id'       => 'start_view',
					'type'     => 'text',
					'class'    => 'small-text',
					'validate' => 'numeric',
					'title'    => esc_html__( 'Post Views Forgery', 'look' ),
					'subtitle' => esc_html__( 'Random specify value to adding number of views for each post', 'look' ),
					'desc'     => esc_html__( 'Input your value ie: 1000 . The theme random select around(+/-500) that value to add to real number of article views', 'look' ),
					'default'  => 0
				),
				array(
					'id'       => 'social_tooltip',
					'type'     => 'switch',
					'title'    => esc_html__( 'Social Tooltip', 'look' ),
					'subtitle' => esc_html__( 'enable or disable social icon tooltip.', 'look' ),
					'default'  => 1,
				),
				array(
					'id'     => 'section_end_miscellaneous',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false,
				),
				//Meta description config
				array(
					'id'     => 'section_start_open_graph',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Open Graph Support Option', 'look' ),
					'indent' => true,
				),
				array(
					'id'       => 'open_graph',
					'type'     => 'switch',
					'title'    => esc_html__( 'Open Graph', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable open graph. disable it if you use open graph plugin for SEO', 'look' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'     => 'section_end_meta_open_graph',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false,
				),
			)
		);
	}
}
