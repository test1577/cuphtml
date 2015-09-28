<?php

namespace App\Controllers\backend;

use DateTime;
use App\Controllers\URL;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

  use DispatchesJobs,
      ValidatesRequests;
  
  const GLOBALDATA = [
        'title' => ' - AdminSystem Control',
        'systemVersion' => 'Version 1.1.0',
        'systemCopyright' => 'Copyright &copy; 2015',
        'systemReserved' => 'All rights reserved.',
        'systemTitle' => 'cuphtml it solution',
        'systemUrl' => 'http://cuphtml.com/',
        'msgStatus' => [
            'success' => 'Saved Success.',
            'error' => 'Something went wrong.'
        ]
    ];
  
  public function __construct() {
  }
  
  public function timeElapsedString($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
      if ($diff->$k) {
        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
        unset($string[$k]);
      }
    }

    if (!$full)
      $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }

}
