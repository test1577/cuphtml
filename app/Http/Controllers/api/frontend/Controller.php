<?php

namespace App\Http\Controllers\api\frontend;

use App\Http\Controllers\URL;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    { 
    }
    
    public function globalData()
    {
     $data = [
         'title' => 'cuphtml online',
         'baseUrl' => asset('/')
     ]; 
     return $data;
    }
}
