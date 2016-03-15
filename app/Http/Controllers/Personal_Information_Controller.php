<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Employee as Employee;
use App\User as User;
use App\Role as Role;
use Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Personal_Information_Request;
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
        $id_Rol = Auth::user()->idRole;
        $id_Acc = Auth::user()->idAccount;
        if( $id_Rol != 1 ){
            $id_Employee = Employee::where('idAccount','=',$id_Acc)->first()->idEmployee;
            $employee = Employee::find($id_Employee);
            $id_Role = User::find($employee->idAccount)->idRole;
            $role_name = Role::find($id_Role)->Role;
            return view('personal.view',compact('employee','role_name'));
        }
        return redirect()->route('admin.personal-information.index');
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
        $id_Rol = Auth::user()->idRole;
        $id_Acc = Auth::user()->idAccount;
        $id_Employee = Employee::where('idAccount','=',$id_Acc)->first()->idEmployee;
        if($id_Rol != 1 && $id_Employee == $id){
        $employee = Employee::find($id);
            return view('personal.edit',compact('employee'));
        }
        else if ($id_Rol ==1 )
        return redirect()->route('personal-information.index');
        else return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Personal_Information_Request $request, $id)
    {
        Input::merge(array_map('trim', Input::all()));
        $employee = Employee::find($id);
        $employee->E_Skype = $request->in_skype;
        $employee->E_Phone = $request->in_phone;
        $employee->E_Address = Input::get('in_address');
        $img_file = $request->in_img;
        if($img_file){
            $img_file_name = $img_file->getClientOriginalName();
            $img_file_extension_name = $img_file->getClientOriginalExtension();
            $img_file->move(public_path('images/personal_images'), $id.'avatar.'.$img_file_extension_name);
            $employee->E_Avatar = $id.'avatar.'.$img_file_extension_name;
        }
        $employee->save();
        return redirect()->route('personal-information.index');
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
