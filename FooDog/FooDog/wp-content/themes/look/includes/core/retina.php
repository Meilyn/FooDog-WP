<?php
/**
 * this file support retina feature
 */
if ( ! class_exists( 'look_ruby_retina' ) ) {
	class look_ruby_retina {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * save retina options to database
		 */
		static function save_retina_option() {
			global $look_ruby_theme_options;

			if ( ! empty( $look_ruby_theme_options['retina_support'] ) ) {
				$retina_support = $look_ruby_theme_options['retina_support'];
			} else {
				$retina_support = false;
			};

			delete_option( 'look_ruby_retina_support_option' );
			add_option( 'look_ruby_retina_support_option', $retina_support );
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $metadata
		 * @param $attachment_id
		 *
		 * @return mixed
		 * retina attachment meta data
		 */
		static function retina_attachment_meta( $metadata, $attachment_id ) {
			foreach ( $metadata as $key => $value ) {
				if ( is_array( $value ) ) {
					foreach ( $value as $image => $attr ) {
						if ( is_array( $attr ) && ! empty( $attr['width'] ) && ! empty( $attr['height'] ) ) {
							self::create_retina_image( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
						};
					};
				};
			};

			return $metadata;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param      $file
		 * @param      $width
		 * @param      $height
		 * @param bool $crop
		 *
		 * @return array|bool
		 * create retina images
		 */
		static function create_retina_image( $file, $width, $height, $crop = false ) {
			if ( $width || $height ) {
				$resized_file = wp_get_image_editor( $file );
				if ( ! is_wp_error( $resized_file ) ) {
					$filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );

					$resized_file->resize( $width * 1.5, $height * 1.5, $crop ); //Create *1.5 size for faster loading
					$resized_file->save( $filename );

					$info = $resized_file->get_size();

					return array(
						'file'   => wp_basename( $filename ),
						'width'  => $info['width'],
						'height' => $info['height'],
					);
				};
			};

			return false;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $attachment_id
		 * delete retina image
		 */
		static function delete_retina_image( $attachment_id ) {
			$meta       = wp_get_attachment_metadata( $attachment_id );
			$upload_dir = wp_upload_dir();
			if ( empty( $meta['file'] ) ) {
				return false;
			}
			$path = pathinfo( $meta['file'] );
			if ( is_array( $meta ) ) {
				foreach ( $meta as $key => $value ) {
					if ( 'sizes' === $key ) {
						foreach ( $value as $sizes => $size ) {
							$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
							$retina_filename   = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
							if ( file_exists( $retina_filename ) ) {
								unlink( $retina_filename );
							};
						};
					};
				};
			};
		}
	}
}


//add filter
if ( get_option( 'look_ruby_retina_support_option', false ) ) {
	add_filter( 'wp_generate_attachment_metadata', array( 'look_ruby_retina', 'retina_attachment_meta' ), 10, 2 );
};
add_filter( 'delete_attachment', array( 'look_ruby_retina', 'delete_retina_image' ) );

//save retina options for backend
add_action( 'redux/options/look_ruby_theme_options/saved', array( 'look_ruby_retina', 'save_retina_option' ) );
add_action( 'redux/options/look_ruby_theme_options/reset', array( 'look_ruby_retina', 'save_retina_option' ) );
add_action( 'redux/options/look_ruby_theme_options/section/reset', array( 'look_ruby_retina', 'save_retina_option' ) );