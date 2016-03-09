<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'User';
    protected $fillable = ['idAccount', 'Username','Password','idRole'];
    protected $hidden = [];
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
}
