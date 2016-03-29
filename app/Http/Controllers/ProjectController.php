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
    public function postcreateProject(Request $request){
        $error_list = array();
    	$project_name = $request->in_NameofProject;
    	$client = $request->sl_Client;
    	$timerange = $request->daterange;
    	$leader = $request->sl_Leader;
    	$PM = $idE = Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee;
    	///////////////////////////
    	$date = explode('-', $timerange);
    	$startday = date_create($date[0])->format('d-m-Y');
    	$endday = date_create($date[1])->format('d-m-Y');
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
    			$pe->idProject = $p->id;
    			$pe->idEmployee = $request->c[$i];
    			$pe->save();
    		}
    	}
    	return redirect('/project');
	}
}
