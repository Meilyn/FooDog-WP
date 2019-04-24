<?php

//save and get data composer
class look_ruby_composer_action {

	/**-------------------------------------------------------------------------------------------------------------------------
	 * init composer action
	 */
	public function __construct() {
		add_action( 'save_post', array( $this, 'init_composer_data' ) );
		add_action( 'admin_head', array( $this, 'backend_composer_data' ) );
	}

	/**-------------------------------------------------------------------------------------------------------------------------
	 * init composer data
	 */
	function init_composer_data() {

		if ( ! empty( $_POST['post_ID'] ) ) {
			$post_id = $_POST['post_ID'];
		} else {
			return false;
		}

		if ( empty( $_POST['post_type'] ) || 'page' != $_POST['post_type'] ) {
			return false;
		}

		$composer_data = array();

		if ( ! isset( $_POST['look_ruby_section_order'] ) ) {
			if ( 'page-composer.php' == get_post_meta( $post_id, '_wp_page_template', true ) ) {
				delete_post_meta( $post_id, 'look_ruby_composer_page_data' );
			}

			return false;
		};

		if ( ! array( $_POST['look_ruby_section_order'] ) ) {
			return false;
		}

		foreach ( $_POST['look_ruby_section_order'] as $id ) {

			//sanitize id
			$id = sanitize_text_field( $id );

			//get section type
			if ( ! isset( $_POST[ 'look_ruby_section_' . $id ] ) ) {
				return false;
			}

			$section_type = sanitize_text_field( $_POST[ 'look_ruby_section_' . $id ] );

			//add sidebar option
			if ( $section_type == 'section_has_sidebar' ) {

				//default value
				$section_sidebar          = '';
				$section_sidebar_position = '';

				if ( ! empty ( $_POST[ 'look_ruby_sidebar_' . $id ] ) ) {
					$section_sidebar = sanitize_text_field( $_POST[ 'look_ruby_sidebar_' . $id ] );
				}
				if ( ! empty( $_POST[ 'look_ruby_sidebar_position_' . $id ] ) ) {
					$section_sidebar_position = sanitize_text_field( $_POST[ 'look_ruby_sidebar_position_' . $id ] );
				}

				$composer_data[ $id ]['section_sidebar']          = $section_sidebar;
				$composer_data[ $id ]['section_sidebar_position'] = $section_sidebar_position;
			}

			$composer_data[ $id ]['section_type'] = $section_type;
			$composer_data[ $id ]['section_id']   = $id;


			//get child block
			if ( ! isset( $_POST['look_ruby_block_order'][ $id ] ) ) {
				continue;
			}

			$blocks_of_section = array_map( 'sanitize_text_field', $_POST['look_ruby_block_order'][ $id ] );

			//get all option and block
			$blocks = array();
			if ( is_array( $blocks_of_section ) ) {
				foreach ( $blocks_of_section as $block ) {
					$block_name = 'look_ruby_block_' . $block;

					//get block name
					$name                           = sanitize_text_field( $_POST[ $block_name ] );
					$blocks[ $block ]['block_name'] = $name;
					$blocks[ $block ]['block_id']   = $block;

					if ( isset( $_POST['look_ruby_block_option'][ $block_name ] ) ) {
						$block_options = $_POST['look_ruby_block_option'][ $block_name ];

						//get block option
						foreach ( $block_options as $option_name => $option ) {
							$option_name                                       = sanitize_text_field( $option_name );
							$option                                            = $this->sanitize_input( $option_name, $option );
							$blocks[ $block ]['block_options'][ $option_name ] = $option;
						}
					}
				}
			}

			$composer_data[ $id ]['blocks'] = $blocks;
		}

		//save composer data
		$this->save_composer_data( $post_id, $composer_data );

	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $page_id
	 * @param $composer_data
	 * save page composer to database
	 */
	public function save_composer_data( $page_id, $composer_data ) {
		delete_post_meta( $page_id, 'look_ruby_composer_page_data' );
		update_post_meta( $page_id, 'look_ruby_composer_page_data', $composer_data );
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param $page_id
	 *
	 * @return mixed
	 * get page composer as array value
	 */
	static function get_composer_data( $page_id ) {
		return get_post_meta( $page_id, 'look_ruby_composer_page_data', true );
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * get data for backend
	 */
	public function backend_composer_data() {

		global $post;
		if ( isset( $post->ID ) && 'page-composer.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
			$page_composer_data = self::get_composer_data( $post->ID );

			//stripcslashes block code
			if ( is_array( $page_composer_data ) ) {
				foreach ( $page_composer_data as $section_id => $section ) {
					if ( ! empty( $section['blocks'] ) ) {
						foreach ( $section['blocks'] as $block_id => $block ) {

							if ( ! empty( $block['block_options']['custom_html'] ) ) {
								$custom_html                                                                              = stripcslashes( $block['block_options']['custom_html'] );
								$page_composer_data[ $section_id ]['blocks'][ $block_id ]['block_options']['custom_html'] = $custom_html;
							}

							if ( ! empty( $block['block_options']['shortcode'] ) ) {
								$shortcode                                                                              = stripcslashes( $block['block_options']['shortcode'] );
								$page_composer_data[ $section_id ]['blocks'][ $block_id ]['block_options']['shortcode'] = $shortcode;
							}


							if ( ! empty( $block['block_options']['ad_script'] ) ) {
								$ad_script                                                                              = stripcslashes( $block['block_options']['ad_script'] );
								$page_composer_data[ $section_id ]['blocks'][ $block_id ]['block_options']['ad_script'] = $ad_script;
							}

						}
					}
				}
			}

			//send page data to javascript
			wp_localize_script( 'look_ruby_composer_script', 'look_ruby_composer_page_data', $page_composer_data );
		}
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param string $option_name
	 * @param string $option
	 *
	 * @return string
	 * sanitize page composer
	 */
	function  sanitize_input( $option_name = '', $option = '' ) {
		switch ( $option_name ) {
			case 'custom_html' :
			case 'shortcode' :
			case 'ad_script' :
				return addslashes( $option );
			case 'title_url'  :
			case 'image_url'  :
			case 'image_link' :
				return esc_url( $option );
			case 'category_ids' : {
				$options = array();
				if ( is_array( $option ) ) {
					foreach ( $option as $option_el ) {
						$options[] = sanitize_text_field( $option_el );
					}
				}
				return $options;
			}
			default :
				return sanitize_text_field( $option );
		}
	}
}


//INIT COMPOSER ACTION
new look_ruby_composer_action();