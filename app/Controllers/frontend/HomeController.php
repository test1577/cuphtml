<?php 

namespace App\Controllers\frontend;
use App\Controllers\frontend\Controller;
use JavaScript;

class HomeController extends Controller
{
    public function __construct()
    {
      JavaScript::put([
          'foo' => 'bar',
          'age' => 29
      ]);
      
    }
    protected function test()
    {
       return view('welcome');
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