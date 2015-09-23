<?php 

namespace App\Controllers\api\frontend;
use App\Controllers\api\frontend\Controller;
use App\Component\frontend\UserComponent;
use App\Model\frontend\UserModel;

class RegisterController extends Controller
{
    public function __construct()
    {
      
    }
    public function index()
    {
      UserComponent::register($_REQUEST);
    }
    
}