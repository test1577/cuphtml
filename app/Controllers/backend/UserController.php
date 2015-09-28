<?php

namespace App\Controllers\backend;

use URL,
    Auth,
    Request,
    Redirect,
    Validator;
use App\Controllers\backend\Controller;
use App\Model\backend\UserModel;

class UserController extends Controller {

  protected $global;
  protected $user;
  protected $page;
  protected $subPage;
  public function __construct() {
    $this->global = Controller::GLOBALDATA;
    $this->global['baseUrl'] = URL::to('/').'/';
    $this->user = Auth::user();
    $this->user['last_created'] = Controller::timeElapsedString($this->user['created_at']);
    $this->user['last_updated'] = Controller::timeElapsedString($this->user['updated_at']);
    $this->page = 'User';
  }

  protected function index() {
    $this->subPage = 'index';
    $row = UserModel::all();
    $data = [
        'global' => $this->global,
        'page' => $this->page,
        'subPage' => $this->subPage,
        'title' => $this->page.$this->global['title'],
        'user' => $this->user,
        'data' => [
            'rows' => $row
        ]
    ];
    return view('backend/home', $data);
  }
  
  protected function add() {
    $this->subPage = 'index';
    $row = UserModel::all();
    $data = [
        'global' => $this->global,
        'page' => $this->page,
        'subPage' => $this->subPage,
        'title' => $this->page.$this->global['title'],
        'user' => $this->user,
        'data' => [
            'rows' => $row
        ]
    ];
    return view('backend/home', $data);
  }
  
  protected function edit() {
    $this->subPage = 'index';
    $row = UserModel::all();
    $data = [
        'global' => $this->global,
        'page' => $this->page,
        'subPage' => $this->subPage,
        'title' => $this->page.$this->global['title'],
        'user' => $this->user,
        'data' => [
            'rows' => $row
        ]
    ];
    return view('backend/home', $data);
  }
  
  public function getStatus() {
    $id = Request::input('id');
    $status = Request::input('user_status');
    $result = $this->updateStatus($id, $status);
    return $result;
  }
  
  protected function updateStatus($id, $status) {
    $result = [
        'status' => false,
        'serviceName' => 'user-status',
          'result' => [
              'id' => $id,
              'status' => $status
          ]
    ];
    $set = [
        'user_status' => $status
    ];
    $query = UserModel::where('user_id', $id)
            ->update($set);
    if ($query) {
      $result['status'] = true;
    }
    return $result;
  }
  
  public function getDeleteWhere() {
    $ids = Request::input('id');
    $result = $this->deleteWhere($ids);
    return $result;
  }
  
  protected function deleteWhere($ids) {
    $result = [
        'status' => false,
        'serviceName' => 'user-delete-where',
          'result' => [
              'id' => $ids
          ]
    ];
    foreach ($ids as $id) {
      $query = UserModel::where('user_id', $id)
              ->delete();
    }
    if ($query) {
      $result['status'] = true;
    }
    return $result;
  }


}
