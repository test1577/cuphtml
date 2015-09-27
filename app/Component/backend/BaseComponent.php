<?php

namespace App\Component\backend;

class BaseComponent {

//  public $prefix = 'cuphtml_';

  static function genToken($date) {
    $prefix = 'cuphtml_';
    $result = SHA1(MD5($prefix . $date));
    return $result;
  }

  static function genPassword($password, $social='') {
    $result = '';
    if ( empty($social) ) {
      $result = SHA1(MD5($password));
    }
    return $result;
  }

}
