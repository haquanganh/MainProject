<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client_Company extends Model
{
    protected $table = 'Client_Company';
    protected $fillable = ['idClientCompany','CC_Name','CC_Address','CC_Phone','CC_Skype','CC_Email','CC_Description','idAccount'];
    protected $hidden = [];
    protected $primaryKey = 'idClientCompany';
    public $timestamps = false;
    public function User(){
    	return $this->belongsTo('App\User','idAccount');
    }
    public function Clients(){
    	return $this->hasMany('App\Clients');
    }
}
