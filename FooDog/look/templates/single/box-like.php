<?php
//check settings
$look_ruby_single_post_social_like = look_ruby_core::get_option( 'single_post_social_like' );
if ( empty( $look_ruby_single_post_social_like ) ) {
	return false;
}

$look_ruby_twitter_user = get_the_author_meta( 'twitter' );
if ( empty( $look_ruby_twitter_user ) ) {
	$look_ruby_twitter_user = look_ruby_core::get_option( 'look_ruby_pinterest' );
}
if ( empty( $look_ruby_twitter_user ) ) {
	$look_ruby_twitter_user = get_bloginfo( 'name' );
}

?>

<div class="single-like-wrap">
	<ul class="single-like-inner">
	<li class="like-el">
	<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink() ?>" data-text="<?php echo esc_attr( strip_tags( get_the_title() ) ) ?>" data-via="<?php echo urlencode( $look_ruby_twitter_user ); ?>" data-lang="en"></a>
		<script>!function (d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (!d.getElementById(id)) {
				js = d.createElement(s);
				js.id = id;
				js.src = "//platform.twitter.com/widgets.js";
				fjs.parentNode.insertBefore(js, fjs);
			}}(document, "script", "twitter-wjs");
		</script>
	</li>
	<li class="like-el">
		<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo get_permalink() ?>&amp;layout=button_count&amp;show_faces=false&amp;width=105&amp;action=like&amp;colorscheme=light&amp;height=21" style="border:none; overflow:hidden; width:105px; height:21px; background-color:transparent;"></iframe>
	</li>
	<li class="like-el">
		<div class="g-plusone" data-size="medium" data-href="<?php echo get_permalink() ?>"></div>
		<script type="text/javascript">
			(function() {
				var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
				po.src = "https://apis.google.com/js/plusone.js";
				var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
			})();
		</script>
	</li>
	</ul>
</div><!--like box -->
