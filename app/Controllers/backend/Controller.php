<?php

namespace App\Controllers\backend;

use App\Controllers\URL;
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
         'title' => 'AdminSystem Control',
         'baseUrl' => asset('/'),
         'systemVersion' => 'Version 1.1.0',
         'systemCopyright' => 'Copyright &copy; 2015',
         'systemReserved' => 'All rights reserved.',
         'systemTitle' => 'cuphtml it solution',
         'systemUrl' => 'http://cuphtml.com/'
     ]; 
     return $data;
    }
}
