<?php
//meta box post review config
if ( ! function_exists( 'look_ruby_metabox_post_review' ) ) {
	function look_ruby_metabox_post_review() {
		return array(
			'id'         => 'look_ruby_metabox_review_options',
			'title'      => esc_html__( 'POST REVIEWS', 'look' ),
			'post_types' => array( 'post' ),
			'priority'   => 'high',
			'context'    => 'normal',
			'fields'     => array(
				array(
					'name'  => esc_html__( 'Enable Review', 'look' ),
					'id'    => 'look_ruby_enable_review',
					'class' => 'ruby-review-checkbox',
					'type'  => 'checkbox',
					'desc'  => esc_html__( 'enable review score this post', 'look' ),
					'std'   => 0,
				),
				array(
					'name'     => esc_html__( 'Review Box Position', 'look' ),
					'id'       => 'look_ruby_review_box_position',
					'type'     => 'image_select',
					'multiple' => false,
					'desc'     => esc_html__( 'select review box position', 'look' ),
					'options'  => look_ruby_theme_config::metabox_review_position(),
					'std'      => 'default'
				),
				array(
					'name' => esc_html__( 'Criteria 1 Description', 'look' ),
					'id'   => 'look_ruby_cd1',
					'type' => 'text',
				),
				array(
					'name'       => esc_html__( 'Criteria 1 Score', 'look' ),
					'id'         => 'look_ruby_cs1',
					'type'       => 'slider',
					'js_options' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => .1,
					),
				),
				// Criteria 2 Text & Score
				array(
					'name' => esc_html__( 'Criteria 2 Description', 'look' ),
					'id'   => 'look_ruby_cd2',
					'type' => 'text',
				),
				array(
					'name'       => esc_html__( 'Criteria 2 Score', 'look' ),
					'id'         => 'look_ruby_cs2',
					'type'       => 'slider',
					'js_options' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => .1,
					),
				),
				// Criteria 3 Text & Score
				array(
					'name' => esc_html__( 'Criteria 3 Description', 'look' ),
					'id'   => 'look_ruby_cd3',
					'type' => 'text',
				),
				array(
					'name'       => esc_html__( 'Criteria 3 Score', 'look' ),
					'id'         => 'look_ruby_cs3',
					'type'       => 'slider',
					'js_options' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => .1,
					),
				),
				// Criteria 4 Text & Score
				array(
					'name' => esc_html__( 'Criteria 4 Description', 'look' ),
					'id'   => 'look_ruby_cd4',
					'type' => 'text',
				),
				array(
					'name'       => esc_html__( 'Criteria 4 Score', 'look' ),
					'id'         => 'look_ruby_cs4',
					'type'       => 'slider',
					'js_options' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => .1,
					),
				),
				// Criteria 5 Text & Score
				array(
					'name' => esc_html__( 'Criteria 5 Description', 'look' ),
					'id'   => 'look_ruby_cd5',
					'type' => 'text',
				),
				array(
					'name'       => esc_html__( 'Criteria 5 Score', 'look' ),
					'id'         => 'look_ruby_cs5',
					'type'       => 'slider',
					'js_options' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => .1,
					),
				),
				// Criteria 6 Text & Score
				array(
					'name' => esc_html__( 'Criteria 6 Description', 'look' ),
					'id'   => 'look_ruby_cd6',
					'type' => 'text',
				),
				array(
					'name'       => esc_html__( 'Criteria 6 Score', 'look' ),
					'id'         => 'look_ruby_cs6',
					'type'       => 'slider',
					'js_options' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => .1,
					),
				),
				// Final average
				array(
					'name'  => esc_html__( 'Average Score', 'look' ),
					'id'    => 'look_ruby_as',
					'class' => 'ruby-average-score',
					'type'  => 'text',
				),
				array(
					'name'  => esc_html__( 'Review Summary', 'look' ),
					'id'    => 'look_ruby_review_summary',
					'class' => 'field-review-summary',
					'type'  => 'textarea',
				),
			)
		);
	}
}