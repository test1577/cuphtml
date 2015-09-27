<?php

namespace App\Controllers\backend;

use Hash;
use Auth;
use Session;
use Redirect;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Model\backend\AdminModel;
use App\Controllers\backend\Controller;
use App\Component\backend\BaseComponent;
use App\Model\backend\SystemInfoModel;

class BackendController extends Controller {

  public function __construct() {
    
  }

  protected function index() {
    $system_model = new SystemInfoModel;
    $system_info = $system_model::findorfail(1);
    $user = Auth::user();
    $user['last_created'] = Controller::timeElapsedString($user['created_at']);
    $user['last_updated'] = Controller::timeElapsedString($user['updated_at']);
    $data = array(
        'global' => Controller::globalData(),
        'page' => 'feed',
        'title' => 'cuphtml',
        'user' => $user,
        'system_info' => $system_info,
    );
    return view('backend/home', $data);
  }

  protected function login($statusLogin = '') {
    if (Auth::check()) {
      // The user is logged in...
      return Redirect::intended('/@min');
    }
    $data = array(
        'global' => Controller::globalData(),
        'page' => 'feed',
        'title' => 'cuphtml',
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
    // Getting all post data
    $data = Input::all();
    // Applying validation rules.
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
      $userdata = [
          'email' => Input::get('email'),
          'password' => Input::get('password')
      ];
//      if ( !empty(Input::get('remember')) &&  Input::get('remember') === 'on') {
//        $userdata['remember'] = true;
//      }
      // doing login.
      if (Auth::validate($userdata)) {
        if (Auth::attempt($userdata)) {
          return Redirect::intended('/@min');
        }
      } else {
        // if any error send back with message.
        Session::flash('error', 'Something went wrong');
        return Redirect::to('auth/login');
      }
    }
  }

  protected function logout() {
    Auth::logout();
    return Redirect::to('auth/login');
  }

  protected function updateSystem() {
    $system_model = SystemInfoModel::where('id', 1)
            ->update([
                'title'=> Input::get('title'),
                'description'=> Input::get('description'),
                'keywords'=> Input::get('keywords'),
                'started_at'=> Input::get('started_at'),
                'end_at'=> Input::get('end_at')
            ]);
    return Redirect::to('/@min');
    
  }

}
