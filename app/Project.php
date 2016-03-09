<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'Project';
    protected $fillable = ['idProject', 'P_Name','idPManager','idTeamleader','idClient','P_DateCreate','P_Note','idPStatus'];
    protected $hidden = [];
    public function ProjectStatus(){
    	return $this->belongsTo('App\ProjectStatus','idPStatus');
    }
    public function Clients(){
    	return $this->belongsTo('App\Clients','idClient');
    }
    public function Employee(){
    	return $this->belongsToMany('App\Employee','App\ProjectEmployee');
    }
}
