<?php
//About widget
add_action('widgets_init', 'look_ruby_register_about_widget');
function look_ruby_register_about_widget()
{
    register_widget('look_ruby_about_widget');
}

class look_ruby_about_widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'sb-widget-about', 'description' => esc_html__('[Sidebar Widget] Display short biography in sidebar sections', 'look'));
        parent::__construct('look_ruby_sb_about_widget', esc_html__('[SIDEBAR] - About Me', 'look'), $widget_ops);
    }

    function widget($args, $instance)
    {
	    extract( $args );
	    $title   = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
	    $text    = ( ! empty( $instance['text'] ) ) ? $instance['text'] : '';
	    $name    = ( ! empty( $instance['name'] ) ) ? $instance['name'] : '';
	    $image   = ( ! empty( $instance['logo_image'] ) ) ? $instance['logo_image'] : '';
	    $address = ( ! empty( $instance['address'] ) ) ? $instance['address'] : '';
	    $phone   = ( ! empty( $instance['phone'] ) ) ? $instance['phone'] : '';
	    $email   = ( ! empty( $instance['email'] ) ) ? $instance['email'] : '';


	    echo $before_widget;

	    if ( ! empty( $title ) ) {
		    echo $before_title . esc_attr( $title ) . $after_title;
	    } ?>


        <?php if (!empty($image)) : ?>
            <div class="about-widget-image">
	            <img data-no-retina src="<?php echo esc_url($image); ?>" alt="<?php bloginfo() ?>"/>
	            <?php if (!empty($name)) : ?>
		            <div class="about-name post-title"><h3><?php echo esc_attr($name); ?></h3></div><!--#name-->
	            <?php endif; ?>
            </div><!--#image-->
        <?php endif; ?>

        <div class="about-content-wrap post-excerpt">

            <?php if (!empty($text)) : ?>
                <div class="about-content entry"><?php echo do_shortcode($text); ?></div><!--about-content-->
            <?php endif; ?>

	        <?php if ( ! empty( $address ) ) : ?>
		        <div class="address"><i class="fa fa-map-marker"></i><span><?php echo esc_html( $address ); ?></span></div><!--about-content-->
	        <?php endif; ?>

	        <?php if ( ! empty( $phone ) ) : ?>
		        <div class="phone"><i class="fa fa-mobile"></i><span><?php echo esc_html( $phone ); ?></span></div><!--about-content-->
	        <?php endif; ?>

	        <?php if ( ! empty( $email ) ) : ?>
		        <div class="email"><i class="fa fa-paper-plane"></i><a href="mailto:<?php esc_html($email)?>"><?php echo esc_html( $email ); ?></a></div><!--about-content-->
	        <?php endif; ?>
        </div><!--#about me content -->


        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
	    $instance               = $old_instance;
	    $instance['title']      = strip_tags( $new_instance['title'] );
	    $instance['name']       = strip_tags( $new_instance['name'] );
	    $instance['text']       = $new_instance['text'];
	    $instance['logo_image'] = strip_tags( $new_instance['logo_image'] );
	    $instance['address']    = strip_tags( $new_instance['address'] );
	    $instance['phone']      = strip_tags( $new_instance['phone'] );
	    $instance['email']      = strip_tags( $new_instance['email'] );

	    return $instance;
    }

    function form($instance)
    {
	    $defaults = array(
		    'title'      => esc_html__( 'About me', 'look' ),
		    'text'       => '',
		    'name'       => '',
		    'logo_image' => '',
		    'address'    => '',
		    'phone'      => '',
		    'email'      => ''
	    );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:','look');?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php if( !empty($instance['title']) ) echo esc_attr($instance['title']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'logo_image' )); ?>"><?php esc_html_e('About Image Url (optional):','look'); ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'logo_image' )); ?>" name="<?php echo esc_attr($this->get_field_name('logo_image')); ?>" value="<?php if( !empty($instance['logo_image']) ) echo esc_url($instance['logo_image']); ?>" />
	    </p>
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'name' )); ?>"><?php esc_html_e('Name (Only display on about image):','look'); ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'name' )); ?>" value="<?php if( !empty($instance['name']) ) echo esc_attr($instance['name']); ?>" />
	    </p>
	    <p>
		    <label for="<?php echo esc_html($this->get_field_id( 'text' )); ?>"><?php esc_html_e('About text:','look'); ?></label>
		    <textarea rows="10" cols="50" id="<?php echo esc_html($this->get_field_id( 'text' )); ?>" name="<?php echo esc_html($this->get_field_name('text')); ?>" class="widefat"><?php echo esc_html($instance['text']); ?></textarea>
	    </p>

	    <p>
		    <label for="<?php echo esc_html($this->get_field_id( 'address' )); ?>"><?php esc_html_e('your address:','look'); ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" value="<?php if( !empty($instance['address']) ) echo esc_attr($instance['address']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_html($this->get_field_id( 'phone' )); ?>"><?php esc_html_e('your phone:','look'); ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone' )); ?>" value="<?php if( !empty($instance['phone']) ) echo esc_attr($instance['phone']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_html($this->get_field_id( 'email' )); ?>"><?php esc_html_e('your email:','look'); ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" value="<?php if( !empty($instance['email']) ) echo esc_attr($instance['email']); ?>" />
	    </p>


    <?php
    }
}
?>
