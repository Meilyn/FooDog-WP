<div class="header-nav-wrap clearfix">
	<div class="header-nav-inner">
		<div class="ruby-container">
			<div class="header-nav-holder clearfix">
				<?php get_template_part( 'templates/header/module', 'off_canvas_btn' ); ?>

				<div id="navigation" class="main-nav-wrap" <?php look_ruby_schema::markup( 'navigation', true ); ?>>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'look_ruby_main_navigation',
							'container'      => '',
							'menu_class'     => 'main-nav-inner',
							'walker'         => new look_ruby_Walker,
							'depth'          => '3',
							'echo'           => true,
							'fallback_cb'    => 'look_ruby_navigation_fallback'
						)
					);
					?>
				</div><!--#main navigation-->
				<?php get_template_part( 'templates/header/module', 'logo_mobile' ); ?>
				<?php get_template_part( 'templates/header/module', 'nav_search_icon' ); ?>
			</div>
		</div><!--#ruby container -->
	</div><!--#header nav inner -->
</div>
