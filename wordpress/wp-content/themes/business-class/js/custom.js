(function ($) {

    $(function ($) {

        var isRtl = business_class_localized.is_rtl ? true : false;

        // Search in header.
        if ($('.search-icon').length > 0) {
            $('.search-icon').on('click', function (e) {
                e.preventDefault();
                $('.search-box-wrap').stop().slideToggle();
            });
        }
        $(document).on("click ", function(event){
            var $trigger = $("#header-search");
            if($trigger !== event.target && !$trigger.has(event.target).length){
                $(".search-box-wrap").hide();
            }            
        });

        //Fixed header.
        $(window).on('scroll', function () {
            if ($(window).scrollTop() > $('.sticky-enabled').offset().top && !($('.sticky-enabled').hasClass('sticky-header'))) {
                $('.sticky-enabled').addClass('sticky-header');
            } else if (0 === $(window).scrollTop()) {
                $('.sticky-enabled').removeClass('sticky-header');
            }
        });

        //Menu collapse
        $('.menu-toggle').on('click', function(){
            $(this).siblings('.menu-primary-menu-container').stop().slideToggle();
        })

        //Add to menu toggler button
        var toggler_btn = "<button type='button' class='children-toggler'><i class='fas fa-angle-down'></i></button>";
        $('.menu-item-has-children').append(toggler_btn);
        $('.children-toggler').on('click', function(){
            $(this).toggleClass('open');
            $(this).siblings('.sub-menu').stop().slideToggle();
        })

        // Init Isotope.
        var $grid = $('#portfolio').isotope({
            itemSelector: '.portfolio-item',
        });

        /**
         * Filter posts.
         */
        $('.filter').on('click', function () {
            var filter = $(this);
            var filterValue = filter.attr('data-filter');

            $('nav.portfolio-filter ul li a').removeClass('current');
            filter.addClass('current');

            $grid.isotope({
                filter: filterValue
            });
        });

        // Slick carousel column 1.
        $(".iteam-col-1.section-carousel-enabled").slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            rtl:isRtl,
            prevArrow: '<span data-role="none" class="slick-prev" tabindex="0"><i class="fas fa-angle-left" aria-hidden="true"></i></span>',
            nextArrow: '<span data-role="none" class="slick-next" tabindex="0"><i class="fas fa-angle-right" aria-hidden="true"></i></span>'
        });


        // Feature Slider
        $(".featrued-slider").slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl:isRtl,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span data-role="none" class="slick-prev" tabindex="0"><i class="fas fa-angle-left" aria-hidden="true"></i></span>',
            nextArrow: '<span data-role="none" class="slick-next" tabindex="0"><i class="fas fa-angle-right" aria-hidden="true"></i></span>'
        });


        // Feature Slider
        $(".testimonial-carousel").slick({
            dots: true,
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 2,
            arrows: false,
            rtl:isRtl,
            responsive: [{
                breakpoint: 900,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }],
            prevArrow: '<span data-role="none" class="slick-prev" tabindex="0"><i class="fas fa-angle-left" aria-hidden="true"></i></span>',
            nextArrow: '<span data-role="none" class="slick-next" tabindex="0"><i class="fas fa-angle-right" aria-hidden="true"></i></span>'
        });
        // Implement go to top.
        var $scroll_obj = $('#btn-scrollup');
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 100) {
                $scroll_obj.fadeIn();
            } else {
                $scroll_obj.fadeOut();
            }
        });

        $scroll_obj.on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 600);
            return false;
        });


    });

    /**
   * =========================
   * Accessibility codes start
   * =========================
   */
        $(document).on('mousemove', 'body', function (e) {
            $(this).removeClass('keyboard-nav-on');
        });
        $(document).on('keydown', 'body', function (e) {
            if (e.which == 9) {
            $(this).addClass('keyboard-nav-on');
            }
        });
  /**
   * =========================
   * Accessibility codes end
   * =========================
   */


})(jQuery);