<?php
/**
 * Widget API: Featured Post List 1
 *
 * @package WP Featured Post
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpfp_featured_post_list_widget() {
    register_widget( 'Wpfp_featured_fplw_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wpfp_featured_post_list_widget' );

class Wpfp_featured_fplw_Widget extends WP_Widget {

     /**
     * Sets up a new widget instance.
     *
     * @package WP Featured Post
     * @since 1.0.0
     */
    function __construct() {
         
        $widget_ops = array('classname' => 'wpfp-featured-fplw', 'description' => __('Display Featured Post Items in list view.', 'featured-post-creative') );
        parent::__construct( 'wpfp_featuredlist_widget', __('WPOS - Featured Post List', 'featured-post-creative'), $widget_ops );
    }

    /**
     * Handles updating settings for the current widget instance.
     *
     * @package WP Featured Post
     * @since 1.0.0
     */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title']              = sanitize_text_field($new_instance['title']);
        $instance['num_items']          = !empty($new_instance['num_items']) ? $new_instance['num_items'] : 5;
        $instance['date']               = !empty($new_instance['date']) ? 1 : 0;
        $instance['show_category']      = !empty($new_instance['show_category']) ? 1 : 0;
        $instance['category']           = intval( $new_instance['category'] );
        
        return $instance;
    }

     /**
     * Outputs the settings form for the widget.
     *
     * @package WP Featured Post
     * @since 1.0.0
     */
    function form($instance) {

        $defaults = array(
            'num_items'         => 5,
            'title'             => '',
            "date"              => 1, 
            'show_category'     => 1,
            'category'          => 0,
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults );
    ?>

        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'featured-post-creative' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        
        <!-- Number of Items -->
        <p>
            <label for="<?php echo $this->get_field_id('num_items'); ?>"><?php _e( 'Number of Items:', 'featured-post-creative' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" min="-1" value="<?php echo esc_attr($instance['num_items']); ?>" />
        </p>
        
        <!-- Category -->
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'featured-post-creative' ); ?></label>
            <?php
                $dropdown_args = array( 
                                        'taxonomy'          => WPFP_CAT,
                                        'class'             => 'widefat',
                                        'show_option_all'   => __( 'All', 'featured-post-creative' ),
                                        'id'                => $this->get_field_id( 'category' ),
                                        'name'              => $this->get_field_name( 'category' ),
                                        'selected'          => $instance['category']
                                    );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>

        <!--  Display Date -->
        <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'featured-post-creative' ); ?></label>
        </p>

        <!-- Display Category -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'featured-post-creative' ); ?></label>
        </p>
    <?php
    }

    /**
    * Outputs the content for the current widget instance.
    *
    * @package WP Featured Post
    * @since 1.0.0
    */
    function widget( $featured_args, $instance ) {

        extract($featured_args, EXTR_SKIP);
        
        $title                      = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Featured Post List', 'featured-post-creative' ), $instance, $this->id_base );
        $num_items                  = $instance['num_items'];
        $date                       = ( isset($instance['date']) && ($instance['date'] == 1) ) ? "true" : "false";
        $show_category              = ( isset($instance['show_category']) && ($instance['show_category'] == 1) ) ? "true" : "false";
        $category                   = $instance['category'];

        // Taking some globals
        global $post;

        // Taking some variables
        $count          = 0;
        $postcount      = 0;
        $unique         = wpfp_get_unique();
        $prefix = WPFP_META_PREFIX; // Metabox prefix

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
    ?>
    
        <div class="wpfp-featured-post-widget-wrp wpfp-clearfix">
            <div class="wpfp-widget wpfp-clearfix" id="wpfp-featured-post-widget-<?php echo $unique; ?>">
             
                <?php
                // WP Query Parameter
                $featured_args = array(
                                    'suppress_filters'  => true,
                                    'posts_per_page'    => $num_items,
                                    'post_type'         => WPFP_POST_TYPE,
                                    'order'             => 'DESC',
									'ignore_sticky_posts' => 1,
                                );
                // Meta Query
                $featured_args['meta_query'] = array(
                                array(
                                        'key'     => $prefix.'featured_post',
                                        'value'   => 1,
                                        'compare' => '=',
                                ));

                // Category Parameter
                if($category != 0) {
                    $featured_args['tax_query'] = array(
                                                array(
                                                        'taxonomy'  => WPFP_CAT,
                                                        'field'     => 'id',
                                                        'terms'     => $category
                                                ));
                }

                // WP Query
                $cust_loop = new WP_Query($featured_args);
                $post_count = $cust_loop->post_count;
                
                if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post();

                        $postcount++;
                        $count++;
                        $feat_image     = wpfp_get_post_featured_image( $post->ID, 'medium' );
                        $terms          = get_the_terms( $post->ID, 'category' );
                        $featured_links     = array();
                        
                        if($terms) {
                            foreach ( $terms as $term ) {
                                $term_link = get_term_link( $term );
                                $featured_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                            }
                        }
                        $cate_name = join( " ", $featured_links );
    ?>
                        
                        <div class="featured-grid">
                            <div class="featured-image-bg">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php if( !empty($feat_image) ) { ?>
                                    <img src="<?php echo $feat_image; ?>" alt="<?php the_title_attribute(); ?>" />
                                    <?php } ?>
                                </a>

                                <?php if($show_category == 'true' && $cate_name !='') { ?>
                                <div class="featured-categories"><?php echo $cate_name; ?></div>
                                <?php } ?>
                            </div><!-- end .featured-image-bg -->

                            <div class="featured-grid-content">
                                <div class="featured-content">
                                    <div class="featured-title">
                                        <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                                    </div>

                                <?php if($date == "true") { ?>
                                <div class="featured-date">     
                                    <?php echo get_the_date(); ?>
                                </div>
                                <?php } ?>
                                </div><!-- end .featured-content -->
                            </div><!-- end .featured-grid-content -->
                        </div><!-- end .featured-grid -->
                     
                <?php
            endwhile;
            endif;
            
            wp_reset_postdata(); // Reset WP Query

            ?>

            </div><!-- end .wpfp-featured-post -->

        </div><!-- end .wpfp-featured-post-widget-wrp -->

    <?php
        echo $after_widget;
    }
}