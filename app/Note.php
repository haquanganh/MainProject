<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'Note';
    protected $fillable = ['idNote', 'N_Title','N_Content','N_DateCreate','N_DateUpdate'];
    protected $hidden = [];
    public function Clients (){
    	return $this->hasMany('App\Clients','idNote');
    }
    public function Employee(){
    	return $this->hasMany('App\Employee','idNote');
    }
}
