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
        $idAccount = Auth::user()->idAccount;
        $list_employee = DB::table('Employee')->where('idAccount', '!=', $idAccount)->get();
        return view('personal.employee_information',compact('list_employee'));
    }
    
    public function postEmployee(Request $request){
        $search = $request->input('search');
        $search_type = $request->input('search-type');
        $idAccount = Auth::user()->idAccount;
        if($search_type == 'Search by name'){
            $Listskill = DB::table('Employee')
                    ->join('SkillDetail', 'Employee.idEmployee', '=', 'SkillDetail.idEmployee')
                    ->join('Skill', 'SkillDetail.idSKill', '=', 'Skill.idSKill')
                    ->select('Employee.*')
                    ->distinct()
                    ->where('E_Name', 'LIKE', '%'.$search.'%')
                    ->where('idAccount', '!=', $idAccount)
                    ->orderBy('E_Cost_Hour','asc')
                    ->get();
        }
        else if($search_type == 'Search by skill'){
            $Listskill = DB::table('Employee')
                    ->join('SkillDetail', 'Employee.idEmployee', '=', 'SkillDetail.idEmployee')
                    ->join('Skill', 'SkillDetail.idSKill', '=', 'Skill.idSKill')
                    ->select('Employee.*')
                    ->distinct()
                    ->where('Skill.Skill', '=', $search)
                    ->where('idAccount', '!=', $idAccount)
                    ->orderBy('E_Cost_Hour','asc')
                    ->get();
        }
        else if($search_type == 'Search by cost/hour'){
            $Listskill = DB::table('Employee')
                    ->join('SkillDetail', 'Employee.idEmployee', '=', 'SkillDetail.idEmployee')
                    ->join('Skill', 'SkillDetail.idSKill', '=', 'Skill.idSKill')
                    ->select('Employee.*')
                    ->distinct()
                    ->where('E_Cost_Hour', '=', $search)
                    ->where('idAccount', '!=', $idAccount)
                    ->orderBy('E_Cost_Hour','asc')
                    ->get();
        }
        $list_employee = DB::table('Employee')->where('idAccount', '!=', $idAccount)->get();
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
