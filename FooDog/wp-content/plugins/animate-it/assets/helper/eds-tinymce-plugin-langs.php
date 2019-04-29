<?php
// This file is based on wp-includes/js/tinymce/langs/wp-langs.php

if ( ! defined( 'ABSPATH' ) )
	exit;

if ( ! class_exists( '_WP_Editors' ) )
	require( ABSPATH . WPINC . '/class-wp-editor.php' );

function edsanimate_tinymce_plugin_translation() {
	$strings = array(
			'modal_title' => __( 'Select your Animation Style', 'eds-animate' ),
	);
	$locale = _WP_Editors::$mce_locale;
	$translated = 'tinyMCE.addI18n("' . $locale . '.edsanimate", ' . json_encode( $strings ) . ");\n";

	return $translated;
}

$strings = edsanimate_tinymce_plugin_translation();