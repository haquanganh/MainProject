<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateTimeZone;
use Auth;
use App\Employee as Employee;
use App\Project as Project;
use App\ProjectEmployee as ProjectEmployee;
use DB;
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
            $h->H_Content = 'Did edit project .'.$project->idProject;
            $h->H_DateCreate = new DateTime();
            $h->idAccount = Auth::user()->idAccount;
            $h->save();
            $original = $project->getOriginal();
            /*Save for leader*/
            /*Check if leader is changed or not*/
            if($original['idTeamLeader'] != $project->idTeamLeader){
                /*Save for new leader*/
                $h_l = new Employee_Record;
                $h_l->DateStart = $project->P_DateStart;
                $h_l->DateEnd = $project->P_DateFinish;
                $h_l->idEmployee = $project->idTeamLeader;
                $h_l->Content = 'Just become leader of the project '.$project->P_Name;
                $h_l->save();
            }
            
            return true;
        });
        static::created(function ($project){
            $h = new History;
            $h->H_Content = 'Did create new project .'.$project->idProject;
            $h->H_DateCreate = new DateTime();
            $h->idAccount = Auth::user()->idAccount;
            $h->save();
            /*Save for project manager*/
            $h_pm = new Employee_Record;
            $h_pm->DateStart = $project->P_DateStart;
            $h_pm->DateEnd = $project->P_DateFinish;
            $h_pm->idEmployee = $project->idPManager;
            $h_pm->Content = 'Just become project manager of the project '.$project->P_Name;
            $h_pm->save();
            /*Save for Team Leader*/
            $h_l = new Employee_Record;
            $h_l->DateStart = $project->P_DateStart;
            $h_l->DateEnd = $project->P_DateFinish;
            $h_l->idEmployee = $project->idTeamLeader;
            $h_l->Content = 'Just become leader of the project '.$project->P_Name;
            $h_l->save();
            return true;
        });
        static::deleted(function ($project){
            $h = new History;
            $h->H_Content = 'Did delete project '.$project->idProject ;
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
