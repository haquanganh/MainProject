<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'Employee';
    protected $fillable = ['idEmployee', 'E_Name', 'E_Phone','E_Address','E_Skype','E_Level','idAccount','idStatus','idEchart','idNote','E_avatar','E_Cost_Hour','E_DateofBirth','E_Sex'];
    protected $primaryKey = 'idEmployee';
    protected $hidden = [];
    public function Note(){
    	return $this->belongsTo('App\Note','idNote');
    }
    public function Feedback(){
    	return $this->hasMany('App\Feedback','idEmployee');
    }
    public function Project(){
    	return $this->belongsToMany('App\Project','ProjectEmployee','idEmployee','idProject');
    }
    public function Employee_Record(){
    	return $this->hasMany('App\Employee_Record','idEmployee');
    }
    public function User(){
    	return $this->belongsTo('App\User','idAccount');
    }
    public function Clients_Request(){
    	return $this->belongsToMany('App\Clients','App\RequestC_E');
    }
    public function Employee_Requests(){
    	return $this->belongsToMany('App\Employee','App\RequestE_E');
    }
    public function Skill(){
    	return $this->belongsToMany('App\Skill','SkillDetail','idEmployee','idSkill')->withPivot('S_Rate');
    }
    public function Team(){
    	return $this->belongsToMany('App\Team','TeamMember','idMember','idTeam');
    }
    public function EnglishChart(){
    	return $this->belongsTo('App\EnglishChart','IdEChart');
    }
    public function E_Status(){
    	return $this->belongsTo('App\E_Status','idStatus');
    }
    public function History(){
        return $this->hasMany('App\History');
    }
    public $timestamps = false;
}
