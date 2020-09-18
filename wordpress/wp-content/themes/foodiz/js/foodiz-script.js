    (function ($) {

        jQuery(document).ready(function () {
            $('.hero-post-slides').owlCarousel({

                /*margin: 10,*/
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                        loop: true,
                    },
                    600: {
                        items: 1,
                        nav: false,
                        loop: true,
                        autoplayTimeout: 7000,
                        smartSpeed: 1000,
                        autoplay: true,
                        center: true
                    },
                    1000: {
                        items: 1,
                        nav: false,
                        //loop: true,
                        autoplayTimeout: 7000,
                        smartSpeed: 1000,
                        autoplay: false,
                        //center: true
                    }
                }
            })
        });
    })(jQuery);


        (function ($) {

        jQuery(document).ready(function () {
            $('.owl-blog').owlCarousel({

                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                        loop: true,
                    },
                    600: {
                        items: 2,
                        nav: false,
                        //loop: true,
                        autoplayTimeout: 7000,
                        smartSpeed: 1000,
                        autoplay: true,
                        //center: true
                    },
                    1000: {
                        items: 3,
                        nav: false,
                        //loop: true,
                        autoplayTimeout: 7000,
                        smartSpeed: 1000,
                        autoplay: true,
                        //center: true
                    }
                }
            })
        });
    })(jQuery);