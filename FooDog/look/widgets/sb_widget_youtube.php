<?php
//youtube widget
add_action('widgets_init', 'look_ruby_register_youtube_widget');
function look_ruby_register_youtube_widget()
{
    register_widget('look_ruby_youtube_widget');
}

//register widget
class look_ruby_youtube_widget extends WP_Widget
{

	//register widget
    function __construct()
    {
        $widget_ops = array('classname' => 'youtube-widget', 'description' => esc_attr__('[Sidebar Widget] Display a YouTube SUBSCRIBE box in sidebar sections','look'));
        parent::__construct('look_ruby_youtube_widget', esc_attr__('[SIDEBAR] - Youtube Subscribe', 'look'), $widget_ops);
    }


	//render widget
    function widget($args, $instance)
    {
        extract($args);

        $title = ($instance['title'])? esc_attr($instance['title']) : '';
        $url = ($instance['url'])? $instance['url'] : '';
        echo $before_widget;
        if (!empty($title)){
	        echo $before_title . esc_attr( $title ) . $after_title;
        } ?>
        <div class="subscribe-youtube-wrap">
            <iframe id="youtube" src="http://www.youtube.com/subscribe_widget?p=<?php echo esc_attr($url) ?>"></iframe>
        </div>
        <?php
        echo $after_widget;
    }


    //update forms
    function update($new_instance, $old_instance)
    {
	    $instance          = $old_instance;
	    $instance['title'] = strip_tags( $new_instance['title'] );
	    $instance['url']   = strip_tags( $new_instance['url'] );

	    return $instance;
    }


    //form settings
    function form($instance)
    {
	    $defaults = array( 'title' => esc_attr__( 'Subscribe to our Channel', 'look' ), 'url' => '' );
	    $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title :','look'); ?></label>
            <input  type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php if (!empty($instance['title'])) echo esc_attr($instance['title']); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php esc_attr_e('Channel Name:','look') ?></label>
            <input  type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" value="<?php if (!empty($instance['url'])) echo esc_attr($instance['url']); ?>"/>
        </p>
    <?php
    }
}
