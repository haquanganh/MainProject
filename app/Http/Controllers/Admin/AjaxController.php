<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Request;
use App\Team as Team;
use App\Project as Project;
use App\Feedback as Feedback;
use DateTime;
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
    public function getTop(){
        if(Request::ajax()){
            $detailed = (int) Request::get('detailed');
            if((int) Request::get('type')){
                $date = explode('-', Request::get('time'));
                $start = DateTime::createFromFormat('m/d/Y', trim($date[0]));
                $end = DateTime::createFromFormat('m/d/Y', trim($date[1]));
                // $feedbacks = Feedback::orderBy('F_DateCreate','DESC')->get();
                // $list = array();
                // foreach ($feedbacks as $key => $f) {
                //    $date = DateTime::createFromFormat('Y-m-d H:i:s',$f->F_DateCreate)->format('m/Y');
                //    if($date == Request::get('time')){
                //     array_push($list, $f);
                //    }

                // }
                // return json_encode(array($list));
                $feedbacks = Feedback::where(DB::raw('MONTH(F_DateCreate)','=',))
            }
            else{

            }

        }
    }
}




