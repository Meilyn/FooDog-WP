<?php

//create config for page composer
class look_ruby_composer_config {

	/**-------------------------------------------------------------------------------------------------------------------------
	 * init page composer
	 */
	public function __construct() {
		add_action( 'edit_form_after_title', array( $this, 'page_composer_edit' ) );
		add_action( 'edit_form_after_title', array( $this, 'page_composer_template' ) );
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * render page composer wrap
	 */
	public function page_composer_edit() {
		//check
		if ( ! is_admin() ) {
			return false;
		}

		$page_id = get_the_ID();

		$str = '';
		if ( isset( $page_id ) && 'page-composer.php' == get_post_meta( $page_id, '_wp_page_template', true ) ) {
			$str .= '<style>';
			$str .= '#postdivrich, #look_ruby_metabox_sidebar_options, #look_ruby_metabox_single_page_options{ display:none; }';
			$str .= '#look_ruby_metabox_composer_options {display: block; }';
			$str .= '</style>';
		} else {
			$str .= '<style>#look_ruby_composer_editor, #look_ruby_metabox_composer_options { display:none; }</style>';
		}

		$str .= '<div id="look_ruby_composer_editor" class="ruby-composer-editor">';
		$str .= '<div class="ruby-composer-title"><h3>' . esc_html__( 'page composer', 'look' ) . '</h3></div>';
		$str .= '<div id="ruby-page-composer-loading"></div>';
		$str .= '<div class="ruby-toolbox"><a href="#" id="page_composer_section_select" class="add-section-select">' . esc_html__( 'select your section', 'look' ) . '</a>';
		$str .= '<div id="look_ruby_section_select" class="section-select-wrap"></div>';
		$str .= '</div>';
		$str .= '<div class="ruby-sections-wrap">';
		$str .= '<div class="ruby-section-empty">' . html_entity_decode( esc_html__( 'Select <strong>"SECTION"</strong> to create section', 'look' ) ) . '</div>';
		$str .= '</div><!--#sections wrap-->';
		$str .= '</div><!--#page composer-->';

		echo( $str );
	}


	/**-------------------------------------------------------------------------------------------------------------------------
	 * create page composer field data
	 */
	public function page_composer_template() {
		$template = array();

		//block
		$str = '';
		$str .= '<div class="ruby-block-item">';
		$str .= '<input type="hidden" class="ruby-block-order">';
		$str .= '<input type="hidden" class="ruby-block-name">';
		$str .= '<div class="ruby-block-bar">';
		$str .= '<i class="ruby-block-move">#</i>';
		$str .= '<div class="ruby-block-label"></div><!--#block label-->';
		$str .= '<div class="ruby-block-toolbox">';
		$str .= '<a class="ruby-block-open-option" href="#">+</a>';
		$str .= '<a class="ruby-block-delete" href="#">x</a><!--block delete-->';
		$str .= '</div><!--#block toolbox -->';
		$str .= '</div><!--#block bar -->';
		$str .= '<div class="ruby-block-options-wrap hidden"><div class="ruby-block-description"></div></div><!--block options wrap -->';
		$str .= '</div><!--item block -->';
		$template['block'] = $str;

		//block option
		$str = '';
		$str .= '<div class="ruby-block-option">';
		$str .= '<div class="ruby-block-option-label-wrap">';
		$str .= '<label class="ruby-block-option-label"></label>';
		$str .= '<div class="ruby-block-option-description"></div>';
		$str .= '</div><!--#block wrap -->';
		$str .= '<div class="ruby-block-option-inner"></div><!--block option -->';
		$str .= '</div><!--#block option -->';
		$template['block_option'] = $str;

		//Fields Input
		$template['input']['text']        = '<input class="ruby-field" type="text">'; //text
		$template['input']['num']         = '<input class="ruby-field" type="number" name="quantity" min="1">'; //number
		$template['input']['textarea']    = '<textarea class="ruby-field" rows="9"></textarea>'; //text area
		$template['input']['category']    = look_ruby_theme_config::category_dropdown_select();//category
		$template['input']['post_format'] = look_ruby_theme_config::post_format_dropdown_select();
		$template['input']['categories']  = look_ruby_theme_config::categories_dropdown_select();//categories
		$template['input']['enable']      = look_ruby_theme_config::enable_dropdown_select();//enable-disable
		$template['input']['authors']     = look_ruby_theme_config::author_dropdown_select();//author
		$template['input']['orderby']     = look_ruby_theme_config::orderby_dropdown_select();//sort order

		//wrapper mode
		$template['input']['wrap_mode'] = look_ruby_theme_config::wrapmode_dropdown_select();

		//Fields Title
		$template['title']['title']          = esc_html__( 'Title', 'look' );
		$template['title']['title_url']      = esc_html__( 'Title Url', 'look' );
		$template['title']['category_id']    = esc_html__( 'Category Filter', 'look' );
		$template['title']['category_ids']   = esc_html__( 'Multiple Categories Filter', 'look' );
		$template['title']['post_format']    = esc_html__( 'Post Format Filter', 'look' );
		$template['title']['tags']           = esc_html__( 'Tags slug filter', 'look' );
		$template['title']['authors']        = esc_html__( 'Authors Filter', 'look' );
		$template['title']['posts_per_page'] = esc_html__( 'Number Of Posts', 'look' );
		$template['title']['num_of_slider']  = esc_html__( 'Number Of Slider', 'look' );
		$template['title']['offset']         = esc_html__( 'Post Offset', 'look' );
		$template['title']['orderby']        = esc_html__( 'Sort Order', 'look' );
		$template['title']['excerpt']        = esc_html__( 'Posts Excerpt', 'look' );
		$template['title']['readmore']       = esc_html__( 'Read More Button', 'look' );
		$template['title']['big_first']      = esc_html__( '1st Classic Post', 'look' );


		//block static image
		$template['title']['content']      = esc_html__( 'Content', 'look' );
		$template['title']['image_url']    = esc_html__( 'Image URL', 'look' );
		$template['title']['image_link']   = esc_html__( 'Image Link', 'look' );
		$template['title']['button_title'] = esc_html__( 'Button Title', 'look' );

		//block code box
		$template['title']['wrap_mode']   = esc_html__( 'Block Wrapper Mode', 'look' );
		$template['title']['custom_html'] = esc_html__( 'Custom HTML', 'look' );
		$template['title']['shortcode']   = esc_html__( 'ShortCodes', 'look' );

		//block ads
		$template['title']['ad_title']  = esc_html__( 'Ad title', 'look' );
		$template['title']['ad_url']    = esc_html__( 'Ad URL', 'look' );
		$template['title']['ad_image']  = esc_html__( 'Ad Image URL', 'look' );
		$template['title']['ad_script'] = esc_html__( 'AdSense‎ Script', 'look' );

		//Fields Description
		$template['desc']['title']          = esc_html__( 'Optional - input title for this block', 'look' );
		$template['desc']['title_url']      = esc_html__( 'Optional - custom url for this block (when the module title is clicked)', 'look' );
		$template['desc']['category_id']    = esc_html__( 'Select the category for this block', 'look' );
		$template['desc']['category_ids']   = esc_html__( 'Select categories you want to display. This option will override on "category filter" setting', 'look' );
		$template['desc']['post_format']    = esc_html__( 'Select post format you want to display', 'look' );
		$template['desc']['tags']           = esc_html__( 'To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)', 'look' );
		$template['desc']['authors']        = esc_html__( 'filter by authors', 'look' );
		$template['desc']['posts_per_page'] = esc_html__( 'How many posts you want to show at once', 'look' );
		$template['desc']['num_of_slider']  = esc_html__( 'How many slides you want to show', 'look' );
		$template['desc']['offset']         = esc_html__( 'Number of post to displace or pass over', 'look' );
		$template['desc']['orderby']        = esc_html__( 'Select sort order type for this block', 'look' );
		$template['desc']['excerpt']        = esc_html__( 'Select length of excerpt for this, leave blank or set is 0 if you want disable excerpt', 'look' );
		$template['desc']['readmore']       = esc_html__( 'Enable or disable "Read More" button for this block', 'look' );
		$template['desc']['big_first']      = esc_html__( 'display classic post at top of posts list', 'look' );

		//block static image
		$template['desc']['content']      = esc_html__( 'Enter the content for this block', 'look' );
		$template['desc']['image_url']    = esc_html__( 'Enter the image URL', 'look' );
		$template['desc']['image_link']   = esc_html__( 'Leave blank to output the image without link', 'look' );
		$template['desc']['button_title'] = esc_html__( 'Enter the button title', 'look' );

		//block code box
		$template['desc']['wrap_mode']   = esc_html__( 'Display content in full width or in wrapper', 'look' );
		$template['desc']['custom_html'] = esc_html__( 'Supports text, HTML code, JS code and video embed code...', 'look' );
		$template['desc']['shortcode']   = esc_html__( 'Input your short code. It is priority than custom html content...', 'look' );


		//block ads
		$template['desc']['ad_title']  = esc_html__( 'Input ad title', 'look' );
		$template['desc']['ad_url']    = esc_html__( 'Input destination URL of ads', 'look' );
		$template['desc']['ad_image']  = esc_html__( 'Input image attachment URL of ads. This option will override on AdSense. Leave blank if you want to use AdSense', 'look' );
		$template['desc']['ad_script'] = esc_html__( 'Input Google ad script or custom HTML', 'look' );

		//ajax pagination
		$template['title']['pagination'] = esc_html__( 'ajax pagination', 'look' );
		$template['desc']['pagination']  = esc_html__( 'select pagination type for this block', 'look' );
		$template['input']['pagination'] = look_ruby_theme_config::pagination_dropdown_select();

		//view more link
		$template['title']['view_more'] = esc_html__( 'view More Button', 'look' );
		$template['desc']['view_more']  = esc_html__( 'enable or disable view more link for this block', 'look' );

		$template['title']['view_more_text'] = esc_html__( 'view More Text', 'look' );
		$template['desc']['view_more_text']  = esc_html__( 'input the text of view more button', 'look' );

		$template['title']['view_more_link'] = esc_html__( 'view More URL', 'look' );
		$template['desc']['view_more_link']  = esc_html__( 'input the URL of view more button', 'look' );

		//title color
		$template['title']['title_color'] = esc_html__( 'Title Color', 'look' );
		$template['desc']['title_color']  = esc_html__( 'input a color for the title of this block (hex color ie: #111111)', 'look' );

		//auto play
		$template['title']['auto_play'] = esc_html__( 'Auto Play Video', 'look' );
		$template['desc']['auto_play']  = esc_html__( 'Auto the first video of this block when scrolling to it', 'look' );
		$template['title']['auto_play'] = esc_html__( 'Auto Play Video', 'look' );
		$template['input']['auto_play'] = look_ruby_theme_config::enable_dropdown_select();//sort order

		//unload
		$template['unload'] = esc_html( 'The changes you made will be lost if you navigate away from this page.', 'look' );

		//sidebar
		$str = '';
		$str .= '<div class="ruby-template-field-sidebar-label"><label>' . esc_html__( 'select sidebar options', 'look' ) . '</label>';
		$str .= '<div class="ruby-sidebar-select-wrap">';
		$str .= '<div class="ruby-sidebar-select-el">';
		$str .= '<div class="sidebar-label">' . esc_html__( 'Sidebar', 'look' ) . '</div>';
		$str .= '<select class ="ruby-sidebar-select">';

		//sidebar select
		$all_sidebar = look_ruby_theme_config::get_all_sidebar();
		if ( is_array( $all_sidebar ) ) {
			foreach ( look_ruby_theme_config::get_all_sidebar() as $sidebar ) {
				if ( ! empty( $sidebar['id'] ) && ! empty( $sidebar['name'] ) ) {
					$str .= '<option value="' . esc_attr( $sidebar['id'] ) . '">' . ucwords( $sidebar['name'] ) . '</option>';
				}
			};
		}
		$str .= '</select>';
		$str .= '</div><!--#sidebar select el-->';
		$str .= '<div class="ruby-sidebar-select-el">';
		$str .= '<div class="sidebar-label">' . esc_html__( 'Sidebar Position', 'look' ) . '</div>';
		$str .= '<select class="ruby-sidebar-position">';
		$str .= '<option selected value ="right">' . esc_html__( 'Right', 'look' ) . '</option>';
		$str .= '<option  value ="left">' . esc_html__( 'Left', 'look' ) . '</option>';
		$str .= '</select>';
		$str .= '</div><!--#sidebar select el-->';
		$str .= '</div></div><!--#sidebar section-->';
		$template['input']['sidebar'] = $str;

		//full width section
		$str = '';
		$str .= '<div class="ruby-section fullwidth-section"><!--section fullwidth-->';
		$str .= '<div class="ruby-section-bar">';
		$str .= '<i class="ruby-section-move">#</i><!--section drag and drop-->';
		$str .= '<div class="ruby-section-label"></div><!--#section label -->';
		$str .= '<div class="ruby-section-toolbox">';
		$str .= '<a class="ruby-section-open-option" href="#">+</a>';
		$str .= '<a class="ruby-section-delete" href="#">x</a><!--section delete-->';
		$str .= '</div><!--#section toolbox-->';
		$str .= '</div><!--#section bar -->';
		$str .= '<div class="ruby-block-wrap clearfix">';
		$str .= '<div class="section-menu-wrap">';
		$str .= '<div class="ruby-toolbox"><a href="#" class="add-block-select">' . esc_html__( 'Add block', 'look' ) . '</a>';
		$str .= '<div class="block-select-wrap"></div>';
		$str .= '</div><!--#block tool box -->';
		$str .= '</div><!--#fullwidth block menu -->';
		$str .= '<div class="ruby-blocks fullwidth-block">';
		$str .= '<input type="hidden" class="ruby-section-order" name="look_ruby_section_order[]">';
		$str .= '<input type="hidden" class="ruby-section-type">';
		$str .= '<div class="ruby-section-empty">' . esc_html__( 'Click " <strong>ADD BLOCK</strong> " button to add new block', 'look' ) . '</div>';
		$str .= '<div class="ruby-section-loading">' . esc_html__( 'Loading ...', 'look' ) . '</div>';
		$str .= '</div><!--#blocks -->';
		$str .= '</div><!--#block wrap -->';
		$str .= '</div><!--#section full width-->';
		$template['section_full_width'] = $str;

		//has sidebar section
		$str = '';
		$str .= '<div class="ruby-section has-sidebar-section">';
		$str .= '<div class="ruby-section-bar">';
		$str .= '<i class="ruby-section-move">#</i><!--section drag and drop-->';
		$str .= '<div class="ruby-section-label"></div><!--#section label -->';
		$str .= '<div class="ruby-section-toolbox">';
		$str .= '<a class="ruby-section-open-option" href="#">+</a>';
		$str .= '<a class="ruby-section-delete" href="#">x</a><!--section delete-->';
		$str .= '</div><!--#section toolbox-->';
		$str .= '</div>';
		$str .= '<div class="ruby-block-wrap clearfix">';
		$str .= '<div class="section-menu-wrap">';
		$str .= '<div class="ruby-section-sidebar">';
		$str .= '</div><!--#sidebar block -->';
		$str .= '<div class="ruby-toolbox"><a href="#" class="add-block-select">' . esc_html__( 'Add block', 'look' ) . '</a>';
		$str .= '<div class="block-select-wrap"></div>';
		$str .= '</div><!--#block tool box -->';
		$str .= '</div><!--#content block menu -->';
		$str .= '<div class="ruby-blocks content-block">';
		$str .= '<input type="hidden" class="ruby-section-order" name="look_ruby_section_order[]">';
		$str .= '<input type="hidden" class="ruby-section-type">';
		$str .= '<div class="ruby-section-empty">' . html_entity_decode( esc_html__( 'Click <strong>ADD BLOCK</strong> button to add new block', 'look' ) ) . '</div>';
		$str .= '<div class="ruby-section-loading">' . esc_html__( 'Loading ...', 'look' ) . '</div>';
		$str .= '</div><!--#blocks wrap-->';

		$str .= '</div><!--#block wrap -->';
		$str .= '</div><!--#section content -->';

		$template['section_has_sidebar'] = $str;

		//send data to javascript
		wp_localize_script( 'look_ruby_composer_script', 'look_ruby_composer_template', $template );
	}
}


//INIT PAGE COMPOSER
new look_ruby_composer_config();


