<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Team as Team;
use Auth;
use App\Employee as Employee;
class TeamManagementController extends Controller
{
    public function viewTeam(){
    	$idPM = Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee;
    	$team = Team::where('idPManager','=',$idPM)->first()->Employee;
    	return view('project.team_management',compact('team'));
    }
}
