<?php
/**
 * Plugin Name: Animate It!
 * Text Domain: eds-animate
 * Domain Path: /lang
 * Plugin URI: http://www.eleopard.in
 * Description: Add cool CSS3 animations to your content.
 * Version: 2.3.3
 * Author: eLEOPARD Design Studios
 * Author URI: http://www.eleopard.in
 * License: GNU General Public License version 2 or later; see LICENSE.txt
 *  http://www.gnu.org/copyleft/gpl.html GNU/GPL
    (C) 2014 eLEOPARD Design Studios Pvt Ltd. All rights reserved
   
   	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	
	or see <http://www.gnu.org/licenses/>.
	* For any other query please contact us at contact[at]eleopard[dot]in
*/

include_once dirname( __FILE__ ) .'/assets/helper/class-eds-mobile-detect.php';
include_once dirname( __FILE__ ) .'/assets/helper/class-eds-tinymce.php';

class EDS_Animate {
	
	public static $abs_file = null;
	
	var $in_animations = array("bounceIn","bounceInDown","bounceInLeft","bounceInRight",
                    	"bounceInUp","fadeIn","fadeInDown","fadeInDownBig","fadeInLeft",
                    	"fadeInLeftBig","fadeInRight","fadeInRightBig","fadeInUp","fadeInUpBig",
                    	"rotateIn","rotateInDownLeft","rotateInDownRight","rotateInUpLeft",
                    	"rotateInUpRight","slideInUp","slideInDown","slideInLeft","slideInRight",
                    	"zoomIn","zoomInDown","zoomInLeft","zoomInRight","zoomInUp","flipInX",
                    	"flipInY","lightSpeedIn","rollIn","twirlIn");
						
	public function __construct( $file_loc ) {	
		
		self::$abs_file = $file_loc;
		
		add_filter('widget_text', 'do_shortcode');
		
		register_activation_hook( self::$abs_file, array( $this, 'set_edsanimate_options' ) );
		
		/*Load Text Domain for translation */
		add_action('plugins_loaded', array($this, 'plugin_textdomain'));
		
		/*checking for version updates*/
		add_action( 'plugins_loaded', array( $this, 'update_plugin' ) );		
		
		/* Adding Settings Menu */
		add_action('admin_menu', array( $this, 'modify_menu' ) );
		
		/* Enqueuing Scrips and CSS */				
		add_action('wp_enqueue_scripts', array( $this, 'add_eds_script_and_css' ) );
		
		/*Enqueuing CSS for Admin side*/
		add_action('admin_enqueue_scripts', array( $this, 'add_eds_script_and_css_admin' ) );
		
		/* adding shortcodes */		
		add_shortcode('edsanimate_start', array( $this, 'edsanimate_start_handler' ) );
		add_shortcode('edsanimate_end', array( $this, 'edsanimate_end_handler' ) );
		add_shortcode('edsanimate', array( $this, 'edsanimate_handler' ) );
		
		/*widget related actions*/
		add_filter('widget_text', 'do_shortcode' );
		add_action('in_widget_form', array( $this, 'eds_add_custom_class_field' ), 5, 3 );
		add_filter('widget_update_callback', array( $this, 'eds_update_widget_animation_class' ), 5, 3 );
		add_filter('dynamic_sidebar_params', array( $this, 'eds_add_widget_animation_class' ) );
		
		
		/* TinyMCE Related Handlers */
		$tinymce_handler = new EDS_TinyMCE();
		
		add_action('init', array( $tinymce_handler, 'add_edsanimate_button') );
		
		add_filter( 'tiny_mce_version', array( $tinymce_handler, 'refresh_mce' ) );
		
		//Registering Ajax action to get the popup on click of animate it buton in editor
		add_action( 'wp_ajax_edsanimate_get_popup', array( $tinymce_handler, 'get_popup' ) );
		
		add_filter('mce_external_languages', array( $tinymce_handler, 'add_locale') );
		
		
	}
	
	function plugin_textdomain() {
		load_plugin_textdomain('eds-animate', false, dirname( plugin_basename( self::$abs_file ) ) . '/lang');
	}
	
	function modify_menu(){
		
		add_options_page( __( 'Animate It! Options', 'eds-animate' ) 
			, __( 'Animate It!', 'eds-animate' )
			, 'manage_options'
			,  self::$abs_file
			, array( $this, 'admin_edsanimate_options' ) );
	}
	
	
	function set_edsanimate_options(){		
		
		add_option( 'eds_scroll_offset', '75' );
		add_option( 'eds_enable_on_phone', '0' );	
		add_option( 'eds_enable_on_tab', '1' );	
		add_option( 'eds_hide_overflow_x', '1' );
		add_option( 'eds_hide_overflow_y', '0' );
		add_option( 'eds_custom_css', '' );
		
	}		
	
	function update_plugin() {
	
		global $eds_animate_it_version;	
	
		$installed_version = get_option( 'eds_animate_it_version' );		
	
		if( $installed_version == FALSE ) {
	
			add_option( 'eds_animate_it_version', '1.4.4' );
	
			if( $eds_animate_it_version != '1.4.4') {
	
				$scroll_offset = get_option( 'scroll_offset', '75' );				  
				$enable_on_phone = get_option( 'enable_on_phone', '0' );				
				$enable_on_tab = get_option( 'enable_on_tab', '1' );				
				$hide_overflow_x = get_option( 'hide_overflow_x', '1' );
				$hide_overflow_y = get_option( 'hide_overflow_y', '0' );
				$custom_css = get_option( 'custom_css', '' );					
	
				delete_option('scroll_offset');
				delete_option('enable_on_phone');
				delete_option('enable_on_tab');
				delete_option('hide_overflow_x');
				delete_option('hide_overflow_y');
				delete_option('custom_css');
				
				add_option( 'eds_scroll_offset', $scroll_offset );
				add_option( 'eds_enable_on_phone', $enable_on_phone );
				add_option( 'eds_enable_on_tab', $enable_on_tab );
				add_option( 'eds_hide_overflow_x', $hide_overflow_x );
				add_option( 'eds_hide_overflow_y', $hide_overflow_y );
				add_option( 'eds_custom_css', $custom_css );		
	
				update_option( 'eds_animate_it_version', $eds_animate_it_version );
	
			}
	
		} else {
	
			if( $installed_version != $eds_animate_it_version ) {
				/* Code Block to be used for next plugin upgrade */
			    /*For version 2.3.0 code to add custom css file is added.*/
			    $custom_css = get_option('eds_custom_css');
			    if($custom_css !== false && $custom_css != "" ){
                    file_put_contents( plugin_dir_path( self::$abs_file ) . "assets/css/custom.css", $custom_css);
			    }			    
			    update_option( 'eds_animate_it_version', $eds_animate_it_version );
			    
			}
		}
	
	}
	
	function admin_edsanimate_options(){
		?>
		<div class="wrap"><h2><?php _e( 'Animate It! Options', 'eds-animate' ); ?></h2>
		<?php 
		if(isset($_REQUEST['submit'])){
			$this->update_edsanimate_options();
		}
		
		$this->print_edsanimate_form();
		?></div><?php 
	}
	
	function update_edsanimate_options(){
		$ok= false;
		if(isset($_REQUEST['eds_scroll_offset'])
			&& isset($_REQUEST['eds_enable_on_phone'])
			&& isset($_REQUEST['eds_enable_on_tab'])){
			update_option('eds_scroll_offset', $_REQUEST['eds_scroll_offset']);
			update_option('eds_enable_on_phone', $_REQUEST['eds_enable_on_phone']);
			update_option('eds_hide_overflow_x', $_REQUEST['eds_hide_overflow_x']);
			update_option('eds_hide_overflow_y', $_REQUEST['eds_hide_overflow_y']);
			update_option('eds_enable_on_tab', $_REQUEST['eds_enable_on_tab']);
			$ok=true;	
		}
		$custom_css =  esc_textarea(isset($_REQUEST['eds_custom_css'])?$_REQUEST['eds_custom_css']:'');
		update_option('eds_custom_css', $custom_css);
		file_put_contents( plugin_dir_path( self::$abs_file ) . "assets/css/custom.css", $custom_css);		
			
		if($ok){?>
			<div id="message" class="updated fade">
				<p><?php _e( 'Options saved.', 'eds-animate' ); ?></p>
			</div>
			<?php	
			
		}else{?>
			<div id="message" class="error fade">
				<p><?php _e( 'Failed to save options.', 'eds-animate' ); ?></p>
			</div>
			<?php		
		}
	}
	
	function print_edsanimate_form(){		
		?>
		<a href="https://wordpress.org/support/view/plugin-reviews/animate-it" target="_blank"
			style="display: inline-block; margin-top: 10px; padding-top: 4px;">
			<img src="<?php echo plugins_url( '/assets/images/banner.jpg', self::$abs_file )?>" />
		</a>
		<form method="post">
			<table cellspacing="10" cellpadding="10">
				<tr>
					<td style="vertical-align: top;">
						<label for="eds_scroll_offset"><?php _e( 'Scroll Offset (in percentage)', 'eds-animate' ); ?>:</label>
					</td>
					<td colspan="2">
						<input type="text" name="eds_scroll_offset" value="<?php echo get_option('eds_scroll_offset', '75'); ?>" />
					</td>
					
				</tr>				
				<tr>
					<td style="vertical-align: top;">
						<label for="eds_enable_on_phone"><?php _e( 'Enable on Smartphones', 'eds-animate' ); ?>:</label>
					</td>
					<td>
						<select name="eds_enable_on_phone">
							<option value="1" <?php echo (get_option('eds_enable_on_phone')=='1')?'selected="selected"':'';?>><?php _e( 'Yes', 'eds-animate' ); ?></option>	
							<option value="0" <?php echo (get_option('eds_enable_on_phone')=='0')?'selected="selected"':'';?>><?php _e( 'No', 'eds-animate' ); ?></option>											
						</select>	
					</td>					
				</tr>
				<tr>
					<td style="vertical-align: top;">
						<label for="eds_enable_on_tab"><?php _e( 'Enable on Tablets', 'eds-animate' ); ?>:</label>					
					</td>
					<td>
						<select name="eds_enable_on_tab">
							<option value="1" <?php echo (get_option('eds_enable_on_tab')=='1')?'selected="selected"':'';?>><?php _e( 'Yes', 'eds-animate' ); ?></option>	
							<option value="0" <?php echo (get_option('eds_enable_on_tab')=='0')?'selected="selected"':'';?>><?php _e( 'No', 'eds-animate' ); ?></option>											
						</select>
					</td>					
				</tr>
				<tr>
					<td style="vertical-align: top;">
						<label for="eds_hide_overflow_x"><?php _e( 'Hide Horizontal Scrollbar', 'eds-animate' ); ?>:</label>					
					</td>
					<td>
						<select name="eds_hide_overflow_x">
							<option value="1" <?php echo (get_option('eds_hide_overflow_x')=='1')?'selected="selected"':'';?>><?php _e( 'Yes', 'eds-animate' ); ?></option>	
							<option value="0" <?php echo (get_option('eds_hide_overflow_x')=='0')?'selected="selected"':'';?>><?php _e( 'No', 'eds-animate' ); ?></option>											
						</select>
					</td>					
				</tr>
				<tr>
					<td style="vertical-align: top;">
						<label for="eds_hide_overflow_y"><?php _e( 'Hide Vertical Scrollbar', 'eds-animate' ); ?>:</label>					
					</td>
					<td>
						<select name="eds_hide_overflow_y">
							<option value="1" <?php echo (get_option('eds_hide_overflow_y')=='1')?'selected="selected"':'';?>><?php _e( 'Yes', 'eds-animate' ); ?></option>	
							<option value="0" <?php echo (get_option('eds_hide_overflow_y')=='0')?'selected="selected"':'';?>><?php _e( 'No', 'eds-animate' ); ?></option>											
						</select>
					</td>					
				</tr>
				<tr>
					<td style="vertical-align: top;">
						<label for="eds_custom_css"><?php _e( 'Custom CSS', 'eds-animate' ); ?>:</label>					
					</td>
					<td>
						<textarea name="eds_custom_css" id="eds_custom_css" cols="25" rows="10"><?php echo get_option('eds_custom_css'); ?></textarea>					
					</td>					
				</tr>
				<tr>
					<td colspan="2">
						<input class="button button-primary" type="submit" name="submit" value="<?php _e( 'Submit', 'eds-animate' ); ?>" />
					</td>				
				</tr>				
			</table>
		</form>
		<?php	
	}
	
	function detect_device() {
		static $device_type = null;
		
		if(!$device_type)
		{
			$detect = new EDS_Mobile_Detect();
			$device_type = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		}
		return $device_type;
	
	}	
		
	function add_eds_script_and_css() {
	    //Custom CSS//
	    $custom_css = get_option('eds_custom_css');
	    
		$device_type = $this->detect_device();
	
		$enable_smart_phone = get_option('eds_enable_on_phone');
		$enable_tablet =  get_option('eds_enable_on_tab');	
	
		$enable= ($device_type=='phone' && intval($enable_smart_phone))
		|| ($device_type =='tablet' && intval($enable_tablet))
		|| ($device_type =='computer');
	
		if($enable) {
		
			wp_register_style( 'edsanimate-animo-css',plugins_url( '/assets/css/animate-animo.css', self::$abs_file ));			
		
			wp_register_script( 'edsanimate-animo-script',plugins_url( '/assets/js/animo.min.js', self::$abs_file ), array('jquery'), '1.0.3', true);
			
			wp_register_script( 'edsanimate-throttle-debounce-script',plugins_url( '/assets/js/jquery.ba-throttle-debounce.min.js', self::$abs_file ), array('jquery'), '1.1', true);
			
			//START: Scripts to Support Older Version
			wp_register_script( 'viewportcheck-script',plugins_url( '/assets/js/viewportchecker.js', self::$abs_file), array('jquery', 'edsanimate-throttle-debounce-script' ), '1.4.4', true);
			
			wp_register_script( 'edsanimate-script', plugins_url( '/assets/js/edsanimate.js', self::$abs_file ), array('viewportcheck-script'), '1.4.4', true );
			//END: : Scripts to Support Older Version
			
			wp_register_script( 'edsanimate-site-script', plugins_url( '/assets/js/edsanimate.site.js', self::$abs_file ), array('edsanimate-animo-script', 'edsanimate-throttle-debounce-script' ), '1.4.5', true );
			
			$edsanimate_options = array( 'offset' => get_option('eds_scroll_offset', '75'), 
											'hide_hz_scrollbar' => get_option('eds_hide_overflow_x', '1'), 
											'hide_vl_scrollbar' => get_option('eds_hide_overflow_y', '0'));			
			
			wp_localize_script( 'edsanimate-site-script', 'edsanimate_options', $edsanimate_options);			
		
			//Enqueuing style sheets
			wp_enqueue_style( 'edsanimate-animo-css' );
			wp_add_inline_style( 'edsanimate-animo-css', $custom_css );		
				
			//Enqueuing javascripts
			wp_enqueue_script( 'edsanimate-animo-script');
			wp_enqueue_script( 'edsanimate-throttle-debounce-script' );
			wp_enqueue_script( 'viewportcheck-script');
			wp_enqueue_script( 'edsanimate-script');
			wp_enqueue_script( 'edsanimate-site-script');		
		} else {		    
		    if( file_exists( plugin_dir_path( self::$abs_file ) . "assets/css/custom.css" ) ) {
        		    wp_register_style( 'edsanimate-custom-css',plugins_url( '/assets/css/custom.css', self::$abs_file ));
        		    wp_enqueue_style( 'edsanimate-custom-css' );		        
        		} else {
        		    if( $custom_css != null && trim($custom_css) != "" ) {
            		    wp_register_style( 'edsanimate-blank-css',plugins_url( '/assets/css/blank.css', self::$abs_file ) );
            		    wp_enqueue_style( 'edsanimate-blank-css' );
            		    wp_add_inline_style( 'edsanimate-blank-css', $custom_css );
        		    }
        		}
		}	
		
		
	}	
	
	function add_eds_script_and_css_admin() {
	    $custom_css = '.mce-tinymce-inline .mce-flow-layout { white-space: normal !important; }';
	    wp_register_style( 'edsanimate-blank-css',plugins_url( '/assets/css/blank.css', self::$abs_file ) );
	    wp_enqueue_style( 'edsanimate-blank-css' );
	    wp_add_inline_style( 'edsanimate-blank-css', $custom_css );
	}
	
	function edsanimate_handler( $attributes, $content = null ) {
	
		$device_type = $this->detect_device();
	
		$enable_smart_phone = get_option('eds_enable_on_phone');
		$enable_tablet =  get_option('eds_enable_on_tab');
	
	
		$enable= ($device_type=='phone' && intval($enable_smart_phone))
		|| ($device_type =='tablet' && intval($enable_tablet))
		|| ($device_type =='computer');
	
		if($enable):
		
			extract( shortcode_atts( array(
					'animation' => '',
					'delay' => '',
					'duration' => '',
					'infinite_animation' =>'',
					'animate_on' => '',
					'scroll_offset' => ''
			), $attributes ) );
		
		
			$classString = "animated";
		
			if($animation == '')
			{
				return do_shortcode($content);
			}
		
			$classString .= " " . $animation;
		
			if(strcasecmp($infinite_animation, 'yes')==0) {
				$classString .= " infinite";
			}
		
			if($delay!= '' && is_int((int)$delay) && $delay>=0) {
				$classString .= " delay" . $delay;
			}
						
			if($duration!= '' && is_int((int)$duration) && $duration>=0) {			
				$classString .= " duration" . $duration;
			} else {
				$classString .= " duration2";
			}
		
			if(strcasecmp($animate_on, 'scroll')==0) {
				$classString .= " eds-on-scroll";
			} else if(strcasecmp($animate_on, 'click')==0) {
				$classString .= " eds-on-click";
			} else if(strcasecmp($animate_on, 'hover')==0) {
				$classString .= " eds-on-hover";
			}
									
										
			if(isset($scroll_offset) && $scroll_offset!=''){
				return '<div class="'.$classString.'" eds_scroll_offset="'.$scroll_offset.'">'.do_shortcode($content).'</div>';
			}else {
				return '<div class="'.$classString.'">'.do_shortcode($content).'</div>';
			}
			
		else:
			return do_shortcode($content);
		endif;
	
	}
	
	
	
	function edsanimate_start_handler( $attributes, $content = null ) {
		
		$device_type = $this->detect_device();
	
		$enable_smart_phone = get_option('eds_enable_on_phone');
		$enable_tablet =  get_option('eds_enable_on_tab');
	
	
		$enable= ($device_type=='phone' && intval($enable_smart_phone))
		|| ($device_type =='tablet' && intval($enable_tablet))
		|| ($device_type =='computer');
		
		if( !$enable ) {
			return '';
		}	
			
		$hide_on_load_css_class = '';
		$entry_animation = isset( $attributes['entry_animation_type'] ) ? $attributes['entry_animation_type']: '';
						
		if( 'scroll' == $attributes['animate_on'] || 'load' == $attributes['animate_on'] ) {
			$hide_on_load_css_class = ( in_array( $entry_animation, $this->in_animations ) ) ? 'edsanimate-sis-hidden' : '';
		}
		$content = array(
				'<div class="eds-animate ', $hide_on_load_css_class, ' ', isset( $attributes['custom_css_class'] ) ? $attributes['custom_css_class'] : '', '"',
				' data-eds-entry-animation="', $entry_animation, '"',
				' data-eds-entry-delay="', isset( $attributes['entry_delay'] ) ? $attributes['entry_delay'] : '', '"',
				' data-eds-entry-duration="', isset( $attributes['entry_duration'] ) ? $attributes['entry_duration'] : '', '"',
				' data-eds-entry-timing="', isset( $attributes['entry_timing'] ) ? $attributes['entry_timing'] : '', '"',
				' data-eds-exit-animation="', isset( $attributes['exit_animation_type'] ) ? $attributes['exit_animation_type'] : '', '"',
				' data-eds-exit-delay="', isset( $attributes['exit_delay'] ) ? $attributes['exit_delay'] : '', '"',
				' data-eds-exit-duration="', isset( $attributes['exit_duration'] ) ? $attributes['exit_duration'] : '', '"',
				' data-eds-exit-timing="', isset( $attributes['exit_timing'] ) ? $attributes['exit_timing'] : '', '"',
				' data-eds-repeat-count="', isset( $attributes['animation_repeat'] ) ? $attributes['animation_repeat'] : '', '"',
				' data-eds-keep="', isset( $attributes['keep'] ) ? $attributes['keep'] : '', '"',
				' data-eds-animate-on="', isset( $attributes['animate_on'] ) ? $attributes['animate_on'] : '', '"',
				' data-eds-scroll-offset="', isset( $attributes['scroll_offset'] ) ? $attributes['scroll_offset'] :'', '">' );
		
		return implode( "", $content );		
	}
	
	function edsanimate_end_handler( $attributes, $content = null ) {
		
		$device_type = $this->detect_device();
		
		$enable_smart_phone = get_option('eds_enable_on_phone');
		$enable_tablet =  get_option('eds_enable_on_tab');
		
		
		$enable= ($device_type=='phone' && intval($enable_smart_phone))
		|| ($device_type =='tablet' && intval($enable_tablet))
		|| ($device_type =='computer');
		
		if( !$enable ) {
			return '';
		}
		
		return '</div>';
		
	}
	
	//Widget settings related functions	
	function eds_add_custom_class_field( $t, $return, $instance ){
		$instance = wp_parse_args( (array) $instance, array( 'eds_animation_class' => '') );
		if ( !isset( $instance['eds_animation_class'] ) )
			$instance['eds_animation_class'] = null;
			?>
	    <p>
	    	<label for="<?php echo $t->get_field_id('eds_animation_class'); ?>"><?php _e( 'Animate It Classes', 'eds-animate' ); ?></label>
	        <input type="text" name="<?php echo $t->get_field_name('eds_animation_class'); ?>" id="<?php echo $t->get_field_id('eds_animation_class'); ?>" value="<?php echo $instance['eds_animation_class'];?>" />         
	    </p>   
	    <?php
	    $retrun = null;
	    return array( $t, $return, $instance );
		
	}
	
	
	function eds_update_widget_animation_class( $instance, $new_instance, $old_instance ){
		$instance['eds_animation_class'] = $new_instance['eds_animation_class'];
		return $instance;
	}
	
	function eds_add_widget_animation_class( $params ){
		global $wp_registered_widgets;
	    $widget_id = $params[0]['widget_id'];
	    $widget_obj = $wp_registered_widgets[$widget_id];
	    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
	    $widget_num = $widget_obj['params'][0]['number'];
	    if( isset($widget_opt[$widget_num]['eds_animation_class'] ) ){
	    	$eds_animation_class = $widget_opt[$widget_num]['eds_animation_class'];
	    	$params[0]['before_widget'] = preg_replace('/class="/', 'class=" '.$eds_animation_class.' ',  $params[0]['before_widget'], 1);
	    }
		return $params;
	}	
}

if( !defined( 'WPINC' ) ) {
	die;	
}

global $eds_animate_it_version;

$eds_animate_it_version = '2.3.0';

new EDS_Animate( __FILE__ );