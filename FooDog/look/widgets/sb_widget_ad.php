<?php
//ads widget
function look_ruby_register_ads_widget()
{
    register_widget('look_ruby_sb_ad_widget');
}
//register widget
class look_ruby_sb_ad_widget extends WP_Widget
{
	//register widget
    function __construct()
    {
        $widget_ops = array('classname' => 'sb-widget-ad', 'description' => esc_html__('[Sidebar Widget] Display your custom ads, your banner JS or Google Adsense code, Support Google Ads Responsive', 'look'));
        parent::__construct('look_ruby_sb_ad_widget', esc_html__('[SIDEBAR] - Advertisement Box', 'look'), $widget_ops);
    }


	//render widget
    function widget($args, $instance)
    {
	    extract( $args );
	    $title      = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
	    $ad_title   = ( ! empty( $instance['ad_title'] ) ) ? $instance['ad_title'] : '';
	    $url        = ( ! empty( $instance['url'] ) ) ? $instance['url'] : '';
	    $img        = ( ! empty( $instance['image_url'] ) ) ? $instance['image_url'] : '';
	    $google_ads = ( ! empty( $instance['google_ads'] ) ) ? $instance['google_ads'] : '';

	    echo $before_widget;
	    if ( ! empty( $title ) ) {
		    echo $before_title . esc_attr( $title ) . $after_title;
	    }?>

        <div class="widget-ad-content-wrap clearfix">
	        <?php if ( ! empty( $ad_title ) ) : ?>
		        <div class="ad-title"><span><?php echo esc_html( $ad_title ); ?></span></div>
	        <?php endif; ?>
          <?php if(!empty($img)) : ?>
	          <div class="widget-ad-image">
            <?php if (!empty($url)) : ?>
                    <a class="widget-ad-link" target="_blank" href="<?php echo esc_url($url); ?>"><img class="ads-image" src="<?php echo esc_url($img); ?>" alt="<?php bloginfo('name') ?>"></a>
                <?php else : ?>
                    <img class="widget-ad-image-url" src="<?php echo esc_url($img); ?>" alt="<?php bloginfo('name') ?>">
                <?php endif; ?>
	          </div><!--# image ads -->
           <?php else : ?>
	          <div class="widget-ad-script">
		          <?php if ( ! empty( $google_ads ) ) {
			          echo html_entity_decode( stripcslashes( look_ruby_ad_support::render_google_ads( $google_ads, 'sidebar_ad' ) ) );
		          } ?>
	          </div>
            <?php endif; ?>
          </div>

        <?php  echo $after_widget;
    }


    //update forms
    function update($new_instance, $old_instance)
    {
	    $instance               = $old_instance;
	    $instance['title']      = strip_tags( $new_instance['title'] );
	    $instance['ad_title']      = strip_tags( $new_instance['ad_title'] );
	    $instance['url']        = strip_tags( $new_instance['url'] );
	    $instance['image_url']  = strip_tags( $new_instance['image_url'] );
	    $instance['google_ads'] = esc_js( $new_instance['google_ads'] );
        return $instance;
    }


	//form settings
	function form($instance)
	{
		$defaults = array(
			'title'      => '',
			'ad_title'   => esc_attr__( '- Advertisement -', 'look' ),
			'url'        => '',
			'image_url'  => '',
			'google_ads' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong><?php esc_html_e('Title:', 'look'); ?></strong></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('ad_title')); ?>"><?php esc_html_e('Ad Title:', 'look'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('ad_title')); ?>" name="<?php echo esc_attr($this->get_field_name('ad_title')); ?>" value="<?php echo esc_attr($instance['ad_title']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php esc_html_e('Ads Link:', 'look'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php if( !empty($instance['url']) ) echo  esc_url($instance['url']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image_url')); ?>"><?php esc_html_e('Ads Image Url:', 'look'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image_url')); ?>" name="<?php echo esc_attr($this->get_field_name('image_url')); ?>" type="text" value="<?php if( !empty($instance['image_url']) ) echo esc_url($instance['image_url']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'google_ads' )); ?>"><?php esc_html_e('JS or Google AdSense Code:','look'); ?></label>
			<textarea rows="10" cols="50" id="<?php echo esc_attr($this->get_field_id( 'google_ads' )); ?>" name="<?php echo esc_attr($this->get_field_name('google_ads')); ?>" class="widefat"><?php echo html_entity_decode(stripcslashes($instance['google_ads'])); ?></textarea>
		</p>
		<p><?php esc_html_e('Please remove custom ads image and ads url if you use javascript ad code.','look'); ?></p>
	<?php
	}
}

add_action('widgets_init', 'look_ruby_register_ads_widget');
