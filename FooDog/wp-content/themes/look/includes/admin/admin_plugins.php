<?php
/**
 * this file handle default plugins for the theme
 */

//include the TGM_Plugin_Activation class
require_once get_template_directory() . '/includes/admin/class-tgm-plugin-activation.php';

if ( ! function_exists( 'look_ruby_theme_register_required_plugins' ) ) {
	function look_ruby_theme_register_required_plugins() {
		$plugins = array(
			array(
				'name'               => 'Redux Framework',
				'slug'               => 'redux-framework',
				'source'             => get_template_directory() . '/plugins/redux-framework.zip',
				'required'           => true,
				'version'            => '',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
				'is_callable'        => '',
			),
			array(
				'name'               => 'Meta Box',
				'slug'               => 'meta-box',
				'required'           => true,
				'version'            => '',
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'               => 'Look Ruby Core',
				'slug'               => 'look-ruby-core',
				'source'             => get_template_directory() . '/plugins/look-ruby-core.zip',
				'required'           => true,
				'version'            => '1.0',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
				'is_callable'        => '',
			),
			array(
				'name'     => 'oAuth Twitter Feed for Developers',
				'slug'     => 'oauth-twitter-feed-for-developers',
				'required' => true,
			),
			array(
				'name'               => 'Envato Market',
				'slug'               => 'wp-envato-market',
				'source'             => get_template_directory() . '/plugins/envato-market.zip',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
			),
			array(
				'name'               => 'Look Ruby Import Demo',
				'slug'               => 'look-ruby-import',
				'source'             => get_template_directory() . '/plugins/look-ruby-import.zip',
				'required'           => true,
				'version'            => '1.0',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
				'is_callable'        => '',
			)
		);


		$look_ruby_config = array(
			'id'           => 'look',
			'default_path' => '',
			'menu'         => 'look-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'look' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'look' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'look' ),
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'look' ),
				'notice_can_install_required'     => _n_noop( 'look the following plugin: %1$s.', 'look requires the following plugins: %1$s.', 'look' ),
				'notice_can_install_recommended'  => _n_noop( 'look recommends the following plugin: %1$s.', 'look recommends the following plugins: %1$s.', 'look' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'look' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'look' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'look' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'look' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with look: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with look: %1$s.', 'look' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'look' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'look' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'look' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'look' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'look' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'look' ),
				'nag_type'                        => 'updated'
			)
		);

		tgmpa( $plugins, $look_ruby_config );
	}

	add_action( 'tgmpa_register', 'look_ruby_theme_register_required_plugins' );

}

