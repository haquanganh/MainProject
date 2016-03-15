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
use App\Skill as Skill;
use App\Http\Requests\Admin_Personal_Information_Request;
use Auth;
use File;
use Illuminate\Support\Facades\Input;
class Personal_Information_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        
        $this->middleware('auth');
        

    }
    public function index()
    {
        if(Auth::user()->idRole != 1){
            return redirect('/');
        }
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
        if(Auth::user()->idRole != 1){
            return redirect('/');
        }
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
        if(Auth::user()->idRole != 1){
            return redirect('/');
        }
        $employee = Employee::find($id);
        /*Update new Role for User*/
        $id_Role = Role::where('Role','=',$request->sl_Role)->first()->idRole;
        $user = User::find($employee->idAccount);
        $user->idRole = $id_Role;
        $user->save();
        /* Update new infor for employee */
        $employee->E_Name = $request->in_Name;
        $employee->E_EngName = trim(Input::get('in_EName'));
        $employee->E_Address = trim(Input::get('in_Address'));
        $employee->E_Phone = $request->in_Phone;
        $employee->E_Skype = trim(Input::get('in_Skype'));
        $employee->E_Cost_Hour =$request->in_CostHour;
        $employee->E_DateofBirth = $request->in_Dateofbirth;
        $img_file = $request->in_img;
        if($img_file){
            if(File::exists(public_path('images/personal_images/'.$employee->E_Avatar)))
                File::delete(public_path('images/personal_images/'.$employee->E_Avatar));
            $img_file_extension_name = $img_file->getClientOriginalExtension();
            $img_file->move(public_path('images/personal_images'), $id.'Avatar.'.$img_file_extension_name);
            $employee->E_Avatar = $id.'Avatar.'.$img_file_extension_name;
        }
        $employee->save();
        $old_list_sk =  SkillDetail::where('idEmployee','=',$id);
        $old_list_sk->delete();
        for($i = 0 ; $i < $request->number_rows ; $i++){
            $name_in_Skill = 'sl_Skill'.$i;
            $name_in_Year = 'in_Year.'.$i;
            $detail_Skill = new SkillDetail;
            $detail_Skill->idEmployee = $id;
            $sk_id = Skill::where('Skill','=',$request->$name_in_Skill)->first()->idSkill;
            $detail_Skill->idSkill = $sk_id;
            $detail_Skill->S_Rate = $request->in_Year[$i];
            $detail_Skill->save();

        }
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
