<?php

namespace App\Controllers\backend;

use URL,
    Auth,
    Input,
    Session,
    Request,
    Redirect,
    Validator;
use App\Controllers\backend\Controller;
use App\Model\backend\UserModel;
use App\Component\backend\UserComponent;

class UserController extends Controller {

  protected $page;

  public function __construct() {
    parent::__construct();
    $this->page = 'User';
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
        'user' => $this->user,
        'data' => []
    ];
    if ($subPage === 'view') {
      $selectField = [
          'user_id', 
          'user_email', 
          'user_fullname', 
          'user_social',
          'user_status'
      ];
      $row = UserModel::select($selectField)
              ->get();
//      $row = UserModel::all();
//      print_r(json_encode($row));exit;
      $result['data']['rows'] = $row;
    } else if ($subPage === 'edit') {
      $query = UserModel::where('user_id', $id)
              ->orderBy('user_id', 'desc')
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

  public function addDataMock() {
    for( $i = 0; $i <= 11000; $i++) {
      $query = new UserModel;
      $query['user_email'] = 'email mock';
      $query->save();
    }
  }
  public function get() {
//    $this->addDataMock();return;
      $result['data'] = UserModel::all();
      $result['data'] = $this->setHtmlView($result['data']);
    return $result;
  }
  
  public function setHtmlView($datas = '') {
      foreach ( $datas as $key => $value ) {
        $htmlInput = '<div class="checkbox checkbox-info">'
                        .'<input id="table-check-'.$datas[$key]['user_id'].'" data-cuphtml-checkbox type="checkbox" value="'.$datas[$key]['user_id'].'">'
                        .'<label for="table-check-'.$datas[$key]['user_id'].'"></label>'
                        .'<input name="title" type="hidden" value="'.$datas[$key]['user_fullname'].'">'
                     .'</div>';
        $nameStatus = $datas[$key]['user_status']=='1'? 'active' : 'disable' ;
        $checked = $datas[$key]['user_status']=='1'? 'checked' : '';
        $htmlStatus = '<span class="invisibility-text">'.$nameStatus.'</span>'
                     .'<input type="checkbox" name="my-checkbox" switch-cuphtml-param-id="'.$datas[$key]['user_id'].'" switch-cuphtml-param-name="user_status" switch-cuphtml-action="user-status" '.$checked.'>';
        $htmlAction = '<div class="box-tools pull-right">'
                        .'<a href="'. URL::route('user/edit', $datas[$key]['user_id']) .'" class="btn btn-social-icon btn-info"><i class="fa fa-edit"></i></a>'
                        .'<a class="cuphtml-select-delete btn btn-social-icon btn-danger" table-cuphtml-action="user-delete-where" table-cuphtml-id="'.$datas[$key]['user_id'].'"><i class="fa fa-trash"></i></a>'
                      .'</div>';
//        print_r(json_encode($htmlAction));exit;
        $datas[$key]['html_input'] = $htmlInput;
        $datas[$key]['html_status'] = $htmlStatus;
        $datas[$key]['html_action'] = $htmlAction;
      }
    return $datas;
  }

  public function getStatus() {
    $id = Request::input('id');
    $status = Request::input('user_status');
    $result = $this->updateStatus($id, $status);
    return $result;
  }

  protected function updateStatus($id, $status) {
    $serviceName = 'user-status';
    $result = $this->setMsgResponseRequest($id, $serviceName, $status);
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
    $serviceName = 'delete-where';
    $result = $this->setMsgResponseRequest($ids, $serviceName);
    $query = UserModel::whereIn('user_id', $ids)
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
    $query = UserModel::where('user_id', $id)
            ->orderBy('user_id', 'desc')
            ->first();
    if ($query) {
      $result['status'] = true;
      $result['result'] = $query;
    }
    return $result;
  }

  public function getUpdateWhere() {
    $serviceName = 'update-where';
    $id = Request::input('user_id');
    $result = $this->setMsgResponseRequest($id, $serviceName);
    $set = [
        'user_tel' => Request::input('user_tel'),
        'user_address' => Request::input('user_address'),
        'user_fullname' => Request::input('user_fullname')
    ];
    $query = UserModel::where('user_id', $id)
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
    $findEmail = UserModel::where('user_email', $inputs['user_email'])->first();
    if ( !empty($findEmail) ) {
      Session::flash('systemError', $this->global['msgStatus']['error']);
      return Redirect::route('user/add');
    }
    $query = new UserModel;
    foreach ($inputs as $key => $value) {
      $query[$key] = $value;
    }
    $query->save();
    $this->setStatusSessionFlashWhenQuery($query);
    if (Request::input('type_post') === "saveclose") {
      return Redirect::route('user/index');
    } else {
      return Redirect::route('user/add');
    }
  }

  public function getUpdateFormWhere() {
    $id = Request::input('user_id');
    $set = [
        'user_tel' => Request::input('user_tel'),
        'user_address' => Request::input('user_address'),
        'user_fullname' => Request::input('user_fullname')
    ];
    $query = UserModel::where('user_id', $id)
            ->update($set);
    $this->setStatusSessionFlashWhenQuery($query);
    if (Request::input('type_post') === "saveclose") {
      return Redirect::route('user/index');
    } else {
      return Redirect::route('user/edit', $id);
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
