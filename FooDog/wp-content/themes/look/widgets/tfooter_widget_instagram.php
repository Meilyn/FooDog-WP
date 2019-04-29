<?php

//footer instagram widget
add_action( 'widgets_init', 'look_ruby_register_tfooter_instagram' );

function look_ruby_register_tfooter_instagram() {
	register_widget( 'look_ruby_tfooter_instagram' );
}

//setup
class look_ruby_tfooter_instagram extends WP_Widget {

	//register widget
	function __construct() {
		$widget_ops = array(
			'classname'   => 'top-footer-widget-instagram',
			'description' => esc_html__( '[Top Footer Widget] Display Instagram image gird in top footer section', 'look' )
		);
		parent::__construct( 'look_ruby_tfooter_instagram', esc_html__( '[TOP FOOTER] - Instagram Grid*', 'look' ), $widget_ops );
	}

	//render widget
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		$title           = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$instagram_token = ( ! empty( $instance['instagram_token'] ) ) ? $instance['instagram_token'] : '';
		$num_images      = ( ! empty( $instance['num_image'] ) ) ? $instance['num_image'] : '';
		$num_column      = ( ! empty( $instance['num_column'] ) ) ? $instance['num_column'] : 'col-xs-3';
		$click_popup     = ( ! empty( $instance['click_popup'] ) ) ? $instance['click_popup'] : '';
		$max_width       = ( ! empty( $instance['max_width'] ) ) ? $instance['max_width'] : '';
		$tag             = ( ! empty( $instance['tag'] ) ) ? strip_tags( $instance['tag'] ) : '';

		//create class
		if ( 'wrapper' == $max_width ) {
			$max_width = 'ruby-container';
		} else {
			$max_width = '';
		}

		//render
		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . esc_attr( $title ) . $after_title;
		}

		$data_images = get_transient( 'look_ruby_tfooter_instagram_cache' );

		if ( empty( $data_images ) ) {
			$data_images = look_ruby_instagram_data::get_data( $instagram_token, 'look_ruby_tfooter_instagram_cache', $num_images, $tag );
		} ?>

		<?php if ( ! empty( $data_images->data ) ) : ?>
			<div class="instagram-content-wrap row <?php echo ' ' . $max_width; ?>">
				<?php foreach ($data_images->data as $post_data) : ?>
					<div class="footer-instagram-el <?php echo esc_attr($num_column) ?>">

						<?php if ( ! empty( $click_popup ) )  : ?>
							<a href="<?php echo esc_url($post_data->images->standard_resolution->url) ?>" class="instagram-popup-el cursor-zoom" data-source="<?php if(!empty($post_data->user->username)){ echo esc_attr($post_data->user->username); } ?>"><img src="<?php echo esc_url($post_data->images->low_resolution->url) ?>" alt=""></a>
						<?php else : ?>
							<a href="<?php echo esc_html( $post_data->link ); ?>" target="_blank"><img src="<?php echo esc_url($post_data->images->low_resolution->url) ?>" alt=""></a>
						<?php endif; ?>

					</div>
				<?php endforeach; ?>
			</div>

			<?php if ( ! empty( $click_popup ) ) {
				//popup image
				wp_localize_script( 'look_ruby_main_script', 'look_ruby_tfooter_instagram_popup', '1' );
			} ?>

		<?php else : ?>
			<?php if ( is_string( $data_images ) ) : ?>
				<div class="is-center"><?php echo( strval( $data_images ) ); ?></div>
			<?php endif; ?>
		<?php endif; ?>

		<?php  echo $after_widget;
	}


	//update forms
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		delete_transient( 'look_ruby_tfooter_instagram_cache' );

		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['instagram_token'] = strip_tags( $new_instance['instagram_token'] );
		$instance['num_image']       = absint( strip_tags( $new_instance['num_image'] ) );
		$instance['num_column']      = strip_tags( $new_instance['num_column'] );
		$instance['max_width']       = strip_tags( $new_instance['max_width'] );
		$instance['click_popup']     = strip_tags( $new_instance['click_popup'] );
		$instance['tag']             = strip_tags( $new_instance['tag'] );

		return $instance;
	}


	//form settings
	function form( $instance ) {
		$defaults = array(
			'title'           => esc_html__( 'Follow @ Instagram', 'look' ),
			'max_width'       => 'full',
			'instagram_token' => '',
			'num_image'       => 7,
			'num_column'      => 'ruby-col-7',
			'click_popup'     => '',
			'tag'             => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p><?php echo html_entity_decode( esc_html__( 'How to Create an app and generate your Instagram access token on: <a target="_blank" href="http://instagram.themeruby.com/">Instagram access token tutorial</a> website</p>', 'look' ) ); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong><?php esc_html_e('Title:', 'look') ?></strong></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('instagram_token')); ?>"><strong><?php esc_html_e('Instagram Access Token:', 'look') ?></strong></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram_token')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram_token')); ?>" type="text" value="<?php echo esc_attr($instance['instagram_token']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('num_image')); ?>"><strong><?php esc_html_e('Limit Image Number:', 'look') ?></strong></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('num_image')); ?>" name="<?php echo esc_attr($this->get_field_name('num_image')); ?>" type="text" value="<?php echo esc_attr($instance['num_image']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('tag')); ?>"><strong><?php esc_attr_e('Display Image With Tag:', 'look') ?></strong><span><?php echo esc_html__( ' (Leave blank if you want display your images)', 'look' ); ?></span></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tag')); ?>" name="<?php echo esc_attr($this->get_field_name('tag')); ?>" type="text" value="<?php echo esc_attr($instance['tag']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'num_column' )); ?>"><strong><?php esc_html_e('Number of Columns:', 'look'); ?></strong></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'num_column' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'num_column' )); ?>" >
				<option value="col-xs-3" <?php if( !empty($instance['num_column']) && $instance['num_column'] == 'col-xs-3' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e('4 columns', 'look'); ?></option>
				<option value="ruby-col-5" <?php if( !empty($instance['num_column']) && $instance['num_column'] == 'ruby-col-5' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e('5 columns', 'look'); ?></option>
				<option value="col-xs-2" <?php if( !empty($instance['num_column']) && $instance['num_column'] == 'col-xs-2' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e('6 columns', 'look'); ?></option>
				<option value="ruby-col-7" <?php if( !empty($instance['num_column']) && $instance['num_column'] == 'ruby-col-7' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e('7 columns', 'look'); ?></option>
				<option value="ruby-col-8" <?php if( !empty($instance['num_column']) && $instance['num_column'] == 'ruby-col-8' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e('8 columns', 'look'); ?></option>
				<option value="ruby-col-9" <?php if( !empty($instance['num_column']) && $instance['num_column'] == 'ruby-col-9' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e('9 columns', 'look'); ?></option>
				<option value="ruby-col-10" <?php if( !empty($instance['num_column']) && $instance['num_column'] == 'ruby-col-10' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e('10 columns', 'look'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'max_width' )); ?>"><strong><?php esc_html_e('Width of Grid:', 'look'); ?></strong></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'max_width' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'max_width' )); ?>" >
				<option value="full" <?php if( !empty($instance['max_width']) && $instance['max_width'] == 'full' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e('Full Width', 'look'); ?></option>
				<option value="wrapper" <?php if( !empty($instance['max_width']) && $instance['max_width'] == 'wrapper' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e('Has Wrapper', 'look'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'click_popup' )); ?>"><?php esc_html_e('Popup When Click:','look') ?></label>
			<input class="widefat" type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'click_popup' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'click_popup' )); ?>" value="checked" <?php if( !empty( $instance['click_popup'] ) ) echo 'checked="checked"'; ?>  />
		</p>

	<?php
	}
}



