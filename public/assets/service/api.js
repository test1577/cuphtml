$(document).ready(function () {
  service = (function () {
    var option = {
      'init': function () {
      },
      'object': {
        'accessToken': ''
      },
      'register': function ($params) {
        console.log($params);
        $.ajax({
          url: Global.baseurl+'api-register',
          data: $params,
          method: 'GET'
        }).done(function( data ) {
          console.log( data );
        });
      }
      
    };
    
    option.init();
    return option;
  })(jQuery);

});

