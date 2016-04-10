<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Auth;
class Project extends Model
{
    protected $table = 'Project';
    protected $fillable = ['idProject', 'P_Name','idPManager','idTeamleader','idClient','P_DateCreate','P_DateStart','P_DateFinish','P_Note','idPStatus'];
    protected $hidden = [];
    protected $primaryKey = 'idProject';
    public $timestamps = false;
    public static function boot(){
        parent::boot();
        static::updated(function ($project){
            $h = new History;
            $h->H_Content = 'Did edit project .'.$project->idProject ;
            $h->H_DateCreate = new DateTime();
            $h->idAccount = Auth::user()->idAccount;
            $h->save();
            return true;
        });
        static::created(function ($project){
            $h = new History;
            $h->H_Content = 'Did create new project .'.$project->idProject ;
            $h->H_DateCreate = new DateTime();
            $h->idAccount = Auth::user()->idAccount;
            $h->save();
            return true;
        });
        static::deleted(function ($project){
            $h = new History;
            $h->H_Content = 'Did delete project .'.$project->idProject ;
            $h->H_DateCreate = new DateTime();
            $h->idAccount = Auth::user()->idAccount;
            $h->save();
            return true;
        });
    }
    public function ProjectStatus(){
    	return $this->belongsTo('App\ProjectStatus','idPStatus');
    }
    public function Clients(){
    	return $this->belongsTo('App\Clients','idClient');
    }
    public function Employee(){
    	return $this->belongsToMany('App\Employee','ProjectEmployee','idProject','idEmployee');
    }
}
