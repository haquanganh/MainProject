<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Request;
use App\Team as Team;
use App\Project as Project;
use App\Feedback as Feedback;
use App\Employee as Employee;
use DateTime;
use DB;
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
            $list = array();
            $detailed = (int) Request::get('detailed');
            $date = explode('/', Request::get('time'));
            
            $top = (int) Request::get('top');
            if((int) Request::get('type') == 1){
                $month = (int) $date[0];
                $year = (int) $date[1];
                $detailed = explode('-', Request::get('detailed'));
                $feedbacks = DB::select('select * from (select idEmployee, avg(F_Rate) as Average_Point from Feedback where month(F_DateCreate) = '.$month.' and year(F_DateCreate) = '.$year.' group by idEmployee order by Average_Point DESC limit '.$top.') as Filter where Average_Point between '.(int) $detailed[0].' and '.$detailed[1]);
                foreach ($feedbacks as $key => $f) {
                    $employees = Employee::find($f->idEmployee);
                    $employees->setAttribute('Point',$f->Average_Point);
                    array_push($list,$employees);
                }
            }
            else{
                $month = $date[0];
                $year = $date[1];
                $detailed = explode('-', Request::get('detailed'));
                $oes = DB::select('select Month'.$month.' as points, idEmployee from EnglishChart where (Month'.$month.' between '.$detailed[0].' and '.$detailed[1].') and Year = '.$year.' order by Month'.$month.' DESC limit '.$top);
                foreach ($oes as $key => $o) {
                    $employees1 = Employee::find($o->idEmployee);
                    $employees1->setAttribute('Point',$o->points);
                    array_push($list,$employees1);
                }
            
            }
            if(count($list) != 0 ){
                return json_encode(array($list));
            }
            else{
                return 'Empty';
            }
        }
    }
}




