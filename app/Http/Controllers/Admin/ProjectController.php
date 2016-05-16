<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Employee as Employee;
use Auth;
use App\Project as Project;
use App\ProjectEmployee as ProjectEmployee;
use App\Employee_Record as Employee_Record;
use DB;
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
        $p->P_Description = $request->in_descrip;
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
        /*Save to Employee Record*/
        $p_e = $p->Employee;
        foreach ($p_e as $key => $e) {
            $h_e = new Employee_Record;
            $h_e->DateStart = $now;
            //$h_e->DateEnd = $p->P_DateFinish;
            $h_e->idEmployee = $e->idEmployee;
            $h_e->Content = 'Just become member of project.'.$p->idProject;
            $h_e->save();
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
        $old_start = new DateTime(Project::find($id)->P_DateStart);
        if($start < $old_start){
            $arr0 = array('wrong_start_day' => 'Start Date has to be more than old created date ');
            $error_list = $error_list + $arr0;
        }
        if($num_day < 7 ){
            $arr1 = array('wrong_day' => 'Date Range has to be equal or more than 7 days');
            $error_list = $error_list + $arr1;
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
        $old_leader = $project->idTeamLeader;
        $old_pm = $project->idPManager;
        $project->P_Name = $request->in_PName;
        $project->idClient = $request->sl_Client;
        $timerange = $request->daterange;
        $date = explode('-', $timerange);
        $startday = DateTime::createFromFormat('m/d/Y', trim($date[0]));
        $endday = DateTime::createFromFormat('m/d/Y', trim($date[1]));
        $project->P_DateStart = $startday;
        $project->P_DateFinish = $endday;
        $project->P_Description = $request->in_descrip;
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
        $pe_old =  ProjectEmployee::where('idProject','=',$id)->get();
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
        if($old_leader != $project->idTeamLeader){
                /*Save for new leader*/
                $h_l = new Employee_Record;
                $h_l->DateStart = new DateTime();
                //$h_l->DateEnd = $project->P_DateFinish;
                $h_l->idEmployee = $project->idTeamLeader;
                $h_l->Content = 'Just become leader of the project.'.$project->idProject;
                $h_l->save();
                /*Update old roles's DateEnd*/
                /*Check if this leader is member of old version*/
                $check1 = false;
                foreach ($pe_old as $key => $p) {
                    if($p->idEmployee == $project->idTeamLeader){
                        $check1 = true;
                        break;
                    }
                }
                if($check1 == true){
                    $idERecord = (array) Employee_Record::where('idEmployee','=',$project->idTeamLeader)->orderBy('DateStart','DESC')->get()[1];
                    DB::table('Employee_Record')->where('idERecord', $idERecord)->update(['DateEnd' => $now]);
                }
            }
        /*Save to Employee Record for Employee*/
            $p_e = $project->Employee;
            foreach ($p_e as $key => $e) {
                $check = false;
                /*Check if the old leader become member*/
                if($e->idEmployee == $old_leader){
                    $h_e = new Employee_Record;
                    $h_e->DateStart = $now;
                    //$h_e->DateEnd = $project->P_DateFinish;
                    $h_e->idEmployee = $e->idEmployee;
                    $h_e->Content = 'Just be changed from leader to member of project.'.$project->idProject;
                    $h_e->save();
                    /*Update DateEnd for newest version of employee*/
                    $idER =(array) DB::select("select idERecord from Employee_Record where substring(Content,instr(Content,'.')+1,length(Content)) = ".$project->idProject." and idEmployee = ".$e->idEmployee." order by DateStart DESC")[1];
                    DB::table('Employee_Record')->where('idERecord', $idER)->update(['DateEnd' => $now]);

                }
                else{
                    /*Check if this employee exists in the old projectemployee*/
                    foreach ($pe_old as $key => $value) {
                        if($value->idEmployee == $e->idEmployee){
                            $check = true;
                            break;
                        }
                    }/*New member*/
                    if($check == false){
                        $h_e = new Employee_Record;
                        $h_e->DateStart = $now;
                        //$h_e->DateEnd = $project->P_DateFinish;
                        $h_e->idEmployee = $e->idEmployee;
                        $h_e->Content = 'Just become member of project.'.$project->idProject;
                        $h_e->save();
                    }
                }
            }
            /*Check member were removed out of project*/

            foreach ($pe_old as $key => $old) {
                $check = false;
                /*Check if old employee becomes new leader*/
                foreach ($p_e as $key => $new) {
                    if($new->idEmployee == $old->idEmployee){
                        $check = true;
                        break;
                    }
                }
                /*If don't have in new list of project employee*/
                if($check == false){
                    /*Not leader*/
                    if($old->idEmployee != $project->idTeamLeader){
                        $h_e = new Employee_Record;
                        $h_e->DateStart = $now;
                        //$h_e->DateEnd = $now;
                        $h_e->idEmployee = $old->idEmployee;
                        $h_e->Content = 'Just be removed out of project.'.$project->idProject;
                        $h_e->save();
                        /*Update the old time of this employee*/
                         $idERecord = (int)  (array) DB::select("select idERecord from Employee_Record where substring(Content,instr(Content,'.')+1,length(Content)) = ".$project->idProject." and idEmployee = ".$old->idEmployee." order by DateStart DESC")[1];
                        DB::table('Employee_Record')->where('idERecord', $idERecord)->update(['DateEnd' => $now]);
                    }
                }
            }
            if($request->sl_PStatus == 2){
                $listE_Done =(array) DB::select("select * from Employee_Record where substring(Content,instr(Content,'.')+1,length(Content)) = ".$project->idProject." and DateEnd is null");
                foreach ($listE_Done as $key => $value) {
                    DB::table('Employee_Record')->where('idERecord', $value->idERecord)->update(['DateEnd' => $now]);
                }
            }
        $flat = 'You are successful to edit the project';
        return redirect('/admin/project')->with('flat',$flat);
    }
}