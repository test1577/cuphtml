$(document).ready(function () {
  var cuphtml = (function () {	
    var option = {
      'init': function () {          
        option.liberies.bootstrap.dropdown();
        option.liberies.wow();
        option.liberies.owlCarousel();
      },
      
      'liberies': {
        'bootstrap': {
          'dropdown': function () {
            $('.dropdown-toggle').dropdown();
          }
        },
        
        'wow': function () {
          var wow = new WOW({
            offset: 75, // distance to the element when triggering the animation (default is 0)
            mobile: false, // trigger animations on mobile devices (default is true)
          });
          wow.init();
        },
        
        'owlCarousel': function () {
          $("#slide-cuphtml").owlCarousel({
              navigation : true, // Show next and prev buttons
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem:true
              // "singleItem:true" is a shortcut for:
              // items : 1, 
              // itemsDesktop : false,
              // itemsDesktopSmall : false,
              // itemsTablet: false,
              // itemsMobile : false
          });
        }
        
      }
    };
	option.init();
	return option;
})(jQuery);



});

