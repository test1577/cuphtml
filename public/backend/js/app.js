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
          var whereTable = $('[cuphtml-page]').prop('title');
          if (whereTable === 'user') {
            option.event.setDataTableUser();
          } else if (whereTable === 'admin') {
            option.event.setDataTableAdmin();
          }
        },
        setDataTableUser: function () {
          $('#indexTable').DataTable({
              "bRetrieve": true,
              "fnDrawCallback": function() {
                option.event.setInputSwitch();
                option.systemCuphtml.setButtonSelectDelete();
              },
		         "initComplete": function(settings, json) {
//                option.event.setInputSwitch();
//                option.systemCuphtml.setButtonSelectDelete();
		         },
            "order": [[1, "desc"]],
            "ajax": {
              "url": $('#getDataTable').val()
            },
            "columns": [
              {"data": null},
              {"data": "user_id"},
              {"data": "user_fullname"},
              {"data": "user_email"},
              {"data": "user_social"},
              {"data": null},
              {"data": null}
            ],
            "columnDefs": [{
                "targets": 0, //index
                "data": null,
                "render": function (data, type, full, meta) {
                  var $htmlInput = '<div class="checkbox checkbox-info">'
                    + '<input id="table-check-' + data.user_id + '" data-cuphtml-checkbox type="checkbox" value="' + data.user_id + '">'
                    + '<label for="table-check-' + data.user_id + '"></label>'
                    + '<input name="title" type="hidden" value="' + data.user_fullname + '">'
                    + '</div>';
                  return $htmlInput;
                }
              },
              {
                "targets": -2, // Active / Disable
                "data": null,
                "render": function (data, type, full, meta) {
                  var $nameStatus = data.user_status === 1 ? 'active' : 'disable';
                  var $checked = data.user_status === 1 ? 'checked' : '';
                  var $htmlStatus = '<span class="invisibility-text">' + $nameStatus + '</span>'
                    + '<input type="checkbox" name="my-checkbox" switch-cuphtml-param-id="' + data.user_id + '" switch-cuphtml-param-name="user_status" switch-cuphtml-action="user-status" ' + $checked + '>';
                  return $htmlStatus;
                }
              },
              {
                "targets": -1, // Actions
                "data": null,
                "render": function (data, type, full, meta) {
                  var $htmlAction = '<div class="box-tools pull-right">'
                    + '<a href="' + Global['baseurl'] + '@min/user/edit/' + data.user_id + '" class="btn btn-social-icon btn-info"><i class="fa fa-edit"></i></a>'
                    + '<a class="cuphtml-select-delete btn btn-social-icon btn-danger" table-cuphtml-action="user-delete-where" table-cuphtml-id="' + data.user_id + '"><i class="fa fa-trash"></i></a>'
                    + '</div>';
                  return $htmlAction;
                }
              }]
          });
        },
        setDataTableAdmin: function () {
          $('#indexTable').DataTable({
              "bRetrieve": true,
              "fnDrawCallback": function() {
                option.event.setInputSwitch();
                option.systemCuphtml.setButtonSelectDelete();
              },
		         "initComplete": function(settings, json) {
//                option.event.setInputSwitch();
//                option.systemCuphtml.setButtonSelectDelete();
		         },
            "order": [[1, "desc"]],
            "ajax": {
              "url": $('#getDataTable').val()
            },
            "columns": [
              {"data": null},
              {"data": "id"},
              {"data": "name"},
              {"data": "email"},
              {"data": null},
              {"data": null}
            ],
            "columnDefs": [{
                "targets": 0, //index
                "data": null,
                "render": function (data, type, full, meta) {
                  var $htmlInput = '<div class="checkbox checkbox-info">'
                    + '<input id="table-check-' + data.id + '" data-cuphtml-checkbox type="checkbox" value="' + data.id + '">'
                    + '<label for="table-check-' + data.id + '"></label>'
                    + '<input name="title" type="hidden" value="' + data.name + '">'
                    + '</div>';
                  return $htmlInput;
                }
              },
              {
                "targets": -2, // Active / Disable
                "data": null,
                "render": function (data, type, full, meta) {
                  var $nameStatus = data.status === 1 ? 'active' : 'disable';
                  var $checked = data.status === 1 ? 'checked' : '';
                  var $htmlStatus = '<span class="invisibility-text">' + $nameStatus + '</span>'
                    + '<input type="checkbox" name="my-checkbox" switch-cuphtml-param-id="' + data.id + '" switch-cuphtml-param-name="status" switch-cuphtml-action="admin-status" ' + $checked + '>';
                 if (data.email === 'admin') {
                   $htmlStatus = '';
                 }
                  return $htmlStatus;
                }
              },
              {
                "targets": -1, // Actions
                "data": null,
                "render": function (data, type, full, meta) {
                  var $htmlAction = '<div class="box-tools pull-right">'
                    + '<a href="' + Global['baseurl'] + '@min/admin/edit/' + data.id + '" class="btn btn-social-icon btn-info"><i class="fa fa-edit"></i></a>'
                    + '<a class="cuphtml-select-delete btn btn-social-icon btn-danger" table-cuphtml-action="admin-delete-where" table-cuphtml-id="' + data.id + '"><i class="fa fa-trash"></i></a>'
                    + '</div>';
                 if (data.email === 'admin') {
                   $htmlAction = '';
                 }
                  return $htmlAction;
                }
              }]
          });
        },
        deleteTableRow: function (params) {
          for (var key in params) {
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
          // Date range picker with time picker
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
          option.systemCuphtml.setFormValidate();
          option.systemCuphtml.setButtonCuphtml();
          option.systemCuphtml.setButtonSelectDelete();
          option.systemCuphtml.setButtonEdit();
          option.systemCuphtml.setButtonSaveClose();
          option.systemCuphtml.setButtonSave();
        },
        load: function () {
          option.systemCuphtml.setShowCuphtml();
        }
      },
//      formAjax: {
//        dashboard: function () {
//          option.event.setDateRange();
//        }
//      },
      page: {
        masterPage: function () {
          option.event.setDataTable();
        },
        dashboard: function () {
          option.event.setDateRange();
        }
      },
      systemCuphtml: {
        openFormEdit: function (res) {
          console.log(res);
        },
        setFormValidate: function () {
          option.systemCuphtml.setFormEditValidate();
        },
        setFormEditValidate: function () {
          $('#formEdit').validator();
        },
        setFormAddValidate: function () {
          $('#formAdd').validator();
        },
        setButtonSelectDelete: function () {
          option.systemCuphtml.setButtonSingleDelete();
          option.systemCuphtml.setButtonMultipleDelete();
        },
        setButtonSave: function () {
          $('#formAddSave').click(function () {
            $typePost = $('form#formAdd').find('input#type_post');
            $typePost.val('save');
          });
          $('#formEditSave').click(function () {
            $typePost = $('form#formEdit').find('input#type_post');
            $typePost.val('save');
          });
        },
        setButtonSaveClose: function () {
          $('#formAddSaveClose').click(function () {
            $typePost = $('form#formAdd').find('input#type_post');
            $typePost.val('saveclose');
          });
          $('#formEditSaveClose').click(function () {
            $typePost = $('form#formEdit').find('input#type_post');
            $typePost.val('saveclose');
          });
        },
        setButtonSingleDelete: function () {
          $('#selectDelete').off('click');
          $('#selectDelete').on('click', function () {
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
        },
        setButtonMultipleDelete: function () {
          $('.cuphtml-select-delete').off('click');
          $('.cuphtml-select-delete').on('click', function () {
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
          var bodyMsg = '';
          if (params.id.length == 1) {
            var nameItem = $('table').find("[table-cuphtml-id='" + params.id + "']").parents().eq(2).find('input[name="title"]').val();
            bodyMsg = 'Do you want to delete id : ' + params.id + ' name : ' + nameItem + '?';
          } else {
            var items = [];
            for (var key in params.id) {
              var nameItem = $('table').find("[table-cuphtml-id='" + params.id[key] + "']").parents().eq(2).find('input[name="title"]').val();
              items.push('<li> id : ' + params.id[key] + ' name : ' + nameItem + '</li>');
            }
            bodyMsg = '<p>Do you want to delete? (items '+params.id.length+')</p>'
              + '<ul id="listDelete">'
              + items.join('')
              + '</ul>';
          }
          var setOption = {
            title: titleMsg,
            message: bodyMsg,
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
        setButtonEdit: function () {
          $('.cuphtml-select-edit').click(function () {
            var serviceName = $(this).attr('table-cuphtml-action');
            var id = $(this).attr('table-cuphtml-id');
            var params = {
              id : id
            };
            service.api.getWhere(serviceName, params);
          });
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