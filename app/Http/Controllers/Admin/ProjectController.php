<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Employee as Employee;
use Auth;
use App\Project as Project;
use App\ProjectEmployee as ProjectEmployee;
use App\History as History;
use App\User as User;
use App\Http\Requests\Admin_ProjectRequest;
use App\Http\Requests\Admin_EditProject_Request;
use DateTime;
use DateTimeZone;
use DatePeriod;
use DateInterVal;
use App\Team as Team;
class ProjectController extends Controller
{
	public function viewProject(){
    	return view('admin.project');
    }
    public function getcreateProject(){
    	return view('admin.create-project');
    }
    public function postcreateProject(Admin_ProjectRequest $request){
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
        $project_name = $request->in_NameofProject;
        $client = $request->sl_Client;
        $idPM = $request->sl_PM;
        $timerange = $request->daterange;
        $date = explode('-', $timerange);
        $startday = DateTime::createFromFormat('m/d/Y', trim($date[0]));
        $endday = DateTime::createFromFormat('m/d/Y', trim($date[1]));
        /*Save new project*/
        $p = new Project;
        $p->P_Name       = $project_name;
        $p->idPManager   = $idPM;
        $p->idClient     = $client;
        $p->P_DateStart  = $startday;
        $p->P_DateFinish = $endday;
        $p->P_DateCreate = date("Y/m/d");
        $p->idPStatus = 1;
        $p->idTeamLeader = $request->r_leader;
        $p->save();
        /*Set role leader for member*/
        $set_role = User::find(Employee::find($request->r_leader)->idAccount);
        $set_role->idRole = 3;
        $set_role->save();
        /*Set status for leader*/
        $set = Employee::find($request->r_leader);
        $set->idStatus = 1;
        $set->save();
        /*Save team member*/
        for ($i = 0 ; $i < $request->n_listE ; $i++) {
            if(isset($request->c[$i])){
                if($request->c[$i] != $request->r_leader){
                    $pe = new ProjectEmployee;
                    $pe->idProject = $p->idProject;
                    $pe->idEmployee = $request->c[$i];
                    $pe->save();
                    $set = Employee::find($request->c[$i]);
                    $set->idStatus = 1;
                    $set->save();
                }
            }
        }
        $flat = 'You are successful to create new project';
        return redirect('/admin/project')->with('flat',$flat);
    }
    public function project_detail($id){
        $project = Project::find($id);
        return view('admin.project_detail',compact('project'));
    }
    public function getEditProject($id){
        $project = Project::find($id);
        return view('admin.edit_project',compact('project'));
    }
    public function postEditProject(Admin_EditProject_Request $request,$id){
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
        $check = $request->sl_PStatus == 2 ? 'Yes' : 'No';
        $project = Project::find($id);
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
        /*Set to leader role*/
        $user = User::find(Employee::find($request->r_leader)->idAccount);
        $user->idRole = 3;
        $user->save();
        /*Check if project 's status is done*/
        if($check == 'Yes'){
            $set_old = Employee::find($project->idTeamLeader);
            $set_old->idStatus = 2;
            $set_old->save();
            /*Set to member role if project has done*/
            $user = User::find(Employee::find($project->idTeamLeader)->idAccount);
            $user->idRole = 5;
            $user->save();
            /*Set status of old employees to available*/
            $old_pe1 = ProjectEmployee::where('idProject','=',$id)->get();
            foreach ($old_pe1 as $key => $p) {
                $set = Employee::find($p->idEmployee);
                $set->idStatus = 2;
                $set->save();
            }

        }
        /*If project hasn't been done, check if leader is change, if it' changes, so changes old leader status to available*/
        else if($project->idTeamLeader != $request->r_Leader){
            $set_old =Employee::find($project->idTeamLeader);
            $set_old->idStatus = 2;
            $set_old->save();
            /*Set to member role*/
            $user = User::find(Employee::find($project->idTeamLeader)->idAccount);
            $user->idRole = 5;
            $user->save();
        }
        
        /*Delete old */
        $old_pe = ProjectEmployee::where('idProject','=',$id);
        $old_pe->delete();
        /*Save new to  projectemployee*/
        $team_employees = Team::where('idPmanager','=',$project->idPManager)->first()->Employee;
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
        return redirect('/admin/project')->with('flat',$flat);
    }
}