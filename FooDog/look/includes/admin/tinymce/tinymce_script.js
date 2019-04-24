(function () {
    tinymce.PluginManager.add('look_ruby_shortcode', function (editor, url) {
        editor.addButton('look_ruby_button_key', {
            type: 'listbox',
            text: 'Shortcodes',
            classes: 'btn ruby-tinymce-dropdown',
            icon: false,
            onselect: function (e) {
            },
            values: [
                {text: 'Button', classes: 'ruby_tinymce_dropdown_label'},
                {text: 'Default', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button type="default" color="" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},
                {text: 'Round', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button type="round" color="" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},
                {text: '3D', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button type="3d" color="" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},
                {text: 'Drop cap', classes: 'ruby_tinymce_dropdown_label'},
                {text: 'Default', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[dropcap type="default"]' + tinyMCE.activeEditor.selection.getContent() + '[/dropcap]');
                }},
                {text: 'Background', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[dropcap type="background"]' + tinyMCE.activeEditor.selection.getContent() + '[/dropcap]');
                }},
                {text: 'Accordion', classes: 'ruby_tinymce_dropdown_label'},
                {text: 'Accordion group', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[accordion]' + tinyMCE.activeEditor.selection.getContent() + '[/accordion]');
                }},
                {text: 'Accordion item', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[accordion-item title=""]' + tinyMCE.activeEditor.selection.getContent() + '[/accordion-item]');
                }},
                {text: 'Column', classes: 'ruby_tinymce_dropdown_label'},
                {text: 'Column Wrapper', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[row]' + tinyMCE.activeEditor.selection.getContent() + '[/row]');
                }},
                {text: 'Column 1/2', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[column width="50%"]' + tinyMCE.activeEditor.selection.getContent() + '[/column]');
                }},
                {text: 'Column 1/3', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[column width="33%"]' + tinyMCE.activeEditor.selection.getContent() + '[/column]');
                }},
                {text: 'Column 2/3', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[column width="66%"]' + tinyMCE.activeEditor.selection.getContent() + '[/column]');
                }},
                {text: 'Column 1/4', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[column width="25%"]' + tinyMCE.activeEditor.selection.getContent() + '[/column]');
                }},
            ]
        });

    });
})();


