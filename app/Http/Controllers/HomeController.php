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
          'title' => 'cuphtml'
      );
       return view('frontend/home',$data);
    }
}