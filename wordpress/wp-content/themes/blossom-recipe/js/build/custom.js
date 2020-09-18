jQuery(document).ready(function($) {

    var winWidth = $(window).width();
    var rtl;
    
    if( blossom_recipe_data.rtl == '1' ){
        rtl = true;
    }else{
        rtl = false;
    }
    
    //banner slider js
    $(".slider-one .banner-slider").owlCarousel({
        items:3,
        margin: 20,
        loop: true,
        dots: false,
        nav: true,
        autoplay: true,
        smartSpeed: 500,
        rtl:rtl,
        lazyLoad   : true,
        autoplayTimeout : 2000,
        responsive : {
            0 : {
                items: 1,
            },
            768 : {
                items: 2,
            }, 
            1025 : {
                items: 3,
            }
        }
    });
    
    $('.sticky-t-bar').addClass('active');
    $('.sticky-t-bar .sticky-bar-content').show();
    $('.sticky-t-bar .close').click(function(){
        if($('.sticky-t-bar').hasClass('active')){
            $('.sticky-t-bar').removeClass('active');
            $('.sticky-t-bar .sticky-bar-content').stop(true, false, true).slideUp();
        }else{
            $('.sticky-t-bar').addClass('active');
            $('.sticky-t-bar .sticky-bar-content').stop(true, false, true).slideDown();
        }
    });

    $(window).on('resize load', function() {
        var siteWidth = $('.site').width();
        var CbgWidth = parseInt(winWidth) - parseInt(siteWidth);
        var finalCbgWidth = parseInt(CbgWidth) / 2;
        $('.custom-background .sticky-t-bar .close').css('right', finalCbgWidth);
    });

    //search toggle js
    $('.header-search > .search-btn').click(function(){
        $(this).siblings('.header-search-form').fadeIn('slow');
    });
    $('.header-search-form .close' && '.header-search-form').click(function(){
        $('.header-search-form').fadeOut('slow');
    });

    $(window).keyup(function(e){
        if(e.key == "Escape") {
            $('.header-search-form').fadeOut('slow');
        }
    });

    $('.header-search-form .search-form').click(function(e){
        e.stopPropagation();
    });

    //main navigation
    $('.main-navigation ul li.menu-item-has-children').find('> a').after('<button class="submenu-toggle"><i class="fas fa-chevron-down"></i></button>');
    $('.main-navigation ul li button.submenu-toggle').on('click', function () {
        $(this).parent('li.menu-item-has-children').toggleClass('active');
        $(this).siblings('.sub-menu').stop(true, false, true).slideToggle();
    });
    $('.main-navigation .toggle-button').click(function(){
        $('.primary-menu-list').animate({
            width: 'toggle',
        });
    });
    $('.main-navigation .close').click(function(){
        $('.primary-menu-list').animate({
            width: 'toggle',
        });
    });

    //for accessibility
    $('.main-navigation ul li a, .main-navigation ul li button').focus(function() {
        $(this).parents('li').addClass('focused');
    }).blur(function() {
        $(this).parents('li').removeClass('focused');
    });

    //show/hide scroll button
    $(window).scroll(function(){
        if($(window).scrollTop() >300) {
            $('#back-to-top').addClass('show');
        } else {
            $('#back-to-top').removeClass('show');
        }
    });

    //scroll window to top
    $('#back-to-top').on('click', function(){
        $('html, body').animate({
            scrollTop: 0
        }, 600);
    });

    //add span in widget title
    $('#secondary .widget .widget-title, .site-footer .widget .widget-title').wrapInner('<span></span>');

    //post share toggle
    $('figure.post-thumbnail .share-icon').click(function(e){
        $(this).parent('.post-share').toggleClass('active');
        e.stopPropagation();
    });

    $('figure.post-thumbnail .social-icon-list').click(function(){
        e.stopPropagation();
    });

    $(window).click(function(){
        $('.post-share').removeClass('active');
    });

    //tab js
    $('.tab-btn').click(function(){
        var divId = $(this).attr('id');
        $('.tab-btn').removeClass('active');
        $(this).addClass('active');
        $('.tab-content').stop(true, false, true);
        $('.tab-content').removeClass('active');
        $('#'+divId+'-content').stop(true, false, true).addClass('active');

    });


    //Ajax for Add to Cart
    $('.btn-simple').click(function() {     
        $(this).addClass('adding-cart');
        var product_id = $(this).attr('id');
        
        $.ajax ({
            url     : blossom_recipe_data.ajax_url,  
            type    : 'POST',
            data    : 'action=blossom_recipe_add_cart_single&product_id=' + product_id,    
            success : function(results){
                $('#'+product_id).replaceWith(results);
            }
        }).done(function(){
            var cart = $('#cart-'+product_id).val();
            $('.cart .number').html(cart);         
        });
    });
    
});