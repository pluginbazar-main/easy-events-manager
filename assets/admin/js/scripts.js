/**
 * EEM - Scripts - Admin
 */

(function ($, window, document, pluginObject) {
    "use strict";

    /**
     * Document onReady
     */
    $(document).on('ready', function () {

        $('.eem-speakers .eem-repeat-head select, .nice-select-wrap select, form.eem-attendees-wrap select').niceSelect();

        $(".eem-repeat-container").sortable({
            handle: ".eem-repeat-sort",
            revert: true
        });
    });


    $(document).on('change', '.eem-attendees-wrap #event', function () {
        if( $(this).val().length !== 0 ) {
            $('form.eem-attendees-wrap').submit();
        }
    });


    /**
     * Change label of days
     */
    $(document).on('click', '.eem-sections-available .eem-section', function (e) {

        let thisSection = $(this),
            sectionID = thisSection.data('section-id'),
            selectedSections = $('.eem-templates-builder .eem-sections-selected');

        if (thisSection.hasClass('selected')) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: pluginObject.ajaxurl,
            context: this,
            data: {
                'action': 'eem_add_section',
                'section_id': sectionID,
            },
            success: function (response) {

                console.log(response);

                if (response.success) {
                    $(response.data).appendTo(selectedSections).hide().slideDown();
                    thisSection.addClass('selected');
                }
            }
        });
    });


    /**
     * Change label of days
     */
    $(document).on('change keyup paste', '.day_label_change_listener input[type=text]', function (e) {
        let name = $(this).attr('name').replace(/]/g, '').split('['), value = $(this).val();
        $('.eem-side-nav-container .eem-side-nav-item').each(function () {
            if ($(this).data('target') === 'schedule-' + name[1]) {
                $(this).html(value);
            }
        });
    });


    $(document).on('click', '.eem-repeat-close', function () {
        let itemToRemove = $(this).parent().parent();
        itemToRemove.slideUp();
        setTimeout(function () {
            itemToRemove.remove();
        }, 300);
    });


    $(document).on('click', '.eem-add-sponsor', function () {

        $.ajax({
            type: 'POST',
            url: pluginObject.ajaxurl,
            context: this,
            data: {
                'action': 'eem_add_new_sponsor',
                'unique_id': $.now(),
            },
            success: function (response) {

                if (response.success) {
                    $(response.data).appendTo($(this).parent().find('.eem-sponsors')).hide().slideDown();
                }
            }
        });
    });

    $(document).on('click', '.eem-add-speaker', function () {

        $.ajax({
            type: 'POST',
            url: pluginObject.ajaxurl,
            context: this,
            data: {
                'action': 'eem_add_new_speaker',
                'unique_id': $.now(),
            },
            success: function (response) {

                if (response.success) {
                    $(response.data).appendTo($(this).parent().find('.eem-speakers')).hide().slideDown();
                }
            }
        });
    });


    $(document).on('click', '.eem-add-session', function () {

        let unique_id = $.now(), scheduleID = $(this).data('schedule-id');

        $.ajax({
            type: 'POST',
            url: pluginObject.ajaxurl,
            context: this,
            data: {
                'action': 'eem_add_new_session',
                'unique_id': unique_id,
                'schedule_id': scheduleID,
            },
            success: function (response) {

                if (response.success) {
                    $(response.data).appendTo($(this).parent().find('.eem-sessions')).hide().slideDown();
                }
            }
        });
    });


    /**
     * Add Day button Click Listener
     */
    $(document).on('click', '.eem-add-day', function () {

        let unique_id = $.now(), index_id = $('.eem-side-nav-container .eem-side-nav .eem-side-nav-item').length;

        $.ajax({
            type: 'POST',
            url: pluginObject.ajaxurl,
            context: this,
            data: {
                'action': 'eem_add_new_day',
                'unique_id': unique_id,
                'index_id': index_id,
            },
            success: function (response) {

                if (response.success) {
                    $('.eem-side-nav-container .eem-side-nav').append(response.data.day_nav);
                    $('.eem-side-nav-container .eem-side-nav-content').append(response.data.day_content);

                    $('.eem-side-nav-container .eem-side-nav .eem-side-nav-item').last().trigger('click');
                }
            }
        });
    });


    /**
     * Side Nam Item Click Action
     */
    $(document).on('click', '.eem-side-nav-container .eem-side-nav-item', function () {

        if ($(this).hasClass('active')) {
            return;
        }

        let target = $(this).data('target');

        $(this).parent().find('.eem-side-nav-item').removeClass('active');
        $(this).addClass('active');

        $(this).parent().parent().find('.eem-side-nav-item-content').hide();
        $(this).parent().parent().find('.eem-side-nav-item-content.' + target).fadeIn();
    });


    $(document).on('click', '.eem-repeat-toggle', function (e) {

        $(this).parent().parent().find('.eem-repeat-content').slideToggle();
        $(this).parent().parent().toggleClass('active');
        $(this).find('i').toggleClass('icofont-curved-down icofont-curved-up');
    });

    $(document).on('click', '.eem-tab-panel .tab-nav-item', function () {

        if ($(this).hasClass('active')) {
            return;
        }

        let target = $(this).data('target');

        $('.eem-tab-panel .tab-nav-item').removeClass('active');
        $(this).addClass('active');

        $('.eem-tab-panel .tab-item-content').hide();
        $('.eem-tab-panel .tab-item-content.' + target).fadeIn();
    });

})(jQuery, window, document, eem_object);


