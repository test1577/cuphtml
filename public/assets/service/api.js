$(document).ready(function () {
  service = (function () {
    var option = {
      'init': function () {
        option.setup.ajax();
      },
      'object': {
        'accessToken': ''
      },
      'setup': {
        'ajax': function () {
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': Global._token
            }
          });
        }
      },
      'register': function ($params) {
        $.ajax({
          method:"POST",
          url: Global.baseurl+'api-register',
          data: $params
        }).done(function( data ) {
//          console.log( data );
        });
      }
      
    };
    
    option.init();
    return option;
  })(jQuery);

});

