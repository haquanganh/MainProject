<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Employee as Employee;
use App\User as User;
use App\Role as Role;
class Personal_Information_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::find(1);
        $id_Role = User::find($employee->idAccount)->idRole;
        $role_name = Role::find($id_Role)->Role;
        return view('personal.view',compact('employee','role_name'));
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
        return view('personal.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $employee = Employee::find($id);
        $employee->E_Email = $request->in_email;
        $employee->E_Skype = $request->in_skype;
        $employee->E_Phone = $request->in_phone;
        $employee->E_Address = $request->in_address;

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
