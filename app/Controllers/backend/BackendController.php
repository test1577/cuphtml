<?php 

namespace App\Controllers\backend;

use Validator;
use Auth;
use Illuminate\Support\Facades\Input;
use App\Controllers\backend\Controller;

class BackendController extends Controller
{
    public function __construct()
    {
      
    }
    protected function index()
    {
      $data = array(
          'global' => Controller::globalData(),
          'page' => 'feed',
          'title' => 'cuphtml'
      );
       return view('backend/home',$data);
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

    protected function authen() {
      
  // validate the info, create rules for the inputs
      $rules = array(
          'email' => 'required', // make sure the email is an actual email
          'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
      );

  // run the validation rules on the inputs from the form
      $validator = Validator::make(Input::all(), $rules);

  // if the validator fails, redirect back to the form
      if ($validator->fails()) {
          echo 'fail!';
  //      return Redirect::to('login')
  //                      ->withErrors($validator) // send back all errors to the login form
  //                      ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
      } else {

        // create our user data for the authentication
        $userdata = array(
            'admin_email' => Input::get('email'),
            'admin_password' => Input::get('password')
        );

        // attempt to do the login
        if (Auth::attempt($userdata)) {

          // validation successful!
          // redirect them to the secure section or whatever
          // return Redirect::to('secure');
          // for now we'll just echo success (even though echoing in a controller is bad)
          echo 'SUCCESS!';
        } else {
          echo 'fail!';

          // validation not successful, send back to form 
  //        return redirect()->route('login');
        }
      }
    }
    
}