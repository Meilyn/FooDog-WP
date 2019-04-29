<?php
/**
 * Represents the view for the administration dashboard.
 *
 * @package   NS_Featured_Posts
 * @author    Nilambar Sharma <nilambar@outlook.com>
 * @license   GPL-2.0+
 * @link      https://nilambar.net
 * @copyright 2013 Nilambar Sharma
 */

?>
<div class="wrap">


  <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

  <div id="poststuff">

    <div id="post-body" class="metabox-holder columns-2">

      <!-- main content -->
      <div id="post-body-content">

        <div class="meta-box-sortables ui-sortable">

          <div class="postbox">


            <div class="inside">


				<form action="options.php" method="post">
				<?php settings_fields( 'nsfp-plugin-options-group' ); ?>
				<?php do_settings_sections( 'ns-featured-posts-main' ); ?>


				<?php submit_button( __( 'Save Changes', 'ns-featured-posts' ) ); ?>
				</form>



            </div> <!-- .inside -->

          </div> <!-- .postbox -->

        </div> <!-- .meta-box-sortables .ui-sortable -->

      </div> <!-- post-body-content -->

      <!-- sidebar -->
      <div id="postbox-container-1" class="postbox-container">

        <?php require_once( ( plugin_dir_path( __FILE__ ) ) . 'admin-right.php' ); ?>

      </div> <!-- #postbox-container-1 .postbox-container -->

    </div> <!-- #post-body .metabox-holder .columns-2 -->

    <br class="clear">
  </div> <!-- #poststuff -->

</div> <!-- .wrap -->
