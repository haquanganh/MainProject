<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Employee as Employee;
use App\User as User;
use App\Role as Role;
use App\SkillDetail as SkillDetail;
use App\Http\Requests\RegisterRequest;
use App\Skill;
use Hash;
use Auth;
class Register_Controller extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth');
        

    }
    public function getRegister(){
        if(Auth::user()->idRole != 1){
            return redirect('/');
        }
        $list_skill = Skill::all();
        return view('admin.register',compact('list_skill'));
    }
    public function postRegister(RegisterRequest $request){
        if(Auth::user()->idRole != 1){
            return redirect('/');
        }
        $id_Role = Role::where('Role','=',$request->sl_Role)->first()->idRole;
        $user = new User;
        $user->Email = $request->in_Email;
        $user->Password = Hash::make($request->in_Password);
        $user->idRole = $id_Role;
        $user->save();
        $id_new_user = User::all()->last()->idAccount;
        $employee = new Employee;
        $employee->idEmployee = $request->in_id;
        $employee->E_Name = $request->in_Name;
        $employee->E_EngName = $request->in_EName;
        $employee->E_Address = $request->in_Address;
        $employee->E_Phone = $request->in_Phone;
        $employee->E_Skype = $request->in_Skype;
        $employee->E_Cost_Hour =$request->in_CostHour;
        $employee->idAccount = $id_new_user;
        $employee->E_DateofBirth = $request->in_Dateofbirth;
        $img_file = $request->in_img;
        $id_images = Employee::all()->count();
        if($img_file){
            $img_file_name = $img_file->getClientOriginalName();
            $img_file_extension_name = $img_file->getClientOriginalExtension();
            $img_file->move(public_path('images/personal_images'), ($id_images+1).'avatar.'.$img_file_extension_name);
            $employee->E_Avatar = ($id_images+1).'avatar.'.$img_file_extension_name;
        }
        $employee->save();
        /*Get the last Id insert of Employee*/
        $e_id = $request->in_id;
        $num_skill = Skill::all()->count();
        for($i = 0 ; $i < $num_skill ; $i++){
            $name_in_Skill = 'sl_Skill'.$i;
            $name_in_Year = 'in_Year.'.$i;
             if(isset($request->$name_in_Skill)){
                 $detail_Skill = new SkillDetail;
                 $detail_Skill->idEmployee = $e_id;
                 $sk_id = Skill::where('Skill','=',$request->$name_in_Skill)->first()->idSkill;
                 $detail_Skill->idSkill = $sk_id;
                 $detail_Skill->S_Rate = $request->in_Year[$i];
                 $detail_Skill->save();
             }
        }
        return redirect()->route('admin.personal-information.index');
    }
}
