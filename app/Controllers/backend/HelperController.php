<?php

namespace App\Controllers\backend;

use URL,
    Session,
    Request,
    Redirect,
    Response,
    Validator;
use App\Controllers\backend\Controller;
use App\Model\backend\UserModel;

class HelperController extends Controller {

  
  public function __construct() {
  }

  public function index() {
  }
  
  public function validateEmail($id='') {
    $email = !empty(Request::input('user_email'))? Request::input('user_email') : Request::input('email') ;
    if ( empty($email) ) {
      $email = $id ;
    }
    $query = UserModel::where('user_email', $email)->first();
    if ( empty($query) ) {
      $contents = 'Email can use.';
      $statusCode = 200;
    } else {
      $contents = 'Email has already!';
      $statusCode = 400;
    }
  $response = Response::make($contents, $statusCode);
  return $response;

  }
  


}
