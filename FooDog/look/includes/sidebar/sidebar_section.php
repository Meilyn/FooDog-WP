<?php

//registering sidebar sections
if ( get_option( 'look_ruby_custom_multi_sidebars', false ) ) {
	$theme_current_sidebars = get_option( 'look_ruby_custom_multi_sidebars', '' );
	if ( ! empty( $theme_current_sidebars ) && is_array( $theme_current_sidebars ) ) {
		foreach ( $theme_current_sidebars as $current_sidebar ) {
			register_sidebar(
				array(
					'name'          => $current_sidebar['name'],
					'id'            => $current_sidebar['id'],
					'before_widget' => '<aside class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<div class="widget-title block-title"><h3>',
					'after_title'   => '</h3></div>',
				)
			); //#foreach
		};
	};
};

register_sidebar(
	array(
		'id'            => 'look_ruby_sidebar_off_canvas',
		'name'          => esc_html__( 'Off Canvas Section', 'look' ),
		'description'   => esc_html__( 'Off canvas section', 'look' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title block-title"><h3>',
		'after_title'   => '</h3></div>'
	)
);

//blog home section
register_sidebar(
	array(
		'id'            => 'look_ruby_blog_column_1',
		'name'          => esc_html__( 'Blog Page First Column', 'look' ),
		'description'   => esc_html__( 'One of column at top of latest blog page', 'look' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title block-title"><h3>',
		'after_title'   => '</h3></div>'
	)
);

register_sidebar(
	array(
		'id'            => 'look_ruby_blog_column_2',
		'name'          => esc_html__( 'Blog Page Second Column', 'look' ),
		'description'   => esc_html__( 'One of column at top of latest last blog page', 'look' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title block-title"><h3>',
		'after_title'   => '</h3></div>'
	)
);

register_sidebar(
	array(
		'id'            => 'look_ruby_blog_column_3',
		'name'          => esc_html__( 'Blog Page Third Column', 'look' ),
		'description'   => esc_html__( 'One of column at top of home page', 'look' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title block-title"><h3>',
		'after_title'   => '</h3></div>'
	)
);


//footer sections
register_sidebar(
	array(
		'id'            => 'look_ruby_sidebar_footer_fullwidth',
		'name'          => esc_html__( 'Top Footer (Full-Width)', 'look' ),
		'description'   => esc_html__( 'Full width area at top of footer area. Allow [TOP FOOTER] Widget as instagram grid & and social counter widgets', 'look' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title block-title"><h3>',
		'after_title'   => '</h3></div>'
	)
);

register_sidebar(
	array(
		'id'            => 'look_ruby_sidebar_footer_1',
		'name'          => esc_html__( 'Footer 1', 'look' ),
		'description'   => esc_html__( 'One of column of footer area', 'look' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title block-title"><h3>',
		'after_title'   => '</h3></div>'
	)
);

register_sidebar(
	array(
		'id'            => 'look_ruby_sidebar_footer_2',
		'name'          => esc_html__( 'Footer 2', 'look' ),
		'description'   => esc_html__( 'One of column of footer area', 'look' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title block-title"><h3>',
		'after_title'   => '</h3></div>'
	)
);

register_sidebar(
	array(
		'id'            => 'look_ruby_sidebar_footer_3',
		'name'          => esc_html__( 'Footer 3', 'look' ),
		'description'   => esc_html__( 'One of column of footer area', 'look' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title block-title"><h3>',
		'after_title'   => '</h3></div>'
	)
);
