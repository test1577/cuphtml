$(function () {

  cuphtml = (function () {
    var option = {
      init: function () {
        option.windowEvent.click();
        option.windowEvent.load();
        option.event.setInputSwitch();
        option.event.setInputSelectAll();
        option.event.setAlertWhenHasSessionFlash();
        option.page.masterPage();
        option.page.dashboard();
      },
      object: {
      },
      model: {
      },
      event: {
        setRemainingDays: function (days) {
          $('#remainingDays').html(days + ' Day');
        },
        setInputSelectAll: function () {
          $('#selectAll').change(function () {
            var checkboxes = $('table').find('[data-cuphtml-checkbox]:checkbox');
            if ($(this).is(':checked')) {
              checkboxes.prop('checked', true);
            } else {
              checkboxes.prop('checked', false);
            }
          });
        },
        setInputSwitch: function () {
          $("[name='my-checkbox']").bootstrapSwitch();
          $("[name='my-checkbox']").on('switchChange.bootstrapSwitch', function (event, state) {
            option.event.inputSwitchAction($(this), event, state);
          });
        },
        inputSwitchAction: function (el, event, state) {
          var serviceName = el.attr('switch-cuphtml-action');
          var paramId = el.attr('switch-cuphtml-param-id');
          var paramName = el.attr('switch-cuphtml-param-name');
          var isStatus = state ? 1 : 0;
          var params = {};
          params["id"] = paramId;
          params[paramName] = isStatus;
          service.api.swicthWhere(serviceName, params);
        },
        inputSwitchFail: function (res) {
          var $el = $("[switch-cuphtml-param-id='" + res.result.id + "'],[switch-cuphtml-param-action='" + res.serviceName + "']");
          var value = $el.parent().find("[name='my-checkbox']").bootstrapSwitch('state');
          $el.parent().find("[name='my-checkbox']").bootstrapSwitch('state', !value, true);
        },
        setDataTable: function () {
          $('#indexTable').DataTable({
              "order": [[ 1, "desc" ]]
          });
        },
        deleteTableRow: function (params) {
          for( var key in params) {
            var tableRow = $('table').find("[table-cuphtml-id='" + params[key] + "']").parents().eq(2);
            tableRow.html('');
          }
        },
        setAlertWhenHasSessionFlash: function () {
          var hasEl = $('[cuphtml-alert]');
          if (hasEl.length > 0) {
            var status = hasEl.attr('cuphtml-alert-status');
            var statusColor = status === 'success' ? "success" : "danger";
            var setOption = {
              type: 'modal-' + statusColor,
              message: messageConfig[status]
            };
            option.event.setAlertApi(setOption);
          }
        },
        setAlertApi: function (setOption) {
          var dialog = new BootstrapDialog.show(setOption);
          dialog.getModalHeader().hide();
//            dialog.realize();
//            dialog.getModalBody().hide();
//            dialog.getModalFooter().hide();
//            dialog.open();
        },
        setAlertConfirm: function (setOption) {
          var dialog = new BootstrapDialog.confirm(setOption);
          dialog.getModalHeader().hide();
//            dialog.realize();
//            dialog.getModalBody().hide();
//            dialog.getModalFooter().hide();
//            dialog.open();
        },
        setDateRange: function () {
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
          option.event.setRemainingDays(validThroughDate);
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
        click: function () {
          option.systemCuphtml.setButtonCuphtml();
          option.systemCuphtml.setButtonSelectDelete();
        },
        load: function () {
          option.systemCuphtml.setShowCuphtml();
        }
      },
      page: {
        masterPage: function () {
          option.event.setDataTable();
        },
        dashboard: function () {
          option.event.setDateRange();
        }
      },
      systemCuphtml: {
        setButtonSelectDelete: function () {
          
          $('#selectDelete').click(function () {
            var indexs = [];
            var serviceName = $(this).attr('data-cuphtml-action');
            var $items = $('[data-cuphtml-checkbox]:checked');
            $items.each(function () {
              indexs.push($(this).val());
            });
            if (indexs.length == 0) {
              return;
            }
            var params = {};
            params["id"] = indexs;
            option.systemCuphtml.setConfirmDelete(serviceName, params);
          });
          
          $('.cuphtml-select-delete').click(function () {
            var indexs = [];
            var serviceName = $(this).attr('table-cuphtml-action');
            var id = $(this).attr('table-cuphtml-id');
            indexs.push(id);
            if (indexs.length == 0) {
              return;
            }
            var params = {};
            params["id"] = indexs;
            option.systemCuphtml.setConfirmDelete(serviceName, params);
          });
          
        },
        setConfirmDelete: function (serviceName, params) {
          var titleMsg = 'Do you want to delete?';
            if ( params.id.length == 1 ) {
              var nameItem = $('table').find("[table-cuphtml-id='"+params.id+"']").parents().eq(2).find('input[name="title"]').val();
              titleMsg = 'Do you want to delete '+nameItem+'?';
            }
            var setOption = {
              title: titleMsg,
              message: titleMsg,
              type: 'modal-warning', // <-- Default value is BootstrapDialog.TYPE_PRIMARY
              closable: true, // <-- Default value is false
              draggable: true, // <-- Default value is false
              btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
              btnOKLabel: 'Delete!', // <-- Default value is 'OK',
              btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
              callback: function (result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if (result) {
                  service.api.deleteWhere(serviceName, params);
                }
              }
            }
            option.event.setAlertConfirm(setOption);
          
        },
        setButtonCuphtml: function () {
          $('[data-cuphtml-action]').click(function () {
            var $bodyEl = $('body');
            var el = $bodyEl.find('[data-cuphtml-toggle]');
            var nameEl = $(this).attr('data-cuphtml-name');
            var nameClass = $(this).attr('data-cuphtml-action');
            var nameShow = nameEl + '-' + nameClass;
            var thisEl = $bodyEl.find("[data-cuphtml-toggle='" + nameShow + "']");
            el.hide();
            thisEl.show();
          });
        },
        setShowCuphtml: function () {
          $(window).load(function () {
            var arrName = [];
            var $bodyEl = $('body');
            var el = $bodyEl.find('[data-cuphtml-toggle]');
            el.hide();
            var nameEl = $bodyEl.find('[data-cuphtml-name]');
            nameEl.each(function () {
              var name = $(this).attr('data-cuphtml-name');
              arrName.push(name);
            });
            arrName = helper.removeDuplicateFromArray(arrName);
            for (var key in arrName) {
              var nameShow = arrName[key] + '-view';
              var thisEl = $bodyEl.find("[data-cuphtml-toggle='" + nameShow + "']");
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