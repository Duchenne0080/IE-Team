jQuery('.dropdown a.dropdown-toggle').on('click', function(e) {
	e.preventDefault();
  if (!jQuery(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
  }
  var $subMenu = jQuery(this).next(".dropdown-menu");
  $subMenu.toggleClass('show');


  jQuery(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
	  e.preventDefault();
    jQuery('.dropdown-submenu .show').removeClass("show");
  });

  return false;
});