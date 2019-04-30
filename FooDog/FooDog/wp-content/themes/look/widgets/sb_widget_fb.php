<?php
add_action('widgets_init', 'look_ruby_register_fanpage_widget');

function look_ruby_register_fanpage_widget()
{
	register_widget('look_ruby_fanpage_fb');
}

class look_ruby_fanpage_fb extends WP_Widget
{

	//register widget
	function __construct()
	{
		$widget_ops = array('classname' => 'ruby-fb-widget', 'description' => esc_html__('[Sidebar Widget] Display Facebook Like box in sidebar sections', 'look'));

		/* Create the widget. */
		parent::__construct('look_ruby_fanpage_widget', esc_html__('[SIDEBAR] - Facebook Like', 'look'), $widget_ops);
	}


	//render widget
	function widget($args, $instance)
	{
		extract($args);
		$title = ($instance['title']) ? apply_filters('title', $instance['title']): '';
		$title = esc_attr($title);
		$page_url = ($instance['page_url']) ? apply_filters('page_url', $instance['page_url']) : NULL;

		if ($page_url):
			echo $before_widget;
			if ( ! empty( $title ) ) {
				echo $before_title . esc_attr( $title ) . $after_title;
			}?>

			<div class="fb-container">
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s); js.id = id;
						js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1385724821660962";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-page" data-href="<?php echo esc_url($page_url);?>" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
			</div>


			<?php
			echo $after_widget;
		endif;
	}


	//update forms
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		return $instance;
	}


	//form settings
	function form($instance)
	{
		$defaults = array( 'title' => esc_html__( 'Find us on Facebook', 'look' ), 'page_url' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong><?php esc_html_e('Title:', 'look'); ?></strong></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('page_url')); ?>"><strong><?php esc_html_e('Fanpage Fb URL:', 'look') ?></strong></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('page_url')); ?>" name="<?php echo esc_attr($this->get_field_name('page_url')); ?>" value="<?php echo esc_url($instance['page_url']); ?>"/>
		</p>
	<?php
	}
}
