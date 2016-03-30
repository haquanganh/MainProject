<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Employee as Employee;
use Auth;
use App\Project as Project;
use App\ProjectEmployee as ProjectEmployee;
use App\Http\Requests\ProjectRequest;
use DateTime;
use DatePeriod;
use DateInterVal;
use Request;
use App\Team as Team;
class ProjectController extends Controller
{
	public function viewProject(){
    	return view('admin.project');
    }
    public function getcreateProject(){
    	return view('admin.create-project');
    }
    public function getRequest(){
    	if(Request::ajax()){
    		$id_PM = (int) Request::get('id_PM');
    		$list_E = Team::where('idPmanager','=',$id_PM)->first()->Employee;
    		if(!empty($list_E)){
    			return $list_E;
    		}
    		else{
    			return 'Empty';
    		}
    	}
    }
}