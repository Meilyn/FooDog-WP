<?php
$dynamic_height = ($grid_count == 1 ) ? $image_height : ($image_height/2);
$height_css 	= ($dynamic_height) ? 'height:'.$dynamic_height.'px;' : '';
$container_cls 	= ($i == 1) ? 'wpfp-medium-6 wpfp-medium-left' : "wpfp-medium-3 wpfp-medium-right";
?>

<div class="<?php echo $container_cls; ?> wpfpcolumns" style="<?php echo $height_css; ?>">
	<a class="wpfp-link-overlay" href="<?php the_permalink(); ?>"></a>
	<div class="wpfp-grid-content">
		<div class="wpfp-overlay">

			<div class="wpfp-image-bg">
				<?php if( !empty($feat_image) ) { ?>
				<img src="<?php echo $feat_image; ?>" alt="<?php the_title_attribute(); ?>" />
				<?php } ?>
			</div>

			<div class="wpfp-bottom-content">
				<?php if($showCategory == "true" && $cate_name !='') { ?>
					<div class="wpfp-categories">
						<?php echo $cate_name; ?>
					</div>
				<?php } ?>

				<div class="wpfp-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>

				<?php if($showDate == "true" || $showAuthor == 'true') { ?>
				<div class="wpfp-date">		
					<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'featured-post' ); ?> <?php the_author(); ?></span><?php } ?>
					<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
					<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>