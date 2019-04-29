<?php
//Social
if ( ! function_exists( 'look_ruby_theme_options_social' ) ) {
	function look_ruby_theme_options_social() {
		return array(
			'title' => esc_html__( 'Shares & Social', 'look' ),
			'id'    => 'look_ruby_theme_ops_section_social_profile',
			'icon'  => 'el el-twitter',
			'desc'  => '',
		);
	}
}


//Share bar config
if ( ! function_exists( 'look_ruby_theme_options_share_post' ) ) {
	function look_ruby_theme_options_share_post() {
		return array(
			'title'      => esc_html__( 'Shares To Social', 'look' ),
			'id'         => 'look_ruby_theme_ops_section_share_social',
			'icon'       => 'el el-share',
			'subsection' => true,
			'desc'       => esc_html__( 'These are options for setting up the sites social and share post to social. To add author social, go to the Users -> Your Profile', 'look' ),
			'fields'     => array(
				//Share bar
				array(
					'id'     => 'section_start_share_post_options',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Share Post Options', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'share_to_facebook',
					'type'     => 'switch',
					'title'    => esc_html__( 'Share On Facebook', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share on Facebook, This default of option is enable', 'look' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'share_to_twitter',
					'type'     => 'switch',
					'title'    => esc_html__( 'Share On Twitter', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share on Twitter, This default of option is enable', 'look' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'share_to_google_plus',
					'type'     => 'switch',
					'title'    => esc_html__( 'Share On Google Plus', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share on Google +, This default of option is enable', 'look' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'share_to_pinterest',
					'type'     => 'switch',
					'title'    => esc_html__( 'Share On Pinterest', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share on Pinsterest, This default of option is enable', 'look' ),
					'switch'   => true,
					'default'  => 1
				),
				array(
					'id'       => 'share_to_linkedin',
					'type'     => 'switch',
					'title'    => esc_html__( 'Share On LinkedIn', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share on LinkedIn, This default of option is disable', 'look' ),
					'switch'   => true,
					'default'  => 0
				),
				array(
					'id'       => 'share_to_tumblr',
					'type'     => 'switch',
					'title'    => esc_html__( 'Share On Tumblr', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share on Tumblr, This default of option is disable', 'look' ),
					'switch'   => true,
					'default'  => 0
				),
				array(
					'id'       => 'share_to_vk',
					'type'     => 'switch',
					'title'    => esc_html__( 'Share On Vkontakte', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share on Vkontakte, This default of option is disable', 'look' ),
					'switch'   => true,
					'default'  => 0
				),
				array(
					'id'       => 'share_to_reddit',
					'type'     => 'switch',
					'title'    => esc_html__( 'Share On Reddit', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share on Reddit, This default of option is disable', 'look' ),
					'switch'   => true,
					'default'  => 0
				),
				array(
					'id'       => 'share_to_email',
					'type'     => 'switch',
					'title'    => esc_html__( 'Share On Email', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable share on Email, This default of option is disable', 'look' ),
					'switch'   => true,
					'default'  => 0
				),
				array(
					'id'     => 'section_end_share_post_options',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			)
		);
	}
}

//Site social
if ( ! function_exists( 'look_ruby_theme_options_site_social' ) ) {
	function look_ruby_theme_options_site_social() {
		return array(
			'id'         => 'look_ruby_theme_ops_section_site_social',
			'title'      => esc_html__( 'Site Social Profile', 'look' ),
			'subsection' => true,
			'icon'       => 'el el-user',
			'desc'       => esc_html__( 'These are options for setting up the sites social and share post to social. To add author social, go to the Users -> Your Profile', 'look' ),
			'fields'     => array(
				//Social Profile
				array(
					'id'     => 'section_start_social_profile',
					'type'   => 'section',
					'class'  => 'ruby-section-start',
					'title'  => esc_html__( 'Site Social Profile', 'look' ),
					'indent' => true
				),
				array(
					'id'       => 'site_social',
					'type'     => 'switch',
					'title'    => esc_html__( 'Social', 'look' ),
					'subtitle' => esc_html__( 'Enable or disable sites social', 'look' ),
					'default'  => 1,
				),
				array(
					'id'       => 'look_ruby_facebook',
					'type'     => 'text',
					'required' => array( 'site_social', '=', '1' ),
					'validate' => 'url',
					'title'    => esc_html__( 'Facebook URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_twitter',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Twitter URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_google_plus',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Google+ URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_pinterest',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Pinterest URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_bloglovin',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Bloglovin URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_instagram',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Instagram URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_youtube',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Youtube URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_vimeo',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Vimeo URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_linkedin',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'LinkedIn URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_tumblr',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Tumblr URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_vkontakte',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'VKontakte URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_snapchat',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Snapchat  URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_reddit',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Reddit  URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_flickr',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Flickr URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_skype',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Skype URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'       => 'look_ruby_rss',
					'type'     => 'text',
					'validate' => 'url',
					'required' => array( 'site_social', '=', '1' ),
					'title'    => esc_html__( 'Rss URL ', 'look' ),
					'subtitle' => esc_html__( 'The URL to your account page', 'look' )
				),
				array(
					'id'     => 'section_end_social_profile',
					'type'   => 'section',
					'class'  => 'ruby-section-end',
					'indent' => false
				),
			)
		);
	}
}