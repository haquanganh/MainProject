<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'Project';
    protected $fillable = ['idProject', 'P_Name','idPManager','idTeamleader','idClient','P_DateCreate','P_DateStart','P_DateFinish','P_Note','idPStatus','P_OldVersion'];
    protected $hidden = [];
    protected $primaryKey = 'idProject';
    public $timestamps = false;
    public function ProjectStatus(){
    	return $this->belongsTo('App\ProjectStatus','idPStatus');
    }
    public function Clients(){
    	return $this->belongsTo('App\Clients','idClient');
    }
    public function Employee(){
    	return $this->belongsToMany('App\Employee','ProjectEmployee','idProject','idEmployee');
    }
    public function History(){
        return $this->hasMany('App\History');
    }
}
