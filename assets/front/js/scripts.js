/**
 * EEM - Scripts - Front
 */

(function ($, window, document, pluginObject) {
    "use strict";


    $(document).ready(function () {

        $('.single-event select').niceSelect();

        var gallery_zoom = $('.gallery-zoon-icon');

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

        var $fb_box_content = $('.eem-fb-content-wrap');

        $fb_box_content.bind('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e){
            if( $fb_box_content.hasClass('state-leave') ) {
                $fb_box_content.removeClass('state-leave');
            }
        });

        $('.close-fb-box').on('click', function () {
            $fb_box_content.removeClass('state-appear').addClass('state-leave');
        });

        $('.open-fb-box').on('click', function () {
            $fb_box_content.removeClass('state-leave').addClass('state-appear');
        });

    })

})(jQuery, window, document, eem_object);




