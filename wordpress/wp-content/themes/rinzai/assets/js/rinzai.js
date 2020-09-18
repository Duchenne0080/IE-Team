(function($){

    // Sticky navbar.
    var navbar = UIkit.sticky('#app > div > .uk-navbar-container', {
        showOnUp: true,
        animation: 'uk-animation-slide-top',
        clsActive: 'uk-navbar-sticky-active'
    });

    // Focus on input field when search modal is shown.
    UIkit.util.on('#search-modal', 'shown', function () {
        $('#search-modal input[type="search"]').focus();
    });

})(jQuery);
