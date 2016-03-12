<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Employee as Employee;
use App\User as User;
use App\Role as Role;
use DB;
use App\SkillDetail as SkillDetail;
use App\Http\Requests\Admin_Personal_Information_Request;
class Personal_Information_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_employee = Employee::all();
		return view('admin.view',compact('list_employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('admin.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Admin_Personal_Information_Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->E_Email = $request->in_Email;
        $employee->E_Name = $request->in_FullName;
        $employee->E_Skype = $request->in_Skype;
        $employee->E_Phone = $request->in_Phone;
        $employee->E_Address = $request->in_Address;
        $employee->E_EngName = $request->in_eName;
        $employee->E_Cost_Hour = $request->in_CostHour;
        $employee->E_DateofBirth = $request->in_Dateofbirth;
        $role_name = $request->Role;
        $role = Role::where('Role','=',$role_name)->first();
        $user = User::where('idAccount','=',$id)->first();
        $user->idRole = $role->idRole;
        $user->save();


        $list_skill = Employee::find($id)->Skill()->get();
        foreach ($list_skill as $skill) {
            $skill->pivot->S_Rate = $request->input($skill->Skill);
            $skill->pivot->save();
        }
        $img_file = $request->in_img;
        if($img_file){
            $img_file_name = $img_file->getClientOriginalName();
            $img_file_extension_name = $img_file->getClientOriginalExtension();
            $img_file->move(public_path('images/personal_images'), $id.'avatar.'.$img_file_extension_name);
            $employee->E_Avatar = $id.'avatar.'.$img_file_extension_name;
        }
        $employee->save();
        return redirect()->route('admin.personal-information.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
