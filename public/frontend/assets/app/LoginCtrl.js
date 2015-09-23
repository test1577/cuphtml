/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global app, Global */

app.controller('LoginCtrl', ['$scope',  function ($scope) {
    $scope.LoginCtrl = {
      init: function () {
        
      },
      object: {
        
      },
      model: {
        formLogin: {
          email: '',
          password: '',
          isRemember: false
        }
      },
      event: {
        login : function () {
          console.log($scope.LoginCtrl.model.formLogin);
        },
      },
      service: {
        
      },
      handdleError: {
        
      }
      
    };
    $scope.LoginCtrl.init();
    return $scope.LoginCtrl;
}]);