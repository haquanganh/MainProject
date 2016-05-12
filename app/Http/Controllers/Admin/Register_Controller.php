<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Employee as Employee;
use App\User as User;
use App\Role as Role;
use App\SkillDetail as SkillDetail;
use App\TeamMember as TeamMember;
use App\Clients as Clients;
use App\Client_Company as Client_Company;
use App\Http\Requests\RegisterRequest;
use App\Skill;
use Hash;
use Auth;
use DateTime;
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
        /*Valitdate password and duplicate skill and email*/
        $error_list = array();
        if($request->sl_Role == "Manager" || $request->sl_Role == "Member"){
            for($j = 0 ; $j < $request->number_rows ; $j++){
                $name_in_Skill = 'sl_Skill'.$j;
                for($k = $j+1 ; $k < $request->number_rows; $k++){
                    $name_in_Skill1 = 'sl_Skill'.$k;
                    if($request->$name_in_Skill == $request->$name_in_Skill1){
                        $arr1 = array('duplicated' => 'Please do not choose duplicated skill');
                        $error_list = $error_list + $arr1;
                        break;
                    }
                }
            }
        }
        if($request->in_Password != $request->in_Repassword){
            $arr2 = array('password_not_match' => 'Password is not match');
            $error_list = $error_list + $arr2;
        }
        $email_val = $request->in_Email;
        $arr_email =explode("@",$email_val);
        if(strpos($arr_email[1], '.') == false || strpos($arr_email[1], '..') == true){
            $arr3 = array('wrong_email'=> 'Invalid email');
            $error_list = $error_list+ $arr3;
        }
        if((!empty($request->in_Address)) && (preg_match('/[A-Z]+[a-z]/',$request->in_Address)) == false && (preg_match('/[1-9]/',$request->in_Address)) == true){
            $arr4 = array('wrong_address'=> 'Invalid address without characters');
            $error_list = $error_list + $arr4;
        }
        if($request->in_Phone == '0000000000' || $request->in_Phone == '00000000000'){
            $arr5 = array('wrong_phone' => 'Invalid phone');
            $error_list = $error_list + $arr5;
        }
        if(!empty($request->in_Dateofbirth)){
            $current_year = (new DateTime())->format('Y');
            $request_year = (new DateTime($request->in_Dateofbirth))->format('Y');
            if(($current_year - $request_year < 18)){
                $arr6 = array('wrong_year' => 'Your age can not be less than 18');
                $error_list = $error_list + $arr6;
            }
        }
        if(!empty($request->in_Skype) && (preg_match('/[A-Z]+[a-z]/',$request->in_Skype)) == false && (preg_match('/./',$request->in_Skype)) == false && (preg_match('/[1-9]/',$request->in_Skype)) == true){
            $arr7 = array('wrong_skype'=> 'Invalid skype without characters');
            $error_list = $error_list + $arr7;
        }
        if(!empty($error_list)){
            return redirect()->back()->withInput()->withErrors($error_list);
        }
        /*Add new user*/
        $id_Role = Role::where('Role','=',$request->sl_Role)->first()->idRole;
        $user = new User;
        $user->email = $request->in_Email;
        $user->password = Hash::make($request->in_Password);
        $user->idRole = $id_Role;
        $user->save();
        /*Add new employee of new user*/
        if($request->sl_Role == "Manager" || $request->sl_Role == "Member"){
            $employee = new Employee;
            $employee->idEmployee = $request->in_id;
            $employee->E_Name = $request->in_Name;
            $employee->E_EngName = $request->in_EName;
            $employee->E_Address = $request->in_Address;
            $employee->E_Sex = ($request->sl_Sex == 'Male' ? 1 : 0 );
            $employee->E_Phone = $request->in_Phone;
            $employee->E_Skype = $request->in_Skype;
            $employee->E_Cost_Hour =$request->in_CostHour;
            $employee->idAccount = $user->idAccount;
            $employee->E_DateofBirth = $request->in_Dateofbirth;
            $employee->idStatus = 2;
            $img_file = $request->in_img;
            /*Handle file and move to images/personal_images and save name images to database*/
            if($img_file){
                $img_file_name = $img_file->getClientOriginalName();
                $img_file_extension_name = $img_file->getClientOriginalExtension();
                $img_file->move(public_path('images/personal_images'), $user->idAccount.'avatar.'.$img_file_extension_name);
                $employee->E_Avatar = $user->idAccount.'avatar.'.$img_file_extension_name;
            }
            $employee->save();
            $e_id = $request->in_id;
            // /*Save list skill*/
             for($i = 0 ; $i < $request->number_rows ; $i++){
                 $name_in_Skill = 'sl_Skill'.$i;
                 $name_in_Year = 'in_Year.'.$i;
                  if(isset($request->$name_in_Skill)){
                      $detail_Skill = new SkillDetail;
                      $detail_Skill->idEmployee = $e_id;
                      $sk_id = Skill::where('Skill','=',$request->$name_in_Skill)->first()->idSkill;
                      $detail_Skill->idSkill = $sk_id;
                      $detail_Skill->S_Rate = $request->in_Year[$i];
                      $detail_Skill->S_Level = $request->in_Level[$i];
                      $detail_Skill->save();
                  }
             }
             /*Save team*/
            if($request->sl_Role == "Member"){
                $pe = new TeamMember;
                $pe->idMember = $e_id;
                $pe->idTeam = $request->sl_Team;
                $pe->save();
            }
        }
        else if($request->sl_Role == "Client Company"){
            $cp = new Client_Company;
            $cp->CC_Name = $request->in_Name;
            $cp->CC_Address = $request->in_Address;
            $cp->CC_Phone = $request->in_Phone;
            $cp->CC_Email = $request->in_Email;
            $cp->CC_Description = $request->in_descrip;
            $cp->idAccount = $user->idAccount;
            /*Save logo*/
            $img_file = $request->in_img;
            if($img_file){
                $img_file_name = $img_file->getClientOriginalName();
                $img_file_extension_name = $img_file->getClientOriginalExtension();
                $img_file->move(public_path('images/personal_images'), $user->idAccount.'avatar.'.$img_file_extension_name);
                $cp->CC_Logo = $user->idAccount.'avatar.'.$img_file_extension_name;
            }
            $cp->save();
        }
        else{
            $client = new Clients;
            $client->ClientName = $request->in_Name;
            $client->C_Address = $request->in_Address;
            $client->C_Phone = $request->in_Phone;
            $client->C_Skype = $request->in_Skype;
            $client->idAccount = $user->idAccount;
            $client->idClientCompany = $request->sl_Company;
            $img_file = $request->in_img;
            if($img_file){
                $img_file_name = $img_file->getClientOriginalName();
                $img_file_extension_name = $img_file->getClientOriginalExtension();
                $img_file->move(public_path('images/personal_images'), $user->idAccount.'avatar.'.$img_file_extension_name);
                $client->C_Avatar = $user->idAccount.'avatar.'.$img_file_extension_name;
            }
            $client->save();
        }
        return redirect()->route('admin.personal-information.index');
    }
}
