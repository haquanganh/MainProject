<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table = 'Clients';
    protected $fillable = ['idClient', 'ClientName','C_Phone','C_Address','C_Email','C_Skype','idAccount','idNote','idClientCompany'];
    protected $hidden = [];
    protected $primaryKey = 'idClient';
    public $timestamps = false;
    public function User(){
    	return $this->belongsTo('App\User');
    }
    public function Project(){
    	return $this->hasMany('App\Project');
    }
    public function Feedback(){
    	return $this->hasMany('App\Feedback');
    }
    public function Note(){
    	return $this->belongsTo('App\Note');
    }
    public function Employee(){
    	return $this->belongsToMany('App\Employee','App\RequestC_E');
    }
    public function History(){
        return $this->hasMany('App\History','idHistory');
    }
    public function Client_Company(){
        return $this->belongsTo('App\Client_Company','idClientCompany');
    }
}
