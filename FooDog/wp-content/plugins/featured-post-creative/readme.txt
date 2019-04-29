=== Featured Post Creative ===
Contributors: wponlinesupport, anoopranawat, pratik-jain
Tags: featured post, featured post grid, featured post widget, responsive featured post grid, responsive featured post, brick layout, featured post brick layout,  free featured posts, add featured posts, display featured posts
Requires at least: 3.5
Tested up to: 5.1.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display Featured post on your website with 2 shortcode and 1 widget. Also work with Gutenberg shortcode block.

== Description ==

Featured Posts allows you to add featured posts to your blog's website via shortcode in pages and/or posts.
This plugin makes it easier to mark posts as featured posts from post list OR from post inner section.

View [DEMO](https://www.wponlinesupport.com/wp-plugin/featured-post-creative/) | [PRO DEMO and Features](https://www.wponlinesupport.com/wp-plugin/featured-post-creative/) for additional information.

Also work with Gutenberg shortcode block. 

= Shortcode and widget =
= Featured Post Creative has 2 shortoctcodes and 1 widget =
* Grid Box : <code>[fpc_post_block]</code>
* Grid : <code>[fpc_post_grid]</code>
* Widget

= Features =
* Mark any post as a Featured Post from post list OR from post inner section.
* Adjust Featured Posts display to any theme.
* 2 Shortcode and 1 widget.
* You can set how many posts you wish to display.
* You can select any category.

= Shortcodes =
* <code>[fpc_post_block limit="10"]</code>
* <code>[fpc_post_grid]</code>

= Templete code =

* <code><?php echo do_shortcode('[fpc_post_block limit="10"]'); ?></code>
* <code><?php echo do_shortcode('[fpc_post_grid grid="3" limit="10"]'); ?></code>
 
= Following are featured post Parameters: =

<code>[fpc_post_block]</code>

* **Limit :** [fpc_post_block limit="10"] (Display latest 10 featured post).
* **Show_author :** [fpc_post_block show_author="true"] (Display featured post author OR not. By default value is “true”. Values are “true” OR “false” )
* **Category :** [fpc_post_block category="category_id"] (Display featured post categories wise).
* **Show_category_name :** [fpc_post_block show_category_name="true" ] (Display featured post category name OR not. By default value is “true”. Options are “true OR false”).
* **Show_date :** [fpc_post_block show_date="false"] (Display featured post date OR not. By default value is “true”. Options are “true OR false”)
* **Order :** [fpc_post_block order="DESC"] (Controls featured post order. Values are "ASC" OR "DESC".)
* **Orderby :** [fpc_post_block orderby="post_date"] (Display featured post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Image Height :** [fpc_post_block image_height="500"] (Control featured post image height.)

<code>[fpc_post_grid]</code>

* **Limit :** [fpc_post_grid limit="10"] (Display latest 10 featured post).
* **Grid:**  [fpc_post_grid grid="3"] (Display post in grid3. You can use grid:1,2,3,4).
* **Show_author :** [fpc_post_grid show_author="true"] (Display featured post author OR not. By default value is “true”. Values are “true” OR “false” )
* **Category :** [fpc_post_grid category="category_id"] (Display featured post categories wise).
* **Show_category_name :** [fpc_post_grid show_category_name="true" ] (Display featured post category name OR not. By default value is “true”. Options are “true OR false”).
* **Show_date :** [fpc_post_grid show_date="false"] (Display featured post date OR not. By default value is “true”. Options are “true OR false”)
* **Order :** [fpc_post_grid order="DESC"] (Controls featured post order. Values are "ASC" OR "DESC".)
* **Orderby :** [fpc_post_grid orderby="post_date"] (Display featured post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Image Height :** [fpc_post_grid image_height="500"] (Control featured post image height.)

= PRO Features Include =
> * 20 Predefined stunning and cool designs
> * Fearured Post Grid view
> * Fearured Post Gridbox view
> * Fearured Post Slider view
> * Fearured Post Carousel view
> * Fearured Post Widget with list view
> * Fearured Post Widget with slider view
> * Strong Shortcode Parameters
> * Slider RTL support
> * Fully Responsive
> * 100% Multilanguage
>
> View [PRO DEMO and Features](https://www.wponlinesupport.com/wp-plugin/featured-post-creative/) for additional information.
>

== Installation ==
1. Upload the 'featured-post-creative' folder to the '/wp-content/plugins/' directory.
2. Activate the 'featured-post-creative' list plugin through the 'Plugins' menu in WordPress.
3. Go to Post--> All Post and click the STAR to make post as a featured post. 
4. Use the following shortcode.

= Shortcodes =
* <code>[fpc_post_block limit="10"]</code>
* <code>[fpc_post_grid]</code>

= Templete code =
* <code><?php echo do_shortcode('[fpc_post_block limit="10"]'); ?></code>
* <code><?php echo do_shortcode('[fpc_post_grid grid="3" limit="10"]'); ?></code>
 
== Screenshots ==

1. Grid Block
2. Grid
3. Featured post Star

 
== Changelog ==

= 1.1.3 (22, Apr 2019) =
* [*] Resolved one typo mistake in plugin menu.
* [*] Applied appropriate sanitization function to relevant fields.
* [*] Taken better care of Post Title as image ALT tag.
* [*] Used 'wp_reset_postdata' instead of 'wp_reset_query'.

= 1.1.2 (04, Jan 2019) =
* [*] Added Opt-in flow.

= 1.0.2 (08, Dec 2018) =
* [*] Tested with WordPress 5.0 and Gutenberg.
* [*] Fixed some CSS issues.

= 1.1.1 (18-04-2018) =
* Fixed image issue and replaced with large image

= 1.1 (02-05-2017) =
* Fixed Grid Issue

= 1.0.1 =
* Added widget

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.0 =
* Initial release.