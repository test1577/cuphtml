<?php

namespace App\Component\backend;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Carbon\Carbon;
use App\Component\frontend\BaseComponent;
use App\Model\frontend\UserModel;

class AdminComponent
{
    static function register($params) {
      $result = [
          'status' => false,
          'massage' => 'can\'t register'
      ];
      $isRegister = false;
      $hasEmail = self::checkUserByEmail($params['email']);
      $create = Carbon::now();
      $token = BaseComponent::genToken($create);
      if( $hasEmail && empty($params['social'])) {
        $result['massage'] = 'email has been use already.';
      } else if ( $hasEmail && !empty($params['social']) ){
        $result = self::loginWithSocial($params['email'], $params['access_token'], $params['social']);
      } else {
        $userData = self::packDataUser($params, $token);
        $isRegister = self::addUser($userData);
      }
      if ( $isRegister ) {
        $result = self::login($params['email'], $params['password']);
      }
      echo json_encode( ($result) );
      exit;
    }
    
    static function packDataUser($params, $token) {
        if ( empty($params['social']) ) $params['access_token'] = '';
        $password = BaseComponent::genPassword($params['password'], $params['social']);
        $result = [
            'user_email' => $params['email'],
            'user_password' => $password,
            'user_fullname' => $params['fullname'],
            'user_social' => $params['social'],
            'user_status' => 1,
            'user_level' => 'user',
            'user_token' => $token,
            'user_access_token' => $params['access_token']
        ];
        return $result;
    }
    
    static function addUser($users) {
      $table = new UserModel;
      foreach ($users as $key => $value) {
        $table[$key] = $value;
      }
      $result = $table->save();
      return $result;
    }
    
    static function checkUserByEmail($email) {
      $result = true;
      $query = UserModel::findEmail($email);
      if ( count($query) === 0 ) {
        $result = false;
      }
      return $result;
    }
    static function login($email, $password) {
      $result = [
        'status' => false,
        'massage' => 'can\'t login'
      ];
      $query = UserModel::where('user_email', $email)
              ->where('user_password', $password)
              ->where('user_status', 1)
              ->get();
      if ( count($query) > 0 ) {
        $result = [
            'status' => true,
            'result' => [
              'user_email' => $query[0]['user_email'],
              'user_fullname' => $query[0]['user_fullname'],
              'user_social' => $query[0]['user_social'],
              'user_level' => $query[0]['user_level'],
              'user_token' => $query[0]['user_token']
            ]
        ];
      }
      return $result;
    }
    
    static function loginWithSocial($email, $accessToken, $social) {
      $result = [
        'status' => false,
        'massage' => 'can\'t login with social'
      ];
      $query = UserModel::where('user_email', $email)
              //update $accessToken
//              ->where('user_access_token', $accessToken)
              ->where('user_social', $social)
              ->get();
      if ( count($query) > 0 ) {
        $result = [
            'status' => true,
            'result' => [
              'user_email' => $query[0]['user_email'],
              'user_fullname' => $query[0]['user_fullname'],
              'user_social' => $query[0]['user_social'],
              'user_level' => $query[0]['user_level'],
              'user_token' => $query[0]['user_token']
            ]
        ];
      }
      return $result;
    }
}
