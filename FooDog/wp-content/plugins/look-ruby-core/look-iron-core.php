<?php
/**
 * Plugin Name:    Look Ruby Core
 * Plugin URI:     https://themeforest.net/user/theme-ruby/
 * Description:    Additional features for Look theme
 * Version:        1.0
 * Author:         Theme-Ruby
 * Author URI:     https://themeforest.net/user/theme-ruby/
 * @package        look-ruby-shortcodes
 * @copyright (c) 2016, Theme-Ruby
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class look_ruby_plugin_core {

	/**
	 * register functions
	 */
	function __construct() {

		// Plugin Folder URL
		if ( ! defined( 'look_ruby_plugin_core_PLUGIN_URL' ) ) {
			define( 'look_ruby_plugin_core_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 1 );

		//add shortcodes
		add_shortcode( 'button', array( $this, 'shortcode_button' ) );
		add_shortcode( 'dropcap', array( $this, 'shortcode_dropcap' ) );
		add_shortcode( 'accordion', array( $this, 'shortcode_accordion_group' ) );
		add_shortcode( 'accordion-item', array( $this, 'ruby_accordion_item' ) );
		add_shortcode( 'row', array( $this, 'shortcode_row' ) );
		add_shortcode( 'column', array( $this, 'shortcode_column' ) );

		//add author
		add_filter( 'user_contactmethods', array( $this, 'additional_author_info' ) );

	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 *
	 * load css
	 */
	static function enqueue_scripts() {

		wp_enqueue_style( 'look_ruby_plugin_core_style', look_ruby_plugin_core_PLUGIN_URL . 'core.css', array(), '1.0', 'all' );
		wp_enqueue_script( 'look_ruby_plugin_core_scripts', look_ruby_plugin_core_PLUGIN_URL . 'core.js', array( 'jquery' ), '1.0', true );

	}

	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param null $content
	 *
	 * @return string
	 */
	static function shortcodes_helper( $content = null ) {
		$content = do_shortcode( shortcode_unautop( $content ) );
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
		$content = preg_replace( '#<br \/>#', '', $content );

		return trim( $content );
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $attrs
	 * @param null $content
	 *
	 * @return string
	 * button shortcode
	 */
	static function shortcode_button( $attrs, $content = null ) {
		extract( shortcode_atts( array(
			'type'   => '',
			'color'  => '',
			'target' => '',
			'link'   => ''
		), $attrs ) );

		$classes      = array();
		$style_inline = '';
		$target       = '';
		$str          = '';

		$classes[] = 'btn shortcode-btn';
		if ( ! empty( $type ) ) {
			$classes[] = 'is-' . strip_tags( $type );
		} else {
			$classes[] = 'is-default';
		}

		if ( ! empty( $color ) ) {
			$style_inline = 'style="background-color: ' . strip_tags( $color ) . '"';
		}

		if ( ! empty( $link ) ) {
			$link = esc_url( $link );
		} else {
			$link = '#';
		}

		if ( ! empty( $target ) ) {
			$target = 'target="_blank"';
		}

		$classes = implode( ' ', $classes );

		$str .= '<a class="' . $classes . '" ' . $style_inline . ' ' . $target . ' href="' . $link . '">';
		$str .= esc_attr( $content );
		$str .= '</a>';

		return $str;

	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $attrs
	 * @param null $content
	 *
	 * @return string
	 * dropcap shortcode
	 */
	static function shortcode_dropcap( $attrs, $content = null ) {
		extract( shortcode_atts( array(
			'type' => '',
		), $attrs ) );

		$classes   = array();
		$classes[] = 'shortcode-dropcap';

		if ( empty( $type ) ) {
			$classes[] = 'is-default';
		} else {
			$classes[] = 'is-' . esc_attr( $type );
		}

		$classes = implode( ' ', $classes );

		return '<span class="' . esc_attr( $classes ) . '">' . $content . '</span>';
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $attrs
	 * @param null $content
	 *
	 * @return string
	 * accordion shortcode
	 */
	static function shortcode_accordion_group( $attrs, $content = null ) {
		return '<div class="shortcode-accordion">' . self::shortcodes_helper( $content ) . ' </div>';
	}


	static function ruby_accordion_item( $attrs, $content = null ) {
		extract( shortcode_atts( array(
			'title' => '',
		), $attrs ) );

		if ( empty( $title ) ) {
			$title = '';
		}

		$str = '';
		$str .= '<h3 class="accordion-item-title">' . $title . '</h3>';
		$str .= '<div class="accordion-item-content accordion-hide">' . self::shortcodes_helper( $content ) . '</div>';

		return $str;

	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $attrs
	 * @param null $content
	 *
	 * @return string
	 * row shortcodes
	 */
	static function shortcode_row( $attrs, $content = null ) {

		return '<div class="shortcode-row row clearfix">' . self::shortcodes_helper( $content ) . '</div>';

	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $attrs
	 * @param null $content
	 *
	 * @return string
	 * column shortcode
	 */
	static function shortcode_column( $attrs, $content = null ) {

		extract( shortcode_atts( array(
			'width' => ''
		), $attrs ) );

		if ( empty( $width ) ) {
			$width = '100%';
		}

		switch ( $width ) {
			case '50%'  :
				return '<div class="shortcode-col col-sm-6 col-sx-12">' . self::shortcodes_helper( $content ) . '</div>';
			case '33%'  :
				return '<div class="shortcode-col col-sm-4 col-sx-12">' . self::shortcodes_helper( $content ) . '</div>';
			case '66%' :
				return '<div class="shortcode-col col-sm-8 col-sx-12">' . self::shortcodes_helper( $content ) . '</div>';
			case '25%' :
				return '<div class="shortcode-col col-sm-3 col-sx-12">' . self::shortcodes_helper( $content ) . '</div>';
			default :
				return '<div class="shortcode-col col-xs-12">' . self::shortcodes_helper( $content ) . '</div>';
		}
	}

	static function additional_author_info() {
		return array(
			'job'         => esc_html__( 'Job Name', 'look' ),
			'facebook'    => esc_html__( 'Facebook', 'look' ),
			'twitter'     => esc_html__( 'Twitter', 'look' ),
			'google_plus' => esc_html__( 'Google Plus', 'look' ),
			'pinterest'   => esc_html__( 'Pinterest', 'look' ),
			'bloglovin'   => esc_html__( 'Bloglovin', 'look' ),
			'linkedin'    => esc_html__( 'Linkedin', 'look' ),
			'tumblr'      => esc_html__( 'Tumblr', 'look' ),
			'flickr'      => esc_html__( 'Flickr', 'look' ),
			'instagram'   => esc_html__( 'Instagram', 'look' ),
			'skype'       => esc_html__( 'Skype', 'look' ),
			'myspace'     => esc_html__( 'Myspace', 'look' ),
			'youtube'     => esc_html__( 'Youtube', 'look' ),
			'vkontakte'   => esc_html__( 'Vkontakte', 'look' ),
			'reddit'      => esc_html__( 'Reddit', 'look' ),
			'snapchat'    => esc_html__( 'Snapchat', 'look' ),
			'digg'        => esc_html__( 'Digg', 'look' ),
			'dribbble'    => esc_html__( 'Dribbble', 'look' ),
			'soundcloud'  => esc_html__( 'Soundcloud', 'look' ),
			'vimeo'       => esc_html__( 'Vimeo', 'look' ),
			'rss'         => esc_html__( 'Rss', 'look' ),
		);
	}

}

new look_ruby_plugin_core();