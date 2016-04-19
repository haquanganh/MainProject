<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Request;
use App\Employee as Employee;
use App\Project as Project;
use App\Clients as Clients;
use Auth;
use DB;
use App\Feedback as Feedback;
use App\EnglishChart as EnglishChart;
use DateTime;
class AjaxController extends Controller{
	public function getemployee(){
        if(Request::ajax()){
            $idE = (int) Request::get('idE');
            $E = Employee::find($idE);
            $skill_list = $E->Skill;
            $list_feedback = Feedback::where('idEmployee', '=', $idE)->get();
            if(!empty($skill_list)){
                return json_encode(array($E,$skill_list, $list_feedback));
            }
            else{
                return 'Empty';
            }
        }
    }
    public function getlistProject(){
        if(Request::ajax()){
            $idPStatus = Request::get('idPStatus');
            $idUser = 0;
            $projects_PM = 0;
            $projects_LD = 0;
            $project_TM = 0;
            if(Auth::user()->idRole != 4){
                $idUser = Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee;
                $projects_PM = Project::where('idPStatus','=',$idPStatus)->where('idPManager','=',$idUser)->get();
                $projects_LD = Project::where('idPStatus','=',$idPStatus)->where('idTeamLeader','=',$idUser)->get();
                $project_TM = Employee::find($idUser)->Project;
                
                if(!empty($projects_PM) || !empty($projects_LD) || !empty($project_TM) ){
                    return json_encode(array($projects_PM,$projects_LD,$project_TM));
                }
                else{
                    return 'Empty';
                }
            }
            else{
                $idUser = Clients::where('idAccount','=',Auth::user()->idAccount)->first()->idClient;
                $project_client = Project::where('idClient','=',$idUser)->where('idPStatus','=',$idPStatus)->get();
                if(!empty($project_client)){
                    return json_encode(array($project_client));
                }
                else{
                    return 'Empty';
                }
            }
            
            
        }
    }
    // Send json
    public function getChart(){
        if(Request::ajax()){
            $now = new DateTime();
            $idEmployee = Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee;
            $englishchart = EnglishChart::where('idEmployee','=',$idEmployee)->where('Year','=',$now->format('Y'))->first();
            /*English Chart*/
            $feedbacks = array();
            if(!empty(DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 1 and 2 and idEmployee = '.$idEmployee.' group by idEmployee')[0])){
                $feedback1 =(array) DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 1 and 2 and idEmployee = '.$idEmployee.' group by idEmployee')[0];
                array_push($feedbacks, $feedback1);
            }
            else{
                array_push($feedbacks, 0);
            }
            if(!empty(DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 3 and 4 and idEmployee = '.$idEmployee.' group by idEmployee')[0])){
                $feedback1 =(array) DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 3 and 4 and idEmployee = '.$idEmployee.' group by idEmployee')[0];
                array_push($feedbacks, $feedback1);
            }
            else{
                array_push($feedbacks, 0);
            }
            if(!empty(DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 5 and 6 and idEmployee = '.$idEmployee.' group by idEmployee')[0])){
                $feedback1 =(array) DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 5 and 6 and idEmployee = '.$idEmployee.' group by idEmployee')[0];
                array_push($feedbacks, $feedback1);
            }
            else{
                array_push($feedbacks, 0);
            }
            if(!empty(DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 7 and 8 and idEmployee = '.$idEmployee.' group by idEmployee')[0])){
                $feedback1 =(array) DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 7 and 8 and idEmployee = '.$idEmployee.' group by idEmployee')[0];
                array_push($feedbacks, $feedback1);
            }
            else{
                array_push($feedbacks, 0);
            }
            if(!empty(DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 9 and 10 and idEmployee = '.$idEmployee.' group by idEmployee')[0])){
                $feedback1 =(array) DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 9 and 10 and idEmployee = '.$idEmployee.' group by idEmployee')[0];
                array_push($feedbacks, $feedback1);
            }
            else{
                array_push($feedbacks, 0);
            }
            if(!empty(DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 11 and 12 and idEmployee = '.$idEmployee.' group by idEmployee')[0])){
                $feedback1 =(array) DB::select('select avg(F_Rate) as Average from Feedback where Month(F_DateCreate) between 11 and 12 and idEmployee = '.$idEmployee.' group by idEmployee')[0];
                array_push($feedbacks, $feedback1);
            }
            else{
                array_push($feedbacks, 0);
            }
            return json_encode(array($englishchart,$feedbacks));
        }
    }
}




