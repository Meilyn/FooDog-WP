<?php
add_action( 'widgets_init', 'look_ruby_register_sb_social_counter' );

function look_ruby_register_sb_social_counter() {
	register_widget( 'look_ruby_sb_social_counter' );
}


class look_ruby_sb_social_counter extends WP_Widget {

	//register widget
	function __construct() {
		$widget_ops = array(
			'classname'   => 'sb-widget-social-counter',
			'description' => esc_html__( '[Sidebar Widget] Display number of social followers in sidebar sections', 'look'
			)
		);

		parent::__construct( 'look_ruby_sb_social_counter_widget', esc_html__( '[SIDEBAR] - Social Counter', 'look' ), $widget_ops );
	}

	//render widget
	function widget( $args, $instance ) {
		extract( $args );

		$title           = ( ! empty( $instance['title'] ) ) ? esc_attr( $instance['title'] ) : '';
		$facebook_page   = ( ! empty( $instance['facebook_page'] ) ) ? $instance['facebook_page'] : '';
		$youtube_user    = ( ! empty( $instance['youtube_user'] ) ) ? $instance['youtube_user'] : '';
		$youtube_channel = ( ! empty( $instance['youtube_channel'] ) ) ? $instance['youtube_channel'] : '';
		$dribbble_user   = ( ! empty( $instance['dribbble_user'] ) ) ? $instance['dribbble_user'] : '';
		$dribbble_token  = ( ! empty( $instance['dribbble_token'] ) ) ? $instance['dribbble_token'] : '';
		$soundcloud_user = ( ! empty( $instance['soundcloud_user'] ) ) ? $instance['soundcloud_user'] : '';
		$soundcloud_api  = ( ! empty( $instance['soundcloud_api'] ) ) ? $instance['soundcloud_api'] : '';
		$instagram_api   = ( ! empty( $instance['instagram_api'] ) ) ? $instance['instagram_api'] : '';
		$twitter_user    = ( ! empty( $instance['twitter_user'] ) ) ? $instance['twitter_user'] : '';
		$pinterest_user  = ( ! empty( $instance['pinterest_user'] ) ) ? $instance['pinterest_user'] : '';
		$vimeo_user      = ( ! empty( $instance['vimeo_user'] ) ) ? $instance['vimeo_user'] : '';

		echo $before_widget;

		if ( ! empty( $title ) ) {
			echo $before_title . esc_attr($title) . $after_title;
		}

		?>
		<div class="sb-social-counter social-counter-wrap">

			<?php
			//facebook counter
			if ( ! empty( $facebook_page ) ) :
				$option['facebook_page'] = $facebook_page;
				$facebook_count          = look_ruby_social_fan::get_sidebar_social_counter( 'facebook_page', $option );
				?>
				<div class="counter-element bg-facebook">
					<a target="_blank" href="http://facebook.com/<?php echo urlencode($facebook_page); ?>" class="facebook" title="facebook">
						<span class="counter-element-left">
							<i class="fa fa-facebook"></i>
							<span class="num-count"><?php echo esc_attr(look_ruby_core::show_over_100k($facebook_count)); ?></span>
							<span class="text-count"><?php esc_html_e('fans', 'look'); ?></span>
						</span>
						<span class="counter-element-right"><?php esc_html_e('like','look'); ?></span>
					</a>
				</div><!--facebook like count -->
			<?php  endif;

			//twitter counter
			if ( ! empty( $twitter_user ) ) :
				$option['twitter_user'] = $twitter_user;
				$twitter_count          = look_ruby_social_fan::get_sidebar_social_counter( 'twitter', $option );
				?>
				<div class="counter-element bg-twitter">
					<a target="_blank" href="http://twitter.com/<?php echo urlencode($twitter_user); ?>" class="twitter" title="twitter">
						<span class="counter-element-left">
							<i class="fa fa-twitter"></i>
							<span class="num-count"><?php echo esc_attr(look_ruby_core::show_over_100k($twitter_count)); ?></span>
							<span class="text-count"><?php esc_html_e('followers', 'look'); ?></span>
						</span>
						<span class="counter-element-right"><?php esc_html_e('follow','look'); ?></span>
					</a>
				</div><!--twitter follower count -->
			<?php endif;


			if ( ! empty( $pinterest_user ) ) :
				$option['pinterest_user'] = $pinterest_user;
				$pinterest_count  = look_ruby_social_fan::get_sidebar_social_counter( 'pinterest', $option );
				?>
				<div class="counter-element bg-pinterest">
					<a target="_blank" href="http://pinterest.com/<?php echo urlencode($pinterest_user); ?>" class="pinterest" title="pinterest">
						<span class="counter-element-left">
						<i class="fa fa-pinterest"></i>
						<span class="num-count"><?php echo esc_attr(look_ruby_core::show_over_100k($pinterest_count)); ?></span>
						<span class="text-count"><?php esc_html_e('followers', 'look'); ?></span>
						</span>
						<span class="counter-element-right"><?php esc_html_e('pin','look'); ?></span>
					</a>
				</div><!--pinterest follower count -->
			<?php endif;

			//instgarm counter
			if (!empty($instagram_api)):
				$option['instagram_api'] = $instagram_api;
				$data_instagram = look_ruby_social_fan::get_sidebar_social_counter('instagram', $option);
				if ( empty( $data_instagram ) ) {
					$data_instagram = array(
						'count'     => 0,
						'user_name' => '',
						'url'       => '',
					);
				};
				?>
				<div class="counter-element bg-instagram">
					<a target="_blank" href="<?php echo esc_url($data_instagram['url']) ?>" title="instagram">
						<span class="counter-element-left">
						<i class="fa fa-instagram"></i>
						<span class="num-count"><?php echo esc_attr(look_ruby_core::show_over_100k($data_instagram['count'])); ?></span>
						<span class="text-count"><?php esc_html_e('Followers', 'look'); ?></span>
						</span>
						<span class="counter-element-right"><?php esc_html_e('follow','look'); ?></span>
					</a>
				</div><!--instagram follower count -->

			<?php endif;

			//youtube counter
			if ( ! empty( $youtube_user ) || !empty($youtube_channel) ) :
				$option['youtube_user'] = $youtube_user;
				$option['youtube_channel'] = $youtube_channel;
				$youtube_count          = look_ruby_social_fan::get_sidebar_social_counter( 'youtube', $option );
				?>
				<div class="counter-element bg-youtube">
					<a target="_blank" href="http://www.youtube.com/user/<?php echo esc_attr($youtube_user); ?>" title="<?php esc_html_e('Youtube', 'look'); ?>">
						<span class="counter-element-left">
						<i class="fa fa-youtube"></i>
						<span class="num-count"><?php echo esc_attr(look_ruby_core::show_over_100k($youtube_count)); ?></span>
						<span class="text-count"><?php esc_html_e('Subscribers', 'look'); ?></span>
						</span>
						<span class="counter-element-right"><?php esc_html_e('subscribe','look'); ?></span>
					</a>
				</div><!--youtube subscribers count -->
			<?php endif;

			//soundcloud counter
			if ( ! empty( $soundcloud_user ) && ! empty( $soundcloud_api ) ):
				$option['soundcloud_user'] = $soundcloud_user;
				$option['soundcloud_api']  = $soundcloud_api;
				$soundcloud_data           = look_ruby_social_fan::get_sidebar_social_counter( 'soundcloud', $option );
				if ( empty( $soundcloud_data ) ) {
					$soundcloud_data = array(
						'url'   => '',
						'count' => ''
					);
				}
				?>
				<div class="counter-element bg-soundcloud">
					<a target="_blank" href="<?php echo esc_url($soundcloud_data['url']); ?>" title="<?php esc_html_e('soundclound', 'look'); ?>">
						<span class="counter-element-left">
						<i class="fa fa-soundcloud"></i>
						<span class="num-count"><?php echo esc_attr(look_ruby_core::show_over_100k($soundcloud_data['count'])); ?></span>
						<span class="text-count"><?php esc_html_e('Followers', 'look'); ?></span>
						</span>
						<span class="counter-element-right"><?php esc_html_e('follow','look'); ?></span>
					</a>

				</div><!--soundcloud follower count -->
			<?php endif;

			//vimeo counter
			if ( ! empty( $vimeo_user ) ) :
				$option['vimeo_user'] = $vimeo_user;
				$vimeo_count          = look_ruby_social_fan::get_sidebar_social_counter( 'vimeo', $option );
				?>
				<div class="counter-element bg-vimeo">
					<a target="_blank" href="https://vimeo.com/<?php echo esc_attr($vimeo_user); ?>" title="vimeo">
						<span class="counter-element-left">
						<i class="fa fa-vimeo"></i>
						<span class="num-count"><?php echo esc_attr(look_ruby_core::show_over_100k($vimeo_count)); ?></span>
						<span class="text-count"><?php esc_html_e('Likes', 'look'); ?></span>
						</span>
						<span class="counter-element-right"><?php esc_html_e('like','look'); ?></span>
					</a>
				</div><!--vimeo follower count -->
			<?php endif;

			//dribbble counter
			if ( ! empty( $dribbble_user ) || !empty($dribbble_token) ) :
				$option['dribbble_user'] = $dribbble_user;
				$option['dribbble_token'] = $dribbble_token;
				$dribbble_count          = look_ruby_social_fan::get_sidebar_social_counter( 'dribbble', $option );
				?>
				<div class="counter-element bg-dribbble">
					<a target="_blank" href="http://dribbble.com/<?php echo esc_attr($dribbble_user); ?>" title="<?php esc_html_e('dribbble', 'look'); ?>">
						<span class="counter-element-left">
						<i class="fa fa-dribbble"></i>
						<span class="num-count"><?php echo esc_attr(look_ruby_core::show_over_100k($dribbble_count)); ?></span>
						<span class="text-count"><?php esc_html_e('Followers', 'look'); ?></span>
						</span>
						<span class="counter-element-right"><?php esc_html_e('follow','look'); ?></span>
					</a>

				</div><!--dribbble follower count -->
			<?php endif; ?>

		</div><!-- #social count wrap -->

		<?php
		echo $after_widget;
	}
	

	//update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//remove cache
		delete_transient( 'look_ruby_sb_social_fan_facebook_page' );
		delete_transient( 'look_ruby_sb_social_fan_twitter' );
		delete_transient( 'look_ruby_sb_social_fan_pinterest' );
		delete_transient( 'look_ruby_sb_social_fan_instagram' );
		delete_transient( 'look_ruby_sb_social_fan_youtube' );
		delete_transient( 'look_ruby_sb_social_fan_soundcloud' );
		delete_transient( 'look_ruby_sb_social_fan_vimeo' );
		delete_transient( 'look_ruby_sb_social_fan_dribbble' );

		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['facebook_page']   = strip_tags( $new_instance['facebook_page'] );
		$instance['twitter_user']    = strip_tags( $new_instance['twitter_user'] );
		$instance['youtube_user']    = strip_tags( $new_instance['youtube_user'] );
		$instance['youtube_channel'] = strip_tags( $new_instance['youtube_channel'] );
		$instance['dribbble_user']   = strip_tags( $new_instance['dribbble_user'] );
		$instance['dribbble_token']  = strip_tags( $new_instance['dribbble_token'] );
		$instance['soundcloud_user'] = strip_tags( $new_instance['soundcloud_user'] );
		$instance['soundcloud_api']  = strip_tags( $new_instance['soundcloud_api'] );
		$instance['instagram_api']   = strip_tags( $new_instance['instagram_api'] );
		$instance['pinterest_user']  = strip_tags( $new_instance['pinterest_user'] );
		$instance['vimeo_user']      = strip_tags( $new_instance['vimeo_user'] );

		return $instance;
	}

	//form setting
	function form( $instance ) {

		$defaults = array(
			'title'           => esc_html__( 'stay connected', 'look' ),
			'youtube_user'    => '',
			'youtube_channel' => '',
			'dribbble_user'   => '',
			'dribbble_token'  => '',
			'twitter_user'    => '',
			'facebook_page'   => '',
			'soundcloud_user' => '',
			'soundcloud_api'  => '',
			'pinterest_user'  => '',
			'instagram_api'   => '',
			'vimeo_user'      => ''

		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title:','look') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php if(!empty($instance['title'])) echo esc_attr($instance['title']); ?>" />
		</p>
		<!--facebook -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook_page' )); ?>"><strong><?php esc_attr_e('Facebook Page Name:', 'look');?></strong></label>
			<input type="text" class="widefat"   id="<?php echo esc_attr($this->get_field_id( 'facebook_page' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook_page' )); ?>" value="<?php echo esc_attr($instance['facebook_page']); ?>" />
		</p>
		<!--twitter -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter_user' )); ?>"><strong><?php esc_attr_e('Twitter Name:', 'look');?></strong></label>
			<input type="text"  class="widefat"  id="<?php echo esc_attr($this->get_field_id( 'twitter_user' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter_user' )); ?>" value="<?php echo esc_attr($instance['twitter_user']); ?>"/>
		</p>
		<!--pinterest -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest_user' )); ?>"><strong><?php esc_attr_e('Pinterest User Name:','look');?></strong> </label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'pinterest_user' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest_user' )); ?>" value="<?php echo esc_attr($instance['pinterest_user']); ?>"/>
		</p>
		<!--instagram -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'instagram_api' )); ?>"><strong><?php esc_attr_e('Instagram Access Token Key:','look') ?></strong> </label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'instagram_api' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram_api' )); ?>" value="<?php echo esc_textarea($instance['instagram_api']); ?>"/>
		</p>
		<p><?php echo html_entity_decode( esc_html__( 'How to Create an app and generate your Instagram access token on: <a target="_blank" href="http://instagram.themeruby.com/">Instagram access token tutorial</a> website</p>', 'look' ) ); ?>
		<!--youtube -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'youtube_user' )); ?>"><strong><?php esc_attr_e('Youtube User Name:', 'look');?></strong></label>
			<input type="text"  class="widefat" id="<?php echo esc_attr($this->get_field_id( 'youtube_user' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube_user' )); ?>" value="<?php echo esc_attr($instance['youtube_user']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'youtube_channel' )); ?>"><strong><?php esc_attr_e('Youtube Channel ID:', 'look');?></strong></label>
			<input type="text"  class="widefat" id="<?php echo esc_attr($this->get_field_id( 'youtube_channel' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube_channel' )); ?>" value="<?php echo esc_attr($instance['youtube_channel']); ?>"/>
		</p>
		<p><?php esc_attr_e('Use channel ID if you can not enough subscriber to create username for channel. Make sure leave blank user name when input channel ID.','look') ?></p>
		<!--sound cloud-->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'soundcloud_user' )); ?>"><strong><?php esc_attr_e('SoundCloud User Name:','look');?></strong> </label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'soundcloud_user' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'soundcloud_user' )); ?>" value="<?php echo esc_attr($instance['soundcloud_user']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'soundcloud_api' )); ?>"><?php esc_attr_e('Soundcloud API Key(Client ID) :','look') ?> </label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'soundcloud_api' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'soundcloud_api' )); ?>" value="<?php echo esc_attr($instance['soundcloud_api']); ?>"/>
		</p>
		<p><a target="_blank" href="http://soundcloud.com/you/apps/"><?php esc_attr_e('Generate your soundcloud app','look') ?></a></p>
		<!--vimeo -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'vimeo_user' )); ?>"><strong><?php esc_attr_e('Vimeo User Name:','look');?></strong> </label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'vimeo_user' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vimeo_user' )); ?>" value="<?php echo esc_attr($instance['vimeo_user']); ?>"/>
		</p>
		<!--dribbble -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'dribbble_user' )); ?>"><strong><?php esc_attr_e('Dribbble User Name:', 'look');?></strong></label>
			<input type="text"  class="widefat" id="<?php echo esc_attr($this->get_field_id( 'dribbble_user' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribbble_user' )); ?>" value="<?php echo esc_attr($instance['dribbble_user']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'dribbble_token' )); ?>"><strong><?php esc_attr_e('Dribbble Token (Client Access Token):', 'look');?></strong></label>
			<input type="text"  class="widefat" id="<?php echo esc_attr($this->get_field_id( 'dribbble_token' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribbble_token' )); ?>" value="<?php echo esc_attr($instance['dribbble_token']); ?>" />
		</p>
		<p><a target="_blank" href="https://dribbble.com/account/applications/new"><?php esc_attr_e('Generate your dribbble app','look') ?></a></p>
	<?php
	}
} 