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
    				->join('Skill', 'SkillDetail.idSkill', '=', 'Skill.idSkill')
    				->select('Employee.*')
                    ->distinct()
                    ->where('Skill.Skill', '=', $search)
    				->orwhere('Employee.E_Cost_Hour', 'LIKE', '%'.$search.'%')
                    ->orwhere('Employee.E_Name', 'LIKE', '%'.$search.'%')
                    ->orderBy('E_Name','desc')
                    ->get();
 		$list_employee = Employee::all();
    	if(count($Listskill) > 0)
    	{
    		return view('personal.employee_information',compact('list_employee'))
            ->with('Listskill', $Listskill);
    		
    	}
    	else {
    		return view('personal.employee_information',compact('list_employee'))
            ->with('message', 'No matching records found. Please try again!'); 
    	}
        return redirect()->back();
    }
}
