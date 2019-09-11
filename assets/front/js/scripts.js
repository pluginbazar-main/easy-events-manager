/**
 * EEM - Scripts - Front
 */

(function ($, window, document, pluginObject) {
    "use strict";


    $(document).ready(function () {

        $('.single-event select').niceSelect();

        let gallery_zoom = $('.gallery-zoon-icon');

        // Magnific Popup
        if ( gallery_zoom.length ) {
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
        
        let floating_box = $('.eem-floating-box');
    })

})(jQuery, window, document, eem_object);


