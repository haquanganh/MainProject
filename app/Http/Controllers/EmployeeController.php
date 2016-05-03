<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Employee;
use DB;
use App\Skill;
use App\SkillDetail;
use App\RequestE_E;
use App\Request_info;
use App\Clients;
use App\User;
class EmployeeController extends Controller
{
    public function getEmployee(){
        $idAccount = Auth::user()->idAccount;
        $idRole = Auth::user()->idRole;
        if($idRole ==1 ) return redirect('/admin/personal-information');
        if($idRole == 4)
        {
            $idClient = Clients::select()->where('idAccount', '=', $idAccount)->first()->idClient;
            $listE = DB::select( DB::raw("SELECT Employee.*, Request.status, Request.idClient, Role.Role  FROM  Employee JOIN users ON Employee.idAccount = users.idAccount JOIN Role ON users.idRole = Role.idRole LEFT JOIN Request ON Employee.idEmployee = Request.idEmployee2 And (Request.idClient is null or Request.idClient = $idClient)"));
        }else {
            $idEmployee = Employee::select()->where('idAccount', '=', $idAccount)->first()->idEmployee;
            $listE = DB::select( DB::raw("SELECT Employee.*, RequestE_E.status, RequestE_E.idEmployee1, Role.Role  FROM  Employee JOIN users ON Employee.idAccount = users.idAccount JOIN Role ON users.idRole = Role.idRole LEFT JOIN RequestE_E ON Employee.idEmployee = RequestE_E.idEmployee2 And (RequestE_E.idEmployee1 is null or RequestE_E.idEmployee1 = $idEmployee) WHERE Employee.idAccount != $idAccount"));
        }
        $kq = array();
        for ($i=0; $i < sizeof($listE); $i++) {
            //nhung colum can hien thi
            $kq[$i]['idEmployee'] = $listE[$i]->idEmployee;
            $kq[$i]['avatar'] = $listE[$i]->E_Avatar;
            $kq[$i]['name'] = $listE[$i]->E_Name;
            $kq[$i]['dob'] = $listE[$i]->E_DateofBirth;
            $kq[$i]['skype'] = $listE[$i]->E_Skype;
            $kq[$i]['phone'] = $listE[$i]->E_Phone;
            $kq[$i]['role'] = $listE[$i]->Role;
            //$kq[$i]['reTime'] = $listE[$i]->responseTime;
            //check status
            if($listE[$i]->status != NULL)
            {
                if($listE[$i]->status == 1)
                    $kq[$i]['status'] = 1;
                else
                if($listE[$i]->status == 2)
                    $kq[$i]['status'] = 2;
                else
                    $kq[$i]['status'] = 0;

            } else {
                    $kq[$i]['status'] = 3;
            }
        }
        return view('personal.employee_information',compact('kq'));
    }

    public function postEmployee(Request $request){
        $idAccount = Auth::user()->idAccount;
        $search = $request->input('search');
        $search_type = $request->input('search-type');
        //get list employee
        if(Auth::user()->idRole == 4)
        {
            $idClient = Clients::select()->where('idAccount', '=', $idAccount)
                        ->first()->idClient;
            if($search_type == 'Search by name'){
                $listE = DB::select( DB::raw("SELECT Employee.* , Request.status, Request.idClient, Role.Role FROM Employee JOIN users ON Employee.idAccount = users.idAccount JOIN Role ON users.idRole = Role.idRole LEFT JOIN Request ON Employee.idEmployee = Request.idEmployee2 AND (Request.idClient IS NULL OR Request.idClient =1) WHERE Employee.E_Name LIKE '%$search%'"));
            }
            else if($search_type == 'Search by skill'){
                $listE = DB::select( DB::raw("SELECT Employee.* , Request.status, Request.idClient, Role.Role FROM Employee JOIN SkillDetail ON Employee.idEmployee = SkillDetail.idEmployee JOIN Skill ON SkillDetail.idSkill = Skill.idSkill JOIN users ON Employee.idAccount = users.idAccount JOIN Role ON users.idRole = Role.idRole LEFT JOIN Request ON Employee.idEmployee = Request.idEmployee2 AND (Request.idClient IS NULL OR Request.idClient =1) WHERE Skill.Skill LIKE '%$search%'"));
            }
            else if($search_type == 'Search by cost/hour'){
                $listE = DB::select( DB::raw("SELECT Employee.* , Request.status, Request.idClient, Role.Role FROM Employee JOIN users ON Employee.idAccount = users.idAccount JOIN Role ON users.idRole = Role.idRole LEFT JOIN Request ON Employee.idEmployee = Request.idEmployee2 AND (Request.idClient IS NULL OR Request.idClient =1) WHERE Employee.E_Cost_Hour = $search"));
            }
        }else {
            $idEmployee = Employee::select()->where('idAccount', '=', $idAccount)
                            ->first()->idEmployee;
            if($search_type == 'Search by name'){
                $listE = DB::select( DB::raw("SELECT Employee.*, RequestE_E.status, RequestE_E.idEmployee1, Role.Role  FROM  Employee JOIN users ON Employee.idAccount = users.idAccount JOIN Role ON users.idRole = Role.idRole LEFT JOIN RequestE_E ON Employee.idEmployee = RequestE_E.idEmployee2 And (RequestE_E.idEmployee1 is null or RequestE_E.idEmployee1 = $idEmployee) WHERE Employee.idAccount != $idAccount and Employee.E_Name LIKE '%$search%'"));
            }
            else if($search_type == 'Search by skill'){
                $listE = DB::select( DB::raw("SELECT Employee.*, RequestE_E.status, RequestE_E.idEmployee1, Role.Role FROM  Employee JOIN SkillDetail ON Employee.idEmployee = SkillDetail.idEmployee JOIN Skill ON SkillDetail.idSkill = Skill.idSkill JOIN users ON Employee.idAccount = users.idAccount JOIN Role ON users.idRole = Role.idRole LEFT JOIN RequestE_E ON Employee.idEmployee = RequestE_E.idEmployee2 And (RequestE_E.idEmployee1 is null or RequestE_E.idEmployee1 = $idEmployee) WHERE Employee.idAccount != $idAccount and Skill.Skill LIKE '%$search%'"));
            }
        }

        //check list_search co ton tai hay ko
        if(count($listE) != 0 && $search != NULL)
        {
            $list_search = array();
            for ($i=0; $i < sizeof($listE); $i++) {
                //nhung colum can hien thi
                $list_search[$i]['idEmployee'] = $listE[$i]->idEmployee;
                $list_search[$i]['avatar'] = $listE[$i]->E_Avatar;
                $list_search[$i]['name'] = $listE[$i]->E_Name;
                $list_search[$i]['dob'] = $listE[$i]->E_DateofBirth;
                $list_search[$i]['skype'] = $listE[$i]->E_Skype;
                $list_search[$i]['phone'] = $listE[$i]->E_Phone;
                $list_search[$i]['role'] = $listE[$i]->Role;
                //check status
                if($listE[$i]->status != NULL)
                {
                    if($listE[$i]->status == 1)
                        $list_search[$i]['status'] = 1;
                    else
                    if($listE[$i]->status == 2)
                        $list_search[$i]['status'] = 2;
                    else
                        $list_search[$i]['status'] = 0;
                } else {
                    $list_search[$i]['status'] = 3;
                }
            }
            return view('personal.employee_information', compact('list_search'))
                    ->with('searches', $search)
                    ->with('search_type', $search_type);
        }
        else {
            if(Auth::user()->idRole == 4)
            {
                $idClient = Clients::select()->where('idAccount', '=', $idAccount)
                            ->first()->idClient;
                $listE = DB::select( DB::raw("SELECT Employee.*, Request.status, Request.idClient, Role.Role  FROM  Employee JOIN users ON Employee.idAccount = users.idAccount JOIN Role ON users.idRole = Role.idRole LEFT JOIN Request ON Employee.idEmployee = Request.idEmployee2 And (Request.idClient is null or Request.idClient = $idClient)"));
            }else {
                $idEmployee = Employee::select()->where('idAccount', '=', $idAccount)
                                ->first()->idEmployee;
                $listE = DB::select( DB::raw("SELECT Employee.*, RequestE_E.status, RequestE_E.idEmployee1, Role.Role  FROM  Employee JOIN users ON Employee.idAccount = users.idAccount JOIN Role ON users.idRole = Role.idRole LEFT JOIN RequestE_E ON Employee.idEmployee = RequestE_E.idEmployee2 And (RequestE_E.idEmployee1 is null or RequestE_E.idEmployee1 = $idEmployee) WHERE Employee.idAccount != $idAccount"));
            }

            $kq = array();
            for ($i=0; $i < sizeof($listE); $i++) {
                //nhung colum can hien thi
                $kq[$i]['idEmployee'] = $listE[$i]->idEmployee;
                $kq[$i]['avatar'] = $listE[$i]->E_Avatar;
                $kq[$i]['name'] = $listE[$i]->E_Name;
                $kq[$i]['dob'] = $listE[$i]->E_DateofBirth;
                $kq[$i]['skype'] = $listE[$i]->E_Skype;
                $kq[$i]['phone'] = $listE[$i]->E_Phone;
                $kq[$i]['role'] = $listE[$i]->Role;
                //check status
                if($listE[$i]->status != NULL)
                {
                    if($listE[$i]->status == 1)
                        $kq[$i]['status'] = 1;
                    else
                    if($listE[$i]->status == 2)
                        $kq[$i]['status'] = 2;
                    else
                        $kq[$i]['status'] = 0;
                } else {
                        $kq[$i]['status'] = 3;
                }
            }
            if($search == NULL)
                return view('personal.employee_information', compact('kq'))
                    ->with('searches', $search)
                    ->with('search_type', $search_type);
            return view('personal.employee_information', compact('kq'))
                    ->with('message', 'Sorry, no employee matched your search. Please try again!')
                    ->with('searches', $search)
                    ->with('search_type', $search_type);
        }
    }

    public function getInfor($id){
        /*Validate page view for employee*/
        if(Auth::user()->idRole != 4){
            $senderId = Employee::where('idAccount','=',Auth::user()->idAccount)->first()->idEmployee;
            $check_ee = RequestE_E::where('idEmployee1','=',$senderId)->where('idEmployee2','=',$id)->first();
            if(count($check_ee) == 0) return redirect('/');
            else if($check_ee->status != 1) return redirect('/');
        }
        /*Validate page view for client*/
        else{
            $senderId = Clients::where('idAccount','=',Auth::user()->idAccount)->first()->idClient;
            $check_ee = Request_info::where('idClient','=',$senderId)->where('idEmployee2','=',$id)->first();
            if(count($check_ee) == 0) return redirect('/');
            else if($check_ee->status != 1) return redirect('/');
        }
        $employee = Employee::find($id);
        $verify = 0;
        return view('personal.view',compact('employee','verify'));
    }
}
