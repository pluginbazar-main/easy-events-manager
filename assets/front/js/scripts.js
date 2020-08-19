/**
 * EEM - Scripts - Front
 */

(function ($, window, document, pluginObject) {
    "use strict";


    $(document).ready(function () {

        $('.single-event select, .post-type-archive-event select, .pb-form .select select').niceSelect();

        var gallery_zoom = $('.gallery-zoom-icon');

        // Magnific Popup
        if (gallery_zoom.length) {
            gallery_zoom.magnificPopup({

                type: 'image',
                gallery: {enabled: true},
                removalDelay: 500,
                callbacks: {
                    beforeOpen: function () {
                        this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                        this.st.mainClass = this.st.el.attr('data-effect');
                    },

                    change: function () {
                        if (this.isOpen) {
                            this.wrap.addClass('mfp-open');
                        }
                    }
                },
                closeOnContentClick: false,
                midClick: false,

            });
        }

        // Floating Box
        var $fb_box_content = $('.eem-fb-content-wrap');

        $fb_box_content.bind('webkitAnimationEnd oanimationend msAnimationEnd animationend', function (e) {
            if ($fb_box_content.hasClass('state-leave')) {
                $fb_box_content.removeClass('state-leave');
            }
        });

        $('.close-fb-box').on('click', function () {
            $fb_box_content.removeClass('state-appear').addClass('state-leave');
        });

        $('.open-fb-box').on('click', function () {
            $fb_box_content.removeClass('state-leave').addClass('state-appear');
        });

        // Advance Search Toggle
        var $search_expand_btn = $('.eem-fields-expand-btn');

        $search_expand_btn.on('click', function () {
            $search_expand_btn.parent().parent().find('.advanced-field').slideToggle();
        });
    });


    $(document).on('submit', '.eem-register-form', function () {

        let registerForm = $(this),
            noticeArea = registerForm.find('.eem-form-notices'),
            noticeContent = $('<div class="eem-notice"></div>');

        noticeArea.html('');

        $.ajax({
            type: 'POST',
            url: pluginObject.ajaxurl,
            context: this,
            data: {
                'action': 'eem_add_attendees',
                'form_data': registerForm.serialize(),
            },
            success: function (response) {
                noticeContent.html(response.data).addClass(response.success ? 'eem-notice-success' : 'eem-notice-error');
                noticeContent.appendTo(noticeArea).hide().slideDown();
            }
        });

        return false;
    });


    $(document).on('click', '.eem-tab-panel .tab-nav-item', function () {

        let thisItem = $(this),
            tabNav = thisItem.parent(),
            tabPanel = tabNav.parent(),
            target = thisItem.data('target');

        if (thisItem.hasClass('active')) {
            return;
        }

        tabNav.find('.tab-nav-item').removeClass('active');
        thisItem.addClass('active');

        tabPanel.find('> .tab-content > .tab-item-content').hide();
        tabPanel.find('> .tab-content > .tab-item-content.' + target).fadeIn();
    });

})(jQuery, window, document, eem_object);




