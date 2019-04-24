<?php
/**
 * look created by ThemeRuby
 * Base template file
 */
?>
<?php get_header( look_ruby_base_template() ); ?>
<body <?php body_class(); look_ruby_schema::markup( 'body', true ) ?>>
<?php get_template_part( 'templates/header/module', 'off_canvas' ); ?>
<div class="main-site-outer">
	<?php get_template_part( 'templates/section', 'header' ); ?>
	<div class="main-site-wrap">
		<div class="main-site-mask"></div>
		<div id="ruby-site-content" class="main-site-content-wrap clearfix">
			<?php include look_ruby_base_template_path(); ?>
		</div><!--#main site content-->
<?php get_footer( look_ruby_base_template() ); ?>
