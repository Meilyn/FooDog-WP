<?php

	if( !defined( 'WP_UNINSTALL_PLUGIN' ) )
		exit;
	
	delete_option('eds_scroll_offset');
	delete_option('eds_enable_on_phone');
	delete_option('eds_enable_on_tab');
	delete_option('eds_hide_overflow_x');
	delete_option('eds_hide_overflow_y');
	delete_option('eds_custom_css');
	delete_option('eds_animate_it_version');