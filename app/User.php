<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\UserInterface;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    protected $fillable = ['idAccount', 'email','password','idRole'];
    protected $hidden = ['password', 'remember_token'];
    protected $primaryKey = 'idAccount';
    public $timestamps = false;
    public function Clients(){
    	return $this->hasMany('App\Clients');
    }
    public function Role(){
    	return $this->belongsTo('App\Role');
    }
    public function Employee(){
    	return $this->hasMany('App\Employee');
    }
    public function Client_Company(){
        return $this->hasMany('App\Client_Company');
    }
}
