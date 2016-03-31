<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Employee as Employee;
use Auth;
use App\Project as Project;
use App\ProjectEmployee as ProjectEmployee;
use App\Http\Requests\ProjectRequest;
use DateTime;
use DatePeriod;
use DateInterVal;
class ProjectController extends Controller
{
    public function viewProject(){
    	return view('project.index');
    }
    public function getcreateProject(){

    	return view('project.create_project');
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
    	$project_name = $request->in_NameofProject;
    	$client = $request->sl_Client;
    	$timerange = $request->daterange;
    	$leader = $request->sl_Leader;
    	$PM = Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee;
    	///////////////////////////
    	$date = explode('-', $timerange);
    	$startday = DateTime::createFromFormat('m/d/Y', trim($date[0]));
    	$endday = DateTime::createFromFormat('m/d/Y', trim($date[1]));
    	$p = new Project;
    	$p->P_Name       = $project_name;
    	$p->idPManager   = $PM;
    	$p->idTeamLeader = $leader;
    	$p->idClient     = $client;
    	$p->P_DateStart  = $startday;
    	$p->P_DateFinish = $endday;
    	$p->P_DateCreate = date("Y/m/d");
    	$p->idPStatus = 1;
    	$p->save();
    	/////////////////////////
    	for ($i = 0 ; $i < $request->n_listE ; $i++) {
    		if(isset($request->c[$i])){
    			$pe = new ProjectEmployee;
    			$pe->idProject = $p->idProject;
    			$pe->idEmployee = $request->c[$i];
    			$pe->save();
    		}
    	}
    	return redirect('/project');
	}
    public function project_detail($id){
        $project = Project::find($id);
        return view('project.project_detail',compact('project'));
    }
}
