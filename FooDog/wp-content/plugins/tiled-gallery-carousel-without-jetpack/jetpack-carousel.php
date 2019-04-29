<?php

/*
Module Name:Image Gallery Carousel Without Jetpack
Plugin URL: https://themepacific.com/
Description: Transform your standard image galleries into an immersive full-screen experience.
Version: 0.1
Author: Raja CRN
Author URI: http://themepacific.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

 
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

class themepacific_Jetpack_Carousel {

	var $prebuilt_widths = array( 370, 700, 1000, 1200, 1400, 2000 );

	var $first_run = true;

	var $in_jetpack = true;

	function __construct() {

		add_action( 'init', array( $this, 'init' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ),99 );

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}
	public	function admin_menu() 
	{
		$icon_url = plugins_url( '/images/favicon.png', __FILE__ );
		
		$page_hook = add_menu_page( __( ' Tiled Gallery Carousel Without JetPack', 'themepacific_Jetpack'), 'TP Tiled Gallery', 'update_core', 'themepacific_jp_gallery', array(&$this, 'settings_page'), $icon_url );
		
		add_submenu_page( 'themepacific_jp_gallery', __( 'Settings', 'themepacific_Jetpack' ), __( ' Tiled Gallery Carousel Without JetPack Settings', 'themepacific_Jetpack' ), 'update_core', 'themepacific_jp_gallery', array(&$this, 'settings_page') );


	}
	function themepacific_gallery_enqueue_about_page_scripts($hook) {

		/*if ( 'themepacific_jp_gallery' != $hook ) {
			return;
		}
*/
	// enqueue CSS
		wp_enqueue_style( 'tpjp-settings-css',  plugins_url( 'themepacific_gallery_settings.css', __FILE__ ) );

	}
	public function admin_init()
	{		 $this->register_settings();

		
	}

	function init() {
		if ( $this->maybe_disable_jp_carousel() )
			return;

		$this->in_jetpack = ( class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'enable_module_configurable' ) ) ? true : false;

		if ( is_admin() ) {
			// Register the Carousel-related related settings

			add_action( 'admin_enqueue_scripts', array( $this, 'themepacific_gallery_enqueue_about_page_scripts' ) );

			if ( ! $this->in_jetpack ) {
				if ( 0 == $this->test_1or0_option( get_option( 'carousel_enable_it' ), true ) )
					return; // Carousel disabled, abort early, but still register setting so user can switch it back on
			}
			// If in admin, register the ajax endpoints.
			add_action( 'wp_ajax_get_attachment_comments', array( $this, 'get_attachment_comments' ) );
			add_action( 'wp_ajax_nopriv_get_attachment_comments', array( $this, 'get_attachment_comments' ) );
			add_action( 'wp_ajax_post_attachment_comment', array( $this, 'post_attachment_comment' ) );
			add_action( 'wp_ajax_nopriv_post_attachment_comment', array( $this, 'post_attachment_comment' ) );
		} else {
			if ( ! $this->in_jetpack ) {
				if ( 0 == $this->test_1or0_option( get_option( 'carousel_enable_it' ), true ) )
					return; // Carousel disabled, abort early
			}
			// If on front-end, do the Carousel thang.
			$this->prebuilt_widths = apply_filters( 'jp_carousel_widths', $this->prebuilt_widths );
			add_filter( 'post_gallery', array( $this, 'enqueue_assets' ), 1000, 2 ); // load later than other callbacks hooked it
			add_filter( 'gallery_style', array( $this, 'add_data_to_container' ) );
			add_filter( 'wp_get_attachment_link', array( $this, 'add_data_to_images' ), 10, 2 );
		}

		if ( $this->in_jetpack && method_exists( 'Jetpack', 'module_configuration_load' ) ) {
			Jetpack::enable_module_configurable( dirname( dirname( __FILE__ ) ) . '/carousel.php' );
			Jetpack::module_configuration_load( dirname( dirname( __FILE__ ) ) . '/carousel.php', array( $this, 'jetpack_configuration_load' ) );
		}
	}

	function maybe_disable_jp_carousel() {
		return apply_filters( 'jp_carousel_maybe_disable', false );
	}

	function jetpack_configuration_load() {
		wp_safe_redirect( admin_url( 'options-media.php#carousel_background_color' ) );
		exit;
	}

	function asset_version( $version ) {
		return apply_filters( 'jp_carousel_asset_version', $version );
	}

	function enqueue_assets( $output ) {
		if ( ! empty( $output ) && ! apply_filters( 'jp_carousel_force_enable', false ) ) {
			// Bail because someone is overriding the [gallery] shortcode.
			remove_filter( 'gallery_style', array( $this, 'add_data_to_container' ) );
			remove_filter( 'wp_get_attachment_link', array( $this, 'add_data_to_images' ) );
			return $output;
		}

		do_action( 'jp_carousel_thumbnails_shown' );

		if ( $this->first_run ) {
			wp_register_script( 'spin', plugins_url( 'spin.js', __FILE__ ), false, '1.3' );
			wp_register_script( 'jquery.spin', plugins_url( 'jquery.spin.js', __FILE__ ) , array( 'jquery', 'spin' ) );

			wp_enqueue_script( 'jetpack-carousel', plugins_url( 'jetpack-carousel.js', __FILE__ ), array( 'jquery.spin' ), $this->asset_version( '20130109' ), true );

			// Note: using  home_url() instead of admin_url() for ajaxurl to be sure  to get same domain on wpcom when using mapped domains (also works on self-hosted)
			// Also: not hardcoding path since there is no guarantee site is running on site root in self-hosted context.
			$is_logged_in = is_user_logged_in();
			$current_user = wp_get_current_user();
			$comment_registration = intval( get_option( 'comment_registration' ) );
			$require_name_email   = intval( get_option( 'require_name_email' ) );
			$localize_strings = array(
				'widths'               => $this->prebuilt_widths,
				'is_logged_in'         => $is_logged_in,
				'lang'                 => strtolower( substr( get_locale(), 0, 2 ) ),
				'ajaxurl'              => admin_url( 'admin-ajax.php', is_ssl() ? 'https' : 'http' ),
				'nonce'                => wp_create_nonce( 'carousel_nonce' ),
				'display_exif'         => $this->test_1or0_option( get_option( 'carousel_display_exif' ), true ),
				
				'display_geo'          => $this->test_1or0_option( get_option( 'carousel_display_geo' ), true ),				
				'display_comments'          => $this->test_1or0_option( get_option( 'comments_display' ), true ),
				'fullsize_display'          => $this->test_1or0_option( get_option( 'fullsize_display' ), true ),

				'background_color'     => $this->carousel_background_color_sanitize( get_option( 'carousel_background_color' ) ),
				'comment'              => __( 'Comment', 'themepacific_gallery' ),
				'post_comment'         => __( 'Post Comment', 'themepacific_gallery' ),
				'loading_comments'     => __( 'Loading Comments...', 'themepacific_gallery' ),

				'download_original'    => sprintf( __( 'View full size <span class="photo-size">%1$s<span class="photo-size-times">&times;</span>%2$s</span>', 'themepacific_gallery' ), '{0}', '{1}' ),

				'no_comment_text'      => __( 'Please be sure to submit some text with your comment.', 'themepacific_gallery' ),
				'no_comment_email'     => __( 'Please provide an email address to comment.', 'themepacific_gallery' ),
				'no_comment_author'    => __( 'Please provide your name to comment.', 'themepacific_gallery' ),
				'comment_post_error'   => __( 'Sorry, but there was an error posting your comment. Please try again later.', 'themepacific_gallery' ),
				'comment_approved'     => __( 'Your comment was approved.', 'themepacific_gallery' ),
				'comment_unapproved'   => __( 'Your comment is in moderation.', 'themepacific_gallery' ),
				'camera'               => __( 'Camera', 'themepacific_gallery' ),
				'aperture'             => __( 'Aperture', 'themepacific_gallery' ),
				'shutter_speed'        => __( 'Shutter Speed', 'themepacific_gallery' ),
				'focal_length'         => __( 'Focal Length', 'themepacific_gallery' ),
				'comment_registration' => $comment_registration,
				'require_name_email'   => $require_name_email,
				'login_url'            => wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ),
			);

			if ( ! isset( $localize_strings['jetpack_comments_iframe_src'] ) || empty( $localize_strings['jetpack_comments_iframe_src'] ) ) {
				// We're not using Jetpack comments after all, so fallback to standard local comments.
				if ( isset( $localize_strings['display_comments'] )){
					if ($localize_strings['display_comments']) {


						if ( $is_logged_in ) {
							$localize_strings['local_comments_commenting_as'] = '<p id="jp-carousel-commenting-as">' . sprintf( __( 'Commenting as %s', 'themepacific_gallery' ), $current_user->data->display_name ) . '</p>';
						} else {
							if ( $comment_registration ) {
								$localize_strings['local_comments_commenting_as'] = '<p id="jp-carousel-commenting-as">' . __( 'You must be <a href="#" class="jp-carousel-comment-login">logged in</a> to post a comment.', 'themepacific_gallery' ) . '</p>';
							} else {
								$required = ( $require_name_email ) ? __( '%s (Required)', 'themepacific_gallery' ) : '%s';
								$localize_strings['local_comments_commenting_as'] = ''
								. '<fieldset><label for="email">' . sprintf( $required, __( 'Email', 'themepacific_gallery' ) ) . '</label> '
								. '<input type="text" name="email" class="jp-carousel-comment-form-field jp-carousel-comment-form-text-field" id="jp-carousel-comment-form-email-field" /></fieldset>'
								. '<fieldset><label for="author">' . sprintf( $required, __( 'Name', 'themepacific_gallery' ) ) . '</label> '
								. '<input type="text" name="author" class="jp-carousel-comment-form-field jp-carousel-comment-form-text-field" id="jp-carousel-comment-form-author-field" /></fieldset>'
								. '<fieldset><label for="url">' . __( 'Website', 'themepacific_gallery' ) . '</label> '
								. '<input type="text" name="url" class="jp-carousel-comment-form-field jp-carousel-comment-form-text-field" id="jp-carousel-comment-form-url-field" /></fieldset>';
							}
						}
					}else{
						$localize_strings['loading_comments'] = '';
						$localize_strings['comment'] = '';
					}
				}
			}

			$localize_strings = apply_filters( 'jp_carousel_localize_strings', $localize_strings );
			wp_localize_script( 'jetpack-carousel', 'jetpackCarouselStrings', $localize_strings );
			wp_enqueue_style( 'jetpack-carousel', plugins_url( 'jetpack-carousel.css', __FILE__ ), array(), $this->asset_version( '20120629' ) );
			global $is_IE;
			if( $is_IE )
			{
				$msie = strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) + 4;
				$version = (float) substr( $_SERVER['HTTP_USER_AGENT'], $msie, strpos( $_SERVER['HTTP_USER_AGENT'], ';', $msie ) - $msie );
				if( $version < 9 )
					wp_enqueue_style( 'jetpack-carousel-ie8fix', plugins_url( 'jetpack-carousel-ie8fix.css', __FILE__ ), array(), $this->asset_version( '20121024' ) );
			}
			do_action( 'jp_carousel_enqueue_assets', $this->first_run, $localize_strings );

			$this->first_run = false;
		}

		return $output;
	}

	function add_data_to_images( $html, $attachment_id ) {
		if ( $this->first_run ) // not in a gallery
		return $html;

		$attachment_id   = intval( $attachment_id );
		$orig_file       = wp_get_attachment_image_src( $attachment_id, 'full' );
		$orig_file       = isset( $orig_file[0] ) ? $orig_file[0] : wp_get_attachment_url( $attachment_id );
		$meta            = wp_get_attachment_metadata( $attachment_id );
		$size            = isset( $meta['width'] ) ? intval( $meta['width'] ) . ',' . intval( $meta['height'] ) : '';
		$img_meta        = ( ! empty( $meta['image_meta'] ) ) ? (array) $meta['image_meta'] : array();
		$comments_opened = intval( comments_open( $attachment_id ) );

		/*
		 * Note: Cannot generate a filename from the width and height wp_get_attachment_image_src() returns because
		 * it takes the $content_width global variable themes can set in consideration, therefore returning sizes
		 * which when used to generate a filename will likely result in a 404 on the image.
		 * $content_width has no filter we could temporarily de-register, run wp_get_attachment_image_src(), then
		 * re-register. So using returned file URL instead, which we can define the sizes from through filename
		 * parsing in the JS, as this is a failsafe file reference.
		 *
		 * EG with Twenty Eleven activated:
		 * array(4) { [0]=> string(82) "http://vanillawpinstall.blah/wp-content/uploads/2012/06/IMG_3534-1024x764.jpg" [1]=> int(584) [2]=> int(435) [3]=> bool(true) }
		 *
		 * EG with Twenty Ten activated:
		 * array(4) { [0]=> string(82) "http://vanillawpinstall.blah/wp-content/uploads/2012/06/IMG_3534-1024x764.jpg" [1]=> int(640) [2]=> int(477) [3]=> bool(true) }
		 */

		$medium_file_info = wp_get_attachment_image_src( $attachment_id, 'medium' );
		$medium_file      = isset( $medium_file_info[0] ) ? $medium_file_info[0] : '';

		$large_file_info  = wp_get_attachment_image_src( $attachment_id, 'large' );
		$large_file       = isset( $large_file_info[0] ) ? $large_file_info[0] : '';

		$attachment       = get_post( $attachment_id );
		$attachment_title = wptexturize( $attachment->post_title );
		$attachment_desc  = wpautop( wptexturize( $attachment->post_content ) );

		// Not yet providing geo-data, need to "fuzzify" for privacy
		if ( ! empty( $img_meta ) ) {
			foreach ( $img_meta as $k => $v ) {
				if ( 'latitude' == $k || 'longitude' == $k )
					unset( $img_meta[$k] );
			}
		}

		$img_meta = json_encode( array_map( 'strval', $img_meta ) );

		$html = str_replace(
			'<img ',
			sprintf(
				'<img data-attachment-id="%1$d" data-orig-file="%2$s" data-orig-size="%3$s" data-comments-opened="%4$s" data-image-meta="%5$s" data-image-title="%6$s" data-image-description="%7$s" data-medium-file="%8$s" data-large-file="%9$s" ',
				$attachment_id,
				esc_attr( $orig_file ),
				$size,
				$comments_opened,
				esc_attr( $img_meta ),
				esc_attr( $attachment_title ),
				esc_attr( $attachment_desc ),
				esc_attr( $medium_file ),
				esc_attr( $large_file )
			),
			$html
		);

		$html = apply_filters( 'jp_carousel_add_data_to_images', $html, $attachment_id );

		return $html;
	}

	function add_data_to_container( $html ) {
		global $post;

		if ( isset( $post ) ) {
			$blog_id = (int) get_current_blog_id();

			if ( defined( 'IS_WPCOM' ) && IS_WPCOM ) {
				$likes_blog_id = $blog_id;
			} else {
				//$likes_blog_id = Jetpack_Options::get_option( 'id' );
			}

			$extra_data = array(
				'data-carousel-extra' => array(
					'blog_id' => $blog_id,
					'permalink' => get_permalink( $post->ID ),
					//'likes_blog_id' => $likes_blog_id
				)
			);

			$extra_data = apply_filters( 'jp_carousel_add_data_to_container', $extra_data );
			foreach ( (array) $extra_data as $data_key => $data_values ) {
				$html = str_replace( '<div ', '<div ' . esc_attr( $data_key ) . "='" . json_encode( $data_values ) . "' ", $html );
			}
		}

		return $html;
	}

	function get_attachment_comments() {
		if ( ! headers_sent() )
			header('Content-type: text/javascript');

		do_action('jp_carousel_check_blog_user_privileges');

		$attachment_id = ( isset( $_REQUEST['id'] ) ) ? (int) $_REQUEST['id'] : 0;
		$offset        = ( isset( $_REQUEST['offset'] ) ) ? (int) $_REQUEST['offset'] : 0;

		if ( ! $attachment_id ) {
			echo json_encode( __( 'Missing attachment ID.', 'themepacific_gallery' ) );
			die();
		}

		if ( $offset < 1 )
			$offset = 0;

		$comments = get_comments( array(
			'status'  => 'approve',
			'order'   => ( 'asc' == get_option('comment_order') ) ? 'ASC' : 'DESC',
			'number'  => 10,
			'offset'  => $offset,
			'post_id' => $attachment_id,
		) );

		$out      = array();

		// Can't just send the results, they contain the commenter's email address.
		foreach ( $comments as $comment ) {
			$out[] = array(
				'id'              => $comment->comment_ID,
				'parent_id'       => $comment->comment_parent,
				'author_markup'   => get_comment_author_link( $comment->comment_ID ),
				'gravatar_markup' => get_avatar( $comment->comment_author_email, 64 ),
				'date_gmt'        => $comment->comment_date_gmt,
				'content'         => wpautop($comment->comment_content),
			);
		}

		die( json_encode( $out ) );
	}

	function post_attachment_comment() {
		if ( ! headers_sent() )
			header('Content-type: text/javascript');

		if ( empty( $_POST['nonce'] ) || ! wp_verify_nonce($_POST['nonce'], 'carousel_nonce') )
			die( json_encode( array( 'error' => __( 'Nonce verification failed.', 'themepacific_gallery' ) ) ) );

		$_blog_id = (int) $_POST['blog_id'];
		$_post_id = (int) $_POST['id'];
		$comment = $_POST['comment'];

		if ( empty( $_blog_id ) )
			die( json_encode( array( 'error' => __( 'Missing target blog ID.', 'themepacific_gallery' ) ) ) );

		if ( empty( $_post_id ) )
			die( json_encode( array( 'error' => __( 'Missing target post ID.', 'themepacific_gallery' ) ) ) );

		if ( empty( $comment ) )
			die( json_encode( array( 'error' => __( 'No comment text was submitted.', 'themepacific_gallery' ) ) ) );

		// Used in context like NewDash
		$switched = false;
		if ( is_multisite() && $_blog_id != get_current_blog_id() ) {
			switch_to_blog( $_blog_id );
			$switched = true;
		}

		do_action('jp_carousel_check_blog_user_privileges');

		if ( ! comments_open( $_post_id ) )
			die( json_encode( array( 'error' => __( 'Comments on this post are closed.', 'themepacific_gallery' ) ) ) );

		if ( is_user_logged_in() ) {
			$user         = wp_get_current_user();
			$user_id      = $user->ID;
			$display_name = $user->display_name;
			$email        = $user->user_email;
			$url          = $user->user_url;

			if ( empty( $user_id ) )
				die( json_encode( array( 'error' => __( 'Sorry, but we could not authenticate your request.', 'themepacific_gallery' ) ) ) );
		} else {
			$user_id      = 0;
			$display_name = $_POST['author'];
			$email        = $_POST['email'];
			$url          = $_POST['url'];

			if ( get_option( 'require_name_email' ) ) {
				if ( empty( $display_name ) )
					die( json_encode( array( 'error' => __( 'Please provide your name.', 'themepacific_gallery' ) ) ) );

				if ( empty( $email ) )
					die( json_encode( array( 'error' => __( 'Please provide an email address.', 'themepacific_gallery' ) ) ) );

				if ( ! is_email( $email ) )
					die( json_encode( array( 'error' => __( 'Please provide a valid email address.', 'themepacific_gallery' ) ) ) );
			}
		}

		$comment_data =  array(
			'comment_content'      => $comment,
			'comment_post_ID'      => $_post_id,
			'comment_author'       => $display_name,
			'comment_author_email' => $email,
			'comment_author_url'   => $url,
			'comment_approved'     => 0,
			'comment_type'         => '',
		);

		if ( ! empty( $user_id ) )
			$comment_data['user_id'] = $user_id;

		// Note: wp_new_comment() sanitizes and validates the values (too).
		$comment_id = wp_new_comment( $comment_data );
		do_action( 'jp_carousel_post_attachment_comment' );
		$comment_status = wp_get_comment_status( $comment_id );

		if ( true == $switched )
			restore_current_blog();

		die( json_encode( array( 'comment_id' => $comment_id, 'comment_status' => $comment_status ) ) );
	}
	public function section_crn_intro(){
		?>
		<p><?php _e('Tiled Gallery with carousel will completely transform your galleries to new look and your users will love this.', 'themepacific_gallery'); ?></p>
		<p><?php _e('Check out our other free <a href="http://themepacific.com/wp-plugins/?ref=themepacific_jetpack">plugins</a> and <a href="http://themepacific.com/?ref=themepacific_jetpack">themes</a>.', 'themepacific_gallery'); ?></p>
		<?php
		
	}
	function settings_validate($input){

		return $input;
	}

	public function settings_page()	{
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'ThemePacific Tiled Galleries Carousel Without Jetpack!', 'themepacific_gallery' ); ?></h1>


			<!-- Tabs -->
			<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'themepacific_gallery_tab_1'; ?>  

			<div class="nav-tab-wrapper">
				<a href="?page=themepacific_jp_gallery&tab=themepacific_gallery_tab_1" class="nav-tab <?php echo $active_tab == 'themepacific_gallery_tab_1' ? 'nav-tab-active' : ''; ?>">
					<?php esc_html_e( 'Settings', 'themepacific_gallery' ); ?>
				</a>
				<a href="?page=themepacific_jp_gallery&tab=themepacific_gallery_tab_2" class="nav-tab <?php echo $active_tab == 'themepacific_gallery_tab_2' ? 'nav-tab-active' : ''; ?>">
					<?php esc_html_e( 'Our Themes', 'themepacific_gallery' ); ?>
				</a>
				<a href="?page=themepacific_jp_gallery&tab=themepacific_gallery_tab_3" class="nav-tab <?php echo $active_tab == 'themepacific_gallery_tab_3' ? 'nav-tab-active' : ''; ?>">
					<?php esc_html_e( 'Our Plugins', 'themepacific_gallery' ); ?>
				</a>
				<a href="?page=themepacific_jp_gallery&tab=themepacific_gallery_tab_4" class="nav-tab <?php echo $active_tab == 'themepacific_gallery_tab_4' ? 'nav-tab-active' : ''; ?>">
					<?php esc_html_e( 'Support', 'themepacific_gallery' ); ?>
				</a>
			</div>

			<!-- Tab Content -->
			<?php if ( $active_tab == 'themepacific_gallery_tab_1' ) : ?>
				<?php if( isset($_GET['settings-updated']) && $_GET['settings-updated'] ){ ?>
				<div id="setting-error-settings_updated" class="updated settings-error"> 
					<p><strong><?php _e( 'Settings saved.', 'themepacific_gallery' ); ?></strong></p>
				</div>
				<?php } ?>
				<form action="options.php" method="post">
					<?php settings_fields( 'themepacific_jp_gallery' ); ?>
					<?php do_settings_sections( 'themepacific_jp_gallery' ); ?>
					<p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'themepacific_gallery' ); ?>" /></p>
				</form>

			<?php endif;?>

			<?php if ( $active_tab == 'themepacific_gallery_tab_2' ) : ?>


				<div class="four-columns-wrap">

					<p>
						<?php esc_html_e( 'Check out all Free and Premium WordPress Themes. More themes in our site..', 'themepacific_gallery' ); ?>
						
					</p>

					<div class="theme-browser rendered">
						<div class="themes wp-clearfix">


							<div class="theme">
								<a href="https://themepacific.com/">
									<div class="theme-screenshot">
										<img src="<?php echo plugins_url( '/images/preview/bfastmag.jpg', __FILE__ )?>" alt="">
									</div>

									<div class="theme-id-container">
										<h2 class="theme-name" id="newsmagz_pro-name">
										BfastMag</h2>
										<div class="theme-actions">
											<a class="button button-primary customize load-customize hide-if-no-customize" href="https://themepacific.com/">Download</a>

										</div>
									</div>
								</a>
							</div>

							<div class="theme">
								<a href="https://themepacific.com/">
									<div class="theme-screenshot">
										<img src="<?php echo plugins_url( '/images/preview/bresponzive.jpg', __FILE__ )?>" alt="">
									</div>

									<div class="theme-id-container">
										<h2 class="theme-name" id="newsmagz_pro-name">
										Bresponzive</h2>
										<div class="theme-actions">
											<a class="button button-primary customize load-customize hide-if-no-customize" href="https://themepacific.com/">Download</a>

										</div>
									</div>
								</a>
							</div>
							<div class="theme">
								<a href="https://themepacific.com/">
									<div class="theme-screenshot">
										<img src="<?php echo plugins_url( '/images/preview/videozine.jpg', __FILE__ )?>" alt="">
									</div>

									<div class="theme-id-container">
										<h2 class="theme-name" id="newsmagz_pro-name">
										VideoZine</h2>
										<div class="theme-actions">
											<a class="button button-primary customize load-customize hide-if-no-customize" href="https://themepacific.com/">Download</a>

										</div>
									</div>
								</a>
							</div>


						</div>
					</div>



				</div>
			<?php endif;?>

			<?php if ( $active_tab == 'themepacific_gallery_tab_3' ) : ?>

				<div class="three-columns-wrap">

					<br>
					<p><?php esc_html_e( ' Checkout Our WordPress Plugins.', 'themepacific_gallery' ); ?></p>
					<br>

					<?php

				 
					$this->themepacific_gallery_recommended_plugin( 'tiled-gallery-carousel-without-jetpack', 'jetpack-carousel', esc_html__( 'Tiled Gallery Carousel Without JetPack', 'themepacific_gallery' ), esc_html__( 'Tiled Gallery with carousel will completely transform your galleries to new look and your users will love this.', 'themepacific_gallery' ) );	
				 
					$this->themepacific_gallery_recommended_plugin( 'tp-postviews-count-popular-posts-widgets', 'tp_postviews', esc_html__( 'PostViews Count & Popular Posts Widgets', 'themepacific_gallery' ), esc_html__( 'This Plugin based on Post Views will help sites to add post views and show Popular posts in Sidebar or anywhere. .', 'themepacific_gallery' ) );		


					$this->themepacific_gallery_recommended_plugin( 'themepacific-review-lite', 'tpcrn_wpreview', esc_html__( ' WordPress Review', 'themepacific_gallery' ), esc_html__( 'WordPress Review and User Rating Plugin (TP WP Reviews) will help sites to add reviews to get more users without affecting page load speed.  ', 'themepacific_gallery' ) );

					?></div>

				<?php endif;?>
					<?php if ( $active_tab == 'themepacific_gallery_tab_4' ) : ?>
		
					<div class="three-columns-wrap">

				<br>

				<div class="column-wdith-3">
					<h3>
						<span class="dashicons dashicons-sos"></span>
						<?php esc_html_e( 'Forums', 'themepacific_gallery' ); ?>
					</h3>
					<p>
						<?php esc_html_e( 'Before asking a questions it\'s highly recommended to search on forums, but if you can\'t find the solution feel free to create a new topic.', 'themepacific_gallery' ); ?>
						<hr>
						<a target="_blank" href="<?php echo esc_url('https://themepacific.com/support/'); ?>"><?php esc_html_e( 'Go to Support Forums', 'themepacific_gallery' ); ?></a>
					</p>
				</div>
 
 

				<div class="column-wdith-3">
					<h3>
						<span class="dashicons dashicons-smiley"></span>
						<?php esc_html_e( 'Facebook Support', 'themepacific_gallery' ); ?>
					</h3>
					<p>
						<?php esc_html_e( 'Like Our Facebook Page and you can send your suggestions via FB. If you have any issues, send the details.', 'themepacific_gallery' ); ?>
						<hr>
						<a target="_blank" href="<?php echo esc_url('https://www.facebook.com/themepacific/'); ?>"><?php esc_html_e( 'Facebook', 'themepacific_gallery' ); ?></a>
					</p>
				</div>

			</div>
				<?php endif;?>



				<?php
			}
			function register_settings() {
				add_settings_section( 'themepacific_jp_gallery', '', array(&$this, 'section_crn_intro'), 'themepacific_jp_gallery' );

				add_settings_section('carousel_section', __( 'Image Gallery Carousel', 'themepacific_gallery' ), array( $this, 'carousel_section_callback' ), 'themepacific_jp_gallery');

				if ( ! $this->in_jetpack ) {
					add_settings_field('carousel_enable_it', __( 'Enable carousel', 'themepacific_gallery' ), array( $this, 'carousel_enable_it_callback' ), 'themepacific_jp_gallery', 'carousel_section' );
					register_setting( 'themepacific_jp_gallery', 'carousel_enable_it', array( $this, 'carousel_enable_it_sanitize' ) );
				}

				add_settings_field('carousel_background_color', __( 'Background color', 'themepacific_gallery' ), array( $this, 'carousel_background_color_callback' ), 'themepacific_jp_gallery', 'carousel_section' );
				register_setting( 'themepacific_jp_gallery', 'carousel_background_color', array( $this, 'carousel_background_color_sanitize' ) );

				add_settings_field('carousel_display_exif', __( 'Metadata', 'themepacific_gallery'), array( $this, 'carousel_display_exif_callback' ), 'themepacific_jp_gallery', 'carousel_section' );
				register_setting( 'themepacific_jp_gallery', 'carousel_display_exif', array( $this, 'carousel_display_exif_sanitize' ) );

				add_settings_field('comments_display', __( 'Show Comments', 'themepacific_gallery' ), array( $this, 'comments_display_callback' ), 'themepacific_jp_gallery', 'carousel_section' );
				register_setting( 'themepacific_jp_gallery', 'comments_display', array( $this, 'carousel_display_geo_sanitize' ) );

				add_settings_field('fullsize_display', __( 'Show View Fullsize', 'themepacific_gallery' ), array( $this, 'fullsize_display_callback' ), 'themepacific_jp_gallery', 'carousel_section' );
				register_setting( 'themepacific_jp_gallery', 'fullsize_display', array( $this, 'carousel_display_geo_sanitize' ) );

		// No geo setting yet, need to "fuzzify" data first, for privacy
		// add_settings_field('carousel_display_geo', __( 'Geolocation', 'themepacific_gallery' ), array( $this, 'carousel_display_geo_callback' ), 'themepacific_jp_gallery', 'carousel_section' );
		// register_setting( 'themepacific_jp_gallery', 'carousel_display_geo', array( $this, 'carousel_display_geo_sanitize' ) );
			}

// Check if plugin is installed
			function themepacific_gallery_check_installed_plugin( $slug, $filename ) {
				return file_exists( ABSPATH . 'wp-content/plugins/' . $slug . '/' . $filename . '.php' ) ? true : false;
			}

// Generate Recommended Plugin HTML
			function themepacific_gallery_recommended_plugin( $slug, $filename, $name, $description) {

				if ( $slug === 'facebook-pagelike-widget' ) {
					$size = '128x128';
				} else {
					$size = '256x256';
				}

				?>

				<div class="plugin-card">
					<div class="name column-name">
						<h3>
							<?php echo esc_html( $name ); ?>
							<img src="<?php echo esc_url('https://ps.w.org/'. $slug .'/assets/icon-'. $size .'.jpg') ?>" class="plugin-icon" alt="">
						</h3>
					</div>
					<div class="action-links">
						<?php if ( $this->themepacific_gallery_check_installed_plugin( $slug, $filename ) ) : ?>
							<button type="button" class="button button-disabled" disabled="disabled"><?php esc_html_e( 'Installed', 'themepacific_gallery' ); ?></button>
						<?php else : ?>
							<a class="install-now button-primary" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin='. $slug ), 'install-plugin_'. $slug ) ); ?>" >
								<?php esc_html_e( 'Install Now', 'themepacific_gallery' ); ?>
							</a>							
						<?php endif; ?>
					</div>
					<div class="desc column-description">
						<p><?php echo esc_html( $description ); ?></p>
					</div>
				</div>

				<?php
			}
	// Fulfill the settings section callback requirement by returning nothing
			function carousel_section_callback() {
				return;
			}

			function test_1or0_option( $value, $default_to_1 = true ) {
				if ( true == $default_to_1 ) {
			// Binary false (===) of $value means it has not yet been set, in which case we do want to default sites to 1
					if ( false === $value )
						$value = 1;
				}
				return ( 1 == $value ) ? 1 : 0;
			}

			function sanitize_1or0_option( $value ) {
				return ( 1 == $value ) ? 1 : 0;
			}

			function settings_checkbox($name, $label_text, $extra_text = '', $default_to_checked = true) {
				if ( empty( $name ) )
					return;
				$option = $this->test_1or0_option( get_option( $name ), $default_to_checked );
				echo '<fieldset>';
				echo '<input type="checkbox" name="'.esc_attr($name).'" id="'.esc_attr($name).'" value="1" ';
				checked( '1', $option );
				echo '/> <label for="'.esc_attr($name).'">'.$label_text.'</label>';
				if ( ! empty( $extra_text ) )
					echo '<p class="description">'.$extra_text.'</p>';
				echo '</fieldset>';
			}

			function settings_select($name, $values, $extra_text = '') {
				if ( empty( $name ) || ! is_array( $values ) || empty( $values ) )
					return;
				$option = get_option( $name );
				echo '<fieldset>';
				echo '<select name="'.esc_attr($name).'" id="'.esc_attr($name).'">';
				foreach( $values as $key => $value ) {
					echo '<option value="'.esc_attr($key).'" ';
					selected( $key, $option );
					echo '>'.esc_html($value).'</option>';
				}
				echo '</select>';
				if ( ! empty( $extra_text ) )
					echo '<p class="description">'.$extra_text.'</p>';
				echo '</fieldset>';
			}

			function carousel_display_exif_callback() {
				$this->settings_checkbox( 'carousel_display_exif', __( 'Show photo metadata (<a href="http://en.wikipedia.org/wiki/Exchangeable_image_file_format" target="_blank">Exif</a>) in carousel, when available.', 'themepacific_gallery' ) );
			}

			function comments_display_callback() {
				$this->settings_checkbox( 'comments_display', __( 'Show  Comment box Below in the Slideshow.', 'themepacific_gallery' ) );
			}		

			function fullsize_display_callback() {
				$this->settings_checkbox( 'fullsize_display', __( 'Show  View Full size Image Link.', 'themepacific_gallery' ) );
			}

			function carousel_display_exif_sanitize( $value ) {
				return $this->sanitize_1or0_option( $value );
			}

			function carousel_display_geo_callback() {
				$this->settings_checkbox( 'carousel_display_geo', __( 'Show map of photo location in carousel, when available.', 'themepacific_gallery' ) );
			}

			function carousel_display_geo_sanitize( $value ) {
				return $this->sanitize_1or0_option( $value );
			}

			function carousel_background_color_callback() {
				$this->settings_select( 'carousel_background_color', array( 'black' => __( 'Black', 'themepacific_gallery' ), 'white' => __( 'White', 'themepacific_gallery', 'themepacific_gallery' ) ) );
			}

			function carousel_background_color_sanitize( $value ) {
				return ( 'white' == $value ) ? 'white' : 'black';
			}

			function carousel_enable_it_callback() {
				$this->settings_checkbox( 'carousel_enable_it', __( 'Display images in full-size carousel slideshow.', 'themepacific_gallery' ) );
			}

			function carousel_enable_it_sanitize( $value ) {
				return $this->sanitize_1or0_option( $value );
			}
		}

		new themepacific_Jetpack_Carousel;
