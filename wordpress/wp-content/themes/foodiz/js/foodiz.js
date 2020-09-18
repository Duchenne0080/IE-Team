jQuery(document).ready(function(){

	// Scroll 

	jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 500) {
				jQuery('.scrollup').fadeIn();
			} else {
				jQuery('.scrollup').fadeOut();
				//alert( "Hello" );
			}
	});
	
	jQuery('.scrollup').click(function () {
			jQuery("html, body").animate({
				scrollTop: 0
			}, 1000)
			return false;
	});
	
});


	
/* sticky navbar */

jQuery(function(){
  
	foodiz_createSticky(jQuery("#app1"));

});

function foodiz_createSticky(sticky) {
	
	if (typeof sticky !== "undefined") {

		var	pos = sticky.offset().top,
				win = jQuery(window);
			
		win.on("scroll", function() {
    		win.scrollTop() >= pos ? sticky.addClass("sticky") : sticky.removeClass("sticky");      
		});			
	}
}
/* drop down */
jQuery(function($) {
$('.navbar .dropdown > a').click(function(){
location.href = this.href;
});

});

/* menu */
