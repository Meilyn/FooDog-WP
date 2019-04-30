<?php

##################################################
###                                            ###
###       THEME CONFIGS & INITIALIZE           ###
###                                            ###
##################################################

$look_ruby_template_directory = get_template_directory();

//including theme options config value file
require_once $look_ruby_template_directory . '/includes/core/theme_config.php';

//Including recommended theme plugins
require_once $look_ruby_template_directory . '/includes/admin/admin_plugins.php';


##################################################
###                                            ###
###         META BOX & THEME OPTIONS           ###
###                                            ###
##################################################

//including redux framework & theme options
require_once $look_ruby_template_directory . '/theme_options/redux_default.php';
require_once $look_ruby_template_directory . '/theme_options/redux_config.php';

// Load custom metabox config
require_once $look_ruby_template_directory . '/metaboxes/metabox_config.php';

// Load taxonomy config
require_once $look_ruby_template_directory . '/metaboxes/taxonomy_config.php';

//including css and js files back end
require_once $look_ruby_template_directory . '/includes/admin/admin_enqueue.php';

//include custom tinymce
require_once $look_ruby_template_directory . '/includes/admin/tinymce/tinymce_action.php';

//including css and js files front end
require_once $look_ruby_template_directory . '/includes/core/enqueue.php';


##################################################
###                                            ###
###              THEME CORE FILES              ###
###                                            ###
##################################################

//including page composer
require_once $look_ruby_template_directory . '/includes/composer/composer.php';

//including mega menu
require_once $look_ruby_template_directory . '/includes/menu/backend_mega_menu.php';
require_once $look_ruby_template_directory . '/includes/menu/frontend_mega_menu.php';


//including theme core
require_once $look_ruby_template_directory . '/includes/core/core.php';
require_once $look_ruby_template_directory . '/includes/core/core_query.php';
require_once $look_ruby_template_directory . '/includes/core/core_single.php';

//woocommerce
if ( class_exists( 'Woocommerce' ) ) {
	require_once $look_ruby_template_directory . '/includes/core/core_woo.php';
}

//video thumbnail
require_once $look_ruby_template_directory . '/includes/core/core_video.php';

//retina support
require_once $look_ruby_template_directory . '/includes/core/retina.php';
require_once $look_ruby_template_directory . '/includes/core/schema.php';


//including theme function
require_once $look_ruby_template_directory . '/includes/core/ad_support.php';
require_once $look_ruby_template_directory . '/includes/core/post_format.php';
require_once $look_ruby_template_directory . '/includes/core/post_views.php';
require_once $look_ruby_template_directory . '/includes/core/post_review.php';
require_once $look_ruby_template_directory . '/includes/core/wrapper.php';
require_once $look_ruby_template_directory . '/includes/core/dynamic_css.php';
require_once $look_ruby_template_directory . '/includes/core/action.php';
require_once $look_ruby_template_directory . '/includes/core/post_related.php';


##################################################
###                                            ###
###              SOCIALS & SHARES              ###
###                                            ###
##################################################

require_once $look_ruby_template_directory . '/includes/socials/social_data.php';
require_once $look_ruby_template_directory . '/includes/socials/social_bar.php';
require_once $look_ruby_template_directory . '/includes/socials/social_fan.php';
require_once $look_ruby_template_directory . '/includes/socials/social_share_post.php';
require_once $look_ruby_template_directory . '/includes/socials/flickr_data.php';
require_once $look_ruby_template_directory . '/includes/socials/instagram_data.php';
require_once $look_ruby_template_directory . '/includes/socials/social_share_count.php';


##################################################
###                                            ###
###             SIDEBAR * WIDGETS              ###
###                                            ###
##################################################

//including sidebar sections
require_once $look_ruby_template_directory . '/includes/sidebar/sidebar_multi.php';
require_once $look_ruby_template_directory . '/includes/sidebar/sidebar_section.php';

//including widgets files
require_once $look_ruby_template_directory . '/widgets/sb_widget_post.php';
require_once $look_ruby_template_directory . '/widgets/sb_widget_social_counter.php';
require_once $look_ruby_template_directory . '/widgets/sb_widget_ad.php';
require_once $look_ruby_template_directory . '/widgets/sb_widget_instagram.php';
require_once $look_ruby_template_directory . '/widgets/sb_widget_flickr.php';
require_once $look_ruby_template_directory . '/widgets/sb_widget_fb.php';
require_once $look_ruby_template_directory . '/widgets/sb_widget_youtube.php';
require_once $look_ruby_template_directory . '/widgets/sb_widget_tweet.php';
require_once $look_ruby_template_directory . '/widgets/sb_widget_about.php';
require_once $look_ruby_template_directory . '/widgets/sb_widget_subscribe.php';

//footer instagram
require_once $look_ruby_template_directory . '/widgets/tfooter_widget_instagram.php';

//blog column widget
require_once $look_ruby_template_directory . '/widgets/bc_widget_banner.php';


##################################################
###                                            ###
###              TEMPLATE PARTS                ###
###                                            ###
##################################################

//include category info
require_once $look_ruby_template_directory . '/templates/meta/el-cat_info.php';
require_once $look_ruby_template_directory . '/templates/meta/el-category.php';


//include all template
require_once $look_ruby_template_directory . '/templates/template_wrapper.php';
require_once $look_ruby_template_directory . '/templates/template_part.php';
require_once $look_ruby_template_directory . '/templates/template_single.php';
require_once $look_ruby_template_directory . '/templates/template_page.php';
require_once $look_ruby_template_directory . '/templates/template_thumbnail.php';
require_once $look_ruby_template_directory . '/templates/template_composer_loop.php';
require_once $look_ruby_template_directory . '/templates/template_feat.php';
require_once $look_ruby_template_directory . '/templates/template_blog.php';


//block layouts
require_once $look_ruby_template_directory . '/templates/block/block.php';

//fullwidth blocks
require_once $look_ruby_template_directory . '/templates/block/fw_block_code.php';
require_once $look_ruby_template_directory . '/templates/block/fw_block_ad_box.php';
require_once $look_ruby_template_directory . '/templates/block/fw_block_slider_fw.php';
require_once $look_ruby_template_directory . '/templates/block/fw_block_slider_hw.php';
require_once $look_ruby_template_directory . '/templates/block/fw_block_carousel.php';
require_once $look_ruby_template_directory . '/templates/block/fw_block_grid.php';
require_once $look_ruby_template_directory . '/templates/block/fw_block_video.php';
require_once $look_ruby_template_directory . '/templates/block/fw_block_1.php';
require_once $look_ruby_template_directory . '/templates/block/fw_block_2.php';
require_once $look_ruby_template_directory . '/templates/block/fw_block_3.php';
require_once $look_ruby_template_directory . '/templates/block/fw_block_4.php';

//has sidebar blocks
require_once $look_ruby_template_directory . '/templates/block/hs_block_code.php';
require_once $look_ruby_template_directory . '/templates/block/hs_block_ad_box.php';
require_once $look_ruby_template_directory . '/templates/block/hs_block_1.php';
require_once $look_ruby_template_directory . '/templates/block/hs_block_2.php';
require_once $look_ruby_template_directory . '/templates/block/hs_block_3.php';
require_once $look_ruby_template_directory . '/templates/block/hs_block_4.php';
require_once $look_ruby_template_directory . '/templates/block/hs_block_5.php';
require_once $look_ruby_template_directory . '/templates/block/hs_block_6.php';
require_once $look_ruby_template_directory . '/templates/block/hs_block_7.php';
require_once $look_ruby_template_directory . '/templates/block/hs_block_8.php';