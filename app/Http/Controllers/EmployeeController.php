<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Employee;
use DB;
use App\Skill;
use App\SkillDetail;
class EmployeeController extends Controller
{
    public function getEmployee(){
    	$list_employee = Employee::all();
    	return view('personal.employee_information',compact('list_employee'));
    }
    public function postEmployee(Request $request){
    	$search = $request->input('search');
    	// lay du lieu inner join  giua 3 bang Employee, SkillDetail, Skill
    	$Listskill = DB::table('Employee')
    				->join('SkillDetail', 'Employee.idEmployee', '=', 'SkillDetail.idEmployee')
    				->join('Skill', 'SkillDetail.idSKill', '=', 'Skill.idSKill')
    				->select('Employee.*')
                    ->distinct()
                    ->where('Skill.Skill', '=', $search)
    				->orwhere('E_Cost_Hour', '=', $search)
                    ->orwhere('E_Name', 'LIKE', '%'.$search.'%')
                    ->orderBy('E_Cost_Hour','desc')
                    ->get();
 		$list_employee = Employee::all();
    	if(count($Listskill) == 0)
    	{
    		
    		return view('personal.employee_information',compact('list_employee'))
    		->with('message', 'Sorry, no employee matched your search. Please try again!');	
    	}
    	else {
    		return view('personal.employee_information',compact('list_employee'))
    		->with('Listskill', $Listskill);
    	}
    }
}
