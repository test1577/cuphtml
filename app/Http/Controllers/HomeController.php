<?php 

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

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
}