/* global Global */
  var messageConfig = {};
  messageConfig['success'] = 'Saved Success.';
  messageConfig['error'] = 'Something went wrong.';
  messageConfig['loseInternet'] = 'No internet access.';
  messageConfig['apiError'] = 'API STATUS ERROR';
  var baseurl = $('meta[name="baseUrl"]').attr('content');
  var _token = $('meta[name="csrf-token"]').attr('content');
  var Global = {};
  Global['handle'] = {};
  Global['baseurl'] = baseurl;
  Global['uploads'] = baseurl+"uploads/";
  Global['assets'] = baseurl+"assets/";
  Global['_token'] = _token;

$(document).ready(function () {
  service = (function () {
    var option = {
      init: function () {
        option.setup.ajax();
      },
      object: {
        accessToken: ''
      },
      status: {
        success: function (res) {
          if (res.serviceName === 'delete-where') {
            cuphtml.event.deleteTableRow(res.result.id);
          }
          var setOption = {
            type: 'modal-success',
            message: messageConfig['success']
          };
          cuphtml.event.setAlertApi(setOption);
        },
        fail: function (res) {
          if (res.serviceName === 'status') {
            cuphtml.event.inputSwitchFail(res);
          }
          var setOption = {
            type: 'modal-danger',
            message: messageConfig['error']
          };
          cuphtml.event.setAlertApi(setOption);
        },
      },
      setup: {
        ajax: function () {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': Global._token
            }
          });
        }
      },
      api: {
        swicthWhere: function (nameService, params) {
          $.ajax({
            method: "POST",
            url: Global.baseurl + '@min/api-' + nameService,
            data: params
          }).done(function (res) {
            if(res.status){
              option.status.success(res);
            }else{
              option.status.fail(res);
            }
          });
        },
        deleteWhere: function (nameService, params) {
          $.ajax({
            method: "POST",
            url: Global.baseurl + '@min/api-' + nameService,
            data: params
          }).done(function (res) {
            if(res.status){
              option.status.success(res);
            }else{
              option.status.fail(res);
            }
          });
        },
        getWhere: function (nameService, params) {
          $.ajax({
            method: "POST",
            url: Global.baseurl + '@min/api-' + nameService,
            data: params
          }).done(function (res) {
            if(res.status){
              cuphtml.systemCuphtml.openFormEdit(res);
            }else{
              option.status.fail(res);
            }
          });
        }
      },
      register: function ($params) {
        $.ajax({
          method: "POST",
          url: Global.baseurl + 'api-register',
          data: $params
        }).done(function (data) {
//          console.log( data );
        });
      }

    };

    option.init();
    return option;
  })(jQuery);

});

