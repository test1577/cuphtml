<?php

namespace App\Component\backend;

use URL,
    Auth,
    Session,
    Request,
    Redirect,
    Validator;
use App\Controllers\backend\Controller;
use App\Model\backend\UserModel;

class UserComponent extends Controller {

//  protected $global;
//  protected $user;
//  protected $page;
  
  public function __construct() {
//    $this->global = Controller::GLOBALDATA;
//    $this->global['baseUrl'] = URL::to('/') . '/';
//    $this->user = Auth::user();
//    $this->user['last_created'] = Controller::timeElapsedString($this->user['created_at']);
//    $this->user['last_updated'] = Controller::timeElapsedString($this->user['updated_at']);
//    $this->page = 'User';
  }
  
  static function index($params = "") {}

}
