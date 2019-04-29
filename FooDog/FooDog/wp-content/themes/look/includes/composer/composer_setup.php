<?php

//setup section & module page composer
if ( ! class_exists( 'look_ruby_composer_setup' ) ) {
	class look_ruby_composer_setup {

		public function  __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'setup_sections' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'setup_blocks' ) );
		}

		//setup page sections
		public function setup_sections() {

			$look_ruby_setup_sections = array(
				'section_full_width'  => array(
					'title' => esc_html__( 'Full Width Section', 'look' ),
					'img'   => get_template_directory_uri() . '/includes/composer/images/section-full-width.png',
					'decs'  => esc_html__( 'Display content without sidebar', 'look' ),
				),
				'section_has_sidebar' => array(
					'title' => esc_html__( 'Has Sidebar Section', 'look' ),
					'img'   => get_template_directory_uri() . '/includes/composer/images/section-has-sidebar.png',
					'decs'  => esc_html__( 'Display content width sidebar', 'look' ),
				),

			);
			wp_localize_script( 'look_ruby_composer_script', 'look_ruby_setup_sections', $look_ruby_setup_sections );
		}

		//setup blocks
		public function setup_blocks() {
			$look_ruby_setup_blocks = array(

				//Fullwidth blocks
				'look_ruby_fw_block_slider_fw' => array(
					'title'         => esc_html__( 'FullWidth Slider', 'look' ),
					'description'   => esc_html__( 'Featured - show slider (fullwidth mode) in fullwidth section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/fw-block-slider-fw.png',
					'section'       => 'section_full_width',
					'block_options' => look_ruby_fw_block_slider_fw::block_config()
				),
				'look_ruby_fw_block_slider_hw' => array(
					'title'         => esc_html__( 'Wrapper Slider', 'look' ),
					'description'   => esc_html__( 'Featured -show slider (wrapper mode) in fullwidth section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/fw-block-slider-hw.png',
					'section'       => 'section_full_width',
					'block_options' => look_ruby_fw_block_slider_hw::block_config()
				),
				'look_ruby_fw_block_carousel'  => array(
					'title'         => esc_html__( 'FullWidth Carousel', 'look' ),
					'description'   => esc_html__( 'Featured - show carousel in fullwidth section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/fw-block-carousel.png',
					'section'       => 'section_full_width',
					'block_options' => look_ruby_fw_block_carousel::block_config()
				),
				'look_ruby_fw_block_grid'      => array(
					'title'         => esc_html__( 'Wrapper Grid', 'look' ),
					'description'   => esc_html__( 'Featured - show featured gird in fullwidth section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/fw-block-feat-grid.png',
					'section'       => 'section_full_width',
					'block_options' => look_ruby_fw_block_grid::block_config()
				),
				'look_ruby_fw_block_video'     => array(
					'title'         => esc_html__( 'Video Playlist', 'look' ),
					'description'   => esc_html__( 'Show video playlist in fullwidth section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/fw-block-video.png',
					'section'       => 'section_full_width',
					'block_options' => look_ruby_fw_block_video::block_config()
				),
				'look_ruby_fw_block_1'         => array(
					'title'         => esc_html__( 'Block 1 (Grid)', 'look' ),
					'description'   => esc_html__( 'show block grid (3 columns) in fullwidth section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/fw-block-1.png',
					'section'       => 'section_full_width',
					'block_options' => look_ruby_fw_block_1::block_config()
				),
				'look_ruby_fw_block_2'         => array(
					'title'         => esc_html__( 'Block 2 (small grid)', 'look' ),
					'description'   => esc_html__( 'show block 2 (4 columns small grid layout) in fullwidth section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/fw-block-2.png',
					'section'       => 'section_full_width',
					'block_options' => look_ruby_fw_block_2::block_config()
				),
				'look_ruby_fw_block_3'         => array(
					'title'         => esc_html__( 'Block 3 (small grid)', 'look' ),
					'description'   => esc_html__( 'show block 3 (4 columns small grid layout) in fullwidth section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/fw-block-3.png',
					'section'       => 'section_full_width',
					'block_options' => look_ruby_fw_block_3::block_config()
				),
				'look_ruby_fw_block_4'         => array(
					'title'         => esc_html__( 'Block 4 (overlay)', 'look' ),
					'description'   => esc_html__( 'show block 4 (3 columns overlay grid layout) in fullwidth section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/fw-block-4.png',
					'section'       => 'section_full_width',
					'block_options' => look_ruby_fw_block_4::block_config()
				),
				'look_ruby_fw_block_code'      => array(
					'title'         => esc_html__( 'HTML/shortcodes', 'look' ),
					'description'   => esc_html__( 'show custom HTML or shortcodes in fullwidth section', 'look' ),
					'section'       => 'section_full_width',
					'img'           => get_template_directory_uri() . '/includes/composer/images/block-code-box.png',
					'block_options' => look_ruby_fw_block_code::block_config()
				),
				'look_ruby_fw_block_ad_box'    => array(
					'title'         => esc_html__( 'Ad Box', 'look' ),
					'description'   => esc_html__( 'Show Advertisement box in fullwidth section', 'look' ),
					'section'       => 'section_full_width',
					'img'           => get_template_directory_uri() . '/includes/composer/images/block-ad-box.png',
					'block_options' => look_ruby_fw_block_ad_box::block_config()
				),
				//Has sidebar blocks
				'look_ruby_hs_block_1'         => array(
					'title'         => esc_html__( 'Block 1 (List)', 'look' ),
					'description'   => esc_html__( 'Show block post 1 (list layout) in has sidebar section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/hs-block-1.png',
					'section'       => 'section_has_sidebar',
					'block_options' => look_ruby_hs_block_1::block_config()
				),
				'look_ruby_hs_block_2'         => array(
					'title'         => esc_html__( 'Block 2 (Grid)', 'look' ),
					'description'   => esc_html__( 'Show block post 2 (grid layout) in has sidebar section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/hs-block-2.png',
					'section'       => 'section_has_sidebar',
					'block_options' => look_ruby_hs_block_2::block_config()
				),
				'look_ruby_hs_block_3'         => array(
					'title'         => esc_html__( 'Block 3 (Classic)', 'look' ),
					'description'   => esc_html__( 'Show block post 3 (classic layout) in has sidebar section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/hs-block-3.png',
					'section'       => 'section_has_sidebar',
					'block_options' => look_ruby_hs_block_3::block_config()
				),
				'look_ruby_hs_block_4'         => array(
					'title'         => esc_html__( 'Block 4 (overlay)', 'look' ),
					'description'   => esc_html__( 'Show block post 4 (2 columns overlay grid layout) in has sidebar section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/hs-block-4.png',
					'section'       => 'section_has_sidebar',
					'block_options' => look_ruby_hs_block_4::block_config()
				),
				'look_ruby_hs_block_5'         => array(
					'title'         => esc_html__( 'Block 5 (small grid)', 'look' ),
					'description'   => esc_html__( 'Show block post 5 (3 columns small grid layout) in has sidebar section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/hs-block-5.png',
					'section'       => 'section_has_sidebar',
					'block_options' => look_ruby_hs_block_5::block_config()
				),
				'look_ruby_hs_block_6'         => array(
					'title'         => esc_html__( 'Block 6 (small grid)', 'look' ),
					'description'   => esc_html__( 'Show block post 6 (3 columns small grid layout) in has sidebar section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/hs-block-6.png',
					'section'       => 'section_has_sidebar',
					'block_options' => look_ruby_hs_block_6::block_config()
				),
				'look_ruby_hs_block_7'         => array(
					'title'         => esc_html__( 'Block 7', 'look' ),
					'description'   => esc_html__( 'Show block post 7 (left overlay layout & right list post) in has sidebar section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/hs-block-7.png',
					'section'       => 'section_has_sidebar',
					'block_options' => look_ruby_hs_block_7::block_config()
				),
				'look_ruby_hs_block_8'         => array(
					'title'         => esc_html__( 'Block 8', 'look' ),
					'description'   => esc_html__( 'Show block post 8 (left overlay layout & right list post) in has sidebar section', 'look' ),
					'img'           => get_template_directory_uri() . '/includes/composer/images/hs-block-8.png',
					'section'       => 'section_has_sidebar',
					'block_options' => look_ruby_hs_block_8::block_config()
				),
				'look_ruby_hs_block_code'      => array(
					'title'         => esc_html__( 'HTML/shortcodes', 'look' ),
					'description'   => esc_html__( 'Show Custom HTML code in has sidebar section', 'look' ),
					'section'       => 'section_has_sidebar',
					'img'           => get_template_directory_uri() . '/includes/composer/images/block-code-box.png',
					'block_options' => look_ruby_hs_block_code::block_config()
				),
				'look_ruby_hs_block_ad_box'    => array(
					'title'         => esc_html__( 'Ad Box', 'look' ),
					'description'   => esc_html__( 'Show Advertisement box in has sidebar section', 'look' ),
					'section'       => 'section_has_sidebar',
					'img'           => get_template_directory_uri() . '/includes/composer/images/block-ad-box.png',
					'block_options' => look_ruby_hs_block_ad_box::block_config()
				),
			);

			wp_localize_script( 'look_ruby_composer_script', 'look_ruby_setup_blocks', $look_ruby_setup_blocks );
		}
	}


	//init page composer class
	new look_ruby_composer_setup();
}



