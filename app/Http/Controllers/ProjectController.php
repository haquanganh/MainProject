<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Employee as Employee;
use Auth;
use App\Project as Project;
use App\ProjectEmployee as ProjectEmployee;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\EditProject_Request;
use App\Team as Team;
use App\History as History;
use DateTime;
use DateTimeZone;
use DatePeriod;
use DateInterVal;
class ProjectController extends Controller
{
    public function viewProject(){
        return view('project.index');
    }
    public function getcreateProject(){
        if(Auth::user()->idRole == 2)
            return view('project.create_project');
        else if(Auth::user()->idRole ==1)
            return redirect()->route('admin.personal-information.index');
        else
            return redirect('/');
    }
    public function postcreateProject(ProjectRequest $request){
        $error_list = array();
        $date = explode('-', $request->daterange);
        $start = DateTime::createFromFormat('m/d/Y', trim($date[0]));
        $end = DateTime::createFromFormat('m/d/Y', trim($date[1]));
        $now = new DateTime();
        $oneday = new DateInterval("P1D");
        $num_day = 0;
        foreach(new DatePeriod($start, $oneday, $end->add($oneday)) as $day) {
            $day_num = $day->format("N"); /* 'N' number days 1 (mon) to 7 (sun) */
            if($day_num < 6) { /* weekday */
                $num_day= $num_day+1;
            }
        }
        if($num_day < 7 ){
            $arr1 = array('wrong_day' => 'Date Range has to be equal or more than 7 days');
            $error_list = $error_list + $arr1;
        }
        if($start < $now){
            $arr0 = array('wrong_start_day' => 'Start Date has to be more than current date ');
            $error_list = $error_list + $arr0;
        }
        if(!empty($error_list)){
            return redirect()->back()->withInput()->withErrors($error_list);
        }
        /*Save project*/
    	$project_name = $request->in_NameofProject;
    	$client = $request->sl_Client;
    	$timerange = $request->daterange;
    	$leader = $request->sl_Leader;
    	$PM = Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee;
    	///////////////////////////
    	$date = explode('-', $timerange);
    	$startday = DateTime::createFromFormat('m/d/Y', trim($date[0]));
    	$endday = DateTime::createFromFormat('m/d/Y', trim($date[1]));
        /*Save project*/
    	$p = new Project;
    	$p->P_Name       = $project_name;
    	$p->idPManager   = $PM;
    	$p->idTeamLeader = $leader;
    	$p->idClient     = (int)$client;
    	$p->P_DateStart  = $startday;
    	$p->P_DateFinish = $endday;
    	$p->P_DateCreate = $now;
    	$p->idPStatus = 1;
    	$p->save();
        /*Set leader status*/
        $set = Employee::find($leader);
        $set->idStatus = 1;
        $set->save();
    	/*Save the members*/
    	for ($i = 0 ; $i < $request->n_listE ; $i++) {
	        if($request->input('c.'.$i) != null){
                $pe = new ProjectEmployee;
                $pe->idProject = $p->idProject;
                $pe->idEmployee = $request->input('c.'.$i);
                $pe->save();
                $set = Employee::find($request->input('c.'.$i));
                $set->idStatus = 1;
                $set->save();
            }
    	}
    	$flat = 'You are successful to create new project';
        return redirect('/project')->with('flat',$flat);
	}
    public function project_detail($id){
        /*Check user's project is compatibile with url project*/
        $project = Project::find($id);
        return view('project.project_detail',compact('project'));
    }
    public function getEditProject($id){
        if(Auth::user()->idRole == 2){
        $project = Project::find($id);
        return view('project.edit_project',compact('project'));
        }
        else if(Auth::user()->idRole ==1)
            return redirect()->route('admin.personal-information.index');
        else
            return redirect('/');
    }
    public function postEditProject(EditProject_Request $request, $id){
        /*Validate*/
        $error_list = array();
        $date = explode('-', $request->daterange);
        $start = DateTime::createFromFormat('m/d/Y', trim($date[0]));
        $end = DateTime::createFromFormat('m/d/Y', trim($date[1]));
        $now = new DateTime();
        $oneday = new DateInterval("P1D");
        $num_day = 0;
        foreach(new DatePeriod($start, $oneday, $end->add($oneday)) as $day) {
            $day_num = $day->format("N"); /* 'N' number days 1 (mon) to 7 (sun) */
            if($day_num < 6) { /* weekday */
                $num_day= $num_day+1;
            }
        }
        if($num_day < 7 ){
            $arr1 = array('wrong_day' => 'Date Range has to be equal or more than 7 days');
            $error_list = $error_list + $arr1;
        }
        if($start < $now){
            $arr0 = array('wrong_start_day' => 'Start Date has to be more than current date ');
            $error_list = $error_list + $arr0;
        }
        if($request->r_leader == null){
            $arr2 = array('wrong_leader' => 'Please choose the leader for team');
            $error_list =$error_list + $arr2;
        }
        if(!empty($error_list)){
            return redirect()->back()->withInput()->withErrors($error_list);
        }
        /*Update*/
        $project = Project::find($id);
        $check = $request->sl_PStatus == 2 ? 'Yes' : 'No';
        /*Set status for old leader*/
        if($check == 'Yes'){
            $set_old =Employee::find($project->idTeamLeader);
            $set_old->idStatus = 2;
            $set_old->save();
        }
        /*If project hasn't been done, check if leader is change, if it' changes, so changes old leader status to available*/
        else if($project->idTeamLeader != $request->r_Leader){
            $set_old =Employee::find($project->idTeamLeader);
            $set_old->idStatus = 2;
            $set_old->save();
        }
        /*Update new project information*/
        $project->P_Name = $request->in_PName;
        $project->idClient = $request->sl_Client;
        $timerange = $request->daterange;
        $date = explode('-', $timerange);
        $startday = DateTime::createFromFormat('m/d/Y', trim($date[0]));
        $endday = DateTime::createFromFormat('m/d/Y', trim($date[1]));
        $project->P_DateStart = $startday;
        $project->P_DateFinish = $endday;
        $project->idPstatus = $request->sl_PStatus;
        $project->idTeamLeader = $request->r_leader;
        $project->save();
        /*Update Member*/
        $team_employees = Team::where('idPmanager','=',$project->idPManager)->first()->Employee;
        /*If project is done ,Set status for old employee to available*/
        if($check == 'Yes'){
            $old_pe1 = ProjectEmployee::where('idProject','=',$id)->get();
            foreach ($old_pe1 as $key => $p) {
                $set = Employee::find($p->idEmployee);
                $set->idStatus = 2;
                $set->save();
            }
        }
        /*Delete old employee*/
        $old_pe = ProjectEmployee::where('idProject','=',$id);
        $old_pe->delete();
        $check = $request->sl_PStatus == 2 ? 'Yes' : 'No';
        /*Save new employee to ProjectEmployee*/
        for($i = 0 ;$i < count($team_employees) ; $i++ ){
            /*If checkbox is yes*/
            if(preg_match('/yes/',$request->input('cb.'.$i))){
                /*Get the id = $split[0]*/
                $split = explode(',',$request->input('cb.'.$i));
                /*Check if checkbox is not leader*/
                if((int) $split[0] != (int) $request->r_leader){
                    /*Save to ProjectEmployee*/
                    $p = new ProjectEmployee();
                    $p->idProject = $id;
                    $p->idEmployee =(int) $split[0];
                    /*If the project is done, set the status of employee to available*/
                    if($check == 'Yes'){
                        $set = Employee::find((int) $split[0]);
                        $set->idStatus = 2;
                        $set->save();
                    }
                    /*If the project hasn't been done*/
                    else{
                        $set = Employee::find((int) $split[0]);
                        $set->idStatus = 1;
                        $set->save();
                    }
                    $p->save();
                }
            }
        }
        $flat = 'You are successful to edit the project';
        return redirect('/project')->with('flat',$flat);
    }
}
