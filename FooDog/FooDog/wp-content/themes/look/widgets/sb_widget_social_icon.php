<?php
//social widget
add_action( 'widgets_init', 'look_ruby_register_social_widget' );

function look_ruby_register_social_widget() {
	register_widget( 'look_ruby_social_widget' );
}


class look_ruby_social_widget extends WP_Widget {

	//register widget
	function __construct() {
		$widget_ops = array(
			'classname'   => 'social-bar-widget',
			'description' => esc_attr__( '[Sidebar Widget] Display social icon in sidebar sections', 'look' )
		);
		parent::__construct( 'look_ruby_social_widget', esc_attr__( '[SIDEBAR] - Social Bar Icon', 'look' ), $widget_ops );
	}


	//render widget
	function widget( $args, $instance ) {
		extract( $args );
		$title   = ( ! empty( $instance['title'] ) ) ? esc_attr( $instance['title'] ) : '';
		$new_tab = ( ! empty( $instance['new_tab'] ) ) ? $instance['new_tab'] : true;
		$enable_icon_color = ( ! empty( $instance['enable_color'] ) ) ? $instance['enable_color'] : false;


		if ( ! empty( $new_tab ) ) {
			$new_tab = true;
		} else {
			$new_tab = false;
		}

		$website_social_data = look_ruby_social_data::web_data();

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . esc_attr( $title ) . $after_title;
		} ?>

		<div class="widget-social-link-info">
			<?php echo  look_ruby_social_bar::render( $website_social_data, '', $new_tab , $enable_icon_color ); ?>
		</div>

        <?php echo $after_widget;
    }

	
	function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['new_tab']      = strip_tags( $new_instance['new_tab'] );
		$instance['enable_color'] = strip_tags( $new_instance['enable_color'] );

		return $instance;
	}

	
    function form($instance) {
	    $defaults = array( 'title' => esc_attr__( 'find me on socials','look' ), 'new_tab' => true, 'enable_color' => true );
	    $instance = wp_parse_args( (array) $instance, $defaults );
	    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title :','look') ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php if (!empty($instance['title'])) echo esc_attr($instance['title']); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('new_tab')); ?>"><?php esc_attr_e('Open in new tab','look'); ?></label>
            <input class="widefat" type="checkbox" id="<?php echo esc_attr($this->get_field_id('new_tab')); ?>" name="<?php echo esc_attr($this->get_field_name('new_tab')); ?>" value="true" <?php if (!empty($instance['new_tab'])) echo 'checked="checked"'; ?>  />
        </p>
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('enable_color')); ?>"><?php esc_attr_e('Enable icon color','look'); ?></label>
		    <input class="widefat" type="checkbox" id="<?php echo esc_attr($this->get_field_id('enable_color')); ?>" name="<?php echo esc_attr($this->get_field_name('enable_color')); ?>" value="true" <?php if (!empty($instance['enable_color'])) echo 'checked="checked"'; ?>  />
	    </p>
	    <p><?php echo html_entity_decode(esc_html__( 'To set social link, Please go to: <strong>THEME OPTIONS -> Share & Socials -> Site Social Profiles</strong>', 'look' )); ?></p>
    <?php
    }
}
