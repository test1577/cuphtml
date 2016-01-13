<?php

namespace App\Controllers\backend;

use Hash,
    URL,
    Auth,
    Session,
    Redirect,
    DateTime,
    Validator,
    JavaScript;
use App\Model\backend\SystemInfoModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

  use DispatchesJobs,
      ValidatesRequests;
  
  protected $global;
  protected $user;
  
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
    $this->global = Controller::GLOBALDATA;
    $this->global['baseUrl'] = URL::to('/') . '/';
    if (Auth::check()) {
      $this->user = Auth::user();
      $this->user['last_created'] = Controller::timeElapsedString($this->user['created_at']);
      $this->user['last_updated'] = Controller::timeElapsedString($this->user['updated_at']);
//    print_r(json_encode($this->user));exit;
    }
    $this->initJS();
  }
  
  public function initJS() {
    JavaScript::put([
        'foo' => 'bar',
        'age' => 29
    ]);
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
