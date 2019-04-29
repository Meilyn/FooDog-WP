<?php
add_action('widgets_init', 'look_ruby_register_block_post_widget');

function look_ruby_register_block_post_widget()
{
    register_widget('look_ruby_sb_widget_post');
}

class look_ruby_sb_widget_post extends WP_Widget
{

	//register widget
    function __construct()
    {
        $widget_ops = array('classname' => 'sb-widget-post', 'description' => esc_html__('[Sidebar Widget] Display posts with custom query in sidebar section','look'));
        parent::__construct('look_ruby_sb_widget_post', esc_html__('[SIDEBAR] - Posts widget', 'look'), $widget_ops);
    }


	//render widget
    function widget($args, $instance)
    {
        extract($args);
	    $look_ruby_options                   = array();
	    $title                          = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
	    $look_ruby_options['posts_per_page'] = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : 4;
	    $look_ruby_options['orderby']        = ! empty( $instance['orderby'] ) ? $instance['orderby'] : 'date_post';
	    $look_ruby_options['category_id']    = ! empty( $instance['cate'] ) ? $instance['cate'] : 0;
	    $look_ruby_options['category_ids']   = ! empty( $instance['cates'] ) ? $instance['cates'] : '';
	    $look_ruby_options['tags']           = ! empty( $instance['tags'] ) ? $instance['tags'] : '';
	    $look_ruby_options['offset']         = ! empty( $instance['offset'] ) ? $instance['offset'] : 0;
	    $style                          = ! empty( $instance['style'] ) ? $instance['style'] : 'style-1';

		//query data
        $data_query = look_ruby_query::get_custom_query($look_ruby_options);

        echo $before_widget;

	    if ( ! empty( $title ) ) {
		    echo $before_title . esc_attr( $title ) . $after_title;
	    }

	    if ( $data_query->have_posts() ) {

		    $post_inner_classes   = array();
		    $post_inner_classes[] = 'post-widget-inner';
		    $post_inner_classes[] = $style;

		    $post_inner_classes = implode( ' ', $post_inner_classes );

		    echo '<div class="' . esc_attr( $post_inner_classes ) . '">';

		    switch ( $style ) {

			    case 'style-1' :
				    while ( $data_query->have_posts() ) {
					    $data_query->the_post();
					    get_template_part( 'templates/module/layout', 'list_mini' );
				    };
				    break;
			    case 'style-2' :
				    while ( $data_query->have_posts() ) {
					    $data_query->the_post();
					    get_template_part( 'templates/module/layout', 'overlay_small' );
				    };
				    break;
			    case 'style-3' :
				    while ( $data_query->have_posts() ) {
					    $data_query->the_post();
					    get_template_part( 'templates/module/layout', 'list_small' );
				    };
				    break;
			    case 'style-4' :
				    $counter = 1;
				    while ( $data_query->have_posts() ) {
					    $data_query->the_post();
					    echo '<div class="post-outer">';
					    get_template_part( 'templates/module/layout', 'list_small' );
					    echo '<span class="post-counter">' . esc_html( $counter ) . '</span>';
					    echo '</div>';
					    $counter ++;
				    };
				    break;
			    case 'style-5' :
				    while ( $data_query->have_posts() ) {
					    $data_query->the_post();
					    get_template_part( 'templates/module/layout', 'grid_1' );
				    };
				    break;
			    case 'style-6' :
				    while ( $data_query->have_posts() ) {
					    $data_query->the_post();
					    get_template_part( 'templates/module/layout', 'grid_small_1' );
				    };
				    break;
			    case 'style-7' :
				    while ( $data_query->have_posts() ) {
					    $data_query->the_post();
					    get_template_part( 'templates/module/layout', 'grid_small_s' );
				    };
				    break;
			    case 'style-8' :
				    echo '<div class="slider-wrap is-widget-post-slider">';
				    echo '<div class="slider-loading"></div>';
				    echo '<div class="ruby-mini-slider slider-init">';
				    while ( $data_query->have_posts() ) {
					    $data_query->the_post();
					    get_template_part( 'templates/module/layout', 'slider_mini' );
				    };
				    echo '</div>';
				    echo '</div>';
				    break;
		    }


		    echo '</div><!--#post widget inner -->';
        }

	    //reset post data
	    wp_reset_postdata();
        echo $after_widget;
    }


	//update forms
	function update( $new_instance, $old_instance ) {
		$instance                   = $old_instance;
		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['style']          = strip_tags( $new_instance['style'] );
		$instance['cate']           = strip_tags( $new_instance['cate'] );
		$instance['cates']          = strip_tags( $new_instance['cates'] );
		$instance['tags']           = strip_tags( $new_instance['tags'] );
		$instance['posts_per_page'] = absint( strip_tags( $new_instance['posts_per_page'] ) );
		$instance['offset']         = absint( strip_tags( $new_instance['offest'] ) );
		$instance['orderby']        = strip_tags( $new_instance['orderby'] );

		return $instance;
	}


	//form settinga
    function form($instance)
    {
	    $defaults = array(
		    'title'          => esc_html__( 'latest posts', 'look' ),
		    'style'          => '',
		    'orderby'        => 'date_post',
		    'posts_per_page' => 4,
		    'cate'           => '',
		    'cates'          => '',
		    'tags'           => '',
		    'offset'         => 0
	    );
	    $instance = wp_parse_args( (array) $instance, $defaults ); ?>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title:','look') ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php if(!empty($instance['title'])) echo esc_attr($instance['title']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'style' )); ?>"><?php esc_attr_e('Style:', 'look'); ?></label>
		    <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>" >
			    <option value="style-1" <?php if( !empty($instance['style']) && $instance['style'] == 'style-1' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Style 1', 'look'); ?></option>
			    <option value="style-2" <?php if( !empty($instance['style']) && $instance['style'] == 'style-2' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Style 2', 'look'); ?></option>
			    <option value="style-3" <?php if( !empty($instance['style']) && $instance['style'] == 'style-3' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Style 3', 'look'); ?></option>
			    <option value="style-4" <?php if( !empty($instance['style']) && $instance['style'] == 'style-4' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Style 4', 'look'); ?></option>
			    <option value="style-5" <?php if( !empty($instance['style']) && $instance['style'] == 'style-5' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Style 5', 'look'); ?></option>
			    <option value="style-6" <?php if( !empty($instance['style']) && $instance['style'] == 'style-6' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Style 6', 'look'); ?></option>
			    <option value="style-7" <?php if( !empty($instance['style']) && $instance['style'] == 'style-7' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Style 7', 'look'); ?></option>
			    <option value="style-8" <?php if( !empty($instance['style']) && $instance['style'] == 'style-8' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Style 8', 'look'); ?></option>
		    </select>
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('cate')); ?>"><strong><?php esc_attr_e('Category Filter:', 'look'); ?></strong></label>
		    <select class="widefat" id="<?php echo esc_attr($this->get_field_id('cate')); ?>" name="<?php echo esc_attr($this->get_field_name('cate')); ?>">
			    <option value='all' <?php if ($instance['cate'] == 'all') echo 'selected="selected"'; ?>><?php esc_attr_e('All Categories', 'look'); ?></option>
			    <?php $categories = get_categories('type=post'); foreach ($categories as $category) { ?><option  value='<?php echo esc_attr($category->term_id); ?>' <?php if ($instance['cate'] == $category->term_id) echo 'selected="selected"'; ?>><?php echo esc_attr($category->cat_name); ?></option><?php } ?>
		    </select>
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'cates' )); ?>"><?php esc_attr_e('Multiple Category Filter (optional, Input category ids, Separate category ids with comma. e.g. 1,2):','look') ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'cates' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'cates' )); ?>" value="<?php if( !empty($instance['cates']) ) echo esc_attr($instance['cates']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'tags' )); ?>"><?php esc_attr_e('Tags (optional, Separate tags with comma. e.g. tag1,tag2):','look') ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'tags' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'tags' )); ?>" value="<?php if( !empty($instance['tags']) ) echo esc_attr($instance['tags']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'posts_per_page' )); ?>"><?php esc_attr_e('Limit Post Number (optional, default is 4):','look') ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'posts_per_page' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'posts_per_page' )); ?>" value="<?php if( !empty($instance['posts_per_page']) ) echo esc_attr($instance['posts_per_page']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'offset' )); ?>"><?php esc_attr_e('Post Offset (optional, default is 0):','look') ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'offset' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'offest' )); ?>" value="<?php if( !empty($instance['offset']) ) echo esc_attr($instance['offset']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>"><?php esc_attr_e('Order By:', 'look'); ?></label>
		    <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'orderby' )); ?>" >
			    <option value="date_post" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'date' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Latest Post', 'look'); ?></option>
			    <option value="comment_count" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'comment_count' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Popular Post by Comments', 'look'); ?></option>
			    <option value="popular" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'popular' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Popular Post by Views', 'look'); ?></option>
			    <option value="top_review" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'top_review' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Top Review', 'look'); ?></option>
			    <option value="last_review" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'last_review' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Last Review', 'look'); ?></option>
			    <option value="post_type" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'post_type' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Post Type', 'look'); ?></option>
			    <option value="rand" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'rand' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Random Post', 'look'); ?></option>
			    <option value="author" <?php if( !empty($instance['author']) && $instance['orderby'] == 'author' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('Author', 'look'); ?></option>
			    <option value="alphabetical_order_asc" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'alphabetical_order_asc' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('alphabetical A->Z Posts', 'look'); ?></option>
			    <option value="alphabetical_order_decs" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'alphabetical_order_decs' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('alphabetical Z->A Posts', 'look'); ?></option>
		    </select>
	    </p>
    <?php
    }
}
