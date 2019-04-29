<?php
if ( has_post_format( 'video' ) ) {
	echo '<div class="post-format-info">';
	echo '<span class="post-format-icon is-video-format"><i class="fa fa-play"></i></span>';
	echo '</div><!--#post format info-->';
} elseif ( has_post_format( 'audio' ) ) {
	echo '<div class="post-format-info">';
	echo '<span class="post-format-icon is-audio-format"><i class="fa fa-volume-up"></i></span>';
	echo '</div><!--#post format info-->';
} elseif ( has_post_format( 'gallery' ) ) {
	echo '<div class="post-format-info">';
	echo '<span class="post-format-icon is-gallery-format"><i class="fa fa-camera"></i></span>';
	echo '</div><!--#post format info-->';
}
