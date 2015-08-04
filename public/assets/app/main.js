$(document).ready(function () {
  var cuphtml = (function () {
    var option = {
      'init': function () {
        option.liberies.bootstrap.dropdown();
        option.liberies.wow();
        option.liberies.owlCarousel();
        option.button.btnScrollTop();
        option.button.btnLottery();
        option.windowEvent.scroll.on();
      },
      
      'object': {
        'scrollPositionCurrent': 0
      },
      
      'button': {
        btnScrollTop: function () {
          $btnScrollTop = '<span class="fix-btn-scroll' +
            ' glyphicon glyphicon-eject"' +
            ' aria-hidden="true"></span>';
          $body = $('body');
          $body.append($btnScrollTop);
          var $elBtn = $body.find('.fix-btn-scroll');
          $elBtn.on("click", function () {
            $('html,body').animate({scrollTop: (0)}, 1000);
          });
        },
        
        'showBtnToTop': function (scroll) {
          $body = $('body');
          var $btn = $body.find('.fix-btn-scroll');
          if (scroll > 300) {
            $btn.fadeIn();
          } else {
            $btn.fadeOut();
          }
        },
        
        'btnLottery': function () {
          $('.btn-show-lottery').on('click', function () {
            option.button.btnShowLottery();
          });
        },
        
        'btnShowLottery': function () {
          var setOption = {
            'title': 'ลอตเตอรี่ประจำวัน',
            'message': 'ลุ้นเสี่ยงดวงวันละครั้ง',
            'buttons': [{
                label: 'เสี่ยงดวง',
                action: function(dialog) {
                    dialog.setMessage('คุณได้รับรางวัลแล้ว โปรดตรวจสอบรางวัลจากกล่องของขวัญ');
                }
            }]
          };
          option.liberies.bootstrap.alert(setOption);
        }
        
      },
      
      'windowEvent': {
        'scroll': {
          'on': function () {
            $(window).on("scroll", function (e) {
              $scroll = $(window).scrollTop();
              option.button.showBtnToTop($scroll);
              option.windowEvent.scroll.checkValueScroll($scroll);
            });
          },
          
          'setValueScroll': function (scroll) {
            option.object.scrollPositionCurrent = scroll;
          },
          
          'checkValueScroll': function (scroll) {
            var scrollValueOld = option.object.scrollPositionCurrent;
            if (scroll > 300 && scroll > scrollValueOld) {
              option.windowEvent.click.on();
              option.windowEvent.scroll.stopScroll();
              option.windowEvent.scroll.setValueScroll($scroll);
            } else {
              option.windowEvent.scroll.setValueScroll($scroll);
            }
          },
          
          'stopScroll': function () {
            $('html,body').stop();
          }
          
        },
        
        'click' : {
          'on': function () {
            $(window).on("click", function (e) {
            });
          }
          
        }
      },
      
      'liberies': {
        'bootstrap': {
          'dropdown': function () {
            $('.dropdown-toggle').dropdown();
          },
          'alert': function (setOption) {
            var dialog = new BootstrapDialog.show(setOption);
//            dialog.realize();
//            dialog.getModalHeader().hide();
//            dialog.getModalBody().hide();
//            dialog.getModalFooter().hide();
//            dialog.open();
          }
        },
        
        'wow': function () {
          var wow = new WOW({
            offset: 75, // distance to the element when triggering the animation (default is 0)
            mobile: false // trigger animations on mobile devices (default is true)
          });
          wow.init();
        },
        
        'owlCarousel': function () {
          $("#slide-cuphtml, #slide-cuphtml-banner").owlCarousel({
            navigation: false, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true
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

