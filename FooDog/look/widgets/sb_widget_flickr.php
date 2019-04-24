<?php
//flickr widget
add_action( 'widgets_init', 'look_ruby_register_flickr_widget' );
function look_ruby_register_flickr_widget() {
	register_widget( 'look_ruby_flickr' );
}

// Setup
class look_ruby_flickr extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname'   => 'flickr-widget',
		                     'description' => esc_html__( '[Sidebar Widget] Display Flickr image grid in sidebar section', 'look' )
		);
		parent::__construct( 'look_ruby_flickr_widget', esc_html__( '[SIDEBAR] - Flickr Grid', 'look' ), $widget_ops );
	}

	//render widget
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		$title      = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$flickr_id  = ( ! empty( $instance['flickr_id'] ) ) ? $instance['flickr_id'] : '';
		$num_images = ( ! empty( $instance['img_num'] ) ) ? $instance['img_num'] : '';
		$num_column = ( ! empty( $instance['columns'] ) ) ? $instance['columns'] : 'col-xs-3';
		$tags       = ( ! empty( $instance['tags'] ) ) ? $instance['tags'] : '';

		if ( ! empty( $title ) ) {
			echo $before_title . esc_attr( $title ) . $after_title;
		}

        ?>
        <div class="widget-flickr-content-wrap row">
	        <?php
	        // get from cache
	        $cache = get_transient( 'look_ruby_flickr_cache' );

	        if ( is_array( $cache ) && ! empty( $cache[ $num_images ] ) ) {
		        $flickr_data = $cache[ $num_images ];
	        } else {
		        $flickr_data = look_ruby_flickr_data::get_data( $flickr_id, $num_images, $tags );

		        // store to cache
		        $cache[ $num_images ] = $flickr_data;
		        set_transient( 'look_ruby_flickr_cache', $cache, 3600 ); // 1 hour expiry
	        }

            ?>
            <?php if(!empty($flickr_data)) : ?>
                <?php foreach ($flickr_data as $item): ?>
                    <div class="flickr-el <?php echo esc_attr($num_column) ?>">
                        <a href="<?php echo esc_url($item['link']); ?>">
                            <img src="<?php echo esc_url($item['media']); ?>" alt="<?php echo esc_attr($item['title']); ?>"/>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                    <div class="ruby-error"><?php esc_html_e('Configuration error or no pictures...', 'look') ?></div>
            <?php endif; ?>

        </div>
        <?php
        echo $after_widget;
    }
    //update setting.
	function update( $new_instance, $old_instance ) {
		delete_transient( 'look_ruby_flickr_cache' );

		$instance              = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['img_num']   = absint( strip_tags( $new_instance['img_num'] ) );
		$instance['tags']      = strip_tags( $new_instance['tags'] );
		$instance['columns']   = strip_tags( $new_instance['columns'] );
		return $instance;
	}

    //load form setting
    function form($instance)
    {
	    $instance = wp_parse_args(
		    (array) $instance,
		    array(
			    'title'     => esc_attr__('gallery','look'),
			    'flickr_id' => '',
			    'img_num'   => 6,
			    'tags'      => '',
			    'columns'   => 'col-xs-4'
		    ) );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong><?php esc_attr_e('Title:', 'look') ?></strong></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>"><strong><?php esc_attr_e('Flickr User ID:', 'look') ?></strong></label>
	        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr_id')); ?>" type="text" value="<?php echo esc_attr($instance['flickr_id']); ?>"/>
        </p>
	    <p><a href="http://www.idgettr.com" target="_blank"><?php esc_attr_e('Get Flickr Id','look') ?></a></p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('img_num')); ?>"><strong><?php esc_attr_e('Limit Image Number:', 'look') ?></strong></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('img_num')); ?>" name="<?php echo esc_attr($this->get_field_name('img_num')); ?>" type="text" value="<?php echo esc_attr($instance['img_num']); ?>"/>
        </p>
        <p>
	        <label for="<?php echo esc_attr($this->get_field_id('tags')); ?>"><?php esc_attr_e('Tags (optional, Separate tags with comma. e.g. tag1,tag2):', 'look'); ?></label>
	        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tags')); ?>" name="<?php echo esc_attr($this->get_field_name('tags')); ?>" type="text" value="<?php echo esc_attr($instance['tags']); ?>" />
        </p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'columns' )); ?>"><strong><?php esc_attr_e('Number of Columns:', 'look'); ?></strong></label>
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'columns' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'columns' )); ?>" >
            <option value="col-xs-6" <?php if( !empty($instance['columns']) && $instance['columns'] == 'col-xs-6' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('2 columns', 'look'); ?></option>
            <option value="col-xs-4" <?php if( !empty($instance['columns']) && $instance['columns'] == 'col-xs-4' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('3 columns', 'look'); ?></option>
            <option value="col-xs-3" <?php if( !empty($instance['columns']) && $instance['columns'] == 'col-xs-3' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('4 columns', 'look'); ?></option>
        </select>
        </p>

    <?php
    }
}