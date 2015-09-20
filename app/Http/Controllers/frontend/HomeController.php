<?php 

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\frontend\Controller;

class HomeController extends Controller
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
       return view('frontend/home',$data);
    }
    
    protected function authen()
    {
      $data = array(
          'global' => Controller::globalData(),
          'page' => 'login',
          'title' => 'cuphtml'
      );
       return view('frontend/home',$data);
    }
    
    protected function register()
    {
      $data = array(
          'global' => Controller::globalData(),
          'page' => 'register',
          'title' => 'cuphtml'
      );
       return view('frontend/home',$data);
    }
    
    protected function profile()
    {
      $data = array(
          'global' => Controller::globalData(),
          'page' => 'profile',
          'title' => 'cuphtml'
      );
       return view('frontend/home',$data);
    }
}