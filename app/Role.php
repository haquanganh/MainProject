<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'Role';
    protected $fillable = ['idRole','Role','Note'];
    protected $hidden = [];
    protected $primaryKey = 'idRole';
    public function User (){
    	return $this->hasMany('App\User','idRole');
    }
}
