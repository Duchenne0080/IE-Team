/**
 * custom script for frontend.
 *
 * @package Matina
 */

jQuery(document).ready(function($){

    "use-strict";

    var sidebarSticky   = MT_JSObject.sidebar_sticky;
    var headerSticky    = MT_JSObject.header_sticky;

    // define rtl value
    var rtlValue = $("body").hasClass("rtl");

    /**
     * Preloader
     */
    if( $('#preloader-background').length > 0 ) {
        setTimeout(function(){$('#preloader-background').hide();}, 600);
    }

    /**
     * Header search form toggle
     */
    $('.header-search-wrapper .search-icon').click(function() {
        $('.search-form-wrap').toggleClass('active-search');
        var element = document.querySelector( '.search-form-wrap.active-search' );
        if( element ) {
            $(document).on('keydown', function(e) {
                var focusable = element.querySelectorAll( 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                var firstFocusable = focusable[0];
                var lastFocusable = focusable[focusable.length - 1];
                matina_focus_trap( firstFocusable, lastFocusable, e );
            })
        }
    });

    $('.search-form-wrap .search-close').click(function() {
        $('.search-form-wrap').toggleClass('active-search');
        var focusElement = $( this ).data( 'focus' );
        $( focusElement ).focus();
    });

    /**
     * masthead menu toggle
     */
    $( '#masthead .menu-toggle' ).click(function(){
        $('#masthead .primary-menu-wrap').toggleClass('menu-active'); 
        var element = document.querySelector( '.primary-menu-wrap.menu-active' );
        if( element ) {
            $(document).on('keydown', function(e) {
                var focusable = element.querySelectorAll( 'input, a, button' );
                focusable = Array.prototype.slice.call( focusable );
                focusable = focusable.filter( function( focusableelement ) {
                    return null !== focusableelement.offsetParent;
                } );
                var firstFocusable = focusable[0];
                var lastFocusable = focusable[focusable.length - 1];
                matina_focus_trap( firstFocusable, lastFocusable, e );
            })
        }
    });
    
    $('.main-menu-close').click(function() {
        $('#masthead .primary-menu-wrap').removeClass('menu-active');
        var focusElement = $( this ).data( 'focus' );
        $( focusElement ).focus();
    });

    /**
     * Focus trap in popup.
     */
    var KEYCODE_TAB = 9;
    function matina_focus_trap( firstFocusable, lastFocusable, e ) {
        if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
            if ( e.shiftKey ) /* shift + tab */ {
                if (document.activeElement === firstFocusable) {
                    lastFocusable.focus();
                    e.preventDefault();
                }
            } else /* tab */ {
                if ( document.activeElement === lastFocusable ) {
                    firstFocusable.focus();
                    e.preventDefault();
                }
            }
        }
    }

    /**
     * Close popups on escape key.
     */
    $( document ).on( 'keydown', function( event ) {
        if ( event.keyCode === 27 ) {
            event.preventDefault();
            $( '.primary-menu-wrap' ).removeClass( 'menu-active' );
            $( '.search-form-wrap' ).removeClass( 'active-search' );
        }
    })

    /**
     * Primary menu sub-toggle
     */
    $('<a class="sub-toggle" href="javascript:void(0);"><i class="fa fa-angle-down"></i></a>').insertAfter('#site-navigation .menu-item-has-children>a, #site-navigation .page_item_has_children>a');

    $('body').on( 'click', '#site-navigation .sub-toggle', function() {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle();
        $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle();
        $(this).children('.fa').first().toggleClass('fa-angle-right').toggleClass('fa-angle-down');
    });
    
    /**
     * define banner slider data value
     */
    var autoValue       = $('.bannerSlide').data('auto');
    var modeValue       = $('.bannerSlide').data('mode');
    var pagerValue      = $('.bannerSlide').data('pager');
    var controlValue    = $('.bannerSlide').data('control');
    var pauseValue      = $('.bannerSlide').data('pause');
    var speedValue      = $('.bannerSlide').data('speed');
    var itemValue       = $('.bannerSlide').data('item');

    /**
     * Scripts for homepage banner
     */
    $(".bannerSlide").lightSlider({
        item: itemValue,
        auto: autoValue,
        pager: pagerValue,
        control: controlValue,
        loop: true,
        slideMargin: 0,
        speed: speedValue,
        pause: pauseValue,
        enableTouch: false,
        enableDrag: false,
        rtl: rtlValue,
        mode: modeValue,
        prevHtml: '<i class="fas fa-arrow-left"></i>',
        nextHtml: '<i class="fas fa-arrow-right"></i>',
        onSliderLoad: function() {
            $('.bannerSlide').removeClass('cS-hidden');
        },
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    item: 1,
                    slideMove: 1,
                    slideMargin: 10,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    item: 1,
                    slideMove: 1,
                }
            }
        ]
    });

    /**
     * Scripts for homepage featured carousel
     */
    $('.featuredCarousel').each(function(){
        var Id = $(this).attr('id');
        var NewId = Id;
        var itemCount = $(this).data('item');
        NewId = $('#' + Id + " .featured-items-wrapper").lightSlider({
            item: itemCount,
            auto: true,
            pager: false,
            controls: false,
            loop: true,
            slideMargin: 30,
            speed: 1000,
            pause: 7000,
            enableTouch: false,
            enableDrag: false,
            rtl: rtlValue,
            onSliderLoad: function() {
                $('#featured-section').removeClass('cS-hidden');
            },
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        item: 3,
                        slideMove: 1,
                        slideMargin: 10,
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        item: 2,
                        slideMove: 1,
                        slideMargin: 10,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        item: 1,
                        slideMove: 1,
                    }
                }
            ]
        });
        $('#' + Id + ' .featuredCarousel-controls__prev').click(function() {
            NewId.goToPrevSlide();
        });
        $('#' + Id + ' .featuredCarousel-controls__next').click(function() {
            NewId.goToNextSlide();
        });
    });

    /**
     * Scripts for homepage featured carousel but only for featured category layout 2 and 3
     */
    $('.featuredCarousel2').each(function(){
        var Id = $(this).attr('id');
        var NewId = Id;
        var itemCount = $(this).data('item');
        NewId = $('#' + Id + " .featured-items-wrapper").lightSlider({
            item: itemCount,
            auto: true,
            pager: false,
            loop: true,
            slideMargin: 30,
            speed: 1000,
            pause: 7000,
            enableTouch: false,
            enableDrag: false,
            rtl: rtlValue,
            onSliderLoad: function() {
                $('#featured-section').removeClass('cS-hidden');
            },
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        item: 3,
                        slideMove: 1,
                        slideMargin: 10,
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        item: 2,
                        slideMove: 1,
                        slideMargin: 10,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        item: 1,
                        slideMove: 1,
                    }
                }
            ]
        });
    });

    /**
     * Masonry Layout in archive.
     */
    var grid = document.querySelector('.archive-style--masonry .mt-archive-posts-wrapper'),
    masonry;

    if (
        grid &&
        typeof Masonry !== undefined &&
        typeof imagesLoaded !== undefined
    ) {
        imagesLoaded( grid, function( instance ) {
            masonry = new Masonry( grid, {
                itemSelector: 'article'
            } );
        } );
    }

    /**
     * Scroll To Top
     */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1000){
            $('#matina-scroll-to-top').fadeIn('slow');
        } else {
            $('#matina-scroll-to-top').fadeOut('slow');
        }
    });
    $('#matina-scroll-to-top').click(function(){
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
    
    /**
     * Sidebar sticky
     */
    if('true' === sidebarSticky){
        $('#primary, #secondary').theiaStickySidebar({
            additionalMarginTop: 30
        });
    }

    /**
     * Header sticky
     */
    if ( 'true' === headerSticky ) {
        var windowWidth = $(window).width();
        if( windowWidth > 600 ) {
            var wpAdminBar = $('#wpadminbar');
            if (wpAdminBar.length) {
                $("#masthead.header--layout-default,.header--layout-one #header-sticky").sticky({topSpacing:wpAdminBar.height()});
            } else {
                $("#masthead.header--layout-default,.header--layout-one #header-sticky").sticky({topSpacing:0});
            }
        }
    }

    /**
     * gallery post format 
     */
    $( '.mt-gallery-slider' ).lightSlider({
        item: 1,
        pager: false,
        loop: true,
        enableTouch: false,
        enableDrag: false,
        rtl: rtlValue,
        prevHtml: '<i class="fas fa-arrow-left"></i>',
        nextHtml: '<i class="fas fa-arrow-right"></i>',
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    item: 1,
                    slideMove: 1,
                    slideMargin: 10,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    item: 1,
                    slideMove: 1,
                }
            }
        ]
    });

});