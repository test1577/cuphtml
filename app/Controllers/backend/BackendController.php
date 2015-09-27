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

class BackendController extends Controller {

  public function __construct() {
    
  }

  protected function index() {
    $user = Auth::user();
    $user['last_created'] = Controller::timeElapsedString($user['created_at']);
    $user['last_updated'] = Controller::timeElapsedString($user['updated_at']);
    $data = array(
        'global'=> Controller::globalData(),
        'page'=> 'feed',
        'title'=> 'cuphtml',
        'user'=> $user
    );
    return view('backend/home', $data);
  }

  protected function login($statusLogin = '') {
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
  
  protected function logout($statusLogin = '') {
        return Redirect::to('auth/login');
  }

}
