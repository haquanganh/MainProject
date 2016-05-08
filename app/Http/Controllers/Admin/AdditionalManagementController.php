<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Skill;
use App\Employee;
use App\EnglishChart;
class AdditionalManagementController extends Controller
{
    //add skill
    public function getAddSkill	(){
    	$skill = Skill::all();
    	return view('admin.additional.add_skill', compact('skill'));
    }
    public function postAddSkill(Request $request){
    	$skillname = $request->input('skill_name');
    	$describe = $request->input('describe');

    	$skill = new Skill;
    	$skill->Skill = $skillname;
    	$skill->S_Note = $describe;
    	if($skill->save())
    	{
    		return $skill->idSkill;
    	}
    	return json_encode('fail');
    }
    public function postEditSkill(Request $request){
        $idSkill = $request->input('idSkill');
        $skillname = $request->input('skill_name');
        $desc = $request->input('skill_des');

        $update = Skill::find($idSkill);
        $update->Skill = $skillname;
        $update->S_Note = $desc;
        if($update->save())
        {
            return json_encode($update);
        }
        return json_encode('fail');
    }
    //add english record
    public function postAddEnglishRecord(Request $request){
        $idEmployee = $request->input('employee');
        $month = $request->input('month');
        $year = $request->input('year');
        $score = $request->input('score');
        $check = EnglishChart::where('idEmployee', '=', $idEmployee)
                    ->where('Year', '=', $year)
                    ->get();
        if(sizeof($check) > 0)
        {
            $data = array(
                $month => $score
                );
            $update = EnglishChart::where('idEmployee', '=', $idEmployee)
                        ->where('Year', '=', $year)
                        ->update($data);
            if($update > 0)
            {
                $record = EnglishChart::where('idEmployee', '=', $idEmployee)->get();
                if(sizeof($record) > 0)
                {   
                    return json_encode($record);
                } else
                    return json_encode('fail');
            }
            return json_encode('fail');
        } else 
        {
            $data = array(
                $month => $score,
                'idEmployee' => $idEmployee,
                'Year' => $year
                );
            $insert = EnglishChart::insert($data);
            if($insert > 0)
            {
                 $record = EnglishChart::where('idEmployee', '=', $idEmployee)->get();
                if(sizeof($record) > 0)
                {   
                    return json_encode($record);
                } else
                    return json_encode('fail');
            }
            return json_encode('fail');
        }

    }
    //get english record
    public function getAddEnglishRecord(){
        $list_E = Employee::all();
        return view('admin.additional.add_eng_record', compact('list_E'));
    }

    public function postGetEnglishRecord(Request $request){

        $idEmployee = $request->input('employee');
        $record = EnglishChart::where('idEmployee', '=', $idEmployee)->get();
        if(sizeof($record) > 0)
        {   
            return json_encode($record);
        } else
            return json_encode('fail');
    }
}
