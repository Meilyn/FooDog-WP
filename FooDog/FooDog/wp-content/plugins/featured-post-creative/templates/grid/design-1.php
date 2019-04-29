<?php
$height_css 	= $image_height;
$grid_cls = "wpfp-medium-4";
if ($gridcol == "1") 
	{
		$grid_cls =	'wpfp-medium-12';	
	} else if ($gridcol == "2")
	{
		$grid_cls =	'wpfp-medium-6';
	}else if ($gridcol == "3")
	{
		$grid_cls =	'wpfp-medium-4';
	}else if ($gridcol == "4")
	{
		$grid_cls =	'wpfp-medium-3';
	}
?>

<div class="<?php echo $grid_cls; ?> wpfpcolumns">
	<a class="wpfp-link-overlay" href="<?php the_permalink(); ?>"></a>
	<div class="wpfp-grid-content">
		<div class="wpfp-overlay">
			<div class="wpfp-image-bg" style="height:<?php echo $height_css; ?>px;">
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