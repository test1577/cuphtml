<?php

namespace App\Controllers\backend;

use URL,
    Hash,
    Auth,
    Input,
    Session,
    Request,
    Redirect,
    Validator;
use App\Controllers\backend\Controller;
use App\Model\backend\AdminModel;
use App\Component\backend\AdminComponent;

class AdminController extends Controller {

  protected $page;

  public function __construct() {
    parent::__construct();
    $this->page = 'Admin';
  }

  protected function index() {
    $data = $this->setDataPageView('view');
    return view('backend/home', $data);
  }

  protected function add() {
    $data = $this->setDataPageView('add');
    return view('backend/home', $data);
  }

  protected function edit($id = '') {
    $data = $this->setDataPageView('edit', $id);
    return view('backend/home', $data);
  }

  protected function setDataPageView($subPage, $id = '') {
    $result = [
        'global' => $this->global,
        'page' => $this->page,
        'subPage' => $subPage,
        'title' => $this->page . $this->global['title'],
        'admin' => $this->admin,
        'data' => []
    ];
    if ($subPage === 'view') {
      $selectField = [
          'id',
          'email',
          'name',
          'status'
      ];
      $row = AdminModel::select($selectField)
              ->get();
      $result['data']['rows'] = $row;
    } else if ($subPage === 'edit') {
      $query = AdminModel::where('id', $id)
              ->orderBy('id', 'desc')
              ->first();
      $result['data']['row'] = $query;
    } else if ($subPage === 'add') {
      // do 
    }
    return $result;
  }

  protected function setMsgResponseRequest($id, $serviceName, $status = '') {
    $result = [
        'status' => false,
        'serviceName' => $serviceName,
        'result' => [
            'id' => $id
        ]
    ];
    if (!empty($status)) {
      $result['result']['status'] = $status;
    }
    return $result;
  }

  public function get() {
    $result['data'] = AdminModel::all();
    return $result;
  }

  public function getStatus() {
    $id = Request::input('id');
    $status = Request::input('status');
    $result = $this->updateStatus($id, $status);
    return $result;
  }

  protected function updateStatus($id, $status) {
    $serviceName = 'admin-status';
    $result = $this->setMsgResponseRequest($id, $serviceName, $status);
    $set = [
        'status' => $status
    ];
    $query = AdminModel::where('id', $id)
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
    $serviceName = 'delete-where';
    $result = $this->setMsgResponseRequest($ids, $serviceName);
    $query = AdminModel::whereIn('id', $ids)
            ->delete();
    if ($query) {
      $result['status'] = true;
    }
    return $result;
  }

  public function getWhere() {
    $serviceName = 'get-where';
    $id = Request::input('id');
    $result = $this->setMsgResponseRequest($id, $serviceName);
    $query = AdminModel::where('id', $id)
            ->orderBy('id', 'desc')
            ->first();
    if ($query) {
      $result['status'] = true;
      $result['result'] = $query;
    }
    return $result;
  }

  public function getUpdateWhere() {
    $serviceName = 'update-where';
    $id = Request::input('id');
    $result = $this->setMsgResponseRequest($id, $serviceName);
    $set = [
        'name' => Request::input('name')
    ];
    $query = AdminModel::where('id', $id)
            ->update($set);
    $this->setStatusSessionFlashWhenQuery($query);
    if ($query) {
      $result['status'] = true;
    }
    return $result;
  }

  public function getAddFormWhere() {
    $inputs = Request::all();
    unset($inputs['type_post']);
    unset($inputs['_token']);
    $findEmail = AdminModel::where('email', $inputs['email'])->first();
    if (!empty($findEmail)) {
      Session::flash('systemError', $this->global['msgStatus']['error']);
      return Redirect::route('admin/add');
    }
    $query = new AdminModel;
    foreach ($inputs as $key => $value) {
      if ($key === 'password') {
        $query[$key] = Hash::make($value);
      } else {
        $query[$key] = $value;
      }
    }
    $query->save();
    $this->setStatusSessionFlashWhenQuery($query);
    if (Request::input('type_post') === "saveclose") {
      return Redirect::route('admin/index');
    } else {
      return Redirect::route('admin/add');
    }
  }

  public function getUpdateFormWhere() {
    $id = Request::input('id');
    $set = [
        'name' => Request::input('name')
    ];
    $query = AdminModel::where('id', $id)
            ->update($set);
    $this->setStatusSessionFlashWhenQuery($query);
    if (Request::input('type_post') === "saveclose") {
      return Redirect::route('admin/index');
    } else {
      return Redirect::route('admin/edit', $id);
    }
  }

  protected function setStatusSessionFlashWhenQuery($query) {
    if ($query) {
      Session::flash('systemSuccess', $this->global['msgStatus']['success']);
    } else {
      Session::flash('systemError', $this->global['msgStatus']['error']);
    }
  }

}
