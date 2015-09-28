$(function () {
  
  cuphtml = (function () {
    var option = {
      init: function () {
        option.windowEvent.click();
        option.windowEvent.load();
        option.event.setInputSwitch();
        option.event.setAlertWhenHasSessionFlash();
        option.page.dashboard();
        option.page.user();
      },
      object: {
        
      },
      model: {
        
      },
      event: {
        setRemainingDays: function(days) {
          $('#remainingDays').html(days+' Day');
        },
        setInputSwitch: function() {
          $("[name='my-checkbox']").bootstrapSwitch();
          $("[name='my-checkbox']").on('switchChange.bootstrapSwitch', function(event, state) {
            option.event.inputSwitchAction($(this), event, state);
          });
        },
        inputSwitchAction: function(el, event, state) {
          var serviceName = el.attr('switch-cuphtml-action');
          var paramId = el.attr('switch-cuphtml-param-id');
          var paramName = el.attr('switch-cuphtml-param-name');
          var isStatus = state? 1:0;
          var params = {};
          params["id"] = paramId;
          params[paramName] = isStatus;
          service.api.whereSwicth(serviceName, params);
        },
        inputSwitchFail: function(res) {
            var $el = $("[switch-cuphtml-param-id='"+res.result.id+"'],[switch-cuphtml-param-action='"+res.serviceName+"']");
            var value = $el.parent().find("[name='my-checkbox']").bootstrapSwitch('state');
              $el.parent().find("[name='my-checkbox']").bootstrapSwitch('state', !value, true);
        },
        setDataTable: function() {
          $('#indexTable').DataTable();
        },
        setAlertWhenHasSessionFlash: function() {
            var hasEl = $('[cuphtml-alert]');
            if ( hasEl.length > 0 ) {
              var status = hasEl.attr('cuphtml-alert-status');
              var statusColor = status==='success'? "success": "danger";
              var setOption = {
                type: 'modal-'+statusColor,
                message: messageConfig[status]
              };
              option.event.setAlertApi(setOption);
            }
        },
        setAlertApi: function(setOption) {
            var dialog = new BootstrapDialog.show(setOption);
            dialog.getModalHeader().hide();
//            dialog.realize();
//            dialog.getModalBody().hide();
//            dialog.getModalFooter().hide();
//            dialog.open();
        },
        setDateRange: function() {
          // Dashboard Page
          //Date range picker with time picker
          var valStartDate = $('input[name="started_at"]').val();
          var valEndDate = $('input[name="end_at"]').val();
          var nowYear = moment().format("YYYY");
          var nowMonth = moment().format("MM");
          var nowDay = moment().format("DD");
          var nowDate = moment([nowYear, nowMonth, nowDay]);
          var validYear = moment(valEndDate).format("YYYY");
          var validMonth = moment(valEndDate).format("MM");
          var validDay = moment(valEndDate).format("DD");
          var validDate = moment([validYear, validMonth, validDay]);
          var validThroughDate = validDate.diff(nowDate, 'days'); // 1
          option.event.setRemainingDays( validThroughDate );
          var $daterange = $('input[name="daterange"]').daterangepicker({ 
          locale: {
              format: 'YYYY-MM-DD'
            },
            startDate: valStartDate,
            endDate: valEndDate
          });
          $daterange.on('apply.daterangepicker', function (ev, picker) {
            $('input[name="started_at"]').val(picker.startDate.format('YYYY-MM-DD'));
            $('input[name="end_at"]').val(picker.endDate.format('YYYY-MM-DD'));
          });
        }
      },
      windowEvent: {
        click: function() {
          option.systemCuphtml.setButtonCuphtml();
        },
        load: function() {
          option.systemCuphtml.setShowCuphtml();
        }
      },
      page: {
        dashboard: function() {
          option.event.setDateRange();
        },
        user: function() {
          option.event.setDataTable();
        }
      },
      systemCuphtml: {
        setButtonCuphtml: function() {
          $('[data-cuphtml-action]').click(function() {
            var $bodyEl = $('body');
            var el = $bodyEl.find('[data-cuphtml-toggle]');
            var nameEl = $(this).attr('data-cuphtml-name');
            var nameClass = $(this).attr('data-cuphtml-action');
            var nameShow = nameEl+'-'+nameClass;
            var thisEl = $bodyEl.find("[data-cuphtml-toggle='"+nameShow+"']");
            el.hide();
            thisEl.show();
          });
        },
        setShowCuphtml: function() {
          $(window).load(function() {
            var arrName = [];
            var $bodyEl = $('body');
            var el = $bodyEl.find('[data-cuphtml-toggle]');
            el.hide();
            var nameEl = $bodyEl.find('[data-cuphtml-name]');
            nameEl.each(function(){
              var name = $(this).attr('data-cuphtml-name');
              arrName.push(name);
            });            
            arrName = helper.removeDuplicateFromArray(arrName);
            for( var key in arrName) {
              var nameShow = arrName[key]+'-view';
              var thisEl = $bodyEl.find("[data-cuphtml-toggle='"+nameShow+"']");
              thisEl.show();
            }
          });
        }
      }
      
    };
  option.init();
  return option;
    
  })(jQuery);
  
});