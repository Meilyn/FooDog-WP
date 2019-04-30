var look_ruby_setup_sections;
var look_ruby_setup_blocks;
var look_ruby_composer_template;
var look_ruby_composer_page_data;
var look_ruby_unload_page;

jQuery(document).ready(function($) {
    "use strict";

    /*********** LAYOUT PAGE BUILDER *************/

    $('#page_template').change(function() {

        var template = $('#page_template').val();
        //enable page composer
        if ('page-composer.php' == template) {
            $('#look_ruby_composer_editor').show();
            $('#look_ruby_metabox_composer_options').show();
            $('#look_ruby_metabox_sidebar_options').hide();
            $('#postdivrich').hide();
            $('#look_ruby_page_settings').hide();
            $('#look_ruby_metabox_single_page_options').hide();

        } else {
            $('#look_ruby_composer_editor').hide();
            $('#look_ruby_metabox_composer_options').hide();
            $('#postdivrich').show();
            $('#look_ruby_metabox_sidebar_options').show();
            $('#look_ruby_page_settings').show();
            $('#look_ruby_metabox_single_page_options').show();
        }
    }).triggerHandler('change');


    /*********** CORE *************/
    var look_ruby_page_builder = {

        /*********** INIT *************/
        //init
        init: function() {
            if ('undefined' === typeof look_ruby_composer_template) {
                return;
            }

            look_ruby_unload_page = false;
            look_ruby_page_builder.setup_section_select();
            look_ruby_page_builder.init_section();
            look_ruby_page_builder.update_composer();
        },

        //Init sections
        init_section: function() {
            var sections = $('#look_ruby_composer_editor').find('.ruby-sections-wrap');
            look_ruby_page_builder.render_section();

            sections.sortable({
                handle: '.ruby-section-bar',
                placeholder: 'ruby-highlight',
                forcePlaceholderSize: true
            });

        },


        //Init blocks
        init_block: function(new_section, section_data) {

            //Load block select
            look_ruby_page_builder.setup_block_select(new_section);

            //load block data
            if (section_data) {
                if (section_data['blocks']) {
                    $.each(section_data['blocks'], function(block_id, block_data) {
                        look_ruby_page_builder.load_block(block_data['block_name'], new_section.find('.ruby-block-wrap'), block_data);
                    })
                }
            }
            //add sortable block
            var block = new_section.find('.ruby-blocks');
            block.sortable({
                handle: '.ruby-block-bar',
                placeholder: 'ruby-highlight',
                forcePlaceholderSize: true
            });
        },


        /***********CREATE SECTION SELECT*************/
        setup_section_select: function() {

            var select_list = $('#look_ruby_section_select');

            //create section element
            $.each(look_ruby_setup_sections, function(section_type, config) {
                var select_item = $('<div class="section-select-el"><a href="#"></a></div>');
                if (config['img']) {
                    select_item = $('<div class="section-select-el"><a href="#"><img alt="' + section_type + '" src="' + config['img'] + '"></a></div>');
                }
                select_item.find('a').data('section_type', section_type).append('<span>' + config.title + '</span>');

                //create section list
                select_list.append(select_item);
            });

            //add section
            select_list.find('a').click(look_ruby_page_builder.add_section);

            //Toggle select section box
            $('#page_composer_section_select').click(function(e) {
                select_list.slideToggle(200);
                e.stopPropagation();
                return false;
            })

        },

        //add select block list
        setup_block_select: function(new_section) {

            var select_list = new_section.find('.block-select-wrap');

            $.each(look_ruby_setup_blocks, function(block_name, config) {
                if (config['section'] === new_section['section_type']) {
                    var select_item = $('<div class="block-select-el"><a href="#"></a></div>');
                    if (config['img']) {
                        select_item = $('<div class="block-select-el"><a href="#"><img alt="' + block_name + '" src="' + config['img'] + '"></a></div>');
                    }
                    select_item.find('a').data('block_name', block_name).append('<span>' + config.title + '</span>');

                    //create block list
                    select_list.append(select_item);
                }
            });

            select_list.find('a').click(look_ruby_page_builder.add_block);

            //Toggle select block box
            new_section.find('.add-block-select').click(function(e) {
                select_list.slideToggle(200);
                e.stopPropagation();
                return false;
            })
        },

        /***********CREATE SECTIONS*************/

        //click add section
        add_section: function() {

            //set unload
            look_ruby_unload_page = true;

            //get section type
            var section_type = $(this).data('section_type');

            //create section
            var new_section = look_ruby_page_builder.load_section(section_type, false);

            //scroll to section
            if (undefined != new_section) {
                $('body').animate({
                    scrollTop: new_section.offset().top
                }, 500);
            }

            return false;
        },

        //load section
        load_section: function(section_type, section_data) {

            var default_sidebar;
            var uuid;
            if ('undefined' === typeof look_ruby_composer_template[section_type]) return;

            //create unique id
            if ('undefined' === typeof section_data.section_id) {
                uuid = $.uuid();
            } else {
                uuid = section_data.section_id;
            }

            var section_id = 'look_ruby_section_' + uuid;
            var new_section = $(look_ruby_composer_template[section_type]);
            if (section_type == 'section_has_sidebar') {
                var sidebar_id = 'look_ruby_sidebar_' + uuid;
                var sidebar_position_id = 'look_ruby_sidebar_position_' + uuid;
                new_section.find('.ruby-section-sidebar').html(look_ruby_composer_template['input']['sidebar']);
                if ('undefined' === typeof section_data['section_sidebar_position'])
                    new_section.find('.ruby-sidebar-position').attr('name', sidebar_position_id);
                else
                    new_section.find('.ruby-sidebar-position').attr('name', sidebar_position_id).val(section_data['section_sidebar_position']);
                var sidebar_select = new_section.find('.ruby-sidebar-select');
                if ('undefined' === typeof section_data['section_sidebar'])
                    default_sidebar = 'look_ruby_sidebar_default';
                else
                    default_sidebar = section_data['section_sidebar'];
                sidebar_select.attr('name', sidebar_id).val(default_sidebar);
                new_section.find('.ruby-section-sidebar label').click(function() {
                    new_section.find('.ruby-sidebar-select-wrap').slideToggle(200);
                    return false;
                })
            }

            new_section.find('.ruby-section-type').attr('name', section_id).val(section_type);
            new_section.find('.ruby-section-order').val(uuid);
            new_section.find('.ruby-section-label').html(look_ruby_setup_sections[section_type].title);

            var section_wrap = $('#look_ruby_composer_editor').find('.ruby-sections-wrap');

            //append new section
            section_wrap.children('.ruby-section-empty').remove();
            section_wrap.append(new_section);

            //load button
            look_ruby_page_builder.button_section(new_section);

            //init block
            new_section['section_type'] = section_type; //filter block of section
            look_ruby_page_builder.init_block(new_section, section_data);

            return new_section;
        },

        //enable button section
        button_section: function(new_section) {
            new_section.find('.ruby-section-bar, .ruby-section-open-option').click(look_ruby_page_builder.open_section_setting);
            new_section.find('.ruby-section-delete').click(look_ruby_page_builder.delete_section);
        },

        //delete section
        delete_section: function(e) {

            //set unload
            look_ruby_unload_page = true;

            $(e.target).parents('.ruby-section').fadeOut(300, function() {
                $(this).remove()
            });
            return false;
        },

        //open section
        open_section_setting: function(e) {
            var section_setting = $(e.target).parents('.ruby-section').find('.ruby-block-wrap');
            section_setting.slideToggle();
            return false;
        },

        /***********BLOCK*************/
        //click add block
        add_block: function() {

            //set unload
            look_ruby_unload_page = true;

            var this_module = $(this);
            var block_name = this_module.data('block_name');
            var module_wrap = this_module.parents('.ruby-block-wrap');
            var new_block = look_ruby_page_builder.load_block(block_name, module_wrap, false);

            if (undefined != new_block) {
                $('body').animate({
                    scrollTop: new_block.offset().top
                }, 500, function() {
                    new_block.find('.ruby-block-open-option').trigger('click');
                });
            }

            return false;
        },

        //load block
        load_block: function(block_name, module_wrap, block_data) {

            var block_name_title;
            var block_name_desc;
            var uuid;

            //create unique id
            if ('undefined' === typeof block_data.block_id) {
                uuid = $.uuid();
            } else {
                uuid = block_data.block_id;
            }

            //load block names
            block_name_title = look_ruby_setup_blocks[block_name].title;
            block_name_desc = look_ruby_setup_blocks[block_name].description;

            module_wrap.find('.ruby-section-empty').remove();
            var id = 'look_ruby_block_' + uuid;
            var new_block = $(look_ruby_composer_template['block']);
            var module_id = module_wrap.find('.ruby-section-order').val();
            new_block.find('.ruby-block-name').attr('name', id).val(block_name);
            new_block.find('.ruby-block-order').attr('name', 'look_ruby_block_order[' + module_id + '][]').val(uuid);
            new_block.find('.ruby-block-description').html(block_name_desc);
            if (block_data && block_data['block_options']['title']) {
                new_block.find('.ruby-block-label').html(block_name_title + ' : ' + block_data['block_options']['title']);
            } else {
                new_block.find('.ruby-block-label').html(block_name_title);
            }

            var block_wrap = module_wrap.find('.ruby-blocks');

            //load block options
            look_ruby_page_builder.block_setting_options(new_block, block_name, block_data['block_options']);

            //append new block
            block_wrap.append(new_block);

            //load button
            look_ruby_page_builder.button_block(new_block);

            return new_block;
        },

        //enable button block
        button_block: function(new_block) {
            new_block.find('.ruby-block-bar, .ruby-block-open-option').click(look_ruby_page_builder.open_block_setting);
            new_block.find('.ruby-block-delete').click(look_ruby_page_builder.delete_block);
        },

        //delete block
        delete_block: function(e) {

            //set unload
            look_ruby_unload_page = true;

            $(e.target).parents('.ruby-block-item').fadeOut(300, function() {
                $(this).remove()
            });
            return false;
        },

        //open block
        open_block_setting: function(e) {
            var block_setting = $(e.target).parents('.ruby-block-item').find('.ruby-block-options-wrap');
            block_setting.slideToggle();
            return false;
        },

        /*********** LOAD BLOCK OPTIONS *************/
        block_setting_options: function(new_block, block_name, look_ruby_default_value) {
            var block_id = new_block.find('.ruby-block-name').attr('name');

            $.each(look_ruby_setup_blocks, function(name, config) {

                //check option block
                if ($(config.block_options).length == 0) return;

                //check block and get setting option of block
                if (block_name == name) {

                    //remove hidden class
                    new_block.find('.ruby-block-options-wrap').removeClass('hidden');

                    //render block options
                    $.each(config.block_options, function(option, value) {

                        var title;
                        var input;
                        var description;
                        var new_block_options = $(look_ruby_composer_template['block_option']);

                        //check if false then return
                        if (value === false) {
                            return;
                        }

                        //render title options
                        if (option == 'title') {
                            title = look_ruby_composer_template['title']['title'];
                            description = look_ruby_composer_template['desc']['title'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        //render title url
                        if (option == 'title_url') {
                            title = look_ruby_composer_template['title']['title_url'];
                            description = look_ruby_composer_template['desc']['title_url'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        //render category option
                        if (option == 'category_id') {
                            title = look_ruby_composer_template['title']['category_id'];
                            description = look_ruby_composer_template['desc']['category_id'];
                            input = look_ruby_composer_template['input']['category'];
                        }

                        //render categories option
                        if (option == 'category_ids') {
                            title = look_ruby_composer_template['title']['category_ids'];
                            description = look_ruby_composer_template['desc']['category_ids'];
                            input = look_ruby_composer_template['input']['categories'];
                        }

                        //render post format option
                        if (option == 'post_format') {
                            title = look_ruby_composer_template['title']['post_format'];
                            description = look_ruby_composer_template['desc']['post_format'];
                            input = look_ruby_composer_template['input']['post_format'];
                        }

                        //render tags option
                        if (option == 'tags') {
                            title = look_ruby_composer_template['title']['tags'];
                            description = look_ruby_composer_template['desc']['tags'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        //render authors option
                        if (option == 'authors') {
                            title = look_ruby_composer_template['title']['authors'];
                            description = look_ruby_composer_template['desc']['authors'];
                            input = look_ruby_composer_template['input']['authors'];
                        }

                        //render posts per page option
                        if (option == 'posts_per_page') {
                            title = look_ruby_composer_template['title']['posts_per_page'];
                            description = look_ruby_composer_template['desc']['posts_per_page'];
                            input = look_ruby_composer_template['input']['num'];
                        }

                        //render number of slider
                        if (option == 'num_of_slider') {
                            title = look_ruby_composer_template['title']['num_of_slider'];
                            description = look_ruby_composer_template['desc']['num_of_slider'];
                            input = look_ruby_composer_template['input']['num'];
                        }

                        //render posts offset option
                        if (option == 'offset') {
                            title = look_ruby_composer_template['title']['offset'];
                            description = look_ruby_composer_template['desc']['offset'];
                            input = look_ruby_composer_template['input']['num'];
                        }

                        //render posts sorted option
                        if (option == 'orderby') {
                            title = look_ruby_composer_template['title']['orderby'];
                            description = look_ruby_composer_template['desc']['orderby'];
                            input = look_ruby_composer_template['input']['orderby'];
                        }


                        //render posts excerpt
                        if (option == 'excerpt') {
                            title = look_ruby_composer_template['title']['excerpt'];
                            description = look_ruby_composer_template['desc']['excerpt'];
                            input = look_ruby_composer_template['input']['num'];
                        }

                        //render read more button
                        if (option == 'readmore') {
                            title = look_ruby_composer_template['title']['readmore'];
                            description = look_ruby_composer_template['desc']['readmore'];
                            input = look_ruby_composer_template['input']['show_options'];
                        }

                        //render option content
                        if (option == 'content') {
                            title = look_ruby_composer_template['title']['content'];
                            description = look_ruby_composer_template['desc']['content'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        //render option image url
                        if (option == 'image_url') {
                            title = look_ruby_composer_template['title']['image_url'];
                            description = look_ruby_composer_template['desc']['image_url'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        //render option image link
                        if (option == 'image_link') {
                            title = look_ruby_composer_template['title']['image_link'];
                            description = look_ruby_composer_template['desc']['image_link'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        //render option button title
                        if (option == 'button_title') {
                            title = look_ruby_composer_template['title']['button_title'];
                            description = look_ruby_composer_template['desc']['button_title'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        //render posts pagination
                        if (option == 'pagination') {
                            title = look_ruby_composer_template['title']['pagination'];
                            description = look_ruby_composer_template['desc']['pagination'];
                            var input_buffer = look_ruby_composer_template['input']['pagination'];
                            input_buffer = jQuery.parseHTML(input_buffer);
                            $.each(value, function(type, val) {
                                if (val == false) {
                                    $(input_buffer).find('option[value=' + type + ']').remove();
                                }
                            });
                            input = $(input_buffer)[0].outerHTML;
                        }

                        //render code content
                        if (option == 'custom_html') {
                            title = look_ruby_composer_template['title']['custom_html'];
                            description = look_ruby_composer_template['desc']['custom_html'];
                            input = look_ruby_composer_template['input']['textarea'];
                        }

                        //render short code
                        if (option == 'shortcode') {
                            title = look_ruby_composer_template['title']['shortcode'];
                            description = look_ruby_composer_template['desc']['shortcode'];
                            input = look_ruby_composer_template['input']['textarea'];
                        }

                        //render block style
                        if (option == 'block_style') {
                            title = look_ruby_composer_template['title']['block_style'];
                            description = look_ruby_composer_template['desc']['block_style'];
                            input = look_ruby_composer_template['input']['block_style'];
                        }

                        //render wrap mode
                        if (option == 'wrap_mode') {
                            title = look_ruby_composer_template['title']['wrap_mode'];
                            description = look_ruby_composer_template['desc']['wrap_mode'];
                            input = look_ruby_composer_template['input']['wrap_mode'];
                        }

                        //render 1st classic post
                        if (option == 'big_first') {
                            title = look_ruby_composer_template['title']['big_first'];
                            description = look_ruby_composer_template['desc']['big_first'];
                            input = look_ruby_composer_template['input']['enable'];
                        }

                        if (option == 'color') {
                            title = look_ruby_composer_template['title']['color'];
                            description = look_ruby_composer_template['desc']['color'];
                            input = look_ruby_composer_template['input']['color'];
                        }

                        //ad box
                        if (option == 'ad_title') {
                            title = look_ruby_composer_template['title']['ad_title'];
                            description = look_ruby_composer_template['desc']['ad_title'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        if (option == 'ad_image') {
                            title = look_ruby_composer_template['title']['ad_image'];
                            description = look_ruby_composer_template['desc']['ad_image'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        if (option == 'ad_url') {
                            title = look_ruby_composer_template['title']['ad_url'];
                            description = look_ruby_composer_template['desc']['ad_url'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        if (option == 'ad_script') {
                            title = look_ruby_composer_template['title']['ad_script'];
                            description = look_ruby_composer_template['desc']['ad_script'];
                            input = look_ruby_composer_template['input']['textarea'];
                        }

                        //view more link
                        if (option == 'view_more') {
                            title = look_ruby_composer_template['title']['view_more'];
                            description = look_ruby_composer_template['desc']['view_more'];
                            input = look_ruby_composer_template['input']['enable'];
                        }

                        if (option == 'view_more_text') {
                            title = look_ruby_composer_template['title']['view_more_text'];
                            description = look_ruby_composer_template['desc']['view_more_text'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        if (option == 'view_more_link') {
                            title = look_ruby_composer_template['title']['view_more_link'];
                            description = look_ruby_composer_template['desc']['view_more_link'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        //title color
                        if (option == 'title_color') {
                            title = look_ruby_composer_template['title']['title_color'];
                            description = look_ruby_composer_template['desc']['title_color'];
                            input = look_ruby_composer_template['input']['text'];
                        }

                        //auto play
                        if (option == 'auto_play') {
                            title = look_ruby_composer_template['title']['auto_play'];
                            description = look_ruby_composer_template['desc']['auto_play'];
                            input = look_ruby_composer_template['input']['auto_play'];
                        }

                        //create ruby options
                        input = $(input);

                        //set default value for number
                        if (typeof value != 'boolean' && typeof value != 'object' && input.length) {
                            input.val(value);
                        }

                        //set value form database
                        if (look_ruby_default_value && typeof look_ruby_default_value[option] != 'undefined') {
                            input.val(look_ruby_default_value[option]);
                        }

                        //check multi select
                        if ('category_ids' == option) {
                            input.attr('name', 'look_ruby_block_option[' + block_id + '][' + option + '][]');
                        } else {
                            input.attr('name', 'look_ruby_block_option[' + block_id + '][' + option + ']');
                        }

                        new_block_options.find('.ruby-block-option-label').append(title);
                        new_block_options.find('.ruby-block-option-description').append(description);
                        new_block_options.find('.ruby-block-option-inner').append(input);

                        //append setting
                        new_block.find('.ruby-block-options-wrap').append(new_block_options);
                    })
                }
            });

            return new_block;
        },

        /*********** LOAD SAVED PAGE BUILDER*************/
        render_section: function() {
            var look_ruby_composer_editor = $('#look_ruby_composer_editor');

            if ('undefined' === typeof look_ruby_composer_page_data) {
                look_ruby_composer_editor.find('#ruby-page-composer-loading').fadeTo(500, 0, function() {
                    $(this).remove();
                });
                return;
            }

            $.each(look_ruby_composer_page_data, function(section_id, section_data) {
                look_ruby_page_builder.load_section(section_data['section_type'], section_data);
            });

            look_ruby_composer_editor.find('#ruby-page-composer-loading').fadeTo(500, 0, function() {
                $(this).remove();
            })
        },

        //check update button
        update_composer: function() {
            //check click on
            $('body').find('#publishing-action').click(function() {
                look_ruby_unload_page = false;
            });

            //unload page
            $(window).on('beforeunload', function() {
                if (true === look_ruby_unload_page) {
                    look_ruby_unload_page = false;
                    return look_ruby_composer_template['unload'];
                }
            })
        }

        /*********** END CORE *************/
    };

    //create unique id
    $.uuid = function() {
        return 'ruby_' + 'xxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    };

    //init load
    look_ruby_page_builder.init();

});