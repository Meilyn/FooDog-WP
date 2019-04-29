jQuery(document).ready(function ($) {
    "use strict";

    //post filter
    var select = $('#post-formats-select').find('[type="radio"]');
    select.live('change', function () {

        var val = $(this).val();
        var look_ruby_gallery_post = $('#look_ruby_metabox_gallery_options');
        var look_ruby_video_post = $('#look_ruby_metabox_video_options');
        var look_ruby_audio_post = $('#look_ruby_metabox_audio_options');

        look_ruby_gallery_post.hide();
        look_ruby_video_post.hide();
        look_ruby_audio_post.hide();

        if ('gallery' == val) {
            look_ruby_gallery_post.show();
        } else if ('video' == val) {
            look_ruby_video_post.show();
        } else if ('audio' == val) {
            look_ruby_audio_post.show();
        }
    }).filter(':checked').trigger('change');

    //review post
    var score_wrap = $('#look_ruby_metabox_review_options .inside .rwmb-meta-box > div:gt(0)');
    var look_ruby_review_checkbox = $('#look_ruby_enable_review');

    //hide reviews
    score_wrap.wrapAll('<div class="ruby-enabled-review">').hide();

    if (look_ruby_review_checkbox.is(":checked")) {
        score_wrap.show();
    }

    look_ruby_review_checkbox.click(function () {
        score_wrap.toggle();
    });

    function look_ruby_agv_score() {
        var i = 0;
        var look_ruby_cs1 = 0, look_ruby_cs2 = 0, look_ruby_cs3 = 0, look_ruby_cs4 = 0, look_ruby_cs5 = 0, look_ruby_cs6 = 0;

        var look_ruby_cd1 = $('input[name=look_ruby_cd1]').val();
        var look_ruby_cd2 = $('input[name=look_ruby_cd2]').val();
        var look_ruby_cd3 = $('input[name=look_ruby_cd3]').val();
        var look_ruby_cd4 = $('input[name=look_ruby_cd4]').val();
        var look_ruby_cd5 = $('input[name=look_ruby_cd5]').val();
        var look_ruby_cd6 = $('input[name=look_ruby_cd6]').val();
        if (look_ruby_cd1) {
            i += 1;
            look_ruby_cs1 = parseFloat($('input[name=look_ruby_cs1]').val());
        } else {
            look_ruby_cd1 = null;
        }
        if (look_ruby_cd2) {
            i += 1;
            look_ruby_cs2 = parseFloat($('input[name=look_ruby_cs2]').val());
        } else {
            look_ruby_cd2 = null;
        }
        if (look_ruby_cd3) {
            i += 1;
            look_ruby_cs3 = parseFloat($('input[name=look_ruby_cs3]').val());
        } else {
            look_ruby_cd3 = null;
        }
        if (look_ruby_cd4) {
            i += 1;
            look_ruby_cs4 = parseFloat($('input[name=look_ruby_cs4]').val());
        } else {
            look_ruby_cd4 = null;
        }
        if (look_ruby_cd5) {
            i += 1;
            look_ruby_cs5 = parseFloat($('input[name=look_ruby_cs5]').val());
        } else {
            look_ruby_cd5 = null;
        }
        if (look_ruby_cd6) {
            i += 1;
            look_ruby_cs6 = parseFloat($('input[name=look_ruby_cs6]').val());
        } else {
            look_ruby_cd6 = null;
        }
        var look_ruby_as = $('#look_ruby_as');

        var look_ruby_temp_total = (look_ruby_cs1 + look_ruby_cs2 + look_ruby_cs3 + look_ruby_cs4 + look_ruby_cs5 + look_ruby_cs6);
        var look_ruby_total = Math.round((look_ruby_temp_total / i) * 10) / 10;

        look_ruby_as.val(look_ruby_total);

        if (isNaN(look_ruby_total)) {
            look_ruby_as.val('');
        }
    }

    $('.rwmb-input').on('change', look_ruby_agv_score);

    $('#look_ruby_cs1, #look_ruby_cs2, #look_ruby_cs3, #look_ruby_cs4, #look_ruby_cs5, #look_ruby_cs6').on('slidechange', look_ruby_agv_score);

});


