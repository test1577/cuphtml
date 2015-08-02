/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global app, Global */

app.controller('BaseCtrl', ['$scope',  function ($scope) {
//  $('[ng-app="application"]').scope().assets
  $scope.assets = Global.assets;
  $scope.uploads = Global.uploads;
  $scope.baseUrl = Global.baseurl;
  $scope.scrollTo = function(div) {
    // searchForm
    var hasElementDiv = $("#"+div).html();
    if (!hasElementDiv) return;
    var divTop = $("#"+div).offset().top;
    $('html,body').animate({scrollTop: (divTop/*-100*/)}, 1000);
  };
}]);