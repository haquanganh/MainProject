<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Request;
use App\Employee as Employee;
class AjaxController extends Controller{
	public function getemployee(){
		if(Request::ajax()){
            $idE = (int) Request::get('idE');
            $E = Employee::find($idE);
            $skill_list = $E->Skill;
            if(!empty($skill_list)){
                return json_encode(array($E,$skill_list));
            }
            else{
                return 'Empty';
            }
        }
	}
}




