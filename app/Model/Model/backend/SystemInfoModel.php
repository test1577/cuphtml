<?php

namespace App\Model\backend;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class SystemInfoModel extends Model 
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'system_info';

    
}
