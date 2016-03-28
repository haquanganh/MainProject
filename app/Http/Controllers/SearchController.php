<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Employee;
use DB;
use App\Skill;
use App\SkillDetail;
class SearchController extends Controller
{	

    public function getSearch(){
    	if(Auth::user()->idRole == 1 || Auth::user()->idRole == 4 )
    	{
			return view('layout.searchdemo');
		}
		  return redirect('/');
    }
    public function postSearch(Request $request){
    	$search = $request->input('search');
    	// lay du lieu inner join  giua 3 bang Employee, SkillDetail, Skill
    	$Listskill = DB::table('Employee')
    				->join('SkillDetail', 'Employee.idEmployee', '=', 'SkillDetail.idEmployee')
    				->join('Skill', 'SkillDetail.idSKill', '=', 'Skill.idSKill')
    				->select('Employee.*')
                    ->distinct()
                    ->where('Skill.Skill', '=', $search)
    				->orwhere('E_Cost_Hour', '=', $search)
                    ->orwhere('E_Name', '=', $search)
                    ->orderBy('E_Name','desc')
                    ->get();
 		//cost and name
    	// $cost = Employee::select()
    	// 		->where('E_Cost_Hour', '=', $search)
    	// 		->orwhere('E_Name', '=', $search)
    	// 		->orderBy('E_Name','desc')
    	// 		->get();

    	if(count($Listskill) == 0)
    	{
    		return view('layout.searchdemo')
    		->with('message', 'nothing!');	
    	}
    	else { 
    		return view('layout.searchdemo')
    		->with('Listskill', $Listskill);
    	}
    }
}
