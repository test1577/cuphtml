$(document).ready(function () {
  helper = (function () {
    var option = {
      'init': function () {
      },
      'object': {
      },
      'setup': {
      },
      removeDuplicateFromArray: function(arrDuplicate) {
        var uniqueNames = [];
        $.each(arrDuplicate, function (i, el) {
          if ($.inArray(el, uniqueNames) === -1)
            uniqueNames.push(el);
        });
       return uniqueNames;
      }
      
    };
    
    option.init();
    return option;
  })(jQuery);

});

