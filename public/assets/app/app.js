/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global Global, angular */

var app  = angular.module('application', ['ngRoute']);
var messageConfig = {};
messageConfig['loseInternet'] = 'No internet access.';
messageConfig['apiError'] = 'API STATUS ERROR';
var baseurl = angular.element('meta[name="baseUrl"]').attr('content');
var Global = {};
Global['handle'] = {};
Global['baseurl'] = baseurl;
Global['uploads'] = baseurl+"uploads/";
Global['assets'] = baseurl+"assets/";
//Global['baseurl'] = window.location.origin;
//Global['uploads'] = window.location.origin+'/uploads/';
//Global['assets'] = window.location.origin+'/assets/';
Global.handle = {
  loseInternet : function(){
    console.log(messageConfig.loseInternet);
  },
  apiError : function(){
    console.log(messageConfig.apiError);
  }
};

