<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Team as Team;
use App\TeamMember as TeamMember;
use Auth;
use App\Employee as Employee;
class TeamManagementController extends Controller
{
    public function viewTeam(){
    	$idPM = Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee;
    	$team = Team::where('idPManager','=',$idPM)->first()->Employee;
    	return view('project.team_management',compact('team'));
    }
    public function viewEmployee($id){
        $idUser_Employee = Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee;
        $idPM = Employee::find($id)->Team->first()->idPManager;
        if($idUser_Employee == $idPM){
            $employee = Employee::find($id);
            $verify = '';
            return view('personal.view',compact('employee','verify'));
        }
        return redirect('/');
    }
}
