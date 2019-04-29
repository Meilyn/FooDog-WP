=== Animate It! ===
Contributors: eleopard
Tags: css3 animation, animate.css, jquery, on scroll animation, delay, infinite, entry exit, iteration
Requires at least: 3.9
Tested up to: 4.9.6
Stable tag: 2.3.3
License: GNU General Public License version 2 or later
License URI: http://www.gnu.org/copyleft/gpl.html

Add cool CSS3 animations to your content.

== Description ==
Add cool CSS3 animations to your content.

[Demo](http://downloads.eleopard.in/animate-it-demo-wordpress/ "Demo") | [Documentation](http://downloads.eleopard.in/animate-it-documentation-wordpress/ "Documentation") | [Class Generator](http://downloads.eleopard.in/class-generator-wordpress/ "Class Generator")

[youtube https://www.youtube.com/watch?v=Np_t43pfrh4]

Some of the Key features Include:

* Allowing user to apply CSS3 animations on Post, Widget and Pages.
* 50+ Entry, Exit and Attention Seeker Animations.
* Capability to apply animation on Scroll.
* Capability to add different scroll offset on individual animation blocks.
* Capability to apply animation on Click.
* Capability to apply animation on Hover.
* Providing delay feature in animation to create a nice animation sequence.
* Providing feature to control the duration for a more precise animation.
* Providing a button in the editor to easily add an animation block in the article or post.
* Allow user to add animation on WordPress widgets. Use <a href="http://downloads.eleopard.in/class-generator-wordpress/" target="_blank">Class Generator</a> to generate the required animation classes. 
* Allow user to apply animation infinitely or any fixed number of times.
* Option to add custom CSS classes to individual animation block.
* Options to enable or disable animations on Smartphones and Tablets.
* Spanish and German language support. Thanks to Santiago Marrone, Christian Herrmann 

All the CSS3 animations are from [Animate.css](http://daneden.github.io/animate.css/ "Animate.css") and [Animo.js](http://labs.bigroomstudios.com/libraries/animo-js "Animo.js")
 
== Installation ==
1. Upload edsanimate to the /wp-content/plugins/ directory.
2. Activate the plugin through the Plugins menu in WordPress.
3. Set your options from the Settings -> Animate It! admin area.

Alternatively:

1. Login to your WordPress admin area
2. Search for Animate It!
3. Click install Animate It!
4. Activate through the Plugins menu in WordPress or when asked during installation
5. Set your options from the Settings -> Animate It! admin area

== Frequently Asked Questions ==

= Animation flicker or occur twice at load time while using animation classes? =
Please add CSS class "eds-animation-paused" along with the other animation classes generated using class generator 

= Setting the scroll offset for on scroll functionality? =
Percentage scroll offset can be set from Settings-> Animate It! menu in the admin area.

= Hiding horizontal and vertical scroll bar? =
Settings to show or hide vertical or horizontal scroll bar are available at  Settings-> Animate It! menu in the admin area.

= Animation applied using older plugin and class generator won't work?  =
If animation applied using class generator or older plugin wont work, Please do the following:
If using shortcode:
Add duration="1" (you can add 1 to 20) as one of the attribute of the shortcode.

If using class generator:
Add duration class ( duration1 to duration20 ) along with the other classes. or use the class generator one more time to generate same animation classes.

== Screenshots ==

1. **Animate Button** - Add animation blocks in WordPress Post and Pages using the Animate It! button.
2. **Select Animation** - After clicking Animate It! button you will get a screen to choose animation.
3. **Entry Exit Animation** - Select and configure the entry and exit animations.
4. **Other Options** - Select other options like iteration count etc.  
5. **Update Dummy Content** - Update the content of the block as per your requirement. You can copy and paste the same in Text Widget also.
6. **Settings** - Options for Animate It! under Settings-> Animate It! menu in the admin area.
7. **Class Generator** - Class Generator to generate required Animation Classes for Widgets.
8. **Copy Generated Classes** - Copy the generated classes.
9. **Apply on Widgets** - Apply the copied classes by pasting it in the 'Animate It! Classes' text box under the widget settings.


== Changelog ==

= Version 2.3.3 =
* Minor Bug Fixes to avoid editor button overflow while using inline editor in Gutenberg.

= Version 2.3.2 =
* Minor Bug Fixes related to animation using Class generator.

= Version 2.3.1 =
* Minor Bug Fixes related to CSS

= Version 2.3.0 =
* Added new CSS Animations. Thanks to http://ianlunn.github.io/Hover/
* Added support for loading custom CSS even if the animations are disabled on tablet or mobile devices.

= Version 2.2.1 =
* Bug fixes for chrome 61+ version

= Version 2.2.0 =
* Bug fixes for chrome 61+ version

= Version 2.1.9 =
* Bug fixes for chrome 61+ version

= Version 2.1.8 =
* Mobile_Detect class updated

= Version 2.1.7 =
* Minor Bug Fix related to Settings page

= Version 2.1.6 =
* Added spanish and german language support

= Version 2.1.5 =
* Minor bug fixes.

= Version 2.1.4 =
* Changes to avoid conflict with other animation scripts

= Version 2.1.3 =
* Minor Bug Fixes related to on scroll animation

= Version 2.1.2 =
* Minor Bug Fixes

= Version 2.1.1 =
* Minor changes to handle load time delay
* Description updated

= Version 2.1.0 =
* Text domain added
* Mobile_Detect class updated

= Version 2.0.4 =
* Minor fixes to support older version and classes added using class generator

= Version 2.0.3 =
* Minor fixes to support older version

= Version 2.0.2 =
* Minor fixes to support infinite animation added using older version

= Version 2.0.1 =
* Minor changes to handle higher load time

= Version 2.0.0 =
* New Feature to create Entry Exit Animation sequence
* New Feature to provide custom delay and durations while generating shortcode
* New Feature to apply timing functions
* New Feature to iterate the animation n number of times
* Code optimization for tinymce popup

= Version 1.4.4 =
* Bug fix related to the addition of animation classes on widgets

= Version 1.4.3 =
* Some spelling correction.

= Version 1.4.2 =
* New Feature that will allow user to add custom CSS for additional delay, duration etc.

= Version 1.4.1 =
* Resolved bug related to nested shortcodes.

= Version 1.4.0 =
* Resolved issue related to CSS.
* New feature that will allow user to add different scroll offset on individual animation blocks.

= Version 1.3.3 =
* Resolved issue related to nested shortcodes.

= Version 1.3.2 =
* Resolved issue related to infinite animation and on hover combination.

= Version 1.3.1 =
* Resolved issue related to widget content update and save.

= Version 1.3 =
* Capability to apply animation on Hover.
* Capability to apply animation on Click.
* Allow users to apply animation on WordPress Widgets.

= Version 1.2.1 =
* Resolved an issue related to multiple declaration of mobile_detect.php class.

= Version 1.2 =
* New options to add animation duration and infinite animation while applying an animation on WordPress Post, Page or widget.

= Version 1.1 =
* New options added under Settings-> Animate It! to enable or disable animations on Smartphones and Tablets.

= Version 1.0 =
* Initial public release.

== Upgrade Notice ==

= Version 1.0 =
* Initial public release.
