<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Request;
use App\Team as Team;
use App\Project as Project;
class AjaxController extends Controller{
	public function getlistPM(){
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
    public function getlistProject(){
        if(Request::ajax()){
            $idPStatus = (int) Request::get('idPStatus');
            $Projects = Project::where('idPStatus','=',$idPStatus)->get();
            if(!empty($Projects)){
                return $Projects;
            }
            else{
                return 'Empty';
            }
        }
    }
}




