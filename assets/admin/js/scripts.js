/**
 * EEM - Scripts - Admin
 */

(function ($, window, document, pluginObject) {
    "use strict";

    /**
     * Document onReady
     */
    $(document).on('ready', function () {

        $(".eem-repeat-container").sortable({
            handle: ".eem-repeat-sort",
            revert: true
        });
    } );


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
    } );


    /**
     * Add Day button Click Listener
     */
    $(document).on('click', '.eem-add-day', function () {

        let unique_id = $.now(), index_id = $( '.eem-side-nav-container .eem-side-nav .eem-side-nav-item').length;

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

                if( response.success ) {
                    $('.eem-side-nav-container .eem-side-nav').append( response.data.day_nav );
                    $('.eem-side-nav-container .eem-side-nav-content').append( response.data.day_content );

                    $( '.eem-side-nav-container .eem-side-nav .eem-side-nav-item').last().trigger('click');
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


