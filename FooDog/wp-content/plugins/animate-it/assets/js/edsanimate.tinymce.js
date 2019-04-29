(function($, ajaxurl) {
	
	tinymce.create('tinymce.plugins.EDSAnimate', {
		init : function(ed, url) {
			ed.addButton('edsanimate', {
				title : 'Animate It!',
				icon : true,
				image : url+'/../images/edsanimate.png',
				onclick : function() {
					ed.windowManager.open({
						file : ajaxurl + '?action=edsanimate_get_popup',
						title: ed.getLang( 'edsanimate.modal_title', 'Select your Animation Style') + ":",
						width : window.innerWidth-100,
						height : window.innerHeight-100,
						inline : 1
					}, {			
						editor: ed,
						plugin_url : url, // Plugin absolute URL
						jquery: $ //jQuery Object
					});				
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Animate It! ShortCode",
				author : 'Eleopard Design Studios Pvt. Ltd.',
				authorurl : 'http://eleopard.in/',
				infourl : 'http://downloads.eleopard.in/',
				version : "1.0"
			};
		}
	});
	
	tinymce.PluginManager.add('edsanimate', tinymce.plugins.EDSAnimate);
	
})(jQuery, ajaxurl);
