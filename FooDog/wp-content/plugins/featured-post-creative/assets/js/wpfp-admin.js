jQuery( document ).ready(function($) {

	// Select Featured Post
	$( document ).on( 'click', '.wpfp-select-featured', function() {

		var current_obj = $(this);
		var post_id 	= $(this).attr('data-post-id');
		var feat_val 	= 1;
		
		if (current_obj.hasClass("dashicons-star-filled")){
			feat_val 	= 0;
		}

		var data 		= {
							action		: 'wpfp_update_featured_post',
							feat_id		: post_id,
							is_feat		: feat_val
						};
			$.post(ajaxurl,data,function(response) {
				var result = $.parseJSON(response);
				
				if( result.success == 1 ) {
					
					if (feat_val == 0) {
						current_obj.removeClass("dashicons-star-filled").addClass("dashicons-star-empty");
					}else{
						current_obj.removeClass("dashicons-star-empty").addClass("dashicons-star-filled");
					}
					
				}
        	});

	});
})