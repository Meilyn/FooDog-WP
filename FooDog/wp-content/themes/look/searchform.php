<form  method="get" action="<?php echo esc_url(home_url('/')) ?>">
	<div class="ruby-search">
		<span class="ruby-search-input"><input type="text" class="field" placeholder="<?php esc_html_e('Search and hit enter&hellip;', 'look') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php esc_attr_e('Search for:', 'look') ?>"/></span>
		<span class="ruby-search-submit"><input type="submit" value="" /><i class="fa fa-search"></i></span>
	</div>
</form><!--#search form -->
