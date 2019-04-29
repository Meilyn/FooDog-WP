<?php
/**
 * Settings Page
 *
 * @package WP Featured Post
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap wpfp-settings">

<h2><?php _e( 'WPOS Featured Post Settings', 'featured-post' ); ?></h2><br />

<?php

// Success message
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p><strong>'.__("Your changes saved successfully.", "featured-post").'</strong></p>
		  </div>';
}
?>

<form action="options.php" method="POST" id="wpfp-settings-form" class="wpfp-settings-form">
	
	<?php settings_fields( 'wpfp_plugin_options' ); ?>
	
	<!-- Custom CSS Settings Starts -->
	<div id="wpfp-custom-css-sett" class="post-box-container wpfp-custom-css-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="custom-css" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Custom CSS Settings', 'featured-post' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wpfp-custom-css-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wpfp-custom-css"><?php _e('Custom CSS', 'featured-post'); ?></label>
									</th>
									<td>
										<textarea name="wpfp_options[custom_css]" class="large-text wpfp-custom-css" id="wpfp-custom-css" rows="15"><?php echo esc_textarea( wpfp_get_option('custom_css') ); ?></textarea><br/>
										<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'featured-post'); ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wpfp-settings-submit" name="wpfp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','featured-post'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #custom-css -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wpfp-custom-css-sett -->
	<!-- Custom CSS Settings Ends -->

</form><!-- end .wpfp-settings-form -->

</div><!-- end .wpfp-settings -->