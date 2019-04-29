<?php
//ads widget
function look_ruby_register_subscribe_widget()
{
    register_widget('look_ruby_sb_subscribe_widget');
}
//register widget
class look_ruby_sb_subscribe_widget extends WP_Widget
{
	//register widget
    function __construct()
    {
        $widget_ops = array('classname' => 'sb-widget-subscribe', 'description' => esc_html__('[Sidebar Widget] Display subscribe form, support MailChimp for WP plugin', 'look'));
        parent::__construct('look_ruby_sb_subscribe_widget', esc_html__('[SIDEBAR] - Subscribe Box', 'look'), $widget_ops);
    }


	//render widget
    function widget($args, $instance)
    {
	    extract( $args );
	    $title               = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
	    $form_background     = ( ! empty( $instance['form_background'] ) ) ? $instance['form_background'] : '';
	    $subscribe_shortcode = ( ! empty( $instance['subscribe_shortcode'] ) ) ? $instance['subscribe_shortcode'] : '';


	    echo $before_widget;
	    ?>

	    <div class="subscribe-wrap">
		    <div class="subscribe-title-wrap"><h3><?php echo esc_html( $title ) ?></h3></div>
		    <div class="subscribe-content-wrap">
			    <?php if(!empty($form_background)) : ?>
			    <div class="subscribe-image"><img src="<?php echo esc_url( $form_background ) ?>" alt="subscribe"></div>
	            <?php endif; ?>
			    <div class="subscribe-form-wrap">
				    <?php echo do_shortcode( $subscribe_shortcode ); ?>
			    </div>
		    </div>
	    </div>

        <?php  echo $after_widget;
    }


    //update forms
    function update($new_instance, $old_instance)
    {
	    $instance                        = $old_instance;
	    $instance['title']               = strip_tags( $new_instance['title'] );
	    $instance['form_background']     = strip_tags( $new_instance['form_background'] );
	    $instance['subscribe_shortcode'] = strip_tags( $new_instance['subscribe_shortcode'] );
        return $instance;
    }


	//form settings
	function form($instance)
	{
		$defaults = array(
			'title'               => esc_html__('get even more','look'),
			'form_background'     => '',
			'subscribe_shortcode' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong><?php esc_html_e('Title:', 'look'); ?></strong></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('form_background')); ?>"><?php esc_html_e('Form Background URL:', 'look'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('form_background')); ?>" name="<?php echo esc_attr($this->get_field_name('form_background')); ?>" value="<?php echo esc_attr($instance['form_background']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('subscribe_shortcode')); ?>"><?php esc_html_e('Subscribe shortcode:', 'look'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('subscribe_shortcode')); ?>" name="<?php echo esc_attr($this->get_field_name('subscribe_shortcode')); ?>" type="text" value="<?php if( !empty($instance['subscribe_shortcode']) ) echo  esc_attr($instance['subscribe_shortcode']); ?>"/>
		</p>
	<?php
	}
}

add_action('widgets_init', 'look_ruby_register_subscribe_widget');
