<?php 

namespace App\Controllers\backend;
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
    
}