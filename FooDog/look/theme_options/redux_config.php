<?php
/**
 * ReduxFramework Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

//template directory
$look_ruby_template_directory = get_template_directory();

//load onclick to import
if ( class_exists( 'look_ruby_one_click_to_import' ) ) {
	add_action( 'redux/extensions/look_ruby_theme_options/before', array('look_ruby_one_click_to_import','look_ruby_register_extension_loader'), 0 );
}

require_once $look_ruby_template_directory . '/theme_options/redux_imported.php';


if ( ! class_exists( 'Redux' ) ) {
	return false;
}

/**-------------------------------------------------------------------------------------------------------------------------
 * remove demo link
 */
if ( ! function_exists( 'look_ruby_redux_remove_demo_link' ) ) {
	function look_ruby_redux_remove_demo_link() {
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_filter( 'plugin_row_meta', array(
				ReduxFrameworkPlugin::get_instance(),
				'plugin_metalinks'
			), null, 2 );
		}
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
		}
	}

	add_action( 'init', 'look_ruby_redux_remove_demo_link', 1 );
}

//including theme options style
require_once $look_ruby_template_directory . '/theme_options/redux_style.php';

//including theme options panels
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_general.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_header.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_navigation.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_sidebar.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_footer.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_blog.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_design.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_mic.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_social.php';


//typography
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_typography.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_typography_body.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_typography_post.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_typography_nav.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_typography_header.php';


require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_single.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_category.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_page.php';
require_once $look_ruby_template_directory . '/theme_options/option_panels/panel_woocommerce.php';


// This is theme option name where all the Theme data is stored.
$look_ruby_theme    = wp_get_theme();
$look_ruby_opt_name = 'look_ruby_theme_options';

$look_ruby_args = array(
	'opt_name'             => $look_ruby_opt_name,
	'display_name'         => $look_ruby_theme->get( 'Name' ),
	'display_version'      => $look_ruby_theme->get( 'Version' ),
	'menu_type'            => 'menu',
	'allow_sub_menu'       => true,
	'menu_title'           => esc_html__( 'Look Options', 'look' ),
	'page_title'           => esc_html__( 'Look Options', 'look' ),
	'google_api_key'       => '',
	'google_update_weekly' => true,
	'async_typography'     => true,
	'admin_bar'            => true,
	'admin_bar_icon'       => 'dashicons-admin-generic',
	'admin_bar_priority'   => 50,
	'global_variable'      => $look_ruby_opt_name,
	'dev_mode'             => false,
	'update_notice'        => false,
	'customizer'           => true,
	'page_priority'        => 54,
	'page_parent'          => 'themes.php',
	'page_permissions'     => 'manage_options',
	'menu_icon'            => '',
	'last_tab'             => '',
	'page_icon'            => 'icon-themes',
	'page_slug'            => '',
	'save_defaults'        => true,
	'default_show'         => false,
	'default_mark'         => '',
	'show_import_export'   => true,
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'use_cdn'              => true,
	'output'               => true,
	'output_tag'           => true,
	'disable_tracking'     => true,
	'database'             => '',
	'system_info'          => false,
	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'light',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '400',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '400',
				'event'    => 'click mouseleave',
			),
		),
	)
);


//Set arguments for framework
Redux::setArgs( $look_ruby_opt_name, $look_ruby_args );

// -> START THEME SETTINGS

// general
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_general() );

//block design
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_block_styling() );

//header
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_header() );
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_navigation() );

//sidebar
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_sidebar() );

//footer
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_footer() );


//home layout
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_blog() );

//single configs
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_single() );

//category configs
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_category() );

//Pages
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_page() );
Redux::setSection( $look_ruby_opt_name, look_ruby_default_page_config() );
Redux::setSection( $look_ruby_opt_name, look_ruby_author_page_config() );
Redux::setSection( $look_ruby_opt_name, look_ruby_search_page_config() );
Redux::setSection( $look_ruby_opt_name, look_ruby_archive_page_config() );
Redux::setSection( $look_ruby_opt_name, look_ruby_author_team_page_config() );


//social configs
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_social() );
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_share_post() );
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_site_social() );

//typography configs
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_typography() );
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_typography_body() );
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_typography_post() );
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_typography_nav() );
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_typography_block_header() );

//woocommerce
if ( class_exists( 'Woocommerce' ) ) {
	Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_woocommerce() );
}

//custom script configs
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_custom_script() );

//import export configs
Redux::setSection( $look_ruby_opt_name, look_ruby_theme_options_import_export() );
