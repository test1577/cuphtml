<?php

namespace App\Component\frontend;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Carbon\Carbon;
use App\Component\frontend\BaseComponent;
use App\Model\frontend\UserModel;

class UserComponent extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    static function register($params) {
      $result = [
          'status' => false,
          'massage' => 'can\'t register'
      ];
      $isRegister = false;
      $hasEmail = self::checkUserByEmail($params['email']);
      if( $hasEmail && empty($params['social'])) {
        $result['massage'] = 'email has been use already.';
      } else if ( $hasEmail && !empty($params['social']) ){
        $result = self::loginWithSocial($params['email'], $params['access_token'], $params['social']);
      } else {
        $create = Carbon::now();
        $token = BaseComponent::genToken($create);
        $password = BaseComponent::genPassword($params['password'], $params['social']);
        $userData = [
            'user_email' => $params['email'],
            'user_password' => $password,
            'user_fullname' => $params['fullname'],
            'user_social' => $params['social'],
            'user_status' => 1,
            'user_level' => 'user',
            'user_token' => $token,
            'user_access_token' => $params['access_token']
        ];
        $isRegister = self::addUser($userData);
      }
      if ( $isRegister ) {
        $result = [
            'status' => true,
            'result' => [
              'user_email' => $params['email'],
              'user_fullname' => $params['fullname'],
              'user_social' => $params['social'],
              'user_level' => 'user',
              'user_token' => $token
            ]
        ];
      }
      echo json_encode( ($result) );
      exit;
    }
    
    static function addUser($userData) {
      $user = new UserModel;
      $user->user_email = $userData['user_email'];
      $user->user_password = $userData['user_password'];
      $user->user_fullname = $userData['user_fullname'];
      $user->user_social = $userData['user_social'];
      $user->user_status = $userData['user_status'];
      $user->user_level = $userData['user_level'];
      $user->user_token = $userData['user_token'];
      $result = $user->save();
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
    static function loginWithSocial($email, $accessToken, $social) {
      $result = [
        'status' => false,
        'massage' => 'can\'t login with social'
      ];
      $query = [];
      $query = UserModel::where('user_email', $email);
//              ->where('user_access_token', $accessToken)
//              ->where('user_social', $social);
      if ( count($query) > 0 ) {
        $result = [
            'status' => true,
            'result' => [
              'user_email' => $query['user_email'],
              'user_fullname' => $query['user_fullname'],
              'user_social' => $query['user_social'],
              'user_level' => 'user',
              'user_token' => $query['user_token']
            ]
        ];
      }
      return $result;
    }
}
