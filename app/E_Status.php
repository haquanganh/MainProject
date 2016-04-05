<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class E_Status extends Model
{
    protected $table = 'E_Status';
    protected $fillable = ['idStatus', 'Status','S_Note'];
    protected $hidden = [];
    public function Employee(){
    	return $this->hasMany('App\Employee');
    }
}
