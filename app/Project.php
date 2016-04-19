<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateTimeZone;
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
            $h->H_Content = 'Did edit project .'.$project->idProject;
            $h->H_DateCreate = new DateTime();
            $h->idAccount = Auth::user()->idAccount;
            $h->save();
            /*old $project*/
            // $old_project = $project->getOriginal();
            // /*Save employee involved to project to Employee_Record*/
            // $employees = Project::find($project->idProject)->Employee;
            // $old_employees = Project::find($old_project->idProject)->Employee;
            // /*Check old leader*/
            // foreach ($old_employees as $key => $e) {
            //     if($project->idTeamleader == $e->idEmployee){
            //         $r = new Employee_Record;
            //         $r->Content = 'Was moved to project '.$project->P_Name;
            //         $r->DateStart = new DateTime();
            //         $r->idEmployee = $e->idEmployee;
            //         $r->save();
            //     }
            return true;
        });
        static::created(function ($project){
            $h = new History;
            $h->H_Content = 'Did create new project .'.$project->idProject;
            $h->H_DateCreate = new DateTime();
            $h->idAccount = Auth::user()->idAccount;
            $h->save();
            // $employees = Project::find($project->idProject)->Employee;
            // foreach ($employees as $key => $e) {
            //     $r = new Employee_Record;
            //     $r->Content = 'Was moved to project '.$project->P_Name;
            //     $r->DateStart = new DateTime();
            //     $r->idEmployee = $e->idEmployee;
            //     $r->save();
            // }
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
