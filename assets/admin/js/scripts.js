/**
 * EEM - Scripts - Admin
 */

(function ($, window, document, pluginObject) {
    "use strict";


    $(function () {
        $(".eem-repeat-container").sortable({
            handle: ".eem-repeat-sort",
            revert: true
        });

        $('.day_label_change_listener input[type=text]').on('change keyup paste', function (e) {
            var name = $(this).attr('name').replace(/]/g, '').split('['), value = $(this).val();
            $('.eem-side-nav-container .eem-side-nav-item').each(function () {
                if ($(this).attr('target') === 'schedule-' + name[1]) {
                    $(this).html(value);
                }
            });
        });


    });


    /**
     * Side Nam Item Click Action
     */
    $(document).on('click', '.eem-side-nav-container .eem-side-nav-item', function () {

        if ($(this).hasClass('active')) {
            return;
        }

        var target = $(this).attr('target');

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

        var target = $(this).attr('target');

        $('.eem-tab-panel .tab-nav-item').removeClass('active');
        $(this).addClass('active');

        $('.eem-tab-panel .tab-item-content').hide();
        $('.eem-tab-panel .tab-item-content.' + target).fadeIn();
    });

})(jQuery, window, document, eem_object);


