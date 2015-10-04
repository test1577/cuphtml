<?php

namespace App\Controllers\backend;

use Hash,
    URL,
    Auth,
    Session,
    Redirect,
    Validator;
//    JavaScript;
use Illuminate\Support\Facades\Input;
use App\Model\backend\AdminModel;
use App\Controllers\backend\Controller;
use App\Model\backend\SystemInfoModel;
use App\Model\backend\UserModel;

class BackendController extends Controller {

  protected $page;
  public function __construct() {
    parent::__construct();
    $this->page = 'Dashboard';
  }

  protected function index() {
    $systemModel = new SystemInfoModel;
    $systemInfo = $systemModel::findorfail(1);
    $data = [
        'global' => $this->global,
        'page' => $this->page,
        'title' => $this->page.$this->global['title'],
        'admin' => $this->admin,
        'systemInfo' => $systemInfo,
        'data' => [
            'items' => [
                'movies' => 9999,
                'others' => 9999,
                'users' => UserModel::count(),
                'reports' => 9999
            ]
        ]
    ];
    return view('backend/home', $data);
  }

  protected function login($statusLogin = '') {
    if (Auth::check()) {
      // The user is logged in...
      return Redirect::intended('/@min');
    }
    $data = array(
        'global' => $this->global,
        'page' => 'Login',
        'title' => SystemInfoModel::findorfail(1)['title'],
        'status' => $statusLogin
    );
    return view('backend/login', $data);
  }

  protected function register() {
    $admin = new AdminModel;
    $admin->email = 'admin';
    $admin->password = Hash::make('admin');
    $admin->name = 'CUPHTML';
    $admin->save();
    return $admin;
  }

  protected function authen() {
    $data = Input::all();
    $rules = array(
        'email' => 'required|min:4',
        'password' => 'required|min:4',
    );
    $validator = Validator::make($data, $rules);
    if ($validator->fails()) {
      // If validation falis redirect back to login.
      Session::flash('error', 'Something went wrong');
      return Redirect::to('auth/login')->withInput(Input::except('password'))->withErrors($validator);
    } else {
      $admindata = [
          'email' => Input::get('email'),
          'password' => Input::get('password')
      ];
//      if ( !empty(Input::get('remember')) &&  Input::get('remember') === 'on') {
//        $userdata['remember'] = true;
//      }
      // doing login.
      if (Auth::validate($admindata)) {
        if (Auth::attempt($admindata)) {
          return Redirect::intended('/@min');
        }
      } else {
        // if any error send back with message.
        Session::flash('systemError', $this->global['msgStatus']['error']);
        return Redirect::to('auth/login');
      }
    }
  }

  protected function logout() {
    unset($this->admin['last_created']);
    unset($this->admin['last_updated']);
    Auth::logout();
    return Redirect::to('auth/login');
  }

  protected function updateSystem() {
    $query = SystemInfoModel::where('id', Input::get('id'))
            ->update([
                'title'=> Input::get('title'),
                'description'=> Input::get('description'),
                'keywords'=> Input::get('keywords'),
                'started_at'=> Input::get('started_at'),
                'end_at'=> Input::get('end_at')
            ]);
    if ($query) {
      Session::flash('systemSuccess', $this->global['msgStatus']['success']);
    }else {
      Session::flash('systemError', $this->global['msgStatus']['error']);
    }
    return Redirect::to('/@min');
    
  }

}
